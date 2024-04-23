<?php

namespace App\Http\Api\Utils;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

trait PaginationTrait
{

    private function getParser():array
    {
        $parser = array();

        parse_str(request()->getQueryString(),$parser);
        return $parser;
    }

    private function verify():bool
    {
        $parser = $this->getParser();
        if(
            array_key_exists('size',$parser)  && strcmp($parser['size'],'') !==0 &&
            array_key_exists('page',$parser)  && strcmp($parser['page'],'') !==0

        )
            return true;

        return false;
    }

    private function _chunk(Collection $collection, int $size){
        return $collection->chunk($size);
    }

    private function getChunk(Collection $collection){
        $parser = $this->getParser();
        $chunk = $this->_chunk($collection,$parser['size']);
        return count($chunk) > 0 ? $chunk[$parser['page']] : $chunk;
    }

    /**
     * @throws \Exception
     */
    private function getPagination(Collection $collection){
        if($this->verify()) {
            return $this->getOrderSort($collection);
        }
        throw  new \Exception("Size and page not found");
    }

    private function getOrderSort(Collection $collection){
        $parser = $this->getParser();
        $chunk  = $this->getChunk($collection);

        if(array_key_exists('order',$parser) && strcmp($parser['order'],'desc') !== 0 && array_key_exists('sortBy',$parser) && strcmp($parser['sortBy'],'') !== 0)
            return  $chunk->sortBy(function ($item) use($parser){
                if(isset($item[$parser['sortBy']]))
                    return $item[$parser['sortBy']];
            });

        return $chunk;
    }

    private function pagination(): Collection
    {
        $parser = $this->getParser();
        $pagination = new Collection();
        $pagination->put("size", $parser['size']);
        $pagination->put("page", $parser['page']);
        $pagination->put("order", array_key_exists('order', $parser) ? $parser['order'] : 'desc');
        $pagination->put("sortBy", array_key_exists('sortBy', $parser) ? $parser['sortBy'] : null);
        return $pagination;
    }


    /**
     * @throws \Exception
     */
    public function getResources($resourceCollection, Collection $collection): JsonResponse
    {
        try{
            $collectionResource = new $resourceCollection($this->getPagination($collection));
            $pagination = $this->pagination();
            $result = new Collection();
            $result->put("contents", $collectionResource);
            $result->put("pagination", $pagination);
            return new JsonResponse($result);
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

}
