<?php
namespace Modules\toDoList\classes;

use Modules\toDoList\Jobs\SendNotification;

class SendEmailNotification implements SendExpirationNotification
{
    public function send() {
        SendNotification::dispatch();
    }
}