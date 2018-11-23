<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\FormCategory;

use View;

class FormCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $form_categories=FormCategory::all();
        return View::make('form_categories.index', ['form_categories'=>$form_categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'form_category_name' => 'required',
        ]);

        $form_category=new FormCategory;
        $form_category->form_category_name=$request->form_category_name;
        $form_category->save();

        return Redirect::to('form_categories');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'form_category_name' => 'required',
        ]);

        $form_category=FormCategory::find($id);
        $form_category->form_category_name=$request->form_category_name;
        $form_category->save();

        return Redirect::to('form_categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $form_category=FormCategory::find($id);
        $form_category->delete();
        return Redirect::back();
    }
}
