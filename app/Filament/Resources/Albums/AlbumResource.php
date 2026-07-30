<?php

namespace App\Filament\Resources\Albums;

use App\Filament\Resources\Albums\Pages\CreateAlbum;
use App\Filament\Resources\Albums\Pages\EditAlbum;
use App\Filament\Resources\Albums\Pages\ListAlbums;
use App\Filament\Resources\Albums\RelationManagers\ImagesRelationManager;
use App\Filament\Resources\Albums\Schemas\AlbumForm;
use App\Filament\Resources\Albums\Tables\AlbumsTable;
use App\Models\Album;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class AlbumResource extends Resource
{
    protected static ?string $model = Album::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;

    protected static string|UnitEnum|null $navigationGroup = 'Thư viện';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Album ảnh';

    protected static ?string $modelLabel = 'album ảnh';

    protected static ?string $pluralModelLabel = 'album ảnh';

    protected static ?string $recordTitleAttribute = 'title_vi';

    public static function form(Schema $schema): Schema
    {
        return AlbumForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AlbumsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            ImagesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAlbums::route('/'),
            'create' => CreateAlbum::route('/create'),
            'edit' => EditAlbum::route('/{record}/edit'),
        ];
    }
}
