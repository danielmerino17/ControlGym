<?php

namespace App\Filament\Resources\Asistencias\Pages;

use App\Filament\Resources\Asistencias\AsistenciaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAsistencia extends EditRecord
{
    protected static string $resource = AsistenciaResource::class;

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
        return '¡Asistencia actualizada correctamente!';
    }
}
