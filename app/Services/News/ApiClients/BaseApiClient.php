<?php

namespace App\Services\News\ApiClients;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

abstract class BaseApiClient
{
	/**
	 * @var string
	 */
	protected string $key;

	/**
	 * @var string
	 */
	protected string $url;

	/**
	 * @var string
	 */
	protected string $source;

	/**
	 * @param array $config
	 */
	public function __construct(array $config)
	{
		$this->key = $config['key'] ?? '';
		$this->url = $config['url'] ?? '';
		$this->source = $config['source'] ?? '';
	}

	/**
	 * Execute an http get request to the given endpint.
	 * 
	 * @param string $endpoint
	 * @param array $query
	 * 
	 * @return array
	 */
	protected function get(string $endpoint, array $query = []): array 
	{
		$response = Http::get($this->url . '/' . $endpoint, $query);

		if (!$response->successful()) {
			// Will keep away from logging or creating a circuit breaker for the purposes of this task.

			return [];
		}

		return $response->json() ?? [];
	}
}