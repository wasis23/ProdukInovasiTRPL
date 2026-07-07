<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class ManageSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Pengaturan Web';
    protected static ?string $title = 'Pengaturan Website';

    protected string $view = 'filament.pages.manage-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $setting = Setting::getSolo();
        $this->form->fill($setting->toArray());
    }

    public function form(Schema $form): Schema
    {
        return $form
            ->components([
                TextInput::make('instagram_url')
                    ->label('Link Instagram')
                    ->url()
                    ->placeholder('https://instagram.com/username')
                    ->required(),
                TextInput::make('tiktok_url')
                    ->label('Link TikTok')
                    ->url()
                    ->placeholder('https://tiktok.com/@username')
                    ->required(),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Simpan Perubahan')
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        $setting = Setting::getSolo();
        $setting->update($this->form->getState());

        Notification::make()
            ->title('Pengaturan berhasil disimpan!')
            ->success()
            ->send();
    }
}
