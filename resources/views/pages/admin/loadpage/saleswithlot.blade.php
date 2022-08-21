
    <div class="table-responsive">
        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th><input type="checkbox" name="" id="all">All</th>
                    <th>SL</th>
                    <th>Lot Number</th>
                    <th>Series No</th>
                    <th>Bond Number</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Purchase Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lot[0]->userbond as $item)
                <tr>
                    <td><input type="checkbox" name="value[]" id="checkbox{{ $item->id }}" value="{{ $item->id }}"></td>
                    <td>{{ $loop->index + 1  }}</td>
                    <td>
                        {{ $item->lot_id }}
                    </td>
                    <td>
                        {{ $item->series_id }}
                    </td>                                      
                    <td>{{ $item->bond_number }}</td>
                    <td>{{ $item->price }}</td>
                    <td>
                        @if($item->status == 'p')
                        <span class="badge badge-warning">{{ 'Unsold' }}</span>
                        @elseif($item->status == 's')
                        <span class="badge badge-success">{{ 'Sold' }}</span>
                        @else
                        {{ 'Unknown' }}
                        @endif
                    </td>
                    <td>{{ date('Fj, Y', strtotime($item->date)) }}</td>
                    <td>
                        <a href="{{ route('userbond.edit', $item->id) }}" class="btn btn-info btn-mod-info btn-sm"><i class="fas fa-edit"></i></a>
                        <a href="{{ route('userbond.delete', $item->id) }}" onclick="return confirm('Are you sure to Delete?')" class="btn btn-danger btn-mod-danger btn-sm"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>