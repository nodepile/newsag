<?php

namespace App\Services\News;

use Illuminate\Support\Arr;
use Carbon\Carbon;
use App\Models\Category;
use App\Models\Source;
use App\Models\Author;

class NewsService
{	
	/**
	 * @var NewsApiClientInterface[]
	 */
	protected array $clients;

	/**
	 * @param NewsApiClientInterface[]
	 */
	public function __construct(array $clients = [])
	{
		$this->clients = $clients;
	}

	/**
	 * Fetch all articles from all the given clients.
	 * 
	 * @return void
	 */
	public function fetchAll(): void 
	{
		$categories = Category::all();

		foreach($this->clients as $client) {
			foreach($categories as $category) {
				$articles = $client->fetchArticlesByCategory($category->slug);

				foreach($articles as $article) {
					$this->saveArticle($category, $article);
				}
			}
		}
	}

	/**
	 * Save or update an article.
	 * 
	 * @param array $article
	 * 
	 * @return void
	 */
	private function saveArticle(Category $category, array $article): void 
	{
		$source = $this->ensureSource(Arr::get($article, 'source'));
		$author = $this->ensureAuthor(Arr::get($article, 'author'));

		$category->articles()->updateOrCreate(
			[
				'title' => Arr::get($article, 'title'),
			], [
				'content' => Arr::get($article, 'content'),
				'published_at' => Carbon::parse(Arr::get($article, 'published_at')),
				'source_id' => $source->id,
				'author_id' => $author->id,
			]
		);
	}

	/**
	 * Get an existing source or create it if it doesn't exist.
	 * 
	 * @param string $name
	 * 
	 * @return Source
	 */
	private function ensureSource(string $name): Source 
	{
		return Source::firstOrCreate([
			'name' => $name
		]);
	}

	/**
	 * Get an existing author or create one if one doesn't exist.
	 * 
	 * @param string $name
	 * 
	 * @return Author
	 */
	private function ensureAuthor(string $name): Author 
	{
		return Author::firstOrCreate([
			'name' => $name,
		]);
	}
}