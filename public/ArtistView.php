<?php 

    

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artist Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Sidebar -->
    <div class="flex flex-col md:flex-row h-full">
        <nav class="bg-indigo-700 text-white w-full md:w-1/4 lg:w-1/5 p-5">
            <h2 class="text-3xl font-bold mb-8">Artist Dashboard</h2>
            <ul class="space-y-4">
                <li><a href="#upload" class="block hover:bg-indigo-500 p-3 rounded-lg">Upload Artwork</a></li>
                <li><a href="#status" class="block hover:bg-indigo-500 p-3 rounded-lg">Artwork Status</a></li>
                <li><a href="#inquiries" class="block hover:bg-indigo-500 p-3 rounded-lg">Inquiries</a></li>
                <li><a href="#profile" class="block hover:bg-indigo-500 p-3 rounded-lg">Profile</a></li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="flex-1 p-6 space-y-10">
            <!-- Upload Artwork Section -->
            <section id="upload" class="bg-white shadow rounded-lg p-6">
                <h3 class="text-2xl font-bold mb-4 text-indigo-700">Upload Artwork</h3>
                <form class="space-y-4">
                    <input type="text" placeholder="Title of the Artwork" class="w-full border rounded p-3 mb-4 focus:outline-none focus:ring-2 focus:ring-indigo-300">
                    
                    <textarea placeholder="Description" class="w-full border rounded p-3 mb-4 focus:outline-none focus:ring-2 focus:ring-indigo-300"></textarea>

                    <select class="w-full border rounded p-3 mb-4 focus:outline-none focus:ring-2 focus:ring-indigo-300">
                        <option>Select Art Form</option>
                        <option>Painting</option>
                        <option>Sculpture</option>
                        <option>Digital Art</option>
                        <!-- Add other art forms as needed -->
                    </select>

                    <input type="file" class="w-full border rounded p-3 mb-4 cursor-pointer focus:outline-none">
                    <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-800 transition">Submit Artwork</button>
                </form>
            </section>

            <!-- Artwork Status Section -->
            <section id="status" class="bg-white shadow rounded-lg p-6">
                <h3 class="text-2xl font-bold mb-4 text-indigo-700">Artwork Status</h3>
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="p-3 border-b">Title</th>
                            <th class="p-3 border-b">Art Form</th>
                            <th class="p-3 border-b">Status</th>
                            <th class="p-3 border-b">Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example row -->
                        <tr>
                            <td class="p-3 border-b">Sunset Painting</td>
                            <td class="p-3 border-b">Painting</td>
                            <td class="p-3 border-b text-yellow-500">Pending</td>
                            <td class="p-3 border-b">N/A</td>
                        </tr>
                        <!-- More rows dynamically added as necessary -->
                    </tbody>
                </table>
            </section>

            <!-- Inquiries Section -->
            <section id="inquiries" class="bg-white shadow rounded-lg p-6">
                <h3 class="text-2xl font-bold mb-4 text-indigo-700">Inquiries</h3>
                <ul class="space-y-4">
                    <!-- Example Inquiry -->
                    <li class="p-4 bg-gray-50 rounded-lg shadow">
                        <h4 class="font-bold text-lg">Client Inquiry</h4>
                        <p>Interested in "Sunset Painting".</p>
                        <p class="text-sm text-gray-500">Status: Under Review</p>
                    </li>
                    <!-- More inquiries as needed -->
                </ul>
            </section>

            <!-- Profile Section -->
            <section id="profile" class="bg-white shadow rounded-lg p-6">
                <h3 class="text-2xl font-bold mb-4 text-indigo-700">Profile</h3>
                <p class="text-lg">Welcome back, <strong>Artist Name</strong>!</p>
                <p class="text-gray-600">This is your personal dashboard. You can view, manage, and submit your artworks here.</p>
            </section>
        </main>
    </div>

</body>
</html>