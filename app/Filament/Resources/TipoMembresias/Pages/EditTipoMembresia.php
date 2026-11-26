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
            DeleteAction::make()
                ->modalHeading('Eliminar Tipo de Membresía')
                ->modalDescription('¿Estás seguro de que deseas eliminar este plan?')
                ->modalSubmitActionLabel('Sí, eliminar')
                ->successNotificationTitle('¡Tipo de membresía eliminado correctamente!'),
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
        return '¡Tipo de membresía actualizado correctamente!';
    }

}
