<?php

namespace App\Filament\Resources\Blogs\Api\Handlers;

use App\Filament\Resources\Blogs\Api\Transformers\BlogTransformer;
use App\Filament\Resources\Blogs\BlogResource;
use App\Filament\Resources\SettingResource;
use Dedoc\Scramble\Attributes\Group;
use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;

#[Group('Blog')]
class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = BlogResource::class;
    protected static string $permission = 'View:Blog';


    /**
     * Show Blog
     *
     * @param Request $request
     * @return BlogTransformer
     */
    public function handler(Request $request)
    {
        $id = $request->route('id');

        $query = static::getEloquentQuery();

        $query = QueryBuilder::for(
            $query->where(static::getKeyName(), $id)
        )
            ->first();

        if (!$query) return static::sendNotFoundResponse();

        return new BlogTransformer($query);
    }
}
