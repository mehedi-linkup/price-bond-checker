@extends('layouts.admin-master', ['pageName'=> 'bond-series', 'title' => 'Add Bond Series'])
@section('admin-content')
<main>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card my-3">
                    <div class="card-header">
                        @if(@isset($bondData))
                        <i class="fas fa-edit mr-1"></i>Update Bond Series
                        
                        @else
                        <i class="fas fa-plus mr-1"></i>Add Bond Series
                        @endif
                    </div>
                    <div class="card-body">
                        <form action="{{ (@$bondData) ? route('bond-series.update', $bondData->id) : route('bond-series.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    {{-- <label for="series" class="mb-2"> Bond Series <span class="text-danger">*</span> </label>
                                    <input type="text" name="series" value="{{ @$bondData ? $bondData->series : old('series')}}" class="form-control form-control-sm mb-2" id="series" placeholder="Bond Serial">
                                    @error('series') <span style="color: red">{{$message}}</span><br> @enderror --}}


                                    <div class="form-group row mb-0">
                                        <label for="series" class="col-sm-3 col-form-label col-form-label-sm"> Bond Series <span class="text-danger">*</span> </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="series" value="{{ @$bondData ? $bondData->series : old('series')}}" class="form-control form-control-sm mb-2" id="series" placeholder="Bond Serial">
                                        </div>
                                        @error('series') <span style="color: red">{{$message}}</span><br> @enderror
                                    </div>       
                                </div>
                            </div>
                            
                            <div class="clearfix border-top">
                                <div class="float-md-right mt-2">
                                    @if(@$bondData) 
                                    <a href="{{ route('bond-series') }}" class="btn btn-dark btn-sm">Back</a>
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

            <div class="col-md-6">
                <div class="card my-3">
                    <div class="card-header">
                        <i class="fas fa-list mr-1"></i>
                        Bond Series List
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Bond Series</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bondseries as $key => $item)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $item->series }}</td>
                                        <td>
                                            <a href="{{ route('bond-series.edit', $item->id) }}" class="btn btn-info btn-mod-info btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('bond-series.delete', $item->id) }}" onclick="return confirm('Are you sure to Delete?')" class="btn btn-danger btn-mod-danger btn-sm"><i class="fas fa-trash"></i></a>
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