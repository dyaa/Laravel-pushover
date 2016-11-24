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
     * @param Pushover $push
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
        $title      = $this->argument('title');
        $msg        = $this->argument('msg');
        $url        = $this->option('url');
        $urltitle   = $this->option('urltitle');
        $debug      = $this->option('debug');
        $sound      = $this->option('sound');
        $device     = $this->option('device');
        $priority   = $this->option('priority');
        $retry      = $this->option('retry');
        $expire     = $this->option('expire');
        $html       = $this->option('html');

        if (!isset($retry)) {
            $retry = 60;
        }

        if (!isset($expire)) {
            $expire = 365;
        }

        if(!isset($html)) {
            $html = 1;
        }

        if (!isset($urltitle)) {
            $urltitle = $url;
        }

        // Check if Debug mode is turned on
        if ($debug) {
            $this->push->debug(true);
        }

        // if sound var is set
        if ($sound) {
            $this->push->sound($sound);
        }

        if ($html) {
            $this->push->html($html);
        }
        // if device var is set
        if ($device) {
            $this->push->device($device);
        }

        // if url var is set
        if ($url) {
            $this->push->url($url, $urltitle);
        }

        // if priority var is set
        if ($priority) {
            $this->push->priority($priority, $retry, $expire);
        }
        
        $this->push->push($title, $msg);

        if ($debug) {
            $this->info($this->push->send());
        } else if ($this->push->send()) {
            $this->info("Your message has been sent.");
        } else {
            $this->error('Something went wrong!');
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['title', InputArgument::REQUIRED, 'Title argument.'],
            ['msg', InputArgument::REQUIRED, 'Message argument.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['url', null, InputOption::VALUE_OPTIONAL, 'URL to send.', null],
            ['urltitle', null, InputOption::VALUE_OPTIONAL, 'URL Title to send.', null],
            ['sound', null, InputOption::VALUE_OPTIONAL, 'Set notification Sound.', null],
            ['device', null, InputOption::VALUE_OPTIONAL, 'Set a Device.', null],
            ['priority', null, InputOption::VALUE_OPTIONAL, 'Set a Priority Message.', null],
            ['retry', null, InputOption::VALUE_OPTIONAL, 'Set a Retry for the Priority.', null],
            ['expire', null, InputOption::VALUE_OPTIONAL, 'Set an expire for the Priority.', null],
            ['html', null, InputOption::VALUE_OPTIONAL, 'Sets if message should be sent as HTML.', null],
            ['debug', null, InputOption::VALUE_NONE, 'Turn the Debug Mode.', null],
        ];
    }

}
