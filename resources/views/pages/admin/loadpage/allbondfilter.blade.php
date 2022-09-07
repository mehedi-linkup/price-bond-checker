@extends('layouts.admin-master', ['pageName'=> 'report-all', 'title' => 'All Report Filter'])
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
                                All Bond List
                            </div>
                            <div class="col-md-10">
                                <form action="{{ route('report.allFilter') }}" method="post" id="filter">
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
                                    <div class="col-lg-3" id="lot_no_column" style="display: none">
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
                                    <div class="col-lg-3" id="status_column" style="display: none">
                                        <div class="form-group row py-2 mb-0">
                                            <label for="status" class="col-sm-4 col-form-label col-form-label-sm">Status</label>
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
                                            <span class="badge badge-secondary">Active</span>
                                            @endif
                                        </td>
                                        <td>{{  date('F j, Y',strtotime($item->purchase_date))}}</td>
                                        <td>
                                            @if($item->status == 's')
                                            {{  @$item->sold_date? date('F j, Y',strtotime($item->sold_date)) : '---'}}
                                            @else
                                            <span class="badge badge-warning">Not Sold</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="2">Total Stock:</th>
                                        <th class="text-info">{{$totalstock}}</th>
                                        <th colspan="2">Total Price:</th>
                                        <th class="text-info">{{ $totalprice }}/-</th>
                                        <td colspan="2"></td>
                                    </tr>
                                </tfoot>
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
          "lengthMenu": [100, 150, 200, 300, 'All']
        });
      });
</script>
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