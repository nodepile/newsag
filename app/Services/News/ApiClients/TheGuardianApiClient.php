<?php

namespace App\Services\News\ApiClients;

use Illuminate\Support\Arr;
use App\Contracts\NewsApiClientInterface;

class TheGuardianApiClient extends BaseApiClient implements NewsApiClientInterface
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
		$data = $this->get('search', [
			'api-key'     => $this->key,
			'section'     => $category,
			'order-by'    => 'newest',
			'show-fields' => 'body',
		]);

		$items = Arr::get($data, 'response.results', []);

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
            'title'        => (string) Arr::get($item, 'webTitle', ''),
            'content'      => (string) strip_tags(Arr::get($item, 'fields.body', '')),
            'published_at' => (string) Arr::get($item, 'webPublicationDate'),
            'source'       => (string) $this->source,
            'author'       => (string) Arr::get($item, 'author', ''),
        ])->toArray();
	}
}