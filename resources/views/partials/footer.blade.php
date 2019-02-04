<footer class="footer">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            
            <div class="col-md-10">
            <h3 class="footer-title">
                @if(setting('site.logo'))
                <img height="35px" src="/storage/{{ setting('site.logo') }}">
                @else
                {{ setting('site.title') }}
                @endif
              </h3>
                
            <p><b>ECRcentral</b> aims to bring early career researchers together to discuss funding opportunities, share experiences, and create impact through community engagement.
            </p>
          </div>
          <div class="col-md-2">
            <h3 class="footer-title">
              <a href="https://elifesciences.org/" target="_blank">
              <img height="65px" class="pull-right" src=" {{ asset('images/powered-by-eLife.svg') }}"> 
            </a>
            </h3>
          </div>
         
          <div class="col-md-4">
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
          </div>
          <div class="col-md-6">
            <h3 class="footer-title"> Subscribe to get updates</h3>
            <form action="https://tsinghua.us2.list-manage.com/subscribe/post?u=4d6fa28bc56f02a30d30f8916&amp;id=7bb33ad6aa" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>

              <div class="form-group">
              <div class="input-group input-group-newsletter">
                <input type="text" class="form-control" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="Enter your email to subscribe..." aria-label="Enter your email to subscribe..." aria-describedby="basic-addon" required>
                <div class="input-group-btn">
                  <button class="btn btn-secondary" type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe">Notify Me!</button>
                </div>
              </div>
            </div>
              </form>
          </div>
        </div>
          <!--
          <div class="col-md-4">
          <a class="twitter-timeline" data-height="350" data-link-color="#19b491" href="https://twitter.com/ECRcentral?ref_src=twsrc%5Etfw">Tweets by ECRcentral</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
        </div>
      -->

           <div class="col-md-4">
            <div class="footer-banner">
              <h3 class="footer-title"> </h3>
              <ul>
              <li {{ Route::is('about') ? 'class=active' : null }}><a href="{{ route('about') }}">About ECRcentral</a></li>
              <li {{ Route::is('team') ? 'class=active' : null }}><a href="{{ route('team') }}">Our Team</a></li>
              <li {{ Route::is('getinvolved') ? 'class=active' : null }}><a  href="{{ route('getinvolved') }}">Get Involved</a></li>
              <li {{ Request::is('funders') ? 'class=active' : null }}><a href="{{ route('funders') }}">Funders</a></li>
              <li {{ Route::is('terms') ? 'class=active' : null }}><a  href="{{ route('terms') }}">Terms of Use</a></li>
              <li {{ Route::is('privacy') ? 'class=active' : null }}><a href="{{ route('privacy') }}">Privacy Policy</a></li>
              <li {{ Route::is('contact') ? 'class=active' : null }}><a href="{{ route('contact') }}">Contact Us</a></li>
            </ul>
            </div>
        </div>
      </div>
    </footer>

  <div id="footerc">
    <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <center>
            <p style="color: #fff; font-size: 14px;">&copy; 2019 ECRcentral. The content is licensed under <a rel="license" href="http://creativecommons.org/licenses/by/4.0/" target="_blank"> <i class="fa fa-creative-commons" aria-hidden="true"></i> </a> Creative Commons BY 4.0 | ECRcentral is developed with <span style="color: #e25555;">&#9829;</span> by eLife Ambassadors.</p>
              </center>
      </div>
    </div>
  </div>
 </div>
