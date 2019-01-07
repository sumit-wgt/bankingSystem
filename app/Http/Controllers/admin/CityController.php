<?php

namespace App\Http\Controllers\admin;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Country;
use App\State;
use App\City;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.city.list')->with('cities',City::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::select('id','name')->get();
        $states = State::select('id','name')->get();
        return view('admin.city.add')->with('countries',$countries)->with('states',$states);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if(uniqueCheck('cities','name',$request->name) > 0)
      {
        Session::flash('error','This name is already exist!');
        return redirect()->back();
      }
      $state = new City;
      $state->create($request->all());

      Session::flash('success','City has been added');
      return redirect()->route('city-list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
      $states = State::select('id','name')->get();
      $countries = Country::select('id','name')->get();
      $city = City::find($request->id);
      return view('admin.city.edit')->with('states',$states)->with('countries',$countries)->with('city',$city);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $status = 'error';
      $msg = 'Unable to update';
      $cities = City::find($request->id);

      if($cities)
      {
        $cities->update([
          'name'       =>   $request->name,
          'country_id' =>   $request->country_id,
          'state_id' =>   $request->state_id,
          'updated_at' => NOW()
        ]);
        $status = 'success';
        $msg = 'City has been updated';
      }
      Session::flash($status,$msg);
      return redirect()->route('city-list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      City::destroy($id);
      Session::flash('success','The City Has Been Deleted!');
      return back();
    }

    public function changeStatus($id)
    {
      $city = City::find($id);
      if($city)
      {
        $status = $city->status == 0 ? 1 : 0;
        $city->update([
          'status'   =>   $status,
          'updated_at' => NOW()
        ]);
      }

      Session::flash('success','Status has been changed');
      return back();
    }

    public function stateList($id)
    {
      $states = State::where('country_id',$id)->select('id','name')->get();
      return $states;
    }
}
