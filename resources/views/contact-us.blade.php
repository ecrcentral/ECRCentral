@extends('layouts.app')

@section('template_title')
  Team members
@endsection

@section('template_linked_css')

@endsection

@section('content')
    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Contact
                    <small>Us</small>
                </h3>
                
            </div>
        </div>
        <!-- /.row -->
        <!-- Content Row -->
        <div class="row">
            <!-- Map Column -->
            <div class="col-md-8">
                <!-- Embedded Google Map -->
                <iframe width="100%" height="400px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?hl=en&amp;ie=UTF8&amp;ll=37.0625,-95.677068&amp;spn=56.506174,79.013672&amp;t=m&amp;z=4&amp;output=embed"></iframe>
            </div>
            <!-- Contact Details Column -->
            <div class="col-md-4">
                <h5>Contact details</h5>
                <p>
                    Oslo Science Park<br>Gaustadalléen 21, 0349 Oslo<br>
                </p>
                <p><i class="fa fa-phone"></i> 
                    <abbr title="Phone">P</abbr>: (+47) 22840563</p>
                <p><i class="fa fa-envelope-o"></i> 
                    <abbr title="Email">E</abbr>: <a href="mailto:aziz.khan@ncmm.uio.no">aziz.khan@ncmm.uio.no</a>
                </p>
                
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
        </div>
        <!-- /.row -->

        <!-- Contact Form -->
        <!-- In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
        <div class="row">
            <div class="col-md-8">
                <h5>Send us a Message</h5>
                <form name="sentMessage" id="contactForm" novalidate>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Full Name:</label>
                            <input type="text" class="form-control" id="name" required data-validation-required-message="Please enter your name.">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Organization:</label>
                            <input type="tel" class="form-control" id="organization" required data-validation-required-message="Please enter your organization.">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Email Address:</label>
                            <input type="email" class="form-control" id="email" required data-validation-required-message="Please enter your email address.">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Message:</label>
                            <textarea rows="10" cols="100" class="form-control" id="message" required data-validation-required-message="Please enter your message" maxlength="999" style="resize:none"></textarea>
                        </div>
                    </div>
                    <div id="success"></div>
                    <!-- For success/fail messages -->
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>

        </div>
        <!-- /.row -->
        <br><br>

        

    </div>
    <!-- /.container -->

@endsection
