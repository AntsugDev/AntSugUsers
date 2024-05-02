<?php

namespace App\Http\Api\Google\Controller;

use App\Http\Api\Google\Request\AccessGoogleRequest;
use App\Http\Api\Users\Resource\UserResource;
use App\Http\Controllers\Controller;
use App\Models\Google\AccessGoogle;
use App\Models\Google\GoogleAccess;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
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
                return (new UserResource($user))->response($request)->setStatusCode(Response::HTTP_OK);
            }else{
                $name = strtoupper($request->input('name'));
                $email = $request->input('email');
                $user = User::create(
                    [
                        'first_name' =>  $name,
                        'last_name' => null,
                        'email' => $email,
                        'password' => Hash::make($email),
                        'email_verified_at' => Carbon::now(),
                        "google_account" => true
                    ]

                );
                GoogleAccess::create([
                    "user_id" => $user->id,
                    "payload" => json_encode($payload,true),
                    "tk" => Hash::make($request->input('access_token'))
                ]);
                return (new UserResource($user))->response($request)->setStatusCode(Response::HTTP_CREATED);
            }

        }
        throw new UnauthorizedException("Account google non autorizzato");


    }

    /**
     * @throws GuzzleException
     * @throws \Exception
     */
    protected function regenerateToken($username, $password){
        try{
            $client = new Client([
                "base_uri" => config('utils.path_api_base')
            ]);
            $response = $client->post('/oauth/token',[
                "form_params" => [
                    "grant_type" => "password",
                    "client_id" => "",
                    "client_secret" => "",
                    "username" => $username,
                    "password" => $password
                ]
            ]);
            if(strcmp($response->getStatusCode(),200) !== 0)
                throw  new UnauthorizedException("Passport user not authorizzation");

            $body = json_decode($response->getBody()->getContents(),true);
            return $body['access_token'];
        }catch (\Exception|GuzzleException $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
