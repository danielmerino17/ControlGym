<?php

namespace App\Filament\Resources\TipoMembresias;

use App\Filament\Resources\TipoMembresias\Pages;
use App\Models\TipoMembresia;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions;

class TipoMembresiaResource extends Resource
{
    protected static ?string $model = TipoMembresia::class;

    protected static ?string $recordTitleAttribute = 'nombre';

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-tag';
    }

    public static function getNavigationLabel(): string
    {
        return 'Tipos de Membresía';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Membresías y Pagos';
    }

    public static function getNavigationSort(): ?int
    {
        return 1;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(100)
                    ->label('Nombre del Plan')
                    ->placeholder('Ej. Mensual, Trimestral, Anual'),

                Forms\Components\TextInput::make('duracion_dias')
                    ->numeric()
                    ->required()
                    ->minValue(1)
                    ->label('Duración en días')
                    ->helperText('Días naturales que dura este plan (ej. 30 para mensual)'),

                Forms\Components\TextInput::make('costo')
                    ->numeric()
                    ->prefix('$')
                    ->required()
                    ->minValue(0)
                    ->label('Costo'),

                Forms\Components\Toggle::make('activo')
                    ->default(true)
                    ->label('Disponible para contratación'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable()
                    ->sortable()
                    ->label('Plan'),
                Tables\Columns\TextColumn::make('duracion_dias')
                    ->sortable()
                    ->label('Duración (días)'),
                Tables\Columns\TextColumn::make('costo')
                    ->money('MXN')
                    ->sortable()
                    ->label('Costo'),
                Tables\Columns\IconColumn::make('activo')
                    ->boolean()
                    ->label('Activo'),
            ])
            ->actions([
                Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTipoMembresias::route('/'),
            'create' => Pages\CreateTipoMembresia::route('/create'),
            'edit' => Pages\EditTipoMembresia::route('/{record}/edit'),
        ];
    }
}