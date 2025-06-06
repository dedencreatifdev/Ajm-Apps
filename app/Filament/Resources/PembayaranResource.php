<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Pembayaran;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PembayaranResource\Pages;
use App\Filament\Resources\PembayaranResource\RelationManagers;

class PembayaranResource extends Resource
{
    protected static ?string $model = Pembayaran::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Transaksi';
    protected static ?string $label = 'Pembayaran';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DateTimePicker::make('date'),
                Forms\Components\TextInput::make('sale_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('return_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('purchase_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('reference_no')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('transaction_id')
                    ->maxLength(50)
                    ->default(null),
                Forms\Components\TextInput::make('paid_by')
                    ->required()
                    ->maxLength(20),
                Forms\Components\TextInput::make('cheque_no')
                    ->maxLength(20)
                    ->default(null),
                Forms\Components\TextInput::make('cc_no')
                    ->maxLength(20)
                    ->default(null),
                Forms\Components\TextInput::make('cc_holder')
                    ->maxLength(25)
                    ->default(null),
                Forms\Components\TextInput::make('cc_month')
                    ->maxLength(2)
                    ->default(null),
                Forms\Components\TextInput::make('cc_year')
                    ->maxLength(4)
                    ->default(null),
                Forms\Components\TextInput::make('cc_type')
                    ->maxLength(20)
                    ->default(null),
                Forms\Components\TextInput::make('amount')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('currency')
                    ->maxLength(3)
                    ->default(null),
                Forms\Components\TextInput::make('created_by')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('attachment')
                    ->maxLength(55)
                    ->default(null),
                Forms\Components\TextInput::make('type')
                    ->required()
                    ->maxLength(20),
                Forms\Components\TextInput::make('note')
                    ->maxLength(1000)
                    ->default(null),
                Forms\Components\TextInput::make('pos_paid')
                    ->numeric()
                    ->default(0.0000),
                Forms\Components\TextInput::make('pos_balance')
                    ->numeric()
                    ->default(0.0000),
                Forms\Components\TextInput::make('approval_code')
                    ->maxLength(50)
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('date')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('getPenjualan.reference_no')
                    ->sortable(),
                Tables\Columns\TextColumn::make('return_id')
                    ->sortable(),
                Tables\Columns\TextColumn::make('getPembelian.reference_no')
                    ->sortable(),
                Tables\Columns\TextColumn::make('reference_no')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('transaction_id')
                //     ->searchable(),
                Tables\Columns\TextColumn::make('paid_by')
                    ->words()
                    ->searchable(),
                // Tables\Columns\TextColumn::make('cheque_no')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('cc_no')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('cc_holder')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('cc_month')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('cc_year')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('cc_type')
                // ->searchable(),
                Tables\Columns\TextColumn::make('amount')
                    ->alignEnd()
                    ->numeric()
                    ->sortable(),
                // Tables\Columns\TextColumn::make('currency')
                //     ->searchable(),
                Tables\Columns\TextColumn::make('getUserPembuat.name')
                    ->label('Dibuat Oleh')
                    ->sortable(),
                // Tables\Columns\TextColumn::make('attachment')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('type')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('note')
                //     ->searchable(),
                Tables\Columns\TextColumn::make('pos_paid')
                    ->alignEnd()
                    ->numeric()
                    ->sortable(),
                // Tables\Columns\TextColumn::make('pos_balance')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('approval_code')
                //     ->searchable(),
            ])
            ->striped()
            ->paginated([15, 30, 50, 100, 'all'])
            ->defaultSort('date', 'desc')
            ->filters([
                Filter::make('date')
                ->label('Tanggal')
                    ->form([
                        DatePicker::make('dari')
                            ->label('Dari Tanggal')
                            ->placeholder('Dari Tanggal')
                            ->required(),
                        DatePicker::make('sampai')
                            ->label('Sampai Tanggal')
                            ->placeholder('Sampai Tanggal')
                            ->required(),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['dari'],
                                fn(Builder $query, $date): Builder => $query->whereDate('date', '>=', $date),
                            )
                            ->when(
                                $data['sampai'],
                                fn(Builder $query, $date): Builder => $query->whereDate('date', '<=', $date),
                            );
                    })
            ], layout: FiltersLayout::Modal)
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
            'index' => Pages\ManagePembayarans::route('/'),
        ];
    }
}
