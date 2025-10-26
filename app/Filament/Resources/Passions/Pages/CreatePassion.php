<?php

namespace App\Filament\Resources\Passions\Pages;

use App\Filament\Resources\Passions\PassionResource;
use Filament\Resources\Pages\CreateRecord;
use LaraZeus\SpatieTranslatable\Resources\Pages\CreateRecord\Concerns\Translatable;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;

class CreatePassion extends CreateRecord
{
    use Translatable;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
        ];
    }

    protected static string $resource = PassionResource::class;
}
