<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ApiController;
use App\Repos\SyncRepositoryInterface;
use App\Models\User;
use Illuminate\Http\Request;

class SyncController extends ApiController
{
    protected $modelRepository; 

    public function __construct(SyncRepositoryInterface $modelRepository){
        $this->modelRepository = $modelRepository;
    }

    public function getToken(Request $request){
        try{
            $result = $this->modelRepository->getTokenSF();
            return $this->sendResponse($result);
        }
        catch(\Exception $e){
            return $this->sendResponse([], false, $e->getMessage(), 400);
        }
    }

    public function getDataFromObjectname(Request $request){
        try{
            $request->validate([
                'objectName' => 'required',
                'fields' => 'required'
            ]);

            $objectName = $request->input('objectName');
            $fields = $request->input('fields');

            $result = $this->modelRepository->getDataFromObjectname($objectName, $fields);

            if($result === 'error'){
                return $this->sendResponse($result, false, $objectName . ' Incorrect Sobject', 500);
            }

            return $this->sendResponse($result, true, 'List ' . $objectName, 200);
        }
        catch(\Exception $e){
            return $this->sendResponse([], false, $e->getMessage(), 400);
        }
    }

    
}
