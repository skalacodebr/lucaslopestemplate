<?php

namespace App\Filament\Resources\CatRequestResource\Pages;

use App\Filament\Resources\CatRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCatRequest extends EditRecord
{
    protected static string $resource = CatRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
