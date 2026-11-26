<?php

namespace App\Filament\Resources\TipoMembresias\Pages;

use App\Filament\Resources\TipoMembresias\TipoMembresiaResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTipoMembresia extends CreateRecord
{
    protected static string $resource = TipoMembresiaResource::class;

    protected static bool $canCreateAnother = false;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationMessage(): ?string
    {
        return '¡Tipo de membresía registrado correctamente!';
    }
}