<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class ComponentController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $categories = ['' => 'Select Item'] + \App\Category::pluck('categoryName', 'idCategory')->toArray();
        $components = \App\Component::orderBy('componentname')->get();
        return view('component.index', compact('components', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        // dd('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
        // dd($request->all());
        $rules = [
            'idCategory' => 'required',
            'componentName' => 'required|max:15|regex:/^[\pL\s\-]+$/u|unique:component',
            'isActive' => 'required',
        ];
        $messages = [
            'idCategory.required' => 'Category Must be Selected',
            'componentName.required' => 'Component Name Must be Filled',
            'componentName.regex' => 'Component Name is Not Valid',
            'isActive.required' => 'Is Active Field Must be Selected'
        ];
            $this->validate($request, $rules, $messages);
        
        $Component = new \App\Component();
        $Component->fill($request->all());
        $Component->save();
        return redirect('components');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
        //   return view('roles.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $components = \App\Component::orderBy('componentname')->get();
        $categories = ['' => 'Select Item'] + \App\Category::pluck('categoryName', 'idCategory')->toArray();
        $component = \App\Component:: where('idComponent', '=', $id)->first();
        //   dd($role);
        return view('component.index', compact('component', 'components', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
        $component = \App\Component:: where('idComponent', '=', $id)->first();
        $rules = [
            'idCategory' => 'required',
            'componentName' => 'required|max:15|regex:/^[\pL\s\-]+$/u', Rule::unique('component')->ignore($component->idComponent, 'idComponent'),
            'isActive' => 'required',
        ];
        $messages = [
            'idCategory.required' => 'Category Must be Selected',
            'componentName.required' => 'Component Name Must be Filled',
            'componentName.regex' => 'Component Name Is Not Valid',
            'isActive.required' => 'Is Active Field Must be Selected'
        ];
        $request->validate([
            $this->validate($request, $rules, $messages)
        ]);
        
        $component->fill($request->all());
        $component->update();
        return redirect('components');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
        $component = \App\Component:: where('idComponent', '=', $id)->first();
        $component->delete();
        return redirect('components');
    }

}
