<?php

namespace App\Filament\Resources\MetodoPagos;

use App\Filament\Resources\MetodoPagos\Pages;
use App\Models\MetodoPago;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class MetodoPagoResource extends Resource
{
    protected static ?string $model = MetodoPago::class;

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-credit-card';
    }

    public static function getNavigationLabel(): string
    {
        return 'Métodos de Pago';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Membresías y Pagos';
    }

    public static function getNavigationSort(): ?int
    {
        return 3;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(30)
                    ->unique(ignoreRecord: true)
                    ->label('Método de Pago'),

                Forms\Components\Toggle::make('activo')
                    ->default(true)
                    ->label('Activo'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable()
                    ->sortable()
                    ->label('Método'),
                
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
            'index' => Pages\ListMetodoPagos::route('/'),
            'create' => Pages\CreateMetodoPago::route('/create'),
            'edit' => Pages\EditMetodoPago::route('/{record}/edit'),
        ];
    }
}