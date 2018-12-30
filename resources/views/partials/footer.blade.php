<footer class="footer">
      <div class="container">
        <div class="row">
          <div class="col-md-5">
    
            <h3 class="footer-title">
                @if(setting('site.logo'))
                <img height="40px" src="/storage/{{ setting('site.logo') }}">
                @else
                {{ setting('site.title') }}
                @endif
              </h3>
                
            <p><b>ECRcentral</b> is a central platform for early career researchers to find postdoc research fellowships, travel grants and to share experiences and to provide feedback.
            </p>
            <h3 class="footer-title"> Follow us</h3>
            <ul class="list-unstyled list-inline list-social-icons">
                    
                    <li>
                        <a href="https://twitter.com/ECRcentral" target="_blank"><i class="fa fa-twitter-square fa-2x"></i></a>
                    </li>

                    <li>
                        <a href="https://fb.me/ECRcentral" target="_blank"><i class="fa fa-facebook-square fa-2x"></i></a>
                    </li>

                    <li>
                        <a href="https://github.com/ecrcentral" target="_blank"><i class="fa fa-github-square fa-2x"></i></a>
                    </li>
                </ul>

            <!--
            <a class="footer-brand" href="https://elifesciences.org/inside-elife/912b0679/early-career-advisory-group-elife-welcomes-150-ambassadors-of-good-practice-in-science" target="_blank">
              <img src="https://elifesciences.org/assets/patterns/img/patterns/organisms/elife-logo-full.b1283c9a.svg" width="200px" alt="eLife" />
            </a>
          -->

          </div> <!-- /col-xs-7 -->

          <div class="col-md-4">
              <br>
            <a class="twitter-timeline" href="https://twitter.com/ECRcentral?ref_src=twsrc%5Etfw">Tweets by ECRcentral</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
          </div>

           <div class="col-md-3">
            <div class="footer-banner">
              <h3 class="footer-title">Links</h3>
              <ul>
              <li {{ Route::is('about') ? 'class=active' : null }}><a href="{{ route('about') }}">About</a></li>
              
              <li><a class="nav-link" href="#">Our team</a></li>
              <!--
              <li {{ Route::is('team') ? 'class=active' : null }}><a href="{{ route('team') }}">Our team</a></li>
            -->

              <li><a class="nav-link" href="#">Resources</a></li>
              <li {{ Request::is('funders') ? 'class=active' : null }}><a href="{{ route('funders') }}">Funders</a></li>

              <li><a class="nav-link active" href="#">Disclaimer</a></li>
              <li {{ Route::is('privacy') ? 'class=active' : null }}><a href="{{ route('privacy') }}">Privacy</a></li>
              <li {{ Route::is('contact') ? 'class=active' : null }}><a href="{{ route('contact') }}">Contact us</a></li>

            </ul>
            </div>
          </div>
         
        </div>
      </div>
      <div class="row" style="background: #38495c;">
        <br>
        <p align="center">&copy; 2019 ECRcentral. The content is licensed under <a rel="license" href="http://creativecommons.org/licenses/by/4.0/" target="_blank"> <i class="fa fa-creative-commons" aria-hidden="true"></i> </a> CC BY 4.0 | ECRcentral is developed with <span style="color: #e25555;">&#9829;</span> by
          <a href="https://asntech.github.io/" target="_blank"> Aziz </a> and brought to you by eLife Ambassadors 2018.</p>
        <br>
      </div>
    </footer>