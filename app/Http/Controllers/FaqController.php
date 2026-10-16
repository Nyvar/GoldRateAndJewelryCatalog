<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaqController extends Controller
{
    //create auto question and answer
    private $autoAnswer=[
        'Where is your store?'=>'Nyvar jewelry is located in Stung Treng Market, 19 C.',
        'What is the store phone Number'=>'0999999',
        'Do you offer delivery?'=>'Sorry, We do not have online shop. But we are happy to book your appointment',
    ];
    public function ask(Request $request){
        $question=trim($request->input('$question'));
        //check if question is match the auto question
        foreach($this->autoAnswer as $key=>$answer){
            if (stripos($question, $answer)!==false){
                return response()->json([
                    'question'=>$question,
                    'key'=>$answer,
                    'source'=>'auto',
                ]);
            }
        }
        // If not matched, reject
    return response()->json([
        'question' => $question,
        'answer'   => 'This question is not available in our FAQ. Please ask one of the supported questions.',
        'source'   => 'restricted',
    ], 400);

    //      // If not matched, check database (admin answers)
    //     $faq = faq::where('question', 'like', '%' . $question . '%')
    //           ->where('is_active', true)
    //           ->first();
              
    //         if ($faq) {
    //             return response()->json([
    //                 'question' => $question,
    //                 'answer'   => $faq->answer,
    //                 'source'   => 'admin',
    //             ]);
    //     }
    //     // If not matched, save request for admin
    //     $pending = \App\Models\FaqRequest::create([
    //         'question' => $question,
    //     ]);
    //     return response()->json([
    //         'question' => $question,
    //         'answer'   => 'Your question has been submitted. Please wait for admin to answer.',
    //         'source'   => 'pending',
    //     ], 202);
    //
    
}}
