<?php

namespace App\Filament\Resources\Experiences;

use App\Filament\Resources\Experiences\Pages\CreateExperience;
use App\Filament\Resources\Experiences\Pages\EditExperience;
use App\Filament\Resources\Experiences\Pages\ListExperiences;
use App\Filament\Resources\Experiences\Pages\ViewExperience;
use App\Filament\Resources\Experiences\Schemas\ExperienceForm;
use App\Filament\Resources\Experiences\Schemas\ExperienceInfolist;
use App\Filament\Resources\Experiences\Tables\ExperiencesTable;
use App\Models\Experience;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Forms\Components\RichEditor;
use LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable;


class ExperienceResource extends Resource
{
    use Translatable;

    protected static ?string $model = Experience::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
      return $schema->schema([
          Forms\Components\DatePicker::make('start_date')->required(),
          Forms\Components\DatePicker::make('end_date'),
          Forms\Components\TextInput::make('position')->required(),
          Forms\Components\RichEditor::make('description'),
          Forms\Components\TextInput::make('location'),
          Forms\Components\Select::make('company_id')
              ->relationship('company', 'name')
              ->required(),
      ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ExperienceInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
      return $table->columns([
          Tables\Columns\TextColumn::make('title')->sortable()->searchable(),
          Tables\Columns\TextColumn::make('company.name'),
          Tables\Columns\TextColumn::make('start_date')->date(),
          Tables\Columns\TextColumn::make('end_date')->date(),
          Tables\Columns\TextColumn::make('location'),
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
            'index' => ListExperiences::route('/'),
            'create' => CreateExperience::route('/create'),
            'view' => ViewExperience::route('/{record}'),
            'edit' => EditExperience::route('/{record}/edit'),
        ];
    }
}
