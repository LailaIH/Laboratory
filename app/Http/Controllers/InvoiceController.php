<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Patient;
use App\Models\Sample;
use App\Models\Debit;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    // invoices of patients
    public function index(){

        return view('invoices.index',['patients'=>Patient::all()]);

    }

    public function show($id){


        $patient = Patient::findOrFail($id);
        $samples = Sample::where('patient_id', $id)->get();
        $debits = Debit::where('patient_id', $id)
        ->where('debit', '>', 0)
        ->get();
        $totalSamples = 0;
        $totalDebits = 0;

        if(!$samples->isEmpty()){
            foreach($samples as $sample){
                $maxDiscount = max($sample->campaign->discount , $sample->test->campaign->discount);

               
                $totalSamples += ($sample->test->price*(1-$maxDiscount))-$sample->paid_amount;
               
               
            } }

            $totalSamples = abs($totalSamples);
            
        if(!$debits->isEmpty())   {
            foreach($debits as $debit){
            $totalDebits += $debit->debit ; }
        } 

        return view('invoices.show' , ['debits'=>$debits ,
        'totalSamples'=>$totalSamples,
        'totalDebits'=>$totalDebits
    
    ]);


        }

    }








