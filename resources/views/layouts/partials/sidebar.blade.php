<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="nav-link" href="{{ route('price-winner') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-trophy"></i></div>
                    Winner List
                </a>
                <a class="nav-link" href="{{ route('userbond') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-shopping-basket"></i></div>
                    Purchase Bonds
                </a>
                <a class="nav-link" href="#">
                    <div class="sb-nav-link-icon"><i class="fab fa-sellcast"></i></div>
                    Sell Bonds
                </a>
                {{-- <a class="nav-link" href="{{ route('draw') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-award"></i></div>
                    Draw Result
                </a> --}}
                <a class="nav-link {{ ($pageName == 'report-all' || $pageName == 'report-result' ? 'active' : 'collapsed') }}" href="#" data-toggle="collapse" data-target="#collapseLayouts1" aria-expanded="false" aria-controls="collapseLayouts1">
                    <div class="sb-nav-link-icon"><i class="fas fa-flag-checkered"></i></div>
                    Report
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ ($pageName == 'report-all' || $pageName == 'report-result' ? 'show' : '') }}" id="collapseLayouts1" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('report') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-list-alt"></i></div>
                            All Bond
                        </a> 
                        <a class="nav-link" href="{{ route('report.result') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-list-alt"></i></div>
                            Draw Result
                        </a> 
                    </nav>
                </div>
                <a class="nav-link {{ ($pageName == 'lot' || $pageName == 'bond-series' || $pageName == 'price-list' ? 'active' : 'collapsed') }}" href="#" data-toggle="collapse" data-target="#collapseLayouts2" aria-expanded="false" aria-controls="collapseLayouts2">
                    <div class="sb-nav-link-icon"><i class="fas fa-cogs"></i></div>
                    Settings
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ ($pageName == 'lot' || $pageName == 'bond-series' || $pageName == 'price-list' ? 'show' : '') }}" id="collapseLayouts2" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('lot') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-plus-circle"></i></div>
                            Add Lot
                        </a> 
                        <a class="nav-link" href="{{ route('bond-series') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-plus-circle"></i></div>
                            Add Series
                        </a> 
                        <a class="nav-link" href="{{ route('price-list') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-plus-circle"></i></div>
                            Add Price
                        </a> 
                    </nav>
                </div>
                {{-- <a class="nav-link {{ ($pageName == 'content' || $pageName == 'service' || $pageName == 'category' || $pageName == 'subcategory' || $pageName == 'management' || $pageName == 'gallery' || $pageName == 'product' || $pageName == 'partner' ? 'active' : 'collapsed') }}" href="#" data-toggle="collapse" data-target="#collapseLayouts1" aria-expanded="false" aria-controls="collapseLayouts1">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Web Content
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a> --}}
                {{-- <div class="collapse {{ ($pageName == 'content' || $pageName == 'service' || $pageName == 'category' || $pageName == 'subcategory' || $pageName == 'management' || $pageName == 'gallery' || $pageName == 'product' || $pageName == 'partner' ? 'show' : '') }}" id="collapseLayouts1" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav"> --}}
                        {{-- <a class="nav-link" href="{{ route('company.edit') }}">Company Content</a> --}}
                        {{-- <a class="nav-link" href="{{ route('service') }}">Service</a> --}}
                        {{-- <a class="nav-link" href="{{ route('admin.categories') }}">Category</a>
                        <a class="nav-link" href="{{ route('admin.subcategories') }}">Subcategory</a> --}}
                        {{-- <a class="nav-link" href="{{ route('management.index') }}">Management</a> --}}
                        {{-- <a class="nav-link" href="{{ route('gallery') }}">Gallery</a> --}}
                        {{-- <a class="nav-link" href="{{ route('partner.index') }}">Partner</a> --}}
                        {{-- <a class="nav-link" href="{{ route('admin.products') }}">Product</a> --}}
                    {{-- </nav>
                </div> --}}

                {{-- <a class="nav-link {{ ($pageName == 'message' || $pageName == 'query') ? 'active' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapseLayouts2" aria-expanded="false" aria-controls="collapseLayouts2">
                    <div class="sb-nav-link-icon"><i class="fas fa-envelope"></i></div>
                    Messages
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a> --}}
                {{-- <div class="collapse {{ ($pageName == 'message' || $pageName == 'query') ? 'show' : '' }}" id="collapseLayouts2" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('admin.query') }}">Customer Query</a>
                        <a class="nav-link" href="{{ route('admin.message') }}">Message</a>
                    </nav>
                </div> --}}
                <a class="nav-link {{ ($pageName == 'profile' || $pageName == 'register') ? 'active' : 'collapsed' }} " href="#" data-toggle="collapse" data-target="#collapseLayouts3" aria-expanded="false" aria-controls="collapseLayouts3">
                    <div class="sb-nav-link-icon"><i class="fas fa-users-cog"></i></div>
                    Authentication
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ ($pageName == 'profile' || $pageName == 'register') ? 'show' : '' }}" id="collapseLayouts3" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('register.create') }}">Add New User</a>
                        <a class="nav-link" href="{{ route('settings') }}">Update Profile</a>
                    </nav>
                </div>
                <a class="nav-link" href="{{ route('logout') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-power-off"></i></div>
                    Sign Out 
                </a>
            </div>
        </div>
    </nav>
</div>