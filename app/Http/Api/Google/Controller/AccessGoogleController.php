<?php

namespace App\Http\Api\Google\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Laravel\Socialite\Facades\Socialite;

class AccessGoogleController extends Controller
{


    /**
     * @throws \Exception
     */
    public function store(): \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\RedirectResponse
    {

        try {
            return Socialite::driver("google")->redirect();
            //return response()->json($user);
        }
        catch (\Exception $e)
        {
            dd($e->getMessage());
        }
    }

}
