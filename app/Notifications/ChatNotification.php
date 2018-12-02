<?php

namespace App\Notifications;

use App\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\OneSignal\OneSignalChannel;
use NotificationChannels\OneSignal\OneSignalMessage;
use NotificationChannels\OneSignal\OneSignalWebButton;

class ChatNotification extends Notification
{
    use Queueable;
    
    private $channel;
    
    private $data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($channel,$data)
    {
        //
        $this->channel=$channel;
        $this->data=$data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [OneSignalChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    /**
     * @param $notifiable
     * @return OneSignalMessage
     */
    public function toOneSignal($notifiable){

        $sub = $this->getSubject();
        $url = env('APP_URL')."chat-rom/download-zip/";

        if($this->channel=='new_message'||$this->channel=='updated_message'){
            $k = 'message';
            $b = $this->data["message"]->body;
        } else{
            $k = 'chat';
//            $b= trans('notification.chat.new_chat_body',["concern"=>"chat"]);
            $b =  $b = $this->data["chat"]->title;
        }

        return OneSignalMessage::create()
            ->subject($sub)
            ->body($b)
            ->setData('channel', $this->channel)
            ->setData($k, $this->data)
            ->url($url)
            ->webButton(
                OneSignalWebButton::create('link-1')
                    ->text('see')
                    ->url($url)
            );
    }

    private function getBody()
    {
        switch ($this->channel) {
            case "new_message":
                return trans('notification.chat.new_message_body');
                break;
            case "updated_message":
                return trans('notification.chat.updated_message_body');
                break;
            case "new_chat":
                return trans('notification.chat.new_chat_body');
                break;
        }
    }

    private function getSubject()
    {
        switch ($this->channel) {
            case "new_message":
                return trans('notification.chat.new_message_subject');
                break;
            case "updated_message":
                return trans('notification.chat.updated_message_subject');
                break;
            case "new_chat":
                return trans('notification.chat.new_chat_subject');
                break;
        }
    }
}
