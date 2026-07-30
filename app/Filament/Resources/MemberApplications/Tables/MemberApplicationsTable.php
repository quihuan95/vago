<?php

namespace App\Filament\Resources\MemberApplications\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class MemberApplicationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('full_name')
                    ->label('Họ và tên')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                TextColumn::make('phone')
                    ->label('Điện thoại')
                    ->searchable(),
                TextColumn::make('organization')
                    ->label('Đơn vị')
                    ->toggleable(),
                TextColumn::make('member_type')
                    ->label('Loại hội viên')
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'individual' => 'Cá nhân',
                        'organization' => 'Tổ chức',
                        'honorary' => 'Danh dự',
                        default => $state ?? '-',
                    }),
                TextColumn::make('status')
                    ->label('Trạng thái')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'info',
                        'reviewing' => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'new' => 'Mới',
                        'reviewing' => 'Đang xét duyệt',
                        'approved' => 'Đã duyệt',
                        'rejected' => 'Từ chối',
                        default => $state,
                    }),
                TextColumn::make('created_at')
                    ->label('Ngày gửi')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Trạng thái')
                    ->options([
                        'new' => 'Mới',
                        'reviewing' => 'Đang xét duyệt',
                        'approved' => 'Đã duyệt',
                        'rejected' => 'Từ chối',
                    ]),
                SelectFilter::make('member_type')
                    ->label('Loại hội viên')
                    ->options([
                        'individual' => 'Cá nhân',
                        'organization' => 'Tổ chức',
                        'honorary' => 'Danh dự',
                    ]),
            ])
            ->defaultSort('created_at', 'desc')
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
