<?php

namespace App\Http\Controllers\admin;

use Session;
use App\State;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Country;


class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.state.list')->with('states',State::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $countries = Country::select('id','name')->get();
      return view('admin.state.add')->with(compact('countries',$countries));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if(uniqueCheck('states','name',$request->name) > 0)
      {
        Session::flash('error','This name is already exist!');
        return redirect()->back();
      }
      $state = new State;
      $state->create($request->all());

      Session::flash('success','State has been added');
      return redirect()->route('state-list');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $states = State::find($request->id);
        $countries = Country::select('id','name')->get();
        return view('admin.state.edit')->with('state',$states)->with('countries',$countries);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request)
     {
       if(uniqueCheck('states','name',$request->name,$request->id) > 0)
       {
         Session::flash('error','This name is already exist!');
         return redirect()->back();
       }
       $status = 'error';
       $msg = 'Unable to update';
       $states = State::find($request->id);

       if($states)
       {
         $states->update([
           'name'       =>   $request->name,
           'country_id' =>   $request->country_id,
           'updated_at' => NOW()
         ]);
         $status = 'success';
         $msg = 'Country has been updated';
       }
       Session::flash($status,$msg);
       return redirect()->route('state-list');
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      State::destroy($id);
      Session::flash('success','The State Has Been Deleted!');
      return back();
    }

    public function changeStatus($id)
    {
      $state = State::find($id);
      if($state)
      {
        $status = $state->status == 0 ? 1 : 0;
        $state->update([
          'status'   =>   $status,
          'updated_at' => NOW()
        ]);
      }

      Session::flash('success','Status has been changed');
      return back();
    }
}
