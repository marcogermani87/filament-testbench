<?php
namespace App\Filament\Resources\Blogs\Api\Handlers;

use App\Filament\Resources\Blogs\Api\Transformers\BlogTransformer;
use App\Filament\Resources\Blogs\BlogResource;
use Dedoc\Scramble\Attributes\Group;
use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;

#[Group('Blog')]
class PaginationHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = BlogResource::class;
    protected static string $permission = 'ViewAny:Blog';

    /**
     * List of Blog
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function handler()
    {
        $query = static::getEloquentQuery();

        $query = QueryBuilder::for($query)
        ->allowedFields($this->getAllowedFields() ?? [])
        ->allowedSorts($this->getAllowedSorts() ?? [])
        ->allowedFilters($this->getAllowedFilters() ?? [])
        ->allowedIncludes($this->getAllowedIncludes() ?? [])
        ->paginate(request()->query('per_page'))
        ->appends(request()->query());

        return BlogTransformer::collection($query);
    }
}
