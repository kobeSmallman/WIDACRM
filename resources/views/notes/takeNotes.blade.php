<x-layout>
    <!-- Styles to match the CRM layout -->
    <style>
        .container {
            display: grid;
            grid-template-columns: 1fr 3fr;
            grid-template-rows: auto auto 1fr; /* Added rows for notes and orders */
            gap: 20px;
            padding: 20px;
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
            background-color: #e9ecef;
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
        .orders-table {
            width: 100%;
            border-collapse: collapse;
        }
        .orders-table th,
        .orders-table td {
            border: 1px solid #ced4da;
            padding: 8px;
            text-align: left;
        }
        .orders-table th {
            background-color: #f8f9fa;
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
            <p>Select a client to view details</p>
        </div>

        <!-- Notes Links -->
        <div class="notes-links" id="notesLinks">
            <!-- Links to individual notes will be loaded here via JavaScript -->
        </div>

        <!-- Note Content -->
        <div class="note-content" id="noteContent">
            <!-- Selected note content will be displayed here -->
        </div>

        <!-- Orders Details -->
        <div class="orders-details" id="ordersDetails">
            <!-- Orders will be loaded here via JavaScript -->
            <table class="orders-table">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Last 5 orders will be loaded here -->
                </tbody>
            </table>
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
            const ordersDiv = document.getElementById('ordersDetails');
            if (orders.length > 0) {
                // Create the table structure
                let tableHtml = '<h3>Last 5 Orders</h3>';
                tableHtml += '<table>';
                tableHtml += '<tr>';
                tableHtml += '<th>Order ID</th>';
                tableHtml += '<th>Created By</th>';
                tableHtml += '<th>Request Date</th>';
                tableHtml += '<th>Request Status</th>';
                tableHtml += '<th>Order Date</th>';
                tableHtml += '<th>Order Status</th>';
                tableHtml += '<th>Quotation Date</th>';
                tableHtml += '</tr>';
                // Populate the table with order data
                orders.forEach(order => {
                    tableHtml += '<tr>';
                    tableHtml += `<td>${order.Order_ID}</td>`;
                    tableHtml += `<td>${order.Created_By}</td>`;
                    tableHtml += `<td>${order.Request_DATE}</td>`;
                    tableHtml += `<td>${order.Request_Status}</td>`;
                    tableHtml += `<td>${order.Order_DATE}</td>`;
                    tableHtml += `<td>${order.Order_Status}</td>`;
                    tableHtml += `<td>${order.Quotation_DATE}</td>`;
                    tableHtml += '</tr>';
                });
                tableHtml += '</table>';
                ordersDiv.innerHTML = tableHtml;
            } else {
                ordersDiv.innerHTML = '<p>No recent orders available for the selected client</p>';
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
