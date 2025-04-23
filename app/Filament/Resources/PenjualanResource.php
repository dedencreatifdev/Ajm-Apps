<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Penjualan;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PenjualanResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PenjualanResource\RelationManagers;

class PenjualanResource extends Resource
{
    protected static ?string $model = Penjualan::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Transaksi';
    protected static ?string $label = 'Penjualan';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DateTimePicker::make('date')
                    ->required(),
                Forms\Components\TextInput::make('reference_no')
                    ->required()
                    ->maxLength(55),
                Forms\Components\TextInput::make('customer_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('customer')
                    ->required()
                    ->maxLength(55),
                Forms\Components\TextInput::make('biller_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('biller')
                    ->required()
                    ->maxLength(55),
                Forms\Components\TextInput::make('warehouse_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('note')
                    ->maxLength(1000)
                    ->default(null),
                Forms\Components\TextInput::make('staff_note')
                    ->maxLength(1000)
                    ->default(null),
                Forms\Components\TextInput::make('total')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('product_discount')
                    ->numeric()
                    ->default(0.0000),
                Forms\Components\TextInput::make('order_discount_id')
                    ->maxLength(20)
                    ->default(null),
                Forms\Components\TextInput::make('total_discount')
                    ->numeric()
                    ->default(0.0000),
                Forms\Components\TextInput::make('order_discount')
                    ->numeric()
                    ->default(0.0000),
                Forms\Components\TextInput::make('product_tax')
                    ->numeric()
                    ->default(0.0000),
                Forms\Components\TextInput::make('order_tax_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('order_tax')
                    ->numeric()
                    ->default(0.0000),
                Forms\Components\TextInput::make('total_tax')
                    ->numeric()
                    ->default(0.0000),
                Forms\Components\TextInput::make('shipping')
                    ->numeric()
                    ->default(0.0000),
                Forms\Components\TextInput::make('grand_total')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('sale_status')
                    ->maxLength(20)
                    ->default(null),
                Forms\Components\TextInput::make('payment_status')
                    ->maxLength(20)
                    ->default(null),
                Forms\Components\TextInput::make('payment_term')
                    ->numeric()
                    ->default(null),
                Forms\Components\DatePicker::make('due_date'),
                Forms\Components\TextInput::make('created_by')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('updated_by')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('total_items')
                    ->numeric()
                    ->default(null),
                Forms\Components\Toggle::make('pos')
                    ->required(),
                Forms\Components\TextInput::make('paid')
                    ->numeric()
                    ->default(0.0000),
                Forms\Components\TextInput::make('return_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('surcharge')
                    ->required()
                    ->numeric()
                    ->default(0.0000),
                Forms\Components\TextInput::make('attachment')
                    ->maxLength(55)
                    ->default(null),
                Forms\Components\TextInput::make('return_sale_ref')
                    ->maxLength(55)
                    ->default(null),
                Forms\Components\TextInput::make('sale_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('return_sale_total')
                    ->required()
                    ->numeric()
                    ->default(0.0000),
                Forms\Components\TextInput::make('rounding')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('suspend_note')
                    ->maxLength(255)
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('date')
                ->dateTime('d M Y H:i')
                    ->sortable(),
                TextColumn::make('reference_no')
                    ->searchable(),
                // TextColumn::make('customer_id')
                //     ->numeric()
                //     ->sortable(),
                TextColumn::make('customer')
                    ->searchable(),
                // TextColumn::make('biller_id')
                //     ->numeric()
                //     ->sortable(),
                TextColumn::make('biller')
                    ->searchable(),
                // TextColumn::make('warehouse_id')
                //     ->numeric()
                //     ->sortable(),
                // TextColumn::make('note')
                //     ->searchable(),
                // TextColumn::make('staff_note')
                //     ->searchable(),
                // TextColumn::make('total')
                //     ->numeric()
                //     ->sortable(),
                // TextColumn::make('product_discount')
                //     ->numeric()
                //     ->sortable(),
                // TextColumn::make('order_discount_id')
                //     ->searchable(),
                // TextColumn::make('total_discount')
                //     ->numeric()
                //     ->sortable(),
                // TextColumn::make('order_discount')
                //     ->numeric()
                //     ->sortable(),
                // TextColumn::make('product_tax')
                //     ->numeric()
                //     ->sortable(),
                // TextColumn::make('order_tax_id')
                //     ->numeric()
                //     ->sortable(),
                // TextColumn::make('order_tax')
                //     ->numeric()
                //     ->sortable(),
                // TextColumn::make('total_tax')
                //     ->numeric()
                //     ->sortable(),
                // TextColumn::make('shipping')
                //     ->numeric()
                //     ->sortable(),
                TextColumn::make('grand_total')
                    ->alignEnd()
                    ->numeric()
                    ->sortable(),
                TextColumn::make('paid')
                    ->alignEnd()
                    ->numeric()
                    ->sortable(),
                TextColumn::make('sale_status')
                    ->searchable(),
                TextColumn::make('payment_status')
                    ->searchable(),
                // TextColumn::make('payment_term')
                //     ->numeric()
                //     ->sortable(),
                // TextColumn::make('due_date')
                //     ->date()
                //     ->sortable(),
                // TextColumn::make('created_by')
                //     ->numeric()
                //     ->sortable(),
                // TextColumn::make('updated_by')
                //     ->numeric()
                //     ->sortable(),
                // TextColumn::make('updated_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                // TextColumn::make('total_items')
                //     ->numeric()
                //     ->sortable(),
                // IconColumn::make('pos')
                //     ->boolean(),
                // TextColumn::make('return_id')
                //     ->numeric()
                //     ->sortable(),
                // TextColumn::make('surcharge')
                //     ->numeric()
                //     ->sortable(),
                // TextColumn::make('attachment')
                //     ->searchable(),
                // TextColumn::make('return_sale_ref')
                //     ->searchable(),
                // TextColumn::make('sale_id')
                //     ->numeric()
                //     ->sortable(),
                // TextColumn::make('return_sale_total')
                //     ->numeric()
                //     ->sortable(),
                // TextColumn::make('rounding')
                //     ->numeric()
                //     ->sortable(),
                // TextColumn::make('suspend_note')
                //     ->searchable(),
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
            'index' => Pages\ListPenjualans::route('/'),
            'create' => Pages\CreatePenjualan::route('/create'),
            'view' => Pages\ViewPenjualan::route('/{record}'),
            'edit' => Pages\EditPenjualan::route('/{record}/edit'),
        ];
    }
}
