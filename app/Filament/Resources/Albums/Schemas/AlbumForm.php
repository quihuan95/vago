<?php

namespace App\Filament\Resources\Albums\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class AlbumForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Thông tin album')
                    ->columns(2)
                    ->components([
                        TextInput::make('title_vi')
                            ->label('Tiêu đề (VI)')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (?string $state, callable $set) => $set('slug_vi', $state ? Str::slug($state) : null)),
                        TextInput::make('title_en')
                            ->label('Tiêu đề (EN)')
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (?string $state, callable $set) => $set('slug_en', $state ? Str::slug($state) : null)),
                        TextInput::make('slug_vi')
                            ->label('Đường dẫn (VI)')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        TextInput::make('slug_en')
                            ->label('Đường dẫn (EN)')
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Textarea::make('description_vi')
                            ->label('Mô tả (VI)')
                            ->rows(3),
                        Textarea::make('description_en')
                            ->label('Mô tả (EN)')
                            ->rows(3),
                    ]),
                Section::make('Xuất bản')
                    ->columns(3)
                    ->components([
                        FileUpload::make('cover_image')
                            ->label('Ảnh bìa')
                            ->image()
                            ->disk('public')
                            ->directory('albums')
                            ->imageEditor()
                            ->columnSpanFull(),
                        DatePicker::make('event_date')
                            ->label('Ngày sự kiện')
                            ->native(false),
                        Select::make('status')
                            ->label('Trạng thái')
                            ->options([
                                'draft' => 'Bản nháp',
                                'published' => 'Đã xuất bản',
                            ])
                            ->default('draft')
                            ->required()
                            ->native(false),
                        TextInput::make('sort_order')
                            ->label('Thứ tự')
                            ->numeric()
                            ->default(0),
                    ]),
                Section::make('SEO')
                    ->columns(2)
                    ->collapsed()
                    ->components([
                        TextInput::make('seo_title_vi')
                            ->label('SEO Title (VI)')
                            ->maxLength(255),
                        TextInput::make('seo_title_en')
                            ->label('SEO Title (EN)')
                            ->maxLength(255),
                        Textarea::make('seo_description_vi')
                            ->label('SEO Description (VI)')
                            ->rows(2),
                        Textarea::make('seo_description_en')
                            ->label('SEO Description (EN)')
                            ->rows(2),
                    ]),
            ]);
    }
}
