<?php

namespace App\Filament\Resources\Pagos;

use App\Filament\Resources\Pagos\Pages;
use App\Models\Membresia;
use App\Models\Pago;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class PagoResource extends Resource
{
    protected static ?string $model = Pago::class;

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-currency-dollar';
    }

    public static function getNavigationLabel(): string
    {
        return 'Pagos Recibidos';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Membresías y Pagos';
    }

    public static function getNavigationSort(): ?int
    {
        return 4;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\Select::make('id_membresia')
                    ->relationship('membresia', 'id_membresia')
                    ->getOptionLabelFromRecordUsing(fn (Membresia $record) => "Membresía #{$record->id_membresia} - {$record->cliente->nombre} {$record->cliente->primer_apellido} ({$record->estado})")
                    ->searchable()
                    ->preload()
                    ->required()
                    ->unique(ignoreRecord: true) // Evita pagar la misma membresía dos veces (restricción unique de la BD)
                    ->live()
                    ->label('Membresía a Pagar')
                    ->afterStateUpdated(function ($set, $state) {
                        if ($state) {
                            $membresia = Membresia::with('tipoMembresia')->find($state);
                            if ($membresia && $membresia->tipoMembresia) {
                                $set('monto', $membresia->tipoMembresia->costo);
                            }
                        }
                    }),

                Forms\Components\Select::make('id_metodo_pago')
                    ->relationship('metodoPago', 'nombre', fn ($query) => $query->where('activo', true))
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Método de Pago'),

                Forms\Components\TextInput::make('folio_comprobante')
                    ->required()
                    ->maxLength(50)
                    ->unique(ignoreRecord: true) // Evita folios duplicados
                    ->label('Folio / Comprobante'),

                Forms\Components\TextInput::make('monto')
                    ->numeric()
                    ->prefix('$')
                    ->required()
                    ->label('Monto Cobrado'),

                Forms\Components\TextInput::make('descuento')
                    ->numeric()
                    ->prefix('$')
                    ->default(0.00)
                    ->label('Descuento Aplicado'),

                Forms\Components\DateTimePicker::make('fecha_hora')
                    ->required()
                    ->default(now())
                    ->label('Fecha y Hora del Pago'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('folio_comprobante')
                    ->searchable()
                    ->sortable()
                    ->label('Folio'),

                Tables\Columns\TextColumn::make('membresia.cliente.nombre')
                    ->formatStateUsing(fn ($record) => "{$record->membresia?->cliente?->nombre} {$record->membresia?->cliente?->primer_apellido}")
                    ->searchable()
                    ->label('Cliente'),

                Tables\Columns\TextColumn::make('metodoPago.nombre')
                    ->sortable()
                    ->label('Método'),

                Tables\Columns\TextColumn::make('monto')
                    ->money('MXN')
                    ->sortable()
                    ->label('Monto'),

                Tables\Columns\TextColumn::make('fecha_hora')
                    ->dateTime('d/M/Y h:i A')
                    ->sortable()
                    ->label('Fecha'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Actions\ViewAction::make(),
                Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPagos::route('/'),
            'create' => Pages\CreatePago::route('/create'),
            'edit' => Pages\EditPago::route('/{record}/edit'),
        ];
    }
}