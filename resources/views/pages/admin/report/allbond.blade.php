@extends('layouts.admin-master', ['pageName'=> 'report-all', 'title' => 'All Report'])
@section('admin-content')

<main>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-4">
                    {{-- <div class="card-body">
                        <p class="m-0 text-success text-center py-2">Search</p>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card my-3">
                    <div class="card-header">
                        <i class="fas fa-list mr-1"></i>
                       All Bond List
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