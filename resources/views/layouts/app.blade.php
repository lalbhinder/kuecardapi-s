<?php
    $user_info= Auth::user();
    $url= url()->current();
    $value= basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <!--<link rel="shortcut icon" href="img/favicon.png">-->
    <title>KueCard</title>
    <link href="{{asset('dist/css')}}/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('dist/css')}}/bootstrap-reset.css" rel="stylesheet">
    <link href="{{asset('dist/font-awesome/css')}}/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('dist/css')}}/owl.carousel.css" type="text/css">
    <link href="{{asset('dist/css')}}/slidebars.css" rel="stylesheet">
    <link href="{{asset('dist/css')}}/style.css" rel="stylesheet">
    <link href="{{asset('dist/css')}}/style-responsive.css" rel="stylesheet" />
  </head>
  <body>

  <section id="container">

            <!--header start-->
      <header class="header white-bg">
            <a href="" class="logo">Kue<span>Card</span></a>

            <div class="top-nav ">
                <ul class="nav pull-right top-menu">
                    <li class="dropdown" style="margin-top: 12px;">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="username">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li><a href="{{url('change_password')}}"><i class=" fa fa-suitcase"></i>Change Password</a></li>
                            <li><a href="{{url('logout')}}"><i class="fa fa-key"></i> Log Out</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
        </header>


      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
                  <li>
                      <a class="active" href="">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>

                 <li>
                     <a class="" href="{{URL::to('/templates')}}" >
                         <i class="fa fa-mail"></i>
                         <span>Mange Templates</span>
                     </a>
                <!--      <ul class="sub">
                         <li><a  href="{{URL::to('/email-templates')}} ">Email Templates</a></li>
                         <li><a  href="">Calendar Templates</a></li>
                         <li><a  href="">Follow Up Templates</a></li>
                         <li><a  href="">Reminder Templates</a></li>
                     </ul> -->
                 </li>

                  <!--<li class="sub-menu">-->
                  <!--    <a href="javascript:;" >-->
                  <!--        <i class="fa fa-cogs"></i>-->
                  <!--        <span>Components</span>-->
                  <!--    </a>-->
                  <!--    <ul class="sub">-->
                  <!--        <li><a  href="grids.html">Grids</a></li>-->
                  <!--        <li><a  href="calendar.html">Calendar</a></li>-->
                  <!--        <li><a  href="gallery.html">Gallery</a></li>-->
                  <!--        <li><a  href="todo_list.html">Todo List</a></li>-->
                  <!--        <li><a  href="draggable_portlet.html">Draggable Portlet</a></li>-->
                  <!--        <li><a  href="tree.html">Tree View</a></li>-->
                  <!--    </ul>-->
                  <!--</li>-->

              </ul>
          </div>
      </aside>
<div class="clearfix"></div>

  <div class="col-md-12 col-sm-12">
<div class="row">

  @yield('content')
  <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              {{ date('Y') }} &copy; KueCard
              <a href="#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->

</div>
</div>
</section>

    <script src="{{asset('dist/js')}}/jquery.js"></script>
    <script src="{{asset('dist/js')}}/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="{{asset('dist/js')}}/jquery.dcjqaccordion.2.7.js"></script>
    <script src="{{asset('dist/js')}}/jquery.scrollTo.min.js"></script>
    <script src="{{asset('dist/js')}}/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="{{asset('dist/js')}}/jquery.sparkline.js" type="text/javascript"></script>
    <script src="{{asset('dist/js')}}/owl.carousel.js" ></script>
    <script src="{{asset('dist/js')}}/jquery.customSelect.min.js" ></script>
    <script src="{{asset('dist/js')}}/respond.min.js" ></script>
    <script src="{{asset('dist/js')}}/slidebars.min.js"></script>
    <script src="{{asset('dist/js')}}/common-scripts.js"></script>
    <script src="{{asset('dist/js')}}/sparkline-chart.js"></script>
    <script src="{{asset('dist/js')}}/count.js"></script>

  <script>

    //   $(document).ready(function() {

    //       $("#owl-demo").owlCarousel({
    //           navigation : true,
    //           slideSpeed : 300,
    //           paginationSpeed : 400,
    //           singleItem : true,
	// 		  autoPlay:true
    //       });
    //   });

    //   $(function(){
    //       $('select.styled').customSelect();
    //   });

  </script>
  </body>
</html>
