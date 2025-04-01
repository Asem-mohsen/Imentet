<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CollectionResource\Pages;
use App\Filament\Resources\CollectionResource\RelationManagers;
use App\Models\Collection;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
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

class CollectionResource extends Resource
{
    protected static ?string $model = Collection::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

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
                                    ->label('Collection Name (English)')
                                    ->maxLength(255),

                                Textarea::make('description.en')->label('Description (English)'),
                            ]),
                    Tabs\Tab::make('Arabic')
                        ->schema([
                                TextInput::make('name.ar')
                                    ->required()
                                    ->label('Collection Name (Arabic)')
                                    ->maxLength(255),

                                Textarea::make('description.ar')->label('Description (Arabic)'),
                            ]),

                    Tabs\Tab::make('More Information')
                        ->schema([
                                Select::make('category_id')
                                    ->label('Select Category')
                                    ->relationship('category', 'name')
                                    ->preload()
                                    ->searchable()
                                    ->required(),

                                Select::make('place_id')
                                    ->label('Select Places')
                                    ->relationship('places', 'name')
                                    ->preload()
                                    ->multiple()
                                    ->searchable()
                                    ->required(),

                                SpatieMediaLibraryFileUpload::make('collection_media')
                                    ->collection('collection_media')
                                    ->multiple()
                                    ->helperText('Upload media for the collection to show the world how beautiful the collection is'),

                                Toggle::make('is_shown')
                                    ->onColor('success')
                                    ->offColor('danger')
                                    ->inline(true)
                                    ->default(true)
                                    ->required(),
                            ]),
                    ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('category.name')->label('Category')->sortable()->searchable(),
                TextColumn::make('description')->sortable()->searchable()->words(8),
                IconColumn::make('is_shown')->label('Is Shown')->boolean(),
                TextColumn::make('created_at')->date()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListCollections::route('/'),
            // 'create' => Pages\CreateCollection::route('/create'),
            // 'edit' => Pages\EditCollection::route('/{record}/edit'),
        ];
    }
}
