<?php

namespace App\Filament\Resources\ExpenceResource\Pages;

use App\Filament\Resources\ExpenceResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

use Filament\Support\Enums\ActionSize;

class ManageExpences extends ManageRecords
{
    protected static string $resource = ExpenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->size(ActionSize::ExtraSmall)
                ->icon('heroicon-o-squares-plus'),
        ];
    }
}
