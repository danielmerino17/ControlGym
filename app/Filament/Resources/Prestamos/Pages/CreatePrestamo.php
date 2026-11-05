<?php

namespace App\Filament\Resources\Prestamos\Pages;

use App\Filament\Resources\Prestamos\PrestamoResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePrestamo extends CreateRecord
{
    protected static string $resource = PrestamoResource::class;

    // Quitar botón de crear y crear otro.
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
        return '¡Préstamo registrado correctamente!';
    }


}
