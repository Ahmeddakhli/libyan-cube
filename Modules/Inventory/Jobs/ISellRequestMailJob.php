<?php

namespace Modules\Inventory\Jobs;

use Mail;
use Illuminate\Bus\Queueable;
use Modules\Settings\Contact;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\Inventory\Emails\ISellRequestMail;

class ISellRequestMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Get sell units requests emails  
        $sell_unit_reuqests_mails = Contact::where('type', 'sell_unit')->get();

        // Prepare  Mail data 
        $subject = $this->data['unit_name'] . ' Sell Unit Request';
        $sender = env('MAIL_NO_REPLY');
        // Send  mail to receivers
        try {
            foreach ($sell_unit_reuqests_mails as $sell_unit_mail) {
                Mail::to($sell_unit_mail->value)->send(new ISellRequestMail($subject, $sender, $this->data));
            }
        } catch (\Exception $th) {
        }
    }
}
