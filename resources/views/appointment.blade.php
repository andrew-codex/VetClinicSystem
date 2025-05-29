<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<nav class="bg-blue-600 text-white px-6 py-4 shadow">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">Appointment</h1>
            <div class="flex items-center space-x-6">
                
        
                

        
                <a href="{{ route('userProfile') }}" class="hover:text-black">Profile</a>
                <a href="{{ route('userDashboard') }}" class="hover:text-black">Home</a>
                <a href="{{ route('logout') }}" class="hover:text-black">Logout</a>
            </div>
        </div>
    </nav>


    <div class="container mx-auto px-4 py-8">
      

      <div class="mb-4">
          <button onclick="toggleModal()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
              + Book an Appointment
          </button>
      </div>

      <div class="bg-white shadow-md rounded-lg overflow-hidden">
          <table class="min-w-full table-auto">
              <thead class="bg-blue-600 text-white">
                  <tr>
                      <th class="px-4 py-3 text-left">Pet Name</th>
                      <th class="px-4 py-3 text-left">Breed</th>
                      <th class="px-4 py-3 text-left">Species</th>
                      <th class="px-4 py-3 text-left">Age</th>
                      <th class="px-4 py-3 text-left">Vet Name</th>
                      <th class="px-4 py-3 text-left">Appointment Date</th>
                      <th class="px-4 py-3 text-left">Notes</th>
                          <th class="px-4 py-3 text-left">Status</th>
                      <th class="px-4 py-3 text-left">Actions</th>
                  </tr>
              </thead>
              <tbody>
                  @forelse ($appointments as $appointment)
                      <tr class="border-b hover:bg-gray-50">
                          <td class="px-4 py-4">{{ $appointment->pet->pet_name }}</td>
                          <td class="px-4 py-4">{{ $appointment->pet->breed }}</td>
                          <td class="px-4 py-4">{{ $appointment->pet->species }}</td>
                          <td class="px-4 py-4">{{ $appointment->pet->age}}</td>
                          <td class="px-4 py-4">{{ $appointment->vet->name }}</td>
                          <td class="px-4 py-4">{{ $appointment->appointment_date }}</td>
                          <td class="px-4 py-4">{{ $appointment->notes }}</td>
                            <td class="px-4 py-4">{{ $appointment->status }}</td>
   <td class="px-6 py-4 space-x-2">
    @if($appointment->status === 'Pending')
        <a href="{{ route('editAppointment', $appointment->id) }}" class="text-blue-600 hover:underline">
            Edit
        </a>
        <form action="{{ route('appointment.destroy', $appointment->id) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure?')">
                Delete
            </button>
        </form>
    @elseif($appointment->status === 'Canceled')
        <span class="text-gray-400">Edit/Delete disabled (Vet canceled appointment)</span>
    @else
        <span class="text-gray-400">Edit/Delete disabled (Status: {{ $appointment->status }})</span>
    @endif
</td>


                      </tr>
                  @empty
                      <tr>
                          <td colspan="4" class="text-center px-6 py-4 text-gray-500">No appointments found.</td>
                      </tr>
                  @endforelse
              </tbody>
          </table>
      </div>
  </div>




  



    <div id="toggleModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden z-50 transition-opacity duration-300">
            <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                <h2 class="text-xl font-bold mb-4">Book an Appointment</h2>
    
                <form action="{{ route('appointment.create') }}" method="POST">
                    @csrf
                    @method('POST')
    
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
                        <label for="pet_id" class="block text-gray-700">Select Pet</label>
                        <select name="pet_id" id="pet_id" class="mt-1 block w-full px-4 py-2 border rounded-md" required>
                            @foreach ($pets as $pet)
                                <option value="{{ $pet->id }}">{{ $pet->pet_name }}</option>
                            @endforeach
                        </select>
                    </div>

                      <div>
                        <label class="block text-gray-700">Breed</label>
                        <div class="mt-1 block w-full px-4 py-2 border rounded-md bg-gray-100">{{ $pet->breed }}</div>
                    </div>

                         <div>
                        <label class="block text-gray-700">Species</label>
                        <div class="mt-1 block w-full px-4 py-2 border rounded-md bg-gray-100">{{ $pet->species }}</div>
                    </div>
    
                    <div class="mb-4">
                        <label for="vet_id" class="block text-gray-700">Select Vet</label>
                        <select name="vet_id" id="vet_id" class="mt-1 block w-full px-4 py-2 border rounded-md" required>
                            @foreach ($vets as $vet)
                                <option value="{{ $vet->id }}">{{ $vet->name }}</option>
                            @endforeach
                        </select>
    
                    <div class="mb-4">
                        <label for="notes" class="block text-gray-700">Notes</label>
                        <input type="text" name="notes" id="notes" class="mt-1 block w-full px-4 py-2 border rounded-md" required>
                    </div>
    
                    <div class="mb-4">
                        <label for="appointment_date" class="block text-gray-700">Appointment Date</label>
                        <input type="datetime-local" name="appointment_date" id="appointment_date" class="mt-1 block
                            w-full px-4 py-2 border rounded-md" required>
                    </div>

                    <div class="flex justify-end">
                    <button type="button" onclick="toggleModal()" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Cancel</button>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save</button>
                </div>
            </form>
        </div>

    </div>





  
  






    
    <script>
      function toggleModal() {
        const addModal = document.getElementById("toggleModal");
        addModal.classList.toggle("hidden");
      }

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