<?php

namespace App\Http\Api\Google\Controller;

use App\Http\Api\Google\Request\AccessGoogleRequest;
use App\Http\Controllers\Controller;
use App\Models\Google\AccessGoogle;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Response;
use Illuminate\Validation\UnauthorizedException;

class AccessGoogleController extends Controller
{

    public function store(AccessGoogleRequest $request){
        if($request->validationData()){
            $data = $request->validationData();

            $find = AccessGoogle::where('email',$data['email'])->count();
            if($find > 0){
                return $this->_response();
            }else{
                try{
                    $client = new Client();
                    $response = $client->get(config('utils.google.api'), [
                        "query" => [
                            "id_token" => $data['access_token']
                        ]
                    ]);
                    if (strcmp($response->getStatusCode(), 200) === 0) {
                        $body = json_decode($response->getBody()->getContents(), true);
                        AccessGoogle::create([
                            "email" => $body['email'],
                            "name" => $data['name'],
                            "id_request" => $body['sub']
                        ]);
                        return $this->_response();

                    } else
                        throw  new UnauthorizedException("Account google is not autorizzation");
                }catch (\Exception|GuzzleException|ClientException $e){
                    throw  new \Exception($e->getMessage());
                }

            }

        }

    }

    protected function _response(){
        $response = new Response();
        return $response->setStatusCode(Response::HTTP_CREATED)->send();
    }

}
