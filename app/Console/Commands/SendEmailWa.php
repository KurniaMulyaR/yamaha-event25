<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Notifikasi;
use Carbon\Carbon;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Throwable;
class SendEmailWa extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Email dan Wa';

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
        $notifs = Notifikasi::where('status', 'pending')
        ->limit(1)
        ->get();

    foreach ($notifs as $not) {
        try {
            /* =========================
             * SEND WHATSAPP
             * ========================= */
            $waResponse = Http::withHeaders([
                    'Authorization' => 'App ' . config('services.infobip.api_key'),
                    'Content-Type'  => 'application/json',
                ])
                ->timeout(15)
                ->post(
                    'https://api.infobip.com/whatsapp/1/message/template',
                    json_decode($not->post_data, true)
                );

            if (! $waResponse->successful()) {
                throw new \Exception(
                    'WA failed: ' . $waResponse->status() . ' - ' . $waResponse->body()
                );
            }

            Log::info($post_data);

            /* =========================
             * SEND EMAIL
             * ========================= */
            if (!empty($not->email)) {
                Mail::to($not->email)
                    ->send(new TestMail(json_decode($not->post_data, true)));
            }

            /* =========================
             * UPDATE STATUS
             * ========================= */
            $not->update([
                'status'  => 'sent',
                'sent_at'=> now(),
            ]);

            Log::info('Notifikasi sent', [
                'notif_id' => $not->id,
            ]);

        } catch (Throwable $e) {

            /* =========================
             * HANDLE ERROR
             * ========================= */
            Log::error('Gagal kirim notifikasi', [
                'notif_id' => $not->id,
                'error'    => $e->getMessage(),
            ]);

            $not->update([
                'status' => 'failed',
            ]);
        }
    }

    return Command::SUCCESS;
    }
}
