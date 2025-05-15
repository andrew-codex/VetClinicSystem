<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex justify-center items-center min-h-screen bg-white-500">
        <div class="bg-white p-8 rounded-lg shadow-lg w-96">
        <div class="mb-4">
    <a href="{{ route('home') }}" class="flex items-center text-sm text-blue-600 hover:underline">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
        </svg>
        Back to Home
    </a>
</div>
            <h2 class="text-2xl font-semibold text-center mb-6">Login</h2>

  
            <form action="{{ route('login.customer') }}" method="POST">

            @csrf
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <div class="mt-1">
          <input type="checkbox" id="showPassword" class="mr-1">
          <label for="showPassword" class="text-sm text-gray-600">Show Password</label>
        </div>
                </div>
                <div class="flex justify-between items-center">
                    <button type="submit" class="w-full px-6 py-2 bg-blue-600 text-white rounded-lg">Login</button>
                </div>
                <div class="text-center">
        <p class="text-sm text-gray-600">
            Don't have an account?
            <a href="{{ route('register.form') }}" class="text-blue-600 hover:underline">Register here</a>
        </p>
    </div>
            </form>
        </div>
    </div>

    <script>   
    document.getElementById('showPassword').addEventListener('change', function () {
      const passwordInput = document.getElementById('password');
      passwordInput.type = this.checked ? 'text' : 'password';
    });
</script>
</body>
</html>
