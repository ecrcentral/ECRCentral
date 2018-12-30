<?php

namespace App\Mail;

use App\Models\TravelGrant;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TravelGrantAdded extends Mailable
{
    use Queueable, SerializesModels;

    public $travelgrant;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(TravelGrant $travelgrant)
    {
        $this->travelgrant = $travelgrant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $travelgrant_url = config('app.url').'/travel-grants/'.$this->travelgrant->id;

        return $this->from('no-reply@ecrcentral.org')
        ->markdown('emails.travelgrant-added')
        ->with(['travelgrant_name' => $this->travelgrant->name,
            'url' => $travelgrant_url,
            'travelgrant_id' => $this->travelgrant->id,
        ]);

    }
}
