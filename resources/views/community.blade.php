@extends('layouts.app')

@section('template_title')
ECR Community
@endsection

@section('template_linked_css')

<style type="text/css">
    .card {
    border: none;
    background: #edf0f1;
}
.joined_date {
    font-size: 10px;
}
.organization {
    font-size: 11px;
}


pre {
  margin: 20px 0;
  padding: 20px;
  background: #fafafa;
}

.round { border-radius: 50%; }
</style>

@endsection

@section('content')
<div class="container">
<!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Community<small>members</small></h3>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            
            @foreach($members as $member)

            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center">
                <div class="thumbnail">
                    @if (($member->profile) && $member->profile->avatar_status == 1)
                        <img src="{{ $member->profile->avatar }}" alt="{{ $member->name }}" width="100" height="100" border="0" class="img-circle">
                    @else
                        <img class="round" width="100" height="100" avatar="@if ($member->first_name !=NULL && $member->last_name !=NULL) {{ $member->first_name }}&nbsp;{{ $member->last_name }} @else {{ $member->name }} @endif">
                    @endif

                    <div class="caption">
                        <a href="/profile/{{ $member->name }}">@if ($member->first_name && $member->last_name) {{ $member->first_name }} {{ $member->last_name }} @else {{ $member->name }} @endif</a>
                        @if ($member->profile->organization)
                        <div class="organization">{{ $member->profile->organization }}</div>
                        @endif
                        <div class="joined_date">Joined: {{ $member->created_at->format('M d, Y') }}</div>
                        <ul class="list-inline">
                            @if ($member->profile->orcid)
                             <a href="https://orcid.org/{{ $member->profile->orcid }}" target="_blank">
                                <i class="ai ai-orcid"></i></a></li>
                            @endif
                            
                             @if ($member->profile->twitter_username)
                             <li><a href="https://twitter.com/{{ $member->profile->twitter_username }}" target="_blank">
                                <i class="fa fa-twitter"> </i></a></li>
                            @endif

                            @if ($member->profile->github_username)
                             <li><a href="https://github.com/{{ $member->profile->github_username }}" target="_blank">
                                <i class="fa fa-github"> </i></a></li>
                            @endif

                            @if ($member->profile->linkedin_username)
                             <li><a href="{{ $member->profile->linkedin_username }}" target="_blank">
                                <i class="fa fa-linkedin"> </i></a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            @endforeach             
        
        </div>
         {{ $members->links() }}
        <br><br>     
</div>

@endsection

@section('js')
<script type="text/javascript">
    /*
     * LetterAvatar
     * 
     * Artur Heinze
     * Create Letter avatar based on Initials
     * based on https://gist.github.com/leecrossley/6027780
     */
    (function(w, d){


        function LetterAvatar (name, size) {

            name  = name || '';
            size  = size || 100;

            var colours = [
                    "#1abc9c", "#2ecc71", "#3498db", "#9b59b6", "#34495e", "#16a085", "#27ae60", "#2980b9", "#8e44ad", "#2c3e50", 
                    "#f1c40f", "#e67e22", "#e74c3c", "#ecf0f1", "#95a5a6", "#f39c12", "#d35400", "#c0392b", "#bdc3c7", "#7f8c8d"
                ],

                nameSplit = String(name).toUpperCase().split(' '),
                initials, charIndex, colourIndex, canvas, context, dataURI;


            if (nameSplit.length == 1) {
                initials = nameSplit[0] ? nameSplit[0].charAt(0):'?';
            } else {
                initials = nameSplit[0].charAt(0) + nameSplit[1].charAt(0);
            }

            if (w.devicePixelRatio) {
                size = (size * w.devicePixelRatio);
            }
                
            charIndex     = (initials == '?' ? 72 : initials.charCodeAt(0)) - 64;
            colourIndex   = charIndex % 20;
            canvas        = d.createElement('canvas');
            canvas.width  = size;
            canvas.height = size;
            context       = canvas.getContext("2d");
             
            context.fillStyle = colours[colourIndex - 1];
            context.fillRect (0, 0, canvas.width, canvas.height);
            context.font = Math.round(canvas.width/2)+"px Arial";
            context.textAlign = "center";
            context.fillStyle = "#FFF";
            context.fillText(initials, size / 2, size / 1.5);

            dataURI = canvas.toDataURL();
            canvas  = null;

            return dataURI;
        }

        LetterAvatar.transform = function() {

            Array.prototype.forEach.call(d.querySelectorAll('img[avatar]'), function(img, name) {
                name = img.getAttribute('avatar');
                img.src = LetterAvatar(name, img.getAttribute('width'));
                img.removeAttribute('avatar');
                img.setAttribute('alt', name);
            });
        };


        // AMD support
        if (typeof define === 'function' && define.amd) {
            
            define(function () { return LetterAvatar; });
        
        // CommonJS and Node.js module support.
        } else if (typeof exports !== 'undefined') {
            
            // Support Node.js specific `module.exports` (which can be a function)
            if (typeof module != 'undefined' && module.exports) {
                exports = module.exports = LetterAvatar;
            }

            // But always support CommonJS module 1.1.1 spec (`exports` cannot be a function)
            exports.LetterAvatar = LetterAvatar;

        } else {
            
            window.LetterAvatar = LetterAvatar;

            d.addEventListener('DOMContentLoaded', function(event) {
                LetterAvatar.transform();
            });
        }

    })(window, document);
</script>

@endsection

