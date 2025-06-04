<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <nav class="bg-blue-600 text-white px-6 py-4 shadow">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">Edit Appointment</h1>
            <div class="flex items-center space-x-6">
                
        
              

        
              
                <a href="{{ route('appointment') }}" class="hover:text-black">Appointment</a>
                <a href="{{ route('logout') }}" class="hover:text-black">Logout</a>
            </div>
        </div>
    </nav>



    <div class="max-w-lg mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Edit Appointment</h2>

    <form action="{{ route('appointment.update', $appointment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="pet_id" class="block text-gray-700">Pet</label>
            <select name="pet_id" id="pet_id" class="w-full px-4 py-2 border rounded">
                @foreach($pets as $pet)
                    <option value="{{ $pet->id }}" {{ $pet->id == $appointment->pet_id ? 'selected' : '' }}>
                        {{ $pet->pet_name }}
                    </option>
                @endforeach
            
            
            </select>
        </div>

        <div class="mb-4">
            <label for="vet_id" class="block text-gray-700">Vet</label>
            <select name="vet_id" id="vet_id" class="w-full px-4 py-2 border rounded">
                @foreach($vets as $vet)
                    <option value="{{ $vet->id }}" {{ $vet->id == $appointment->vet_id ? 'selected' : '' }}>
                        {{ $vet->name }}
                    </option>
                @endforeach
        </select>
        </div>

        <div class="mb-4">
            <label for="notes" class="block text-gray-700">Notes</label>
        <input type="text" name="notes" id="notes" value="{{ $appointment->notes }}" class="w-full px-4 py-2 border rounded">
        </div>

        
        <div class="mb-4">
        <label for="species" class="block text-gray-700">Species</label>
            <input type="text" name="species" id="species" value="{{ $appointment->pet->species }}" class="w-full px-4 py-2 border rounded">
        </div>

        <div class="mb-4">
            <label for="appointment_date" class="block text-gray-700">Appointment Date</label>
            <input type="datetime-local" name="appointment_date" id="appointment_date" value="{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('Y-m-d\TH:i') }}" class="w-full px-4 py-2 border rounded">
        </div>

        <div class="flex justify-end">
            <a href="{{ route('appointment.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Cancel</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        </div>
    </form>
</div>

@if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session('success') }}",
                timer: 3000,
                showConfirmButton: false
            });
        </script>
    @endif
</body>
</html>