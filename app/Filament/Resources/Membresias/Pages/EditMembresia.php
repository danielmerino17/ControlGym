<?php

namespace App\Filament\Resources\Membresias\Pages;

use App\Filament\Resources\Membresias\MembresiaResource;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditMembresia extends EditRecord
{
    protected static string $resource = MembresiaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->modalDescription('¿Estás seguro de que deseas borrar esta membresía?')
                ->modalSubmitActionLabel('Sí, borrar membresía')
                ->successNotificationTitle('¡Membresía eliminada correctamente!')
                ->before(function ($record, DeleteAction $action) {
                    if ($record->estado === 'activa') {
                        Notification::make()
                            ->danger()
                            ->title('No se puede eliminar')
                            ->body('No puedes borrar una membresía que se encuentra activa. Cancélala primero.')
                            ->send();

                        $action->halt(); // Detiene el borrado
                    }
                }),
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