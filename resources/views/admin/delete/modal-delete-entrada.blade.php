<form action="{{ route('delete.entrada', $entrada->id) }}" method="POST"
    onsubmit="return confirm('Tem certeza que deseja excluir esta movimentação?')">
    @csrf
    @method('DELETE')

    <button type="submit" class="btn btn-danger">
        <i class="bi bi-trash"></i>
    </button>
</form>
