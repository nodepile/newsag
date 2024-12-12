<?php

namespace App\Contracts;

interface NewsApiClientInterface
{
	/**
	 * Fetch articles for a given category.
	 * 
	 * @param string $slug
	 * 
	 * @return array;
	 */
	public function fetchArticlesByCategory(string $category): array;
}