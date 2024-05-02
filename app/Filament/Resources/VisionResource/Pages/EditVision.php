<?php

namespace App\Filament\Resources\VisionResource\Pages;

use App\Filament\Resources\VisionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVision extends EditRecord
{
    protected static string $resource = VisionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
