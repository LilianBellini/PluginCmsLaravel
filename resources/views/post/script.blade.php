
<link href="{{ asset('assets/plugins/custom/quil/css/quil.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/plugins/custom/quil/js/quil.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @foreach ($locales as $locale)
                const quill{{ $locale }} = new Quill('#editor_{{ $locale }}', {
                    theme: 'snow'
                });
                var content{{ $locale }} = document.getElementById('content_{{ $locale }}')
                    .getAttribute('data-content');

                quill{{ $locale }}.root.innerHTML = content{{ $locale }};

                quill{{ $locale }}.on('text-change', function() {
                    document.getElementById('textarea_{{ $locale }}').value =
                        quill{{ $locale }}.root.innerHTML;
                });
            @endforeach
        });
    </script>
    <script>
        $(document).ready(function() {
            $('select[name="category_id"]').select2({
                placeholder: "Choisir une catégorie...",
                allowClear: true
            });

            $('#tag_multiple').select2({
                placeholder: "Sélectionner des tags",
                allowClear: true
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @foreach ($locales as $locale)
                var titleInput{{ $locale }} = document.getElementById('title_{{ $locale }}');
                var slugInput{{ $locale }} = document.getElementById('slug_{{ $locale }}');

                titleInput{{ $locale }}.addEventListener('input', function() {
                    var slug = generateSlug(titleInput{{ $locale }}.value);
                    slugInput{{ $locale }}.value = slug;
                });

                function generateSlug(text) {
                    return text.toString().toLowerCase()
                        .replace(/\s+/g, '-') // Remplace les espaces par des tirets
                        .replace(/[^\w\-]+/g, '') // Retire les caractères non alphanumériques
                        .replace(/\-\-+/g, '-') // Remplace les tirets multiples par un seul tiret
                        .replace(/^-+/, '') // Retire les tirets au début
                        .replace(/-+$/, ''); // Retire les tirets à la fin
                }
            @endforeach
        });
    </script>