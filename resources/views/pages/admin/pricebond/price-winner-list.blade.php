@extends('layouts.admin-master', ['pageName'=> 'winner-list', 'title' => 'Add Winner List'])

@section('admin-content')
<main>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card my-3">
                    <div class="card-header">
                        @if(@isset($winnerData))
                        <i class="fas fa-edit mr-1"></i>Update Winner List
                        
                        @else
                        <i class="fas fa-plus mr-1"></i>Add Winner List
                        @endif
                    </div>
                    <div class="card-body">
                        <form action="{{ (@$winnerData) ? route('price-winner.update', $winnerData->id) : route('price-winner.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 my-2">
                                    <div class="form-group row mb-0">
                                        <label for="draw_id" class="col-sm-3 col-form-label col-form-label-sm">Draw Number <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="draw_id" class="form-control form-control-sm d-inline-block mb-2" style="width: 88%" id="draw_id">
                                                @if(@$winnerData)
                                                @foreach($draw as $item)
                                                <option value="{{ $item->id }}" {{ $item->id == @$winnerData->draw_id ? 'selected' : '' }} >{{ $item->draw }}</option>
                                                @endforeach
                                                @elseif(old('draw_id'))
                                                @foreach($draw as $item)
                                                <option value="{{ $item->id }}" {{ $item->id == old('draw_id') ? 'selected' : '' }}>{{ $item->draw }}</option>
                                                @endforeach
                                                @else
                                                <option value="">Select Serial</option>
                                                @foreach($draw as $item)
                                                <option value="{{ $item->id }}">{{ $item->draw }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <a href="{{ route('draw.all') }}" class="add-item"><i class="fas fa-plus-circle"></i></a>
                                            @error('draw_id') <span style="color: red">{{$message}}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-2">
                                    <div class="form-group row mb-0">
                                        <label for="price_list_id" class="col-sm-3 col-form-label">Prize Serial <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="price_list_id" class="form-control form-control-sm d-inline-block mb-2"  style="width: 88%" id="price_list_id">
                                                @if(@$winnerData)
                                                @foreach($pricelist as $item)
                                                <option value="{{ $item->id }}" {{ $item->id == @$winnerData->price_list_id ? 'selected' : '' }} >{{ $item->price_sl }}</option>
                                                @endforeach
                                                @elseif(old('price_list_id'))
                                                @foreach($pricelist as $item)
                                                <option value="{{ $item->id }}" {{ $item->id == old('price_list_id') ? 'selected' : '' }}>{{ $item->price_sl }}</option>
                                                @endforeach
                                                @else
                                                <option value="">Select Serial</option>
                                                @foreach($pricelist as $item)
                                                <option value="{{ $item->id }}">{{ $item->price_sl }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <a href="{{ route('price-list') }}" class="add-item"><i class="fas fa-plus-circle"></i></a>
                                            @error('price_list_id') <span style="color: red">{{$message}}</span> @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-2">
                                    <div class="form-group row mb-0">
                                        <label for="bond_number" class="col-sm-3 col-form-label">Bond Number<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="number" name="bond_number" value="{{ @$winnerData ? $winnerData->bond_number : old('bond_number')}}" class="form-control form-control-sm mb-2" id="bond_number" placeholder="Bond Number">
                                            @error('bond_number') <span style="color: red">{{$message}}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-group row mb-0">
                                        <label for="draw_date" class="col-sm-3 col-form-label">Draw Date</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control form-control-sm mb-2" id="draw_date" name="draw_date" value="{{ @$winnerData ? $winnerData->draw_date : date('Y-m-d') }}" min="2022-01-31" max="2022-10-31">
                                        </div>
                                        @error('draw_date') <span style="color: red">{{$message}}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="clearfix border-top">
                                <div class="float-md-right mt-2">
                                    @if(@$winnerData)
                                    <a href="{{ route('price-winner') }}" class="btn btn-dark btn-sm">Back</a>
                                    @else
                                    <button type="reset" class="btn btn-dark btn-sm">Reset</button>
                                    @endif
                                    <button type="submit" class="btn btn-info btn-form-info btn-sm">{{(@$winnerData)?'Update':'Save'}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card my-3">
                    <div class="card-header">
                        <i class="fas fa-list mr-1"></i>
                       Winner List
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        {{-- <th>ID</th> --}}
                                        <th>Prize Serial</th>
                                        <th>Bond Number</th>
                                        <th>Prize Amount</th>
                                        <th>Draw No</th>
                                        <th>Draw Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($winner as $item)
                                    <tr style="color: #008000">
                                        {{-- <td>{{ $loop->index + 1 }}</td> --}}
                                        <td>{{ $item->pricelist->price_sl }} </td>
                                        <td>{{ $item->bond_number }}</td>
                                        <td>{{ $item->pricelist->amount }} </td>
                                        <td>{{ $item->draw->draw }}</td>
                                        <td>{{ $item->draw_date }}</td>
                                        <td>
                                            <a href="{{ route('price-winner.edit', $item->id) }}" class="btn btn-info btn-mod-info btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('price-winner.delete', $item->id) }}" onclick="confirm('Are you sure to Delete?')" class="btn btn-danger btn-mod-danger btn-sm"><i class="fas fa-trash"></i></a>
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
    $(document).ready(function() {
        $('#dataTable').DataTable({
          "lengthMenu": [100, 150, 200, 300, 'All']
        });
      });
</script>
@endpush