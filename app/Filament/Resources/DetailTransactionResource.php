<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DetailTransactionResource\Pages;
use App\Filament\Resources\DetailTransactionResource\RelationManagers;
use App\Models\DetailTransaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DetailTransactionResource extends Resource
{
    protected static ?string $model = DetailTransaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationGroup = 'Sales & Reports';

    protected static ?string $navigationLabel = 'Detail Transactions';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id_transaction')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('id_product')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('detail_transaction_qty')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('detail_transaction_subtotal')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_transaction')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('product.product_name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('detail_transaction_qty')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('detail_transaction_subtotal')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListDetailTransactions::route('/'),
            'create' => Pages\CreateDetailTransaction::route('/create'),
            'edit' => Pages\EditDetailTransaction::route('/{record}/edit'),
        ];
    }
}
