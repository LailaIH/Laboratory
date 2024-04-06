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
