<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TaskNotification extends Notification
{
    use Queueable;

    public function __construct(
        public string $action,
        public string $taskTitle
    ) {}

    /**
     * Get the notification delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the database representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'action' => $this->action,
            'task_title' => $this->taskTitle,
            'message' => $this->message(),
        ];
    }

    /**
     * Build the notification message.
     */
    private function message(): string
    {
        return match ($this->action) {
            'created' => "You created the task \"{$this->taskTitle}\".",
            'updated' => "You updated the task \"{$this->taskTitle}\".",
            'completed' => "You completed the task \"{$this->taskTitle}\".",
            'deleted' => "You deleted the task \"{$this->taskTitle}\".",
            default => "Something happened with the task \"{$this->taskTitle}\".",
        };
    }
}
