@extends('layouts.admin-master', ['pageName'=> 'lot', 'title' => 'Add Lot Number'])
@section('admin-content')
<main>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card my-3">
                    <div class="card-header">
                        @if(@isset($lotData))
                        <i class="fas fa-edit mr-1"></i>Update Lot Number
                        
                        @else
                        <i class="fas fa-plus mr-1"></i>Add Lot Number
                        @endif
                    </div>
                    <div class="card-body">
                        <form action="{{ (@$lotData) ? route('lot.update', $lotData->id) : route('lot.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <div class="form-group row">
                                        <label for="Number" class="col-sm-3 col-form-label mt-2"> Lot Number <span class="text-danger">*</span> </label>
                                        <div class="col-sm-9 mt-2">
                                            <input type="number" name="number" value="{{ @$lotData ? $lotData->number : old('number')}}" class="form-control form-control-sm mb-2" id="Number" placeholder="Lot Number">
                                        </div>
                                        @error('number') <span style="color: red">{{$message}}</span><br> @enderror
                                    </div>       
                                </div>
                            </div>
                            
                            <div class="clearfix border-top">
                                <div class="float-md-right mt-2">
                                    @if(@$lotData) 
                                    <a href="{{ route('lot') }}" class="btn btn-dark btn-sm">Back</a>
                                    @else
                                    <button type="reset" class="btn btn-dark btn-sm">Reset</button>
                                    @endif
                                    <button type="submit" class="btn btn-info btn-form-info btn-sm">{{(@$lotData)?'Update':'Save'}}</button>
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
                        Lot Number List
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Lot Number</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lot as $key => $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->number }}</td>
                                        <td>
                                            <a href="{{ route('lot.edit', $item->id) }}" class="btn btn-info btn-mod-info btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('lot.delete', $item->id) }}" onclick="return confirm('Are you sure to Delete?')" class="btn btn-danger btn-mod-danger btn-sm"><i class="fas fa-trash"></i></a>
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