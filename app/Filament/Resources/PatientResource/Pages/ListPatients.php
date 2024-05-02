<?php

namespace App\Filament\Resources\PatientResource\Pages;

use App\Filament\Resources\PatientResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListPatients extends ListRecords
{
    protected static string $resource = PatientResource::class;

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(),
            'dogs' => Tab::make()->modifyQueryUsing(fn (Builder $query) => $query->where('type', 'dog')),
            'rabbits' => Tab::make()->modifyQueryUsing(fn (Builder $query) => $query->where('type', 'rabbit')),
            'cat' => Tab::make()->modifyQueryUsing(fn (Builder $query) => $query->where('type', 'cat')),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
