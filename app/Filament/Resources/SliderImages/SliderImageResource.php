<?php

namespace App\Filament\Resources\SliderImages;

use App\Filament\Resources\SliderImages\Pages\CreateSliderImage;
use App\Filament\Resources\SliderImages\Pages\EditSliderImage;
use App\Filament\Resources\SliderImages\Pages\ListSliderImages;
use App\Filament\Resources\SliderImages\Schemas\SliderImageForm;
use App\Filament\Resources\SliderImages\Tables\SliderImagesTable;
use App\Models\SliderImage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SliderImageResource extends Resource
{
    protected static ?string $model = SliderImage::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;

    protected static ?string $navigationLabel = 'Image Slider';
    
    protected static ?string $pluralLabel = 'Image Slider';
    
    protected static ?string $modelLabel = 'Slider Image';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return SliderImageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SliderImagesTable::configure($table);
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
            'index' => ListSliderImages::route('/'),
            'create' => CreateSliderImage::route('/create'),
            'edit' => EditSliderImage::route('/{record}/edit'),
        ];
    }
}
