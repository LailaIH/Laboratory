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
        // get all the patients who have invoices
        $patients = Patient::has('invoices')->get();

        return view('invoices.index',['patients'=>$patients]);

    }

    public function show($id){


        $patient = Patient::findOrFail($id);
        $invoices = $patient->invoices ;

        $total =0;
        foreach($invoices as $invoice){
            $total+= $invoice->total_invoice;
        }



        return view('invoices.show' , ['patient'=>$patient ,
        'invoices'=>$invoices,
        'total'=>$total
        
    
    ]);


        }

        // invoice creation form for adding one by admin
        public function create(){
            $patients = Patient::all();
            return view('invoices.create',['patients'=>$patients]);

        }
    

       

        // store invoice from a form request with no sample (extra invoice)
        public function store(Request $request){
            $request->validate([
                'patient_id'=>'required',
                'total_invoice'=>'required',
            ]);

            $invoice = new Invoice();
            $invoice->user_id = auth()->user()->id;
            $invoice->patient_id = strip_tags($request->input('patient_id'));
            $invoice->total_invoice = strip_tags($request->input('total_invoice'));
            $invoice->save();

            return redirect()->route('invoices.index')->with('success','invoice has been created successfully');

        }

        // create invoice for a patien'ts specific sample
        public function createInvoiceFromSamplesList($sampleId , $patientId){

            $sample = Sample::findOrFail($sampleId);
            $maxDiscount = max($sample->campaign->discount , $sample->test->campaign->discount);
            $total = ($sample->test->price*(1-$maxDiscount))-$sample->paid_amount;


            $existingInvoice = Invoice::where('patient_id',$patientId)
            ->where('sample_id',$sampleId)->first();

            // if it exist , update the invoice value ,
            // an extra discount may have been requested after setting the invoice for that patient sample
            if($existingInvoice){
                $existingInvoice->total_invoice = $total;
                $existingInvoice->save();
                return redirect()->route('invoices.index')->with('success',' invoice value have been set again successfully');

            }

            else{
            
            $invoice = new Invoice();
            $invoice->user_id = auth()->user()->id;
            $invoice->sample_id = $sampleId;
            $invoice->patient_id = $patientId;
               
            $invoice->total_invoice = $total;
           
            $invoice->save(); 
            return redirect()->route('invoices.index')->with('success','invoice has been created successfully');

            }



        }

        // invoice cancel request
        public function invoiceCancelRequest($invoiceId){

            $invoice = Invoice::findOrFail($invoiceId);
            if($invoice->status=='waiting'){
                return redirect()->back()->with('warning','a canceling request has already been sent for this invoice , and it is in the waiting list');
            }
            elseif($invoice->status=='rejected'){
                return redirect()->back()->with('warning','a canceling request has already been sent for this invoice , and it is in the rejection list');

            }
            else{
            return view('invoices.cancel-reason',['invoice'=>$invoice]);
            }
        }

        public function storeCancelReason(Request $request ,$invoiceId ){
            $request->validate([
                'cancel_reason'=>'required',
            ]);

            $invoice = Invoice::findOrFail($invoiceId);
            $patient = $invoice->patient;

            $invoice->cancel_reason = strip_tags($request->input('cancel_reason'));
            $invoice->status='waiting';
            $invoice->save();
            return redirect()->route('invoices.show',$patient->id)->with('success','canceling request has been sent successfully , waiting for manager approval');
        }

        public function waitingInvoices(){
            $invoices = Invoice::where('status','waiting')->get();

            return view('invoices.waiting-invoices',['invoices'=>$invoices]);
        }

        public function cancel($id){

            Invoice::destroy($id);
            return redirect()->route('invoices.waiting_invoices')->withErrors(['fail' => 'Invoice Has Been Canceled']);

        }

        public function reject($id){
            $invoice = Invoice::findOrFail($id);
            $invoice->status = 'rejected';
            $invoice->save();
            return redirect()->route('invoices.waiting_invoices')->withErrors(['fail' => 'Invoice Cancel Request Has Been Rejecte , Invoice is moved to rejected invoices list']);


        }

        public function rejectedInvoices(){
            $invoices = Invoice::where('status','rejected')->get();

            return view('invoices.rejected-invoices',['invoices'=>$invoices]);

        }



}




