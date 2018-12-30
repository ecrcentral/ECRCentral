<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;

class TravelGrantDimmer extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $count = \App\Models\TravelGrant::count();
        $string = 'Travel Grants';

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-rocket',
            'title'  => "{$count} {$string}",
            'text'   => __('voyager.dimmer.page_text', ['count' => $count, 'string' => Str::lower($string)]),
            'button' => [
                'text' => 'View all travel grants',
                'link' => route('voyager.travel-grants.index'),
            ],
            'image' => voyager_asset('images/widget-backgrounds/travelgrant.png'),
        ]));
    }
}
