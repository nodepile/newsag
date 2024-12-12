<?php

namespace App\Services\News\ApiClients;

use Illuminate\Support\Arr;
use App\Contracts\NewsApiClientInterface;

class NYTimesApiClient extends BaseApiClient implements NewsApiClientInterface
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
		$data = $this->get('articlesearch.json', [
			'api-key'     => $this->key,
			'q'     => $category,
		]);

		$items = Arr::get($data, 'response.docs', []);

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
		return collect($items)->map(function ($item) {
			$person = Arr::first(Arr::get($item, 'byline.person', []));
			$name = trim(implode(' ', Arr::only($person, ['firstname', 'lastname'])));

			return [
	            'title'        => (string) Arr::get($item, 'headline.main', ''),
	            'content'      => (string) Arr::get($item, 'lead_paragraph', ''),
	            'published_at' => (string) Arr::get($item, 'pub_date'),
	            'source'       => (string) Arr::get($item, 'source', $this->source),
	            'author'       => (string) $name,
		    ];
        })->toArray();
	}
}