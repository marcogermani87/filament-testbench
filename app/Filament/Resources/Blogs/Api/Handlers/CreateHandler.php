<?php
namespace App\Filament\Resources\Blogs\Api\Handlers;

use App\Filament\Resources\Blogs\Api\Requests\CreateBlogRequest;
use App\Filament\Resources\Blogs\BlogResource;
use Dedoc\Scramble\Attributes\Group;
use Rupadana\ApiService\Http\Handlers;

#[Group('Blog')]
class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = BlogResource::class;
    protected static string $permission = 'Create:Blog';

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Blog
     *
     * @param CreateBlogRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateBlogRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}
