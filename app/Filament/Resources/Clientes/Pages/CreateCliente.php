<?php

namespace App\Filament\Resources\Clientes\Pages;

use App\Filament\Resources\Clientes\ClienteResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCliente extends CreateRecord
{
    protected static string $resource = ClienteResource::class;

    // Agrega este método para redirigir a la tabla principal
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    // Notificación de cliente registrado.
    protected function getCreatedNotificationMessage(): ?string
    {
        return '¡Cliente registrado correctamente!';
    }
}