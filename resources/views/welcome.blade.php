<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />

    <!--====== Title ======-->
    <title>WiFiCom - Untethered Digimon/Legendz Communicator</title>

    <meta name="description" content="Wireless access to Digimon/Legendz electronic toy interfacing.  Build your own WiFiCom with our docs and get online from any operating system, device or web browser." />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="/favicon.ico" type="image/ico" />

    <!--====== CSS Files LinkUp ======-->
    <link rel="stylesheet" href="{{ asset('/landing_page/assets/css/animate.css')}}" />
    <link rel="stylesheet" href="{{ asset('/landing_page/assets/css/tiny-slider.css')}}" />
    <link rel="stylesheet" href="{{ asset('/landing_page/assets/css/glightbox.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('/landing_page/assets/css/lineicons.css')}}" />
    <link rel="stylesheet" href="{{ asset('/landing_page/assets/css/tailwindcss.css')}}" />
</head>

<body>
    <!--[if IE]>
      <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="https://browsehappy.com/">upgrade your browser</a> to improve
        your experience and security.
      </p>
    <![endif]-->

    <!--====== HEADER PART START ======-->
    <header class="header-area z-10">
        <div class="
          navbar-area
          absolute
          top-0
          left-0
          z-[999]
          w-full
          duration-300
          bg-transparent
        ">
            <div class="container px-4 lg:py-0 py-5 relative">
                <div class="flex flex-wrap">
                    <div class="w-full">
                        <nav class="
                  flex
                  items-center
                  justify-between
                  navbar navbar-expand-lg
                ">
                            <a class="mr-4 navbar-brand" href="index.html">
                                <!-- <img src="/landing_page/assets/images/logo/logo.svg" alt="Logo" /> -->
                            </a>
                            <button class="block navbar-toggler focus:outline-none lg:hidden" type="button" data-toggle="collapse" data-target="#navbarOne" aria-controls="navbarOne" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="
                      toggler-icon
                      relative
                      block
                      duration-300
                      bg-white
                      h-[2px]
                      w-[30px]
                      my-[6px]
                    ">
                                </span>
                                <span class="
                      toggler-icon
                      relative
                      block
                      duration-300
                      bg-white
                      h-[2px]
                      w-[30px]
                      my-[6px]
                    ">
                                </span>
                                <span class="
                      toggler-icon
                      relative
                      block
                      duration-300
                      bg-white
                      h-[2px]
                      w-[30px]
                      my-[6px]
                    ">
                                </span>
                            </button>

                            <div class="
                    absolute
                    left-0
                    z-20
                    hidden
                    w-full
                    px-5
                    py-3
                    duration-300
                    bg-white
                    shadow
                    lg:w-auto
                    collapse
                    navbar-collapse
                    lg:block
                    top-full
                    lg:static lg:bg-transparent lg:shadow-none
                  " id="navbarOne">
                                <ul id="nav" class="
                      items-center
                      content-start
                      mr-auto
                      lg:justify-end
                      navbar-nav
                      lg:flex
                    ">
                                    <li class="nav-item active">
                                        <a class="page-scroll" href="#home">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#features">Features</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#discord">Discord</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- navbar collapse -->

                            <div class="
                    absolute
                    right-0
                    mt-2
                    mr-24
                    navbar-btn
                    sm:inline-block
                    lg:mt-0 lg:static lg:mr-0
                  ">
                                <a class="main-btn gradient-btn" data-scroll-nav="0" href="/login" rel="nofollow">
                                    @guest
                                    Login
                                    @else
                                    Dashboard
                                    @endauth
                                </a>
                            </div>
                        </nav>
                        <!-- navbar -->
                    </div>
                </div>
                <!-- row -->
            </div>
            <!-- container -->
        </div>
        <!-- navbar area -->

        <div id="home" class="relative z-20 bg-bottom bg-no-repeat bg-cover" style="background-image: url({{ asset('/landing_page/assets/images/header/banner-bg.svg')}})">
            <div class="container px-4">
                <div class="justify-center flex flex-wrap">
                    <div class="w-full lg:w-2/3">
                        <div class="pt-32 mb-12 text-center lg:pt-48 header-hero-content">
                            <h3 class="
                    text-4xl
                    font-light
                    leading-tight
                    text-white
                    header-sub-title
                    wow
                    fadeInUp
                  " data-wow-duration="1.3s" data-wow-delay="0.2s">
                                WiFiCom - Untethered vPet Interactions
                            </h3>
                            <h2 class="
                    mb-3
                    text-4xl
                    font-bold
                    text-white
                    header-title
                    wow
                    fadeInUp
                  " data-wow-duration="1.3s" data-wow-delay="0.5s">
                                WiFi and a power source is all you need to get online
                            </h2>
                            <p class="mb-8 text-white text wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="0.8s">
                                Works on any operating system, mobile device, and even websites
                            </p>
                            <a href="https://docs.wificom.dev" class="main-btn gradient-btn gradient-btn-2 wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="1.1s">
                                Read our Docs
                            </a>
                        </div>
                        <!-- header hero content -->
                    </div>
                </div>
                <!-- row -->
                <div class="justify-center flex flex-wrap">
                    <div class="w-full lg:w-2/3">
                        <div class="text-center header-hero-image wow fadeIn" data-wow-duration="1.3s" data-wow-delay="1.4s">
                            <img src="{{ asset('/landing_page/assets/images/header/header-hero.png')}}" alt="hero" />
                        </div>
                        <!-- header hero image -->
                    </div>
                </div>
                <!-- row -->
            </div>
            <!-- container -->
        </div>
        <!-- header hero -->
    </header>
    <!--====== HEADER PART ENDS ======-->

    <!--====== BRAND PART START ======-->
    <div class="pt-24 brand-area">
        <div class="container px-4">
            <div class="flex flex-wrap">
                <div class="w-full">
                    <!-- 
