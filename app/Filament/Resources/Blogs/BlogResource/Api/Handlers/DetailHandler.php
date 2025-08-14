<?php

namespace App\Filament\Resources\Blogs\BlogResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\Blogs\BlogResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\Blogs\BlogResource\Api\Transformers\BlogTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = BlogResource::class;


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
