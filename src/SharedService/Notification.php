<?php


namespace NtauhLabs\SharedService;


class Notification
{

    protected array $notify = [];

    /**
     * @return array
     */
    public function getMessages(): array
    {
        return $this->notify;
    }

    public function setMessage(string $key, string $message): void
    {
        if (!array_key_exists($key, $this->notify)) {
            $this->notify[$key] = $message;
        }
    }
}
