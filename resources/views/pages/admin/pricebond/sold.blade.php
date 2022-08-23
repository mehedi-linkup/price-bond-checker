@extends('layouts.admin-master', ['pageName' => 'sold', 'title' => 'Sold Bonds'])
@section('admin-content')
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card my-3">
                        <div class="card-header d-flex">
                            <span class="col-sm-1" style="margin-top: 3px;">Sales</span>
                        </div>
                        <div id="replaceBondList" class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center" id="dataTable" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" name="" id="all">All</th>
                                            <th>SL</th>
                                            <th>Lot Number</th>
                                            <th>Series No</th>
                                            <th>Bond Number</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Sold To</th>
                                            <th>Sold Date</th>
                                            {{-- <th>Sold Date</th> --}}
                                            {{-- <th>Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bondlist as $item)
                                            <tr>
                                                <td><input type="checkbox" name="value[]"
                                                        id="checkbox{{ $item->id }}" value="{{ $item->id }}">
                                                </td>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>
                                                    @php
                                                        $lotitem = \App\Models\lot::find($item->lot_id);
                                                        
                                                    @endphp
                                                    {{ $lotitem->number }}
                                                </td>
                                                <td>
                                                    @php
                                                        $seriesitem = \App\Models\BondSeries::find($item->series_id);
                                                    @endphp
                                                    {{ $seriesitem->series }}
                                                </td>
                                                <td class="text-left">{{ $item->bond_number }}</td>
                                                <td class="text-left">{{ $item->price }}</td>
                                                <td>
                                                    @if ($item->status == 'p')
                                                        <span class="badge badge-warning">{{ 'Unsold' }}</span>
                                                    @elseif($item->status == 's')
                                                        <span class="badge badge-success">{{ 'Sold' }}</span>
                                                    @else
                                                        {{ 'Unknown' }}
                                                    @endif
                                                </td>
                                                <td class="text-danger">{{ $item->client->name }}</td>
                                                <td>{{ date('Fj, Y', strtotime($item->updated_at)) }}</td>
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

   