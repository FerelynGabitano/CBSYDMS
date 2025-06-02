<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learn More - BSY</title>
    <style>
        body {
            background-color: #f3f4f6;
            font-family: sans-serif;
            margin: 0;
        }

        header {
            background-color: #4c1d95;
            color: white;
            padding: 1.5rem;
            text-align: center;
            position: relative;
        }

        header h1 {
            font-size: 1.875rem;
            font-weight: 700;
        }

        header a {
            position: absolute;
            left: 1.5rem;
            top: 50%;
            transform: translateY(-50%);
            color: white;
        }

        header a:hover {
            color: #d1d5db;
        }

        header a svg {
            width: 2rem;
            height: 2rem;
        }

        section {
            padding: 2.5rem 0;
        }

        section.bg-white {
            background-color: white;
        }

        section.bg-gray-200 {
            background-color: #e5e7eb;
        }

        .container {
            max-width: 1280px;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
        }

        h2 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        video {
            width: 100%;
            max-width: 1024px;
            margin: 0 auto;
        }

        p {
            font-size: 1.125rem;
            max-width: 672px;
            margin: 0 auto;
        }

        .mb-6 {
            margin-bottom: 1.5rem;
        }

        .bg-white {
            background-color: white;
        }

        .p-4 {
            padding: 1rem;
        }

        .rounded-lg {
            border-radius: 0.5rem;
        }

        .shadow {
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1), 0 1px 2px rgba(0, 0, 0, 0.06);
        }

        .inline-block {
            display: inline-block;
        }

        img {
            margin: 0 auto 0.5rem;
        }

        .w-48 {
            width: 12rem;
            height: 12rem;
        }

        .w-40 {
            width: 10rem;
            height: 10rem;
        }

        .w-32 {
            width: 8rem;
            height: 8rem;
        }

        .w-24 {
            width: 6rem;
            height: 6rem;
        }

        .rounded-full {
            border-radius: 9999px;
        }

        .font-bold {
            font-weight: 700;
        }

        .text-gray-600 {
            color: #4b5563;
        }

        .grid {
            display: grid;
            gap: 1.5rem;
        }

        @media (min-width: 768px) {
            .md-grid-cols-2 {
                grid-template-columns: repeat(2, 1fr);
            }

            .md-grid-cols-4 {
                grid-template-columns: repeat(4, 1fr);
            }

            .md-grid-cols-5 {
                grid-template-columns: repeat(5, 1fr);
            }
        }

        footer {
            background-color: #4c1d95;
            color: white;
            padding: 1.5rem;
            text-align: center;
        }

        footer p {
            font-size: 1.125rem;
        }

        footer p.mt-2 {
            margin-top: 0.5rem;
            font-size: 0.875rem;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header>
        <a href="{{ url('/') }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
        <h1>Learn More About Batang Surigaonon Youth</h1>
    </header>

    <!-- Video Section -->
    <section class="bg-white">
        <div class="container">
            <h2>Watch Our Video</h2>
            <video controls>
                <source src="images/videos/We endured and Won.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </section>

    <!-- Vision & Mission Section -->
    <section class="bg-white">
        <div class="container">
            <h2>Vision & Mission</h2>
            <p>
                Our vision is to empower youth through leadership and service. Our mission is to foster a community
                dedicated to personal growth, community service, and sustainable development.
            </p>
        </div>
    </section>

    <!-- BSY Creed Section -->
    <section class="bg-white">
        <div class="container">
            <h2>BSY Creed</h2>
            <p>
                We believe in the power of youth to shape the future. We commit to integrity, service, and excellence in
                all we do, standing united for a better tomorrow.
            </p>
        </div>
    </section>

    <!-- BSY Logo Section -->
    <section class="bg-white">
        <div class="container">
            <h2>BSY Logo</h2>
            <img src="/images/BSYLogo.png" alt="BSY Logo" class="w-48 mx-auto">
            <p>
                THE FLAME<br><br>

                The emblem of this Organization is called The Flame. It is composed of four individual blazes within an
                incomplete circle. Each blaze is a different color representing the Four Tenets of BSY: <br><br>

                Blue represents freedom. BSY believes that the youth should be able to express their ideas and opinions
                freely and without censure.<br><br>

                The neutrality of Gray symbolizes equality. BSY believes that every Batang Surigaonon should have equal
                access to opportunity, services, and progress.<br><br>

                The warmth of Red embodies justice. BSY believes that justice plays an important role in achieving
                peace.<br><br>

                Cyan represents youth servanthood. BSY believes that the first step of leadership is servanthood.<br>

                The flame itself represents the burning passion of the youth to be a catalyst for positive change,
                heralding a better and brighter Surigao City.<br><br>

                The incomplete circle represents the void, a gap that needs to be filled with continuous learning of the
                youth to address the challenges present in the society.<br><br>

                #BatangSurigaononYouth<br>
                #OffToGreatness<br>
                #BeTheChangeYouWantToSee<br>




            </p>
        </div>
    </section>

    <!-- BSY Officers Section -->
    <section class="bg-gray-200">
        <div class="container">
            <h2>BSY Officers</h2>
            <!-- City President -->
            <div class="mb-6">
                <div class="bg-white p-4 rounded-lg shadow inline-block">
                    <img src="/images/officers/Avatar.png" alt="Carla Lesis" class="w-48 rounded-full">
                    <p class="font-bold">Carla Lesis</p>
                    <p class="text-gray-600">City President</p>
                </div>
            </div>

            <!-- Secretary General and Treasurer General -->
            <div class="grid md-grid-cols-2 mb-6">
                <div class="bg-white p-4 rounded-lg shadow">
                    <img src="/images/officers/Avatar.png" alt="Dy Anne Gales" class="w-40 rounded-full">
                    <p class="font-bold">Dy Anne Gales</p>
                    <p class="text-gray-600">Secretary General</p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <img src="/images/officers/Avatar.png" alt="Giessa Piedad" class="w-40 rounded-full">
                    <p class="font-bold">Giessa Piedad</p>
                    <p class="text-gray-600">Treasurer General</p>
                </div>
            </div>

            <!-- Executive Vice President -->
            <div class="mb-6">
                <div class="bg-white p-4 rounded-lg shadow inline-block">
                    <img src="/images/officers/Avatar.png" alt="Jaira Mae Liquido" class="w-40 rounded-full">
                    <p class="font-bold">Jaira Mae Liquido</p>
                    <p class="text-gray-600">Executive Vice President</p>
                </div>
            </div>

            <!-- District Vice Presidents -->
            <div class="grid md-grid-cols-4 mb-6">
                <div class="bg-white p-4 rounded-lg shadow">
                    <img src="/images/officers/Avatar.png" alt="Jess Catuboran" class="w-32 rounded-full">
                    <p class="font-bold">Jess Catuboran</p>
                    <p class="text-gray-600">North District Vice President</p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <img src="/images/officers/Avatar.png" alt="Missy Faith Marte" class="w-32 rounded-full">
                    <p class="font-bold">Missy Faith Marte</p>
                    <p class="text-gray-600">East District Vice President</p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <img src="/images/officers/Avatar.png" alt="Riza Joy Lisbo" class="w-32 rounded-full">
                    <p class="font-bold">Riza Joy Lisbo</p>
                    <p class="text-gray-600">West District Vice President</p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <img src="/images/officers/Avatar.png" alt="Ace Balutan" class="w-32 rounded-full">
                    <p class="font-bold">Ace Balutan</p>
                    <p class="text-gray-600">South District Vice President</p>
                </div>
            </div>

            <!-- Additional District Vice Presidents -->
            <div class="grid md-grid-cols-2 mb-6">
                <div class="bg-white p-4 rounded-lg shadow">
                    <img src="/images/officers/Avatar.png" alt="Clark Erdadan" class="w-32 rounded-full">
                    <p class="font-bold">Clark Erdadan</p>
                    <p class="text-gray-600">Urban District Vice President</p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <img src="/images/officers/Avatar.png" alt="Reggie Cubelo Jr." class="w-32 rounded-full">
                    <p class="font-bold">Reggie Cubelo Jr.</p>
                    <p class="text-gray-600">Highway District Vice President</p>
                </div>
            </div>

            <!-- Committee Chairmen -->
            <div class="grid md-grid-cols-5">
                <div class="bg-white p-4 rounded-lg shadow">
                    <img src="/images/officers/Avatar.png" alt="Angel Buico" class="w-24 rounded-full">
                    <p class="font-bold">Angel Buico</p>
                    <p class="text-gray-600">Audit Committee Chairman</p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <img src="/images/officers/Avatar.png" alt="Rizel An Pedronio" class="w-24 rounded-full">
                    <p class="font-bold">Rizel An Pedronio</p>
                    <p class="text-gray-600">Training Director</p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <img src="/images/officers/Avatar.png" alt="Delber Joy Hermoso" class="w-24 rounded-full">
                    <p class="font-bold">Delber Joy Hermoso</p>
                    <p class="text-gray-600">Awards Committee Chairman</p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <img src="/images/officers/Avatar.png" alt="Trixie Pelaris" class="w-24 rounded-full">
                    <p class="font-bold">Trixie Pelaris</p>
                    <p class="text-gray-600">Programs & Projects Director</p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <img src="/images/officers/Avatar.png" alt="Jindel Febrer Bangcoy" class="w-24 rounded-full">
                    <p class="font-bold">Jindel Febrer Bangcoy</p>
                    <p class="text-gray-600">Grievance Committee Chairman</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>© 2025 BSY. All rights reserved.</p>
        <p class="mt-2">Contact us: info@bsy.org | Follow us on social media</p>
    </footer>
</body>

</html>