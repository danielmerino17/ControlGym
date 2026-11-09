<?php

namespace App\Filament\Resources\Asistencias;

use App\Filament\Resources\Asistencias\Pages;
use App\Models\Asistencia;
use App\Models\Membresia;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class AsistenciaResource extends Resource
{
    protected static ?string $model = Asistencia::class;

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-qr-code';
    }

    public static function getNavigationLabel(): string
    {
        return 'Control de Accesos';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Gestión del Gimnasio';
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
                    ->live() // Monitorea los cambios en tiempo real para actualizar la visibilidad del campo de motivo de denegación.
                    ->label('Cliente / Recepción')
                    ->afterStateUpdated(function ($state, callable $set) {
                        if (!$state) return;

                        // Se busca si el cliente tiene una membresía activa y vigente.
                        $tieneMembresiaActiva = Membresia::where('id_cliente', $state)
                            ->where('estado', 'activa')
                            ->where('fecha_fin', '>=', now())
                            ->exists();

                        if($tieneMembresiaActiva) {
                            $set('resultado', 'permitido');
                            $set('motivo_denegacion', null);
                        } else {
                            $set('resultado', 'denegado');
                            $set('motivo_denegacion', 'El cliente no tiene una membresía activa o vigente.');
                        }
                    }),

                Forms\Components\Select::make('resultado')
                    ->options([
                        'permitido' => 'Permitido',
                        'denegado' => 'Denegado',
                    ])
                    ->required()
                    ->live()
                    ->default('permitido')
                    ->label('Resultado de Acceso'),

                Forms\Components\TextInput::make('motivo_denegacion')
                    ->label('Motivo de Denegación')
                    ->visible(fn ($get) => $get('resultado') === 'denegado')
                    ->columnSpanFull(),

                Forms\Components\DateTimePicker::make('fecha_hora')
                    ->required()
                    ->default(now())
                    ->label('Fecha y Hora de Acceso'),
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

                Tables\Columns\TextColumn::make('resultado')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'permitido' => 'success',
                        'denegado' => 'danger',
                        default => 'gray',
                    })
                    ->label('Acceso'),

                Tables\Columns\TextColumn::make('motivo_denegacion')
                    ->label('Motivo (Si fue denegado)')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('fecha_hora')
                    ->dateTime('d/M/Y h:i A')
                    ->sortable()
                    ->label('Fecha y Hora'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('resultado')
                    ->options([
                        'permitido' => 'Permitido',
                        'denegado' => 'Denegado',
                    ])
                    ->label('Filtrar por Resultado'),
            ])
            ->actions([
                Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAsistencias::route('/'),
            'create' => Pages\CreateAsistencia::route('/create'),
            'edit' => Pages\EditAsistencia::route('/{record}/edit'),
        ];
    }
}