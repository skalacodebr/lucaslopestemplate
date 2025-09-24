<?php

namespace App\Filament\Resources\PppRequestResource\Pages;

use App\Filament\Resources\PppRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPppRequest extends EditRecord
{
    protected static string $resource = PppRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
