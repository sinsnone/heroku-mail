<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExampleController extends Controller
{
    public function sendEmail(Request $request)
    {
        $validated = Validator::make($request->toArray(), [
            'email' => ['required', 'email'],
            'subject' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string']
        ]);
        if( $validated->fails() ){
            return response()->json([
                'errors' => [
                    'time' => time(),
                    'code' => 1,
                    'message' => $validated->errors()->first()
                ]
            ], 400);
        }
        return response()->json([
            'data' => [
                'message' => 'Success',
                'time' => time(),
                'request' => [
                    'email' => $request->get('email'),
                    'subject' => $request->get('subject'),
                    'content' => $request->get('content')
                ]
            ]
        ]);
    }
}
