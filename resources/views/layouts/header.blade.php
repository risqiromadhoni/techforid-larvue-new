<header class="menu" id="myHeader">
    <nav class="navbar navbar-expand-lg">
      <div class="container menu__head">
        <a class="navbar-brand" href="index.html"><img src="{{asset('img/footer_logo.png')}}" alt="brand logo" class="img-fluid"/></a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarSupportedContent"aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"><i class="fa fa-bars" aria-hidden="true"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a href="#" class="nav-link">Categories</a>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0">
              <input type="text" class="form-control mr-sm-2" placeholder="Search for Courses...">
              <button type="submit" class="btn btn-outline-success my-2 my-sm-0"><i class="fa fa-search" aria-hidden="true"></i></button>
          </form>
          <ul class="nav navbar-nav navbar-right font-thin">
            {{-- <li class="nav-item"><a href="#">Techfor Community</a></li> --}}
            {{-- <li class="nav-item"><a href="#"><i class="fa fa-shopping-cart icon" aria-hidden="true"></i></a></li> --}}
            {{-- <li class="nav-item"><a href="#" class="bord-rad"><span>Login</span></a></li> --}}
            <li class="nav-item signup"><a href="#" class="bord-rad"><span>Sign Up</span></a></li>
          </ul>
        </div>
      </div>
    </nav>
</header>