<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\FormCategory;
use App\Form;
use App\Question;
use App\Answer;

use View;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $form_categories=FormCategory::all();
        $forms=Form::all();
        return View::make('forms.index', ['form_categories'=>$form_categories, 'forms'=>$forms]);
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
            'form_title' => 'required',
        ]);

        $form=new Form;
        $form->form_title=$request->form_title;
        $form->form_category_id=$request->form_category_id;
        if($form->save()){
            return 1;
        }
        else{
            return 0;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $form=Form::where('form_id',$id)->get();
        $form_categories=FormCategory::all();
        $form_category_id=Form::where('form_id',$id)->value('form_category_id');
        $questions=Question::where('form_id',$id)->get();
        $answers=Answer::all();
        return View::make('forms.edit',['form'=>$form, 'questions'=>$questions, 'answers'=>$answers, 'form_category_id'=>$form_category_id, 'form_categories'=>$form_categories]);
    }

    public function update(Request $request, $id){
        $validatedData = $request->validate([
            'form_title' => 'required',
        ]);

        $form=Form::find($request->form_id);
        $form->form_title=$request->form_title;
        $form->form_category_id=$request->form_category_id;
        $form->save();

        $questions=$request->questions;
        Question::where('form_id', $form->form_id)->delete();

        foreach ($questions as $key => $value) {
            $question=new Question;
            $question->question_text=$value["question_text"];
            $question->question_correct_text=$value["question_correct_text"];
            $question->question_incorrect_text=$value["question_incorrect_text"];
            $question->form_id=$value["form_id"];
            $question->save();

            
            foreach ($value['answers'] as $key_answer => $value_answer) {
                var_dump("Registrando respuesta ".$value_answer["answer_text"]." de pregunta ".$key);
                $answer=new Answer;
                $answer->answer_text=$value_answer["answer_text"];
                $answer->answer_correct=$value_answer["answer_correct"];
                $answer->question_id=$question->question_id;
                $answer->save();
            }
        }       
        
        return 1;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $form=Form::find($id);
        $form->delete();
        return Redirect::to('forms');
    }
}