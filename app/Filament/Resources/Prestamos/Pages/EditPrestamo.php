<?php

namespace App\Filament\Resources\Prestamos\Pages;

use App\Filament\Resources\Prestamos\PrestamoResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPrestamo extends EditRecord
{
    protected static string $resource = PrestamoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->modalHeading('Eliminar Préstamo')
                ->modalDescription('¿Estás seguro de que deseas eliminar este préstamo? Si aún no se devuelve, el artículo regresará al inventario.')
                ->modalSubmitActionLabel('Sí, eliminar')
                ->successNotificationTitle('¡Préstamo eliminado correctamente!'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotificationMessage(): ?string
    {
        return '¡Préstamo actualizado correctamente!';
    }
}