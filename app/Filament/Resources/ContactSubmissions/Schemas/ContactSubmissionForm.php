<?php

namespace App\Filament\Resources\ContactSubmissions\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactSubmissionForm
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
                                Section::make('Thông tin người gửi')
                                    ->columns(2)
                                    ->components([
                                        TextInput::make('full_name')
                                            ->label('Họ và tên')
                                            ->required()
                                            ->maxLength(255),
                                        TextInput::make('email')
                                            ->label('Email')
                                            ->email()
                                            ->required()
                                            ->maxLength(255),
                                        TextInput::make('phone')
                                            ->label('Số điện thoại')
                                            ->tel()
                                            ->maxLength(255),
                                        TextInput::make('address')
                                            ->label('Địa chỉ')
                                            ->maxLength(255),
                                        TextInput::make('subject')
                                            ->label('Tiêu đề')
                                            ->maxLength(255)
                                            ->columnSpanFull(),
                                    ]),
                                Section::make('Nội dung liên hệ')
                                    ->components([
                                        Textarea::make('message')
                                            ->label('Nội dung')
                                            ->rows(6)
                                            ->required(),
                                    ]),
                            ]),
                        Grid::make(1)
                            ->columnSpan(['default' => 1, 'lg' => 1])
                            ->components([
                                Section::make('Xử lý')
                                    ->components([
                                        Select::make('status')
                                            ->label('Trạng thái')
                                            ->options([
                                                'new' => 'Mới',
                                                'processing' => 'Đang xử lý',
                                                'done' => 'Đã xử lý',
                                            ])
                                            ->default('new')
                                            ->required()
                                            ->native(false),
                                        DateTimePicker::make('handled_at')
                                            ->label('Thời gian xử lý')
                                            ->native(false),
                                    ]),
                                Section::make('Thông tin gửi')
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
