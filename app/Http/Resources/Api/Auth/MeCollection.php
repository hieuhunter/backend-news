<?php

namespace App\Http\Resources\Api\Auth;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MeCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return MeResource::collection($this->collection);
    }
}
