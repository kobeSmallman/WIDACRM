<x-layout>
    <!-- Styles to match the CRM layout -->
    <style>
        .container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            /* Creates two columns */
            grid-gap: 20px;
            padding: 20px;
        }

        /* Mobile view */
        @media (max-width: 768px) {
            .container {
                grid-template-columns: 1fr;
                /* Stack on top of each other on small screens */
            }

            .client-details,
            .notes-links,
            .note-content,
            .orders-details {
                grid-column: 1 / -1;
                /* Stretch across the full width */
            }
        }

        .client-list {
            grid-column: 1 / 2;
            grid-row: 1 / 2;
            width: 100%;
            /* Full width of the grid column */
        }

        .client-details {
            grid-column: 2 / 3;
            grid-row: 1 / 2;
            width: 100%;
            /* Full width of the grid column */
        }

        .notes-links {
            grid-column: 1 / 2;
            /* Spanning across both columns */
            width: 100%;
            /* Full width */
            display: inline-block;
            /* Side-by-side display */
        }

        .note-content {
            grid-column: 2 / 3;
            /* Spanning across both columns */
            width: 100%;
            /* Full width */
            display: inline-block;
            /* Side-by-side display */
        }

        .orders-details {
            grid-column: 1 / 3;
            width: 100%;
            /* Full width */
            overflow-x: auto;
            /* Enables horizontal scrolling if table is wider than screen */
        }

        .orders-table {
            width: 100%;
            /* Table width is 100% of its container */
            border-collapse: collapse;
            /* Remove space between borders */
            table-layout: fixed;
            /* Fixed table layout */
            background-color: #f8f9fa;
        }

        .orders-table th,
        .orders-table td {
            border: 1px solid #ced4da;
            padding: 8px;
            /* Adjusted padding for a balanced look */
            text-align: center;
            /* Center text horizontally */
            vertical-align: middle;
            /* Center text vertically */
            min-width: 120px;
            /* Minimum width for each cell */
        }

        .client-list,
        .client-details,
        .notes-links,
        .note-content,
        .orders-details {
            border: 2px solid #ced4da;
            padding: 10px;
            border-radius: .25rem;
            background-color: #f8f9fa;
        }

        .client-list div:hover,
        .notes-links div:hover,
        .orders-details li:hover {
            background-color: #007bff;
            cursor: pointer;
        }

        .active {
            background-color: #007bff;
            color: white;
        }

        .note-link {
            padding: 5px;
            margin: 2px;
            display: inline-block;
            background-color: #f0f0f0;
            border-radius: 4px;
            cursor: pointer;
        }

        .note-link:hover {
            background-color: #e0e0e0;
        }

        #clientInput {
            width: 100%;
            height: 50px;
            /* Fixed height as set before */
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #fff;
            /* Set the background color to white */
        }

        .picture-modal-header {
            cursor: move;
            z-index: 10;
            background-color: #2c3e50;
            color: #2c3e50;
            padding: 5px 10px;
            border-top-left-radius: 6px;
            border-top-right-radius: 6px;
            display: flex;
            justify-content: space-between;
            /* Align close button to the right */
        }

        /* The Modal (background) */
        .picture-modal {
            display: none;
            position: fixed;
            /* Updated to fixed for full-screen overlay */
            z-index: 10000;
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: auto;
            height: auto;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0);
            /* Updated to a blueish tint with transparency */
            padding: 20px;
            /* Add some padding around the modal */
        }

        /* Modal Content (image) */
        .picture-modal-content {
            margin: auto;
            display: inline-block;
            /* Allows the modal to only be as wide as the content */
            max-width: 90%;
            /* You can adjust this to allow for some margin */
            height: auto;
            /* Ensure the height is auto to maintain aspect ratio */
        }

        /* Caption of Modal Image */
        #pictureCaption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #007bff;
            padding: 10px 0;
            height: 150px;
        }

        /* The Close Button */
        .picture-close {
            cursor: pointer;
            position: absolute;
            top: 15px;
            right: 35px;
            color: #2c3e50;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .picture-close:hover,
        .picture-close:focus {
            color: #d9534f;
            text-decoration: none;
            cursor: pointer;
        }
    </style>



    <!-- Layout structure -->
    <div class="container">
        <!-- Client list -->
        <input list="clientsDatalist" id="clientInput" name="clientInput" placeholder="Search for a client...">
        <datalist id="clientsDatalist">
            @foreach ($clients as $client)
            <option value="{{ $client->Company_Name }}" data-client-id="{{ $client->Client_ID }}">
                @endforeach
        </datalist>


        <!-- Client Details -->
        <div class="client-details" id="clientDetails">
            <!-- Client information will be loaded here via JavaScript -->
            <p>Select a client to view Information details</p>
        </div>

        <!-- Notes Links -->
        <div class="notes-links" id="notesLinks">
            <p>Select a client to view Older Notes</p>
            <!-- Links to individual notes will be loaded here via JavaScript -->
        </div>

        <!-- Note Content -->
        <div class="note-content" id="clientNote">
            <p>Select a Note to view Note details</p>
            <!-- Selected note content will be displayed here -->
        </div>

        <!-- Picture Modal -->
        <div id="pictureModal" class="picture-modal">
            <div class="picture-modal-header">
                <span class="picture-close">&times;</span>
            </div>
            <img class="picture-modal-content" id="pictureImg">
            <div id="pictureCaption"></div>
        </div>



        <!-- Orders Details -->
        <div class="orders-details" id="ordersDetails">
            <!-- Orders will be loaded here via JavaScript -->
            <div class="table-container">
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Created By</th>
                            <th>Request Date</th>
                            <th>Request Status</th>
                            <th>Order Date</th>
                            <th>Order Status</th>
                            <th>Quotation Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Last 5 orders will be loaded here by JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function displayClientDetails(clientId) {
            // Fetch client details
            fetch(`/get-company-info/${clientId}`)
                .then(response => response.json())
                .then(data => {
                    const detailsDiv = document.getElementById('clientDetails');
                    detailsDiv.innerHTML = `
                        <h3>${data.companyName}</h3>
                        <p><strong>Main Contact:</strong> ${data.mainContact}</p>
                        <p><strong>Email:</strong> ${data.email}</p>
                        <p><strong>Phone:</strong> ${data.phone}</p>
                    `;
                    // Fetch and display the number of notes for the client
                    fetchNotesDetails(clientId);
                })
                .catch(error => console.error('Error:', error));

            fetch(`/clients/${clientId}/notesAJAX`)
                .then(response => response.json())
                .then(notes => {
                    const linksDiv = document.getElementById('notesLinks');
                    linksDiv.innerHTML = ''; // Clear previous links

                    if (notes.length === 0) {
                        // If there are no notes, display a message
                        linksDiv.textContent = 'No notes available for the selected client';
                    } else {
                        // If there are notes, create links for them
                        notes.forEach((note, index) => {
                            const noteLink = document.createElement('div');
                            noteLink.className = 'note-link';
                            noteLink.textContent = note.Title;
                            //noteLink.textContent = `Note ${index + 1}`;
                            noteLink.onclick = () => showNoteContent(note);
                            linksDiv.appendChild(noteLink);
                        });
                    }
                })
                .catch(error => console.error('Error:', error));


            fetch(`/clients/${clientId}/last-orders`)
                .then(response => response.json())
                .then(orders => {
                    const ordersTableBody = document.querySelector('.orders-table tbody'); // Select the tbody within the orders-table
                    if (orders.length > 0) {
                        let tableRowsHtml = ''; // Initialize an empty string to build the rows
                        // Populate the rows with order data
                        orders.forEach(order => {
                            tableRowsHtml += '<tr>';
                            tableRowsHtml += `<td>${order.Order_ID}</td>`;
                            tableRowsHtml += `<td>${order.Created_By}</td>`;
                            tableRowsHtml += `<td>${order.Request_DATE}</td>`;
                            tableRowsHtml += `<td>${order.Request_Status}</td>`;
                            tableRowsHtml += `<td>${order.Order_DATE}</td>`;
                            tableRowsHtml += `<td>${order.Order_Status}</td>`;
                            tableRowsHtml += `<td>${order.Quotation_DATE}</td>`;
                            tableRowsHtml += '</tr>';
                        });
                        ordersTableBody.innerHTML = tableRowsHtml; // Insert the rows into the tbody
                    } else {
                        ordersTableBody.innerHTML = '<tr><td colspan="7">No recent orders available for the selected client</td></tr>'; // Handle no orders
                    }
                })
                .catch(error => console.error('Error:', error));

        }

        document.getElementById('clientInput').addEventListener('focus', function(e) {
    // When the input field is focused, clear its value
    e.target.value = '';
}, true);

document.getElementById('clientInput').addEventListener('input', function(e) {
    var inputVal = e.target.value;
    var dataList = document.getElementById('clientsDatalist').options;
    for (var i = 0; i < dataList.length; i++) {
        if (dataList[i].value === inputVal) {
            displayClientDetails(dataList[i].getAttribute('data-client-id'));
            // Optionally, you might want to clear the input after a delay, giving time for your function to use the input's value
            setTimeout(function() {
                e.target.value = '';
            }, 100);
            break;
        }
    }
});





        function fetchNotesDetails(clientId) {
            fetch(`/clients/${clientId}/notesAJAX`)
                .then(response => response.json())
                .then(notes => {
                    const notesDiv = document.getElementById('notesDetails');
                    notesDiv.innerHTML = `<h3>Notes (${notes.length})</h3>`;
                    notes.forEach(note => {
                        notesDiv.innerHTML += `<div onclick="showNoteContent(${note.id})" class="note-link">Note ${note.id}</div>`;
                    });
                })
                .catch(error => console.error('Error:', error));
        }

        function showNoteContent(note) {
            const contentDiv = document.getElementById('clientNote');
            // Clear previous content
            contentDiv.innerHTML = '';

            // Populate the div with the note content
            contentDiv.innerHTML += `
        <h3>Note Details</h3>
        <p><strong>Title:</strong> ${note.Title}</p>
        <p><strong>Type:</strong> ${note.Interaction_Type}</p>
        <p><strong>Created By:</strong> ${note.Created_By}</p>
        <p><strong>Date Created:</strong> ${new Date(note.Created_At).toLocaleString()}</p>
        <p><strong>Date Updated:</strong> ${new Date(note.Updated_At).toLocaleString()}</p>
        <p><strong>Details:</strong> ${note.Description}</p>
        <div id="imagesContainer"></div>`;

            // Fetch the images for this note
            fetch(`/notes/${note.Note_ID}/images`)
                .then(response => response.json())
                .then(data => {
                    const imagesContainer = document.getElementById('imagesContainer');
                    if (data.success && data.images.length) {
                        data.images.forEach(image => {
                            const link = document.createElement('a');
                            link.href = '#';
                            link.textContent = 'IMG '; // The link text
                            link.onclick = function() {
                                // Open the picture modal instead of the generic modal
                                const pictureModal = document.getElementById('pictureModal');
                                const pictureImg = document.getElementById('pictureImg');
                                const pictureCaption = document.getElementById('pictureCaption');
                                pictureImg.onload = function() {
                                    // This ensures the modal resizes after the image has loaded
                                    pictureModal.style.display = "block";
                                    makeModalDraggable();
                                };
                                pictureImg.src = `data:${image.MIME};base64,${image.data}`;
                                pictureCaption.innerHTML = `Note:${note.Note_ID}`; // Your caption here

                                var span = document.getElementsByClassName("picture-close")[0];
                                span.onclick = function() {
                                    pictureModal.style.display = "none";
                                }
                            }
                            imagesContainer.appendChild(link);
                        });
                    } else {
                        imagesContainer.innerHTML = '<p>No images available for this note.</p>';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    imagesContainer.innerHTML = '<p>Error retrieving images for this note.</p>';
                });
        }

        // Draggable Modal Function
        function makeModalDraggable() {
            var modal = document.getElementById("pictureModal");
            var mousePosition;
            var offset = [0, 0];
            var isDown = false;

            modal.addEventListener('mousedown', function(e) {
                isDown = true;
                offset = [
                    modal.offsetLeft - e.clientX,
                    modal.offsetTop - e.clientY
                ];
            }, true);

            document.addEventListener('mouseup', function() {
                isDown = false;
            }, true);

            document.addEventListener('mousemove', function(event) {
                event.preventDefault();
                if (isDown) {
                    mousePosition = {
                        x: event.clientX,
                        y: event.clientY
                    };
                    modal.style.left = (mousePosition.x + offset[0]) + 'px';
                    modal.style.top = (mousePosition.y + offset[1]) + 'px';
                }
            }, true);
        }
    </script>
</x-layout>