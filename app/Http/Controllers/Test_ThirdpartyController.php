<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\Test_Thirdparty;
use App\Models\Thirdparty;
use Illuminate\Http\Request;

class Test_ThirdpartyController extends Controller
{


    public function index(){


        return view('test_thirdparies.index',['test_thirdparties'=>Test_Thirdparty::all()]);
    }

    public function create(){

        return view('test_thirdparies.create' , ['tests'=>Test::all() ,
    'thirdparties'=>Thirdparty::all()]);
    }

    public function store(Request $request){
        $request->validate([
            'test_id'=>'required',
            'thirdparty_id'=>'required',
            'given_time'=>'required',
        ]);

        $test_thirdparty = Test_Thirdparty::where('test_id',$request->input('test_id'))
        ->where('thirdparty_id',$request->input('thirdparty_id'))->first();
        if($test_thirdparty){
            return redirect()->route('test_thirdparies.index')->with('warning','test and third part are already attached ');

        }
        else{
        $test_thirdparty = new Test_Thirdparty();
        
        $test_thirdparty->user_id = auth()->user()->id;
        $test_thirdparty->test_id = $request->input('test_id');
        $test_thirdparty->thirdparty_id = $request->input('thirdparty_id');
        $test_thirdparty->given_time = $request->input('given_time');
        $test_thirdparty->save();

        return redirect()->route('test_thirdparies.index')->with('success','test and third part have been attached successfully');
        }

    }
}
