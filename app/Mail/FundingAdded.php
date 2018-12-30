<?php

namespace App\Mail;

use App\Models\Funding;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FundingAdded extends Mailable
{
    use Queueable, SerializesModels;

    public $funding;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Funding $funding)
    {
        $this->funding = $funding;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $funding_url = config('app.url').'/fundings/'.$this->funding->id;

        return $this->from('no-reply@ecrcentral.org')
        ->markdown('emails.funding-added')
        ->with(['funding_name' => $this->funding->name,
            'url' => $funding_url,
            'funding_id' => $this->funding->id,
        ]);

    }
}
