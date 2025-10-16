<?php

namespace App\Filament\Resources\Courses;

use App\Filament\Resources\Courses\Pages\CreateCourse;
use App\Filament\Resources\Courses\Pages\EditCourse;
use App\Filament\Resources\Courses\Pages\ListCourses;
use App\Filament\Resources\Courses\Pages\ViewCourse;
use App\Filament\Resources\Courses\Schemas\CourseForm;
use App\Filament\Resources\Courses\Schemas\CourseInfolist;
use App\Filament\Resources\Courses\Tables\CoursesTable;
use App\Models\Course;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Components\RichEditor;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'course';

    public static function form(Schema $schema): Schema
    {
      return $schema->schema([
        Forms\Components\TextInput::make('title')->required(),
        Forms\Components\RichEditor::make('description'),
        Forms\Components\DatePicker::make('start_date')->required(),
        Forms\Components\DatePicker::make('end_date'),
        Forms\Components\Select::make('school_id')
            ->relationship('school', 'name')
            ->required(),
      ]);
        // return CourseForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CourseInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CoursesTable::configure($table);
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
            'index' => ListCourses::route('/'),
            'create' => CreateCourse::route('/create'),
            'view' => ViewCourse::route('/{record}'),
            'edit' => EditCourse::route('/{record}/edit'),
        ];
    }
}
