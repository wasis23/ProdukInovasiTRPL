<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Alumni')
                    ->required()
                    ->placeholder('Nama Lengkap beserta gelar'),
                TextInput::make('profession')
                    ->label('Pekerjaan / Jabatan')
                    ->required()
                    ->placeholder('Contoh: Bekerja di PT. Deltomed Laboratories'),
                Textarea::make('content')
                    ->label('Kata Alumni (Testimonial)')
                    ->required()
                    ->rows(4)
                    ->placeholder('Masukkan testimoni atau kutipan dari alumni...'),
                FileUpload::make('photo_path')
                    ->label('Foto Alumni')
                    ->image()
                    ->disk('public')
                    ->directory('testimonials')
                    ->helperText('Gunakan rasio 1:1 (square) untuk hasil terbaik.')
                    ->columnSpanFull(),
            ]);
    }
}
