<?php

use App\Filament\Resources\Blogs\Pages\ListBlogs;

use function Pest\Livewire\livewire;

it('can render blog page', function () {
    livewire(ListBlogs::class)
        ->assertSuccessful();
});

it('can render blog page records', function () {
    $records = \App\Models\Blog::factory(10)->create();
    livewire(ListBlogs::class)
        ->assertSuccessful()
        ->assertCanSeeTableRecords($records);
});
