<?php

namespace App\Filament\Resources\VisionResource\Pages;

use App\Events\VisionCreated;
use App\Filament\Resources\VisionResource;
use App\Models\Vision;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Log;

class CreateVision extends CreateRecord
{
    protected static string $resource = VisionResource::class;

    protected function afterCreate(): void
    {
        /** @var Vision|null $vision */
        $vision = $this->record;

        if (!$vision) {
            return;
        }

        event(new VisionCreated($vision));
    }
}
