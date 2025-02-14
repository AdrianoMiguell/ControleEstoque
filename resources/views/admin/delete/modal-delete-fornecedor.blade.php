<form action="{{ route('delete.fornecedor', $fornecedor->id) }}" method="POST"
    onsubmit="return confirm('Tem certeza que deseja excluir este fornecedor?')">
    @csrf
    @method('DELETE')

    <button type="submit" class="btn btn-danger">
        <i class="bi bi-trash"></i>
    </button>
</form>
