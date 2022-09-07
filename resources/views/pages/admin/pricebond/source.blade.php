@extends('layouts.admin-master', ['pageName'=> 'source', 'title' => 'Add Purchase Source Name'])
@section('admin-content')
<main>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card my-3">
                    <div class="card-header">
                        @if(@isset($sourceData))
                        <i class="fas fa-edit mr-1"></i>Update Purchase Source
                        
                        @else
                        <i class="fas fa-plus mr-1"></i>Add Purchase Source
                        @endif
                    </div>
                    <div class="card-body">
                        <form action="{{ (@$sourceData) ? route('source.update', $sourceData->id) : route('source.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row mb-0">
                                        <label for="name" class="col-sm-3 col-form-label col-form-label-sm">Source Name <span class="text-danger">*</span> </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="name" value="{{ @$sourceData ? $sourceData->name : old('name')}}" class="form-control form-control-sm mb-2" id="name" placeholder="Source Name">
                                        </div>
                                        @error('name') <span style="color: red">{{$message}}</span><br> @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="clearfix border-top">
                                <div class="float-md-right mt-2">
                                    @if(@$sourceData) 
                                    <a href="{{ route('source.all') }}" class="btn btn-dark btn-sm">Back</a>
                                    @else
                                    <button type="reset" class="btn btn-dark btn-sm">Reset</button>
                                    @endif
                                    <button type="submit" class="btn btn-info btn-form-info btn-sm">{{(@$sourceData)?'Update':'Save'}}</button>
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
                        Purchase Source List
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($source as $key => $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <a href="{{ route('source.edit', $item->id) }}" class="btn btn-info btn-mod-info btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('source.delete', $item->id) }}" onclick="return confirm('Are you sure to Delete?')" class="btn btn-danger btn-mod-danger btn-sm"><i class="fas fa-trash"></i></a>
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