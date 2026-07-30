<?php

namespace App\Filament\Resources\TrainingPrograms\Schemas;

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

class TrainingProgramForm
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
                                        TextInput::make('location_vi')
                                            ->label('Địa điểm (VI)')
                                            ->maxLength(255),
                                        TextInput::make('organizer_vi')
                                            ->label('Đơn vị tổ chức (VI)')
                                            ->maxLength(255),
                                        TextInput::make('format_vi')
                                            ->label('Hình thức (VI)')
                                            ->maxLength(255)
                                            ->placeholder('VD: Trực tiếp / Trực tuyến'),
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
                                        TextInput::make('location_en')
                                            ->label('Location (EN)')
                                            ->maxLength(255),
                                        TextInput::make('organizer_en')
                                            ->label('Organizer (EN)')
                                            ->maxLength(255),
                                        TextInput::make('format_en')
                                            ->label('Format (EN)')
                                            ->maxLength(255),
                                    ]),
                            ]),
                        Grid::make(1)
                            ->columnSpan(['default' => 1, 'lg' => 1])
                            ->components([
                                Section::make('Thời gian & trạng thái')
                                    ->components([
                                        DateTimePicker::make('starts_at')
                                            ->label('Thời gian bắt đầu')
                                            ->native(false),
                                        DateTimePicker::make('ends_at')
                                            ->label('Thời gian kết thúc')
                                            ->native(false),
                                        Select::make('program_status')
                                            ->label('Trạng thái chương trình')
                                            ->options([
                                                'upcoming' => 'Sắp diễn ra',
                                                'ongoing' => 'Đang diễn ra',
                                                'finished' => 'Đã kết thúc',
                                            ])
                                            ->default('upcoming')
                                            ->required()
                                            ->native(false),
                                        Select::make('status')
                                            ->label('Trạng thái hiển thị')
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
                                Section::make('Đăng ký & tài liệu')
                                    ->components([
                                        TextInput::make('registration_url')
                                            ->label('Link đăng ký')
                                            ->url()
                                            ->maxLength(255),
                                        FileUpload::make('featured_image')
                                            ->label('Ảnh đại diện')
                                            ->image()
                                            ->disk('public')
                                            ->directory('training-programs')
                                            ->imageEditor(),
                                        FileUpload::make('attachment')
                                            ->label('Tệp đính kèm')
                                            ->disk('public')
                                            ->directory('training-programs/attachments'),
                                    ]),
                            ]),
                    ]),
            ]);
    }
}
