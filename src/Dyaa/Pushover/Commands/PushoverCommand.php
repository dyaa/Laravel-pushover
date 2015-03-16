<?php namespace dyaa\Pushover\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Dyaa\Pushover\Pushover;

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
		$title	= $this->argument('title');
		$msg	= $this->argument('msg');
		$url 	= $this->option('url');
		$urltitle = $this->option('urltitle');
		$debug 	= $this->option('debug');
		$sound 	= $this->option('sound');
		$device = $this->option('device');
		$priority = $this->option('priority');
		$retry 	= $this->option('retry');
		$expire = $this->option('expire');

		if(!isset($retry))
		{
			$retry = 60;
		}

		if(!isset($expire))
		{
			$expire = 365;
		}

		if(!isset($urltitle))
		{
			$urltitle = $url;
		}

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

		// if device var is set
		if($device)
		{
			$this->push->device($device);
		}

		// if url var is set
		if($url)
		{
			$this->push->url($url, $urltitle);
		}

		// if priority var is set
		if($priority)
		{
			$this->push->priority($priority, $retry, $expire);
		}
		
		$this->push->push($title, $msg);

		if($debug)
		{
			return $this->info($this->push->send());

		}else{
			if($this->push->send())
			{
				return $this->info("Your message has been sent.");
			}else{
				return $this->error('Something went wrong!');
			}
		}
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
			array('urltitle', null, InputOption::VALUE_OPTIONAL, 'URL Title to send.', null),
			array('sound', null, InputOption::VALUE_OPTIONAL, 'Set notification Sound.', null),
			array('device', null, InputOption::VALUE_OPTIONAL, 'Set a Device.', null),
			array('priority', null, InputOption::VALUE_OPTIONAL, 'Set a Priority Message.', null),
			array('retry', null, InputOption::VALUE_OPTIONAL, 'Set a Retry for the Priority.', null),
			array('expire', null, InputOption::VALUE_OPTIONAL, 'Set an expire for the Priority.', null),
			array('debug', null, InputOption::VALUE_NONE, 'Turn the Debug Mode.', null),
		);
	}

}
