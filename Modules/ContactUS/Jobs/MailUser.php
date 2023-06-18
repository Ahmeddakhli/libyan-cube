<?php

namespace Modules\ContactUS\Jobs;

use Mail;
use Modules\Inventory\IUnit;
use Modules\Settings\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\URL;
use Illuminate\Queue\SerializesModels;
use Modules\ContactUS\Mail\ThankyouMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\ContactUS\Mail\ContactUsMail as MailContactUs;

class MailUser implements ShouldQueue
{

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $data;
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
        // (new ConectContactUsWithCRMAction)->execute($this->data);
        // Get contact  
        $contact_us_mails = Contact::where('type', 'contact_us')->pluck('value')->toArray();

        // Prepare  Mail data 
        $subject = 'Contact US';
        $sender = env('MAIL_NO_REPLY');
        $best_from = isset($data['best_time_to_call_from']) && !is_null($data['best_time_to_call_from']) ? $data['best_time_to_call_from'] : '';
        $best_to = isset($data['best_time_to_call_to']) && !is_null($data['best_time_to_call_to']) ? $data['best_time_to_call_to'] : '';
        $urls = [];

        if (isset($this->data['city_id']) && isset($this->data['position'])) {
            $city_id = $this->data['city_id'];
            $position = $this->data['position'];
            switch ($position) {
                case 'project':
                    if ($city_id) {
                        $units = IUnit::where('city_id', $city_id)->take(10)->get();
                        foreach ($units as $unit) {
                            $urls[$unit->title] = route('front.singleUnit', ['id' => $unit->id, 'title' => str_slug($unit->default_title)]);
                        }
                    }
                    break;
                case 'unit':
                    if ($city_id) {
                        $units = IUnit::where('city_id', $city_id)->take(10)->get();
                        foreach ($units as $unit) {
                            $urls[$unit->title] = route('front.singleUnit', ['id' => $unit->id, 'title' => str_slug($unit->default_title)]);
                        }
                    }
                    break;

                default:
                    break;
            }
        }
        // Send  mail to receivers
        try {
            if (isset($this->data['model_name'])) {
                $this->data['item_link'] = '<a href="' . $this->data['link'] . '">' . $this->data['model_name'] . '</a>';
            }

            if(isset($this->data['message']) && $this->data['message']){
                $this->data['message'] = preg_replace("@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?).*$)@", '',$this->data['message']);
            }
            foreach ($contact_us_mails as $contact_us_mail) {
                Mail::to($contact_us_mail)->send(new MailContactUs($subject, $sender, $this->data, $best_from, $best_to));
            }
            // $this->data['urls'] = $urls;
            $all_data = [
                'urls' => $urls,
                'full_name' => $this->data['full_name'],
                'item_link' => isset($this->data['item_link']) ? $this->data['item_link'] : null,
            ];
            if(is_null($this->data['model_name'])){
                $all_data['item_link'] = '<a href="' . URL::to('/') . '"><span style="font-weight:bold;">' . 'advisors Properties' . '</span></a>';
            }
            Mail::to($this->data['email'])->send(new ThankyouMail($subject, $sender, $all_data, $best_from, $best_to));
        } catch (\Exception $th) {
        }
    }
}
