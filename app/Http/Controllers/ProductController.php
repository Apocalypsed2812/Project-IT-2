<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ApiController;
use App\Repos\ProductRepositoryInterface;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends ApiController
{
    protected $modelRepository; 

    public function __construct(ProductRepositoryInterface $modelRepository){
        $this->modelRepository = $modelRepository;
    }

    public function getListProduct(Request $request){
        try{
            $result = $this->modelRepository->all();
            return $this->sendResponse($result, true, 'List Product', 200, 100);
        }
        catch(\Exception $e){
            return $this->sendResponse([], false, $e->getMessage(), 400);
        }
    }

    public function getProductById(Request $request){
        try{
            $id = $request->input('id');

            if(!$id){
                return $this->sendResponse([], false, 'Id Is Required', 400);
            }

            $result = $this->modelRepository->findById($id);

            if(!$result){
                return $this->sendResponse([], false, 'Product Not Found', 400);
            }

            return $this->sendResponse($result, true, 'Product', 200, 100);
        }
        catch(\Exception $e){
            return $this->sendResponse([], false, $e->getMessage(), 400);
        }
    }

    public function addProduct(Request $request){
        try{
            $data = $request->all();

            if(!isset($data['name'])){
                return $this->sendResponse([], false, 'Name Is Required', 400);
            }

            if(!isset($data['price'])){
                return $this->sendResponse([], false, 'Price Is Required', 400);
            }

            $result = $this->modelRepository->create($data);
            return $this->sendResponse($result, true, 'List Product', 200, 100);
        }
        catch(\Exception $e){
            return $this->sendResponse([], false, $e->getMessage(), 400);
        }
    }

    public function deleteProduct($id){
        try{
            $result = $this->modelRepository->deleteById($id);

            if(!$result){
                return $this->sendResponse([], false, 'Id Not Valid', 400);
            }

            return $this->sendResponse([], true, 'Delete Product Successfully', 200);
        }
        catch(\Exception $e){
            return $this->sendResponse([], false, $e->getMessage(), 400);
        }
    }

    public function updateProduct($id, Request $request){
        try{
            $data = $request->all();

            if(!isset($data['name'])){
                return $this->sendResponse([], false, 'Name Is Required', 400);
            }

            if(!isset($data['price'])){
                return $this->sendResponse([], false, 'Price Is Required', 400);
            }

            $result = $this->modelRepository->update($id, $data);

            if(!$result){
                return $this->sendResponse([], false, 'Id Not Valid', 400);
            }

            return $this->sendResponse([], true, 'Update Product Successfully', 200);
        }
        catch(\Exception $e){
            return $this->sendResponse([], false, $e->getMessage(), 400);
        }
    }

    public function updateProductPost(Request $request){
        try{
            $data = $request->all();

            if(!isset($data['name'])){
                return $this->sendResponse([], false, 'Name Is Required', 400);
            }

            if(!isset($data['price'])){
                return $this->sendResponse([], false, 'Price Is Required', 400);
            }

            $id = $request->input('id');

            if(!$id){
                return $this->sendResponse([], false, 'Id Not Valid', 400);
            }

            $result = $this->modelRepository->update($id, $data);

            return $this->sendResponse([], true, 'Update Product Successfully', 200);
        }
        catch(\Exception $e){
            return $this->sendResponse([], false, $e->getMessage(), 400);
        }
    }
}
