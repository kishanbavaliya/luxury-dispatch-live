<?php

namespace App\Jobs\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Jobs\Notifications\FcmHelper;

class SendBulkPushNotification implements ShouldQueue
{
    use Dispatchable, Queueable, InteractsWithQueue, SerializesModels;

    /**
     * The users.
     *
     * @var array
     */
    protected $users;

    /**
     * The title key.
     *
     * @var string
     */
    protected $title_key;

    /**
     * The body key.
     *
     * @var string
     */
    protected $body_key;

    /**
     * The base data.
     *
     * @var array
     */
    protected $base_data;

    /**
     * The image.
     *
     * @var string
     */
    protected $image;

    /**
     * Create a new job instance.
     *
     * @param array $users
     * @param string $title_key
     * @param string $body_key
     * @param array|null $base_data
     * @param string|null $image
     */
    public function __construct(array $users, $title_key, $body_key, $base_data = null, $image = null)
    {
        $this->users = $users;
        $this->title_key = $title_key;
        $this->body_key = $body_key;
        $this->base_data = $base_data ?: [];
        $this->image = $image;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->users as $user) {
            $title = trans($this->title_key, [], $user->lang);
            $body = trans($this->body_key, [], $user->lang);
            $data = $this->base_data;
            $data['title'] = $title;
            $data['message'] = $body;
            \Log::info('Send driver name: ' . $user->name, [
                        'time' => now()->toDateTimeString()
                    ]);
            $user->notify(new AndroidPushNotification($title, $body, $data, $this->image));
            \Log::info('Sended driver name: ' . $user->name, [
                        'time' => now()->toDateTimeString()
                    ]);
        }
    }
}