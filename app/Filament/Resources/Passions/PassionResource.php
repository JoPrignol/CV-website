<?php

namespace App\Filament\Resources\Passions;

use App\Filament\Resources\Passions\Pages\CreatePassion;
use App\Filament\Resources\Passions\Pages\EditPassion;
use App\Filament\Resources\Passions\Pages\ListPassions;
use App\Filament\Resources\Passions\Pages\ViewPassion;
use App\Filament\Resources\Passions\Schemas\PassionForm;
use App\Filament\Resources\Passions\Schemas\PassionInfolist;
use App\Filament\Resources\Passions\Tables\PassionsTable;
use App\Models\Passion;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable;


class PassionResource extends Resource
{
    use Translatable;

    protected static ?string $model = Passion::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'passions';

    public static function form(Schema $schema): Schema
    {
        // return PassionForm::configure($schema);
        return $schema->schema([
          Forms\Components\TextInput::make('name')->required(),
          Forms\Components\RichEditor::make('description')->nullable(),
          Forms\Components\FileUpload::make('image')->disk('public')->image()->nullable(),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PassionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PassionsTable::configure($table);
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
            'index' => ListPassions::route('/'),
            'create' => CreatePassion::route('/create'),
            'view' => ViewPassion::route('/{record}'),
            'edit' => EditPassion::route('/{record}/edit'),
        ];
    }
}
