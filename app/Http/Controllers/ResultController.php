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
        $view = true;
        return view('results.search-patients-samples', compact('samples','view'));
    }

    //show sample's of entered patient
    public function findSamples(Request $request){

        $request->validate([
            'search'=>'required|string', //patient name
        ]);
        
        $patient = Patient::where('name',$request->input('search'))->first();

        
        if(!$patient || !$patient->samples()->exists()){
            return redirect()->route('results.search_patients_samples')->withErrors(['fail' => 'Sample Must Be Created']);

        }
        else{

            // Retrieve samples of the patient that do not have associated results
            $samples = $patient->samples()->whereDoesntHave('result')->get();
            $view = false;
            return view('results.search-patients-samples', compact('samples','view'));
                }


    }


    public function create($id){
        $sample = Sample::findOrFail($id);
        $test = $sample->test ;
        $results = $test->results;
        $nonNullResults = array_filter($results, function ($value) {
            return $value !== null;
        });
        
        return view('results.create',['sample'=>$sample ,'results'=>$nonNullResults]);
    }

    public function store(Request $request ,$id){
        $data = $request->validate([

            'title'=>'required|string',
            'body'=>'required|string',
            'status'=>'required|string',
        ]);

        $result = new Result();

        $result->user_id = auth()->user()->id;
        $result->sample_id = $id ;
        $result->title = $data['title'];
        $result->body = $data['body'];
        $result->status = $data['status'];
        $result->is_online = $request->has('is_online')?1:0;
        $result->is_approved = 0;
        $result->is_approved_doctor = 0;
        $result->status = 'waiting';
        $result->doctor_approval_status='waiting';

        $result->save();

        return redirect()->route('results.index');
    }


    // Admin Approval Or Rejection Process 

    // waiting for admin approval or rejection
    public function notApprovedByAdminResults()
{
    $notApprovedResults = Result::where('status', 'waiting')->get();
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


public function adminRejectResult(Request $request ,$id)
{
    $request->validate(['reason'=>'required']);
    $result = Result::findOrFail($id);
    $result->is_approved = false;
    $result->admin_reason = $request->input('reason');
    $result->status = 'rejected'; //by admin
    $result->save();
    return redirect()->back()->withErrors(['fail' => 'Result Has Been Rejected By Admin']);
}


public function rejectedByAdminResults()
{
    $rejectedResults = Result::where('status', 'rejected')->get();
    return view('results.admin-rejected', compact('rejectedResults'));
}



// Doctor Approval Process

public function notApprovedByDoctorResults()
{
    $notApprovedResults = Result::where('doctor_approval_status', 'waiting')->get();
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

public function doctorRejectResult(Request $request ,$id)
{
    $request->validate(['reason'=>'required']);
    $result = Result::findOrFail($id);
    $result->is_approved_doctor = false;
    $result->doctor_reason = $request->input('reason');
    $result->doctor_approval_status = 'rejected'; //by doctor
    $result->save();
    return redirect()->back()->withErrors(['fail' => 'Result Has Been Rejected By Doctor']);
}



public function rejectedByDoctorResults()
{
    $rejectedResults = Result::where('doctor_approval_status', 'rejected')->get();
    return view('results.doctor-rejected', compact('rejectedResults'));
}


public function destroy($id){
    $result = Result::findOrFail($id);

    $sample = $result->sample;
    Result::destroy($id);
    return redirect()->route('results.create',$sample->id)->with('warning','the result of this sample has been deleted , please consider re-entering the result');
}



    









}
