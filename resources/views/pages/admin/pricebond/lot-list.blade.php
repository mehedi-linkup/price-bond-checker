@extends('layouts.admin-master', ['pageName'=> 'lot-list', 'title' => 'Lot List'])
@push('admin-css')
 <style>
.button-71 {
  background-color: #0078d0;
  border: 0;
  border-radius: 56px;
  color: #fff;
  cursor: pointer;
  display: inline-block;
  font-family: system-ui,-apple-system,system-ui,"Segoe UI",Roboto,Ubuntu,"Helvetica Neue",sans-serif;
  font-size: 18px;
  font-weight: 600;
  outline: 0;
  padding: 16px 21px;
  position: relative;
  text-align: center;
  text-decoration: none;
  transition: all .3s;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
}

.button-71:before {
  background-color: initial;
  background-image: linear-gradient(#fff 0, rgba(255, 255, 255, 0) 100%);
  border-radius: 125px;
  content: "";
  height: 50%;
  left: 4%;
  opacity: .5;
  position: absolute;
  top: 0;
  transition: all .3s;
  width: 92%;
}

.button-71:hover {
    color: white;
    text-decoration: none;
    box-shadow: rgba(255, 255, 255, .2) 0 3px 15px inset, rgba(0, 0, 0, .1) 0 3px 5px, rgba(0, 0, 0, .1) 0 10px 13px;
    transform: scale(1.05);
}

@media (min-width: 768px) {
    .button-71 {
        padding: 30px 48px;
        width: 100%;
    }
}
</style>   
@endpush
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
                    <div class="card-body pb-5">
                        <div class="row">
                            @foreach($lot as $item)
                            @if($item->userbond->count() > 0)
                            <div class="col-md-2 py-2">
                                {{-- <div class="bond-box" style="position: relative">
                                    <div class="text-center m-0 p-4" style="border: 8px solid rgb(128, 128, 128); border-radius:8px; background-color: #695297;">
                                        <span class="lot-number">{{ $item->number }}</span>
                                        <span class="text-success text-center">(Items {{ $item->userbond->count() }})</span>
                                    </div>
                                </div>
                                <a class="bond-link" href="{{ route('bond.with.lot', $item->id) }}"></a> --}}
                                <a href="{{ route('bond.with.lot', $item->id) }}" class="button-71">{{$item->number}}</a>
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
@push('admin-js')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
          "lengthMenu": [100, 150, 200, 300, 'All']
        });
      });
</script>
@endpush