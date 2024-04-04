<head>

    <!--Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    
<title>@yield('title')</title>
<meta content="@yield('meta_keywords')" name="keywords">
<meta content="@yield('meta_description')" name="description">

    
    
    
    <link rel='dns-prefetch' href='https://maps.googleapis.com/' />
    <link rel='dns-prefetch' href='https://fonts.googleapis.com/' />
    <link rel='dns-prefetch' href='https://s.w.org/' />
    <link rel="alternate" type="application/rss+xml" title="Nyc Black Car Service &raquo; Feed" href="feed/index.html" />
    <link rel="alternate" type="application/rss+xml" title="Nyc Black Car Service &raquo; Comments Feed" href="comments/feed/index.html" />
    <style type="text/css">
        img.wp-smiley,
        img.emoji {
            display: inline !important;
            border: none !important;
            box-shadow: none !important;
            height: 1em !important;
            width: 1em !important;
            margin: 0 .07em !important;
            vertical-align: -0.1em !important;
            background: none !important;
            padding: 0 !important;
        }
        
       // .large-header-wrapper{
         //   height: 541px;
            
        }
        .booking-form-1{
            background: #00002b !important;
        }
       // .header-booking-form-wrapper{
         //   margin-left: 710px;
        }
        .top-bar-wrapper{
            display:none;
        }
        .header-area-1 .header-content
        {
            padding: 9px 0px !important;
        }
    </style>
    <link rel='stylesheet' id='wp-block-library-css'  href="{{asset('wp-includes/css/dist/block-library/style.min7661.css?ver=5.4.2')}}" type='text/css' media='all' />
    <link rel='stylesheet' id='style-css'  href="{{asset('wp-content/plugins/chauffeur-shortcodes-post-types/assets/css/style7661.css?ver=5.4.2')}}" type='text/css' media='all' />
    <link rel='stylesheet' id='contact-form-7-css'  href="{{asset('wp-content/plugins/contact-form-7/includes/css/styles38c6.html?ver=5.1.9')}}" type='text/css' media='all' />
    <link rel='stylesheet' id='rs-plugin-settings-css'  href="{{asset('wp-content/plugins/revslider/public/assets/css/settingsf542.css?ver=5.4.8.3')}}" type='text/css' media='all' />
    <style id='rs-plugin-settings-inline-css' type='text/css'>
        #rs-demo-id {}
    </style>
    <link rel='stylesheet' id='wp-pagenavi-css'  href="{{asset('wp-content/plugins/wp-pagenavi/pagenavi-css44fd.css?ver=2.70')}}" type='text/css' media='all' />
    <link rel='stylesheet' id='chauffeur_color_red-css'  href="{{asset('wp-content/themes/chauffeur/framework/css/color-red7661.css?ver=5.4.2')}}" type='text/css' media='all' />
    <link rel='stylesheet' id='chauffeur_style-css'  href="{{asset('wp-content/themes/chauffeur/style7661.css?ver=5.4.2')}}" type='text/css' media='all' />
    
    <link rel='stylesheet' href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" type='text/css' media='all' />
    <style id='chauffeur_style-inline-css' type='text/css'>
        .logo-icon,
        .header-area-1 .topright-button,
        .header-area-2 .topright-button,
        .header-area-1 .navigation li a:hover,
        .header-area-1 .navigation li.current-menu-item > a,
        .header-area-1 .navigation li.current_page_item > a,
        .mobile-navigation-wrapper li.current-menu-item > a,
        .header-area-2 .navigation li li a:hover,
        .mobile-navigation-wrapper ul li li a:hover,
        .mobile-navigation-wrapper ul li li li a:hover,
        .rev-custom-caption-1 .title-block1,
        .rev-custom-caption-2 .title-block1,
        .slideshow-button,
        .title-block2,
        .title-block3,
        .fleet-block-wrapper .fleet-block-content .fleet-price,
        .header-booking-form-wrapper #booking-tabs ul li.ui-state-active a,
        .widget-booking-form-wrapper #booking-tabs ul li.ui-state-active a,
        .booking-form-1 button,
        #ui-datepicker-div a:hover,
        .owl-theme .owl-dots .owl-dot span,
        #booking-tabs-2 .booking-form-2 button,
        #booking-tabs-2 .booking-form-3 button,
        .widget-block,
        .page-not-found-search-form button,
        .button2,
        .button4,
        .button6,
        .link-arrow,
        .main-content button,
        #submit-button,
        .content-wrapper form .wpcf7-submit,
        .main-content .search-results-form button,
        .accordion h4:before,
        .toggle h4:before,
        .button0,
        .title-block4,
        .call-to-action-2-section .title-block5,
        .newsletter-form button,
        .title-block6,
        .title-block7,
        #booking-tabs-2 .nav li.ui-state-active a,
        .page-pagination li span.current,
        .page-pagination li a:hover,
        .news-read-more,
        .more-link,
        .call-to-action-button,
        .main-content .step-icon-current,
        .view-map-button,
        .main-content p .view-map-button,
        .trip-details-wrapper form button,
        .total-price-display .payment-button,
        .service-rate-wrapper:hover .service-rate-header,
        .wp-pagenavi span.current,
        .wp-pagenavi a:hover,
        .footer table th,
        .sidebar-content table th,
        .vc_tta-panels .vc_tta-panel-title:before,
        .post-pagination span,
        .post-pagination span:hover,
        .button1:hover,
        .mobile-navigation-wrapper ul a:hover {
            background: #df9403;
        }

        .pp_close {
            background: url("wp-content/themes/chauffeur/framework/images/close.png") no-repeat center #df9403;
        }

        .footer .tnp-field input[type="submit"] {
            background-color: #df9403;
        }

        .header-area-1 .header-icon i,
        .header-area-2 .header-icon i,
        .content-wrapper ul li:before,
        .latest-news-block-content .news-meta .nm-news-date:before,
        .latest-news-block-content .news-meta .nm-news-comments:before,
        .testimonial-wrapper span.qns-open-quote,
        .testimonial-wrapper span.qns-close-quote,
        .main-content p a,
        .widget ul li:before,
        .main-content ul li:before,
        .main-content blockquote:before,
        .home-icon-wrapper-2 .qns-home-icon,
        .contact-details-list .cdw-address:before,
        .contact-details-list .cdw-phone:before,
        .contact-details-list .cdw-email:before,
        .main-content .social-links li i,
        .main-content .search-results-list li:before,
        .news-block-wrapper .news-meta .nm-news-author:before,
        .news-block-wrapper .news-meta .nm-news-date:before,
        .news-block-wrapper .news-meta .nm-news-category:before,
        .news-block-wrapper .news-meta .nm-news-comments:before,
        .service-rate-section p strong span,
        .vehicle-section p strong,
        .sidebar-content .contact-widget .cw-address:before,
        .sidebar-content .contact-widget .cw-phone:before,
        .sidebar-content .contact-widget .cw-cell:before {
            color: #df9403;
        }

        .header-area-2 .navigation li.current-menu-item,
        .header-area-2 .navigation li:hover {
            border-top: #df9403 3px solid;
        }

        .main-content blockquote {
            border-left: #df9403 3px solid;
        }

        .owl-theme .owl-dots .owl-dot span, .owl-theme .owl-dots .owl-dot.active span,
        .home-icon-wrapper-2 .qns-home-icon,
        .total-price-display {
            border: #df9403 3px solid;
        }

        .news-block-wrapper-1-col-listing .sticky {
            border: #df9403 2px solid;
        }

        #booking-tabs-2 .nav li.ui-state-active a,
        .service-rate-wrapper:hover .service-rate-header {
            border-right: #df9403 1px solid;
        }

        .page-pagination li span.current,
        .page-pagination li a:hover,
        .wp-pagenavi span.current,
        .wp-pagenavi a:hover,
        .post-pagination span,
        .post-pagination span:hover {
            border: #df9403 1px solid;
        }

        .header-booking-form-wrapper #booking-tabs ul li.ui-state-active a:after,
        .widget-booking-form-wrapper #booking-tabs ul li.ui-state-active a:after {
            border-top: 15px solid #df9403;
        }

        #booking-tabs-2 .nav li.ui-state-active a:after {
            border-left: 17px solid #df9403;
        }

        @media only screen and (max-width: 1250px) {

            #booking-tabs-2 .nav li.ui-state-active a:after {
                border-bottom: initial !important;
                border-left: 15px solid transparent !important;
                border-right: 15px solid transparent !important;
                border-top: 15px solid #df9403 !important;
            }

        }

        #tabs .ui-tabs-nav li.ui-state-active {
            border-top: #df9403 4px solid;
        }

        .total-price-inner {
            border-bottom: #df9403 3px solid;
        }

        .service-rate-wrapper:hover .service-rate-header:after {
            border-top: 10px solid #df9403;
        }

        .select-vehicle-wrapper .vehicle-section:hover,
        .select-vehicle-wrapper .selected-vehicle {
            border: #df9403 2px solid;
            outline: #df9403 1px solid;
        }

        .vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab.vc_active > a {
            border-top: #df9403 4px solid !important;
        }

        @media only screen and (max-width: 1250px) {

            #booking-tabs-2 .nav li.ui-state-active a:after {
                border-top: 15px solid #df9403;
            }

        }.service-rate-wrapper:hover .service-rate-header p {
             color: #e7aeb4;
         }.header-area-1 #primary-navigation,
          .mobile-navigation-wrapper,
          .mobile-navigation-wrapper ul li li a,
          .mobile-navigation-wrapper ul li li li a,
          .header-booking-form-wrapper,
          .widget-booking-form-wrapper,
          #ui-datepicker-div,
          .about-us-block,
          .footer,
          .body-booking-form-wrapper,
          .main-content table th,
          .page-not-found-search-form,
          .link-blocks .link-block-2,
          .link-blocks .link-block-3,
          .main-content .search-results-form,
          .widget .pricing-options-widget,
          .service-rate-header,
          .call-to-action-small,
          .step-icon,
          .trip-details-wrapper,
          .full-booking-wrapper,
          .lightbox-title {
              background: #00002b;
          }

        .call-to-action-1-section,
        .testimonials-full-wrapper,
        .paypal-loader {
            background-color: #00002b;
        }

        #tabs .nav li a {
            color: #00002b !important;
        }

        .service-rate-header:after {
            border-top: 10px solid #00002b;
        }.mobile-navigation-wrapper ul a,
         .ui-datepicker-calendar thead tr th,
         .footer-bottom {
             border-top: #3b3b3b 1px solid;
         }

        .header-booking-form-wrapper #booking-tabs ul li a,
        .widget-booking-form-wrapper #booking-tabs ul li a,
        .ui-datepicker-calendar tbody tr td a,
        #ui-datepicker-div .ui-datepicker-calendar tbody tr td span,
        .ui-datepicker-calendar thead tr th,
        .widget .pricing-options-widget ul li,
        .trip-details-wrapper .trip-details-wrapper-1 p,
        .full-booking-wrapper .clearfix .qns-one-half p,
        .footer .widget ul li,
        .footer table td {
            border-bottom: #3b3b3b 1px solid;
        }

        .ui-datepicker-calendar tbody tr td a,
        #ui-datepicker-div .ui-datepicker-calendar tbody tr td span,
        #booking-tabs-2 .nav li a,
        .service-rate-header,
        .footer table td {
            border-right: #3b3b3b 1px solid;
        }

        .trip-details-wrapper .trip-details-wrapper-2,
        .passenger-details-wrapper,
        .footer .tagcloud a,
        .footer .widget-booking-form-wrapper {
            border: #3b3b3b 1px solid;
        }

        .space7 {
            background: #3b3b3b;
        }.contact-widget .cw-phone span,
         .contact-widget .cw-cell span,
         .widget .pricing-options-widget,
         .service-rate-header p,
         .service-rate-section p {
             color: #838383;
         }h1, h2, h3, h4, h5, h6, .logo h2, .rev-custom-caption-1 h3, .rev-custom-caption-2 h3, .dropcap, .content-wrapper table th, .footer table th, .vc_tta-tabs .vc_tta-title-text, .chauffeur-block-image .new-icon, .content-wrapper .search-results-list li {
              font-family: 'Montserrat', sans-serif;
          }body, select, input, button, form textarea, .chauffeur-charter-sale-form h3 span, #reply-title small {
               font-family: 'Source Sans Pro', sans-serif;
           }
    </style>
    <link rel='stylesheet' id='prettyPhoto-css'  href="{{asset('wp-content/themes/chauffeur/framework/css/prettyPhoto7661.css?ver=5.4.2')}}" type='text/css' media='all' />
    <link rel='stylesheet' id='owlcarousel-css'  href="{{asset('wp-content/themes/chauffeur/framework/css/owl.carousel7661.css?ver=5.4.2')}}" type='text/css' media='all' />
    <link rel='stylesheet' id='chauffeur_responsive-css'  href="{{asset('wp-content/themes/chauffeur/framework/css/responsive7661.css?ver=5.4.2')}}" type='text/css' media='all' />
    <link rel='stylesheet' id='fontawesome-css'  href="{{asset('wp-content/themes/chauffeur/framework/css/font-awesome/css/font-awesome.min7661.css?ver=5.4.2')}}" type='text/css' media='all' />
    <link rel='stylesheet' id='chauffeur_fonts-css'  href='https://fonts.googleapis.com/css?family=Montserrat%3A400%2C700%7CSource+Sans+Pro%3A400%2C200%2C200italic%2C300%2C300italic%2C400italic%2C600%2C600italic%2C700%2C700italic%2C900%2C900italic&amp;ver=1.0.0' type='text/css' media='all' />
    <link rel='stylesheet' id='newsletter-css'  href="{{asset('wp-content/plugins/newsletter/style9704.css?ver=6.7.1')}}" type='text/css' media='all' />
    <link rel='stylesheet' id='js_composer_front-css'  href="{{asset('wp-content/plugins/js_composer/assets/css/js_composer.mine23c.css?ver=5.7')}}" type='text/css' media='all' />
    <script type='text/javascript' src="{{asset('wp-includes/js/jquery/jquery4a5f.js?ver=1.12.4-wp')}}"></script>
    <script type='text/javascript' src="{{asset('wp-includes/js/jquery/jquery-migrate.min330a.js?ver=1.4.1')}}"></script>
    <script type='text/javascript' src="{{asset('wp-content/plugins/chauffeur-shortcodes-post-types/assets/js/scripts7661.js?ver=5.4.2')}}"></script>
    <script type='text/javascript'>

        var AJAX_URL = 'https://chauffeur.leadersol.com/wp-admin/admin-ajax.php';
        var chauffeur_pickup_dropoff_error = 'Please enter a pick up and drop off location';
        var chauffeur_valid_email = 'Please enter a valid email address';
        var chauffeur_valid_phone = 'Please enter a valid phone number (numbers only and no spaces)';
        var chauffeur_valid_bags = 'Number of bags selected exceeds vehicle limit';
        var chauffeur_valid_passengers = 'Number of passengers selected exceeds vehicle limit';
        var chauffeur_select_vehicle = 'Please select a vehicle';
        var chauffeur_complete_required = 'Please complete all the required form fields marked with a *';
        var chauffeur_autocomplete = 'Please select your addresses using the Google autocomplete suggestion';
        var chauffeur_terms = 'You must accept the terms and conditions before placing your booking';
        var chauffeur_terms_set = 'false';

        var ch_minimum_hourly_alert = 'The minimum hourly booking is 1 hours';

        var chauffeur_min_time_before_booking_error = 'Sorry we do not accept same day online bookings less than 1 hour(s) in advance of the pick up time';

        var LOADING_IMAGE = "{{asset('wp-content/plugins/chauffeur-shortcodes-post-types/assets/images/loading.gif')}}";
        var chauffeur_datepicker_format = 'mm/dd/yy';

        var chauffeur_active_tab = 'distance';
        var Google_AutoComplete_Country = 'ALL_COUNTRIES';
        var hours_before_booking_minimum = '60';
        var hourly_minimum = '1';
    </script>
    <script type='text/javascript' src="{{asset('wp-content/plugins/chauffeur-shortcodes-post-types/assets/js/fontawesome-markers.min7661.js?ver=5.4.2')}}"></script>
    <script type='text/javascript' src="{{asset('front_css/my-css.css')}}"></script>
    <script type='text/javascript' src="{{asset('wp-content/plugins/revslider/public/assets/js/jquery.themepunch.tools.minf542.js?ver=5.4.8.3')}}"></script>
    <script type='text/javascript' src="{{asset('wp-content/plugins/revslider/public/assets/js/jquery.themepunch.revolution.minf542.js?ver=5.4.8.3')}}"></script>
    <link rel='https://api.w.org/' href='wp-json/index.html' />
    <link rel="EditURI" type="application/rsd+xml" title="RSD" href="xmlrpc0db0.html?rsd" />
    <link rel="wlwmanifest" type="application/wlwmanifest+xml" href="wp-includes/wlwmanifest.xml" />
    <meta name="generator" content="WordPress 5.4.2" />
    <link rel="canonical" href="index.html" />
    <link rel='shortlink' href='index.html' />
    <link rel="alternate" type="application/json+oembed" href="wp-json/oembed/1.0/embed2837.json?url=https%3A%2F%2Fchauffeur.leadersol.com%2F" />
    <link rel="alternate" type="text/xml+oembed" href="wp-json/oembed/1.0/embed13f1?url=https%3A%2F%2Fchauffeur.leadersol.com%2F&amp;format=xml" />
    <style type="text/css">.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}</style><meta name="generator" content="Powered by WPBakery Page Builder - drag and drop page builder for WordPress."/>
    <!--[if lte IE 9]><link rel="stylesheet" type="text/css" href="https://chauffeur.leadersol.com/wp-content/plugins/js_composer/assets/css/vc_lte_ie9.min.css" media="screen"><![endif]--><meta name="generator" content="Powered by Slider Revolution 5.4.8.3 - responsive, Mobile-Friendly Slider Plugin for WordPress with comfortable drag and drop interface." />
    <script type="text/javascript">function setREVStartSize(e){
            try{ e.c=jQuery(e.c);var i=jQuery(window).width(),t=9999,r=0,n=0,l=0,f=0,s=0,h=0;
                if(e.responsiveLevels&&(jQuery.each(e.responsiveLevels,function(e,f){f>i&&(t=r=f,l=e),i>f&&f>r&&(r=f,n=e)}),t>r&&(l=n)),f=e.gridheight[l]||e.gridheight[0]||e.gridheight,s=e.gridwidth[l]||e.gridwidth[0]||e.gridwidth,h=i/s,h=h>1?1:h,f=Math.round(h*f),"fullscreen"==e.sliderLayout){var u=(e.c.width(),jQuery(window).height());if(void 0!=e.fullScreenOffsetContainer){var c=e.fullScreenOffsetContainer.split(",");if (c) jQuery.each(c,function(e,i){u=jQuery(i).length>0?u-jQuery(i).outerHeight(!0):u}),e.fullScreenOffset.split("%").length>1&&void 0!=e.fullScreenOffset&&e.fullScreenOffset.length>0?u-=jQuery(window).height()*parseInt(e.fullScreenOffset,0)/100:void 0!=e.fullScreenOffset&&e.fullScreenOffset.length>0&&(u-=parseInt(e.fullScreenOffset,0))}f=u}else void 0!=e.minHeight&&f<e.minHeight&&(f=e.minHeight);e.c.closest(".rev_slider_wrapper").css({height:f})
            }catch(d){console.log("Failure at Presize of Slider:"+d)}
        };</script>
    <style type="text/css" data-type="vc_shortcodes-custom-css">.vc_custom_1483261287357{margin-top: 0px !important;margin-right: 0px !important;margin-bottom: 0px !important;margin-left: 0px !important;border-top-width: 0px !important;border-right-width: 0px !important;border-bottom-width: 0px !important;border-left-width: 0px !important;padding-top: 0px !important;padding-right: 0px !important;padding-bottom: 0px !important;padding-left: 0px !important;}.vc_custom_1483319394148{margin-top: 0px !important;margin-right: 0px !important;margin-bottom: 0px !important;margin-left: 0px !important;border-top-width: 0px !important;border-right-width: 0px !important;border-bottom-width: 0px !important;border-left-width: 0px !important;padding-top: 0px !important;padding-right: 0px !important;padding-bottom: 0px !important;padding-left: 0px !important;}.vc_custom_1483323508403{margin-top: 0px !important;margin-right: 0px !important;margin-bottom: 0px !important;margin-left: 0px !important;border-top-width: 0px !important;border-right-width: 0px !important;border-bottom-width: 0px !important;border-left-width: 0px !important;padding-top: 0px !important;padding-right: 0px !important;padding-bottom: 0px !important;padding-left: 0px !important;}.vc_custom_1483325712669{margin-top: 0px !important;margin-right: 0px !important;margin-bottom: 0px !important;margin-left: 0px !important;border-top-width: 0px !important;border-right-width: 0px !important;border-bottom-width: 0px !important;border-left-width: 0px !important;padding-top: 0px !important;padding-right: 0px !important;padding-bottom: 0px !important;padding-left: 0px !important;}.vc_custom_1485767312828{margin-bottom: 80px !important;padding-bottom: 0px !important;}</style><noscript><style type="text/css"> .wpb_animate_when_almost_visible { opacity: 1; }</style></noscript>
    <!-- END head -->
</head>