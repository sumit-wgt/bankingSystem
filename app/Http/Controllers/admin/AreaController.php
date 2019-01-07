<?php

namespace App\Http\Controllers\admin;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Country;
use App\State;
use App\City;
use App\Area;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.area.list')->with('areas',Area::all());
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
      return view('admin.area.add')->with('countries',$countries)->with('states',$states);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
     {
       if(uniqueCheck('areas','name',$request->name) > 0)
       {
         Session::flash('error','This name is already exist!');
         return redirect()->back();
       }
       $area = new Area;
       $area->create($request->all());

       Session::flash('success','Area has been added');
       return redirect()->route('area-list');
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
       $cities = City::select('id','name')->get();
       $area = Area::find($request->id);
       return view('admin.area.edit')->with('states',$states)->with('countries',$countries)
       ->with('cities',$cities)
       ->with('area',$area);
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
      $areas = Area::find($request->id);

      if($areas)
      {
        $areas->update([
          'name'        =>   $request->name,
          'country_id'  =>   $request->country_id,
          'state_id'    =>   $request->state_id,
          'city_id'     =>   $request->city_id,
          'city_id'     =>   $request->city_id,
          'post_code'   =>   $request->post_code,
          'updated_at' => NOW()
        ]);
        $status = 'success';
        $msg = 'Country has been updated';
      }
      Session::flash($status,$msg);
      return redirect()->route('area-list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Area::destroy($id);
      Session::flash('success','The Area Has Been Deleted!');
      return back();
    }

    public function changeStatus($id)
    {
      $area = Area::find($id);
      if($area)
      {
        $status = $area->status == 0 ? 1 : 0;
        $area->update([
          'status'   =>   $status,
          'updated_at' => NOW()
        ]);
      }

      Session::flash('success','Status has been changed');
      return back();
    }

    public function cityList($id)
    {
      $cities = City::where('state_id',$id)->select('id','name')->get();
      return $cities;
    }
}
