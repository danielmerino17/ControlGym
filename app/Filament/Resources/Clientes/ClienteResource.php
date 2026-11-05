<?php

namespace App\Filament\Resources\Clientes;

use App\Filament\Resources\Clientes\Pages\CreateCliente;
use App\Filament\Resources\Clientes\Pages\EditCliente;
use App\Filament\Resources\Clientes\Pages\ListClientes;
use App\Filament\Resources\Clientes\Pages\ViewCliente;
use App\Models\Cliente;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea; 
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use BackedEnum;
use UnitEnum;

class ClienteResource extends Resource
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Clientes';
    protected static string|UnitEnum|null $navigationGroup = 'Gestión del Gimnasio';
    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('nombre')
                    ->required()
                    ->maxLength(100)
                    ->label('Nombre(s)'),

                TextInput::make('apellido_paterno')
                    ->required()
                    ->maxLength(100)
                    ->label('Primer apellido'),

                TextInput::make('apellido_materno')
                    ->required()
                    ->maxLength(100)
                    ->label('Segundo Apellido'),

                TextInput::make('telefono')
                    ->tel()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(20)
                    ->label('Teléfono'),
                
                TextInput::make('correo')
                    ->email()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255)
                    ->label('Correo Electrónico'),
                
                TextInput::make('documento_identidad')
                    ->unique(ignoreRecord: true)
                    ->maxLength(50)
                    ->label('Documento de Identidad'),
                
                DatePicker::make('fecha_registro')
                    ->required()
                    ->default(now())
                    ->label('Fecha de Registro'),
                
                Toggle::make('activo')
                    ->default(true)
                    ->label('Cliente Activo'),
                
                Textarea::make('contacto_emergencia')
                    ->maxLength(255)
                    ->label('Contacto de Emergencia')
                    ->columnSpanFull(),
                
                Textarea::make('observaciones')
                    ->maxLength(500)
                    ->label('Observaciones')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre')
                    ->searchable()
                    ->sortable()
                    ->label('Nombre(s)'),

                TextColumn::make('apellido_paterno')
                    ->searchable()
                    ->sortable()
                    ->label('1er Apellido'),

                TextColumn::make('apellido_materno')
                    ->searchable()
                    ->sortable()
                    ->label('2do Apellido'),    
                    
                TextColumn::make('telefono')
                    ->searchable()
                    ->label('Teléfono'),
                TextColumn::make('correo')
                    ->searchable(),
                IconColumn::make('activo')
                    ->boolean()
                    ->label('Activo'),
                TextColumn::make('fecha_registro')
                    ->date()
                    ->sortable()
                    ->label('Registro'),
            ])
            ->filters([
                TernaryFilter::make('activo')
                    ->label('Estado del Cliente')
                    ->trueLabel('Solo Activos')
                    ->falseLabel('Solo Inactivos')
                    ->default(true), 
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListClientes::route('/'),
            'create' => CreateCliente::route('/create'),
            'view' => ViewCliente::route('/{record}'),
            'edit' => EditCliente::route('/{record}/edit'),
        ];
    }
}