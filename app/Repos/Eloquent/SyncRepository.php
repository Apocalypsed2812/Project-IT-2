<?php

namespace App\Repos\Eloquent;

use Carbon\Carbon;
use App\Repos\SyncRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class SyncRepository extends BaseRepository implements SyncRepositoryInterface
{

    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct()
    {
        
    }

    public function getTokenSF(){
        try{
            $response = Http::asForm()->post(env('SF_LOGIN_URL') . '/services/oauth2/token', [
                'grant_type' => 'password',
                'client_id' => env('SF_CONSUMER_KEY'),
                'client_secret' => env('SF_CONSUMER_SECRET'),
                'username' => env('SF_USERNAME'),
                'password' => env('SF_PASSWORD')
            ]);
    
            $response_data = $response->json();
    
            if ($response->successful()) {
                return $response_data;
            } else {
                return response()->json(['error' => 'Unable to fetch token'], 500);
            }
        }
        catch(\Exception $e){
            dd($e->getMessage());
            return '';
        }
    }

    public function getDataFromObjectname(string $objectName, string $fields){
        try{
            $token = $this->getTokenSF()['access_token'];
            
            $query = "SELECT " . $fields . " FROM " . $objectName;

            $endPoint = env('SF_LOGIN_URL') . "/services/data/v56.0/query/?q=" . urlencode($query);

            $response = Http::withToken($token)
                            ->get($endPoint);

            $response_data = $response->json();

            if ($response->successful()) {
                $objectName = strtolower($objectName);
                if($response_data['records']){
                    foreach ($response_data['records'] as $record) {
                        $insertData = [];
            
                        foreach ($record as $field => $value) {
                            if ($field === 'attributes') continue;
            
                            $insertData[$field] = $value;
                        }
            
                        $insertData['created_at'] = now();
                        $insertData['updated_at'] = now();

                        if (\DB::table($objectName)->where('Id', $record['Id'])->exists()) {
                            continue;
                        }
            
                        \DB::table($objectName)->insert($insertData);
                    }
                }
                return $response_data;
            } else {
                return 'error';
            }
        }
        catch(Exception $e){
            dd($e->getMessage());
            return [];
        }
    }
}
