@php
    $currentRouteName = Route::currentRouteName();

     // Mendapatkan parameter id dari route saat ini, jika ada
     $currentRouteId = Route::current()->parameter('id');
@endphp

@if ($currentRouteName !== 'dataUmkm')
<div class="row">
    <a href="{{ route('detailAdmin', ['id' => $umkm->detailUmkm->id]) }}" class="btn btn-info btn-sm">Show</a>

</div>
@else
<form action="{{ route('umkm.destroy', ['umkm' => $umkm->id]) }}" method="POST">
    @csrf
    @method('delete')
    <button type="submit" class="btn btn-outline-dark btn-sm me-2 btn-delete">
        <i class="bi-trash"></i>
    </button>
</form>
@endif


