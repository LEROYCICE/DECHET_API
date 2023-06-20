<?php

namespace App\Filament\Resources\LivraisonResource\Pages;

use App\Filament\Resources\LivraisonResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageLivraisons extends ManageRecords
{
    protected static string $resource = LivraisonResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
