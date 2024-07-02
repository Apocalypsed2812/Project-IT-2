<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Exception;

class ApiController extends Controller
{
    public function sendResponse($data = [], $success = true, $message = '', $code = 200, $total_record = 0){
        return response([
            'success' => $success,
            'message' => $message,
            'data' => $data,
            'total_record' => $total_record
        ], $code);
    }
}
