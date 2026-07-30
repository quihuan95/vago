<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class ManageSettings extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static string|UnitEnum|null $navigationGroup = 'Hệ thống';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Cấu hình hệ thống';

    protected static ?string $title = 'Cấu hình hệ thống';

    protected string $view = 'filament.pages.manage-settings';

    /**
     * @var array<string, mixed>
     */
    public ?array $data = [];

    /**
     * @var array<int, string>
     */
    protected const SETTINGS_KEYS = [
        'site_name_vi', 'site_name_en',
        'logo', 'favicon',
        'contact_address_vi', 'contact_address_en',
        'contact_email', 'contact_phone',
        'office_hours_vi', 'office_hours_en',
        'vago2026_url', 'vago2026_open_new_tab',
        'journal_url', 'journal_open_new_tab',
        'facebook_url', 'youtube_url',
        'notification_email',
        'default_seo_title_vi', 'default_seo_title_en',
        'default_seo_description_vi', 'default_seo_description_en',
        'google_maps_embed',
    ];

    /**
     * @var array<int, string>
     */
    protected const BOOLEAN_KEYS = [
        'vago2026_open_new_tab',
        'journal_open_new_tab',
    ];

    public function mount(): void
    {
        $values = [];

        foreach (self::SETTINGS_KEYS as $key) {
            $isBoolean = in_array($key, self::BOOLEAN_KEYS, true);
            $value = Setting::getValue($key, $isBoolean ? false : null);

            $values[$key] = $isBoolean ? filter_var($value, FILTER_VALIDATE_BOOLEAN) : $value;
        }

        $this->form->fill($values);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Cấu hình')
                    ->columnSpanFull()
                    ->tabs([
                        Tab::make('Thông tin chung')
                            ->columns(2)
                            ->components([
                                TextInput::make('site_name_vi')
                                    ->label('Tên đơn vị (VI)')
                                    ->maxLength(255),
                                TextInput::make('site_name_en')
                                    ->label('Tên đơn vị (EN)')
                                    ->maxLength(255),
                                FileUpload::make('logo')
                                    ->label('Logo')
                                    ->image()
                                    ->disk('public')
                                    ->directory('settings'),
                                FileUpload::make('favicon')
                                    ->label('Favicon')
                                    ->image()
                                    ->disk('public')
                                    ->directory('settings'),
                            ]),
                        Tab::make('Liên hệ')
                            ->columns(2)
                            ->components([
                                Textarea::make('contact_address_vi')
                                    ->label('Địa chỉ (VI)')
                                    ->rows(2),
                                Textarea::make('contact_address_en')
                                    ->label('Địa chỉ (EN)')
                                    ->rows(2),
                                TextInput::make('contact_email')
                                    ->label('Email liên hệ')
                                    ->email()
                                    ->maxLength(255),
                                TextInput::make('contact_phone')
                                    ->label('Số điện thoại')
                                    ->tel()
                                    ->maxLength(255),
                                TextInput::make('office_hours_vi')
                                    ->label('Giờ làm việc (VI)')
                                    ->maxLength(255),
                                TextInput::make('office_hours_en')
                                    ->label('Giờ làm việc (EN)')
                                    ->maxLength(255),
                                TextInput::make('notification_email')
                                    ->label('Email nhận thông báo')
                                    ->email()
                                    ->maxLength(255)
                                    ->helperText('Email nhận thông báo khi có đơn liên hệ hoặc đăng ký hội viên mới.')
                                    ->columnSpanFull(),
                                Textarea::make('google_maps_embed')
                                    ->label('Mã nhúng Google Maps')
                                    ->rows(3)
                                    ->columnSpanFull(),
                            ]),
                        Tab::make('Liên kết & Mạng xã hội')
                            ->columns(2)
                            ->components([
                                TextInput::make('vago2026_url')
                                    ->label('Link VAGO 2026')
                                    ->url()
                                    ->maxLength(255),
                                Toggle::make('vago2026_open_new_tab')
                                    ->label('Mở VAGO 2026 ở tab mới'),
                                TextInput::make('journal_url')
                                    ->label('Link Tạp chí')
                                    ->url()
                                    ->maxLength(255),
                                Toggle::make('journal_open_new_tab')
                                    ->label('Mở Tạp chí ở tab mới'),
                                TextInput::make('facebook_url')
                                    ->label('Facebook')
                                    ->url()
                                    ->maxLength(255),
                                TextInput::make('youtube_url')
                                    ->label('YouTube')
                                    ->url()
                                    ->maxLength(255),
                            ]),
                        Tab::make('SEO mặc định')
                            ->columns(2)
                            ->components([
                                TextInput::make('default_seo_title_vi')
                                    ->label('SEO Title mặc định (VI)')
                                    ->maxLength(255),
                                TextInput::make('default_seo_title_en')
                                    ->label('SEO Title mặc định (EN)')
                                    ->maxLength(255),
                                Textarea::make('default_seo_description_vi')
                                    ->label('SEO Description mặc định (VI)')
                                    ->rows(3),
                                Textarea::make('default_seo_description_en')
                                    ->label('SEO Description mặc định (EN)')
                                    ->rows(3),
                            ]),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($data as $key => $value) {
            $isBoolean = in_array($key, self::BOOLEAN_KEYS, true);

            Setting::setValue(
                key: (string) $key,
                value: $isBoolean ? ($value ? '1' : '0') : $value,
                group: 'general',
                type: $isBoolean ? 'boolean' : 'string',
            );
        }

        Notification::make()
            ->title('Đã lưu cấu hình hệ thống')
            ->success()
            ->send();
    }
}
