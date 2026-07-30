<?php

namespace App\Filament\Resources\Banners\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class BannersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_desktop')
                    ->label('Ảnh')
                    ->disk('public'),
                TextColumn::make('title_vi')
                    ->label('Tiêu đề')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('link_url')
                    ->label('Liên kết')
                    ->limit(40)
                    ->toggleable(),
                TextColumn::make('sort_order')
                    ->label('Thứ tự')
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label('Kích hoạt')
                    ->boolean(),
            ])
            ->filters([
                SelectFilter::make('is_active')
                    ->label('Trạng thái')
                    ->options([
                        '1' => 'Kích hoạt',
                        '0' => 'Tắt',
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
