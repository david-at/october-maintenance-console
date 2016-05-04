<?php namespace DavidLeonard\MaintenanceConsole;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
    }

    public function registerSettings()
    {
    }
    public function register()
    {
        $this->registerConsoleCommand('october.maint', 'DavidLeonard\MaintenanceConsole\Console\Maint');
    }
}
