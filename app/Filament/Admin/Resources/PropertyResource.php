<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PropertyResource\Pages;
use App\Models\Property;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PropertyResource extends Resource
{
    protected static ?string $model = Property::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    use UnitEnum; // adicione no topo se não existir

protected static string|UnitEnum|null $navigationGroup  = 'Imóveis';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set) => 
                        $set('slug', \Illuminate\Support\Str::slug($state) . '-' . \Illuminate\Support\Str::random(6))
                    ),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),
                Forms\Components\Textarea::make('description')
                    ->rows(4),
                Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->prefix('R$'),
                Forms\Components\TextInput::make('price_rent')
                    ->numeric()
                    ->prefix('R$'),
                Forms\Components\TextInput::make('street'),
                Forms\Components\TextInput::make('neighborhood'),
                Forms\Components\TextInput::make('city'),
                Forms\Components\TextInput::make('state')
                    ->maxLength(2),
                Forms\Components\TextInput::make('latitude')
                    ->numeric()
                    ->step(0.00000001),
                Forms\Components\TextInput::make('longitude')
                    ->numeric()
                    ->step(0.00000001),
                Forms\Components\TextInput::make('bedrooms')
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('bathrooms')
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('area_sqmt')
                    ->numeric()
                    ->step(0.01),
                Forms\Components\Select::make('status')
                    ->options([
                        'active' => 'Ativo',
                        'inactive' => 'Inativo',
                        'sold' => 'Vendido',
                    ])
                    ->default('active'),
                Forms\Components\Repeater::make('images')
                    ->relationship('images')
                    ->schema([
                        Forms\Components\FileUpload::make('url')
                            ->image()
                            ->directory('properties')
                            ->visibility('public'),
                        Forms\Components\TextInput::make('order')
                            ->numeric()
                            ->default(0),
                        Forms\Components\Toggle::make('is_enhanced'),
                    ])
                    ->orderable('order')
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('main_image')
                    ->label('Imagem')
                    ->circular()
                    ->size(50),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Corretor')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money('BRL')
                    ->sortable(),
                Tables\Columns\TextColumn::make('city'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'success' => 'active',
                        'warning' => 'inactive',
                        'danger' => 'sold',
                    ]),
                Tables\Columns\TextColumn::make('views_count'),
                Tables\Columns\TextColumn::make('lead_count'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d/m/Y H:i'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Corretor'),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'active' => 'Ativo',
                        'inactive' => 'Inativo',
                        'sold' => 'Vendido',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProperties::route('/'),
            'create' => Pages\CreateProperty::route('/create'),
            'edit' => Pages\EditProperty::route('/{record}/edit'),
        ];
    }
}