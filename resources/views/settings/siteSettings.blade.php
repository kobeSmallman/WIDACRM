<x-layout>
    <div class="container mt-4">
        <h2>Site Settings</h2>

        <!-- Light/Dark Mode Toggle -->
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="darkModeToggle">
            <label class="custom-control-label" for="darkModeToggle">Toggle Dark Mode</label>
        </div>
    </div>

    <script>
        document.getElementById('darkModeToggle').addEventListener('change', function(event) {
            if (event.target.checked) {
                document.body.classList.add('dark-mode');
            } else {
                document.body.classList.remove('dark-mode');
            }
        });
    </script>
</x-layout>
