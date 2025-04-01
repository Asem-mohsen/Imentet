<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CareersResource\Pages;
use App\Filament\Resources\CareersResource\RelationManagers;
use App\Models\Career;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
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

class CareersResource extends Resource
{
    protected static ?string $model = Career::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationGroup = 'Management';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Tabs::make('Tabs')
                ->tabs([
                Tabs\Tab::make('English')
                    ->schema([
                            TextInput::make('title.en')
                                ->required()
                                ->unique(column: 'title->en' , ignoreRecord: true)
                                ->label('Career Title (English)')
                                ->maxLength(255),

                            Textarea::make('description.en')->label('Description (English)'),

                            Textarea::make('location.en')->label('Location (English)'),
                        ]),
                Tabs\Tab::make('Arabic')
                    ->schema([
                            TextInput::make('title.ar')
                                ->required()
                                ->unique(column: 'title->ar', ignoreRecord: true)
                                ->label('Career Title (Arabic)')
                                ->maxLength(255),

                            Textarea::make('description.ar')->label('Description (Arabic)'),

                            Textarea::make('location.ar')->label('Location (Arabic)'),
                        ]),
                        
                Tabs\Tab::make('Place & deadline')
                    ->schema([
                            Select::make('place_id')
                                ->label('Select Place')
                                ->relationship('place', 'name')
                                ->preload()
                                ->searchable()
                                ->required(),
                            DatePicker::make('application_deadline')->label('Application Deadline'),
                        ]),
                        
            ])->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('title')->sortable()->searchable(),
                TextColumn::make('place.name')->label('Place')->sortable()->searchable(),
                TextColumn::make('location')->label('Location')->sortable()->searchable()->words(8),
                TextColumn::make('applications_count')->label('No. of Applications')->counts('applications')->sortable(),
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
            'index' => Pages\ListCareers::route('/'),
            'create' => Pages\CreateCareers::route('/create'),
            'edit' => Pages\EditCareers::route('/{record}/edit'),
        ];
    }
}
