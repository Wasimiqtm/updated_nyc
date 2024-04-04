<div class="header-content">

    <!-- BEGIN .logo -->
    <div class="logo">

        <h2><a href="{{url('/')}}"><span class="logo-icon"><i class="fa fa-car" aria-hidden="true"></i></span>Nycblackcarservice</a></h2>

        <!-- END .logo -->
    </div>

    <!-- BEGIN .header-icons-wrapper -->
    <div class="header-icons-wrapper clearfix">
<center>
     
   <!--  <img src="wp-content/uploads/2017/02/seal.png" style="float: right;" alt="" />
     <img src="wp-content/uploads/2017/02/cards.gif" style="float: right;     border: 1px solid; margin-top: 22px;" alt="" />-->
     

</center>
        <!-- END .header-icons-wrapper -->
    </div>

    <div id="mobile-navigation">
        {{--<a href="#search-lightbox" data-gal="prettyPhoto"><i class="fa fa-search"></i></a>
        <a href="#" id="mobile-navigation-btn"><i class="fa fa-bars"></i></a>--}}
    </div>

    <div class="clearboth"></div>

    <!-- BEGIN .mobile-navigation-wrapper -->
    <div class="mobile-navigation-wrapper">

        <ul><li id="menu-item-527" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-316 current_page_item menu-item-527"><a href="{{url('/')}}" aria-current="page">Home</a></li>
            <li id="menu-item-499" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-499"><a href="{{url('about-us')}}">About Us</a></li>
            <li id="menu-item-551" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-551"><a href="{{url('services')}}">Services</a></li>
            <li id="menu-item-492" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-492"><a href="{{url('contact-us')}}">Contact Us</a></li>
        </ul>
        <!-- END .mobile-navigation-wrapper -->
    </div>

    <!-- END .header-content -->
</div>

<!-- BEGIN #primary-navigation -->
<nav id="primary-navigation" class="navigation-wrapper fixed-navigation clearfix">

    <!-- BEGIN .navigation-inner -->
    <div class="navigation-inner">

        <!-- BEGIN .navigation -->
        <div class="navigation">

            <ul><li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home {{Request::segment(1) == ''?'current-menu-item page_item page-item-316 current_page_item menu-item-527':''}}"><a href="{{url('/')}}" aria-current="page">Home</a></li>
                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-499 {{Request::segment(1) == 'about-us'?'current-menu-item page_item page-item-316 current_page_item menu-item-527':''}}"><a href="{{url('about-us')}}">About Us</a></li>
           <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-551 {{Request::segment(1) == 'services'?'current-menu-item page_item page-item-316 current_page_item menu-item-527':''}}"><a href="{{url('services')}}">Services</a></li>
                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-492 {{Request::segment(1) == 'contact-us'?'current-menu-item page_item page-item-316 current_page_item menu-item-527':''}}"><a href="{{url('contact-us')}}">Contact Us</a></li>
            </ul>
            <!-- END .navigation -->
        </div>

        {{--<a href="#search-lightbox" data-gal="prettyPhoto"><i class="fa fa-search"></i></a>--}}

        <!-- BEGIN #search-lightbox -->
        <div id="search-lightbox">

            <!-- BEGIN .search-lightbox-inner -->
            <div class="search-lightbox-inner">

               

                <!-- END .search-lightbox-inner -->
            </div>

            <!-- END #search-lightbox -->
        </div>

        <!-- END .navigation-inner -->
    </div>

    <!-- END #primary-navigation -->
</nav>

<!-- END .header-area-1 -->
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-G3BMBS7V6M"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-G3BMBS7V6M');
</script>