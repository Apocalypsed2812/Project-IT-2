<?php

namespace App\Http\Controllers;

use OTPHP\TOTP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Repos\AccountRepositoryInterface;

class AuthController extends ApiController
{
    protected $modelRepository;

    public function __construct(AccountRepositoryInterface $modelRepository){
        $this->modelRepository = $modelRepository;
    }

    public function login(Request $request){
        try{
            $request->validate([
                'username' => 'required',
                'password' => 'required'
            ]);

            $username = $request->username;
            $password = $request->password;

            $account = $this->modelRepository->getAccountByUsername($username);

            if(!$account){
                return $this->sendResponse([], false, 'Account Not Found', 400);
            }

            if($account->password !== $password){
                return $this->sendResponse([], false, 'Password Incorrect', 400);
            }

            return $this->sendResponse([], true, 'Please Authen With Google Authenticator', 200);
        }
        catch(\Exception $e){
            return $this->sendResponse([], false, $e->getMessage(), 400);
        }
    } 

    public function showQRCode(Request $request){
        try{
            $request->validate([
                'username' => 'required',
            ]);

            $username = $request->username;

            $user = $this->modelRepository->getAccountByUsername($username);

            if(!$user){
                return $this->sendResponse([], false, 'User Not Found', 400);
            }

            $otp = TOTP::generate();
            $secret = $otp->getSecret();
            
            $otp = TOTP::create($secret);
            $otp->setLabel('IT2');

            $imageDataUri = $otp->getQrCodeUri(
                'https://api.qrserver.com/v1/create-qr-code/?data=[DATA]&size=300x300&ecc=M',
                '[DATA]'
            );

            if($user->qr_code == null && $user->secret == null){
                $user->qr_code = $imageDataUri;
                $user->secret = $secret;

                $user->save();
            }

            $result = [
                "qr_code" => $user->qr_code,
                "secret" => $user->secret,
            ];

            return $this->sendResponse($result);
        }
        catch(\Exception $e){
            return $this->sendResponse([], false, $e->getMessage(), 400);
        }
    }

    public function confirmOTP(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required',
                'otp' => 'required',
            ]);

            $username = $request->username;

            $user = $this->modelRepository->getAccountByUsername($username);

            if(!$user){
                return $this->sendResponse([], false, 'User Not Found', 400);
            }

            $otp = TOTP::create($user->secret);

            if ($otp->verify($request->otp)) {
                return $this->sendResponse($user->toArray(), true, 'Login Successfully', 200);
            } 

            return $this->sendResponse([], false, 'OTP Code Is Incorrect');

        } catch (\Exception $e) {
            return $this->sendResponse([], false, $e->getMessage(), 400);
        }
    }
}
