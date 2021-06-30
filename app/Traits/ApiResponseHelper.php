<?php
/**
 * File name: UserAPIController.php
 * Last modified: 2020.06.11 at 12:09:19
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 */
namespace App\Traits;


trait ApiResponseHelper {
    public function successResponse($data, $message = null, $code = 200, $attr = array())
    {
        $array = [
            'status'=> true,
            'message' => $message,
            'data' => $data
        ];
        if(count($attr)){
            $array = [
                'status'=> true,
                'message' => $message,
            ];
            $array =  array_merge($array, $attr);
        }
        return response()->json(
            $array
        , $code);
    }
    public function errResponse($data, $message = null, $code = 200, $attr = array())
    {
        $array = [
            'status'=> false,
            'message' => $message,
            'data' => $data
        ];
        if(count($attr)){
            $array = [
                'status'=> true,
                'message' => $message,
            ];
            $array =  array_merge($array, $attr);
        }
        return response()->json(
            $array
        , $code);
    }
    public function errorResponse($message = null, $code=401)
    {
        return response()->json([
            'status'=> false,
            'message' => $message,
            'data' => null
        ], $code);
    }
    public function validationErrorResponse($messages = null, $code)
    {
        $message = collect($messages)->values()->first();
        $key = collect($messages)->keys()->first();
        return response()->json([
            'status'=> false,
            'message' => $message[0],
            'column_name' => $key,
            'data' => (object) array()
        ], $code);
    }

    public function success() {
        return 200;
    }
    public function failed() {
        return 401;
    }
    public function invalid() {
        return 400;
    }
    public function validation() {
        return 422;
        // return 202;
    }
}