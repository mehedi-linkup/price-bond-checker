@extends('layouts.admin-master', ['pageName'=> 'report-all', 'title' => 'All Report Filter'])
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
                                All Bond List
                            </div>
                            <div class="col-md-10">
                                <form action="{{ route('reportWithfilter') }}" method="post" id="filter">
                                    @csrf
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group row py-2 mb-0 ">
                                            <label for="search_by" class="col-sm-5 col-form-label col-form-label-sm">Search By</label>
                                            <select class="form-control form-control-sm col-sm-7" id="search_by" onchange="SearchBy(this.value)">
                                                <option value="" selected>Select---</option>
                                                <option value="status">Status</option>
                                                <option value="lot">Lot</option>
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
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Lot No</th>
                                        <th>Series No</th>
                                        <th>Bond Number</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Purchase Date</th>
                                        <th>Sell Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($userbond as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->lot->number }}</td>
                                        <td>{{ $item->bondseries->series }}</td>
                                        <td>{{ $item->bond_number }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>
                                            @if($item->status == 's')
                                            <span class="badge badge-success">Sold</span>
                                            @else
                                            <span class="badge badge-warning">Unsold</span>
                                            @endif
                                        </td>
                                        <td>{{  date('F j, Y',strtotime($item->date))}}</td>
                                        <td>
                                            @if($item->status == 's')
                                            {{  date('F j, Y',strtotime($item->updated_at)) }}
                                            @else
                                            {{ '---' }}
                                            @endif
                                        </td>
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
            $('#status_column').hide();
            // $('#draw_no_column').show();
            // $('#status_column').show();
        } else if(value == 'status') {
            $('#status_column').show();
            $('#lot_no_column').hide();
        } else {
            $('#lot_no_column').hide();
            $('#status_column').hide();
        }
    }
</script>
@endpush