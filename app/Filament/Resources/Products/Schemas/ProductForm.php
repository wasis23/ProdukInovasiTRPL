<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required()
                    ->native(false)
                    ->placeholder('Select Category')
                    ->columnSpan(1),
                TextInput::make('title')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($set, ?string $state) => $set('slug', Str::slug($state)))
                    ->columnSpan(1),
                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->columnSpan(1),
                TextInput::make('youtube_url')
                    ->url()
                    ->required()
                    ->label('Video URL (YouTube / TikTok)')
                    ->placeholder('https://www.youtube.com/watch?v=... atau https://www.tiktok.com/@username/video/...')
                    ->helperText('Masukkan URL video YouTube atau TikTok (biasa, Shorts, atau TikTok)')
                    ->columnSpan(1),
                TextInput::make('live_preview_url')
                    ->url()
                    ->placeholder('https://...')
                    ->helperText('Hanya untuk kategori Website (Opsional)')
                    ->columnSpan(2),
                RichEditor::make('description')
                    ->required()
                    ->columnSpanFull(),
                Repeater::make('images')
                    ->relationship('images')
                    ->schema([
                        FileUpload::make('image_path')
                            ->image()
                            ->disk('public')
                            ->directory('products')
                            ->required()
                            ->label('Image File'),
                    ])
                    ->grid(3)
                    ->columnSpanFull()
                    ->label('Koleksi Gambar (IoT & Games)')
                    ->helperText('Unggah tangkapan layar, mock-up, atau foto hardware di sini.'),
            ]);
    }
}
