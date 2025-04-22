<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExpenceResource\Pages;
use App\Filament\Resources\ExpenceResource\RelationManagers;
use App\Models\Expence;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExpenceResource extends Resource
{
    protected static ?string $model = Expence::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Transaksi';
    protected static ?string $label = 'Expence';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DateTimePicker::make('date')
                    ->required(),
                Forms\Components\TextInput::make('reference')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('amount')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('note')
                    ->maxLength(1000)
                    ->default(null),
                Forms\Components\TextInput::make('created_by')
                    ->required()
                    ->maxLength(55),
                Forms\Components\TextInput::make('attachment')
                    ->maxLength(55)
                    ->default(null),
                Forms\Components\TextInput::make('category_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('warehouse_id')
                    ->numeric()
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('reference')
                    ->searchable(),
                Tables\Columns\TextColumn::make('amount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('note')
                    ->html()
                    ->searchable(),
                Tables\Columns\TextColumn::make('getUserPembuat.name')
                    ->label('Dibuat Oleh')
                    ->searchable(),
                Tables\Columns\TextColumn::make('getKategoriExpence.name')
                    ->label('Kategori')
                    ->searchable(),
                Tables\Columns\TextColumn::make('getGudang.name')
                    ->label('Gudang')
                    ->searchable(),
            ])
            ->striped()
            ->paginated([15, 30, 50, 100, 'all'])
            ->defaultSort('date', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ManageExpences::route('/'),
        ];
    }
}
