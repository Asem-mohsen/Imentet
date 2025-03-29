<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VisitTicketResource\Pages;
use App\Filament\Resources\VisitTicketResource\RelationManagers;
use App\Models\VisitTicket;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VisitTicketResource extends Resource
{
    protected static ?string $model = VisitTicket::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    protected static ?string $navigationGroup = 'Tickets';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tabs')
                ->tabs([
                    Tabs\Tab::make('English')
                        ->schema([

                                TextInput::make('ticket_type.en')
                                    ->label('Ticket Type (English)')
                                    ->unique(column: 'ticket_type->en')
                                    ->required(),

                                Textarea::make('location.en')->label('Location (English)')->columnSpanFull(),
                            ]),
                    Tabs\Tab::make('Arabic')
                        ->schema([

                                TextInput::make('ticket_type.ar')
                                    ->label('Ticket Type (Arabic)')
                                    ->unique(column: 'ticket_type->ar')
                                    ->required(),

                                Textarea::make('location.ar')->label('Location (Arabic)')->columnSpanFull(),
                            ]),

                    Tabs\Tab::make('More Information')
                        ->schema([
                            Select::make('place_id')
                                ->relationship('place', 'name')
                                ->preload()
                                ->searchable()
                                ->required(),

                            TextInput::make('price')
                                ->required()
                                ->numeric()
                                ->prefix('$'),
                            ]),
                ])->columnSpanFull(),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('ticket_type')->searchable(),
                TextColumn::make('place.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('price')
                    ->money()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
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
            'index' => Pages\ListVisitTickets::route('/'),
            // 'create' => Pages\CreateVisitTicket::route('/create'),
            // 'edit' => Pages\EditVisitTicket::route('/{record}/edit'),
        ];
    }
}
