<?php

namespace App\Filament\Resources\AiCredits\Pages;

use App\Filament\Resources\AiCredits\AiCreditResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAiCredit extends EditRecord
{
    protected static string $resource = AiCreditResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
