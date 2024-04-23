<?php

namespace App\Http\Api\WhoAmI\Controller;

use App\Http\Api\Members\Resources\MemberResource;
use App\Http\Api\Operators\Resources\OperatorResource;
use App\Http\Api\Users\Resources\UserResource;
use App\Http\Controllers\Controller;
use App\Models\Members\Member;
use App\Models\Operators\Operator;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\UnauthorizedException;

class WhoAmIController extends Controller
{

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
            return (new UserResource($requestAuthenticatable))->response(request())->setStatusCode(Response::HTTP_OK);
        }
        throw new UnauthorizedException();
    }
}
