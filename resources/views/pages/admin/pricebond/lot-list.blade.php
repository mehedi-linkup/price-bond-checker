@extends('layouts.admin-master', ['pageName'=> 'lot-list', 'title' => 'Lot List'])
@section('admin-content')
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card my-3">
                    <div class="card-header">
                        <i class="fas fa-list mr-1"></i>
                       Your Lot List
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($lot as $item)
                            @if($item->userbond->count() > 0)
                            <div class="col-md-2 py-2">
                                <div class="bond-box border" style="position: relative">
                                    <img src="{{ asset('img/golden_frame.webp') }}" alt="" class="img-fluid" style="border: 16px solid #0f203e;">
                                    <p class="text-center m-0 p-1" style="border-top: 1px solid rgba(128, 128, 128, 0.384)">
                                        <span class="text-success text-center">(Items {{ $item->userbond->count() }})</span>
                                    </p>
                                    <span class="lot-number">{{ $item->number }}</span>
                                </div>
                                <a class="bond-link" href="{{ route('bond.with.lot', $item->id) }}"></a>
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