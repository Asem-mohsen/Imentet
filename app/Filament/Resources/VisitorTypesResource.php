<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VisitorTypesResource\Pages;
use App\Filament\Resources\VisitorTypesResource\RelationManagers;
use App\Models\VisitorType;
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

class VisitorTypesResource extends Resource
{
    protected static ?string $model = VisitorType::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationGroup = 'Management';

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
                                    ->label('Visitor Type (English)')
                                    ->maxLength(255)
                                ]),
                        Tabs\Tab::make('Arabic')
                            ->schema([
                                TextInput::make('name.ar')
                                    ->required()
                                    ->label('Visitor Type (Arabic)')
                                    ->maxLength(255),
                                ]),
                    ])->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('created_at')->sortable()->searchable()->date(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
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
            'index' => Pages\ListVisitorTypes::route('/'),
            // 'create' => Pages\CreateVisitorTypes::route('/create'),
            // 'edit' => Pages\EditVisitorTypes::route('/{record}/edit'),
        ];
    }
}
