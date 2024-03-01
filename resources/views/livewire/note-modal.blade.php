<!-- note-modal.blade.php -->

<div>
    <!-- Trigger button -->
    <button wire:click="$set('showModal', true)">Create Note</button>

    <!-- Modal -->
    <div class="modal" style="display: {{ $showModal ? 'block' : 'none' }}; position: fixed; top: 10%; left: 10%; z-index: 9999;" x-init="draggableModal">
        <!-- Modal content -->
        <div class="modal-content" style="pointer-events: auto; background: white; border-radius: 10px; padding: 20px;">
            <!-- Note text input -->
            <input type="text" wire:model="noteText" placeholder="Enter note" class="input">

            <!-- Save button -->
            <button wire:click="saveNote" class="save-btn">Save</button>

            <!-- Close button -->
            <button wire:click="$set('showModal', false)" class="close-btn">Close</button>
        </div>
    </div>
</div>


<script>
function draggableModal() {
    const modal = document.querySelector('.modal-content');
    modal.onmousedown = function(event) {
        let shiftX = event.clientX - modal.getBoundingClientRect().left;
        let shiftY = event.clientY - modal.getBoundingClientRect().top;

        function moveAt(pageX, pageY) {
            modal.style.left = pageX - shiftX + 'px';
            modal.style.top = pageY - shiftY + 'px';
        }

        function onMouseMove(event) {
            moveAt(event.pageX, event.pageY);
        }

        document.addEventListener('mousemove', onMouseMove);

        document.addEventListener('mouseup', function() {
            document.removeEventListener('mousemove', onMouseMove);
        }, { once: true });
    };

    modal.ondragstart = function() {
        return false;
    };
}

</script>

