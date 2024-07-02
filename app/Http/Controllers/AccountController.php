<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class AccountController extends ApiController
{
    public function getAccount(Request $request){
        return $this->sendResponse([], true, 'List Account', 200, 100);
    }
}
