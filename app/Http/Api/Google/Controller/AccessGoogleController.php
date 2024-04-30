<?php

namespace App\Http\Api\Google\Controller;

use App\Http\Api\Google\Request\AccessGoogleRequest;
use App\Http\Controllers\Controller;
use App\Models\Google\AccessGoogle;
use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Response;
use Illuminate\Validation\UnauthorizedException;
use Laravel\Passport\Passport;
use Laravel\Passport\Token;

class AccessGoogleController extends Controller
{

    public function store(AccessGoogleRequest $request){

        $client = new \Google_Client();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setRedirectUri(config('services.google.redirect'));
        $client->setAccessToken(request()->input('access_token'));
        $payload = $client->verifyIdToken($request->input('access_token'));
        if(is_array($payload)){
            $user = User::where('email',$request->input('email'))->first();
            if($user instanceof  User){
//                Token::where('user_id',$user->id)->delete();
                $token = $user->createToken('bearer token')->accessToken;
                return response()->json(['token' => $token]);
            }else{
                $user = User::firstOrCreate([
                    "email" => $request->input('email'),
                    "first_name" => $request->input('name')
                ]);
                Token::where('user_id',$user->id)->delete();
                $token = $user->createToken('bearer token')->accessToken;
                return response()->json(['token' => $token]);
            }

        }
        throw new UnauthorizedException("Account google non autorizzato");

//        if($request->validationData()){
//            $data = $request->validationData();
//
//            $find = AccessGoogle::where('email',$data['email'])->count();
//            if($find > 0){
//                return $this->_response();
//            }else{
//                try{
//                    $client = new Client();
//                    $response = $client->get(config('utils.google.api'), [
//                        "query" => [
//                            "id_token" => $data['access_token']
//                        ]
//                    ]);
//                    if (strcmp($response->getStatusCode(), 200) === 0) {
//                        $body = json_decode($response->getBody()->getContents(), true);
//                        AccessGoogle::create([
//                            "email" => $body['email'],
//                            "name" => $data['name'],
//                            "id_request" => $body['sub']
//                        ]);
//                        return $this->_response();
//
//                    } else
//                        throw  new UnauthorizedException("Account google is not autorizzation");
//                }catch (\Exception|GuzzleException|ClientException $e){
//                    throw  new \Exception($e->getMessage());
//                }
//
//            }
//
//        }

    }

    protected function _response(){
        $response = new Response();
        return $response->setStatusCode(Response::HTTP_CREATED)->send();
    }

}
