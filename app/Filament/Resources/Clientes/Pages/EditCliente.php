<?php

namespace App\Filament\Resources\Clientes\Pages;

use App\Filament\Resources\Clientes\ClienteResource;
use Filament\Resources\Pages\EditRecord;

class EditCliente extends EditRecord
{
    protected static string $resource = ClienteResource::class;

    // Redireccionar a la página de índice después de guardar los cambios
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    // Personalizar el mensaje de notificación después de guardar los cambios
    protected function getSavedNotificationMessage(): ?string
    {
        return '¡Cliente actualizado correctamente!';
    }
}