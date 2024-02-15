<x-layout>
    <div class="container mt-4">
        <h2>Site Settings</h2>

        <!-- Light/Dark Mode Toggle -->
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="darkModeToggle" {{ session('dark_mode') ? 'checked' : '' }}>
            <label class="custom-control-label" for="darkModeToggle">Toggle Dark Mode</label>
        </div>
    </div>

    <script>
        document.getElementById('darkModeToggle').addEventListener('change', function(event) {
            let darkMode = event.target.checked;
            document.body.classList.toggle('dark-mode', darkMode);
            
            // Save the preference to the session
            fetch('{{ route('settings.save-mode') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ dark_mode: darkMode })
            });
        });
    </script>
</x-layout>
