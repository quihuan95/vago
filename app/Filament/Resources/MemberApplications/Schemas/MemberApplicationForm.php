<?php

namespace App\Filament\Resources\MemberApplications\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MemberApplicationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(['default' => 1, 'lg' => 3])
                    ->components([
                        Grid::make(1)
                            ->columnSpan(['default' => 1, 'lg' => 2])
                            ->components([
                                Section::make('Thông tin cá nhân')
                                    ->columns(2)
                                    ->components([
                                        TextInput::make('full_name')
                                            ->label('Họ và tên')
                                            ->required()
                                            ->maxLength(255),
                                        DatePicker::make('date_of_birth')
                                            ->label('Ngày sinh')
                                            ->native(false),
                                        Select::make('gender')
                                            ->label('Giới tính')
                                            ->options([
                                                'male' => 'Nam',
                                                'female' => 'Nữ',
                                                'other' => 'Khác',
                                            ])
                                            ->native(false),
                                        TextInput::make('academic_title')
                                            ->label('Học hàm/Học vị')
                                            ->maxLength(255),
                                        TextInput::make('specialty')
                                            ->label('Chuyên ngành')
                                            ->maxLength(255),
                                        TextInput::make('organization')
                                            ->label('Đơn vị công tác')
                                            ->maxLength(255),
                                        TextInput::make('job_title')
                                            ->label('Chức danh')
                                            ->maxLength(255),
                                        Select::make('member_type')
                                            ->label('Loại hội viên')
                                            ->options([
                                                'individual' => 'Cá nhân',
                                                'organization' => 'Tổ chức',
                                                'honorary' => 'Danh dự',
                                            ])
                                            ->native(false),
                                    ]),
                                Section::make('Thông tin liên hệ')
                                    ->columns(2)
                                    ->components([
                                        TextInput::make('phone')
                                            ->label('Số điện thoại')
                                            ->tel()
                                            ->maxLength(255),
                                        TextInput::make('email')
                                            ->label('Email')
                                            ->email()
                                            ->required()
                                            ->maxLength(255),
                                        TextInput::make('province')
                                            ->label('Tỉnh/Thành phố')
                                            ->maxLength(255),
                                        TextInput::make('address')
                                            ->label('Địa chỉ')
                                            ->maxLength(255)
                                            ->columnSpanFull(),
                                    ]),
                                Section::make('Tệp đính kèm & thông tin bổ sung')
                                    ->components([
                                        FileUpload::make('attachment')
                                            ->label('Tệp đính kèm')
                                            ->disk('public')
                                            ->directory('member-applications')
                                            ->downloadable()
                                            ->openable(),
                                        KeyValue::make('extra_fields')
                                            ->label('Thông tin bổ sung')
                                            ->disabled(),
                                    ]),
                            ]),
                        Grid::make(1)
                            ->columnSpan(['default' => 1, 'lg' => 1])
                            ->components([
                                Section::make('Xử lý hồ sơ')
                                    ->components([
                                        Select::make('status')
                                            ->label('Trạng thái')
                                            ->options([
                                                'new' => 'Mới',
                                                'reviewing' => 'Đang xét duyệt',
                                                'approved' => 'Đã duyệt',
                                                'rejected' => 'Từ chối',
                                            ])
                                            ->default('new')
                                            ->required()
                                            ->native(false),
                                        Textarea::make('notes')
                                            ->label('Ghi chú xử lý')
                                            ->rows(4),
                                    ]),
                                Section::make('Thông tin gửi đơn')
                                    ->components([
                                        TextInput::make('ip_address')
                                            ->label('Địa chỉ IP')
                                            ->disabled(),
                                    ]),
                            ]),
                    ]),
            ]);
    }
}
