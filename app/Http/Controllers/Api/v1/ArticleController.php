<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Article;
use App\Http\Resources\ArticleResource;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'query'      => [ 'sometimes', 'string', 'min:1' ],
            'date'       => [ 'sometimes', 'date_format:Y-m-d' ],
            'authors'    => [ 'sometimes', 'array' ],
            'categories' => [ 'sometimes', 'array' ],
            'sources'    => [ 'sometimes', 'array' ],
        ]);

        $query = Article::with([
            'author',
            'category',
            'source',
        ]);

        if ($request->filled('query')) {
            $query->where('title', 'like', '%' . $request->input('query') . '%');
        }

        if ($request->filled('date')) {
            $query->whereDate('published_at', $request->input('date'));
        }

        if ($request->filled('authors')) {
            $query->whereIn(
                'author_id', 
                Arr::wrap($request->input('authors'))
            );
        }

        if ($request->filled('categories')) {
            $query->whereIn(
                'category_id', 
                Arr::wrap($request->input('categories'))
            );
        }

        if ($request->filled('sources')) {
            $query->whereIn(
                'source_id',
                Arr::wrap($request->input('sources'))
            );
        }

        return ArticleResource::collection($query->orderByDesc('published_at')->paginate(50))
            ->response()
            ->setEncodingOptions(JSON_PRETTY_PRINT);
    }
}
