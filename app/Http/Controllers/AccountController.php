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
        try{
            $result = $this->modelRepository->all();
            return $this->sendResponse($result, true, 'List Account', 200, 100);
        }
        catch(\Exception $e){
            return $this->sendResponse([], false, $e->getMessage(), 400);
        }
    }

    public function addAccount(Request $request){
        try{
            $data = $request->all();

            if(!isset($data['username'])){
                return $this->sendResponse([], false, 'Username Is Required', 400);
            }

            if(!isset($data['password'])){
                return $this->sendResponse([], false, 'Password Is Required', 400);
            }

            $result = $this->modelRepository->create($data);
            return $this->sendResponse($result, true, 'List Account', 200, 100);
        }
        catch(\Exception $e){
            return $this->sendResponse([], false, $e->getMessage(), 400);
        }
    }

    public function deleteAccount($id){
        try{
            $result = $this->modelRepository->deleteById($id);

            if(!$result){
                return $this->sendResponse([], false, 'Id Not Valid', 400);
            }

            return $this->sendResponse([], true, 'Delete Account Successfully', 200);
        }
        catch(\Exception $e){
            return $this->sendResponse([], false, $e->getMessage(), 400);
        }
    }

    public function updateAccount($id, Request $request){
        try{
            $data = $request->all();

            if(!isset($data['username'])){
                return $this->sendResponse([], false, 'Username Is Required', 400);
            }

            if(!isset($data['password'])){
                return $this->sendResponse([], false, 'Password Is Required', 400);
            }

            $result = $this->modelRepository->update($id, $data);

            if(!$result){
                return $this->sendResponse([], false, 'Id Not Valid', 400);
            }

            return $this->sendResponse([], true, 'Update Account Successfully', 200);
        }
        catch(\Exception $e){
            return $this->sendResponse([], false, $e->getMessage(), 400);
        }
    }

    public function updateAccountPost(Request $request){
        try{
            $data = $request->all();

            if(!isset($data['username'])){
                return $this->sendResponse([], false, 'Username Is Required', 400);
            }

            if(!isset($data['password'])){
                return $this->sendResponse([], false, 'Password Is Required', 400);
            }

            $id = $request->input('id');

            if(!$id){
                return $this->sendResponse([], false, 'Id Not Valid', 400);
            }

            $result = $this->modelRepository->update($id, $data);

            return $this->sendResponse([], true, 'Update Account Successfully', 200);
        }
        catch(\Exception $e){
            return $this->sendResponse([], false, $e->getMessage(), 400);
        }
    }
}
