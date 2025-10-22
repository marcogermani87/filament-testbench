<?php
namespace App\Filament\Resources\Blogs\Api;

use App\Filament\Resources\Blogs\BlogResource;
use Rupadana\ApiService\ApiService;


class BlogApiService extends ApiService
{
    protected static string | null $resource = BlogResource::class;

    public static function handlers() : array
    {
        return [
            \App\Filament\Resources\Blogs\Api\Handlers\CreateHandler::class,
            \App\Filament\Resources\Blogs\Api\Handlers\UpdateHandler::class,
            \App\Filament\Resources\Blogs\Api\Handlers\DeleteHandler::class,
            \App\Filament\Resources\Blogs\Api\Handlers\PaginationHandler::class,
            \App\Filament\Resources\Blogs\Api\Handlers\DetailHandler::class
        ];

    }
}
