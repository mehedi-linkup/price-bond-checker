@extends('layouts.admin-master', ['pageName'=> 'user-lot-bond', 'title' => 'User Bond According to Lot'])
@section('admin-content')

<main>
    <div class="container-fluid">
        <div class="row">
            {{-- <div class="col-md-6 offset-md-3">
                <div class="card my-3">
                    <a href="{{ route('joint') }}" target="_blank" rel="noopener noreferrer" class="btn btn-warning text-white">
                        Draw
                    </a>
                </div>
            </div> --}}

            <div class="col-md-12">
                <div class="card my-3">
                    <div class="card-header">
                        <i class="fas fa-list mr-1"></i>
                       Purchase Bond List
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" name="" id="">
                                            All
                                        </th>
                                        <th>SL</th>
                                        <th>Lot Number</th>
                                        <th>Series No</th>
                                        <th class="text-left">Bond Number</th>
                                        <th class="text-left">Price</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @php
                                        dd($lot)
                                    @endphp --}}
                                    @foreach ($lot->userbond as $item)
                                    <tr>
                                        <td><input type="checkbox" name="" id=""></td>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            {{  $item->lot_number }}
                                        </td>
                                        <td>
                                            {{ $item->series_no }}
                                        </td>                                      
                                        <td class="text-left">{{ $item->bond_number }}</td>
                                        <td class="text-left">{{ $item->price }}</td>
                                        <td>
                                            @if($item->status == 'p')
                                            <span style="background-color: yellow">{{ 'Pending' }}</span>
                                            @elseif($item->status == 's')
                                            <span style="background-color: green">{{ 'Sold' }}</span>
                                            @else
                                            {{ 'Unknown' }}
                                            @endif
                                        </td>
                                        <td>{{ $item->date }}</td>
                                        <td>
                                            <a href="{{ route('userbond.edit', $item->id) }}" class="btn btn-info btn-mod-info btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('userbond.delete', $item->id) }}" onclick="return confirm('Are you sure to Delete?')" class="btn btn-danger btn-mod-danger btn-sm"><i class="fas fa-trash"></i></a>
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