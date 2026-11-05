<?php

namespace App\Filament\Resources\TipoMembresias\Pages;

use App\Filament\Resources\TipoMembresias\TipoMembresiaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTipoMembresia extends EditRecord
{
    protected static string $resource = TipoMembresiaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
