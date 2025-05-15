<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>VetCare - Veterinary Clinic System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-gray-50 text-gray-800 font-sans">

 
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-blue-600">VetCare</h1>
            <nav class="space-x-6">
                <a href="#features" class="text-gray-700 hover:text-blue-600">Features</a>
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600">Login</a>
                <a href="{{ route('register.form') }}" class="text-gray-700 hover:text-blue-600">Sign Up</a>
            </nav>
        </div>
    </header>

    
    <section class="text-center py-24 bg-gradient-to-br from-blue-100 via-white to-blue-50">
        <div class="max-w-3xl mx-auto px-4">
            <h2 class="text-4xl font-extrabold mb-4 text-blue-800">LJ Veterinary Clinic System</h2>
            <p class="text-lg text-gray-700 mb-6">Manage appointments, pets, medical records, and POS in one place.</p>
            <a href="#login" class="bg-blue-600 text-white px-6 py-3 rounded-lg text-lg hover:bg-blue-700 transition">Login Now</a>
        </div>
    </section>

   
    <section id="features" class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-4 grid md:grid-cols-3 gap-10 text-center">
            <div>
                <h3 class="text-xl font-semibold text-blue-700 mb-2">Appointments</h3>
                <p class="text-gray-600">Schedule vet visits and receive reminders automatically.</p>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-blue-700 mb-2">Medical Records</h3>
                <p class="text-gray-600">Track and manage pet histories securely.</p>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-blue-700 mb-2">Inventory & POS</h3>
                <p class="text-gray-600">Point-of-sale transactions.</p>
            </div>
        </div>
    </section>

 
    <section id="login" class="py-20 bg-blue-50">
        <div class="max-w-xl mx-auto text-center">
            <h3 class="text-2xl font-bold text-blue-800 mb-6">Login As</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="{{ url('admin/login') }}" class="bg-white shadow hover:shadow-lg p-6 rounded-lg border hover:border-blue-600 transition">
                    <h4 class="text-xl font-semibold text-blue-700 mb-2">Admin</h4>
                    <p class="text-gray-600 text-sm">Full system access and reports.</p>
                </a>
                <a href="{{ url('vet/login') }}" class="bg-white shadow hover:shadow-lg p-6 rounded-lg border hover:border-blue-600 transition">
                    <h4 class="text-xl font-semibold text-blue-700 mb-2">Vet</h4>
                    <p class="text-gray-600 text-sm">Manage appointments and medical records.</p>
                </a>
                <a href="{{ route('login') }}" class="bg-white shadow hover:shadow-lg p-6 rounded-lg border hover:border-blue-600 transition">
                    <h4 class="text-xl font-semibold text-blue-700 mb-2">Pet Owner</h4>
                    <p class="text-gray-600 text-sm">View pet records and book appointments.</p>
                </a>
            </div>
        </div>
    </section>

  
    <footer class="bg-white py-6 text-center text-gray-500 text-sm">
        &copy; {{ now()->year }} VetCare System. All rights reserved.
    </footer>



    
    
  

</body>
</html>
