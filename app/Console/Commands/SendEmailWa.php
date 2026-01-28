<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Notifikasi;
use Carbon\Carbon;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

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
        $notif = Notifikasi::where('status', 'pending')
                ->limit(1)
                ->get();
            Log::info('cron running');
        foreach($notif as $not){
           
            // Http::withHeaders([
            //             'Authorization' => 'App ' . config('services.infobip.api_key'),
            //             'Content-Type' => 'application/json'
            //         ])->post('https://api.infobip.com/whatsapp/1/message/template', $not->post_data);

            Mail::to($not->email)
                ->send(new TestMail($not->post_data));
 
            $not->update([  
                'status' => 'sent',
                'sent_at' => now(),
            ]);

            return 0;

        }
    }
}
