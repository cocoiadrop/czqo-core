<!DOCTYPE HTML>
<html lang="en">
    <head>
        <!--
        {{App\Models\Settings\CoreSettings::where('id', 1)->firstOrFail()->sys_name}}
        {{App\Models\Settings\CoreSettings::where('id', 1)->firstOrFail()->release}} ({{App\Models\Settings\CoreSettings::where('id', 1)->firstOrFail()->sys_build}})
        Built on Bootstrap 4 and Laravel 6

        Written by Liesel D

          sSSs. sSSSSSs   sSSSs     sSSSs
         S           s   S     S   S     S
        S           s   S       S S       S
        S          s    S       S S       S
        S         s     S       S S       S
         S       s       S   s S   S     S
          "sss' sSSSSSs   "sss"ss   "sss"

        For Flight Simulation Use Only - Not To Be Used For Real World Navigation. All content on this web site may not be shared, copied, reproduced or used in any way without prior express written consent of Gander Oceanic. © Copyright {{App\Models\Settings\CoreSettings::where('id', 1)->firstOrFail()->copyright_year}} Gander Oceanic, All Rights Reserved.

        Taking a peek under the hood and like what you see? Want to help out? Send Liesel an email! deputy@ganderoceanic.com
        -->
        <!--Metadata-->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!--Rich Preview Meta-->
        <title>@yield('title', '')Gander Oceanic VATSIM</title>
        <meta name="description" content="@yield('description', '')">
        <meta name="theme-color" content="#0080c9">
        <meta name="og:title" content="@yield('title', '')Gander Oceanic VATSIM">
        <meta name="og:description" content="@yield('description', '')">
        <meta name="og:image" content="@yield('image','https://resources.ganderoceanic.com/media/img/brand/sqr/ZQO_SQ_TSPBLUE.png')">
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
        <!-- Bootstrap core CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.1.3/materia/bootstrap.min.css" rel="stylesheet" integrity="sha384-5bFGNjwF8onKXzNbIcKR8ABhxicw+SC1sjTh6vhSbIbtVgUuVTm2qBZ4AaHc7Xr9" crossorigin="anonymous">        <!-- Material Design Bootstrap -->
        <!-- Material Design Bootstrap -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/css/mdb.min.css" rel="stylesheet">
        <!-- JQuery -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!-- Bootstrap tooltips -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/js/mdb.min.js"></script>
        <!--CZQO specific CSS and JS-->
        @if (Auth::check())
        @switch (Auth::user()->preferences)
            @case("default")
            <link href="{{ asset('css/czqomd.css') }}" rel="stylesheet">
            @break
            @default
            <link href="{{ asset('css/czqomd.css') }}" rel="stylesheet">
        @endswitch
        @else
        <link href="{{ asset('css/czqomd.css') }}" rel="stylesheet">
        @endif
        <script src="{{asset('js/czqo.js')}}"></script>
        <!--Leaflet-->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==" crossorigin=""/>
        <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js" integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg==" crossorigin=""></script>
        <script src="{{asset('/js/leaflet.rotatedMarker.js')}}"></script>
        <!--TinyMCE-->
        <script src='https://cloud.tinymce.com/5/tinymce.min.js?apiKey=k2zv68a3b4m423op71lnifx4a9lm0a2ee96o58zafhrdnddb'></script>
        <!--DataTables-->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>
        <!--IntroJS-->
        <link rel="stylesheet" href="{{asset('introjs/introjs.min.css')}}">
        <script src="{{asset('introjs/intro.min.js')}}"></script>
        <!--Date picker-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <!--SimpleMDE-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
        <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
        <!--Jarallax-->
        <script src="https://unpkg.com/jarallax@1/dist/jarallax.min.js"></script>
        <script src="https://unpkg.com/jarallax@1/dist/jarallax-video.min.js"></script>
        <script src="https://unpkg.com/jarallax@1/dist/jarallax-element.min.js"></script>
        <!--Image picker and masonry-->
        <script src="{{asset('js/image-picker.min.js')}}"></script>
        <link rel="stylesheet" href="{{asset('css/image-picker.css')}}">
        <script src="{{asset('js/masonry.pkgd.min.js')}}"></script>
        <!--Chart js-->
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>
    </head>
    <body @if(Auth::check() && Auth::user()->preferences) data-theme="{{Auth::user()->preferences->ui_mode}}" @else data-theme="light" @endif>
    <!--Header-->
    @include('maintenancemode::notification')
    @if (\App\Models\Settings\CoreSettings::where('id', 1)->firstOrFail()->banner)
        <div class="alert alert-{{\App\Models\Settings\CoreSettings::where('id', 1)->firstOrFail()->bannerMode}}" style="margin: 0; border-radius: 0; border: none;">
            <div class="text-center align-self-center">
                <a href="{{\App\Models\Settings\CoreSettings::where('id', 1)->firstOrFail()->bannerLink}}"><span style="margin: 0;">{{\App\Models\Settings\CoreSettings::where('id', 1)->firstOrFail()->banner}}</span></a>
            </div>
        </div>
    @endif
    <header>
        <nav id="czqoHeaderLight" class="navbar navbar-expand-lg navbar-dark blue p-0" style="min-height:59px;">
            <div class="container">
                <a class="navbar-brand" href="{{route('index')}}"><img style="height: 40px; width:auto;" id="czqoHeaderImg" src="https://resources.ganderoceanic.com/media/img/brand/bnr/ZQO_BNR_TSPWHITE.png" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item {{ Request::is('roster/*') || Request::is('roster') ? 'active' : '' }}">
                            <a class="nav-link" href="{{route('roster.public')}}">
                                Roster
                            </a>
                        </li>
                        <li class="nav-item {{ Request::is('news') ? 'active white-text' : '' }} {{ Request::is('news/*') ? 'active white-text' : '' }}">
                            <a class="nav-link" href="{{route('news')}}">
                                News
                            </a>
                        </li>
                        <li class="nav-item {{ Request::is('events/*') || Request::is('events') ? 'active' : '' }}">
                            <a href="{{route('events.index')}}" class="nav-link">Events</a>
                        </li>
                        <li class="nav-item dropdown {{ Request::is('dashboard/application') || Request::is('dashboard/application/*') || Request::is('atcresources') ? 'active' : '' }}">
                            <a class="nav-link dropdown-toggle" style="cursor:pointer" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ATC</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown01">
                                @unlessrole('guest')
                                    <a class="dropdown-item {{ Request::is('dashboard/application/list') ? 'active white-text' : '' }}" href="{{url ('/dashboard/application/list')}}">Your Applications</a>
                                @else
                                    <a class="dropdown-item {{ Request::is('dashboard/application') ? 'active white-text' : '' }}" href="{{url ('/dashboard/application/')}}">Apply for CZQO</a>
                                @endunlessrole
                                <a class="dropdown-item {{ Request::is('atcresources') ? 'active white-text' : '' }}" href="{{route('atcresources.index')}}">ATC Resources</a>
                                <a href="{{route('eurosounds')}}" class="dropdown-item {{ Request::is('eurosounds') ? 'active white-text' : '' }}">EuroSounds</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown {{ Request::is('pilots/oceanic-clearance') || Request::is('pilots/position-report') || Request::is('pilots/vatsim-resources') || Request::is('pilots/tutorial') || Request::is('pilots/tracks') ? 'active' : '' }}">
                            <a class="nav-link dropdown-toggle" style="cursor:pointer" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilots</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown01">
                                <a class="dropdown-item {{ Request::is('pilots/oceanic-clearance') ? 'active white-text' : '' }}" href="{{url('/pilots/oceanic-clearance')}}">Oceanic Clearance Generator</a>
                                <a class="dropdown-item {{ Request::is('pilots/position-report') ? 'active white-text' : '' }}" href="{{url('/pilots/position-report')}}">Position Report Generator</a>
                                <a class="dropdown-item {{ Request::is('pilots/tracks') ? 'active white-text' : ''}}" href="{{url('/pilots/tracks')}}">Current NAT Tracks</a>
                                <a class="dropdown-item" href="https://www.vatsim.net/pilots/resources" target="_blank">VATSIM Resources</a>
                                <a class="dropdown-item" href="https://nattrak.vatsim.net" target="_blank">natTRAK</a>
                                <a class="dropdown-item" href="{{url('/map')}}">Map</a>
                            </div>
                        </li>
                        <li class="nav-item  {{ Request::is('staff') ? 'active' : '' }}">
                            <a class="nav-link" href="{{url ('/staff')}}" aria-expanded="false">Staff</a>
                        </li>
                        <li class="nav-item dropdown {{ Request::is('policies') || Request::is('meetingminutes') ? 'active' : ''}}">
                            <a class="nav-link dropdown-toggle" style="cursor:pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Publications</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown01">
                                <a class="dropdown-item {{ Request::is('policies') ? 'active white-text' : '' }}" href="{{route('policies')}}">Policies</a>
                                <a class="dropdown-item {{ Request::is('meetingminutes') ? 'active white-text' : '' }}" href="{{route('meetingminutes')}}">Meeting Minutes</a>
                                <a class="dropdown-item" href="https://blog.ganderoceanic.com">Blog</a>
                            </div>
                        </li>
                        <li class="nav-item  {{ Request::is('feedback') ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('feedback.create')}}" aria-expanded="false">Submit Feedback</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto nav-flex-icons">
                        @unless (Auth::check())
                        <li class="nav-item d-flex align-items-center">
                            {{-- <a href="{{route('auth.sso.login')}}" class="nav-link waves-effect waves-light">
                                <i class="fas fa-key"></i>&nbsp;Login
                            </a> --}}
                            <a href="{{route('auth.connect.login')}}" class="nav-link waves-effect waves-light">
                                <i class="fas fa-key"></i>&nbsp;Login with VATSIM
                            </a>
                        </li>
                        @endunless
                        @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{Auth::user()->avatar()}}" style="height: 27px; width: 27px; margin-right: 7px; margin-bottom: 3px; border-radius: 50%;">&nbsp;<span class="font-weight-bold">{{Auth::user()->fullName("F")}}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-default py-0" aria-labelledby="navbarDropdownMenuLink-333">
                                <a class="dropdown-item {{ Request::is('dashboard') || Request::is('dashboard/*') ? 'active white-text' : '' }}" href="{{route('dashboard.index')}}">
                                    <i class="fa fa-tachometer-alt mr-2"></i>&nbsp;Dashboard
                                </a>
                                <a class="dropdown-item red-text" href="{{route('auth.logout')}}">
                                    <i class="fa fa-key mr-2"></i>&nbsp;Logout
                                </a>
                            </div>
                        </li>
                        @endauth
                        <li class="nav-item d-flex align-items-center">
                            <a href="https://twitter.com/ganderocavatsim" class="nav-link waves-effect waves-light">
                                <i style="font-size: 1.7em;" class="fab fa-twitter"></i>
                            </a>
                        </li>
                        <li class="nav-item d-flex align-items-center">
                            <a href="https://www.facebook.com/ganderocavatsim" class="nav-link waves-effect waves-light">
                                <i style="font-size: 1.7em;" class="fab fa-facebook"></i>
                            </a>
                        </li>
                        <li class="nav-item d-flex align-items-center">
                            <a class="nav-link waves-effect waves-light" data-toggle="modal" data-target="#discordTopModal">
                                <i style="height: 22px; font-size: 1.7em;width: 28px;padding-left: 5px;padding-top: 2px;" class="fab fa-discord"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    @if ($errors->any())
        <div class="alert alert-danger" style="margin: 0; border-radius: 0; border: none;">
            <div class="container">
                @foreach ($errors->all() as $error)
                    {{ $error }} <br>
                @endforeach
            </div>
        </div>
    @endif
    @if (\Session::has('success'))
        <div class="alert alert-success" style="margin: 0; border-radius: 0; border: none;">
            <div class="container">
                {!! \Session::get('success') !!}
            </div>
        </div>
    @endif
    @if (\Session::has('error'))
        <div class="alert alert-danger" style="margin: 0; border-radius: 0; border: none;">
            <div class="container">
                {!! \Session::get('error') !!}
            </div>
        </div>
    @endif
    @if (\Session::has('info'))
        <div class="alert alert-info" style="margin: 0; border-radius: 0; border: none;">
            <div class="container">
                {!! \Session::get('info') !!}
            </div>
        </div>
    @endif
    <!--End header-->
    <div id="czqoContent">
        @yield('content')
    </div>
    <!-- Footer -->
    <!-- Footer -->
    <footer class="page-footer text-dark font-small py-4 {{Request::is('/dashboard') ? 'mt-5' : ''}}">
        <div class="container">
            <p>For Flight Simulation Use Only - Not To Be Used For Real World Navigation. Any and all proprietary content available on this website may not be shared, copied, reproduced or used in any way without providing credit to the Gander Oceanic FIR - VATCAN. If in doubt, contact the Deputy FIR Chief.</p>
            <p>Copyright © {{App\Models\Settings\CoreSettings::where('id', 1)->firstOrFail()->copyright_year}} Gander Oceanic - All Rights Reserved.</p>
            <div class="flex-left mt-3">
                <a href="{{route('feedback.create')}}" class="font-weight-bold black-text">Feedback</a>
                &nbsp;
                •
                &nbsp;
                <a href="{{route('about')}}" class="font-weight-bold black-text">About</a>
                &nbsp;
                •
                &nbsp;
                <a href="{{route('privacy')}}" class="font-weight-bold black-text">Privacy Policy</a>
                &nbsp;
                •
                &nbsp;
                <a href="https://github.com/gander-oceanic-fir-vatsim/czqo-core" class="font-weight-bold black-text">GitHub</a>
                &nbsp;
                •
                &nbsp;
                <a href="{{route('branding')}}" class="font-weight-bold black-text">Branding</a>
                &nbsp;
                •
                &nbsp;
                <a href="#" data-toggle="modal" data-target="#contactUsModal" class="font-weight-bold black-text">Contact Us</a>
                &nbsp;
                •
                &nbsp;
                <a href="https://vatsim.net" class="font-weight-bold black-text">VATSIM</a>
                &nbsp;
                •
                &nbsp;
                <a href="https://vatcan.ca" class="font-weight-bold black-text">VATCAN</a>
            </div>
            <div class="mt-3">
                <img style="height: 20px;" src="https://upload.wikimedia.org/wikipedia/commons/8/8a/LGBT_Rainbow_Flag.png" alt="">
                <img style="height: 20px;" src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b0/Transgender_Pride_flag.svg/1280px-Transgender_Pride_flag.svg.png" alt="">
                <img src="https://cdn.discordapp.com/attachments/482817676067209217/695255571623837837/220px-Bisexual_Pride_Flag.png" style="height:20px;" alt="">
            </div>
            <div class="mt-3">
                <a href="{{route('about')}}"><small class="text-muted">{{App\Models\Settings\CoreSettings::where('id', 1)->firstOrFail()->sys_name}} {{App\Models\Settings\CoreSettings::where('id', 1)->firstOrFail()->release}} ({{App\Models\Settings\CoreSettings::where('id', 1)->firstOrFail()->sys_build}})</small></a> <small>- <a target="_blank" href="https://blog.ganderoceanic.com/gander-oceanic-core-update-log/" class="text-muted">Update Log</a></small>
            </div>
        </div>
    </footer>
    <!-- Footer -->
    @if (Auth::check() && Auth::user()->init == 0 && Request::is('privacy') == false)
    <!--Privacy welcome modal-->
    <div class="modal fade" id="welcomeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Welcome to CZQO!</b></h5>
                </div>
                <div class="modal-body">
                    Welcome to the Gander Oceanic Core system. Here you can apply for a CZQO certification, organise your
                    training, and access important pilot and controller resources. Before
                    we allow you to use the system, we require you to accept our Privacy Policy. The Policy is available
                    <a target="_blank" href="{{url('/privacy')}}">here.</a>
                    By default, you are <b>not</b> subscribed to non-essential email notifications. Head to the Dashboard and click on Manage my Preferences to
                    subscribe, we highly recommend it!
                </div>
                <div class="modal-footer">
                    <a role="button" href="{{ URL('/privacydeny') }}" class="btn btn-outline-danger">I disagree</a>
                    <a href="{{url('/privacyaccept')}}" role="button" class="btn btn-success">I agree</a>
                </div>
            </div>
        </div>
    </div>
        <script>
            $('#welcomeModal').modal({backdrop: 'static'});
            $('#welcomeModal').modal('show');
        </script>
    <!-- End privacy welcome modal-->
    @endif
    <!-- Contact us modal-->
    <div class="modal fade" id="contactUsModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Contact CZQO</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    To contact us, please do one of the following:
                    <ol>
                        <li>Login and open a <a href="{{route('tickets.index')}}">support ticket.</a></li>
                        <li>Head to the <a href="{{route('staff')}}">staff page</a> and email the relevant staff member.</li>
                        <li>Join our <a href="https://discord.gg/MvPVAHP">Discord server</a> and ask in the #westons-at-the-airport channel.</li>
                    </ol>
                    <b>If your query is related to ATC coverage for your event, please visit <a href="{{route('events.index')}}">this page.</a></b>
                </div>
            </div>
        </div>
    </div>
    <!-- End contact us modal-->
    @if (\Session::has('error-modal'))
    <!-- Error modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><span class="font-weight-bold red-text"><i class="fas fa-exclamation-circle"></i> An error occurred...</span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{\Session::get('error-modal')}}
                    <div class="alert black-text bg-czqo-blue-light mt-4">
                        If you believe this is a mistake, please create a <a target="_blank" class="black-text" href="{{route('tickets.index')}}">support ticket.</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    $("#errorModal").modal();
    </script>
    <!-- End error modal -->
    @endif
    <!-- Start Discord (top nav) modal -->
    <div class="modal fade" id="discordTopModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Join the CZQO Discord</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img style="height: 50px;" src="{{asset('/img/discord/czqoplusdiscord.png')}}" class="img-fluid mb-2" alt="">
                    <p>To link your Discord account and join our Discord community, please head to your <a href="{{route('dashboard.index')}}">dashboard.</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- End Discord (top nav) modal -->
    <!-- Start Connect modal -->
    <div class="modal fade" id="connectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Login with VATSIM</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Gander Oceanic uses VATSIM Connect (auth.vatsim.net) for authentication. This is similar to SSO, but allows you to select specific data to share with us. Click 'Login' below to continue.</p>
                    <p><small>If you are having issues with Connect, please send an email to the Deputy FIR Chief and use <a href="{{route('auth.sso.login')}}">SSO to login.</a></small></p>
                </div>
                <div class="modal-footer">
                    <a href="{{route('auth.connect.login')}}" role="button" class="btn bg-czqo-blue-light">Login</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Connect modal -->
    <script type="text/javascript">
        Dropzone.options.dropzone =
            {
                maxFilesize: 12,
                renameFile: function (file) {
                    var dt = new Date();
                    var time = dt.getTime();
                    return time + file.name;
                },
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                timeout: 5000,
                success: function (file, response) {
                    console.log(response);
                },
                error: function (file, response) {
                    return false;
                }
            };
    </script>
    <script>
        $("blockquote").addClass('blockquote');
    </script>
    </body>
</html>
