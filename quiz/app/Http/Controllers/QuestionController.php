<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Question;
use App\Form;
use App\Answer;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'question_text' => 'required',
        ]);

        $question=new Question;
        $question->question_text=$request->question_text;
        $question->question_correct_text=$request->question_correct_text;
        $question->question_incorrect_text=$request->question_incorrect_text;
        $question->form_id=Form::latest()->first()->form_id;

        if($question->save()){
            $answers=array();

            foreach($request->answers as $key => $value){
                if($key==0){
                    $answer=array(
                        'answer_text' => $value,
                        'answer_correct' => 1,
                        'question_id' => $question->question_id
                    );
                }
                else{
                    $answer=array(
                        'answer_text' => $value,
                        'answer_correct' => 0,
                        'question_id' => $question->question_id
                    );
                }
                
                $answers[]=$answer;
            }
            
            if(Answer::insert($answers)){
                return 1;
            }
            else{
                return 0;
            }

        }
        else{
            return 0;
        }
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
    public function edit($id)
    {
        //
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
            'question_text' => 'required',
        ]);

        $question=Question::find($request->question_id);
        $question->question_text=$request->question_text;
        $question->question_correct_text=$request->question_correct_text;
        $question->question_incorrect_text=$request->question_incorrect_text;
        $question->form_id=$request->form_id;

        if($question->save()){
            // $answers=array();

            // foreach($request->answers as $key => $value){
            //     if($key==0){
            //         $answer=array(
            //             'answer_text' => $value,
            //             'answer_correct' => 1,
            //             'question_id' => $question->question_id
            //         );
            //     }
            //     else{
            //         $answer=array(
            //             'answer_text' => $value,
            //             'answer_correct' => 0,
            //             'question_id' => $question->question_id
            //         );
            //     }
                
            //     $answers[]=$answer;
            // }
            
            // if(Answer::insert($answers)){
            //     return 1;
            // }
            // else{
            //     return 0;
            // }
            return 1;
        }
        else{
            return 0;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}