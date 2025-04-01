<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\Role;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Pages\Page;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('first_name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('last_name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->required()
                    ->maxLength(255)
                    ->email()
                    ->unique(table: 'users', column: 'email', ignoreRecord: true),

                TextInput::make('password')
                    ->password()
                    ->revealable()
                    ->maxLength(255)
                    ->required(fn (Page $livewire) => $livewire instanceof \Filament\Resources\Pages\CreateRecord)
                    ->dehydrateStateUsing(fn ($state) => filled($state) ? Hash::make($state) : null)
                    ->dehydrated(fn ($state) => filled($state)),

                Select::make('status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                        'pending' => 'Pending',
                        'suspended' => 'Suspended',
                        'banned' => 'Banned',
                    ])
                    ->searchable()
                    ->required(),
                

                Select::make('role')
                    ->relationship('role', 'name')
                    ->options(Role::pluck('name', 'id')->toArray()) 
                    ->searchable()
                    ->required(),


                    Fieldset::make('More Information')
                        ->schema([
                            Textarea::make('address')->required()->columnSpan(2),
                            DatePicker::make('dob')->required(),
                            Toggle::make('is_admin')
                                ->onColor('success')
                                ->offColor('danger')
                                ->inline(false)
                                ->default(false)
                                ->required(),
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->sortable(),
                TextColumn::make('full_name')
                    ->sortable(['first_name', 'last_name'])
                    ->searchable(['first_name', 'last_name']),
                TextColumn::make('email')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('role.name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'inactive' => 'danger',
                        'banned' => 'danger',
                        'suspended' => 'secondary',
                        'pending' => 'warning',
                    }),
                IconColumn::make('is_admin')
                    ->boolean()
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Filter::make('is_admin')->query(fn (Builder $query) => $query->where('is_admin', true)),
                SelectFilter::make('status')
                    ->options([
                        'active' => 'success',
                        'inactive' => 'danger',
                        'banned' => 'danger',
                        'suspended' => 'secondary',
                        'pending' => 'warning',
                    ]),
                SelectFilter::make('role_id')
                    ->label('Role')
                    ->relationship('role', 'name')
                    ->options([
                        'Master Admin' => 'Master Admin',
                        'Strategic Admin' => 'Strategic Admin',
                        'Operations' => 'Operations',
                        'Customer Service' => 'Customer Service',
                        'Regular User' => 'Regular User',
                    ])
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
