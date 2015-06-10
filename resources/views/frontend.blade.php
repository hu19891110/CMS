<!doctype html>
    <html>
    <head>
        <meta charset="utf-8">
        <title>CloudMyIT</title>
        {!! HTML::style( asset('css/frontend.css') ) !!}
        {!! HTML::style( asset('/assets/vendor/ContentBuilder/assets/minimalist-basic/content.css') ) !!}
        @yield('css')
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    </head>

    <body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
        <div id="wrapper">
            <header>
                <nav class="navbar navbar-default  navbar-fixed-top" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"> <span class="sr-only">Toggle navigation</span>
                            <span class="glyphicon glyphicon-bar"></span>
                        <span
                                class="glyphicon glyphicon-bar"></span> <span class="glyphicon glyphicon-bar"></span>
                        </button>
                    </div>
                    <div class="container">
                        <div class="navbar-header page-scroll"> <a class="navbar-navbar-brand" href="{{URL::page()}}">

                                <img alt="logo" src="/images/logo.png" class="img-responsive" />

                            </a>
                        </div>
                        <div class="collapse navbar-collapse navbar-ex1-collapse">
                            @include('frontend._partials.navigation')
                        </div>
                    </div>
                </nav>
            </header>
            <main>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12" id="alert-area">
                            @include('backend._partials.errors')
                        </div>
                    </div>
                    @yield('content',"Content Goes Here")
                </div>
            </main>
            <footer>
                <!-- Footer-->
                <section class="contact" style="background:#d0d0d2;">
                    <div class="container">
                        <div class="col-md-4">
							<form action="/email.php">
								<h1>Contact Form</h1>
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Name" id="name" name="name" required data-validation-required-message="Please enter your name.">
									<p class="help-block text-danger"></p>
								</div>
								<div class="form-group">
									<input type="email" class="form-control" placeholder="Email" id="email" name="email" required data-validation-required-message="Please enter your email address.">
									<p class="help-block text-danger"></p>
									<textarea id="message" class="form-control textar" placeholder="Message" name="message" required data-validation-required-message="Please enter a message."></textarea>
									<button class="btn btn-xl hang" type="submit">Send</button>
								</div>
							</form>
                        </div><!--col-md-4-->
                        <div class="col-md-5"></div>
                        <div class="col-md-3">
                            <h1>Contact Info</h1>
                            <ul>
                                <li>
                                    <div class="icon-set-wrap">
                                        <div class="icon-set"><a><i class="fa fa-map-marker"></i></a></div>
                                        <div class="content-icon-set">New Paltz, NY</div>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon-set-wrap">
                                        <div class="icon-set"><a><i class="fa  fa-envelope"></i></a></div>
                                        <div class="content-icon-set"><a href="mailto:support@cloudmy.it">support@cloudmy.it</a> </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon-set-wrap">
                                        <div class="icon-set"><a><i class="fa  fa-phone "></i></a></div>
                                        <div class="content-icon-set">+1 845 202 0395</div>
                                    </div>
                                </li>
                            </ul>
                            <ul class="social-links">
                                <li><a target="_blank" href="https://www.facebook.com/Cloudmyit"><i class="fa fa-facebook"></i></a></li>
                                <li><a target="_blank" href="https://www.twitter.com/cloudmyit"><i class="fa fa-twitter"></i></a></li>
                                <li><a target="_blank" href="https://www.github.com/cloudmyit"><i class="fa fa-github"></i></a></li>
                            </ul>
                        </div>

                    </div><!--container-->
                </section>

                <section class="footer">
                    <div class="copyright">© {{\Carbon\Carbon::now()->year}} Cloudmyit - All rights reserved</div>
                </section>
            </footer>
        </div>
        {!! HTML::script( asset('js/frontend.js') ) !!}
        @yield('javascript')
        <script>
            function errorJson(json)
            {
                $.each(json.responseJSON, function(key, value){
                    var str = '@oneLine('backend._partials.jsonError')';
                    $('#alert-area').append(str) ;
                });
            }
            $( document ).ready()
            {
                $('#alert-area').bind('DOMNodeInserted', function(event) {
                    setTimeout(function() {
                        $(".autoClose").fadeOut(1000);
                    },3000);

                });
            }
        </script>
    </body>
    </html>
