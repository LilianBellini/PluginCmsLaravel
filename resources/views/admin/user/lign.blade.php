<tr>
    <td class="ps-0 text-start">
        <span class="text-gray-800 fw-bold fs-6 d-block">{{ $user->name }}</span>
    </td>
    <td class="ps-0 text-start">
        <span class="text-gray-800 fw-bold fs-6 d-block">{{ $user->email }}</span>
    </td>
    <td class="text-center">
        <span class="text-gray-800 fw-bold fs-6">{{ $user->role->name }}</span>
    </td>
    <td class="text-end">
        <div class="d-inline-flex">
            <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-info btn-sm me-1">
                <i class="bi bi-pencil-square"></i>
            </a>
            <form method="POST" action="{{ route('admin.user.destroy', $user->id) }}" onsubmit="return confirm('Êtes-vous sûr ?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" type="submit"><i class="bi bi-trash3"></i></button>
            </form>
        </div>
    </td>
</tr>
