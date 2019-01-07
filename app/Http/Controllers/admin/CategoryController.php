<?php

namespace App\Http\Controllers\admin;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.category.list')->with('categories',Category::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category;
        $category->create($request->all());
        Session::flash('success','Category has been added');
        return redirect()->route('category-list');
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
         $category = Category::find($request->id);
         return view('admin.category.edit')->with('category',$category);
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
       $category = Category::find($request->id);
       if($category)
       {
         $category->update([
           'name'   =>   $request->name,
           'updated_at' => NOW()
         ]);
       }
       Session::flash('success','Category has been updated');
       return redirect()->route('category-list');
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
     {
         Category::destroy($id);
         Session::flash('success','The Category Has Been Deleted!');
         return back();
     }

     public function changeStatus($id)
     {
       $category = Category::find($id);
       //a($category);
       if($category)
       {
         $status = $category->status == 0 ? 1 : 0;
         $category->update([
           'status'   =>   $status,
           'updated_at' => NOW()
         ]);
       }

       Session::flash('success','Status has been changed');
       return back();
     }

   }
