<script>
    document.addEventListener('DOMContentLoaded', function() {
        @foreach (config('app.langages') as $locale)
            var titleInput{{ $locale }} = document.getElementById('name_{{ $locale }}');
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