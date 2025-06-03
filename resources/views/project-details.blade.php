<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $project[$id]['title'] ?? 'Our Project' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">
    <!-- Hero Section -->
    <section class="bg-blue-600 text-white py-20 relative">
        <div class="container mx-auto px-4 text-center">

            <!-- Previous Arrow -->
            <a href="{{ url('/') }}"
                class="absolute left-4 top-1/2 transform -translate-y-1/2 text-white hover:text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>

            <!-- Next Arrow -->
            @php
                $totalProjects = count($project);
                $nextId = ($id + 1) % $totalProjects; // Calculate next ID
            @endphp
            @if($id < $totalProjects - 1) <!-- Show Next Arrow only if not on the last project -->
                <a href="{{ route('project.details', ['id' => $nextId]) }}"
                    class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white hover:text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            @endif


            <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $project[$id]['title'] ?? 'Project Not Found' }}</h1>
            <p class="text-lg md:text-xl max-w-2xl mx-auto">
                {{ $project[$id]['description'] ?? 'The project you are looking for does not exist.' }}
            </p>
        </div>
    </section>

    <!-- Description Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-8">About This Project</h2>
            <div class="max-w-3xl mx-auto text-gray-700">
                <p class="mb-4">
                    {{ $project[$id]['description'] ?? 'The project you are looking for does not exist.' }}
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
                @if(!empty($project[$id]['gallery_images']))
                    {{-- Check if gallery images exist --}}
                    {{-- If gallery images are available, display them --}}
                    @foreach($project[$id]['gallery_images'] as $index => $image)
                        {{-- Display each image in the gallery --}}
                        <div class="overflow-hidden rounded-lg shadow-lg">
                            <img src="{{ asset('images/projects/' . $project[$id]['folder'] . '/' . $image) }}"
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