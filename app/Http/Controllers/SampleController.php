<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Sample;
use App\Models\Patient;
use App\Models\Branch;
use App\Models\Doctor;
use App\Models\Payment;
use App\Models\Campaign;
use App\Models\Group;
use App\Models\Institu;


class SampleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $samples = Sample::all();
        return view('samples.index',['samples'=>$samples]);
    }


    
    public function autocompleteSearch(Request $request)
    {
          $query = $request->get('query');
          $filterResult = Patient::where('name', 'LIKE', '%'. $query. '%')->get();
          return response()->json($filterResult);
    }


    public function create(){

        return view('samples.create',[
            'branches'=>Branch::all() ,
            'patients'=>Patient::all(),
            'doctors'=>Doctor::all(),
            'institutes'=>Institu::all(),
            'payments'=>Payment::all(),
            'campaigns'=>Campaign::all(),
            'groups'=>Group::all()
        ]);
    }

    public function store(Request $request){

      $data=  $request->validate([
            'search'=>'required|string', //patient's name
            'branch_id'=>'required',
            'doctor_id'=>'required',
            'institute_id'=>'required',
            'payment_id'=>'required',
            'group_id'=>'required',
            'campaign_id'=>'required',
            'period'=>'date',
            'today'=>'date',
            'total_price'=>'required|numeric',
            'gross_amount'=>'required|numeric',
            'paid_amount'=>'required|numeric',
            'remain_amount'=>'required|numeric',
            'money_note'=>'string',
            'notes'=>'string',
            'admission'=>'required|date',

        ]);

        $sample = new Sample();


        // count gestational age
        if($data['period'] && $data['today']){
        $lastPeriodDate = Carbon::parse($data['period']);
        $todayDate = Carbon::parse($data['today']);
        $gestational_age = $todayDate->diffInDays($lastPeriodDate);
        $sample->period_time = $gestational_age;

        }

        // if entered patient exists attach its id to the sample , if not create a new patient
        $patient = Patient::where('name', $data['search'])->first();
        if($patient){
            $sample->patient_id = $patient->id;
        }

        else{
            $newPatient = new Patient();
            $newPatient->user_id = auth()->user()->id;
            $newPatient->name = $data['search'];
            $newPatient->save();
            $sample->patient_id = $newPatient->id;
        }

        $sample->user_id = auth()->user()->id;
        $sample->branch_id	= $data['branch_id'];
        $sample->doctor_id	= $data['doctor_id'];
        $sample->institu_id	= $data['institute_id'];
        $sample->payment_id	= $data['payment_id'];
        $sample->group_id	= $data['group_id'];
        $sample->campaign_id = $data['campaign_id'];
        $sample->total_price = $data['total_price'];
        $sample->admission_date = $data['admission'];
        $sample->gross_amount = $data['gross_amount'];
        $sample->paid_amount = $data['paid_amount'];
        $sample->remain_amount = $data['remain_amount'];
        $sample->money_note = $data['money_note'];
        $sample->pation_note = $data['notes'];
        $sample->is_approved = $request->has('is_approved')?1:0;
        $sample->is_approved_doctor = $request->has('is_approved_doctor')?1:0;
        $sample->is_online = $request->has('is_online')?1:0;

        

        $sample->save();
        return redirect()->route('samples.index');



    }


    public function updateStatus(Request $request, Sample $sample)
    {
        // Toggle the is_online status
        $sample->update(['is_online' => !$sample->is_online]);

        return back()->with('success', 'Status updated successfully');
    }



    // function for viewing samples with no discounts
    // public function noDiscountSamples(){
    //     $noDiscountSamples = Sample::whereHas('campaign', function ($query) {
    //         $query->where('name', 'no discount');
    //     })->get();

    //     return view('samples.no_discount_samples',['noDiscountSamples'=>$noDiscountSamples]);

    
    // }


    public function discountReason($id){
        $sample = Sample::findOrFail($id);
        return view('samples.discount-reason',['sample'=>$sample]);
    }

    public function storeReason(Request $request , $id){

        $sample = Sample::findOrFail($id);

        $request->validate([
            'discount_reason'=>'required|string',
        ]);

        $sample->discount_reason = $request->input('discount_reason');
        $sample->status = 'waiting';
        $sample->save();
        return redirect()->route('samples.index')->with('success','request has been sent');
    }

    //for admin to view  discount requests

    public function approve(){
        $waitingSamples = Sample::where('status', 'waiting')->get();

        return view ('samples.admin_check' , ['waitingSamples'=>$waitingSamples,
        'campaigns'=>Campaign::all()]);
    }

    // show rejected samples
    public function rejectedSamples(){
        $rejectedSamples = Sample::where('status', 'rejected')->get();

        return view ('samples.rejected' , ['rejectedSamples'=>$rejectedSamples,
        'campaigns'=>Campaign::all()]);
    }

    // admin approve discount
    public function approveDiscountReason(Request $request ,$id)
    {
        $sample = Sample::findOrFail($id);
        $sample->status = 'approved';
        $sample->campaign_id = $request->input('campaign_id');
        $sample->save();
        return redirect()->route('samples.approve')->with('success','Request Has Been Approved');
    }

    //admin reject discount
    public function rejectDiscountReason($id)
    {
        $sample = Sample::findOrFail($id);
        $sample->status = 'rejected';
        $sample->save();
        return redirect()->route('samples.approve')->withErrors(['fail' => 'Request Has Been Rejected']);
    }


}

