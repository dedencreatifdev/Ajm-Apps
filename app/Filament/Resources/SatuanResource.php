<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SatuanResource\Pages;
use App\Filament\Resources\SatuanResource\RelationManagers;
use App\Models\Satuan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SatuanResource extends Resource
{
    protected static ?string $model = Satuan::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Produk';
    protected static ?string $label = 'Satuan';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->maxLength(10),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(55),
                Forms\Components\TextInput::make('base_unit')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('operator')
                    ->maxLength(1)
                    ->default(null),
                Forms\Components\TextInput::make('unit_value')
                    ->maxLength(55)
                    ->default(null),
                Forms\Components\TextInput::make('operation_value')
                    ->maxLength(55)
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('base_unit')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('operator')
                    ->searchable(),
                Tables\Columns\TextColumn::make('unit_value')
                    ->searchable(),
                Tables\Columns\TextColumn::make('operation_value')
                    ->searchable(),
            ])
            ->striped()
            ->paginated([15, 30, 50, 100, 'all'])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSatuans::route('/'),
        ];
    }
}
