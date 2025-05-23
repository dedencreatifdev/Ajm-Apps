<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Produk;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ProdukResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProdukResource\RelationManagers;

use function Termwind\style;

class ProdukResource extends Resource
{
    protected static ?string $model = Produk::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Produk';
    protected static ?string $label = 'Produk List';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('product_id')
                    ->required()
                    ->numeric(),
                TextInput::make('warehouse_id')
                    ->required()
                    ->numeric(),
                TextInput::make('quantity')
                    ->required()
                    ->numeric(),
                TextInput::make('rack')
                    ->maxLength(55)
                    ->default(null),
                TextInput::make('avg_cost')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('getProdukDetail.code')
                    ->label('Kode Produk')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('getProdukDetail.name')
                    ->label('Nama Produk')
                    ->searchable(),
                TextColumn::make('getProdukDetail.getSatuan.name')
                    ->label('Satuan')
                    ->searchable(),
                TextColumn::make('getProdukDetail.getKategori.name')
                    ->label('Kategori')
                    ->searchable(),
                TextColumn::make('getProdukDetail.getMerk.name')
                    ->label('Merk')
                    ->searchable(),
                TextColumn::make('getProdukDetail.price')
                    ->label('Harga')
                    ->alignEnd()
                    ->numeric(decimalPlaces: 2),
                TextColumn::make('getProdukDetail.promo_price')
                    ->label('Harga Promo')
                    ->alignEnd()
                    ->default(0.00)
                    ->numeric(decimalPlaces: 2),

                TextColumn::make('quantity')
                    ->label('Stok')
                    ->numeric(),
                TextColumn::make('avg_cost')
                    ->label('Harga Beli')
                    ->numeric(decimalPlaces: 2)
                    ->alignEnd(),
                TextColumn::make('getProdukDetail.alert_quantity')
                    ->label('Alert')
                    ->alignEnd()
                    ->default(0.00)
                    ->numeric(decimalPlaces: 2),
                TextColumn::make('getGudang.name')
                    ->label('Gudang')
                    ->hiddenFrom('md')
                    ->searchable(),
                TextColumn::make('rack'),
            ])
            ->recordClasses([])

            ->striped()
            ->defaultSort('getProdukDetail.code', 'asc')
            ->paginated([15, 30, 50, 100, 'all'])
            ->filters([
                SelectFilter::make('warehouse_id')
                    ->label('Gudang')
                    ->relationship('getGudang', 'name')
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->label('Detail Produk')
                        ->modalHeading('Detail Stok Produk')
                        ->modalSubheading('Detail Stok Produk')
                        ->modalAlignment('center')
                        ->modalIcon('heroicon-o-pencil'),
                    Tables\Actions\EditAction::make()
                        ->label('Ubah')
                        ->modalHeading('Ubah Stok Produk')
                        ->modalSubheading('Ubah Stok Produk')
                        ->modalAlignment('center')
                        ->modalIcon('heroicon-o-pencil')
                        ->modalWidth('3xl'),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\Action::make('cetak_label'),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageProduks::route('/'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
