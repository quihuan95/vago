<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Thông tin danh mục')
                    ->columns(2)
                    ->components([
                        TextInput::make('name_vi')
                            ->label('Tên danh mục (VI)')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (?string $state, callable $set) => $set('slug_vi', $state ? Str::slug($state) : null)),
                        TextInput::make('name_en')
                            ->label('Tên danh mục (EN)')
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
                    ]),
                Grid::make(3)
                    ->components([
                        Select::make('type')
                            ->label('Loại danh mục')
                            ->options([
                                'post' => 'Bài viết',
                                'training' => 'Đào tạo',
                                'album' => 'Thư viện ảnh',
                                'page' => 'Trang nội dung',
                            ])
                            ->default('post')
                            ->required()
                            ->native(false),
                        TextInput::make('sort_order')
                            ->label('Thứ tự')
                            ->numeric()
                            ->default(0),
                        Select::make('status')
                            ->label('Trạng thái')
                            ->options([
                                'draft' => 'Bản nháp',
                                'published' => 'Đã xuất bản',
                            ])
                            ->default('published')
                            ->required()
                            ->native(false),
                    ]),
            ]);
    }
}
