<?php

namespace App;

trait ResponseTrait
{
    //
    
    protected function success($message, $data = [], $status = 200)
    {
        return response([
          //  'success to get data' => true,
            'data' => $data,
            'message' => $message,
        ], $status);
    }

    protected function failure($message, $error,$status = 422)
    {
        return response([
           'success' => false,
            'message' => $message,
            'error' => $error
        ], $status);
    }
}
