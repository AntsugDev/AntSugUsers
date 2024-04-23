<?php

namespace App\Http\Api\Passport\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Laravel\Passport\Passport;

class RootController extends Controller
{

    /**
     * OA\Get(
     *     path="api/v1/root,
     *     summary="Configurazioni",
     *     description="Configurazioni",
     *
     * OA\Response(
     *           response=200,
     * description="Json configurazioni se la ricerca è andata a buon fine",
     *       ),
     *
     * )
     *
     *
     */
    public function index(): JsonResponse
    {

        $passport  = Passport::client()->where('password_client',1)->first();
        $response  = new Collection();
        if(!is_null($passport)){
            $response->put('oauthPasswordClient',[
                "id" => $passport->id,
                "secret" => $passport->secret,
            ]);
        }
        return new JsonResponse($response);
    }

}
