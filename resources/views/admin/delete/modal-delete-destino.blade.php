<form action="{{ route('delete.destino', $destino->id) }}" method="POST"
    onsubmit="return confirm('Tem certeza que deseja excluir este destino?')">
    @csrf
    @method('DELETE')

    <button type="submit" class="btn btn-danger">
        <i class="bi bi-trash"></i>
    </button>
</form>
