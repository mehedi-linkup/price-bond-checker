@extends('layouts.admin-master', ['pageName'=> 'user-lot-bond', 'title' => 'User Bond According to Lot'])
@section('admin-content')

<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card my-3">
                    <div class="card-header">
                        <i class="fas fa-list mr-1"></i>
                        Lot Number {{$lot->number}}
                       {{-- Lot Number {{ $lotitem = \App\Models\lot::find($lot->id)->number; }} --}}
                       <span class="float-right">
                        <a href="{{ route('lot.list') }}" class="btn btn-sm btn-primary">Back</a>
                       </span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Lot Number</th>
                                        <th>Series No</th>
                                        <th>Bond Number</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Purchase Date</th>
                                        <th>Sold Date</th>
                                        <th>Purchase From</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lot->userbond as $item)
                                    <tr>
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
                                            @if($item->status == 'a')
                                            <span class="badge badge-secondary">{{ 'Active' }}</span>
                                            @elseif($item->status == 's')
                                            <span class="badge badge-success">{{ 'Sold' }}</span>
                                            @else
                                            {{ 'Unknown' }}
                                            @endif
                                        </td>
                                        <td>{{ date('Fj, Y', strtotime($item->purchase_date)) }}</td>
                                        <td>{{ @$item->sold_date ? (date('Fj, Y', strtotime($item->sold_date))) : '---' }}</td>
                                        <td>{{ @$item->source? $item->source->name : 'Unknown' }}</td>
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
                    {{-- <div class="d-flex">
                        <button type="submit" class="btn btn-sm btn-primary mx-auto mb-2 px-5">Submit</button>
                        <img src="{{ asset('img/arrow-post-finance.gif') }}" style="width:90px;height:30px;display:inline-block;margin-bottom:12px;" alt="">
                        <a href="{{ route('draw-lot', $lot->id) }}" class="btn btn-sm btn-warning mb-2 px-5 mx-3">Draw</a>
                    </div> --}}
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
        // $("#all").on("change", function(event) {
        //     if (event.target.checked) {
        //         $("[type=checkbox]").attr("checked", true)
        //     } else {
        //         $("[type=checkbox]").attr("checked", false)
        //     }
        // });

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

