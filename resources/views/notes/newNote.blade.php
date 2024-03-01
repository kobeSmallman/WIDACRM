<!-- create-note-modal.blade.php -->

<div>
    <!-- Trigger button -->
    <button onclick="openNoteModal()">Create Note</button>
</div>

<script>
    let noteModal;

    function openNoteModal() {
        // Check if the modal window is already open
        if (!noteModal || noteModal.closed) {
            // Open the modal in a new window
            noteModal = window.open('', 'NoteModal', 'width=400,height=300');

            // Set the document title
            noteModal.document.title = 'Create Note';

            // Add style
            const style = noteModal.document.createElement('style');
            style.textContent = `/* Add your CSS styles here */`;
            noteModal.document.head.appendChild(style);

            // Add the content to the body
            noteModal.document.body.innerHTML = `
                <h2>Create Note</h2>
                <textarea id="noteText" placeholder="Enter note" style="width: 100%; height: 150px;"></textarea><br>
                <button onclick="saveNote()">Save</button>
                <button onclick="closeModal()">Close</button>
            `;

            // Add scripts
            const script = noteModal.document.createElement('script');
            script.textContent = `
                function saveNote() {
                    let noteText = document.getElementById('noteText').value;
                    // Replace with AJAX call or other method to save note
                    console.log('Note saved:', noteText);
                    // Close the modal window after saving
                    window.close();
                }

                function closeModal() {
                    window.close();
                }
            `;
            noteModal.document.body.appendChild(script);
        } else {
            // If the modal window is already open, bring it to focus
            noteModal.focus();
        }
    }
</script>
