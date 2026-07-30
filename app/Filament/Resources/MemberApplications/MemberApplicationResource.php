<?php

namespace App\Filament\Resources\MemberApplications;

use App\Filament\Resources\MemberApplications\Pages\EditMemberApplication;
use App\Filament\Resources\MemberApplications\Pages\ListMemberApplications;
use App\Filament\Resources\MemberApplications\Schemas\MemberApplicationForm;
use App\Filament\Resources\MemberApplications\Tables\MemberApplicationsTable;
use App\Models\MemberApplication;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class MemberApplicationResource extends Resource
{
    protected static ?string $model = MemberApplication::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedIdentification;

    protected static string|UnitEnum|null $navigationGroup = 'Hội viên';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = 'Đơn xin gia nhập';

    protected static ?string $modelLabel = 'đơn xin gia nhập';

    protected static ?string $pluralModelLabel = 'đơn xin gia nhập';

    protected static ?string $recordTitleAttribute = 'full_name';

    public static function form(Schema $schema): Schema
    {
        return MemberApplicationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MemberApplicationsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMemberApplications::route('/'),
            'edit' => EditMemberApplication::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getNavigationBadge(): ?string
    {
        $count = static::getModel()::query()->where('status', 'new')->count();

        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'danger';
    }
}
