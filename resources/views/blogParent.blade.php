
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Zach Mueller</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="About Zach Mueller" />
  <meta name="keywords" content="" />
  <meta name="author" content="Zach Mueller" />

    <!-- 
  //////////////////////////////////////////////////////

  FREE HTML5 TEMPLATE 
  DESIGNED & DEVELOPED by FreeHTML5.co
    
  Website:    http://freehtml5.co/
  Email:      info@freehtml5.co
  Twitter:    http://twitter.com/fh5co
  Facebook:     https://www.facebook.com/fh5co

  //////////////////////////////////////////////////////
  -->

    <!-- Facebook and Twitter integration -->
  <meta property="og:title" content=""/>
  <meta property="og:image" content=""/>
  <meta property="og:url" content=""/>
  <meta property="og:site_name" content=""/>
  <meta property="og:description" content=""/>
  <meta name="twitter:title" content="" />
  <meta name="twitter:image" content="" />
  <meta name="twitter:url" content="" />
  <meta name="twitter:card" content="" />

  <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
  <link rel="shortcut icon" href="./favicon.ico">

  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">
  
  <!-- Animate.css -->
  <link rel="stylesheet" href="/css/animate.css">
  <!-- Icomoon Icon Fonts-->
  <link rel="stylesheet" href="/css/icomoon.css">
  <!-- Bootstrap  -->
  <link rel="stylesheet" href="/css/bootstrap.css">
  <!-- Flexslider  -->
  <link rel="stylesheet" href="/css/flexslider.css">
  <!-- Theme style  -->
  <link rel="stylesheet" href="/css/style.css">


   <link href="https://cdn.quilljs.com/1.3.5/quill.snow.css" rel="stylesheet">

   <!-- include the style -->
    <link rel="stylesheet" href="/css/alertify.min.css" />
    <!-- include a theme -->
    <link rel="stylesheet" href="/css/themes/default.min.css" />
  


  <!-- Modernizr JS -->
  <script src="/js/modernizr-2.6.2.min.js"></script>
  <!-- FOR IE9 below -->
  <!--[if lt IE 9]>
  <script src="js/respond.min.js"></script>
  <![endif]-->

  <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

  </head>
  <body>
  <div id="fh5co-page">
    <a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle"><i></i></a>
    <aside id="fh5co-aside" role="complementary" class="border js-fullheight" style="overflow-y: hidden;">

      <h1 id="fh5co-logo"><a href="/">Blog</a></h1>
      <nav id="fh5co-main-menu" role="navigation">
        <ul>
          <li id="selector-home" class="fh5co-active"><a href="/">Home</a></li>
          <li id="selector-posts" ><a href="/posts">Blog Posts</a></li>
          <li id="selector-portfolio" ><a href="/portfolio">Portfolio</a></li>
          <li id="selector-about" ><a href="/about">About</a></li>
          <li id="selector-contact" ><a href="/contact">Contact</a></li>
        </ul>
      </nav>

      <div class="fh5co-footer">
        <p><small></small></p>
        <ul>
          @if (Auth::check())
          <li><a href="/profile">{{ Auth::user()->name}}</a></li>
          @else
          <li><a href="/login">Login</a></li>|
          <li><a href="/register">Register</a></li>
          @endif
        </ul>
      </div>

    </aside>

    <div id="fh5co-main">
      @yield('content')
    </div>
  </div>

  <!-- jQuery -->
  <script src="/js/jquery.min.js"></script>
  <!-- jQuery Easing -->
  <script src="/js/jquery.easing.1.3.js"></script>
  <!-- Bootstrap -->
  <script src="/js/bootstrap.min.js"></script>
  <!-- Waypoints -->
  <script src="/js/jquery.waypoints.min.js"></script>
  <!-- Flexslider -->
  <script src="/js/jquery.flexslider-min.js"></script>

  <script src="/js/alertify.js"></script>
  
  <script src="https://cdn.quilljs.com/1.3.5/quill.js"></script>

  @yield('javascript')
  
  @if(isset($notification))
  <script>alertify.warning('{{ $notification }}');</script>
  @endif

  @if (session('notification'))
  
    <script>
      alertify.{{ session('notificationType') ?: 'message' }}('{{session('notification')}}');
    </script>
  @endif
  <!-- MAIN JS -->
  <script src="/js/main.js"></script>
    
  <script>
    $(document).ready(function(){
      var pathname = window.location.pathname;
      if(pathname == '/'){
        //do nothing, correct by default
      }
      else if (pathname.startsWith('/post')){
        $('#selector-home').removeClass('fh5co-active');
        $('#selector-posts').addClass('fh5co-active');
      }
    })
  </script>
  </body>
</html>