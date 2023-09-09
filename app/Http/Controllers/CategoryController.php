<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['categories'] = Category::bySchool(auth()->user()->school_id)->get();
        return view('category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required|string',
            'status' => 'required|numeric',
        ]);
        $category = new Category();
        $category->school_id = auth()->user()->school_id;
        $category->name = $request['name'];
        $category->status = $request['status'];
        $category->save();
        toast(transMsg('Created successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $data['category'] = $category;
        return view('category.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::bySchool(auth()->user()->school_id)->find($id);
        if (empty($category)) {
            return abort('404');
        }
        $data['category'] = $category;
        return view('category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::bySchool(auth()->user()->school_id)->find($id);
        if (empty($category)) {
            return abort('404');
        }
        request()->validate([
            'name' => 'required|string',
            'status' => 'required|numeric',
        ]);
        $category->school_id = auth()->user()->school_id;
        $category->name = $request->name;
        $category->status = $request->status;
        $category->save();
        toast(transMsg('Update successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::bySchool(auth()->user()->school_id)->find($id);
        if (empty($category)) {
            return abort('404');
        }
        $category->delete();
        toast(transMsg('Delete successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.category.index');
    }
}
