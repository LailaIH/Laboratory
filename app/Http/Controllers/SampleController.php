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
use App\Models\Test;
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
            'tests'=>Test::all(),
            
        ]);
    }

    public function store(Request $request){

      $data=  $request->validate([
            'search'=>'required|string', //patient's name
            'branch_id'=>'required',
            'doctor_id'=>'required',
            'institute_id'=>'required',
            'payment_id'=>'required',
            'test_id'=>'required',
            
            
            
            'gross_amount'=>'required|numeric',
            'paid_amount'=>'required|numeric',
            'test_id'=>'required',
            'money_note'=>'string',
            'notes'=>'string',
            'admission'=>'required|date',

        ]);

        $sample = new Sample();
        $campaign = Campaign::where('discount',0.0)->first();
        $test = Test::findOrFail($data['test_id']);

        // count gestational age
        if($request->filled('today') && $request->filled('period')){
        $lastPeriodDate = Carbon::parse($request->input('period'));
        $todayDate = Carbon::parse($request->input('today'));
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
        $sample->test_id = $data['test_id'];
        
        $sample->campaign_id = $campaign->id;
        $sample->admission_date = $data['admission'];
        $sample->gross_amount = $data['gross_amount'];
        $sample->paid_amount = $data['paid_amount'];
        $sample->remain_amount = $test->price - $data['paid_amount'];
        $sample->money_note = $data['money_note'];
        $sample->pation_note = $data['notes'];
        
        $sample->is_approved_doctor = false;
        

        

        $sample->save();
        return redirect()->route('samples.index');



    }


    public function updateStatus(Request $request, Sample $sample)
    {
        // Toggle the is_online status
        $sample->update(['is_online' => !$sample->is_online]);

        return back()->with('success', 'Status updated successfully');
    }



 


    public function discountReason($id){
        $sample = Sample::findOrFail($id);
        if($sample->status=='waiting'){
            return redirect()->back()->with('warning','extra discount has already been requested for this sample , and it is in the waiting list' );
        }
        elseif($sample->status=='rejected'){
            return redirect()->back()->with('warning','extra discount has already been requested and rejected for this sample , and it is in the rejection list' );

        }
        else{
        return view('samples.discount-reason',['sample'=>$sample]);
        }
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

    //show waiting samples
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
        $campaign = Campaign::findOrFail($request->input('campaign_id'));
        if($sample->test->campaign->discount < $campaign->discount){
        $sample->status = 'approved';
        $sample->campaign_id = $request->input('campaign_id'); // extra discount approved , and the test original discount is ignored
        $sample->save();
        return redirect()->route('samples.approve')->with('success','Request Has Been Approved');
        }
        else{
            $sample->status = 'waiting';
            $sample->save();
            return redirect()->route('samples.approve')->with('warning','The Test of this sample  already have a higer discount percentage , you can just edit the test');

        }
    }


    //admin reject discount
    public function rejectDiscountReason($id)
    {
        $sample = Sample::findOrFail($id);
        $sample->status = 'rejected';
        $sample->save();
        return redirect()->route('samples.approve')->withErrors(['fail' => 'Request Has Been Rejected']);
    }



 public function lateSamples(){
            // get samples that have results entered
            $samples = Sample::has('result')->get();
            $lateSamples =[];

            // samples that already have results but were entered late
            foreach($samples as $sample){
                if($sample->result_entry_due && $sample->result_entry_due < $sample->result->created_at){
                    $lateSamples[]=$sample;
                }
            }

            // samples that exceeded the result entry date and haven't yet enter a result
            $noResultsSamples = Sample::doesntHave('result')->get();
            foreach($noResultsSamples as $noResultsSample){
                if($noResultsSample->result_entry_due && $noResultsSample->result_entry_due < Carbon::now()){
                    $lateSamples[]=$noResultsSample;
                }
            }

            return view('samples.late-samples' , ['lateSamples'=>$lateSamples]);


        }

}