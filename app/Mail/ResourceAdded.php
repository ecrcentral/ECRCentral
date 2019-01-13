<?php

namespace App\Mail;

use App\Models\Resource;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResourceAdded extends Mailable
{
    use Queueable, SerializesModels;

    public $resource;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Resource $resource)
    {
        $this->resource = $resource;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $resource_url = config('app.url').'/resources/'.$this->resource->id;

        return $this->from('no-reply@ecrcentral.org')
        ->markdown('emails.resource-added')
        ->with(['resource_name' => $this->resource->name,
            'url' => $resource_url,
            'resource_id' => $this->resource->id,
        ]);

    }
}
