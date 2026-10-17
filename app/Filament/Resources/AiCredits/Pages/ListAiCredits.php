<?php

namespace App\Filament\Resources\AiCredits\Pages;

use App\Filament\Resources\AiCredits\AiCreditResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAiCredits extends ListRecords
{
    protected static string $resource = AiCreditResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
