<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ApiController;
use App\Repos\AccountRepositoryInterface;
use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends ApiController
{
    protected $modelRepository; 

    public function __construct(AccountRepositoryInterface $modelRepository){
        $this->modelRepository = $modelRepository;
    }

    public function getListAccount(Request $request){
        // $result = $this->modelRepository->all();
        $result = Account::get()->toArray();
        return $this->sendResponse($result, true, 'List Account', 200, 100);
    }

    public function addAccount(Request $request){
        $data = $request->all();
        $result = $this->modelRepository->create($data);
        return $this->sendResponse($result, true, 'List Account', 200, 100);
    }
}
