<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result;
use App\Models\Sample;
use App\Models\Patient;



class ResultController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $results = Result::all();

        return view('results.index',['results'=>$results]);
    }

    public function updateStatus(Request $request, Result $result)
    {
        // Toggle the is_online status
        $result->update(['is_online' => !$result->is_online]);

        return back()->with('success', 'Status updated successfully');
    }




    // view to enter patient name to find their samples
    public function searchPatientSamples(){
        $samples = null;
        return view('results.search-patients-samples', compact('samples'));
    }

    //show sample's of entered patient
    public function findSamples(Request $request){

        $request->validate([
            'search'=>'required|string',
        ]);
        
        $patient = Patient::where('name',$request->input('search'))->first();

        
        if(!$patient || !$patient->samples()->exists()){
            return redirect()->route('results.search_patients_samples')->withErrors(['fail' => 'Sample Must Be Created']);

        }
        else{

            // Retrieve samples of the patient that do not have associated results
            $samples = $patient->samples()->whereDoesntHave('result')->get();
            return view('results.search-patients-samples', compact('samples'));
                }


    }


    public function create($id){
        $sample = Sample::findOrFail($id);
        
        return view('results.create',['sample'=>$sample]);
    }

    public function store(Request $request ,$id){
        $data = $request->validate([

            'title'=>'required|string',
            'body'=>'required|string',
            'status'=>'string',
        ]);

        $result = new Result();

        $result->user_id = auth()->user()->id;
        $result->sample_id = $id ;
        $result->title = $data['title'];
        $result->body = $data['body'];
        $result->status = $data['status'];
        $result->is_online = $request->has('is_online')?1:0;

        $result->save();

        return redirect()->route('results.index');
    }


    // Admin Approval Or Rejection Process 


    public function notApprovedByAdminResults()
{
    $notApprovedResults = Result::where('is_approved', false)->get();
    return view('results.admin-not-approved', compact('notApprovedResults'));
}

   //Admin Approve 

   public function adminApproveResult($id)
{
    $result = Result::findOrFail($id);
    $result->is_approved = true;
    $result->status = 'approved'; //by admin
    $result->save();
    return redirect()->back()->with('success', 'Result approved successfully.');
}

// Doctor Approval Process

public function notApprovedByDoctorResults()
{
    $notApprovedResults = Result::where('is_approved_doctor', false)->get();
    return view('results.doctor-not-approved', compact('notApprovedResults'));
}

public function doctorApproveResult($id)
{
    $result = Result::findOrFail($id);
    $result->is_approved_doctor = true;
    $result->doctor_approval_status = 'approved'; //by doctor
    $result->save();
    return redirect()->back()->with('success', 'Result approved successfully.');
}



    









}
