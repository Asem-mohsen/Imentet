<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeatureResource\Pages;
use App\Filament\Resources\FeatureResource\RelationManagers;
use App\Models\Feature;
use Filament\Forms;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FeatureResource extends Resource
{
    protected static ?string $model = Feature::class;
    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationGroup = 'Memberships';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name.en')
                    ->required()
                    ->label('Feature Name (English)')
                    ->maxLength(255),

                TextInput::make('name.ar')
                    ->required()
                    ->label('Feature Name (Arabic)')
                    ->maxLength(255),

                Toggle::make('is_active')
                    ->onColor('success')
                    ->offColor('danger')
                    ->inline(true)
                    ->default(false)
                    ->required(),

                Toggle::make('is_bold')
                    ->onColor('success')
                    ->offColor('danger')
                    ->inline(true)
                    ->default(true)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->sortable()->searchable(),
                IconColumn::make('is_active')
                    ->boolean()
                    ->sortable()
                    ->searchable(),
                IconColumn::make('is_bold')
                    ->boolean()
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListFeatures::route('/'),
            // 'create' => Pages\CreateFeature::route('/create'),
            // 'edit' => Pages\EditFeature::route('/{record}/edit'),
        ];
    }
}
