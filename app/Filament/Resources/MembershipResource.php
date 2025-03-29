<?php

namespace App\Filament\Resources;

use App\Enums\MembershipDuration;
use App\Filament\Resources\MembershipResource\Pages;
use App\Filament\Resources\MembershipResource\RelationManagers;
use App\Models\Membership;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MembershipResource extends Resource
{
    protected static ?string $model = Membership::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?string $navigationGroup = 'Memberships';

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
                                        ->label('Membership Name (English)')
                                        ->maxLength(255),

                                    Textarea::make('description.en')->label('Description (English)'),
                                    Textarea::make('title.en')->label('Title (English)'),

                                ]),
                        Tabs\Tab::make('Arabic')
                            ->schema([

                                    TextInput::make('name.ar')
                                        ->required()
                                        ->label('Membership Name (Arabic)')
                                        ->maxLength(255),
                                        

                                    Textarea::make('description.ar')->label('Description (Arabic)'),
                                    Textarea::make('title.ar')->label('Title (Arabic)'),
                                ]),
                    ]),
                Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('Features')
                        ->schema([

                            Select::make('features')
                                ->label('Select Features')
                                ->relationship('features', 'name')
                                ->preload()
                                ->searchable()
                                ->multiple()
                                ->required(),
                        ]),
                ]),

                Repeater::make('prices')
                    ->relationship('prices')
                    ->label('Visitor Pricing')
                    ->schema([
                        Select::make('duration')
                            ->label('Duration')
                            ->options(MembershipDuration::labels())
                            ->searchable()
                            ->required(),
                            
                        Select::make('visitor_type_id')
                            ->label('Visitor Type')
                            ->relationship('visitorType', 'name')
                            ->preload()
                            ->searchable()
                            ->required(),

                        TextInput::make('price')
                            ->label('Price (EGP)')
                            ->numeric()
                            ->required(),

                        TextInput::make('currency')
                            ->label('Currency')
                            ->default('EGP')
                            ->disabled(),
                    ])
                    ->columns(2)
                    ->columnSpan(2)
                    ->addable()
                    ->deletable()
                    ->required(),

                Tabs::make('Custom Duration')
                    ->tabs([
                        Tabs\Tab::make('Add Custom Duration')
                            ->schema([
                                TextInput::make('custom_duration.en')
                                    ->label('Duration (EN)')
                                    ->required(),
                                TextInput::make('custom_duration.ar')
                                    ->label('Duration (AR)')
                                    ->required(),
                            ])
                    ])
                    ->hidden(fn (Get $get) => !$get('show_custom_duration_tab')) 
                    ->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('durations.duration')->label('Duration')->sortable()->searchable(),
                TextColumn::make('features_count')->label('No. Features')->counts('features')->sortable(),
                TextColumn::make('users_count')->label('Subscribers')->counts('users')->sortable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn ($record) => $record->users_count === 0)
                    ->disabled(fn ($record) => $record->users_count > 0), 
                Tables\Actions\ForceDeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                    // Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListMemberships::route('/'),
            'create' => Pages\CreateMembership::route('/create'),
            'view' => Pages\ViewMembership::route('/{record}'),
            'edit' => Pages\EditMembership::route('/{record}/edit'),
        ];
    }
}
