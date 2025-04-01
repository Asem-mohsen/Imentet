<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FaqCategoryResource\Pages;
use App\Filament\Resources\FaqCategoryResource\RelationManagers;
use App\Models\FaqCategory;
use Filament\Forms;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FaqCategoryResource extends Resource
{
    protected static ?string $model = FaqCategory::class;
    protected static ?string $navigationIcon = 'heroicon-o-folder';
    protected static ?string $navigationGroup = 'FAQs';

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
                                ->unique(column: 'name->en' , ignoreRecord: true)
                                ->label('Category Name (English)')
                                ->maxLength(255),
                        ]),
                Tabs\Tab::make('Arabic')
                    ->schema([
                            TextInput::make('name.ar')
                                ->required()
                                ->unique(column: 'name->ar', ignoreRecord: true)
                                ->label('Category Name (Arabic)')
                                ->maxLength(255),
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
                TextColumn::make('faqs_count')->label('No. of FAQs')->counts('faqs')->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListFaqCategories::route('/'),
            // 'create' => Pages\CreateFaqCategory::route('/create'),
            // 'edit' => Pages\EditFaqCategory::route('/{record}/edit'),
        ];
    }
}
