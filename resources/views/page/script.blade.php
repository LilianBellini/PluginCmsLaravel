    <link href="https://cdn.jsdelivr.net/npm/jsoneditor@latest/dist/jsoneditor.min.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/jsoneditor@latest/dist/jsoneditor.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const container = document.getElementById('jsoneditor');
            const hiddenInput = document.getElementById('data-json-input');

            const options = {
                mode: 'form', // tu peux tester aussi 'code' ou 'tree'
                onChangeText: function (jsonString) {
                    hiddenInput.value = jsonString;
                }
            };

            // Initialisation : parser proprement les données du backend
            let initialJson = {};
            try {
                initialJson = JSON.parse(@json(old('data', $page->data ?? [])));
            } catch (e) {
                console.error("Erreur lors du parsing JSON initial :", e);
            }

            const editor = new JSONEditor(container, options);
            editor.set(initialJson);
            hiddenInput.value = JSON.stringify(initialJson);
        });
    </script>