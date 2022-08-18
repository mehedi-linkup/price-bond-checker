@extends('layouts.admin-master', ['pageName'=> 'price-list', 'title' => 'Add list List'])
@section('admin-content')

<main>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card my-3">
                    <div class="card-header">
                        @if(@isset($priceData))
                        <i class="fas fa-edit mr-1"></i>Update Price List
                        @else
                        <i class="fas fa-plus mr-1"></i>Add Price List
                        @endif
                    </div>
                    <div class="card-body">
                        <form action="{{ (@$priceData) ? route('price-list.update', $priceData->id) : route('price-list.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <label for="price_sl" class="mb-2"> Price Serial <span class="text-danger">*</span> </label>
                                    <input type="number" name="price_sl" value="{{ @$priceData ? $priceData->price_sl : old('price_sl')}}" class="form-control form-control-sm mb-2" id="price_sl" placeholder="Price Serial">
                                    @error('price_sl') <span style="color: red">{{$message}}</span><br> @enderror

                                    <label for="amount"> Price Amount <span class="text-danger">*</span> </label>
                                    <input type="number" name="amount" value="{{ @$priceData ? $priceData->amount : old('amount')}}" class="form-control form-control-sm mb-2" id="amount" placeholder="Price Amount">
                                    @error('amount') <span style="color: red">{{$message}}</span><br> @enderror
                                </div>
                            </div>
                            
                            <div class="clearfix border-top">
                                <div class="float-md-right mt-2">
                                    <button type="reset" class="btn btn-dark btn-sm">Reset</button>
                                    <button type="submit" class="btn btn-info btn-form-info btn-sm">{{(@$priceData)?'Update':'Create'}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <div class="card my-3">
                    <div class="card-header">
                        <i class="fas fa-list mr-1"></i>
                       list List
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Price Serial</th>
                                        <th>Price Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pricelist as $item)
                                    <tr>
                                        <td>{{ $item->price_sl }}</td>
                                        <td>{{ $item->amount }}</td>
                                        <td>
                                            <a href="{{ route('price-list.edit', $item->id) }}" class="btn btn-info btn-mod-info btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('price-list.delete', $item->id) }}" onclick="return confirm('Are you sure to Delete?')" class="btn btn-danger btn-mod-danger btn-sm"><i class="fas fa-trash"></i></a>
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