<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PembelianResource\Pages;
use App\Filament\Resources\PembelianResource\RelationManagers;
use App\Models\Pembelian;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PembelianResource extends Resource
{
    protected static ?string $model = Pembelian::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Transaksi';
    protected static ?string $label = 'Pembelian';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('reference_no')
                    ->required()
                    ->maxLength(55),
                Forms\Components\DateTimePicker::make('date')
                    ->required(),
                Forms\Components\TextInput::make('supplier_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('supplier')
                    ->required()
                    ->maxLength(55),
                Forms\Components\TextInput::make('warehouse_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('note')
                    ->required()
                    ->maxLength(1000),
                Forms\Components\TextInput::make('total')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('product_discount')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('order_discount_id')
                    ->maxLength(20)
                    ->default(null),
                Forms\Components\TextInput::make('order_discount')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('total_discount')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('product_tax')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('order_tax_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('order_tax')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('total_tax')
                    ->numeric()
                    ->default(0.0000),
                Forms\Components\TextInput::make('shipping')
                    ->numeric()
                    ->default(0.0000),
                Forms\Components\TextInput::make('grand_total')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('paid')
                    ->required()
                    ->numeric()
                    ->default(0.0000),
                Forms\Components\TextInput::make('status')
                    ->maxLength(55)
                    ->default(''),
                Forms\Components\TextInput::make('payment_status')
                    ->maxLength(20)
                    ->default('pending'),
                Forms\Components\TextInput::make('created_by')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('updated_by')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('attachment')
                    ->maxLength(55)
                    ->default(null),
                Forms\Components\TextInput::make('payment_term')
                    ->numeric()
                    ->default(null),
                Forms\Components\DatePicker::make('due_date'),
                Forms\Components\TextInput::make('return_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('surcharge')
                    ->required()
                    ->numeric()
                    ->default(0.0000),
                Forms\Components\TextInput::make('return_purchase_ref')
                    ->maxLength(55)
                    ->default(null),
                Forms\Components\TextInput::make('purchase_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('return_purchase_total')
                    ->required()
                    ->numeric()
                    ->default(0.0000),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('date')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('reference_no')
                    ->searchable(),
                Tables\Columns\TextColumn::make('supplier')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('warehouse_id')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('total')
                //     ->numeric(decimalPlaces: 2)
                //     ->alignEnd()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('product_discount')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('order_discount_id')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('order_discount')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('total_discount')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('product_tax')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('order_tax_id')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('order_tax')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('total_tax')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('shipping')
                //     ->numeric()
                //     ->sortable(),
                Tables\Columns\TextColumn::make('grand_total')
                    ->numeric()
                    ->alignEnd()
                    ->sortable(),
                Tables\Columns\TextColumn::make('paid')
                    ->numeric()
                    ->alignEnd()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('payment_status')
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
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPembelians::route('/'),
            'create' => Pages\CreatePembelian::route('/create'),
            'view' => Pages\ViewPembelian::route('/{record}'),
            'edit' => Pages\EditPembelian::route('/{record}/edit'),
        ];
    }
}
