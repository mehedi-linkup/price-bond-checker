@extends('layouts.admin-master', ['pageName'=> 'user-bond', 'title' => 'Add Price Bond List'])
@section('admin-content')

<main>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="form-area">
                    @if(@isset($bondData))
                    <h4 class="heading"><i class="fas fa-edit mr-1"></i>Update Purchased Bond List</h4>
                    @else
                    <h4 class="heading"><i class="fas fa-plus mr-1"></i>Add Purchased Bond List</h4>
                    @endif
                    <form action="{{ (@$bondData) ? route('userbond.update', $bondData->id) : route('userbond.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <div class="form-group row mb-0">
                                    <label for="purchase_date" class="col-sm-3 col-form-label col-form-label-sm">  Entry Date <span class="text-danger">*</span> </label>
                                    <div class="col-sm-9">
                                        <input type="date" name="purchase_date" value="{{ @$bondData ? date('Y-m-d', strtotime($bondData->purchase_date)) : date('Y-m-d') }}" class="form-control form-control-sm mb-2" id="purchase_date">
                                    </div>
                                    @error('purchase_date') <span style="color: red">{{$message}}</span><br> @enderror
                                </div>       
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group row mb-0">
                                    <label for="lot_id" class="col-sm-3 col-form-label col-form-label-sm"> Lot No <span class="text-danger">*</span> </label>
                                    <div class="col-sm-9">
                                        <select name="lot_id" class="form-control form-control-sm d-inline-block mb-2" id="lot_id" style="width: 88%">
                                            @if(@$bondData)
                                                <option value="">Select Lot</option>
                                                @foreach($lot as $item)
                                                <option value="{{ $item->id }}" {{ $item->id == @$bondData->lot_id ? 'selected' : '' }} >{{ $item->number }}</option>
                                                @endforeach
                                            @elseif(old('lot_id'))
                                                <option value="">Select Lot</option>
                                                @foreach($lot as $item)
                                                <option value="{{ $item->id }}" {{ $item->id == old('lot_id') ? 'selected' : '' }}>{{ $item->number }}</option>
                                                @endforeach
                                            @else
                                                <option value="">Select Lot</option>
                                                @foreach($lot as $item)
                                                <option value="{{ $item->id }}">{{ $item->number }}</option>
                                                @endforeach
                                            @endif 
                                        </select>
                                        <a href="{{ route('lot') }}" class="add-item"><i class="fas fa-plus-circle"></i></a>
                                        @error('lot_id') <span style="color: red">{{$message}}</span> @enderror
                                    </div>
                                </div>    
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group row mb-0">
                                    <label for="series_id" class="col-sm-3 col-form-label col-form-label-sm">Series No <span class="text-danger">*</span> </label>
                                    <div class="col-sm-9">
                                        <select name="series_id" class="form-control form-control-sm d-inline-block mb-2" id="series_id" style="width: 88%">
                                            @if(@$bondData)
                                                <option value="">Select Series</option>
                                                @foreach($series as $item)
                                                <option value="{{ $item->id }}" {{ $item->id == @$bondData->series_id ? 'selected' : '' }} >{{ $item->series }}</option>
                                                @endforeach
                                            @elseif(old('series_id'))
                                                <option value="">Select Series</option>
                                                @foreach($series as $item)
                                                <option value="{{ $item->id }}" {{ $item->id == old('series_id') ? 'selected' : '' }}>{{ $item->series }}</option>
                                                @endforeach
                                            @else
                                                <option value="">Select Series</option>
                                                @foreach ($series as $item)
                                                <option value="{{ $item->id }}">{{ $item->series}}</option>    
                                                @endforeach
                                            @endif
                                        </select>
                                        <a href="{{ route('bond-series') }}" class="add-item"><i class="fas fa-plus-circle"></i></a>
                                        @error('series_id') <span style="color: red">{{$message}}</span> @enderror
                                    </div>
                                </div> 
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group row mb-0">
                                    <label for="bond_number" class="col-sm-3 col-form-label col-form-label-sm"> Bond Number <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="number" name="bond_number" value="{{ @$bondData ? $bondData->bond_number : old('bond_number')}}" class="form-control form-control-sm mb-2" id="bond_number" placeholder="Bond Number">
                                    </div>
                                    @error('bond_number') <span style="color: red">{{$message}}</span> @enderror
                                </div>    
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group row mb-0">
                                    <label for="price" class="col-sm-3 col-form-label col-form-label-sm"> Price <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="number" name="price" value="{{ @$bondData ? $bondData->price : old('price')}}" class="form-control form-control-sm mb-2" id="price" placeholder="Enter Price">
                                    </div>
                                    @error('price') <span style="color: red">{{$message}}</span> @enderror
                                </div>
                            </div>
                            {{-- <div class="col-md-6 mb-2">
                                <div class="form-group row mb-0">
                                    <label for="source" class="col-sm-3 col-form-label col-form-label-sm">Purchase Source</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="source" value="{{ @$bondData ? $bondData->source : old('source')}}" class="form-control form-control-sm mb-2" id="source" placeholder="Enter Source">
                                    </div>
                                    @error('source') <span style="color: red">{{$message}}</span> @enderror
                                </div>
                            </div> --}}
                            <div class="col-md-6 mb-2">
                                <div class="form-group row mb-0">
                                    <label for="source" class="col-sm-3 col-form-label col-form-label-sm"> Purchase Source </span> </label>
                                    <div class="col-sm-9">
                                        <select name="source_id" class="form-control form-control-sm d-inline-block mb-2" id="source" style="width: 88%">
                                            @if(@$bondData)
                                                <option value="">Select Source</option>
                                                @foreach($source as $item)
                                                <option value="{{ $item->id }}" {{ $item->id == @$bondData->source_id ? 'selected' : '' }} >{{ $item->name }}</option>
                                                @endforeach
                                            @elseif(old('source_id'))
                                                <option value="">Select Source</option>
                                                @foreach($source as $item)
                                                <option value="{{ $item->id }}" {{ $item->id == old('source_id') ? 'selected' : '' }}>{{ $item->name }}</option>
                                                @endforeach
                                            @else
                                                <option value="">Select Source</option>
                                                @foreach($source as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            @endif 
                                        </select>
                                        <a href="{{ route('source.all') }}" class="add-item"><i class="fas fa-plus-circle"></i></a>
                                        @error('source_id') <span style="color: red">{{$message}}</span> @enderror
                                    </div>
                                </div>    
                            </div>
                        </div>
                        
                        <div class="clearfix border-top">
                            <div class="float-md-right mt-2">
                                @if(@$bondData)
                                <a href="{{ route('userbond') }}" class="btn btn-dark btn-sm">Back</a>
                                @else
                                <button type="reset" class="btn btn-dark btn-sm">Reset</button>
                                @endif
                                <button type="submit" class="btn btn-info btn-form-info btn-sm">{{(@$bondData)?'Update':'Save'}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card my-3">
                    <div class="card-header">
                        <i class="fas fa-list mr-1"></i>
                       Your Lot List
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Lot Number</th>
                                                    <th>Series No</th>
                                                    <th>Bond Number</th>
                                                    <th>Price</th>
                                                    {{-- <th>Status</th> --}}
                                                    <th>Purchase Date</th>
                                                    <th>Purchase Source</th>
                                                    <th>Action</th>
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
                                                    <td>{{ date('Fj, Y', strtotime($item->purchase_date)) }}</td>
                                                    <td>{{ @$item->source? $item->source->name : 'Unknown'}}</td>
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