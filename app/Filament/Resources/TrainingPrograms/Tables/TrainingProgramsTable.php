<?php

namespace App\Filament\Resources\TrainingPrograms\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class TrainingProgramsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('featured_image')
                    ->label('Ảnh')
                    ->disk('public')
                    ->square(),
                TextColumn::make('title_vi')
                    ->label('Tiêu đề')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                TextColumn::make('starts_at')
                    ->label('Bắt đầu')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                TextColumn::make('program_status')
                    ->label('Tiến trình')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'upcoming' => 'info',
                        'ongoing' => 'warning',
                        'finished' => 'gray',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'upcoming' => 'Sắp diễn ra',
                        'ongoing' => 'Đang diễn ra',
                        'finished' => 'Đã kết thúc',
                        default => $state,
                    }),
                TextColumn::make('status')
                    ->label('Hiển thị')
                    ->badge()
                    ->color(fn (string $state): string => $state === 'published' ? 'success' : 'gray')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'published' => 'Đã xuất bản',
                        'draft' => 'Bản nháp',
                        default => $state,
                    }),
                TextColumn::make('sort_order')
                    ->label('Thứ tự')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('program_status')
                    ->label('Tiến trình')
                    ->options([
                        'upcoming' => 'Sắp diễn ra',
                        'ongoing' => 'Đang diễn ra',
                        'finished' => 'Đã kết thúc',
                    ]),
                SelectFilter::make('status')
                    ->label('Hiển thị')
                    ->options([
                        'draft' => 'Bản nháp',
                        'published' => 'Đã xuất bản',
                    ]),
            ])
            ->defaultSort('starts_at', 'desc')
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