-->
                    <!-- brand logo -->
                </div>
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!--====== BRAND PART ENDS ======-->

    <!--====== SERVICES PART START ======-->
    <section id="features" class="services-area pt-[120px]">
        <div class="container px-4">
            <div class="justify-center flex flex-wrap">
                <div class="w-full lg:w-2/3">
                    <div class="pb-10 text-center section-title">
                        <div class="
                m-auto
                w-40
                h-1
                mb-3
                bg-gradient-to-r
                to-[#fe8464]
                from-[#fe6e9a]
              "></div>
                        <h3 class="text-[32px] pt-2 font-bold">Same features as a D-Com<span class="font-normal"> but with so much more, includes a screen, speaker, and buttons for interactions</span>
                        </h3>
                    </div>
                    <!-- section title -->
                </div>
            </div>
            <!-- row -->
            <div class="justify-center flex flex-wrap">
                <div class="w-full sm:w-2/3 lg:w-1/3">
                    <div class="single-services
              px-8
              py-12
              mx-4
              mt-8
              text-center
              duration-300
              bg-white
              border-2 border-transparent
              rounded-lg
              shadow-lg
              group
              hover:border-theme-color-2
              wow
              fadeIn" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeIn;">
                        <div class="services-icon relative inline-block">
                            <img class="duration-300 shape group-hover:rotate-[25deg]" src="{{ asset('/landing_page/assets/images/services/services-shape.svg')}}" alt="shape">
                            <img class="
                  duration-300
                  shape-1
                  absolute
                  top-1/2
                  left-1/2
                  translate-x-[-50%] translate-y-[-50%]
                " src="{{ asset('/landing_page/assets/images/services/services-shape-1.svg')}}" alt="shape">
                            <i class="
                  lni lni-baloon
                  absolute
                  top-0
                  left-0
                  flex
                  items-center
                  justify-center
                  w-full
                  h-full
                  text-3xl text-white
                "></i>
                        </div>
                        <div class="mt-8 services-content">
                            <h4 class="mb-8 text-xl font-bold text-gray-900">WiFi Enabled</h4>
                            <p class="mb-8">Also optional. Use your WiFiCom as a normal D-Com when unable to connect online</p>
                            <!-- 
-->
                        </div>
                    </div>
                    <!-- single services -->
                </div>
                <div class="w-full sm:w-2/3 lg:w-1/3">
                    <div class="mt-8
              text-center
              single-services
              px-8
              py-12
              mx-4
              duration-300
              bg-white
              border-2 border-transparent
              rounded-lg
              shadow-lg
              group
              hover:border-theme-color-2
              wow
              fadeIn" data-wow-duration="1s" data-wow-delay="0.5s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.5s; animation-name: fadeIn;">
                        <div class="services-icon relative inline-block">
                            <img class="duration-300 shape group-hover:rotate-[25deg]" src="{{ asset('/landing_page/assets/images/services/services-shape.svg')}}" alt="shape">
                            <img class="
                  duration-300
                  shape-1
                  absolute
                  top-1/2
                  left-1/2
                  translate-x-[-50%] translate-y-[-50%]
                " src="{{ asset('/landing_page/assets/images/services/services-shape-2.svg')}}" alt="shape">
                            <i class="
                  lni lni-cog
                  absolute
                  top-0
                  left-0
                  flex
                  items-center
                  justify-center
                  w-full
                  h-full
                  text-3xl text-white
                "></i>
                        </div>
                        <div class="mt-8 services-content">
                            <h4 class="mb-8 text-xl font-bold text-gray-900">Easily Configured</h4>
                            <p class="mb-8">Simple single file configuration, other files are optional but enable even more device abilities</p>
                            <!-- 
-->
                        </div>
                    </div>
                    <!-- single services -->
                </div>
                <div class="w-full sm:w-2/3 lg:w-1/3">
                    <div class="single-services
              px-8
              py-12
              mx-4
              mt-8
              text-center
              duration-300
              bg-white
              border-2 border-transparent
              rounded-lg
              shadow-lg
              group
              hover:border-theme-color-2
              wow
              fadeIn" data-wow-duration="1s" data-wow-delay="0.8s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.8s; animation-name: fadeIn;">
                        <div class="services-icon relative inline-block">
                            <img class="duration-300 shape group-hover:rotate-[25deg]" src="{{ asset('/landing_page/assets/images/services/services-shape.svg')}}" alt="shape">
                            <img class="
                  duration-300
                  shape-1
                  absolute
                  top-1/2
                  left-1/2
                  translate-x-[-50%] translate-y-[-50%]
                " src="{{ asset('/landing_page/assets/images/services/services-shape-3.svg')}}" alt="shape">
                            <i class="
                  lni lni-bolt-alt
                  absolute
                  top-0
                  left-0
                  flex
                  items-center
                  justify-center
                  w-full
                  h-full
                  text-3xl text-white
                "></i>
                        </div>
                        <div class="mt-8 services-content">
                            <h4 class="mb-8 text-xl font-bold text-gray-900">Unlock the Power</h4>
                            <p class="mb-8">Realtime Battle support for Digimon and Legendz, Punchbag for common DigiROMs, and Infrared support</p>
                        </div>
                    </div>
                    <!-- single services -->
                </div>
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </section>
    <div class="flex flex-wrap testimonial-active wow fadeInUpBig" data-wow-duration="1s" data-wow-delay="0.8s">
        <!-- row -->
    </div>

    <!--====== FOOTER PART START ======-->
    <footer id="footer" class="relative z-10 footer-area pt-[120px]">
        <div class="
        footer-bg
        absolute
        bottom-0
        left-0
        w-full
        h-full
        bg-top bg-no-repeat bg-cover
        z-[-1]
      " style="background-image: url({{ asset('/landing_page/assets/images/footer/footer-bg.svg')}})"></div>
        <div class="container px-4">
            <div class="px-6
          pt-10
          pb-20
          mb-12
          bg-white
          rounded-lg
          drop-shadow-md
          md:px-12
          subscribe-area
          wow
          fadeIn" data-wow-duration="1s" data-wow-delay="0.5s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.5s; animation-name: fadeIn;">
                <div class="flex flex-wrap" id="discord">
                    <div class="w-full lg:w-1/2">
                        <div class="lg:mt-12 subscribe-content">
                            <h2 class="text-2xl font-bold sm:text-4xl subscribe-title">Join our active community<span class="block font-normal">stay current with the project</span>
                            </h2>
                        </div>
                    </div>
                    <div class="w-full lg:w-1/2" id="discord">
                        <div class="h-20">

                        </div>
                        <a href="https://discord.gg/yJ4Ub64zrP" class="flex items-center">
                            <img src="https://dcbadge.vercel.app/api/server/yJ4Ub64zrP" alt="Discord Server">
                        </a>
                    </div>
                </div>
                <!-- row -->
            </div>
            <!-- subscribe area -->
            <div class="footer-widget pb-[120px]">
                <div class="flex flex-wrap">
                    <div class="w-4/5 md:w-3/5 lg:w-2/6">
                        <div class="mt-12 footer-about wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeIn;">
                            <a class="inline-block mb-8 logo" href="index.html">
                            </a>
                        </div>
                        <!-- footer about -->
                    </div>
                    <div class="w-4/5 sm:w-2/3 md:w-3/5 lg:w-2/6">
                        <div class="flex flex-wrap">
                            <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/2">
                                <div class="mt-12 link-wrapper wow fadeIn" data-wow-duration="1s" data-wow-delay="0.4s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.4s; animation-name: fadeIn;">
                                    <div class="footer-title">
                                        <h4 class="mb-8 text-2xl font-bold text-white">
                                            Quick Link
                                        </h4>
                                    </div>
                                    <ul class="link">
                                        <li><a href="https://github.com/mechawrench/wificom-roadmap" target="_blank" rel="noopener noreferrer">Road Map</a></li>
                                        <li><a href="/privacy">Privacy Policy</a></li>
                                        <li><a href="/terms">Terms of Service</a></li>
                                    </ul>
                                </div>
                                <!-- footer wrapper -->
                            </div>
                            <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/2">
                                <div class="mt-12 link-wrapper wow fadeIn" data-wow-duration="1s" data-wow-delay="0.6s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.6s; animation-name: fadeIn;">
                                    <div class="footer-title">
                                        <h4 class="mb-8 text-2xl font-bold text-white">
                                            Resources
                                        </h4>
                                    </div>
                                    <ul class="link">
                                        <li><a href="/">Home</a></li>
                                        <li><a href="/dashboard">Dashboard</a></li>
                                        <li><a href="https://docs.wificom.dev">Docs</a></li>
                                    </ul>
                                </div>
                                <!-- footer wrapper -->
                            </div>
                        </div>
                    </div>
                    <div class="w-4/5 sm:w-1/3 md:w-2/5 lg:w-2/6">
                        <div class="mt-12 footer-contact wow fadeIn" data-wow-duration="1s" data-wow-delay="0.8s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.8s; animation-name: fadeIn;">
                            <div class="footer-title">
                                <h4 class="mb-8 text-2xl font-bold text-white">Contact Us</h4>
                            </div>
                            <ul class="contact">
                                <li class="mb-3 text-white">wificom@mechawrench.com</li>
                                <li class="mb-3 text-white">wificom.dev</li>
                            </ul>
                        </div>
                        <!-- footer contact -->
                    </div>
                </div>
                <!-- row -->
            </div>
            <!-- footer widget -->
            <div class="py-8 border-t border-gray-200 footer-copyright">
                <p class="text-white text-center">
                    {{ config('app.url', 'WiFiCom.dev') }}
                </p>
            </div>
            <!-- footer copyright -->
        </div>
        <!-- container -->
    </footer>
    <!--====== FOOTER PART ENDS ======-->

    <!--====== BACK TOP TOP PART START ======-->
    <a href="#" class="back-to-top" style="display: flex;"><i class="lni lni-chevron-up"></i></a>
    <!--====== BACK TOP TOP PART ENDS ======-->

    <!--====== Javascript files ======-->
    <script src="{{ asset('/landing_page/assets/js/tiny-slider.js')}}"></script>
    <script src="{{ asset('/landing_page/assets/js/glightbox.min.js')}}"></script>
    <script src="{{ asset('/landing_page/assets/js/wow.min.js')}}"></script>
    <script src="{{ asset('/landing_page/assets/js/count-up.min.js')}}"></script>
    <script src="{{ asset('/landing_page/assets/js/main.js')}}"></script>
    <script src="https://four-ideal.wificom.dev/script.js" data-site="YSFEVNJI" defer></script>
</body>

</html>