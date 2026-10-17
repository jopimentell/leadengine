<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\LeadResource\Pages;
use App\Models\Lead;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LeadResource extends Resource
{
    protected static ?string $model = Lead::class;
    protected static ?string $navigationIcon = 'heroicon-o-inbox';
    use UnitEnum; // adicione no topo se não existir

protected static string|UnitEnum|null $navigationGroup  = 'Leads';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('property_id')
                    ->relationship('property', 'title')
                    ->required(),
                Forms\Components\Select::make('corretor_id')
                    ->relationship('corretor', 'name')
                    ->required(),
                Forms\Components\TextInput::make('lead_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('lead_phone')
                    ->required()
                    ->maxLength(20),
                Forms\Components\TextInput::make('lead_email')
                    ->email()
                    ->maxLength(255),
                Forms\Components\Toggle::make('has_property_to_sell'),
                Forms\Components\Textarea::make('sell_property_details')
                    ->rows(3),
                Forms\Components\Select::make('status')
                    ->options([
                        'new' => 'Novo',
                        'contacted' => 'Contactado',
                        'converted' => 'Convertido',
                    ])
                    ->default('new'),
                Forms\Components\DateTimePicker::make('notification_sent_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('lead_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lead_phone'),
                Tables\Columns\TextColumn::make('property.title')
                    ->label('Imóvel')
                    ->searchable(),
                Tables\Columns\TextColumn::make('corretor.name')
                    ->label('Corretor')
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'primary' => 'new',
                        'warning' => 'contacted',
                        'success' => 'converted',
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'new' => 'Novo',
                        'contacted' => 'Contactado',
                        'converted' => 'Convertido',
                    ]),
                Tables\Filters\SelectFilter::make('corretor_id')
                    ->relationship('corretor', 'name')
                    ->label('Corretor'),
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
            'index' => Pages\ListLeads::route('/'),
            'create' => Pages\CreateLead::route('/create'),
            'edit' => Pages\EditLead::route('/{record}/edit'),
        ];
    }
}