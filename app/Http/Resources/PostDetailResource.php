<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'image' => $this->image,
            'news_content' => $this->news_content,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'author' => $this->author,
            // 'writer' => $this->writer, with relationship writer in model user
            'writer' => $this->whenLoaded('writer'), //eager loading (cek di controller menggunakan relationship atau tidak)
            'comments' => $this->whenLoaded('comments', function() {
                return collect($this->comments)->each(function ($comment) {
                    $comment->commentator;
                    return $comment;
                });
            }),
            'comment_total' => $this->whenLoaded('comments', function() {
                return $this->comments->count();
            })
        ];
    }
}
