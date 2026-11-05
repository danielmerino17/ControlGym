<?php

namespace App\Filament\Resources\TipoMembresias\Pages;

use App\Filament\Resources\TipoMembresias\TipoMembresiaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTipoMembresias extends ListRecords
{
    protected static string $resource = TipoMembresiaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
