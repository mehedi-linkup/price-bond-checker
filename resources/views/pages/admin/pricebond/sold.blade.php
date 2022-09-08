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
                                                <td>{{ $item->bond_number }}</td>
                                                <td>{{ $item->price }}</td>
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
                                                <td>{{ date('Fj, Y', strtotime(@$item->sold_date? $item->sold_date : $item->updated_at)) }}</td>
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
    $(document).ready(function() {
        $('#dataTable').DataTable({
          "lengthMenu": [100, 200, 300, 500, 'All']
        });
      });
</script>
@endpush
   