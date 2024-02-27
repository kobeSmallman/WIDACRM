<x-layout>
    <!-- Styles to match the CRM layout -->
    <style>
        .container {
            display: grid;
            grid-template-columns: repeat(2, 1fr); /* Creates two columns */
            grid-gap: 20px;
            padding: 20px;
        }

        /* Mobile view */
        @media (max-width: 768px) {
            .container {
            grid-template-columns: 1fr; /* Stack on top of each other on small screens */
            }

            .client-details,
            .notes-links,
            .note-content,
            .orders-details {
                grid-column: 1 / -1; /* Stretch across the full width */
            }
        }

        .client-list {
            grid-column: 1 / 2;
            grid-row: 1 / 2;
            width: 100%; /* Full width of the grid column */
        }

        .client-details {
            grid-column: 2 / 3;
            grid-row: 1 / 2;
            width: 100%; /* Full width of the grid column */
        }

        .notes-links {
            grid-column: 1 / 2; /* Spanning across both columns */
            width: 100%; /* Full width */
            display: inline-block; /* Side-by-side display */
        }
        .note-content {
            grid-column: 2 / 3; /* Spanning across both columns */
            width: 100%; /* Full width */
            display: inline-block; /* Side-by-side display */
        }

        .orders-details {
            grid-column: 1 / 3;
            width: 100%; /* Full width */
            overflow-x: auto; /* Enables horizontal scrolling if table is wider than screen */
        }

        .orders-table {
            width: 100%; /* Table width is 100% of its container */
            border-collapse: collapse; /* Remove space between borders */
            table-layout: fixed; /* Fixed table layout */
            background-color: #f8f9fa;
        }

        .orders-table th,
        .orders-table td {
            border: 1px solid #ced4da;
            padding: 8px; /* Adjusted padding for a balanced look */
            text-align: center; /* Center text horizontally */
            vertical-align: middle; /* Center text vertically */
            min-width: 120px; /* Minimum width for each cell */
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
    </style>



   <!-- Layout structure -->
   <div class="container">
        <!-- Client list -->
        <div class="client-list">
            @foreach ($clients as $client)
            <div onclick="displayClientDetails('{{ $client->Client_ID }}')">
                {{ $client->Company_Name }}
            </div>
            @endforeach
        </div>

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
        <div class="note-content" id="noteContent">
        <p>Select a Note to view Note details</p>
            <!-- Selected note content will be displayed here -->
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
                    notes.forEach((note, index) => {
                        const noteLink = document.createElement('div');
                        noteLink.className = 'note-link';
                        noteLink.textContent = `Note ${index + 1}`;
                        noteLink.onclick = () => showNoteContent(note);
                        linksDiv.appendChild(noteLink);
                    });
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
            const contentDiv = document.getElementById('noteContent');
            // Populate the div with the note content
            contentDiv.innerHTML = `
                <h3>Note Details</h3>
                <p><strong>Type:</strong> ${note.Interaction_Type}</p>
                <p><strong>Created By:</strong> ${note.Created_By}</p>
                <p><strong>Date:</strong> ${note.Date_Time}</p>
                <p>${note.Description}</p>
            `;
        }
    </script>
</x-layout>
