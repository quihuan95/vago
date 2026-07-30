<?php

namespace App\Filament\Resources\Categories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name_vi')
                    ->label('Tên (VI)')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name_en')
                    ->label('Tên (EN)')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('type')
                    ->label('Loại')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'post' => 'Bài viết',
                        'training' => 'Đào tạo',
                        'album' => 'Thư viện ảnh',
                        'page' => 'Trang nội dung',
                        default => $state,
                    }),
                TextColumn::make('sort_order')
                    ->label('Thứ tự')
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Trạng thái')
                    ->badge()
                    ->color(fn (string $state): string => $state === 'published' ? 'success' : 'gray')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'published' => 'Đã xuất bản',
                        'draft' => 'Bản nháp',
                        default => $state,
                    }),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->label('Loại')
                    ->options([
                        'post' => 'Bài viết',
                        'training' => 'Đào tạo',
                        'album' => 'Thư viện ảnh',
                        'page' => 'Trang nội dung',
                    ]),
                SelectFilter::make('status')
                    ->label('Trạng thái')
                    ->options([
                        'draft' => 'Bản nháp',
                        'published' => 'Đã xuất bản',
                    ]),
            ])
            ->defaultSort('sort_order')
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
