<?php

namespace App\Filament\Resources\Membresias;

use App\Filament\Resources\Membresias\Pages;
use App\Models\Membresia;
use App\Models\TipoMembresia;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class MembresiaResource extends Resource
{
    protected static ?string $model = Membresia::class;

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-identification';
    }

    public static function getNavigationLabel(): string
    {
        return 'Contrataciones';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Membresías y Pagos';
    }

    public static function getNavigationSort(): ?int
    {
        return 2;
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
                    ->label('Cliente')
                    ->rules([
                        fn ($get, ?Membresia $record) => function (string $attribute, $value, $fail) use ($get, $record) {
                            $fechaInicio = $get('fecha_inicio');
                            if (!$fechaInicio) return;

                            $traslape = Membresia::where('id_cliente', $value)
                                ->where('estado', 'activa')
                                ->where('fecha_fin', '>=', $fechaInicio)
                                ->when($record, fn ($q) => $q->where('id_membresia', '!=', $record->id_membresia))
                                ->exists();

                            if ($traslape) {
                                $fail('El cliente ya tiene una membresía activa que cubre esta fecha.');
                            }
                        },
                    ]),

                Forms\Components\Select::make('id_tipo')
                    ->relationship('tipoMembresia', 'nombre', fn ($query) => $query->where('activo', true))
                    ->searchable()
                    ->preload()
                    ->required()
                    ->live()
                    ->label('Tipo de Membresía')
                    ->afterStateUpdated(function ($get, $set, ?string $state) {
                        self::calcularFechaFin($get, $set, $state);
                    }),

                Forms\Components\DatePicker::make('fecha_inicio')
                    ->required()
                    ->default(now())
                    ->live()
                    ->label('Fecha de Inicio')
                    ->afterStateUpdated(function ($get, $set) {
                        self::calcularFechaFin($get, $set, $get('id_tipo'));
                    }),

                Forms\Components\DatePicker::make('fecha_fin')
                    ->required()
                    ->readonly()
                    ->label('Fecha de Vencimiento'),

                // Valores exactamente iguales a los de la migración enum
                Forms\Components\Select::make('estado')
                    ->options([
                        'activa' => 'Activa',
                        'pendiente' => 'Pendiente',
                        'cancelada' => 'Cancelada',
                    ])
                    ->default('activa')
                    ->required()
                    ->live()
                    ->label('Estado'),

                Forms\Components\Textarea::make('motivo_cancelacion')
                    ->label('Motivo de Cancelación')
                    ->visible(fn ($get) => $get('estado') === 'cancelada')
                    ->required(fn ($get) => $get('estado') === 'cancelada')
                    ->columnSpanFull(),
            ]);
    }

    protected static function calcularFechaFin($get, $set, ?string $tipoMembresiaId): void
    {
        $fechaInicio = $get('fecha_inicio');

        if ($fechaInicio && $tipoMembresiaId) {
            $tipo = TipoMembresia::find($tipoMembresiaId);
            if ($tipo && $tipo->duracion_dias) {
                $fin = Carbon::parse($fechaInicio)->addDays((int) $tipo->duracion_dias)->format('Y-m-d');
                $set('fecha_fin', $fin);
            }
        }
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
                Tables\Columns\TextColumn::make('tipoMembresia.nombre')
                    ->sortable()
                    ->label('Plan'),
                Tables\Columns\TextColumn::make('fecha_inicio')
                    ->date()
                    ->sortable()
                    ->label('Inicio'),
                Tables\Columns\TextColumn::make('fecha_fin')
                    ->date()
                    ->sortable()
                    ->label('Vencimiento'),
                Tables\Columns\TextColumn::make('estado')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)) // Colocar la primera letra en mayúscula (aunque la BD solo acepte minúsculas).
                    ->color(fn (string $state): string => match ($state) {
                        'activa' => 'success',
                        'pendiente' => 'warning',
                        'cancelada' => 'danger',
                        default => 'gray',
                    })
                    ->label('Estado'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('estado')
                    ->options([
                        'activa' => 'Activa',
                        'pendiente' => 'Pendiente',
                        'cancelada' => 'Cancelada',
                    ])
                    ->label('Filtrar Estado'),
            ])
            ->actions([
                Actions\EditAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMembresias::route('/'),
            'create' => Pages\CreateMembresia::route('/create'),
            'edit' => Pages\EditMembresia::route('/{record}/edit'),
        ];
    }
}