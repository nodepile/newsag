<?php

namespace App\Services\News\ApiClients;

use Illuminate\Support\Arr;
use App\Contracts\NewsApiClientInterface;

class NewsAPIApiClient extends BaseApiClient implements NewsApiClientInterface
{
	/**
	 * Fetch articles grouped by the given category.
	 * 
	 * @param string $category
	 * 
	 * @return array
	 */
	public function fetchArticlesByCategory(string $category): array
	{
		$data = $this->get('top-headlines', [
			'category' => $category,
			'apiKey'   => $this->key,
		]);

		$items = Arr::get($data, 'articles', []);

		return $this->formatItems($items);
	}

	/**
	 * Format the given items.
	 * 
	 * @param array $items
	 * 
	 * @return array
	 */
	protected function formatItems(array $items): array 
	{
		return collect($items)->map(fn($item) => [
            'title'        => (string) Arr::get($item, 'title', ''),
            'content'      => (string) Arr::get($item, 'content', ''),
            'published_at' => (string) Arr::get($item, 'publishedAt'),
            'source'       => (string) Arr::get($item, 'source.name', $this->source),
            'author'       => (string) Arr::get($item, 'author', ''),
        ])->toArray();
	}
}