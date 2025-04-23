<?php

namespace App\Filament\Resources\PembelianResource\Pages;

use Filament\Actions;
use Filament\Support\Enums\ActionSize;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\PembelianResource;

class ListPembelians extends ListRecords
{
    protected static string $resource = PembelianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->size(ActionSize::ExtraSmall)
                ->icon('heroicon-o-squares-plus'),
        ];
    }
}
