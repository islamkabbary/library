<?php

namespace App\Http\Resources;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "title_book" => $this->title,
            "decs_book" => $this->decs,
            "name_auther" => $this->author_id ? Author::find($this->author_id)->name : null,
        ];
    }
}
