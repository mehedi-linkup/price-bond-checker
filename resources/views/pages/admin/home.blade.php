@extends('layouts.admin-master', ['pageName'=> 'dashboard', 'title' => 'Dashboard'])
{{-- @section('title', 'Dashboard') --}}
@section('admin-content')
<main>
    <div class="heading-title">
        <h4 class="my-3 heading"><i class="fa fa-tachometer-alt"></i> Dashboard</h4>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card text-white mb-4" style="background: #1487e6">
                    <div class="card-body">
                        <div>Purchased Bond</div>
                        <span>{{$userbond}}</span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('userbond') }}">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card text-white mb-4" style="background: #f025c4">
                    <div class="card-body">
                        <div>Sold Bond</div>
                        <span>{{ $soldbond }}</span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#!">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card text-white mb-4" style="background: #9b0e20">
                    <div class="card-body">
                        <div>Total Winner</div>
                        <span>{{$pricewinner}}</span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('price-winner') }}">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card text-white mb-4" style="background: #0e9b59">
                    <div class="card-body">
                        <div>Total Lot</div>
                        <span>{{$lot}}</span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('lot.list') }}">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection