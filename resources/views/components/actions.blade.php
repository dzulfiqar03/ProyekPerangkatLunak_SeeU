<form action="{{ route('umkm.destroy', ['umkm' => $umkm->id]) }}" method="POST">
    @csrf
    @method('delete')
    <button type="submit" class="btn btn-outline-dark btn-sm me-2 btn-delete">
        <i class="bi-trash"></i>
    </button>
</form>
