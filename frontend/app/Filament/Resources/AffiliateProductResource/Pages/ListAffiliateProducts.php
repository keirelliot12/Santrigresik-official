<?php

namespace App\Filament\Resources\AffiliateProductResource\Pages;

use App\Filament\Resources\AffiliateProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAffiliateProducts extends ListRecords
{
    protected static string $resource = AffiliateProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
