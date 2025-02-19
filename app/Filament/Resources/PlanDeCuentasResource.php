<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlanDeCuentasResource\Pages;
use App\Filament\Resources\PlanDeCuentasResource\RelationManagers;
use App\Models\PlanDeCuentas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PlanDeCuentasResource extends Resource
{
    protected static ?string $model = PlanDeCuentas::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                  //title
                  Forms\Components\TextInput::make('id'),

            //brand
            Forms\Components\TextInput::make('nombre'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                //title
                Tables\Columns\TextColumn::make('id')
                ->searchable()
                ->sortable()
                ->weight('medium')
                ->alignLeft(),

                Tables\Columns\TextColumn::make('nombre')
                ->searchable()
                ->sortable()
                ->color('secondary')
                ->alignLeft(),


            ])
            ->filters([

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
            'index' => Pages\ManagePlanDeCuentas::route('/'),
        ];
    }
}
