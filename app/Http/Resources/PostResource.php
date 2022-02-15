<?php

namespace App\Http\Resources;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => (string) $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'public_post' => $this->public_post,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'author_id' => $this->author_id,
            'categories' => CategoryResource::collection($this->categories),
            'author' => new UserResource($this->user),
        ];
    }
}