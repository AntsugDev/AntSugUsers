<?php

namespace App\Http\Api\WhoAmI\Controller;

use App\Http\Api\Users\Resource\UserResource;
use App\Http\Api\Utils\FiltersTrait;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\UnauthorizedException;

class WhoAmIController extends Controller
{
    use FiltersTrait;

    /**
     * @param Request $request
     * @return JsonResponse|void
     *
     * @OA\Get(
     *         path="api/v1/who_am_i",
     *         summary="Who Am I",
     *         description="Who Am I",
     *   security={{"bearerAuth":{}}},
     *   @OA\Response(
     *             response=200,
     *             description="Dettagli utente autenticato",
     *
     *         ),
     *
     *
     *     )
     *
     */
    public function who_am_i(Request $request)
    {
        $requestAuthenticatable = $request->user();
        if ($requestAuthenticatable instanceof User) {
            return (new UserResource($this->load($requestAuthenticatable)))->response(request())->setStatusCode(Response::HTTP_OK);
        }
        throw new UnauthorizedException();
    }
}
