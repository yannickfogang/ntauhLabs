<?php

declare(strict_types=1);

namespace NtauhLabs\SharedService;


use JetBrains\PhpStorm\Pure;

class Response
{
    private Notification $notification;

    public function __construct() {
        $this->notification = new Notification();
    }

    public function setNotification(string $key, string $message) {
        $this->notification->setMessage($key, $message);
    }

    /**
     * @return array
     */
    #[Pure] public function getNotifications(): array
    {
        return $this->notification->getMessages();
    }
}
