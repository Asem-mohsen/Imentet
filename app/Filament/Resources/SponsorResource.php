<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SponsorResource\Pages;
use App\Filament\Resources\SponsorResource\RelationManagers;
use App\Models\Membership;
use App\Models\Sponsor;
use Filament\Forms;
use Filament\Forms\Components\{TextInput, Textarea, Toggle, Select};
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SponsorResource extends Resource
{
    protected static ?string $model = Sponsor::class;
    protected static ?string $navigationIcon = 'heroicon-o-gift-top';
    protected static ?string $navigationGroup = 'Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('contact_person')
                    ->required()
                    ->maxLength(255)
                    ->reactive(),
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                TextInput::make('phone')
                    ->tel()
                    ->maxLength(255),
                Textarea::make('address')
                    ->columnSpanFull(),

                Toggle::make('is_user')
                    ->label(fn ($get) => 'Create a user for ' . ($get('contact_person') ?? 'this sponsor'))
                    ->reactive(),

                Toggle::make('assign_membership')
                    ->label(fn ($get) => 'Assign Membership for ' . ($get('contact_person') ?? 'this sponsor'))
                    ->hidden(fn ($get) => !$get('is_user'))
                    ->reactive(),

                Select::make('membership_id')
                    ->label('Membership')
                    ->options(fn () => Membership::pluck('name', 'id'))
                    ->helperText('Recommended: Patron or Supporting plans for full features.')
                    ->hidden(fn ($get) => !$get('assign_membership')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('contact_person')
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('phone')
                    ->searchable(),
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
            'index' => Pages\ListSponsors::route('/'),
            'create' => Pages\CreateSponsor::route('/create'),
            'edit' => Pages\EditSponsor::route('/{record}/edit'),
        ];
    }
}
