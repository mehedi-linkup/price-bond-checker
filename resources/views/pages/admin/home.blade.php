@extends('layouts.admin-master', ['pageName'=> 'dashboard', 'title' => 'Dashboard'])
{{-- @section('title', 'Dashboard') --}}
@push('admin-js')
    <style>
        .card-anon-pen {
            background:linear-gradient(115deg, #4fcf70, #fad648, #a767e5, #12bcfe, #44ce7b);
            padding: 3px;
            overflow: hidden;
        }
        .card-anon-pen:hover {
            -webkit-animation: play 1.6s ease-in infinite;
        }
        @-webkit-keyframes play {
            0% {
                background-position: 0px;
            }
            20% {
                background-position: -110px;
            }
            35% {
                background-position: -180px;
            }
            50% {
                background-position: -210px;
            }
            80% {
                background-position: -350px;
            }
            100% {
                background-position: -390px;
            }
        }
    </style>
@endpush
@section('admin-content')
<main>
    <div class="heading-title">
        <h4 class="my-3 heading"><i class="fa fa-tachometer-alt"></i> Dashboard</h4>
    </div>
    <div class="container-fluid">
        {{-- <div class="row">
            <div class="col-md-12">
                <h4 class="text-center">Welcome to pricebond checker</h4>
            </div>
        </div> --}}
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card text-white mb-4" style="background: #1487e6;">
                    <div class="card-body">
                        <div>Total Stock <small>(Only Yours)</small> </div>
                        <span>{{$userbond}}</span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('report.all') }}">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card text-white mb-4" style="background: #0c9595;">
                    <div class="card-body">
                        <div>Total Value <small>(Only Yours)</small></div>
                        <span>{{ $totalvalue }}</span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('report.all') }}">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card text-white mb-4" style="background: #7e22ff;">
                    <div class="card-body">
                        <div>Total Winner <small>(Only Yours)</small></div>
                        <span>{{$pricewinner}}</span>
                    </div> 
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <form id="form1" action="{{route('report.load')}}" method="post" style="line-height:1">
                            @csrf
                        <a onclick="document.getElementById('form1').submit();" class="small text-white stretched-link" type="submit">View Details</a>
                        </form>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card text-white mb-4" style="background: #0e9b59;">
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