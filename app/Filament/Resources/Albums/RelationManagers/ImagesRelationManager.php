<?php

namespace App\Filament\Resources\Albums\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ImagesRelationManager extends RelationManager
{
    protected static string $relationship = 'images';

    protected static ?string $title = 'Hình ảnh';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('image_path')
                    ->label('Hình ảnh')
                    ->image()
                    ->required()
                    ->disk('public')
                    ->directory('albums/images')
                    ->imageEditor()
                    ->columnSpanFull(),
                TextInput::make('alt_vi')
                    ->label('Mô tả ảnh (VI)')
                    ->maxLength(255),
                TextInput::make('alt_en')
                    ->label('Mô tả ảnh (EN)')
                    ->maxLength(255),
                TextInput::make('caption_vi')
                    ->label('Chú thích (VI)')
                    ->maxLength(255),
                TextInput::make('caption_en')
                    ->label('Chú thích (EN)')
                    ->maxLength(255),
                TextInput::make('sort_order')
                    ->label('Thứ tự')
                    ->numeric()
                    ->default(0),
                Toggle::make('is_cover')
                    ->label('Ảnh bìa')
                    ->default(false),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('caption_vi')
            ->columns([
                ImageColumn::make('image_path')
                    ->label('Hình ảnh')
                    ->disk('public')
                    ->square(),
                TextColumn::make('caption_vi')
                    ->label('Chú thích')
                    ->limit(40),
                TextColumn::make('sort_order')
                    ->label('Thứ tự')
                    ->sortable(),
                IconColumn::make('is_cover')
                    ->label('Ảnh bìa')
                    ->boolean(),
            ])
            ->defaultSort('sort_order')
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
