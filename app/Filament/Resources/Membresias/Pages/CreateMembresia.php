<?php

namespace App\Filament\Resources\Membresias\Pages;

use App\Filament\Resources\Membresias\MembresiaResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMembresia extends CreateRecord
{
    protected static string $resource = MembresiaResource::class;

    protected static bool $canCreateAnother = false;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    // Título de la notificación sin importar clases externas
    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Membresía registrada exitosamente';
    }
}