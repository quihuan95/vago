<?php

namespace App\Filament\Resources\BoardMembers\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BoardMemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Thông tin cá nhân')
                    ->columns(2)
                    ->components([
                        TextInput::make('name_vi')
                            ->label('Họ tên (VI)')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('name_en')
                            ->label('Họ tên (EN)')
                            ->maxLength(255),
                        TextInput::make('position_vi')
                            ->label('Chức vụ (VI)')
                            ->maxLength(255),
                        TextInput::make('position_en')
                            ->label('Chức vụ (EN)')
                            ->maxLength(255),
                        TextInput::make('title_vi')
                            ->label('Học hàm/Học vị (VI)')
                            ->maxLength(255),
                        TextInput::make('title_en')
                            ->label('Học hàm/Học vị (EN)')
                            ->maxLength(255),
                        TextInput::make('organization_vi')
                            ->label('Đơn vị công tác (VI)')
                            ->maxLength(255),
                        TextInput::make('organization_en')
                            ->label('Đơn vị công tác (EN)')
                            ->maxLength(255),
                        TextInput::make('term')
                            ->label('Nhiệm kỳ')
                            ->maxLength(255)
                            ->placeholder('VD: 2023 - 2028'),
                    ]),
                Section::make('Tiểu sử')
                    ->components([
                        RichEditor::make('bio_vi')
                            ->label('Tiểu sử (VI)'),
                        RichEditor::make('bio_en')
                            ->label('Tiểu sử (EN)'),
                    ]),
                Section::make('Ảnh & hiển thị')
                    ->columns(3)
                    ->components([
                        FileUpload::make('photo')
                            ->label('Ảnh đại diện')
                            ->image()
                            ->disk('public')
                            ->directory('board-members')
                            ->imageEditor()
                            ->columnSpanFull(),
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
