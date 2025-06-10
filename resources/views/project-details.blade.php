<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $projectData['title'] ?? 'Our Project' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">
    <!-- Navigation Bar -->
    <nav class="bg-gray-50 text-gray-700 py-3 shadow-sm">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Logo -->
            <img src="{{ asset('public/images/BSYLogo.png') }}" alt="Batang Surigaonon Youth Logo"
                class="h-11 w-11 rounded-full">

            <!-- Navigation Links and Logout Icon (Right Side) -->
            <div class="flex items-center space-x-6">
                <a href="{{ route('welcome') }}" class="hover:text-purple-700">Dashboard</a>
                <a href="{{ route('learnmore') }}" class="hover:text-purple-700">Learn More</a>
                <a href="{{ route('login') }}" class="hover:text-purple-700">Login</a>
                <!-- Logout Icon -->
                <a href="{{ route('logout') }}" class="hover:text-purple-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-blue-600 text-white py-20 relative">
        <div class="container mx-auto px-4 text-center">
            <!-- Previous Arrow -->
            @php
                $totalProjects = 5; // Matches the number of projects (1 to 5)
                $prevId = ($id - 1 >= 1) ? $id - 1 : 1;
            @endphp
            @if($id > 1)
                <a href="{{ route('project.details', ['id' => $prevId]) }}"
                    class="absolute left-4 top-1/2 transform -translate-y-1/2 text-white hover:text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
            @endif

            <!-- Next Arrow -->
            @php
                $nextId = ($id + 1 <= $totalProjects) ? $id + 1 : $totalProjects;
            @endphp
            @if($id < $totalProjects)
                <a href="{{ route('project.details', ['id' => $nextId]) }}"
                    class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white hover:text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            @endif

            <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $projectData['title'] ?? 'Project Not Found' }}</h1>
            <p class="text-lg md:text-xl max-w-2xl mx-auto">
                {{ $projectData['description'] ?? 'The project you are looking for does not exist.' }}
            </p>
        </div>
    </section>

    <!-- Description Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-8">About This Project</h2>
            <div class="max-w-3xl mx-auto text-gray-700">
                <p class="mb-4">
                    {{ $projectData['description'] ?? 'The project you are looking for does not exist.' }}
                </p>
                <p>
                    Explore more about our initiatives and join us in making a difference in the Surigao community.
                </p>
            </div>
        </div>
    </section>

    <!-- Image Gallery Section -->
    <section class="bg-white py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-8">Project Gallery</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @if(!empty($projectData['gallery_images']))
                    @foreach($projectData['gallery_images'] as $index => $image)
                        <div class="overflow-hidden rounded-lg shadow-lg">
                            <img src="{{ asset('images/projects/' . $projectData['folder'] . '/' . $image) }}"
                                alt="Project Image {{ $index + 1 }}"
                                class="w-full h-64 object-cover hover:scale-105 transition-transform duration-300">
                        </div>
                    @endforeach
                @else
                    <div class="col-span-3 text-center text-gray-500">
                        No gallery images available for this project.
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-4 text-center">
            <p class="mb-2">© 2025 Batang Surigaonon Youth. <br> All rights reserved.</p>
            <p>Contact us at: <a href="mailto:info@surigaoyouth.org"
                    class="underline hover:text-blue-300">info@batangsurigaononyouth.org</a></p>
        </div>
    </footer>
</body>

</html>