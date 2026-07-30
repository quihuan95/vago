<?php

namespace App\Filament\Resources\Banners\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BannerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Nội dung banner')
                    ->columns(2)
                    ->components([
                        TextInput::make('title_vi')
                            ->label('Tiêu đề (VI)')
                            ->maxLength(255),
                        TextInput::make('title_en')
                            ->label('Tiêu đề (EN)')
                            ->maxLength(255),
                        Textarea::make('description_vi')
                            ->label('Mô tả (VI)')
                            ->rows(3),
                        Textarea::make('description_en')
                            ->label('Mô tả (EN)')
                            ->rows(3),
                        TextInput::make('link_url')
                            ->label('Đường dẫn liên kết')
                            ->url()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Toggle::make('open_in_new_tab')
                            ->label('Mở tab mới')
                            ->default(false),
                    ]),
                Section::make('Hình ảnh')
                    ->columns(2)
                    ->components([
                        FileUpload::make('image_desktop')
                            ->label('Ảnh desktop')
                            ->image()
                            ->required()
                            ->disk('public')
                            ->directory('banners')
                            ->imageEditor(),
                        FileUpload::make('image_mobile')
                            ->label('Ảnh mobile')
                            ->image()
                            ->disk('public')
                            ->directory('banners')
                            ->imageEditor(),
                    ]),
                Grid::make(2)
                    ->components([
                        TextInput::make('sort_order')
                            ->label('Thứ tự')
                            ->numeric()
                            ->default(0),
                        Toggle::make('is_active')
                            ->label('Kích hoạt')
                            ->default(true),
                    ]),
            ]);
    }
}
