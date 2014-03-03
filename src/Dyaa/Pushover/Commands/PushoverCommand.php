<?php namespace dyaa\Pushover\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Dyaa\Pushover\Pushover;
//use Illuminate\Config\Repository;

class PushoverCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'pushover:send';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Pushover Command';
	
	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(Pushover $push)
	{
		parent::__construct($push);	
		$this->push = $push;
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$Title	= $this->argument('title');
		$msg	= $this->argument('msg');
		$url 	= $this->option('url');
		$debug 	= $this->option('debug');
		$sound 	= $this->option('sound');

		// Check if Debug mode is turned on
		if($debug)
		{
			$this->push->debug(true);
		}

		// if sound var is set
		if($sound)
		{
			$this->push->sound($sound);
		}
		
		$this->push->push($title, $msg);

		return $this->info($this->push->send());
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('title', InputArgument::REQUIRED, 'Title argument.'),
			array('msg', InputArgument::REQUIRED, 'Message argument.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('url', null, InputOption::VALUE_OPTIONAL, 'URL to send.', null),
			array('sound', null, InputOption::VALUE_OPTIONAL, 'Set notification Sound.', null),
			array('debug', null, InputOption::VALUE_NONE, 'Turn the Debug Mode.', null),
		);
	}

}
