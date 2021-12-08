<?php 

namespace Modules\toDoList\classes;
use Modules\toDoList\interfaces\SendExpirationNotification;

class SendNotification {
    private $sendMethod;

    public function setSendMethod(SendExpirationNotification $expirationNotification) {
        $this->sendMethod = $expirationNotification;
    }

    public function executeSendMethod()
    {
        return $this->sendMethod->send();
    }
}