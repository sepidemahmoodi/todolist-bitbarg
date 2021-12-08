<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\toDoList\classes\SendNotification;
use Modules\toDoList\classes\SendEmailNotification;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:notif {method}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command send notif based on choosen method';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $sendMethod = $this->argument('method');
        $sendNotification = new SendNotification();
        switch ($sendMethod) {
            case 'email':
                $sendNotification->setSendMethod(new SendEmailNotification);
                break;
            case 'sms' : 
                return '';
            default:
                $sendNotification->setSendMethod(new SendEmailNotification);
                break;
        }
        return Command::SUCCESS;
    }
}
