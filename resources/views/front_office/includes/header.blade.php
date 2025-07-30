  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.html" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img width="150px" height="250px" src="{{ asset('logo.png') }}" alt="">
        {{-- <h1 class="sitename">FlexStart</h1> --}}
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">{{ translate('Home') }}<br></a></li>
          <li><a href="#about">{{ translate('About') }}</a></li>
          <li><a href="#services">{{ translate('Services') }}</a></li> 
          <li><a href="#team">{{ translate('Team') }}</a></li>
          <li><a href="blog.html">{{ translate('Blog') }}</a></li>
        
          <li><a href="#contact">{{ translate('Contact') }}</a></li>
          <li><a href="{{ route('login_page') }}">{{ translate('Login') }}</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav> 

    </div>
  </header>