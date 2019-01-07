<?php

namespace App\Http\Controllers\admin;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cuisine;
use input;

class CuisinesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cuisines = Cuisine::all();
        return view('admin.cuisines.list')->with('cuisines',$cuisines);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cuisines.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $cuisine = new Cuisine;
      $cuisine->name = $request->name;
      $cuisine->save();

      Session::flash('success','Cuisine has been added');
      return redirect()->route('cuisines-list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cuisines = Cuisine::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $cuisines = Cuisine::find($request->id);
        return view('admin.cuisines.edit')->with('cuisines',$cuisines);
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

      $cuisines = Cuisine::find($request->id);
      if($cuisines)
      {
        $cuisines->update([
          'name'   =>   $request->name,
          'updated_at' => NOW()
        ]);
      }
      Session::flash('success','Cuisine has been updated');
      return redirect()->route('cuisines-list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cuisine::destroy($id);
        Session::flash('success','The Cuisine Has Been Deleted!');
        return back();
    }

    public function changeStatus($id)
    {
      $cuisine = Cuisine::find($id);
      //a($cuisine);
      if($cuisine)
      {
        $status = $cuisine->status == 0 ? 1 : 0;
        $cuisine->update([
          'status'   =>   $status,
          'updated_at' => NOW()
        ]);
      }

      Session::flash('success','Status has been changed');
      return back();

    }
}
