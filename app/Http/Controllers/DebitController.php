<?php

namespace App\Http\Controllers;

use App\Models\Debit;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;

class DebitController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('debits.index',['debits'=>Debit::all()]);
    }


    public function create(){

        return view('debits.create');

    }

    public function store(Request $request){

       $data= $request->validate([
        'search'=>'required|string',
            'debit'=>'required|numeric',
            'description'=>'string',
        ]);

        $debit = new Debit();
        

        $patient = Patient::where('name', $data['search'])->first();

        if (!$patient) {
            return redirect()->route('debits.create')->with('warning', 'Patient not found. Please create the patient first.');
        }

        $debit->user_id = auth()->user()->id;
        $debit->patient_id = $patient->id;
        $debit->debit = $request->input('debit');
        $debit->description = $request->input('description');
        $debit->save();

        return redirect()->route('debits.index')->with('success', 'Debit created successfully.');
       
    }

    public function debitsPayForm($id){
        $debit = Debit::findOrFail($id);

        return view('debits.pay' , ['debit'=>$debit]);
    }

    public function payDebit(Request $request ,$id){

        $request->validate([
           'new_debit'=>'required',
        ]);

        $debit = Debit::findOrFail($id);
        $patient = $debit->patient ;

        $oldDebit = $debit->debit ;
        $newDebit = $request->input('new_debit');

        if($newDebit <= $oldDebit){
        $debit->debit = $oldDebit - $newDebit ;
        $debit->save();
        return redirect()->route('invoices.show',$patient->id);
        }

        return redirect()->route('debits.pay_form' , $id)->with('warning','Amount you entered is greater than original edit');


    }








}
