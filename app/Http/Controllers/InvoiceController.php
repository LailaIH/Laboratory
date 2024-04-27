<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Patient;
use App\Models\Sample;
use App\Models\Debit;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    // status column --> status for canceling invoice request (waiting,rejected,approved)
    // paying_status column --> the status of invoice paying ( paid , unpaid , pending )


    // invoices of patients
    public function index(){
        // get all the patients who have invoices
        $patients = Patient::has('invoices')->get();

        return view('invoices.index',['patients'=>$patients]);

    }

    public function show($id){


        $patient = Patient::findOrFail($id);
        $invoices = $patient->invoices ;

        $total = $invoices->where('is_online', 1)->sum('remaining_amount');




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
            $invoice->remaining_amount = strip_tags($request->input('total_invoice'));
            $invoice->paying_status='pending';
            $invoice->is_online = 1;
            $invoice->save();

            return redirect()->route('invoices.index')->with('success','invoice has been created successfully');

        }

        // create invoice for a patient's specific sample
        public function createInvoiceFromSamplesList($sampleId , $patientId){

            $sample = Sample::findOrFail($sampleId);
            $maxDiscount = max($sample->campaign->discount , $sample->test->campaign->discount);
            $total = ($sample->test->price*(1-$maxDiscount));


            $existingInvoice = Invoice::where('patient_id',$patientId)
            ->where('sample_id',$sampleId)->first();

            // if it exist , update the invoice value ,
            // an extra discount may have been requested after setting the invoice for that patient sample
            if($existingInvoice){
                $existingInvoice->total_invoice = $total;
                $existingInvoice->remaining_amount=$total ;
                $existingInvoice->paid_amount = 0;
                $existingInvoice->paying_status = 'pending';
                $existingInvoice->save();
                return redirect()->route('invoices.index')->with('success',' invoice value have been set again successfully');

            }

            else{
            
            $invoice = new Invoice();
            $invoice->user_id = auth()->user()->id;
            $invoice->sample_id = $sampleId;
            $invoice->patient_id = $patientId;
            $invoice->total_invoice = $total;
            $invoice->remaining_amount = $total ;
            $invoice->is_online = 1;
           
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

            $invoice = Invoice::findOrFail($id);
            $invoice->status = 'approved';
            $invoice->is_online = 0;
            $invoice->save();
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

        // view invoice paying form 

        public function invoicePayForm($id){

            return view('invoices.pay-form',['invoice'=>Invoice::findOrFail($id)]);
        }

        // fully or partly pay an invoice / debit
        public function payForInvoice(Request $request ,$id){

            $request->validate([
            
                'new_invoice'=>'required',
            ]);

            $invoice = Invoice::findOrFail($id);

          
            $patientId = $invoice->patient->id;
            $oldInvoice = $invoice->total_invoice ;
            $oldPaidAmount = $invoice->paid_amount;
            $newInvoice = strip_tags($request->input('new_invoice'));

            if($newInvoice <= $invoice->remaining_amount){
            
                $invoice->paid_amount = $newInvoice + $oldPaidAmount;
                $invoice->remaining_amount = $oldInvoice - $invoice->paid_amount ;
                $invoice->paying_status = $invoice->remaining_amount==0? 'fully paid':'partly paid';

                $invoice->save();
                return redirect()->route('invoices.show',$patientId)->with('success','successfully updated invoice value');

            }

            return redirect()->back()->with('warning','Amount you entered is greater than your original invoice');

            




        }

}




