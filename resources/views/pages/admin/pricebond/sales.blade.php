@extends('layouts.admin-master', ['pageName' => 'sale', 'title' => 'Sale Bonds'])
@push('admin-css')
<style>
    .col-form-label-sm {
        text-transform: uppercase;
        font-size: 0.80rem;
        font-weight: 400;
    }
    .form-control-sm {
        font-size: 0.80rem;
        border-radius: 0;
    }
    .form-control:focus {
        box-shadow: none;
    }
    .btn-form-info:focus, .btn-form-info.focus {
        box-shadow: none;
    }
    .btn-sm, .btn-group-sm > .btn {
        border-radius: 0;
    }
</style>
@endpush
@section('admin-content')
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card my-3">
                        <form action="{{ route('status') }}" method="POST">
                            @csrf
                            <div class="card-header d-flex">
                                <span class="col-sm-1" style="margin-top: 3px;">Sales</span>
                                <div class="col-sm-3">
                                    <div class="form-group row mb-0">
                                        <label for="lot_id" class="col-sm-4 col-form-label col-form-label-sm">Lot
                                            No</label>
                                        <select name="lot_id" class="form-control form-control-sm col-sm-8" id="lot_id">
                                            <option value=""selected>Select Lot</option>
                                            @foreach ($lot as $item)
                                                <option value="{{ $item->id }}">{{ $item->number }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group row mb-0">
                                        <label for="client_id" class="col-sm-4 col-form-label col-form-label-sm">Client
                                            Name</label>
                                        <div class="col-sm-8">
                                            <select name="client_id" class="form-control form-control-sm col-sm-8" id="client_id">
                                                <option value=""selected>Select Client</option>
                                                @foreach ($client as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('client_id')<span style="color:red; font-size:11px">{{$message}}</span>@enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-sm btn-info btn-form-info px-5">Sell</button>
                                </div>
                            </div>
                            <div id="replaceBondList" class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-center" id="dataTable" width="100%"
                                        cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" name="" id="all">All</th>
                                                <th>SL</th>
                                                <th>Lot Number</th>
                                                <th>Series No</th>
                                                <th class="text-left">Bond Number</th>
                                                <th class="text-left">Price</th>
                                                <th>Status</th>
                                                <th>Purchase Date</th>
                                                <th>Purchase Source</th>
                                                {{-- <th>Sold Date</th> --}}
                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($bondlist as $item)
                                                <tr>
                                                    <td><input type="checkbox" name="value[]"
                                                            id="checkbox{{ $item->id }}" value="{{ $item->id }}">
                                                    </td>
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
                                                    <td>
                                                        @if ($item->status == 'a')
                                                            <span class="badge badge-secondary">{{ 'Active' }}</span>
                                                        @elseif($item->status == 's')
                                                            <span class="badge badge-success">{{ 'Sold' }}</span>
                                                        @else
                                                            <span class="badge badge-light">{{ 'Unknown' }}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ date('Fj, Y', strtotime($item->purchase_date)) }}</td>
                                                    <td>{{ $item->source? $item->source->name : 'Unknown'}}</td>
                                                    {{-- <td>{{ date('Fj, Y', strtotime($item->updated_at)) }}</td> --}}
                                                    {{-- <td>
                                                        <a href="{{ route('userbond.edit', $item->id) }}"
                                                            class="btn btn-info btn-mod-info btn-sm"><i
                                                                class="fas fa-edit"></i></a>
                                                        <a href="{{ route('userbond.delete', $item->id) }}"
                                                            onclick="return confirm('Are you sure to Delete?')"
                                                            class="btn btn-danger btn-mod-danger btn-sm"><i
                                                                class="fas fa-trash"></i></a>
                                                    </td> --}}
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- <div class="d-flex"> --}}
                            {{-- <button type="submit" class="btn btn-sm btn-primary ml-2 mr-auto mb-2 mt-2 px-5">Submit</button> --}}
                            {{-- <img src="{{ asset('img/arrow-post-finance.gif') }}" style="width:90px;height:30px;display:inline-block;margin-bottom:12px;" alt=""> --}}
                            {{-- <a href="{{ route('draw-lot', $lot->id) }}" class="btn btn-sm btn-warning mb-2 px-5 mx-3">Draw</a> --}}
                            {{-- </div> --}}
                        </form>
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
    <script>
        $("#all").on("change", function(event) {
            if (event.target.checked) {
                $("[type=checkbox]").attr("checked", true)
            } else {
                $("[type=checkbox]").attr("checked", false)
            }
        });
        $("#lot_id").on("change", function(event) {
            var lotId = $('#lot_id').val();
            // console.log(lotId);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "GET",
                url: "/saleswithlot/" + lotId,
                data: '',
                success: function(res) {
                    // console.log(res);
                    $('#replaceBondList').html(res);
                    $('#dataTable').DataTable();
                    $("#all").on("change", function(event) {
                        if (event.target.checked) {
                            $("[type=checkbox]").attr("checked", true)
                        } else {
                            $("[type=checkbox]").attr("checked", false)
                        }
                    });

                    // $('#replaceBondList').replaceWith(res)
                    
                }
            });
        });
        
        // $("tbody").html("");
        // $.each(res, function(val){
        //     var row = `
        //         <tr></tr>
        //     `;
        //     $('tbody').append(row);

        // })
// function getCheckboxValue() {
        //     // var value = $("input[type='checkbox']"). val();
        //     var value = $('#checkbox1').val();
        //     console.log(value)
        // }


        // $("#formSubmit").on("submit", function(e) {
        //     e.preventDefault()
        //     alert('check')
        // })

        // function formSubmit(event){
        //     event.preventDefault()
        //     console.log(event);
        //     // var val = $(".checkvalue").val();
        //     // console.log(val);
        // }
    </script>
@endpush
