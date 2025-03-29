<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    protected static ?string $navigationGroup = 'Events';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([

                    Wizard\Step::make('Event Main Information')
                        ->icon('heroicon-m-sparkles')
                        ->schema([

                            Tabs::make('Tabs')
                                ->tabs([
                                Tabs\Tab::make('English')
                                    ->schema([
        
                                            TextInput::make('title.en')
                                                ->required()
                                                ->unique(column: 'title->en' , ignoreRecord:true)
                                                ->label('Event Title (English)')
                                                ->maxLength(255),
        
                                            Textarea::make('description.en')->label('Description (English)'),
        
                                            Textarea::make('location.en')->label('Location (English)'),
                                        ]),
                                Tabs\Tab::make('Arabic')
                                    ->schema([
        
                                            TextInput::make('title.ar')
                                                ->required()
                                                ->unique(column: 'title->ar', ignoreRecord:true)
                                                ->label('Event Title (Arabic)')
                                                ->maxLength(255),
        
                                            Textarea::make('description.ar')->label('Description (Arabic)'),
        
                                            Textarea::make('location.ar')->label('Location (Arabic)'),
                                        ]),
                            ]),

                            Tabs::make('Tabs')
                                ->tabs([
                                    Tabs\Tab::make('Event Location')
                                        ->schema([
                                            Select::make('event_category_id')
                                            ->label('Select Event Category')
                                            ->relationship('category', 'name')
                                            ->preload()
                                            ->searchable()
                                            ->required(),
                    
                                        Select::make('place_id')
                                            ->label('Select Place')
                                            ->relationship('place', 'name')
                                            ->preload()
                                            ->searchable()
                                            ->required(),
                                        ]),
                                ]),
                        ]),
                    Wizard\Step::make('Dates & Durations')
                        ->icon('heroicon-m-calendar-days')
                        ->schema([

                            DateTimePicker::make('start_time')->label('Start Date')->required(),
    
                            DateTimePicker::make('end_time')->label('End Date'),
    
                            Toggle::make('repeated')->default(false)->label('Repeated'),
        
                            TextInput::make('repeated_type')
                                ->label('Repeated Type')
                                ->required(fn ($get) => $get('repeated')) // Required if repeated is on
                                ->visible(fn ($get) => $get('repeated')) // Show only if repeated is on
                                ->maxLength(255),
                        ]),
                    Wizard\Step::make('Status & Sponsors')
                        ->icon('heroicon-m-face-smile')
                        ->schema([
                            Select::make('status')
                                ->options([
                                    'active' => 'Active',
                                    'inactive' => 'Inactive',
                                    'pending' => 'Pending',
                                    'suspended' => 'Suspended',
                                    'banned' => 'Banned',
                                    'cancelled' => 'Cancelled',
                                ])
                                ->searchable()
                                ->required(),

                            Select::make('sponsors')
                                ->multiple()
                                ->relationship('sponsors', 'name')
                                ->preload()
                                ->searchable()
                                ->required(),

                            Textarea::make('cancellation_reason.en')
                                ->label('Cancellation Reason (English)')
                                ->required(fn ($get) => $get('status') === 'cancelled')
                                ->visible(fn ($get) => $get('status') === 'cancelled'),

                            Textarea::make('cancellation_reason.ar')
                                ->label('Cancellation Reason (Arabic)')
                                ->required(fn ($get) => $get('status') === 'cancelled')
                                ->visible(fn ($get) => $get('status') === 'cancelled'),
                        ]),
                    Wizard\Step::make('Prices')
                        ->icon('heroicon-m-currency-dollar')
                        ->schema([

                            Repeater::make('prices')
                                ->label('Event Prices')
                                ->schema([
                                    Select::make('category')
                                        ->options([
                                            'VIP' => 'VIP',
                                            'Regular' => 'Regular',
                                            'Early Bird ' => 'Early Bird ',
                                            'Single-day' => 'Single-day',
                                            'multi-day' => 'multi-day',
                                            'Giveaway' => 'Giveaway',
                                        ])
                                        ->searchable()
                                        ->required(),
    
                                    TextInput::make('price_egyptian')->label('Egyption Price')->required(),
                                    TextInput::make('price_arab')->label('Arabian Price')->required(),
                                    TextInput::make('price_foreigner')->label('Foreigner Price')->required(),
                                ])->addable(),
                        ]),
                    Wizard\Step::make('Media')
                        ->icon('heroicon-m-camera')
                        ->schema([
                            SpatieMediaLibraryFileUpload::make('event_media')
                                ->collection('event_media')
                                ->multiple()
                                ->helperText('Upload multiple event media files.'),
                        ]),

                ])->columnSpan(2)->skippable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('title')->sortable()->searchable(),
                TextColumn::make('category.name')->label('Category')->sortable()->searchable(),
                TextColumn::make('place.name')->label('Place')->searchable()->sortable(),
                TextColumn::make('sponsors')
                    ->label('Sponsors')
                    ->formatStateUsing(fn ($record) => 
                        $record->sponsors->take(3)->pluck('name')->join(' - ') . ($record->sponsors->count() > 3 ? ' ...' : '')
                    )
                    ->sortable(),

                TextColumn::make('attendees_count')
                    ->label('Attendees')
                    ->counts('paymentItems')
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
