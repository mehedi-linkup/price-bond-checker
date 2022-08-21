@extends('layouts.admin-master', ['pageName'=> 'client', 'title' => 'Add Client Name'])
@section('admin-content')
<main>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card my-3">
                    <div class="card-header">
                        @if(@isset($clientData))
                        <i class="fas fa-edit mr-1"></i>Update Client Name
                        
                        @else
                        <i class="fas fa-plus mr-1"></i>Add Client Name
                        @endif
                    </div>
                    <div class="card-body">
                        <form action="{{ (@$clientData) ? route('client.update', $clientData->id) : route('client.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 col-form-label mt-2">Client Name <span class="text-danger">*</span> </label>
                                        <div class="col-sm-9 mt-2">
                                            <input type="text" name="name" value="{{ @$clientData ? $clientData->name : old('name')}}" class="form-control form-control-sm mb-2" id="name" placeholder="Client Name">
                                        </div>
                                        @error('name') <span style="color: red">{{$message}}</span><br> @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="clearfix border-top">
                                <div class="float-md-right mt-2">
                                    @if(@$clientData) 
                                    <a href="{{ route('client') }}" class="btn btn-dark btn-sm">Back</a>
                                    @else
                                    <button type="reset" class="btn btn-dark btn-sm">Reset</button>
                                    @endif
                                    <button type="submit" class="btn btn-info btn-form-info btn-sm">{{(@$clientData)?'Update':'Create'}}</button>
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
                        client List
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
                                    @foreach ($client as $key => $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <a href="{{ route('client.edit', $item->id) }}" class="btn btn-info btn-mod-info btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('client.delete', $item->id) }}" onclick="return confirm('Are you sure to Delete?')" class="btn btn-danger btn-mod-danger btn-sm"><i class="fas fa-trash"></i></a>
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