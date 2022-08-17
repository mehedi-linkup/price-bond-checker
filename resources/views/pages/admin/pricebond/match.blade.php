@extends('layouts.admin-master', ['pageName'=> 'Match Bond', 'title' => 'Matched Bond'])
@section('admin-content')

<main>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                @if($data->count() > 0)
                <div class="card mt-4">
                    <div class="card-body">
                        <p class="m-0 text-success text-center py-2">We've found {{ $data->count() }} Serial have been matched!</p>
                    </div>
                </div>
                @else
                <div class="card mt-4">
                    <div class="card-body mb-2">
                        <h2 class="text-danger text-center">Opps!</h2>
                        <p class="m-0 text-center text-danger py-2">Your serial haven't been match!</p>
                    </div>
                </div>
                <div class="text-center">
                    <a class="btn btn-sm btn-info mt-4" href="{{ route('userbond') }}">Back</a>
                </div>
                @endif
            </div>
        </div>
        @if($data->count() > 0)
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card my-3">
                    <div class="card-header">
                        <i class="fas fa-list mr-1"></i>
                       Match Bond List
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th class="text-left">Bond No.</th>
                                        <th>Serial</th>
                                        <th>Amount</th>
                                        <th>Draw No.</th>
                                        <th>Draw Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                    @php
                                        $pricelist = \App\Models\PriceList::find($item->price_sl_id);
                                    @endphp
                                    <tr class="text-success">
                                        <td class="text-dark">{{ $loop->index + 1 }}</td>
                                        <td class="text-left">{{ $item->bond_number }}</td>
                                        <td class="text-left"><span>{{ @$pricelist ? $pricelist->price_sl.'Th' : 'Unknown'}}</span></td>
                                        <td>{{ @$pricelist ? $pricelist->amount : 'Unknown'}}</td>
                                        <td>{{ $item->draw_No }}</td>
                                        <td>{{ date('F j, Y',strtotime($item->draw_date)) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</main>
@endsection