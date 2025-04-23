<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\PosRegister;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PosRegisterResource\Pages;
use App\Filament\Resources\PosRegisterResource\RelationManagers;

class PosRegisterResource extends Resource
{
    protected static ?string $model = PosRegister::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Setting';
    protected static ?string $label = 'PosRegister';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DateTimePicker::make('date')
                    ->required(),
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('cash_in_hand')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->maxLength(10),
                Forms\Components\TextInput::make('total_cash')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('total_cheques')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('total_cc_slips')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('total_cash_submitted')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('total_cheques_submitted')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('total_cc_slips_submitted')
                    ->numeric()
                    ->default(null),
                Forms\Components\Textarea::make('note')
                    ->columnSpanFull(),
                Forms\Components\DateTimePicker::make('closed_at'),
                Forms\Components\TextInput::make('transfer_opened_bills')
                    ->maxLength(50)
                    ->default(null),
                Forms\Components\TextInput::make('closed_by')
                    ->numeric()
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('getUserOpen.name')
                    ->label('Dibuat Oleh'),
                Tables\Columns\TextColumn::make('cash_in_hand')
                    ->alignEnd()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->color(fn (string $state): string => match ($state) {
                        'close' => 'success',
                        'open' => 'danger',
                    })
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('total_cash')
                    ->alignEnd()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_cheques')
                    ->alignEnd()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_cc_slips')
                    ->alignEnd()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_cash_submitted')
                    ->alignEnd()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_cheques_submitted')
                    ->alignEnd()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_cc_slips_submitted')
                    ->alignEnd()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('closed_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('transfer_opened_bills')
                    ->searchable(),
                Tables\Columns\TextColumn::make('getUserClosed.name')
                    ->label('Ditutup Oleh'),
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
            'index' => Pages\ManagePosRegisters::route('/'),
        ];
    }
}
