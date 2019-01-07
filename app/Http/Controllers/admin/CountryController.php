<?php

namespace App\Http\Controllers\admin;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Country;


class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.country.list')->with('countries',Country::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.country.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if(uniqueCheck('countries','name',$request->name) > 0)
      {
        Session::flash('success','This name is already exist!');
        return redirect()->back();
      }
        $country = new Country;
        $country->create($request->all());
        Session::flash('success','Country has been added');
        return redirect()->route('country-list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$countries = Country::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $countries = Country::find($request->id);
        return view('admin.country.edit')->with('countries',$countries);
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
      if(uniqueCheck('countries','name',$request->name,$request->id) > 0)
      {
        Session::flash('error','This name is already exist!');
        return redirect()->back();
      }
      $status = 'error';
      $msg = 'Unable to update';

      $countries = Country::find($request->id);

      if($countries)
      {
        $countries->update([
          'name'   =>   $request->name,
          'currency_name'   =>   $request->currency_name,
          'currency_code'   =>   $request->currency_code,
          'currency_symbol'   =>   $request->currency_symbol,
          'country_code'   =>   $request->country_code,
          'iso'   =>   $request->iso,
          'updated_at' => NOW()
        ]);
        $status = 'success';
        $msg = 'Country has been updated';
      }
      Session::flash($status,$msg);
      return redirect()->route('country-list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Country::destroy($id);
      Session::flash('success','The Country Has Been Deleted!');
      return back();
    }

    public function changeStatus($id)
    {
      $country = Country::find($id);
      if($country)
      {
        $status = $country->status == 0 ? 1 : 0;
        $country->update([
          'status'   =>   $status,
          'updated_at' => NOW()
        ]);
      }

      Session::flash('success','Status has been changed');
      return back();
    }
}
