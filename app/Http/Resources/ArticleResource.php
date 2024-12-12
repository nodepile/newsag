<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource 
{
	/**
	 * ransforming the article resource into an arr.
	 */
	public function toArray($request)
	{
		return [
			'id' => $this->id,
			'title'   => $this->title,
			'content' => $this->content,

			'author' => [
				'id'   => $this->author->id,
				'name' => $this->author->name,
			],

			'category' => [
				'id'   => $this->category->id,
				'name' => $this->category->name,
			],

			'source' => [
				'id'   => $this->source->id,
				'name' => $this->source->name,
			],

			'published_at' => $this->published_at?->toDateTimeString(),
		];
	}
}
