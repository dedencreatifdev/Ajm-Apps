<?php

namespace App\Filament\Resources\KategoriResource\Pages;

use Filament\Actions;
use Filament\Support\Enums\ActionSize;
use Filament\Resources\Pages\ManageRecords;
use App\Filament\Resources\KategoriResource;

class ManageKategoris extends ManageRecords
{
    protected static string $resource = KategoriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->size(ActionSize::ExtraSmall)
                ->icon('heroicon-o-squares-plus'),
        ];
    }
}
