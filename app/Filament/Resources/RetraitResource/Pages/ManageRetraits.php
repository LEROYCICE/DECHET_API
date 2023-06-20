<?php

namespace App\Filament\Resources\RetraitResource\Pages;

use App\Filament\Resources\RetraitResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageRetraits extends ManageRecords
{
    protected static string $resource = RetraitResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
