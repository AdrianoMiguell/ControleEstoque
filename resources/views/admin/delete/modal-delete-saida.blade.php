<form action="{{ route('delete.saida', $saida->id) }}" method="POST"
    onsubmit="return confirm('Tem certeza que deseja excluir este movimentação?')">
    @csrf
    @method('DELETE')

    <button type="submit" class="btn btn-danger">
        <i class="bi bi-trash"></i>
    </button>
</form>
