<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;


class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                 //title
            Forms\Components\TextInput::make('title'),

            //brand
            Forms\Components\TextInput::make('brand'),

            //category
            Forms\Components\TextInput::make('category'),

            //description
            Forms\Components\RichEditor::make('description'),

            //price
            Forms\Components\TextInput::make('price')
                ->prefix('$'),

            //rating
            Forms\Components\TextInput::make('rating')
                ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\ImageColumn::make('thumbnail')
                ->label('Image')
                ->circular(),

            //title
             Tables\Columns\TextColumn::make('title')
                ->searchable()
                ->sortable()
                ->weight('medium')
                ->alignLeft(),

            //brand
             Tables\Columns\TextColumn::make('brand')
                ->searchable()
                ->sortable()
                ->color('secondary')
                ->alignLeft(),

            //category
             Tables\Columns\TextColumn::make('category')
                ->sortable()
                ->searchable(),

            //description
             Tables\Columns\TextColumn::make('description')
                ->sortable()
                ->searchable()
                ->limit(30),

            //price
            Tables\Columns\TextColumn::make('price')
                ->colors(['secondary'])
                ->numeric()
                ->badge()
                ->prefix('$')
                ->sortable()
                ->searchable(),


            Tables\Columns\TextColumn::make('rating'),

            //rating
            // Tables\Columns\BadgeColumn::make('rating')
            // ->colors([
            //     'danger' => static fn ($state): bool => $state <= 3,
            //     'warning' => static fn ($state): bool => $state > 3 && $state <= 4.5,
            //     'success' => static fn ($state): bool => $state > 4.5,
            // ])
            // ->sortable()
            // ->searchable(),
            ])
            ->filters([
                //
                Tables\Filters\SelectFilter::make('brand')
                    ->multiple()
                    ->options(Product::select('brand')
                        ->distinct()
                        ->get()
                        ->pluck('brand', 'brand')
                    ),

                //category
                Tables\Filters\SelectFilter::make('category')
                    ->multiple()
                    ->options(Product::select('category')
                        ->distinct()
                        ->get()
                        ->pluck('category', 'category')
                    ),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageProducts::route('/'),
        ];
    }
}
