<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <style>
      
        .dropdown:hover .dropdown-menu {
            display: block;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">
   
    <nav class="bg-blue-600 text-white px-6 py-4 shadow">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">Dashboard</h1>
            <div class="flex items-center space-x-6">

               
             
                <div class="relative dropdown">
                    <button class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hover:text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V4a2 2 0 10-4 0v1.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span class="absolute top-0 right-0 inline-block w-2 h-2 bg-red-600 rounded-full"></span>
                    </button>
                
                    <div class="dropdown-menu hidden absolute right-0 mt-2 w-64 bg-white text-black rounded-lg shadow-lg z-50">
                        <div class="p-4 border-b font-semibold">Notifications</div>
                        <ul class="max-h-64 overflow-y-auto">
                            @forelse($appointments as $appointment)
                                <li class="px-4 py-2 hover:bg-gray-100 border-b">
                                    <div class="font-semibold">{{ $appointment->customer->name }}</div>
                                    <div class="text-gray-500">has an appointment for <strong>{{ $appointment->pet->name }}</strong> on {{ $appointment->appointment_date }}.</div>
                                    <div class="text-xs text-gray-400">Status: {{ $appointment->status }}</div>
                                </li>
                            @empty
                                <li class="px-4 py-2 hover:bg-gray-100 border-b">No new appointments.</li>
                            @endforelse
                        </ul>
                        <div class="text-center p-2 border-t">
                            <a href="{{ route('appointment') }}" class="text-blue-500 hover:underline text-sm">View all</a>
                        </div>
                    </div>
                </div>

              
                <a href="{{ route('userProfile') }}" class="hover:text-black">Profile</a>
                <a href="{{ route('logout') }}" class="hover:text-black ">Logout</a>
            </div>
        </div>
    </nav>

    
    <main class="container mx-auto mt-8 px-4">
        <div class="bg-white p-6 rounded-lg shadow-md">
            @php
                $user = Auth::guard('customer')->user(); 
            @endphp

            <h2 class="text-2xl font-semibold mb-4">
                Welcome, {{ $user ? $user->name : 'Guest' }}!
            </h2>

            <p class="mb-4">Here's a quick overview of your account.</p>

        
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
               
                <a href="{{ route('petPage') }}" class="p-4 bg-blue-100 rounded shadow hover:bg-blue-200 transition">
                    <h3 class="font-bold text-lg">Pet</h3>
                    <p class="text-2xl">{{ $pets->count() }}</p>
                </a>

             
                <a href="{{ route('appointment') }}" class="p-4 bg-yellow-100 rounded shadow hover:bg-yellow-200 transition">
                    <h3 class="font-bold text-lg">Appointment</h3>
                    <p class="text-2xl">{{ $appointments->count() }}</p>
                </a>

              
                <a href="{{ route('medicalRecords') }}" class="p-4 bg-yellow-100 rounded shadow hover:bg-yellow-200 transition">
                    <h3 class="font-bold text-lg">Medical Records</h3>
                    <p class="text-2xl">{{ $medicalRecords->count() }}</p>
                </a>
            </div>
        </div>
    </main>

    <script>
       
        const dropdownButton = document.querySelector('button');
        const dropdownMenu = document.querySelector('.dropdown-menu');

        dropdownButton.addEventListener('click', () => {
            dropdownMenu.classList.toggle('hidden');
        });

       
        document.addEventListener('click', (event) => {
            if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
