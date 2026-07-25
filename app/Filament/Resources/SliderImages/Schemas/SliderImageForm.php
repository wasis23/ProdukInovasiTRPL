<?php

namespace App\Filament\Resources\SliderImages\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Slider;
use Filament\Schemas\Schema;

class SliderImageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('image_path')
                    ->label('Gambar Slider')
                    ->image()
                    ->disk('public')
                    ->directory('slider')
                    ->required()
                    ->helperText('Gunakan gambar landscape berkualitas tinggi.'),
                
                Slider::make('focus_x')
                    ->label('Titik Fokus Horisontal (X)')
                    ->min(0)
                    ->max(100)
                    ->default(50)
                    ->helperText('0% (Kiri) - 50% (Tengah) - 100% (Kanan)'),
                
                Slider::make('focus_y')
                    ->label('Titik Fokus Vertikal (Y)')
                    ->min(0)
                    ->max(100)
                    ->default(50)
                    ->helperText('0% (Atas) - 50% (Tengah) - 100% (Bawah)'),

                TextInput::make('title')
                    ->label('Judul Slider (Opsional)')
                    ->placeholder('Masukkan judul gambar/slide...'),

                Textarea::make('description')
                    ->label('Deskripsi (Opsional)')
                    ->rows(2)
                    ->placeholder('Masukkan deskripsi singkat slide...'),
            ]);
    }
}
