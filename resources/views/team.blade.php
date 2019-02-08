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
                <h3 class="page-header">Team
                    <small>ECRcentral</small>
                </h3>
            </div>
        </div>
        <!-- /.row -->

        <!-- Intro Content -->
        <div class="row">
            <div class="col-md-2">
                <img class="img-responsive" src="https://pbs.twimg.com/profile_images/966290540609327105/xC87gxfk_400x400.jpg" alt="">
            </div>
            <div class="col-md-10">
                <blockquote>
                    <strong>ECRcentral</strong> is a community-driven initiative which was started by <a href="https://elifesciences.org/inside-elife/912b0679/early-career-advisory-group-elife-welcomes-150-ambassadors-of-good-practice-in-science" target="_blank" rel="noopener noreferrer">eLife Ambassadors 2018</a>. The eLife Ambassador program supports the development of new initiatives ranging from preprints, reproducibility, and funding, by facilitating local discussions and connecting communities with international developments. In the funding initiative of this program, a group of Ambassadors teamed up to develop a central resource for early career research with comprehensive lists of research funding, travel grants, and useful resources. On the top of that - the team also created a community forum to ask questions and get help on funding. Although, many people had been involved directly or indirectly, but below are the core team members.
                </blockquote>
            </div>
        </div>
        <!-- /.row -->

        <!-- Team Members -->
        <div class="row">

            <div class="col-md-3 text-center">
                <div class="thumbnail">
                    <img class="img-responsive img-circle" src="https://pbs.twimg.com/profile_images/923604836389617665/ovO6lXHJ_400x400.jpg" alt="">
                    <div class="caption">
                        <h6>Aziz Khan
                        </h6>
                        <p>Aziz is a postdoctoral scientist at NCMM, University of Oslo, Norway, and leading the development of the ECRCentral project.</p>
                        <ul class="list-inline">
                            <li><a href="https://asntech.github.io/" target="_blank"><i class="fa fa-2x fa-globe"></i></a></li>
                            <li><a href="https://twitter.com/khanaziz84" target="_blank"><i class="fa fa-2x fa-twitter"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-3 text-center">
                <div class="thumbnail">
                    <img class="img-responsive img-circle" src="https://pbs.twimg.com/profile_images/843770023856488449/4LtasiD4_400x400.jpg" alt="">
                    <div class="caption">
                        <h6>Cristiana Cruceanu
                        </h6>
                        <p>Cristiana is a postdoctoral scientist at the Max Planck Institute of Psychiatry, Germany. Cristiana is managing the forums.</p>
                        <ul class="list-inline">
                            <li><a href="#"><i class="fa fa-2x fa-globe"></i></a></li>
                            <li><a href="https://twitter.com/DrCriCru" target="_blank"><i class="fa fa-2x fa-twitter"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-3 text-center">
                <div class="thumbnail">
                    <img class="img-responsive img-circle" src="{{ asset('images/team/juan.png') }}" alt="Juan Quintana">
                    <div class="caption">
                        <h6>Juan Quintana
                        </h6>
                        <p>Juan is postdoctoral scientist at the Wellcome Centre for Anti-Infectives Research, University of Dundee, UK. Juan is curating funding list.</p>
                        <ul class="list-inline">
                            <li><a href="http://orcid.org/0000-0002-5092-5576" target="_blank"><i class="fa fa-2x fa-globe"></i></a></li>
                            <li><a href="https://twitter.com/Jquintanalcala" target="_blank"><i class="fa fa-2x fa-twitter"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-3 text-center">
                <div class="thumbnail">
                    <img class="img-responsive img-circle" src="https://pbs.twimg.com/profile_images/862415239652020225/Pk7ozf8n_400x400.jpg" alt="">
                    <div class="caption">
                        <h6>Lotte de Winde
                        </h6>
                        <p>Lotte is a postdoctoral scientist at the MRC Laboratory for Molecular Cell Biology at UCL, UK. Lotte is curating travel grants.</p>
                        <ul class="list-inline">
                            <li><a href="/profile/LotteDW"><i class="fa fa-2x fa-globe"></i></a></li>
                            <li><a href="https://twitter.com/lotte_dewinde" target="_blank"><i class="fa fa-2x fa-twitter"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            
        </div>
        <!-- /.row -->
        <br><br>

    </div>
    <!-- /.container -->

@endsection

