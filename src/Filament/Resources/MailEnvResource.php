<?php

namespace AlifAhmmed\EnvEditorPlugin\Filament\Resources;

use AlifAhmmed\EnvEditorPlugin\Filament\Pages\EditMailEnv;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Forms\Form; // Ensure you are importing from Filament\Forms

class MailEnvResource extends Resource
{
    protected static ?string $model = null;

    protected static ?string $navigationIcon = 'heroicon-o-mail';

    public static function form(Form $form): Form // Use the correct Filament\Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('MAIL_MAILER')
                    ->label('Mail Mailer')
                    ->default(env('MAIL_MAILER', 'smtp'))
                    ->required(),
                Forms\Components\TextInput::make('MAIL_HOST')
                    ->label('Mail Host')
                    ->default(env('MAIL_HOST', 'smtp.mailtrap.io'))
                    ->required(),
                Forms\Components\TextInput::make('MAIL_PORT')
                    ->label('Mail Port')
                    ->default(env('MAIL_PORT', '2525'))
                    ->required(),
                Forms\Components\TextInput::make('MAIL_USERNAME')
                    ->label('Mail Username')
                    ->default(env('MAIL_USERNAME', ''))
                    ->required(),
                Forms\Components\TextInput::make('MAIL_PASSWORD')
                    ->label('Mail Password')
                    ->password()
                    ->default(env('MAIL_PASSWORD', ''))
                    ->required(),
                Forms\Components\TextInput::make('MAIL_ENCRYPTION')
                    ->label('Mail Encryption')
                    ->default(env('MAIL_ENCRYPTION', 'tls'))
                    ->required(),
                Forms\Components\TextInput::make('MAIL_FROM_ADDRESS')
                    ->label('Mail From Address')
                    ->default(env('MAIL_FROM_ADDRESS', 'noreply@example.com'))
                    ->email()
                    ->required(),
                Forms\Components\TextInput::make('MAIL_FROM_NAME')
                    ->label('Mail From Name')
                    ->default(env('MAIL_FROM_NAME', 'Example'))
                    ->required(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => EditMailEnv::route('/'),
        ];
    }
}
