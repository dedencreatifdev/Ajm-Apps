<?php

namespace App\Filament\Resources\PenjualanResource\Pages;

use Filament\Actions;
use Filament\Support\Enums\ActionSize;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\PenjualanResource;

class ListPenjualans extends ListRecords
{
    protected static string $resource = PenjualanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->size(ActionSize::ExtraSmall)
                ->icon('heroicon-o-squares-plus'),
        ];
    }
}
