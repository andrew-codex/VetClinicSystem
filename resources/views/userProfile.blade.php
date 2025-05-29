<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>User Profile</title>
  <script src="https://cdn.tailwindcss.com"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">


  <nav class="bg-blue-600 text-white px-6 py-4 shadow">
    <div class="container mx-auto flex justify-between items-center">
      <h1 class="text-xl font-bold">Profile</h1>
      <div class="flex items-center space-x-6">
        <a href="{{ route('userDashboard') }}" class="hover:text-black">Home</a>
        <a href="{{ route('logout') }}" class="hover:text-black">Logout</a>
      </div>
    </div>
  </nav>


  <main class="flex-grow flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-lg p-6 w-full max-w-md">
      <div class="flex flex-col items-center text-center">
        
        <p class="text-lg font-semibold">{{ $customer->name }}</p>
        <p class="text-gray-500 text-sm">{{ $customer->email }}</p>
      </div>

      <div class="mt-6">
        <h3 class="text-lg font-medium text-gray-800">Profile Details</h3>
        <div class="mt-4 space-y-2 text-sm text-gray-700">
          <p><span class="font-semibold">Phone:</span> {{ $customer->phone }}</p>
          <p><span class="font-semibold">Address:</span> {{ $customer->address }}</p>
        </div>
      </div>

      <div class="mt-6 flex justify-center">
  <button onclick="openEditModal()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition">
    Edit Profile
  </button>
</div>
    </div>
  </main>


<div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
  <form action="{{ route('userProfile.update', $customer->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="bg-white p-6 rounded-lg shadow-xl w-full max-w-md">
      <h1 class="text-xl font-bold mb-4">Edit Profile</h1>

      <input type="text" name="name" value="{{ $customer->name }}" placeholder="Edit Name" class="border rounded px-3 py-2 w-full mb-4" />
      <input type="text" name="email" value="{{ $customer->email }}" placeholder="Edit Email" class="border rounded px-3 py-2 w-full mb-4" />
      <input type="text" name="phone" value="{{ $customer->phone }}" placeholder="Edit Phone" class="border rounded px-3 py-2 w-full mb-4" />
      <input type="text" name="address" value="{{ $customer->address }}" placeholder="Edit Address" class="border rounded px-3 py-2 w-full mb-4" />

      <div class="flex justify-between mt-4">
        <button type="button" onclick="closeEditModal()" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Close</button>
        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Save</button>
      </div>
    </div>
  </form>
</div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const editModal = document.getElementById('openEditModal');

  
      function openEditModal() {
        editModal.classList.remove('hidden');
        editModal.classList.add('flex');
      }

      
      const editButton = document.querySelector('editProfileButton');
      if (editButton) {
        editButton.addEventListener('click', openEditModal);
      }
    });
  </script>

<script>
  function openEditModal() {
    const modal = document.getElementById('editModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
  }

  function closeEditModal() {
    const modal = document.getElementById('editModal');
    modal.classList.remove('flex');
    modal.classList.add('hidden');
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
