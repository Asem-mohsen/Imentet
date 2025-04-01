<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CollectionsCategoriesResource\Pages;
use App\Filament\Resources\CollectionsCategoriesResource\RelationManagers;
use App\Models\CollectionCategory;
use Filament\Forms;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CollectionsCategoriesResource extends Resource
{
    protected static ?string $model = CollectionCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $navigationGroup = 'Collections';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Tabs::make('Tabs')
                ->tabs([
                    Tabs\Tab::make('English')
                        ->schema([

                                TextInput::make('name.en')
                                    ->required()
                                    ->label('Collection Cateory Name (English)')
                                    ->maxLength(255),

                                Textarea::make('description.en')->label('Description (English)')->columnSpanFull(),
                            ]),
                    Tabs\Tab::make('Arabic')
                        ->schema([

                                TextInput::make('name.ar')
                                    ->required()
                                    ->label('Collection Cateory Name (Arabic)')
                                    ->maxLength(255),
                                    

                                Textarea::make('description.ar')->label('Description (Arabic)')->columnSpanFull(),
                            ]),
                ])->columnSpan(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('description')->sortable()->searchable()->words(5),
                TextColumn::make('collections_count')->label('No. Collections')->counts('collections')->sortable(),
                TextColumn::make('created_at')->sortable()->date(),
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
                    // Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListCollectionsCategories::route('/'),
            // 'create' => Pages\CreateCollectionsCategories::route('/create'),
            // 'edit' => Pages\EditCollectionsCategories::route('/{record}/edit'),
        ];
    }
}
