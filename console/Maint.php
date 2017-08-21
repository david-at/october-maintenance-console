<?php namespace DavidLeonard\MaintenanceConsole\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Cms\Models\MaintenanceSetting;

class Maint extends Command
{
    /**
     * @var string The console command name.
     */
    protected $name = 'october:maint';

    /**
     * @var string The console command description.
     */
    protected $description = 'Sets october maintenance mode.';

    /**
     * Execute the console command.
     * @return void
     */
    public function fire()
    {
	$command = implode(' ', (array) $this->argument('name'));
	$status = MaintenanceSetting::get('is_enabled');
	if ($command === 'false' && $status == true) {
		MaintenanceSetting::set('is_enabled', false);
		$this->output->writeln("Maintenance mode is now disabled.");
	} elseif ($command === 'false' && $status == false) {
		$this->error("October CMS is already out of Maintenance Mode.");
	} elseif ($command === 'true' && $status == true) {
		$this->error("October CMS is already in Maintenance Mode.");
	} elseif ($command === 'true' && $status == false) {
		MaintenanceSetting::set('is_enabled', true);
		$this->output->writeln("Maintenance mode is now enabled.");
	} else {
		$this->error("Something was wrong with your input. Should look like ./artisan october:maint true or ./artisan october:maint false.");
	}
    }

    /**
     * Get the console command arguments.
     * @return array
     */
    protected function getArguments()
    {
        return [
		['name', InputArgument::IS_ARRAY, 'Desired state'],
	];
    }

    /**
     * Get the console command options.
     * @return array
     */
    protected function getOptions()
    {
        return [];
    }

}
