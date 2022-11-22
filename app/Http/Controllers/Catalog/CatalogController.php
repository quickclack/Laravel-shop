<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Domain\Catalog\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

class CatalogController extends Controller
{
    public function __invoke(?Category $category): Application|Factory|View
    {
        $categories = Category::query()
            ->select(['id', 'title', 'slug'])
            ->has('products')
            ->get();

        $products = Product::query()
            ->select(['id', 'title', 'slug', 'price', 'thumbnail'])
            ->when(request('search'), function (Builder $query) {
                $query->whereFullText(['title', 'text'], request('search'));
            })
            ->when($category->exists, function (Builder $query) use ($category) {
                $query->whereRelation('categories', 'categories.id', '=', $category->id);
            })
            ->filtered()
            ->sorted()
            ->paginate(6);

        return view('front.catalog.index', [
            'products' => $products,
            'categories' => $categories,
            'category' => $category
        ]);
    }
}
