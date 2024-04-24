<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\RelationNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\UnauthorizedException;
use SebastianBergmann\Invoker\TimeoutException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];



    public function render($request, Throwable $e)
    {
        $accept_json = $request->expectsJson();
        if($e instanceof NotFoundHttpException ){
           return  redirect('/');
        }
        else if($e instanceof  UnauthorizedException || $e instanceof TimeoutException){
            $response = new Response();
            return  $response->setStatusCode(($e instanceof  UnauthorizedException ? Response::HTTP_UNAUTHORIZED : Response::HTTP_REQUEST_TIMEOUT))->send();
        }
        else if($e instanceof  RelationNotFoundException){
            return  new JsonResponse(array("errors" => array(
                "message" => $e->getMessage(),
                "instance" => get_class($e)
            )),Response::HTTP_NOT_FOUND);
        }
        else if($e instanceof  \Exception ){
            return  new JsonResponse(array("errors" => array(
                "message" => $e->getMessage(),
            )),Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        else if ($accept_json) {

            return  new JsonResponse(array("errors" => array(
                "instance" => get_class($e),
                "file" => $e->getFile(),
                "line" => $e->getLine(),
                "message" => $e->getMessage()
            )),Response::HTTP_UNPROCESSABLE_ENTITY);

        }
        return parent::render($request, $e);
    }
}
