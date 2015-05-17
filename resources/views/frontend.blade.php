<!doctype html>
    <html>
    <head>
        <meta charset="utf-8">
        <title>CloudMyIT</title>
        {!! HTML::style( asset('css/frontend.css') ) !!}
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    </head>

    <body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

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
                <div class="navbar-header page-scroll"> <a class="navbar-navbar-brand" href="index.html">

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
        <div class="row">
            <div class="col-lg-12" id="alert-area">
                @include('backend._partials.errors')
            </div>
        </div>
        @yield('content',"")
    </main>
    <footer>
        <!-- Footer-->
        <section class="contact" style="background:#d0d0d2;">
            <div class="container">
                <div class="col-md-2">
                    <h1>Navigation</h1>

                    <ul class="list-2">
                        <li><a href="#_"><span><img src="/images/arrow.png"></span>Products</a></li>
                        <li><a href="#_"><span><img src="/images/arrow.png"></span>Enterprise

                            </a></li>
                        <li><a href="#_"><span><img src="/images/arrow.png"></span>Partners</a></li>
                        <li><a href="#_"><span><img src="/images/arrow.png"></span>
                                Blog</a></li>
                        <li><a href="#_"><span><img src="/images/arrow.png"></span>About</a></li>
                        <li><a href="#_"><span><img src="/images/arrow.png"></span>Resurces</a></li>
                    </ul>
                </div><!--col-md-2-->

                <div class="col-md-4">
                    <h1>Contact Form</h1>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Name" id="name" required data-validation-required-message="Please enter your name.">
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email" id="email" required data-validation-required-message="Please enter your email address.">
                        <p class="help-block text-danger"></p>
                        <textarea id="message" class="form-control textar" placeholder="Message" required data-validation-required-message="Please enter a message."></textarea>
                        <button class="btn btn-xl hang" type="submit">Send</button>
                    </div>

                </div><!--col-md-4-->
                <div class="col-md-3">
                    <div class="Flexible-container">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d11907.07914860237!2d-74.08122871713867!3d41.747058205182434!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sus!4v1431574247804" frameborder="0"></iframe>
                    </div><!--Flexible-container-->
                </div><!--col-md-3-->

                <div class="col-md-3">
                    <h1>Contact Info</h1>
                    <ul>
                        <li>
                            <div class="icon-set-wrap">
                                <div class="icon-set"><a><i class="fa fa-map-marker   "></i></a></div>
                                <div class="content-icon-set">4567 Street name,
                                    012 12 City name, Country </div>
                            </div>
                        </li>
                        <li>
                            <div class="icon-set-wrap">
                                <div class="icon-set"><a><i class="fa  fa-envelope"></i></a></div>
                                <div class="content-icon-set"><a href="mailto:info@xtremesp.org">info@cloudmyit.com</a> </div>
                            </div>
                        </li>
                        <li>
                            <div class="icon-set-wrap">
                                <div class="icon-set"><a><i class="fa  fa-phone "></i></a></div>
                                <div class="content-icon-set">
                                    +000 000 0000</div>
                            </div>
                        </li>
                    </ul>
                    <ul class="social-links">
                        <li><a target="_blank" href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a></li>
                        <li class="active"><a target="_blank" href="https://twitter.com/"><i class="fa fa-twitter"></i></a></li>
                        <li><a target="_blank" href="https://www.google.com/"><i class="fa fa-google-plus"></i></a></li>
                        <li><a target="_blank" href="https://www.pinterest.com/"><i class="fa fa-pinterest-p"></i></a></li>
                    </ul>
                </div>

            </div><!--container-->
        </section>

        <section class="footer">
            <div class="copyright">© {{\Carbon\Carbon::now()->year}} Cloudmyit - All rights reserved</div>
        </section>
    </footer>
    {!! HTML::script( asset('js/frontend.js') ) !!}
    @yield('javascript')

    </body>
    </html>
