<div class="row">
    <div class="col-xs-6 margin-bottom-1">
        {!! HTML::icon_link(route('social.redirect',['provider' => 'facebook']), 'fa fa-facebook', 'Facebook', array('class' => 'btn btn-block btn-social btn-facebook')) !!}
    </div>
    <div class="col-xs-6 margin-bottom-1">
        {!! HTML::icon_link(route('social.redirect',['provider' => 'twitter']), 'fa fa-twitter', 'Twitter', array('class' => 'btn btn-block btn-social btn-twitter')) !!}
    </div>
</div>

<div class="row">
    <div class="col-xs-6 margin-bottom-1">
        {!! HTML::icon_link(route('social.redirect',['provider' => 'google']), 'fa fa-google-plus', 'Google +', array('class' => 'btn btn-block btn-social btn-google')) !!}
    </div>
    <div class="col-xs-6 margin-bottom-1">
        {!! HTML::icon_link(route('social.redirect',['provider' => 'github']), 'fa fa-github', 'GitHub', array('class' => 'btn btn-block btn-social btn-github')) !!}
    </div>
</div>