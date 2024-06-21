<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Web Form</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-lg">
        <h2 class="text-2xl font-bold mb-6">Simple Web Form</h2>
        <form action="/submit" method="post">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email:</label>
                <input type="email" id="email" name="email" class="mt-1 p-2 w-full border border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label for="ssn" class="block text-gray-700">SSN:</label>
                <input type="text" id="ssn" name="ssn" class="mt-1 p-2 w-full border border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label for="phone" class="block text-gray-700">Phone Number:</label>
                <input type="tel" id="phone" name="phone" class="mt-1 p-2 w-full border border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label for="firstname" class="block text-gray-700">First Name:</label>
                <input type="text" id="firstname" name="firstname" class="mt-1 p-2 w-full border border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label for="lastname" class="block text-gray-700">Last Name:</label>
                <input type="text" id="lastname" name="lastname" class="mt-1 p-2 w-full border border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label for="dob" class="block text-gray-700">Date of Birth:</label>
                <input type="date" id="dob" name="dob" class="mt-1 p-2 w-full border border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label for="salary" class="block text-gray-700">Salary Monthly Before Tax:</label>
                <input type="number" id="salary" name="salary" class="mt-1 p-2 w-full border border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label for="employmentfrom" class="block text-gray-700">Employment From:</label>
                <input type="date" id="employmentfrom" name="employmentfrom" class="mt-1 p-2 w-full border border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label for="employmentto" class="block text-gray-700">Employment To:</label>
                <input type="date" id="employmentto" name="employmentto" class="mt-1 p-2 w-full border border-gray-300 rounded">
            </div>

            <div class="mb-4 flex items-center">
                <input type="checkbox" id="currentlyworking" name="currentlyworking" class="mr-2">
                <label for="currentlyworking" class="text-gray-700">Currently Working Here</label>
            </div>

            <div>
                <input type="submit" value="Submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700">
            </div>
        </form>
    </div>
</body>
</html>
