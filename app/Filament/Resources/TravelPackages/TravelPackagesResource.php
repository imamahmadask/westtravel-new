<?php

namespace App\Filament\Resources\TravelPackages;

use App\Filament\Resources\TravelPackages\Pages\CreateTravelPackages;
use App\Filament\Resources\TravelPackages\Pages\EditTravelPackages;
use App\Filament\Resources\TravelPackages\Pages\ListTravelPackages;
use App\Filament\Resources\TravelPackages\Schemas\TravelPackagesForm;
use App\Filament\Resources\TravelPackages\Tables\TravelPackagesTable;
use App\Models\TravelPackages;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TravelPackagesResource extends Resource
{
    protected static ?string $model = TravelPackages::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Travel Packages';

    public static function form(Schema $schema): Schema
    {
        return TravelPackagesForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TravelPackagesTable::configure($table);
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
            'index' => ListTravelPackages::route('/'),
            'create' => CreateTravelPackages::route('/create'),
            'edit' => EditTravelPackages::route('/{record}/edit'),
        ];
    }
}
