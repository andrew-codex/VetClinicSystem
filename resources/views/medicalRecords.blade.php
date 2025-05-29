<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Records</title>
       <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <nav class="bg-blue-600 text-white px-6 py-4 shadow">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-xl font-bold">Profile</h1>
        <div class="flex items-center space-x-6">
            <a href="{{ route('userDashboard') }}" class="hover:text-black">Home</a>
            <a href="{{ route('logout') }}" class="hover:text-black"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
               Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </div>
</nav>

<div class="container mx-auto py-8 px-4">
    <h2 class="text-2xl font-semibold mb-6">Medical Records</h2>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow rounded-lg overflow-hidden">
            <thead class="bg-gray-100 text-left text-sm font-semibold text-gray-700">
                <tr>
                    <th class="px-4 py-3">Pet Name</th>
                    <th class="px-4 py-3">Owner Name</th>
                    <th class="px-4 py-3">Visit Date</th>
                    <th class="px-4 py-3">Diagnosis</th>
                    <th class="px-4 py-3">Treatment</th>
                    <th class="px-4 py-3">Prescription</th>
                    <th class="px-4 py-3">Notes</th>
                    <th class="px-4 py-3">Next Visit</th>
                    <th class="px-4 py-3">Status</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-800 divide-y divide-gray-200">
                @foreach ($medicalRecords as $record)
                    <tr>
                        <td class="px-4 py-3">{{ $record->pet->pet_name ?? 'N/A' }}</td>
                        <td class="px-4 py-3">{{ $record->Owner_name }}</td>
                        <td class="px-4 py-3">{{ \Carbon\Carbon::parse($record->visit_date)->format('Y-m-d') }}</td>
                        <td class="px-4 py-3">{{ $record->diagnosis }}</td>
                        <td class="px-4 py-3">{{ $record->treatment }}</td>
                        <td class="px-4 py-3">{{ $record->prescription }}</td>
                        <td class="px-4 py-3">{{ $record->notes }}</td>
                        <td class="px-4 py-3">{{ \Carbon\Carbon::parse($record->next_visit_date)->format('Y-m-d') }}</td>
                        <td class="px-4 py-3">
                            @if ($record->status === 'Completed')
                                <span class="px-2 py-1 text-xs font-semibold bg-green-200 text-green-800 rounded-full">Completed</span>
                            @elseif ($record->status === 'Follow-Up')
                                <span class="px-2 py-1 text-xs font-semibold bg-yellow-200 text-yellow-800 rounded-full">Follow-Up</span>
                            @else
                                <span class="px-2 py-1 text-xs font-semibold bg-gray-200 text-gray-800 rounded-full">Pending</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>