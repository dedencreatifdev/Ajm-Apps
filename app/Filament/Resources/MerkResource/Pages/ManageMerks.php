<?php

namespace App\Filament\Resources\MerkResource\Pages;

use App\Filament\Resources\MerkResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

use Filament\Support\Enums\ActionSize;

class ManageMerks extends ManageRecords
{
    protected static string $resource = MerkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->size(ActionSize::ExtraSmall)
                ->icon('heroicon-o-squares-plus'),
        ];
    }
}
