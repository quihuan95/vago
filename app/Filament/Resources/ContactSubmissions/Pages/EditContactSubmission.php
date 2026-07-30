<?php

namespace App\Filament\Resources\ContactSubmissions\Pages;

use App\Filament\Resources\ContactSubmissions\ContactSubmissionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditContactSubmission extends EditRecord
{
    protected static string $resource = ContactSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (($data['status'] ?? null) === 'done' && blank($data['handled_at'] ?? null)) {
            $data['handled_at'] = now();
        }

        return $data;
    }
}
