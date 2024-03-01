<?php

namespace App\Livewire;

use Livewire\Component;

class NoteModal extends Component
{
    public $showModal = false;
    public $noteText = ''; // Variable to store the note text

    // Method to toggle the visibility of the modal
    public function toggleModal()
    {
        $this->showModal = !$this->showModal;
    }

    // Method to handle the "Save" action
    public function saveNote()
    {
        // Here you would typically save the note to the database
        // For demonstration, we'll just reset the form and close the modal
        $this->noteText = '';
        $this->toggleModal();
        
        // Optionally, emit an event to notify the note has been saved
        // $this->emit('noteSaved');
    }

    public function render()
    {
        return view('livewire.note-modal');
    }
}

