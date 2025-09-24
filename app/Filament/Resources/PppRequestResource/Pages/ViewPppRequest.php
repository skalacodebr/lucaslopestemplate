<?php

namespace App\Filament\Resources\PppRequestResource\Pages;

use App\Filament\Resources\PppRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPppRequest extends ViewRecord
{
    protected static string $resource = PppRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}