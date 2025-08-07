<?php

namespace AlifAhmmed\EnvEditorPlugin;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;
use AlifAhmmed\EnvEditorPlugin\Filament\Resources\MailEnvResource;


class EnvEditorServiceProvider extends ServiceProvider
{
    /**
     * Get the plugin ID.
     *
     * @return string
     */
    public function getId(): string
    {
        return 'mail-env-editor';
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }

    /**
     * Return the plugin's commands.
     *
     * @return array
     */
    protected function getCommands(): array
    {
        return [
            MailEnvResource::class, // Register the resource
        ];
    }

    /**
     * Register the plugin with the given panel.
     *
     * @param  \Filament\Panel  $panel
     * @return \Filament\Panel
     */
    public function registerPanel(Panel $panel): Panel
    {
        // You can register your resources, pages, etc. to the panel here.
        Filament::registerResources([
            MailEnvResource::class,
        ]);

        return $panel;
    }
}
