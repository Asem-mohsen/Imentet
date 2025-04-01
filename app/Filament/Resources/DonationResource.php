<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DonationResource\Pages;
use App\Filament\Resources\DonationResource\RelationManagers;
use App\Models\Donation;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DonationResource extends Resource
{
    protected static ?string $model = Donation::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-currency-dollar';

    protected static ?string $navigationGroup = 'Others';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('place_id')
                    ->relationship('place', 'name')
                    ->required(),
                TextInput::make('donor_name')
                    ->maxLength(255)
                    ->default(null),
                TextInput::make('email')
                    ->email()
                    ->maxLength(255)
                    ->default(null),
                TextInput::make('amount')
                    ->required()
                    ->numeric(),
                TextInput::make('payment_method')
                    ->required()
                    ->maxLength(255),
                Textarea::make('message')->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('donor_name')->searchable(),
                TextColumn::make('place.name')->numeric()->sortable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('amount')->numeric()->sortable(),
                TextColumn::make('payment_method')->searchable(),
                TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListDonations::route('/'),
            'view' => Pages\ViewDonation::route('/{record}/view'),
            // 'create' => Pages\CreateDonation::route('/create'),
            // 'edit' => Pages\EditDonation::route('/{record}/edit'),
        ];
    }
}
