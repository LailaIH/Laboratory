<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Department;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Models\Test;

class TestController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){

        return view('tests.index',['tests'=>Test::all()]);
    }

    public function create(){

        return view('tests.create' , ['departments'=>Department::all()
    ,'groups'=>Group::all() , 'campaigns'=>Campaign::all()]);
    }

    public function store(Request $request){

        $request->validate([
            'name'=>'required|string',
            'price'=>'required|numeric',
            'group_id'=>'required',
            'campaign_id'=>'required',


        ]);
        
        $test = new Test();
        $test->user_id = auth()->user()->id;
        $test->name = strip_tags($request->input('name'));
        $test->department_id = strip_tags($request->input('department_id'));
        $test->group_id = strip_tags($request->input('group_id'));

        if($request->filled('campaign_id')){
        $test->campaign_id = strip_tags($request->input('campaign_id'));
        }
        else{
            $campaign= Campaign::where('discount',0.0)->first();
            $test->campaign_id = $campaign->id;
        }
        $test->price = strip_tags($request->input('price'));

        $test->save();

        return redirect()->route('admin');



    }






}
