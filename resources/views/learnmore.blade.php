<!DOCTYPE html>
<html lang="en">

<style>
    /* Navigation Bar Styles */
    .navbar {
        background-color: #035ba28e;
        padding: 15px 20px;
        /* margin-right: 100px; */
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: fixed;
        top: 0;
        width: 98%;
        /* border-bottom-right-radius: 30px; */
        height: fit-content;
        z-index: 1000;
        transition: transform 0.1s ease;
    }

    .navbar.hidden {
        transform: translateY(-100%);
        /* Slide the navbar up out of view */
    }

    .navbar-logo img {
        width: 60px;
        height: 60px;
    }

    .navbar-links {
        display: flex;
        gap: 20px;
        align-items: center;
    }

    .navbar-links a {
        color: #F5A623;
        /* Orange color for links */
        text-decoration: none;
        font-size: 1rem;
        font-weight: bold;
        transition: color 0.3s ease;
    }

    .navbar-links a:hover {
        color: #fff;
        /* White on hover */
    }

    .join-us-btn {
        background-color: #007BFF;
        /* Blue button */
        color: #fff;
        padding: 8px 20px;
        border-radius: 20px;
        text-decoration: none;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .join-us-btn:hover {
        background-color: #0056b3;
        /* Darker blue on hover */
    }

    /* Media Queries for Responsiveness */
    @media (max-width: 1024px) {
        .navbar-links a {
            font-size: 0.9rem;
            /* Slightly smaller text for tablets */
        }

        .navbar-logo img {
            max-width: 130px;
            /* Smaller logo for tablets */
        }

        .join-us-btn {
            padding: 6px 15px;
            /* Reduced padding for tablets */
        }
    }

    @media (max-width: 768px) {
        .navbar {
            padding: 10px 15px;
            /* Reduced padding for tablets */
        }

        .navbar-links {
            gap: 15px;
            /* Reduced gap between links */
        }

        .navbar-links a {
            font-size: 0.85rem;
            /* Smaller text for tablets */
        }

        .navbar-logo img {
            max-width: 120px;
            /* Smaller logo for tablets */
        }

        .join-us-btn {
            padding: 5px 12px;
            /* Further reduced padding */
            font-size: 0.9rem;
            /* Smaller button text */
        }
    }

    @media (max-width: 480px) {
        .navbar {
            flex-direction: column;
            /* Stack elements vertically on mobile */
            padding: 10px;
            /* Reduced padding for mobile */
            text-align: center;
        }

        .navbar-logo {
            margin-bottom: 10px;
            /* Space below logo */
        }

        .navbar-logo img {
            max-width: 100px;
            /* Smaller logo for mobile */
        }

        .navbar-links {
            flex-direction: column;
            /* Stack links vertically */
            gap: 10px;
            /* Reduced gap */
            margin-bottom: 10px;
        }

        .navbar-links a {
            font-size: 0.8rem;
            /* Smaller text for mobile */
        }

        .join-us-btn {
            padding: 5px 10px;
            /* Minimal padding for mobile */
            font-size: 0.85rem;
            /* Smaller button text */
            width: 100px;
            /* Fixed width for consistency */
            display: block;
            /* Ensure it behaves as a block */
            margin: 0 auto;
            /* Center the button */
        }
    }
</style>

<body>

    <div class="container">
        <!-- New Header with Navigation -->
        <nav class="navbar">
            <div class="navbar-logo">
                <img src="{{ asset('images/logos/bsylogo.png') }}" alt="JCI Surigao Nickel Logo">
            </div>
            <div class="navbar-links">
                <a href="#" onclick="scrollToSection('about-section')">About Us</a>
                <a href="#" onclick="scrollToSection('project-section')">Projects</a>
                <a href="#" onclick="scrollToSection('partners-section')">Partners</a>
                <a href="{{ route('login') }}">Login</a>
                {{-- <a href="#" class="join-us-btn">Join Us</a> --}}
            </div>
        </nav>
    </div>


    {{-- <div class="video-section">
        <div class="video-container">
            <img src={{ asset('images/videos/BSY Story.mp4') }} alt="Video Thumbnail" class="video-thumbnail">
            <div class="video-overlay">
                <span class="video-title">HE'S THE JUAN: A leader made for everyJUAN</span>
                <button class="play-button">
                    <svg width="68" height="48" viewBox="0 0 68 48" fill="none" xmlns="http://www.w3.org/2000/svg">

                        <path
                            d="M66.52 7.74c-.78-2.93-2.49-5.41-5.42-6.19C55.79.13 34 0 34 0S12.21.13 6.9 1.55c-2.93.78-4.63 3.26-5.42 6.19C.06 13.05 0 24 0 24s.06 10.95 1.48 16.26c.78 2.93 2.49 5.41 5.42 6.19C12.21 47.87 34 48 34 48s21.79-.13 27.1-1.55c2.93-.78 4.64-3.26 5.42-6.19C67.94 34.95 68 24 68 24s-.06-10.95-1.48-16.26z"
                            fill="#f00" />
                        <path d="M45.02 24 27.94 16.1v15.8L45.02 24z" fill="#fff" />
                    </svg>
                </button>
                <span class="channel-name">Sungao Nickler</span>
            </div>
            <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class="watch-link" target="_blank">Watch on
                YouTube</a>
        </div>
    </div> --}}

    <style>
        .video-section {
            width: 100%;
            background-color: #0f0f0f;
            padding: 10px 0;
        }

        .video-container {
            position: relative;
            width: 100%;
            max-width: 1280px;
            margin: 0 auto;
            overflow: hidden;
        }

        .video-thumbnail {
            width: 100%;
            height: auto;
            display: block;
        }

        .video-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
        }

        .video-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 10px;
            display: block;
        }

        .play-button {
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
        }

        .channel-name {
            font-size: 0.9rem;
            color: #ccc;
            display: block;
            margin-top: 10px;
        }

        .watch-link {
            display: block;
            text-align: center;
            color: white;
            text-decoration: none;
            font-size: 0.9rem;
            margin-top: 10px;
            background-color: #333;
            padding: 5px 10px;
            border-radius: 3px;
        }

        .watch-link:hover {
            background-color: #444;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .video-title {
                font-size: 1.2rem;
            }

            .channel-name {
                font-size: 0.8rem;
            }

            .watch-link {
                font-size: 0.8rem;
            }
        }

        @media (max-width: 480px) {
            .video-title {
                font-size: 1rem;
            }

            .channel-name {
                font-size: 0.7rem;
            }

            .watch-link {
                font-size: 0.7rem;
            }
        }
    </style>




    {{-- <div class="container">
        <h1>Learn More</h1>
        <p>Welcome to the Learn More page! Here you can find additional information about our organization,
            projects,
            and initiatives.</p>
        <p>Feel free to explore and discover how we are making a difference in the community.</p>
        <p>If you have any questions or need further information, please don't hesitate to contact us.</p>
    </div> --}}
</body>

</html>