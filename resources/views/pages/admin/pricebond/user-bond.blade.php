@extends('layouts.admin-master', ['pageName'=> 'user-bond', 'title' => 'Add Price Bond List'])
@section('admin-content')

<main>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="form-area">
                    @if(@isset($bondData))
                    <h4 class="heading"><i class="fas fa-edit mr-1"></i>Update Purchase Bond List</h4>
                    @else
                    <h4 class="heading"><i class="fas fa-plus mr-1"></i>Add Purchase Bond List</h4>
                    @endif
                    <form action="{{ (@$bondData) ? route('userbond.update', $bondData->id) : route('userbond.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-md-6 mb-2">
                                <label for="purchase_date"> Entry Date <span class="text-danger">*</span> </label>
                                <input type="date" name="date" value="{{ @$bondData ? $bondData->date : date('Y-m-d') }}" class="form-control form-control-sm mb-2" id="purchase_date">
                                @error('date') <span style="color: red">{{$message}}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="lot_number">Lot No <span class="text-danger">*</span></label>
                                <select name="lot_number" class="form-control form-control-sm d-inline-block mb-2" id="lot_number" style="width: 91%">
                                    @if(@$bondData)
                                        <option value="">Select Serial</option>
                                        @foreach($lot as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == @$bondData->lot_number ? 'selected' : '' }} >{{ $item->number }}</option>
                                        @endforeach
                                    @elseif(old('lot_number'))
                                        <option value="">Select Serial</option>
                                        @foreach($lot as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == old('lot_number') ? 'selected' : '' }}>{{ $item->number }}</option>
                                        @endforeach
                                    @else
                                        <option value="">Select Serial</option>
                                        @foreach($lot as $item)
                                        <option value="{{ $item->id }}">{{ $item->number }}</option>
                                        @endforeach
                                    @endif 
                                </select>
                                <a href="{{ route('lot') }}" class="add-item"><i class="fas fa-plus-circle"></i></a>
                                @error('lot_number') <span style="color: red">{{$message}}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="Series_no">Series No <span class="text-danger">*</span></label>
                                <select name="series_no" class="form-control form-control-sm d-inline-block mb-2" id="Series_no" style="width: 91%">
                                    @if(@$bondData)
                                        <option value="">Select Series</option>
                                        @foreach($series as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == @$bondData->series_no ? 'selected' : '' }} >{{ $item->series }}</option>
                                        @endforeach
                                    @elseif(old('series_no'))
                                        <option value="">Select Series</option>
                                        @foreach($series as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == old('series_no') ? 'selected' : '' }}>{{ $item->series }}</option>
                                        @endforeach
                                    @else
                                        <option value="">Select Series</option>
                                        @foreach ($series as $item)
                                        <option value="{{ $item->id }}">{{ $item->series}}</option>    
                                        @endforeach
                                    @endif
                                </select>
                                <a href="{{ route('bond-series') }}" class="add-item"><i class="fas fa-plus-circle"></i></a>
                                @error('series_no') <span style="color: red">{{$message}}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="bond_number"> Bond Number <span class="text-danger">*</span> </label>
                                <input type="number" name="bond_number" value="{{ @$bondData ? $bondData->bond_number : old('bond_number')}}" class="form-control form-control-sm mb-2" id="bond_number" placeholder="Bond Number">
                                @error('bond_number') <span style="color: red">{{$message}}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="price"> Price <span class="text-danger">*</span> </label>
                                <input type="number" name="price" value="{{ @$bondData ? $bondData->price : old('price')}}" class="form-control form-control-sm mb-2" id="price" placeholder="Enter Price">
                                @error('price') <span style="color: red">{{$message}}</span> @enderror
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
            <div class="col-md-6 offset-md-3">
                <div class="card my-3">
                    <a href="{{ route('draw') }}" target="_blank" rel="noopener noreferrer" class="btn btn-bg btn-warning">
                        Overall Draw
                    </a>
                </div>
            </div>
            {{-- <div class="col-md-12">
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
                                    @foreach ($bondlist as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            @php
                                                $lot = \App\Models\Lot::find($item->lot_number);
                                            @endphp
                                            {{  @$lot ? $lot->number : 'Unknown' }}
                                        </td>
                                        <td>
                                            @php
                                                $series = \App\Models\BondSeries::find($item->series_no);
                                            @endphp
                                            {{ @$series ? $series->series : 'Unknown' }}
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
            </div> --}}

            <div class="col-md-12">
                <div class="card my-3">
                    <div class="card-header">
                        <i class="fas fa-list mr-1"></i>
                       Your Lot List
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($lotwithBond as $item)
                            @if($item->userbond->count() > 0)
                            <div class="col-md-3 py-2">
                                <div class="bond-box border">
                                    <img src="{{ asset('img/bond.webp') }}" alt="" class="img-fluid">
                                    <p class="text-center m-0 p-3" style="border-top: 1px solid rgba(128, 128, 128, 0.384)">
                                        Bundle No: {{ $item->number }}
                                        <span class="text-success text-center">(Items {{ $item->userbond->count() }})</span>
                                    </p>
                                </div>
                                <a class="bond-link" href="{{ route('lotsUserBonds', $item->id) }}"></a>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>
@endsection