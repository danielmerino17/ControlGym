<?php

namespace App\Filament\Resources\Membresias\Pages;

use App\Filament\Resources\Membresias\MembresiaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMembresia extends EditRecord
{
    protected static string $resource = MembresiaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

        // Redireccionar a la página de índice después de guardar los cambios
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    // Personalizar el mensaje de notificación después de guardar los cambios
    protected function getSavedNotificationMessage(): ?string
    {
        return '¡Membresía actualizada correctamente!';
    }
}
