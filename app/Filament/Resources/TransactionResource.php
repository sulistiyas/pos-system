<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;
use App\Models\Category;
use App\Models\Products;
use App\Models\Transaction;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?string $navigationGroup = 'Sales & Reports';

    protected static ?string $navigationLabel = 'Transactions';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            // ->disableUpdate()
            ->schema([
                Forms\Components\Section::make('Customer Details')
                    ->description('Select the customer for this transaction.')
                    ->schema([
                        Forms\Components\Select::make('id_customer')
                            ->relationship('customer', 'customer_name')
                            ->label('Customer Name')
                            ->searchable()
                            ->preload()
                            ->live()
                            ->required(),
                    ]),
                Forms\Components\Section::make('Product Details')
                    ->description('Select the product details for this transaction.')
                    ->schema([
                        Forms\Components\Select::make('product_category')
                            // ->relationship('product_category', 'category_name')
                            ->options(fn (Get $get):Collection => Category::query()
                                ->pluck('category_name', 'id_category'))
                            ->label('Product Category') 
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(Function(Set $set){
                                // $set('product_id', null);
                                $set('product_stok', null);
                            })
                            ->dehydrated(false)
                            ->required(),
                        Forms\Components\Select::make('product_id')
                        ->options(fn (Get $get):Collection => Products::query()
                            ->where('id_category', $get('product_category'))
                            ->pluck('product_name', 'id_product'))
                        ->searchable()
                        ->preload()
                        ->live()
                        ->afterStateUpdated(
                            function (Set $set, Get $get) {
                                $product = Products::find($get('product_id'));
                                if ($product) {
                                    $set('product_price', $product->product_price);
                                    $set('product_stok', $product->product_stock);
                                } else {
                                    $set('product_price', null);
                                    $set('product_stok', null);
                                }
                            }
                        )
                        ->required(),
                        Forms\Components\TextInput::make('product_stok')
                            ->label('Product Stock')
                            ->required()
                            ->numeric()
                            ->readOnly(),
                    ])->columns(3),
                Forms\Components\Section::make('Transaction Details')
                    ->description('Fill in the transaction details below.')
                    ->schema([
                        Forms\Components\TextInput::make('detail_transaction_qty')
                            ->label('Quantity')
                            ->numeric()
                            ->default(0)
                            ->afterStateUpdated(
                                function (Set $set, Get $get) {
                                    $product = Products::find($get('product_id'));
                                    if ($product) {
                                        $qty = $get('detail_transaction_qty');
                                        if ($qty == null) {
                                            $set('detail_transaction_subtotal', 0);
                                        } else {
                                            $price = $product->product_price;
                                            $subtotal = $qty * $price;
                                            $set('detail_transaction_subtotal', $subtotal);
                                        }
                                    } else {
                                        $set('detail_transaction_subtotal', 0);
                                    }
                                }
                            )
                            ->reactive()
                            ->required(),
                        Forms\Components\TextInput::make('product_price')
                            ->label('Price Per Unit')
                            ->required()
                            ->numeric()
                            ->disabled(),
                        Forms\Components\TextInput::make('detail_transaction_subtotal')
                            ->label('Subtotal')
                            ->required()
                            ->numeric()
                            ->default(0)
                            // ->dehydrated(false)
                            ->readOnly(),
                    ])->columns(3),
                // Forms\Components\DatePicker::make('transaction_date')
                //     ->required(),
                // Forms\Components\TextInput::make('detail_transaction_subtotal')
                //     ->required()
                //     ->numeric(),
                // Forms\Components\TextInput::make('id_customer')
                //     ->required()
                //     ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('transaction_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('customer.customer_name')
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
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}
