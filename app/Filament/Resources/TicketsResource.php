<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TicketsResource\Pages;
use App\Filament\Resources\TicketsResource\RelationManagers;
use App\Models\UserTicket;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TicketsResource extends Resource
{
    protected static ?string $model = UserTicket::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    protected static ?string $navigationGroup = 'Tickets';
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('user.fullName')->label('User Name'),
                TextInput::make('visitTicket.ticket_type')->label('Ticket Type'),
                TextInput::make('visitTicket.price')->label('Price'),
                TextInput::make('visitTicket.place.name')->label('Place'),
                TextInput::make('visit_date')->label('Visit Date'),
                TextInput::make('status')->label('Status'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.fullName')->label('User Name'),
                TextColumn::make('visitTicket.ticket_type')->label('Ticket Type'),
                TextColumn::make('visitTicket.price')->label('Price'),
                TextColumn::make('visitTicket.place.name')->label('Place'),
                DateTimePicker::make('visit_date')->label('Visit Date')->dateTime('d-m-Y H:i'),
                TextColumn::make('status')->label('Status')->badge(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
            'index' => Pages\ListTickets::route('/'),
            // 'create' => Pages\CreateTickets::route('/create'),
            // 'edit' => Pages\EditTickets::route('/{record}/edit'),
            'view' => Pages\ViewTickets::route('/{record}'),
        ];
    }
}
