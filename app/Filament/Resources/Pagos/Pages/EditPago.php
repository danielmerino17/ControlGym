<?php

namespace App\Filament\Resources\Pagos\Pages;

use App\Filament\Resources\Pagos\PagoResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPago extends EditRecord
{
    protected static string $resource = PagoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->modalHeading('Eliminar Pago')
                ->modalDescription('¿Estás seguro de que deseas eliminar este registro de pago?')
                ->modalSubmitActionLabel('Sí, eliminar')
                ->successNotificationTitle('¡Pago eliminado correctamente!'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotificationMessage(): ?string
    {
        return '¡Pago actualizado correctamente!';
    }
}