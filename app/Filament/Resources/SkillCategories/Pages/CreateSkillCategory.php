<?php

namespace App\Filament\Resources\SkillCategories\Pages;

use App\Filament\Resources\SkillCategories\SkillCategoryResource;
use Filament\Resources\Pages\CreateRecord;
use LaraZeus\SpatieTranslatable\Resources\Pages\CreateRecord\Concerns\Translatable;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;

class CreateSkillCategory extends CreateRecord
{
    use Translatable;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
        ];
    }

    protected static string $resource = SkillCategoryResource::class;
}
