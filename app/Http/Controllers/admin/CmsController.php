<?php

namespace App\Http\Controllers\admin;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cms;

class CmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.cms.list')->with('cmss',Cms::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cms.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $cms = new Cms;
      $cms->create($request->all());
      Session::flash('success','Cms has been added');
      return redirect()->route('cms-list');
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
         $cms = Cms::find($request->id);
         return view('admin.cms.edit')->with('cms',$cms);
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
       $cms = Cms::find($request->id);
       if($cms)
       {
         $cms->update([
           'name'   =>   $request->name,
           'content'   =>   $request->content,
           'updated_at' => NOW()
         ]);
       }
       Session::flash('success','Cms has been updated');
       return redirect()->route('cms-list');
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Cms::destroy($id);
      Session::flash('success','The CMS Has Been Deleted!');
      return back();
    }

    public function changeStatus($id)
    {
      $cms = Cms::find($id);
      if($cms)
      {
        $status = $cms->status == 0 ? 1 : 0;
        $cms->update([
          'status'   =>   $status,
          'updated_at' => NOW()
        ]);
      }

      Session::flash('success','Status has been changed');
      return back();
    }

}
