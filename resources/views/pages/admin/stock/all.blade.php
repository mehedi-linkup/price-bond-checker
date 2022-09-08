@extends('layouts.admin-master', ['pageName'=> 'stock-all', 'title' => 'All Bonds Stock'])
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
                                Total Bond Stock
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered allbond text-center" id="dataTable" width="100%" >
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Lot No</th>
                                        <th>Series No</th>
                                        <th>Bond Number</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Purchase Date</th>
                                        <th>Purchase Source </th>
                                        <th>Sold Date</th>
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
                                        <td>{{ @$item->source? $item->source->name : 'Unknown'}}</td>
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
                                        <td colspan="4"></td>
                                        <th colspan="2">Total Stock:</th>
                                        <th class="text-info">{{$totalstock}}</th>
                                        <th>Total Price:</th>
                                        <th class="text-info">{{ $totalprice }}/-</th>
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
          "lengthMenu": [500, 1000, 1500, 2000, 'All']
        });
      });
</script>
@endpush
