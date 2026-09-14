<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Halal LMS</title>
</head>

<body class="bg-gray-100">

    <div class="min-h-screen flex items-center justify-center">

        <div class="bg-white p-8 rounded-xl shadow-lg">

            <h1 class="text-3xl font-bold text-gray-900">
                Halal Certification LMS
            </h1>

            <p class="mt-2 text-gray-600">
                Learning Management System
            </p>

            <a href="{{ route('welcome') }}" class="mt-6 px-4 py-2 bg-blue-600 text-white rounded-lg">
                Mulai Belajar
            </a>

        </div>

    </div>

</body>
</html>