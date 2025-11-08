<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $projectData['title'] ?? 'Our Project' }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/png" href="{{ asset('images/BSYLogo.png') }}">
    <style>
        body {
            background-color: #f7fafc;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        nav {
            background-color: #1C0BA3;
            color: #ffffff;
            /* Changed to white to match the image */
            padding: 12px 0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-left: 0;
            position: fixed;
            /* Keeps nav at the top */
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 15px;
            gap: 5px;
            /* Reduced gap to bring logo and text closer */
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 8px;
            /* Minimal gap between logo and text */
        }

        .nav-logo {
            height: 44px;
            width: 44px;
            border-radius: 50%;
            margin-left: 1px;
        }

        .nav-container h2 {
            color: white;
            margin: 0;
            /* Remove default margin to eliminate extra space */
            font-size: 24px;
            font-weight: bold;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 24px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
        }

        .nav-links a:hover {
            color: #6b46c1;
        }

        .hero-section {
            background-color: #2b6cb0;
            color: #ffffff;
            padding: 80px 0;
            position: relative;
            margin-top: 60px;
            /* Offset for fixed nav */
        }

        .hero-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
            text-align: center;
        }

        .hero-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            color: #ffffff;
            text-decoration: none;
        }

        .hero-arrow:hover {
            color: #e2e8f0;
        }

        .hero-arrow.left {
            left: 15px;
        }

        .hero-arrow.right {
            right: 15px;
        }

        .hero-title {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 16px;
        }

        .hero-description {
            font-size: 18px;
            max-width: 800px;
            margin: 0 auto;
        }

        .description-section {
            padding: 64px 0;
        }

        .description-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
            text-align: center;
        }

        .description-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 32px;
        }

        .description-text {
            max-width: 900px;
            margin: 0 auto;
            color: #4a5568;
        }

        .description-text p {
            margin-bottom: 16px;
        }

        .gallery-section {
            background-color: #ffffff;
            padding: 64px 0;
        }

        .gallery-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .gallery-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 32px;
            text-align: center;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 24px;
        }

        @media (min-width: 640px) {
            .gallery-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 1024px) {
            .gallery-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        .gallery-item {
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .gallery-item img {
            width: 100%;
            height: 256px;
            object-fit: cover;
            transition: transform 0.3s;
        }

        .gallery-item img:hover {
            transform: scale(1.05);
        }

        .gallery-empty {
            grid-column: 1 / -1;
            text-align: center;
            color: #a0aec0;
        }

        footer {
            background-color: #2d3748;
            color: #ffffff;
            padding: 32px 0;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
            text-align: center;
        }

        .footer-container p {
            margin-bottom: 8px;
        }

        .footer-container a {
            color: #ffffff;
            text-decoration: underline;
        }

        .footer-container a:hover {
            color: #63b3ed;
        }

        .logout-icon {
            height: 24px;
            width: 24px;
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <nav>
        <div class="nav-container">
            <!-- Brand (Logo and Title) -->
            <div class="nav-brand">
                <img src="{{ asset('images/BSYLogo.png') }}" alt="Batang Surigaonon Youth Logo" class="nav-logo">
                <h2>Batang Surigaonon</h2>
            </div>

            <!-- Navigation Links and Logout Icon (Right Side) -->
            <div class="nav-links">
                <a href="{{ route('welcome') }}">Dashboard</a>
                <a href="{{ route('learnmore') }}">Learn More</a>
                <a href="{{ route('login') }}">Login</a>
                <!-- Logout Icon -->
                <a href="{{ route('logout') }}" class="hover:text-purple-700">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-container">
            <!-- Previous Arrow -->
            @php
                $totalProjects = 5; // Matches the number of projects (1 to 5)
                $prevId = ($id - 1 >= 1) ? $id - 1 : 1;
            @endphp
            @if($id > 1)
                <a href="{{ route('project.details', ['id' => $prevId]) }}" class="hero-arrow left">
                    <i class="fas fa-chevron-left"></i>
                </a>
            @endif

            <!-- Next Arrow -->
            @php
                $nextId = ($id + 1 <= $totalProjects) ? $id + 1 : $totalProjects;
            @endphp
            @if($id < $totalProjects)
                <a href="{{ route('project.details', ['id' => $nextId]) }}" class="hero-arrow right">
                    <i class="fas fa-chevron-right"></i>
                </a>
            @endif

            <h1 class="hero-title">{{ $projectData['title'] ?? 'Project Not Found' }}</h1>
            <p class="hero-description">
                {{ $projectData['description'] ?? 'The project you are looking for does not exist.' }}
            </p>
        </div>
    </section>

    <!-- Description Section -->
    <section class="description-section">
        <div class="description-container">
            <h2 class="description-title">About This Project</h2>
            <div class="description-text">
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
    <section class="gallery-section">
        <div class="gallery-container">
            <h2 class="gallery-title">Project Gallery</h2>
            <div class="gallery-grid">
                @if(!empty($projectData['gallery_images']))
                    @foreach($projectData['gallery_images'] as $index => $image)
                        <div class="gallery-item">
                            <img src="{{ asset('images/projects/' . $projectData['folder'] . '/' . $image) }}"
                                alt="Project Image {{ $index + 1 }}">
                        </div>
                    @endforeach
                @else
                    <div class="gallery-empty">
                        No gallery images available for this project.
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <p class="mb-2">© 2025 Batang Surigaonon Youth. <br> All rights reserved.</p>
            <p>Contact us at: <a href="mailto:info@surigaoyouth.org">info@batangsurigaononyouth.org</a></p>
        </div>
    </footer>
</body>

</html>