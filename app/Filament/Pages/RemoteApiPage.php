<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Infolists\Components\CodeEntry;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\HtmlString;
use Phiki\Grammar\Grammar;
use Phiki\Theme\Theme;

class RemoteApiPage extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string|null|\BackedEnum $navigationIcon = 'heroicon-o-document-text';

    protected string $view = 'filament.pages.remote-api-page';

    public function table(Table $table): Table
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>
                <note>
                  <to>Tove</to>
                  <from>Jani</from>
                  <heading>Reminder</heading>
                  <body>
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                      labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                      nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit
                      esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt
                      in culpa qui officia deserunt mollit anim id est laborum.
                  </body>
                </note>';

        return $table
            ->records(function (int $page, int $recordsPerPage, ?string $search): LengthAwarePaginator {
                $skip = ($page - 1) * $recordsPerPage;

                $response = Http::baseUrl('https://dummyjson.com')
                    ->get('products/search', [
                        'limit' => $recordsPerPage,
                        'skip' => $skip,
                        'q' => $search,
                    ])
                    ->collect();

                return new LengthAwarePaginator(
                    items: $response['products'],
                    total: $response['total'],
                    perPage: $recordsPerPage,
                    currentPage: $page
                );
            })
            ->columns([
                TextColumn::make('title'),
                TextColumn::make('category'),
                TextColumn::make('price')
                    ->money(),
            ])
            ->recordActions([
//                Action::make('view-xml')
//                    ->label('View XML')
//                    ->schema([
//                        CodeEntry::make('xml')
//                            ->hiddenLabel()
//                            ->formatStateUsing(function () use ($xml) {
//                                return new HtmlString($xml);
//                            })
//                            ->grammar(Grammar::Xml)
//                            ->copyable()
//                            ->lightTheme(Theme::Dracula)
//                            ->darkTheme(Theme::Dracula)
//                    ])
//                    ->modalSubmitAction(false)
//                    ->modalCancelAction(false),
            ])
            ->persistSearchInSession()
            ->searchable()
            ;
    }
}
