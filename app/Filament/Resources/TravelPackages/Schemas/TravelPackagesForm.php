<?php

namespace App\Filament\Resources\TravelPackages\Schemas;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use App\Models\TravelCategory;
use Illuminate\Support\Str;

class TravelPackagesForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Set $set, $state) {
                        $set('slug', Str::slug($state));
                    })
                    ->placeholder('City Tour'),
                TextInput::make('slug')
                    ->dehydrated(),
                Select::make('country')
                    ->multiple()
                    ->options([
                        'Indonesia' => 'Indonesia',
                        'Malaysia' => 'Malaysia',
                        'Singapura' => 'Singapura',
                        'Thailand' => 'Thailand',
                        'Vietnam' => 'Vietnam',
                        'Jepang' => 'Jepang',
                    ])
                    ->required(),
                TextInput::make('location')
                    ->required()
                    ->placeholder('Lombok'),
                Select::make('travel_category_id')
                    ->label('Travel Category')
                    ->relationship('category', 'name')
                    ->options(TravelCategory::pluck('name', 'id'))
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('type')
                    ->required()
                    ->placeholder('3D2N'),
                TextInput::make('min_pax')
                    ->required(),
                TextInput::make('price')
                    ->numeric()
                    ->inputMode('decimal')
                    ->required(),                
                TextInput::make('disc'),
                TextInput::make('disc_price')
                    ->numeric(),                
                Toggle::make('is_active')
                    ->label('Active')
                    ->default(true),
                Toggle::make('is_featured')
                    ->label('Featured')
                    ->default(false),
                FileUpload::make('images')
                    ->required()
                    ->multiple()
                    ->image()
                    ->directory('travel-package-images')
                    ->maxSize(1024),
                FileUpload::make('mobile_images')
                    ->multiple()
                    ->image()
                    ->directory('travel-package-images-mobile')
                    ->maxSize(1024),
                TinyEditor::make('description')
                    ->columnSpan(2)
                    ->required(),
            ]);
    }
}
