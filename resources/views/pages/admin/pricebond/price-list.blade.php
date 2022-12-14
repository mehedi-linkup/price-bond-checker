@extends('layouts.admin-master', ['pageName'=> 'prize-list', 'title' => 'Add Prize List'])
@section('admin-content')

<main>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card my-3">
                    <div class="card-header">
                        @if(@isset($priceData))
                        <i class="fas fa-edit mr-1"></i>Update Prize List
                        @else
                        <i class="fas fa-plus mr-1"></i>Add Prize List
                        @endif
                    </div>
                    <div class="card-body">
                        <form action="{{ (@$priceData) ? route('price-list.update', $priceData->id) : route('price-list.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row mb-0">
                                        <label for="price_sl" class="col-sm-3 col-form-label col-form-label-sm"> Prize Serial <span class="text-danger">*</span> </label>
                                        <div class="col-sm-9">
                                            <input type="number" name="price_sl" value="{{ @$priceData ? $priceData->price_sl : old('price_sl')}}" class="form-control form-control-sm mb-2" id="price_sl" placeholder="Price Serial">
                                        </div>
                                        @error('price_sl') <span style="color: red">{{$message}}</span><br> @enderror
                                    </div>       

                                    <div class="form-group row mb-0">
                                        <label for="amount" class="col-sm-3 col-form-label col-form-label-sm"> Prize amount <span class="text-danger">*</span> </label>
                                        <div class="col-sm-9">
                                            <input type="number" name="amount" value="{{ @$priceData ? $priceData->amount : old('amount')}}" class="form-control form-control-sm mb-2" id="amount" placeholder="Price amount">
                                        </div>
                                        @error('amount') <span style="color: red">{{$message}}</span><br> @enderror
                                    </div> 
                                </div>
                            </div>
                            
                            <div class="clearfix border-top">
                                <div class="float-md-right mt-2">
                                    @if(@$priceData)
                                    <a href="{{ route('price-list') }}" class="btn btn-dark btn-sm">Back</a>
                                    @else
                                    <button type="reset" class="btn btn-dark btn-sm">Reset</button>
                                    @endif
                                    <button type="submit" class="btn btn-info btn-form-info btn-sm">{{(@$priceData)?'Update':'Save'}}</button>
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
                                        <th>Prize Serial</th>
                                        <th>Prize Amount</th>
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
@push('admin-js')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
          "lengthMenu": [100, 150, 200, 300, 'All']
        });
      });
</script>
@endpush