@extends('layouts.admin-master', ['pageName'=> 'report-draw', 'title' => 'All Result'])
@section('admin-content')

<main>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-body">
                        <form action="{{ route('report.load') }}" method="post">
                            @csrf
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="form-group row py-2 mb-0 ">
                                    <label for="search_by" class="col-sm-6 col-form-label col-form-label-sm">Search By</label>
                                    <select class="form-control form-control-sm col-sm-6" id="search_by" onchange="SearchBy(this.value)">
                                        <option value="" selected>Select---</option>
                                        <option value="lot">Lot</option>
                                        {{-- <option value="draw_no">Draw No</option> --}}
                                        {{-- <option value="win_series">Win Series</option>
                                        <option value="draw_date">Draw Date</option>
                                        <option value="win_amount">Win Amount</option>
                                        <option value="status">Status</option> --}}
                                        {{-- <option value="purchase_date">Purchase Date</option> --}}
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2" id="lot_no_column" style="display: none">
                                <div class="form-group row py-2 mb-0">
                                    <label for="lot_id" class="col-sm-4 col-form-label col-form-label-sm">Lot</label>
                                    <select name="lot_id" class="form-control form-control-sm col-sm-8" id="lot_id">
                                        <option value="">All</option>
                                        @foreach ($lot as $item)
                                        <option value="{{ $item->id }}">{{ $item->number }}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2" id="win_series_column" style="display: none">
                                <div class="form-group row py-2 mb-0">
                                    <label for="win_series" class="col-sm-7 col-form-label col-form-label-sm">Win Series</label>
                                    <select class="form-control form-control-sm col-sm-5" id="win_series">
                                        {{-- @foreach ($collection as $item)
                                        <option>Win Series</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2" id="draw_no_column" style="display: none">
                                <div class="form-group row py-2 mb-0">
                                    <label for="draw_id" class="col-sm-6 col-form-label col-form-label-sm">Draw No</label>
                                    <select name="draw_id" class="form-control form-control-sm col-sm-6" id="draw_id">
                                        @foreach ($draw as $item)
                                        <option value="{{ $item->id }}">{{ $item->draw }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2" id="draw_date_column" style="display: none">
                                <div class="form-group row py-2 mb-0">
                                    <label for="draw_date" class="col-sm-7 col-form-label col-form-label-sm">Draw Date</label>
                                    <select class="form-control form-control-sm col-sm-5" id="draw_date">
                                        <option>Win Series</option>
                                        <option>Draw No</option>
                                        <option>Draw Date</option>
                                        <option>Win Amount</option>
                                        <option>Lot</option>
                                        <option>Status</option>
                                        <option>Purchase Date</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2" id="win_amount_column" style="display: none">
                                <div class="form-group row py-2 mb-0">
                                    <label for="win_amount" class="col-sm-7 col-form-label col-form-label-sm pr-0">Win Amount</label>
                                    <select class="form-control form-control-sm col-sm-5" id="win_amount">
                                        <option>Win Series</option>
                                        <option>Draw No</option>
                                        <option>Draw Date</option>
                                        <option>Win Amount</option>
                                        <option>Lot</option>
                                        <option>Status</option>
                                        <option>Purchase Date</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2" id="status_column" style="display: none">
                                <div class="form-group row py-2 mb-0">
                                    <label for="status" class="col-sm-6 col-form-label col-form-label-sm">Status</label>
                                    <select name="status" class="form-control form-control-sm col-sm-6" id="status">
                                        <option value="">All</option>
                                        <option value="p">Unsold</option>
                                        <option value="s">Sold</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 d-flex justify-content-end align-items-center ml-auto">
                                <button type="submit" class="btn btn-sm btn-info btn-form-info">Search</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
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
                                        <th>Sl No</th>
                                        <th>Draw No</th>
                                        <th>Draw Date</th>
                                        <th>Win Position</th>
                                        <th>Win Amount</th>
                                        <th>My No</th>
                                        <th>Lot No</th>
                                        <th>Status</th>
                                        <th>Purchase Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                    @php
                                        $pricelist = \App\Models\PriceList::find($item->price_list_id);
                                        $banglaSeries = \App\Models\BondSeries::find($item->series_id);
                                        $lotno = \App\Models\Lot::find($item->lot_id);
                                        $drawno =  \App\Models\Draw::find($item->draw_id);
                                    @endphp
                                    <tr class="text-success">
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $drawno->draw }}</td>
                                        <td>{{ date('F j, Y',strtotime($item->draw_date)) }}</td>
                                        <td class="th_parent">{{ @$pricelist ? $pricelist->price_sl : 'Unknown' }}</td>
                                        <td>{{ @$pricelist ? $pricelist->amount : 'Unknown'}}</td>
                                        <td>{{ @$banglaSeries ? $banglaSeries->series : 'Unknown'}}{{$item->bond_number }}</td>
                                        <td>{{ $lotno->number }}</td>
                                        <td>
                                            @if($item->status == 's')
                                            <span class="badge badge-success">Sold</span>
                                            @else
                                            <span class="badge badge-warning">Unsold</span>
                                            @endif
                                        </td>
                                        <td>{{ date('F j, Y',strtotime($item->date)) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@push('admin-js')
<script>
    function SearchBy(value) {
        // console.log(value);
        if(value == 'lot') {
            $('#lot_no_column').show();
            $('#draw_no_column').show();
            $('#status_column').show();
        // } else if(value == 'model') {
        //     $('#model_column').show();
        //     $('#category_column').hide();
        } else {
            $('#lot_no_column').hide();
            $('#draw_no_column').hide();
            $('#status_column').hide();
        }
    }
</script>
@endpush