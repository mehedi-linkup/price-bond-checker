@extends('layouts.admin-master', ['pageName'=> 'report-draw', 'title' => 'All Result'])
@push('admin-css')
<style>
    .col-form-label-sm {
        text-transform: uppercase;
        font-size: 0.80rem;
        font-weight: 400;
    }
    .form-control-sm {
        font-size: 0.80rem;
        border-radius: 0;
    }
    .form-control:focus {
        box-shadow: none;
    }
    .btn-form-info:focus, .btn-form-info.focus {
        box-shadow: none;
    }
    .btn-sm, .btn-group-sm > .btn {
        border-radius: 0;
    }
</style>
@endpush
@section('admin-content')
<main>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card my-3">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-2" style="padding-top: 10px">
                                <i class="fas fa-list mr-1"></i>
                               <span>Search Draw</span>
                            </div>
                            <div class="col-md-10">
                                <form action="{{ route('report.load') }}" method="post">
                                    @csrf
                                <div class="row">
                                    {{-- <div class="col-lg-3">
                                        <div class="form-group row py-2 mb-0 ">
                                            <label for="search_by" class="col-sm-5 col-form-label col-form-label-sm">Search By</label>
                                            <select class="form-control form-control-sm col-sm-7" id="search_by" onchange="SearchBy(this.value)">
                                                <option value="" selected>Select---</option>
                                                <option value="lot">Lot</option>
                                            </select>
                                        </div>
                                    </div> --}}
                                    <div class="col-lg-2" id="lot_no_column">
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
                                    <div class="col-lg-2" id="draw_no_column">
                                        <div class="form-group row py-2 mb-0">
                                            <label for="draw_id" class="col-sm-7 col-form-label col-form-label-sm">Draw No</label>
                                            <select name="draw_id" class="form-control form-control-sm col-sm-5" id="draw_id">
                                                <option value="">All</option>
                                                @foreach ($draw as $item)
                                                <option value="{{ $item->id }}">{{ $item->draw }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2" id="status_column">
                                        <div class="form-group row py-2 mb-0">
                                            <label for="status" class="col-sm-6 col-form-label col-form-label-sm">Status</label>
                                            <select name="status" class="form-control form-control-sm col-sm-6" id="status">
                                                <option value="">All</option>
                                                <option value="a">Active</option>
                                                <option value="s">Sold</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 d-flex align-items-center">
                                        <button type="submit" class="btn btn-sm btn-info btn-form-info">Search</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Draw No</th>
                                        <th>Draw Date</th>
                                        <th>Win Pos.</th>
                                        <th>Win Amount</th>
                                        <th>My No</th>
                                        <th>Lot No</th>
                                        <th>Status</th>
                                        <th>Purchase Date</th>
                                        <th>Purchase Source</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $item)
                                        @php
                                            $pricelist = \App\Models\PriceList::find($item->price_list_id);
                                            $banglaSeries = \App\Models\BondSeries::find($item->series_id);
                                            $lotno = \App\Models\Lot::find($item->lot_id);
                                            $drawno =  \App\Models\Draw::find($item->draw_id);
                                            $purchaseFrom = \App\Models\Source::find($item->source_id);
                                        @endphp
                                        <tr class="text-success">
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ @$drawno? $drawno->draw : 'Unknown'}}</td>
                                            <td>{{ date('F j, Y',strtotime($item->draw_date)) }}</td>
                                            <td class="th_parent">{{ @$pricelist ? $pricelist->price_sl : 'Unknown' }}</td>
                                            <td>{{ @$pricelist ? $pricelist->amount : 'Unknown'}}</td>
                                            <td>{{ @$banglaSeries ? $banglaSeries->series : 'Unknown'}}{{$item->bond_number }}</td>
                                            <td>{{ @$lotno? $lotno->number:'Unknown' }}</td>
                                            <td>
                                                @if($item->status == 's')
                                                <span class="badge badge-success">Sold</span>
                                                @elseif($item->status == 'a')
                                                <span class="badge badge-secondary">Active</span>
                                                @else
                                                <span>Unknown</span>
                                                @endif
                                            </td>
                                            <td>{{ date('F j, Y',strtotime($item->purchase_date)) }}</td>
                                            <td>{{ @$purchaseFrom? $purchaseFrom->name : 'Unknown'}}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10">No Data Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                @if(@$totalArray['totalStock'] > 0)
                                <tfoot>
                                    <tr>
                                        <th>Total Stock</th>
                                        <th class="text-warning">{{ $totalArray['totalStock'] }}</th>
                                        <th colspan="2">Winning Amount</th>
                                        <th class="text-warning">{{  $totalArray['totalAmount'] }}</th>
                                        <th colspan="5"></th>
                                    </tr>
                                </tfoot>
                                @endif
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
    $(document).ready(function() {
        $('#dataTable').DataTable({
          "lengthMenu": [500, 1000, 1500, 2000, 'All']
        });
      });
</script>
<script>
    function SearchBy(value) {
        // console.log(value);
        if(value == 'lot') {
            $('#lot_no_column').show();
            $('#draw_no_column').show();
            $('#status_column').show();
        } else {
            $('#lot_no_column').hide();
            $('#draw_no_column').hide();
            $('#status_column').hide();
        }
    }
</script>
@endpush