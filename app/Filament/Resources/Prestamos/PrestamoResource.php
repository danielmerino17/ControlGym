<?php

namespace App\Filament\Resources\Prestamos;

use App\Filament\Resources\Prestamos\Pages;
use App\Models\Prestamo;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class PrestamoResource extends Resource
{
    protected static ?string $model = Prestamo::class;

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-key';
    }

    public static function getNavigationLabel(): string
    {
        return 'Préstamos de Equipo';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Gestión del Gimnasio';
    }

    public static function getNavigationSort(): ?int
    {
        return 3;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\Select::make('id_cliente')
                    ->relationship('cliente', 'nombre')
                    ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->nombre} {$record->primer_apellido}")
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Cliente'),

                Forms\Components\TextInput::make('articulo')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Ej. Toalla, Candado, Cinturón')
                    ->label('Artículo Prestado'),

                Forms\Components\Select::make('estado')
                    ->options([
                        'prestado' => 'Prestado (Pendiente)',
                        'devuelto' => 'Devuelto',
                    ])
                    ->required()
                    ->default('prestado')
                    ->label('Estado del Préstamo'),

                Forms\Components\DateTimePicker::make('fecha_prestamo')
                    ->required()
                    ->default(now())
                    ->label('Fecha de Préstamo'),

                Forms\Components\DateTimePicker::make('fecha_devolucion')
                    ->label('Fecha de Devolución')
                    ->helperText('Llenar cuando el cliente devuelva el artículo.'),

                Forms\Components\Textarea::make('observaciones')
                    ->maxLength(65535)
                    ->columnSpanFull()
                    ->label('Observaciones (Opcional)'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('cliente.nombre')
                    ->formatStateUsing(fn ($record) => "{$record->cliente?->nombre} {$record->cliente?->primer_apellido}")
                    ->searchable()
                    ->sortable()
                    ->label('Cliente'),

                Tables\Columns\TextColumn::make('articulo')
                    ->searchable()
                    ->label('Artículo'),

                Tables\Columns\TextColumn::make('estado')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'prestado' => 'warning',
                        'devuelto' => 'success',
                        default => 'gray',
                    })
                    ->label('Estado'),

                Tables\Columns\TextColumn::make('fecha_prestamo')
                    ->dateTime('d/M/Y h:i A')
                    ->sortable()
                    ->label('Préstamo'),

                Tables\Columns\TextColumn::make('fecha_devolucion')
                    ->dateTime('d/M/Y h:i A')
                    ->sortable()
                    ->label('Devolución'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('estado')
                    ->options([
                        'prestado' => 'Prestado (Pendiente)',
                        'devuelto' => 'Devuelto',
                    ])
                    ->label('Filtrar por Estado'),
            ])
            ->actions([
                Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPrestamos::route('/'),
            'create' => Pages\CreatePrestamo::route('/create'),
            'edit' => Pages\EditPrestamo::route('/{record}/edit'),
        ];
    }
}