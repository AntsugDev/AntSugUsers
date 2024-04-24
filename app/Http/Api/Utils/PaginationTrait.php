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

    private function getChunk(Collection $collection, int &$nrpage = 0){
        $parser = $this->getParser();
        $chunk = $this->_chunk($collection,$parser['size']);
        $nrpage = count($chunk);
        return count($chunk) > 0 ? $chunk[$parser['page']] : $chunk;
    }

    /**
     * @throws \Exception
     */
    private function getPagination(Collection $collection,int &$nrpage = 0, int &$totalElement = 0){
        if($this->verify()) {
            $totalElement = $collection->count() ;
            return $this->getOrderSort($collection,$nrpage);
        }
        throw  new \Exception("Size and page not found");
    }

    private function getOrderSort(Collection $collection,int &$nrpage = 0){
        $parser = $this->getParser();
        $chunk  = $this->getChunk($collection,$nrpage);


        if(array_key_exists('order',$parser) && strcmp($parser['order'],'desc') !== 0 && array_key_exists('sortBy',$parser) && strcmp($parser['sortBy'],'') !== 0)
            return  $chunk->sortBy(function ($item) use($parser){
                if(isset($item[$parser['sortBy']]))
                    return $item[$parser['sortBy']];
            });

        return $chunk;
    }

    private function pagination(int $nrpage,int $totalElement): Collection
    {
        $parser = $this->getParser();
        $pagination = new Collection();
        $pagination->put("size", $parser['size']);
        $pagination->put("page", $parser['page']);
        $pagination->put("order", array_key_exists('order', $parser) ? $parser['order'] : 'desc');
        $pagination->put("sortBy", array_key_exists('sortBy', $parser) ? $parser['sortBy'] : null);
        $pagination->put("totElement",$totalElement );
        $pagination->put("totPage", $nrpage);
        return $pagination;
    }


    /**
     * @throws \Exception
     */
    public function getResources($resourceCollection, Collection $collection): JsonResponse
    {
        try{
            $nrpage = 0;
            $totalElement = 0;
            $orderSort = $this->getPagination($collection,$nrpage,$totalElement);
            $collectionResource = new $resourceCollection($orderSort);
            $pagination = $this->pagination($nrpage,$totalElement);
            $result = new Collection();
            $result->put("contents", $collectionResource);
            $result->put("pagination", $pagination);
            return new JsonResponse($result);
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

}
