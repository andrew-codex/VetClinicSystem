<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

  <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
    @if ($errors->any())
      <div class="bg-red-100 text-red-700 border border-red-400 p-4 rounded mb-4">
        <ul class="list-disc list-inside">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form id="registerForm" action="{{ route('register.customer') }}" method="POST" onsubmit="return validateForm()">
      @csrf
      <h3 class="text-2xl font-bold text-center text-gray-800 mb-6">Customer Information</h3>

      <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
        <input type="text" name="name" id="name" required
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
      </div>

      <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" name="email" id="email" required
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
      </div>

      <div class="mb-4">
        <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
        <input type="number" name="phone" id="phone" required
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
      </div>

      <div class="mb-4">
        <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
        <input type="text" name="address" id="address" required
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
      </div>

      <div class="mb-4">
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" name="password" id="password" required
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
        <div class="mt-1">
          <input type="checkbox" id="showPassword" class="mr-1">
          <label for="showPassword" class="text-sm text-gray-600">Show Password</label>
        </div>
      </div>

      <button type="submit"
              class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-300">
        Register
      </button>

      <div class="text-center mt-4">
        <p class="text-sm text-gray-600">
          Already have an account?
          <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login here</a>
        </p>
      </div>
    </form>
  </div>




  <script>

    document.getElementById('showPassword').addEventListener('change', function () {
      const passwordInput = document.getElementById('password');
      passwordInput.type = this.checked ? 'text' : 'password';
    });

 
    function validateForm() {
      const password = document.getElementById('password').value;
      if (password.length < 6) {
        alert("Password must be at least 6 characters.");
        return false;
      }
      return true;
    }
  </script>

</body>
</html>




