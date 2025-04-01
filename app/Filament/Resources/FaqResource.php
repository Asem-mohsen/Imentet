<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FaqResource\Pages;
use App\Filament\Resources\FaqResource\RelationManagers;
use App\Models\Faq;
use Filament\Forms;
use Filament\Forms\Components\Select;
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

class FaqResource extends Resource
{
    protected static ?string $model = Faq::class;

    protected static ?string $navigationIcon = 'heroicon-o-signal';

    protected static ?string $navigationGroup = 'FAQs';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('English')
                            ->schema([

                                    TextInput::make('question.en')
                                        ->required()
                                        ->label('Question (English)')
                                        ->maxLength(255)
                                        ->columnSpan(2),

                                    Textarea::make('answer.en')->label('Answer (English)')->columnSpanFull(),
                                ]),
                        Tabs\Tab::make('Arabic')
                            ->schema([

                                    TextInput::make('question.ar')
                                        ->required()
                                        ->label('Question (Arabic)')
                                        ->maxLength(255),
                                        
                                    Textarea::make('answer.ar')->label('Answer (Arabic)')->columnSpanFull(),
                                ]),

                        Tabs\Tab::make('Category & appearance')
                                ->schema([
    
                                    Select::make('category')
                                        ->label('Select Category')
                                        ->relationship('category', 'name->en')
                                        ->preload()
                                        ->searchable()
                                        ->required(),
                                            
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
                TextColumn::make('category.name')->sortable()->searchable(),
                TextColumn::make('question')->sortable()->searchable()->words(10),
                TextColumn::make('answer')->sortable()->searchable()->words(5),
                IconColumn::make('is_shown')
                    ->boolean()
                    ->sortable(),
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
            'index' => Pages\ListFaqs::route('/'),
            // 'create' => Pages\CreateFaq::route('/create'),
            // 'edit' => Pages\EditFaq::route('/{record}/edit'),
        ];
    }
}
