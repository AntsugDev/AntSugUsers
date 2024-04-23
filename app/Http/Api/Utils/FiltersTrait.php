<?php

namespace App\Http\Api\Utils;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\RelationNotFoundException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

trait FiltersTrait
{
    public function parserQueryString() :array{
        $queryString = request()->getQueryString();
        $filters = array();
        parse_str($queryString,$filters);
        return  array_key_exists('filters',$filters) ? explode(',',$filters['filters']) : [];
    }

    public function load(Model $model): Model
    {
        try {
            $filters = $this->parserQueryString();
            if($this->verifyRelationExists($filters,$model)) {
                return $model->refresh()->load($filters);
            }

        }catch (NotFoundResourceException $e) {
            throw new NotFoundResourceException();
        }
        return $model;
    }

    private function verifyRelationExists(array $relationiship,Model $model):bool
    {
        $model->load($relationiship);
        foreach ($relationiship as $key => $item){
            if(!$model->relationLoaded($item)) {
                throw new RelationNotFoundException();
                return false;
            }
        }
        return true;


    }



}
