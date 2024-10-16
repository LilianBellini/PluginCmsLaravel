
<tr>
    <td class="text-start">
        <span class="badge {{ $post->status ? 'badge-light-success' : 'badge-light-warning' }}">
            {{ $post->status ? 'Publié' : 'Non publié' }}
        </span>
    </td>
    <td class="text-start">
        <a href="{{ route('post.edit', $post->id) }}" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">
            {{ $post->translations->first()->title ?? 'Titre non disponible' }}
        </a>
        <span class="text-gray-500 fw-semibold fs-7">{{ \Carbon\Carbon::parse(Auth::user()->created_at)->translatedFormat('d F Y')}}</span>
    </td>
    <td class="text-center">
        {{ optional($post->category->translations->first())->name ?? 'Catégorie non disponible' }}
    </td>
    <td class="text-center">
        @foreach ($post->tags as $tag)
        <span class="badge badge-light-primary">{{ optional($tag->translations->first())->name ?? 'Tag non disponible' }}</span>
        @endforeach
    </td>
    <td class="text-end">
        <div class="d-inline-flex">
            <a href="{{ route('post.edit', $post->id) }}" class="btn btn-info btn-sm me-1">
                <i class="bi bi-pencil-square"></i>
            </a>
            <form method="POST" action="{{ route('post.destroy', $post->id) }}" onsubmit="return confirm('Êtes-vous sûr ?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" type="submit"><i class="bi bi-trash3"></i></button>
            </form>
        </div>
    </td>
</tr>