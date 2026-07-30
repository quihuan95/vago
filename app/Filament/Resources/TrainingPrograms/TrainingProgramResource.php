<?php

namespace App\Filament\Resources\TrainingPrograms;

use App\Filament\Resources\TrainingPrograms\Pages\CreateTrainingProgram;
use App\Filament\Resources\TrainingPrograms\Pages\EditTrainingProgram;
use App\Filament\Resources\TrainingPrograms\Pages\ListTrainingPrograms;
use App\Filament\Resources\TrainingPrograms\Schemas\TrainingProgramForm;
use App\Filament\Resources\TrainingPrograms\Tables\TrainingProgramsTable;
use App\Models\TrainingProgram;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class TrainingProgramResource extends Resource
{
    protected static ?string $model = TrainingProgram::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAcademicCap;

    protected static string|UnitEnum|null $navigationGroup = 'Hội viên';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Đào tạo';

    protected static ?string $modelLabel = 'chương trình đào tạo';

    protected static ?string $pluralModelLabel = 'chương trình đào tạo';

    protected static ?string $recordTitleAttribute = 'title_vi';

    public static function form(Schema $schema): Schema
    {
        return TrainingProgramForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TrainingProgramsTable::configure($table);
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
            'index' => ListTrainingPrograms::route('/'),
            'create' => CreateTrainingProgram::route('/create'),
            'edit' => EditTrainingProgram::route('/{record}/edit'),
        ];
    }
}
