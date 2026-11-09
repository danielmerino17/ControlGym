<?php

namespace App\Filament\Resources\Asistencias\Pages;

use App\Filament\Resources\Asistencias\AsistenciaResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Validation\ValidationException;

class CreateAsistencia extends CreateRecord
{
    protected static string $resource = AsistenciaResource::class;

    public function canCreateAnother(): bool
    {
        return false;
    }

    // Redirigir al menú principal una vez creado el registro.
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    // Mensaje de aviso al registrar.
    protected function getCreatedNotificationMessage(): ?string
    {
        return '¡Acceso registrado correctamente!';
    }

    // Validación estricta: bloquea el guardado si el resultado es denegado
    protected function beforeCreate(): void
    {
        if ($this->form->getState()['resultado'] === 'denegado') {
            throw ValidationException::withMessages([
                'data.id_cliente' => 'No se puede registrar la asistencia porque el cliente tiene el acceso denegado.',
            ]);
        }
    }
}