<?php

namespace App\Filament\Resources\MetodoPagos\Pages;

use App\Filament\Resources\MetodoPagos\MetodoPagoResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMetodoPago extends EditRecord
{
    protected static string $resource = MetodoPagoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->modalHeading('Eliminar Método de Pago')
                ->modalDescription('¿Estás seguro de que deseas eliminar este método de pago?')
                ->modalSubmitActionLabel('Sí, eliminar')
                ->successNotificationTitle('¡Método de pago eliminado correctamente!'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotificationMessage(): ?string
    {
        return '¡Método de pago actualizado correctamente!';
    }
}