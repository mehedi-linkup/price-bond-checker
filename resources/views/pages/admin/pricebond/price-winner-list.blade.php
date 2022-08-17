@extends('layouts.admin-master', ['pageName'=> 'winner-list', 'title' => 'Add Winner List'])
@section('admin-content')

<main>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
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
                                <div class="col-md-12 mb-2">
                                    <label for="draw_No"> Draw Number <span class="text-danger">*</span> </label>
                                    <input type="number" name="draw_No" value="{{ @$winnerData ? $winnerData->draw_No : old('draw_No') }}" class="form-control form-control-sm mb-2" id="draw_No" placeholder="Draw Number">
                                    @error('draw_No') <span style="color: red">{{$message}}</span> @enderror


                                    <label for="price_sl" class="mb-2"> Price Serial <span class="text-danger">*</span> </label>
                                    <select name="price_sl_id" class="form-control form-control-sm mb-2">
                                        @if(@$winnerData)
                                        @foreach($list as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == @$winnerData->price_sl_id ? 'selected' : '' }} >{{ $item->price_sl }}th</option>
                                        @endforeach
                                        @elseif(old('price_sl_id'))
                                        @foreach($list as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == old('price_sl_id') ? 'selected' : '' }}>{{ $item->price_sl }}th</option>
                                        @endforeach
                                        @else
                                        <option value="">Select Serial</option>
                                        @foreach($list as $item)
                                        <option value="{{ $item->id }}">{{ $item->price_sl }}th</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    @error('price_sl_id') <span style="color: red">{{$message}}</span> @enderror


                                    <label for="bond_number"> Bond Number <span class="text-danger">*</span> </label>
                                    <input type="number" name="bond_number" value="{{ @$winnerData ? $winnerData->bond_number : old('bond_number')}}" class="form-control form-control-sm mb-2" id="bond_number" placeholder="Bond Number">
                                    @error('bond_number') <span style="color: red">{{$message}}</span> @enderror

                                    <label for="draw_date">Draw Date</label>
                                    <input type="date" class="form-control form-control-sm mb-2" id="draw_date" name="draw_date" value="{{ @$winnerData ? $winnerData->draw_date : '2022-07-31'}}" min="2022-01-31" max="2022-10-31">
                                    @error('draw_date') <span style="color: red">{{$message}}</span> @enderror
                                </div>
                            </div>
                            
                            <div class="clearfix border-top">
                                <div class="float-md-right mt-2">
                                    <button type="reset" class="btn btn-dark btn-sm">Reset</button>
                                    <button type="submit" class="btn btn-info btn-sm">{{(@$winnerData)?'Update':'Create'}}</button>
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
                                        <th>ID</th>
                                        <th>Draw No</th>
                                        <th>Price Serial</th>
                                        <th>Bond Number</th>
                                        <th>Draw Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($winner as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->draw_No }}</td>
                                        <td>
                                            @php
                                                $pricesl = \App\Models\PriceList::where('id', $item->price_sl_id)->first();
                                            @endphp
                                            @if($pricesl)
                                            {{ $pricesl->price_sl."th" }}
                                            @else
                                            {{ 'Unknown' }}
                                            @endif
                                        </td>
                                        <td>{{ $item->bond_number }}</td>
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