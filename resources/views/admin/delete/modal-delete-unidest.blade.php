<form action="{{ route('delete.unidest', $unid->id) }}" method="POST"
    onsubmit="return confirm('Tem certeza que deseja excluir este unidade de estoque?')">
    @csrf
    @method('DELETE')

    <button type="submit" class="btn btn-danger">
        <i class="bi bi-trash"></i>
    </button>
</form>
