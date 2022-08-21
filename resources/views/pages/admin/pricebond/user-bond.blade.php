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
                        <div class="row mb-2">
                            <div class="col-md-6 mb-2">
                                <label for="purchase_date"> Entry Date <span class="text-danger">*</span> </label>
                                <input type="date" name="date" value="{{ @$bondData ? $bondData->date : date('Y-m-d') }}" class="form-control form-control-sm mb-2" id="purchase_date">
                                @error('date') <span style="color: red">{{$message}}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="lot_id">Lot No <span class="text-danger">*</span></label>
                                <select name="lot_id" class="form-control form-control-sm d-inline-block mb-2" id="lot_id" style="width: 91%">
                                    @if(@$bondData)
                                        <option value="">Select Serial</option>
                                        @foreach($lot as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == @$bondData->lot_id ? 'selected' : '' }} >{{ $item->number }}</option>
                                        @endforeach
                                    @elseif(old('lot_id'))
                                        <option value="">Select Serial</option>
                                        @foreach($lot as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == old('lot_id') ? 'selected' : '' }}>{{ $item->number }}</option>
                                        @endforeach
                                    @else
                                        <option value="">Select Serial</option>
                                        @foreach($lot as $item)
                                        <option value="{{ $item->id }}">{{ $item->number }}</option>
                                        @endforeach
                                    @endif 
                                </select>
                                <a href="{{ route('lot') }}" class="add-item"><i class="fas fa-plus-circle"></i></a>
                                @error('lot_id') <span style="color: red">{{$message}}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="series_id">Series No <span class="text-danger">*</span></label>
                                <select name="series_id" class="form-control form-control-sm d-inline-block mb-2" id="series_id" style="width: 91%">
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
                    <a href="{{ route('draw') }}" target="_blank" rel="noopener noreferrer" class="btn btn-bg btn-warning" style="font-weight: 700;font-size: 18px;">
                        Overall Draw
                    </a>
                </div>
            </div>
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
                            <div class="col-md-2 py-2">
                                <div class="bond-box border">
                                    <img src="{{ asset('img/golden_frame.webp') }}" alt="" class="img-fluid" style="border: 16px solid #0f203e;">
                                    <p class="text-center m-0 p-1" style="border-top: 1px solid rgba(128, 128, 128, 0.384)">
                                        <span class="text-success text-center">(Items {{ $item->userbond->count() }})</span>
                                    </p>
                                    <span style="position: absolute;right: 43px;top: 46px;font-size: 27px;text-transform: uppercase;font-weight: 700;color: #ff0707;">Lot {{ $item->number }}</span>
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