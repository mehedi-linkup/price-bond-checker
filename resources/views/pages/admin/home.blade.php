@extends('layouts.admin-master', ['pageName'=> 'dashboard', 'title' => 'Dashboard'])
{{-- @section('title', 'Dashboard') --}}
@push('admin-js')
    <style>
        .card {
            border-radius: 6px;
            transition: all 0.2s ease-in-out;
        }
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 0 30px #7f89a16b;
        }
        .card .card-body .icon {
            font-size: 30px;
        }
        .card .card-body .title {
            font-size: 12px;
            text-transform: uppercase;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            color: #94a3b8;
        }
        .card .card-body .value {
            color: rgb(30 41 59);
            font-weight: 700;
            font-size: 24px;
            font-family: 'Roboto', sans-serif;
        }
        .card-anon-pen {
            background:linear-gradient(115deg, #4fcf70, #fad648, #a767e5, #12bcfe, #44ce7b);
            padding: 3px;
            overflow: hidden;
        }
        .card-anon-pen:hover {
            -webkit-animation: play 1.6s ease-in infinite;
        }
        .card-footer {
            padding: 0;
            background-color: unset;
            border-top: none;
            padding-left: 0.875rem;
            padding-right: 0.875rem;
        }
        .stretched-link {
            padding: 7px 10px;
            border-radius: 6px;
            color: #fff;
            font-size: 12px;
        }
        .link-1 {
            border-color: #00c4ff;
            background-color: #00c4ff;
        }
        .link-2 {
            border-color: #10b981;
            background-color: #10b981;
        }
        .link-3 {
            border-color: #f59e0b;
            background-color: #f59e0b;
        }
        .link-4 {
            border-color: #ea5455;
            background-color: #ea5455;
        }
        .stretched-link:hover {
            color: #fff;
            text-decoration: none;
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
        <h4 class="my-3 heading"><i class="fad fa-tachometer-alt" style="color: #cf4c4c"></i> Dashboard</h4>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card p-md-3 mb-4" style="background-color:#441ebbd9;">
                    <div class="card-body">
                        <div class="icon" style="color: #00c4ff;"><i class="fad fa-analytics"></i></div>
                        <div class="title">Total Stock</div>
                        <div class="value">{{$userbond}}</div>
                    </div>
                    <div class="card-footer d-flex align-items-center">
                        <a class="stretched-link link-1" href="{{ route('stock.all') }}">View Details</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card p-md-3 mb-4" style="background-color: #9e0aa1;">
                    <div class="card-body">
                        <div class="icon" style="color: #10b981"><i class="fad fa-money-check-edit-alt"></i></div>
                        <div class="title">Total Value</div>
                        <div class="value">{{$totalvalue}}/-</div>
                    </div>
                    <div class="card-footer d-flex align-items-center">
                        <a class="stretched-link link-2" href="{{ route('stock.all') }}">View Details</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card p-md-3 mb-4" style="background-color: #1776c9;">
                    <div class="card-body">
                        <div class="icon" style="color: #f59e0b;"><i class="fad fa-trophy"></i></div>
                        <div class="title">Total Winner</div>
                        <div class="value">{{$pricewinner}}</div>
                    </div> 
                    <div class="card-footer d-flex align-items-center">
                        <form id="form1" action="{{route('report.load')}}" method="post">
                            @csrf
                        <a onclick="document.getElementById('form1').submit();" class="stretched-link link-3" type="submit">View Details</a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card p-md-3 mb-4" style="background-color:#ebcba1;">
                    <div class="card-body">
                        <div class="icon" style="color: #ea5455;"><i class="fad fa-chart-line"></i></div>
                        <div class="title">Total Lot</div>
                        <div class="value">{{$lot}}</div>
                    </div>
                    <div class="card-footer d-flex align-items-center">
                        <a class="stretched-link link-4" href="{{ route('lot.list') }}">View Details</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection