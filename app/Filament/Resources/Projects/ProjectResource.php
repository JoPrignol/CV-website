<?php

namespace App\Filament\Resources\Projects;

use App\Filament\Resources\Projects\Pages\CreateProject;
use App\Filament\Resources\Projects\Pages\EditProject;
use App\Filament\Resources\Projects\Pages\ListProjects;
use App\Filament\Resources\Projects\Pages\ViewProject;
use App\Filament\Resources\Projects\Schemas\ProjectForm;
use App\Filament\Resources\Projects\Schemas\ProjectInfolist;
use App\Filament\Resources\Projects\Tables\ProjectsTable;
use App\Models\Project;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Forms\Components;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable;

class ProjectResource extends Resource
{
    use Translatable;

    protected static ?string $model = Project::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Project';

    public static function form(Schema $schema): Schema
    {
        // return ProjectForm::configure($schema);
        return $schema->schema([
          Forms\Components\TextInput::make('name')
            ->required(),

          Forms\Components\RichEditor::make('description')
            ->nullable(),

          Forms\Components\TextInput::make('url')
            ->url()
            ->nullable(),

          Forms\Components\FileUpload::make('main_image')
            ->image()
            ->directory('projects/main_image'),
            // ->required(),

          Forms\Components\FileUpload::make('secondary_images')
            ->image()
            ->multiple()
            ->maxFiles(10)
            ->directory('projects/secondary_images'),

          Forms\Components\Select::make('tags')
            ->multiple()
            ->relationship('tags', 'name')
            ->preload()
            ->searchable()
            ->required(),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ProjectInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProjectsTable::configure($table);
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
            'index' => ListProjects::route('/'),
            'create' => CreateProject::route('/create'),
            'view' => ViewProject::route('/{record}'),
            'edit' => EditProject::route('/{record}/edit'),
        ];
    }
}
