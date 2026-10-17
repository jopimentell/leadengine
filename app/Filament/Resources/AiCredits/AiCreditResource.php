<?php

namespace App\Filament\Resources\AiCredits;

use App\Filament\Resources\AiCredits\Pages\CreateAiCredit;
use App\Filament\Resources\AiCredits\Pages\EditAiCredit;
use App\Filament\Resources\AiCredits\Pages\ListAiCredits;
use App\Filament\Resources\AiCredits\Schemas\AiCreditForm;
use App\Filament\Resources\AiCredits\Tables\AiCreditsTable;
use App\Models\AiCredit;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AiCreditResource extends Resource
{
    protected static ?string $model = AiCredit::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return AiCreditForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AiCreditsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAiCredits::route('/'),
            'create' => CreateAiCredit::route('/create'),
            'edit' => EditAiCredit::route('/{record}/edit'),
        ];
    }
}
