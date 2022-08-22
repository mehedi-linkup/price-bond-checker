@extends('layouts.admin-master', ['pageName'=> 'dashboard', 'title' => 'Dashboard'])
{{-- @section('title', 'Dashboard') --}}
@section('admin-content')
<main>
    <div class="heading-title">
        <h4 class="my-3 heading"><i class="fa fa-tachometer-alt"></i> Dashboard</h4>
    </div>
    <div class="container-fluid">
        <div class="row">
            {{-- <div class="col-xl-3 col-md-6">
                <div class="card text-white mb-4" style="background: #484d52">
                    <div class="card-body">
                        <div>Customer Message</div>
                        <span></span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="col-xl-3 col-md-6">
                <div class="card text-white mb-4" style="background: #484d52">
                    <div class="card-body">
                        <div>Service Query Message</div>
                        <span></span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="col-xl-3 col-md-6">
                <div class="card text-white mb-4" style="background: #484d52">
                    <div class="card-body">
                        <div>Product Category</div>
                       
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="col-xl-3 col-md-6">
                <div class="card text-white mb-4" style="background: #484d52">
                    <div class="card-body">
                        <div>Product Sub Category</div>
                        <span></span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="col-xl-3 col-md-6">
                <div class="card text-white mb-4" style="background: #484d52">
                    <div class="card-body">
                        <div>Total Product</div>
                        <span></span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href=>View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</main>
@endsection