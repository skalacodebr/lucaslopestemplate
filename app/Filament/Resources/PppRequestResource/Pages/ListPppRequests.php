<?php

namespace App\Filament\Resources\PppRequestResource\Pages;

use App\Filament\Resources\PppRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPppRequests extends ListRecords
{
    protected static string $resource = PppRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
