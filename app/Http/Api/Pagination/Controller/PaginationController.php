<?php

namespace App\Http\Api\Pagination\Controller;

use App\Http\Api\Pagination\Resource\CitiesCollection;
use App\Http\Api\Utils\PaginationTrait;
use App\Http\Controllers\Controller;
use App\Models\Cities;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class PaginationController extends Controller
{

    use PaginationTrait;

    /**
     * @throws \Exception
     */
    public function index(Cities $cities): JsonResponse
    {
       $collection = $cities->all();
       return $this->getResources(CitiesCollection::class,$collection);

    }
}
