<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class CategoryController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $programs = ['' => 'Select'] + \App\Program::where('isVendorRequired', '=', 'Y')->pluck('programName', 'idProgram')->toArray();
        $categories = \App\Category::orderBy('categoryName')->get();
        return view('category.index', compact('categories', 'programs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $rules = [
            'idProgram' => 'required',
            'categoryName' => 'required|unique:category|max:100|regex:/^[\pL\s\-]+$/u|between:2,100',
        ];
        $messages = [
            'idProgram.required' => 'Program Must be Selected',
            'categoryName.required' => 'Category Name Must be Filled',
            'categoryName.unique' => 'Category Name Already Taken',
            'cotegoryName.regex' => 'Category Name Is Not Valid'
        ];
        $this->validate($request, $rules, $messages);


        $category = new \App\Category();
        $category->fill($request->all());
        $category->save();
        return redirect('categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $programs = ['' => 'Select'] + \App\Program::pluck('programName', 'idProgram')->toArray();
        $categories = \App\Category::orderBy('categoryName')->get();
        $category = \App\Category::where('idCategory', '=', $id)->first();
        return view('category.index', compact('category', 'categories', 'programs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $category = \App\Category::where('idCategory', '=', $id)->first();
       
        $rules = [
            'idProgram' => 'required',
            'categoryName' => 'required|max:100|regex:/^[\pL\s\-]+$/u', Rule::unique('category')->ignore($category->idCategory, 'idCategory'),
        ];
        $messages = [
            'idProgram.required' => 'Program Must be Selected',
            'categoryName.required' => 'Category Name Must be Filled',
            'categoryName.regex' => 'Category Name Is Not Valid'
        ];
        $this->validate($request, $rules, $messages);

        $category->fill($request->all());
        $category->update();
        return redirect('categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $category = \App\Category::where('idCategory', '=', $id)->first();
        $category->delete();
        return redirect('categories');
    }

}
