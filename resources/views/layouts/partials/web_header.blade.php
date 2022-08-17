<section id="header" class="header">
    {{-- <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="top-padding py-md-3"></div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="main-head">
        <nav class="navbar navbar-expand-lg nav-background scrolling-navbar">
            <div class="container-fluid">
                <div class="nav-box">
                    {{-- <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{{ asset($content->logo) }}" alt="" style="width: auto; height: 45px">
                    </a>
                    <a class="navbar-brand text-uppercase p-0" href="{{ route('home') }}">{{ $content->name }}</a> --}}
                    <a class="navbar-brand text-uppercase p-0" href="{{ route('home') }}">Price Bond Checker</a>

                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="fal fa-bars"></i>
                    </span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <form class="d-flex ms-auto" role="search">
                        <div class="input-group">
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="addon-wrapping">
                                    <i class="fal fa-search"></i>
                                </span>

                                <form action="{{route('search')}}" method="GET">
                                    <div class="input-group rounded">
                                            <input type="search" name="q" id="keyword" class="serach-control search-box keyword form-control" autocomplete="off" placeholder="Search.." />
                                            {{-- <span class="input-group-text border-0"><i class="fas fa-search"></i></span>
                                            <button type="submit" class="input-group-text border-0">
                                                <i class="fas fa-search"></i>
                                            </button> --}}
                                    </div>
                                </form>
                                {{-- <input type="text" class="form-control" placeholder="Search Here..." aria-label="Username" aria-describedby="addon-wrapping"> --}}
                            </div>
                        </div>
                    </form>
                    <ul class="navbar-nav mb-2 mb-md-0">
                        <li class="nav-item">
                            <span style="display: inline-block; padding: 0.5rem">
                                <i class="fal fa-phone-alt"></i>
                                <span class="" aria-current="page" href="#"><a href="tel:{{$content->phone}}">{{ $content->phone }}</a></span>
                            </span>
                        </li>
                        <li class="nav-item dropdown">
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</section>
{{-- <section class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumbs"></ul>
            </div>
        </div>
    </div>
</section> --}}