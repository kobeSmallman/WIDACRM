{{-- resources/views/dashboard/admin.blade.php --}}
<x-layout>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="{{ asset('css/dashboardAdmin.css') }}">

    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Welcome to the Admin Dashboard, you might find some information relevant to admins here!</h1>

    <h2>NOTHING!</h2>
    <table>
        <thead>
            <tr>
                <th>Client Name</th>
                <th>Employees Interacted</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clients as $client)
                <tr>
                    <td>{{ $client->Company_Name }}</td>
                    <td>
                        @php
                            $notesCount = [];
                        @endphp
                        @foreach ($client->notes as $note)
                            @php
                                $employeeName = $note->employee->First_Name . ' ' . $note->employee->Last_Name;
                                if (!isset($notesCount[$employeeName])) {
                                    $notesCount[$employeeName] = 0;
                                }
                                $notesCount[$employeeName]++;
                            @endphp
                        @endforeach
                        @foreach ($notesCount as $employeeName => $count)
                            {{ $employeeName }}: {{ $count }} Notes Taken<br>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('clients.show', $client->Client_ID) }}">View Notes</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
</x-layout>