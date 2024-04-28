<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){

        return view('patients.index',['patients'=>Patient::orderBy('created_at', 'desc')->get()]);

    }

    public function updateStatus(Request $request, Patient $patient)
    {
        // Toggle the is_online status
        $patient->update(['is_online' => !$patient->is_online]);

        return back()->with('success', 'Status updated successfully');
    }

    public function create(){

        return view('patients.create');
    }

    public function store(Request $request){

        $request->validate([
            'name'=>'required',
            'birth'=>'required',
            'gender'=>'required'
        ]);

        $patient = new Patient();
        $patient->user_id = auth()->user()->id;
        $patient->name = strip_tags($request->input('name'));
        $patient->date_of_birth = strip_tags($request->input('birth'));
        $patient->gender = strip_tags($request->input('gender'));
        $patient->city = strip_tags($request->input('city'));
        $patient->village = strip_tags($request->input('village'));
        $patient->work_address = strip_tags($request->input('work_address'));
        $patient->phone_number = strip_tags($request->input('phone_number'));
        $patient->whatsapp_number = strip_tags($request->input('whatsapp_number'));
        $patient->email = strip_tags($request->input('email'));
        $patient->id_number = strip_tags($request->input('id_number'));
        $patient->online_portal_information = strip_tags($request->input('online_portal_information'));
        $patient->facebook = strip_tags($request->input('facebook'));
        $patient->instagram = strip_tags($request->input('instagram'));
        $patient->patient_notes = strip_tags($request->input('patient_notes'));
        $patient->address_on_map = strip_tags($request->input('address_on_map'));
        
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('productImages'), $imageName);
            $patient->img = $imageName;
        }
    




        $patient->is_online = 1;
        $patient->save();

        return redirect()->route('patients.index')->with('success','patient has been created successfully');


    }


    // display patients that registered sample/s
    public function patientsWithPriceQuotation(){

        // retrieve patients who has samples
        $patientsWithSamples = Patient::has('samples')->get();
        return view('patients.patients-with-samples',['patientsWithSamples'=>$patientsWithSamples]);



    }

    public function priceQuotation($id){

        $patient = Patient::findOrFail($id);

        $samples = $patient->samples;
        return view('patients.price-quotation',['patient'=>$patient , 'samples'=>$samples]);
    }
}
