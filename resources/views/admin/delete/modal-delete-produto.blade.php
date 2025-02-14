<form action="{{ route('delete.produto', $produto->id) }}" method="POST"
    onsubmit="return confirm('Tem certeza que deseja excluir este produto?')">
    @csrf
    @method('DELETE')

    <button type="submit" class="btn btn-danger">
        <i class="bi bi-trash"></i>
    </button>
</form>
