<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Pets</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100">

<nav class="bg-blue-600 text-white px-6 py-4 shadow">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">My pets</h1>
            <div class="flex items-center space-x-6">
                
        
               

        
                <a href="#" class="hover:text-black">Profile</a>
                <a href="{{ route('userDashboard') }}" class="hover:text-black">Home</a>
                <a href="{{ route('logout') }}" class="hover:text-black">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
      

        <div class="mb-4">
            <button onclick="toggleModal()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                + Add New Pet
            </button>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full table-auto">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left">Name</th>
                           <th class="px-4 py-3 text-left">Species</th>
                        <th class="px-4 py-3 text-left">Medical History</th>
                        <th class="px-4 py-3 text-left">Breed</th>
                        <th class="px-4 py-3 text-left">Age</th>
                        <th class="px-4 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pets as $pet)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-4">{{ $pet->pet_name }}</td>
                                <td class="px-4 py-4">{{ $pet->species}}</td>
                            <td class="px-4 py-4">{{ $pet->medical_history }}</td>
                            <td class="px-4 py-4">{{ $pet->breed }}</td>
                            <td class="px-4 py-4">{{ $pet->age }}</td>
                       
                            <td class="px-6 py-4 space-x-2">
                                <button onclick="openEditModal()" class="text-blue-500 hover:underline">Edit</button>

                                <form action="{{ route('pet.destroy', $pet->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center px-6 py-4 text-gray-500">No pets found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>


    <div id="petModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-xl font-bold mb-4">Add a New Pet</h2>

            <form action="{{ route('pet.create') }}" method="POST">
                @csrf

                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 border border-red-400 p-4 rounded mb-4">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Pet Name</label>
                    <input type="text" name="pet_name" id="name" class="mt-1 block w-full px-4 py-2 border rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="species" class="block text-gray-700">Species</label>
                    <input type="text" name="species" id="species" class="mt-1 block w-full px-4 py-2 border rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="medical_history" class="block text-gray-700">Medical History</label>
                    <input type="text" name="medical_history" id="medical_history" class="mt-1 block w-full px-4 py-2 border rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="breed" class="block text-gray-700">Breed</label>
                    <input type="text" name="breed" id="breed" class="mt-1 block w-full px-4 py-2 border rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="age" class="block text-gray-700">Age</label>
                    <input type="number" name="age" id="age" class="mt-1 block w-full px-4 py-2 border rounded-md" required>
                </div>

                <div class="flex justify-end">
                    <button type="button" onclick="toggleModal()" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Cancel</button>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Add Pet</button>
                </div>
            </form>
        </div>
    </div>


    <div id="editPetModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white p-6 rounded-lg w-96">
            <h2 class="text-xl font-bold mb-4">Edit Pet</h2>

            @foreach($pets as $pet)
        <form method="POST" action="{{ route('pet.update', ['pet' => $pet->id]) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
                    <label for="editName" class="block text-gray-700" >Name</label>
                    <input type="text" id="editName" name="pet_name" value="{{ $pet->pet_name }}" class="mt-1 block w-full px-4 py-2 border rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="editSpecies" class="block text-gray-700" >Species</label>
                    <input type="text" id="editSpecies" name="species" value="{{ $pet->species }}" class="mt-1 block w-full px-4 py-2 border rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="editBreed" class="block text-gray-700">Breed</label>
                    <input type="text" id="editBreed" name="breed" value="{{ $pet->breed}}"class="mt-1 block w-full px-4 py-2 border rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="editMedicalHistory" class="block text-gray-700">Medical History</label>
                    <input type="text" id="editMedicalHistory" name="medical_history" value="{{ $pet->medical_history}}" class="mt-1 block w-full px-4 py-2 border rounded-md" required>

                <div class="mb-4">
                    <label for="editAge" class="block text-gray-700">Age</label>
                    <input type="number" id="editAge" name="age" value="{{ $pet->age}}" class="mt-1 block w-full px-4 py-2 border rounded-md" required>
                </div>

                <div class="flex justify-end">
                    <button type="button" id="closeEditModal" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Cancel</button>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Pet</button>
                </div>
       
    </form>
@endforeach
        </div>
        </div>


     

    <script>
        function toggleModal() {
            const modal = document.getElementById("petModal");
            modal.classList.toggle("hidden");
        }

        function openEditModal() {
            const modal = document.getElementById("editPetModal");
            modal.classList.remove("hidden");
        }
        document.getElementById("closeEditModal").addEventListener("click", function() {
            const modal = document.getElementById("editPetModal");
            modal.classList.add("hidden");
        });
    </script>

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
