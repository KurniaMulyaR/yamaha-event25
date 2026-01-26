<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;

class SendScheduledNotificationJob implements ShouldQueue
{
    public function __construct(
        public PesananNotifikasi $notif
    ) {}

    public function handle()
    {
        Http::withHeaders([
            'Authorization' => 'App ' . config('services.infobip.api_key'),
            'Content-Type' => 'application/json',
        ])->post(
            config('services.infobip.base_url') . '/whatsapp/1/message/template',
            json_decode($this->notif->post_data, true)
        );

        Mail::to($this->notif->email)
            ->send(new TestMail(json_decode($this->notif->post_data, true)));

        $this->notif->update([
            'status' => 'sent',
            'sent_at' => now(),
        ]);
    }
}
