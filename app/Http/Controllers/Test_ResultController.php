<?php

namespace App\Http\Controllers;

use App\Models\Test_Result;
use App\Models\Test;
use Illuminate\Support\Facades\Log; // <-- Make sure this line is present


use Illuminate\Http\Request;

class Test_ResultController extends Controller
{
   public function index(){

    return view('test_results.index',['results'=>Test_Result::all()]);
   }

   public function create(){
    $tests = Test::all();

    return view('test_results.create',['tests'=>$tests]);
   }

   public function store(Request $request)
   {
       // Validate the incoming request data
       $validatedData = $request->validate([
           'test_id' => 'required|exists:tests,id',
           'result' => 'required|string',
       ]);
   
       
           $test_result = new Test_Result();
   
           $test_result->test_id = $validatedData['test_id'];
           $test_result->result = $validatedData['result'];
   
           $test_result->save();
   
           return redirect()->route('test_results.index')->with('success', 'A new result has been successfully created');
       } 

       public function edit($id){

        $test_result = Test_Result::findOrFail($id);
        return view('test_results.edit' , ['testResult'=>$test_result , 'tests'=>Test::all()]);
       }

       public function update(Request $request , $id){

        $test_result = Test_Result::findOrFail($id);

        $request->validate([
            'test_id'=>'required',
            'result'=>'required',
        ]);

        $test_result->test_id = $request->input('test_id');
        $test_result->result = $request->input('result');
        $test_result->save();

        return redirect()->route('test_results.index')->with('success','test result has been updated successfully');


       }


   }
   



