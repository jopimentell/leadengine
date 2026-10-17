<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    use UnitEnum; // adicione no topo se não existir

protected static string|UnitEnum|null $navigationGroup  = 'Usuários';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set) => 
                        $set('slug', Str::slug($state) . '-' . Str::random(6))
                    ),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('phone')
                    ->required()
                    ->maxLength(20)
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('city')
                    ->maxLength(255),
                Forms\Components\TextInput::make('creci')
                    ->maxLength(50),
                Forms\Components\Select::make('plan_type')
                    ->options([
                        'free' => 'Free',
                        'pro' => 'Pro',
                        'black' => 'Black',
                    ])
                    ->default('free'),
                Forms\Components\Toggle::make('has_custom_domain'),
                Forms\Components\Toggle::make('setup_fee_paid'),
                Forms\Components\DateTimePicker::make('trial_ends_at'),
                Forms\Components\FileUpload::make('avatar')
                    ->image()
                    ->directory('avatars')
                    ->visibility('public'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('avatar')
                    ->circular()
                    ->size(40),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\TextColumn::make('city'),
                Tables\Columns\BadgeColumn::make('plan_type')
                    ->colors([
                        'success' => 'free',
                        'warning' => 'pro',
                        'danger' => 'black',
                    ]),
                Tables\Columns\TextColumn::make('properties_count')
                    ->counts('properties')
                    ->label('Imóveis'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('plan_type')
                    ->options([
                        'free' => 'Free',
                        'pro' => 'Pro',
                        'black' => 'Black',
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}