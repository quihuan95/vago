<?php

namespace App\Filament\Resources\BoardMembers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class BoardMembersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')
                    ->label('Ảnh')
                    ->disk('public')
                    ->circular(),
                TextColumn::make('name_vi')
                    ->label('Họ tên')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('position_vi')
                    ->label('Chức vụ')
                    ->searchable(),
                TextColumn::make('term')
                    ->label('Nhiệm kỳ'),
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
