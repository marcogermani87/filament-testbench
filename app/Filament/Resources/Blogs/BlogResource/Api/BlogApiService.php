<?php
namespace App\Filament\Resources\Blogs\BlogResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\Blogs\BlogResource;
use Illuminate\Routing\Router;


class BlogApiService extends ApiService
{
    protected static string | null $resource = BlogResource::class;

    public static function handlers() : array
    {
        return [
            Handlers\CreateHandler::class,
            Handlers\UpdateHandler::class,
            Handlers\DeleteHandler::class,
            Handlers\PaginationHandler::class,
            Handlers\DetailHandler::class
        ];

    }
}
