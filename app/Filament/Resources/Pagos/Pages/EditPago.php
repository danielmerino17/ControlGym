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
        return 'Pago actualizado correctamente!';
    }
}
