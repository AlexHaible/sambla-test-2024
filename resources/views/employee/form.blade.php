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
        <form id="employeeForm">
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
                <label for="firstName" class="block text-gray-700">First Name:</label>
                <input type="text" id="firstName" name="firstName" class="mt-1 p-2 w-full border border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label for="lastName" class="block text-gray-700">Last Name:</label>
                <input type="text" id="lastName" name="lastName" class="mt-1 p-2 w-full border border-gray-300 rounded" required>
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
                <label for="employmentFrom" class="block text-gray-700">Employment From:</label>
                <input type="date" id="employmentFrom" name="employmentFrom" class="mt-1 p-2 w-full border border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label for="employmentTo" class="block text-gray-700">Employment To:</label>
                <input type="date" id="employmentTo" name="employmentTo" class="mt-1 p-2 w-full border border-gray-300 rounded">
            </div>

            <div class="mb-4 flex items-center">
                <input type="checkbox" id="currentlyWorking" name="currentlyWorking" class="mr-2">
                <label for="currentlyWorking" class="text-gray-700">Currently Working Here</label>
            </div>

            <div>
                <input type="submit" value="Submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700">
            </div>
        </form>
    </div>
    <script>
        document.getElementById('employeeForm').addEventListener('submit', async function (e) {
            e.preventDefault();

            const formData = new FormData(this);
            const formObject = {};
            formData.forEach((value, key) => formObject[key] = value);

            if (formObject.currentlyWorking) {
                formObject.currentlyWorking = true;
            } else {
                formObject.currentlyWorking = false;
            }

            try {
                const response = await fetch('/api/employees', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify(formObject)
                });

                if (response.ok) {
                    alert('Employee added successfully');
                    document.location.href = '/';
                } else {
                    const errorData = await response.json();
                    alert('Error: ' + errorData.message);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred');
            }
        });
    </script>
</body>
</html>
