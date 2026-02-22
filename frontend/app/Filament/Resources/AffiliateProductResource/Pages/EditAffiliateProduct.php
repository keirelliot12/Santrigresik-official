<?php

namespace App\Filament\Resources\AffiliateProductResource\Pages;

use App\Filament\Resources\AffiliateProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAffiliateProduct extends EditRecord
{
    protected static string $resource = AffiliateProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
