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
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;

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
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->nombre_corto)
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Cliente'),

                Forms\Components\Select::make('articulo')
                    ->options([
                        'Levantamiento de Pesas' => [
                            'Cinturón de halterofilia' => 'Cinturón de halterofilia',
                            'Almohadilla para barra (Squat pad)' => 'Almohadilla para barra (Squat pad)',
                            'Straps / Agarraderas' => 'Straps / Agarraderas',
                            'Cinturón para lastre (Dip belt)' => 'Cinturón para lastre (Dip belt)',
                            'Muñequeras' => 'Muñequeras',
                        ],
                        'Funcional y Movilidad' => [
                            'Bandas de resistencia' => 'Bandas de resistencia',
                            'Tapete / Mat de Yoga' => 'Tapete / Mat de Yoga',
                            'Cuerdas para saltar' => 'Cuerdas para saltar',
                            'Rodillo de espuma (Foam roller)' => 'Rodillo de espuma (Foam roller)',
                            'Pelota de pilates' => 'Pelota de pilates',
                        ],
                        'Amenidades' => [
                            'Candado para casillero' => 'Candado para casillero',
                            'Toalla' => 'Toalla',
                            'Cronómetro' => 'Cronómetro',
                        ],
                    ])
                    ->searchable()
                    ->required()
                    ->label('Artículo Prestado'),

                Forms\Components\Select::make('estado')
                    ->options([
                        'prestado' => 'Prestado (Pendiente)',
                        'devuelto' => 'Devuelto',
                    ])
                    ->required()
                    ->default('prestado')
                    ->label('Estado del Préstamo'),

                Forms\Components\DatePicker::make('fecha_prestamo')
                    ->required()
                    ->default(now())
                    ->displayFormat('d/m/Y')
                    ->label('Fecha de Préstamo'),

                Forms\Components\DatePicker::make('fecha_devolucion')
                    ->displayFormat('d/m/Y')
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
                    ->formatStateUsing(fn ($record) => $record->cliente?->nombre_corto)
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
                    ->date('d/m/Y')
                    ->sortable()
                    ->label('Préstamo'),

                Tables\Columns\TextColumn::make('fecha_devolucion')
                    ->date('d/m/Y')
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
                Actions\DeleteAction::make(),
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