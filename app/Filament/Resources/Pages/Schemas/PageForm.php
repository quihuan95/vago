<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(['default' => 1, 'lg' => 3])
                    ->components([
                        Tabs::make('Nội dung')
                            ->columnSpan(['default' => 1, 'lg' => 2])
                            ->tabs([
                                Tab::make('Tiếng Việt')
                                    ->components([
                                        TextInput::make('title_vi')
                                            ->label('Tiêu đề (VI)')
                                            ->required()
                                            ->maxLength(255)
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn (?string $state, callable $set) => $set('slug_vi', $state ? Str::slug($state) : null))
                                            ->columnSpanFull(),
                                        TextInput::make('slug_vi')
                                            ->label('Đường dẫn (VI)')
                                            ->required()
                                            ->maxLength(255)
                                            ->unique(ignoreRecord: true)
                                            ->columnSpanFull(),
                                        Textarea::make('excerpt_vi')
                                            ->label('Mô tả ngắn (VI)')
                                            ->rows(3)
                                            ->columnSpanFull(),
                                        RichEditor::make('content_vi')
                                            ->label('Nội dung (VI)')
                                            ->columnSpanFull(),
                                        TextInput::make('seo_title_vi')
                                            ->label('SEO Title (VI)')
                                            ->maxLength(255)
                                            ->columnSpanFull(),
                                        Textarea::make('seo_description_vi')
                                            ->label('SEO Description (VI)')
                                            ->rows(2)
                                            ->columnSpanFull(),
                                    ]),
                                Tab::make('English')
                                    ->components([
                                        TextInput::make('title_en')
                                            ->label('Title (EN)')
                                            ->maxLength(255)
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn (?string $state, callable $set) => $set('slug_en', $state ? Str::slug($state) : null))
                                            ->columnSpanFull(),
                                        TextInput::make('slug_en')
                                            ->label('Slug (EN)')
                                            ->maxLength(255)
                                            ->unique(ignoreRecord: true)
                                            ->columnSpanFull(),
                                        Textarea::make('excerpt_en')
                                            ->label('Excerpt (EN)')
                                            ->rows(3)
                                            ->columnSpanFull(),
                                        RichEditor::make('content_en')
                                            ->label('Content (EN)')
                                            ->columnSpanFull(),
                                        TextInput::make('seo_title_en')
                                            ->label('SEO Title (EN)')
                                            ->maxLength(255)
                                            ->columnSpanFull(),
                                        Textarea::make('seo_description_en')
                                            ->label('SEO Description (EN)')
                                            ->rows(2)
                                            ->columnSpanFull(),
                                    ]),
                            ]),
                        Grid::make(1)
                            ->columnSpan(['default' => 1, 'lg' => 1])
                            ->components([
                                Section::make('Xuất bản')
                                    ->components([
                                        Select::make('type')
                                            ->label('Loại trang')
                                            ->options([
                                                'static' => 'Trang tĩnh',
                                                'landing' => 'Trang giới thiệu',
                                                'system' => 'Trang hệ thống',
                                            ])
                                            ->default('static')
                                            ->required()
                                            ->native(false),
                                        Select::make('parent_id')
                                            ->label('Trang cha')
                                            ->relationship('parent', 'title_vi')
                                            ->searchable()
                                            ->preload(),
                                        Select::make('status')
                                            ->label('Trạng thái')
                                            ->options([
                                                'draft' => 'Bản nháp',
                                                'published' => 'Đã xuất bản',
                                            ])
                                            ->default('draft')
                                            ->required()
                                            ->native(false),
                                        DateTimePicker::make('published_at')
                                            ->label('Ngày xuất bản')
                                            ->native(false),
                                        TextInput::make('sort_order')
                                            ->label('Thứ tự')
                                            ->numeric()
                                            ->default(0),
                                    ]),
                                Section::make('Hình ảnh')
                                    ->components([
                                        FileUpload::make('featured_image')
                                            ->label('Ảnh đại diện')
                                            ->image()
                                            ->disk('public')
                                            ->directory('pages')
                                            ->imageEditor(),
                                        FileUpload::make('og_image')
                                            ->label('Ảnh chia sẻ (OG)')
                                            ->image()
                                            ->disk('public')
                                            ->directory('pages/og'),
                                    ]),
                            ]),
                    ]),
            ]);
    }
}
