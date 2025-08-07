<?php

namespace AlifAhmmed\EnvEditorPlugin\Filament\Pages;

use Filament\Forms;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class EditMailEnv extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static string $view = 'filament-plugin::edit-mail-settings';
    protected static ?string $navigationLabel = 'Mail Settings';

    public $mail_driver;
    public $mail_host;
    public $mail_port;
    public $mail_username;
    public $mail_password;
    public $mail_encryption;
    public $mail_from_address;
    public $mail_from_name;

    public function mount(): void
    {
        $this->mail_driver = env('MAIL_MAILER', 'smtp');
        $this->mail_host = env('MAIL_HOST', 'smtp.example.com');
        $this->mail_port = env('MAIL_PORT', '587');
        $this->mail_username = env('MAIL_USERNAME', '');
        $this->mail_password = env('MAIL_PASSWORD', '');
        $this->mail_encryption = env('MAIL_ENCRYPTION', 'tls');
        $this->mail_from_address = env('MAIL_FROM_ADDRESS', 'noreply@example.com');
        $this->mail_from_name = env('MAIL_FROM_NAME', 'Example');
    }

    public function save()
    {
        $envPath = base_path('.env');

        if (File::exists($envPath)) {
            $content = File::get($envPath);

            $content = preg_replace("/MAIL_MAILER=.*/", "MAIL_MAILER={$this->mail_driver}", $content);
            $content = preg_replace("/MAIL_HOST=.*/", "MAIL_HOST={$this->mail_host}", $content);
            $content = preg_replace("/MAIL_PORT=.*/", "MAIL_PORT={$this->mail_port}", $content);
            $content = preg_replace("/MAIL_USERNAME=.*/", "MAIL_USERNAME={$this->mail_username}", $content);
            $content = preg_replace("/MAIL_PASSWORD=.*/", "MAIL_PASSWORD={$this->mail_password}", $content);
            $content = preg_replace("/MAIL_ENCRYPTION=.*/", "MAIL_ENCRYPTION={$this->mail_encryption}", $content);
            $content = preg_replace("/MAIL_FROM_ADDRESS=.*/", "MAIL_FROM_ADDRESS={$this->mail_from_address}", $content);
            $content = preg_replace("/MAIL_FROM_NAME=.*/", "MAIL_FROM_NAME={$this->mail_from_name}", $content);

            File::put($envPath, $content);
        }

        Artisan::call('config:clear');
        Artisan::call('cache:clear');

        session()->flash('success', 'Mail settings updated successfully!');
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('mail_driver')->label('Mail Driver')->required(),
            Forms\Components\TextInput::make('mail_host')->label('Mail Host')->required(),
            Forms\Components\TextInput::make('mail_port')->label('Mail Port')->required(),
            Forms\Components\TextInput::make('mail_username')->label('Mail Username')->required(),
            Forms\Components\TextInput::make('mail_password')->label('Mail Password')->password(),
            Forms\Components\TextInput::make('mail_encryption')->label('Mail Encryption')->required(),
            Forms\Components\TextInput::make('mail_from_address')->label('Mail From Address')->required(),
            Forms\Components\TextInput::make('mail_from_name')->label('Mail From Name')->required(),
        ];
    }
}
