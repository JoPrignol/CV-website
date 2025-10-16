<?php

namespace App\Filament\Resources\Users;

use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Filament\Resources\Users\Pages\ViewUser;
use App\Filament\Resources\Users\Schemas\UserForm;
use App\Filament\Resources\Users\Schemas\UserInfolist;
use App\Filament\Resources\Users\Tables\UsersTable;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Forms\Components;
use Filament\Forms\Components\RichEditor;


class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Users';

    public static function form(Schema $schema): Schema
    {
        // return UserForm::configure($schema);
        return $schema->schema([
          Forms\Components\TextInput::make('name')->required(),
          Forms\Components\TextInput::make('email')->required()->email(),
          Forms\Components\TextInput::make('first_name')->required()->nullable(),
          Forms\Components\TextInput::make('last_name')->required()->nullable(),
          Forms\Components\TextInput::make('phone_number')->tel()->nullable(),
          Forms\Components\RichEditor::make('bio')->nullable(),
          Forms\Components\TextInput::make('linkedin_url')->url()->nullable(),
          Forms\Components\TextInput::make('github_url')->url()->nullable(),
          Forms\Components\TextInput::make('position')->nullable(),
          Forms\Components\FileUpload::make('profile_pic')->image()->nullable(),
        ]);
    }

    // Fonction empêchant de créer plus d'un utilisateur
    public static function canCreate(): bool
    {
        return \App\Models\User::count() === 0;
    }

    public static function infolist(Schema $schema): Schema
    {
        return UserInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UsersTable::configure($table);
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
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'view' => ViewUser::route('/{record}'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }
}
