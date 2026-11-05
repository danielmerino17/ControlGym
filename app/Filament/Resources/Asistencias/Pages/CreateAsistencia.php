<?php

namespace App\Filament\Resources\Asistencias\Pages;

use App\Filament\Resources\Asistencias\AsistenciaResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAsistencia extends CreateRecord
{
    protected static string $resource = AsistenciaResource::class;

    // Quitar botón de "crear y crear otro".
    public function canCreateAnother(): bool
    {
        return false;
    }

    // Redirección al inicio una vez guardado.
    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    // Mensaje al confirmar asistencia.
    protected function getCreatedNotificationMessage(): ?string
    {
        return '¡Acceso registrado correctamente!';
    }
}
