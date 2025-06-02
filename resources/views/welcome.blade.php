<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Batang Surigaonon Youth</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

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

    <div class="container">
      <!-- First Hero Section -->
      <header class="hero1">
        <div class="semi-circle">
          <div class="title_container">
            <img src="images/BSYLogo.png" class="landing_page_logo" alt="Logo" />
            <div class="title_wrapper_main">
              <div class="t_1">BATANG</div>
              <div class="t_2">SURIGAONON</div>
              <div class="t_3">YOUTH</div>
            </div>
            <div class="title_wrapper_sub">
              <div class="ts_1">"THE FIRST STEP OF LEADERSHIP IS</div>
              <div class="ts_2">SERVANTHOOD."</div>
            </div>
          </div>
        </div>
      </header>
    </div>


    <!-- Second Hero Section -->
    <section id="about-section" class="about">
      <div class="container">

        <div class="about-content">
          <div class="about-text">
            <h2>About Us</h2>
            <h3>Who Are We?</h3>
            <p>Batang Surigaonon Youth is a group or organization centered around the youth of Surigao, typically
              aiming to uplift and empower young people in the region. The term could symbolize a collective
              identity for Surigao's younger generation, emphasizing pride in local culture, active participation in
              community development, and fostering unity among peers.
            </p>
            <div class="buttons">
              <a href="{{ route('learnmore')}}" class="learn-more">Learn More →</a>
              <a href="{{ route('register') }}" class="join-us">Join Us</a>
            </div>
          </div>
          <div class="about-image">
            <img src="{{ asset('images/side_feat.png') }}" alt="About Group Photo">
          </div>
        </div>
    </section>
  </div>



  <!-- Our Projects Section -->
  <section id="project-section" class="projects">
    <h2>Our Projects</h2>
    <div class="scroll-gallery-container">
      <div class="scroll-gallery-track">
        <!-- Community Clean-Up -->
        <a href="{{ route('project.details', ['id' => 1]) }}" class="scroll-gallery-link">
          <div class="scroll-gallery-item">
            <img src="{{ asset('images/projects/Community_Clean_Up/1.jpg') }}" alt="Project 1">
            <div class="text-container">
              <h3>Community Clean-Up</h3>
              <p>A project to clean and preserve Surigao's beaches, promoting environmental awareness among the
                youth.</p>
            </div>
          </div>
        </a>

        <!-- Basic Life Support Trainings -->
        <a href="{{ route('project.details', ['id' => 2]) }}" class="scroll-gallery-link">
          <div class="scroll-gallery-item">
            <img src="{{ asset('images/projects/Basic_Life_Support_Training/6.jpg') }}" alt="Project 2">
            <div class="text-container">
              <h3>Basic Life Support Training</h3>
              <p>An annual summit to inspire and train young leaders in Surigao for community development.</p>
            </div>
          </div>
        </a>

        <!--Feeding Program -->
        <a href="{{ route('project.details', ['id' => 3]) }}" class="scroll-gallery-link">
          <div class="scroll-gallery-item">
            <img src="{{ asset('images/projects/Feeding_Program/5.jpg') }}" alt="Project 3">
            <div class="text-container">
              <h3>Feeding Programs</h3>
              <p>Supporting education by providing scholarships to underprivileged students in the region.</p>
            </div>
          </div>
        </a>

        <!-- Free Ice Cream & Sim_Reg -->
        <a href="{{ route('project.details', ['id' => 4]) }}" class="scroll-gallery-link">
          <div class="scroll-gallery-item">
            <img src="{{ asset('images/projects/Free_IceCream&Sim_Reg/10.jpg') }}" alt="Project 4">
            <div class="text-container">
              <h3>Free Ice Cream & Sim Registration</h3>
              <p>Celebrating Surigaonon culture through art, music, and dance performances by the youth.</p>
            </div>
          </div>
        </a>

        <!-- Relief Operation -->
        <a href="{{ route('project.details', ['id' => 5]) }}" class="scroll-gallery-link">
          <div class="scroll-gallery-item">
            <img src="{{ asset('images/projects/Relief_Operations/5.jpg') }}" alt="Project 5">
            <div class="text-container">
              <h3>Relief Operation</h3>
              <p>Planting trees to contribute to a greener Surigao community.</p>
            </div>
          </div>
        </a>
      </div>
    </div>
  </section>

  <!-- Partners & Sponsors Section -->
  <section id="partners-section" class="partners-sponsors">
    <h2>PARTNERS & SPONSORS</h2>
    <h3>Extending Hands</h3>
    <div class="logo-grid">
      <img src="{{ asset('images/logos/jci-surigao-nickel 1.png') }}" alt="JCI Surigao Nickel">
      <img src="{{ asset('images/logos/lydo.png') }}" alt="LYDO Surigao City">
      <img src="{{ asset('images/logos/city_logo.png') }}" alt="Surigao City Logo">
      <img src="{{ asset('images/logos/jjc.png') }}" alt="JJC Surigao Ironwood">
      <img src="{{ asset('images/logos/ylp.png') }}" alt="YLP Youth Leadership">
      <img src="{{ asset('images/logos/tingog.png') }}" alt="Tingog Party List">
      <img src="{{ asset('images/logos/sk.png') }}" alt="SK Federation Surigao City">
    </div>
  </section>

  <!-- Footer Section -->
  <footer class="footer-section">
    <div class="footer-left">
      <img src="{{ asset('images/logos/bsylogo.png') }}" alt="BSY Logo">
      <img src="{{ asset('images/logos/offtogreatness.png') }}" alt="Off to Greatness Logo">
      <img src="{{ asset('images/logos/ignitethelight.png') }}" alt="Ignite the Light Logo">
      <img src="{{ asset('images/logos/daretolead.png') }}" alt="Dare to Lead Logo">
    </div>
    <div class="footer-right">
      <div class="footer-column">
        <h4>BSY DISTRICTS</h4>
        <ul>
          <li>Arellano Districts</li>
          <li>Urban Districts</li>
          <li>Highway Districts</li>
          <li>North Districts</li>
          <li>East Districts</li>
          <li>South Districts</li>
          <li>West Districts</li>
        </ul>
      </div>
      <div class="footer-column">
        <h4>GET INVOLVED</h4>
        <ul>
          <li><a href="#">Join Us</a></li>
          <li><a href="#">Donate</a></li>
        </ul>
      </div>
      <div class="footer-column">
        <h4>STAY CONNECTED</h4>
        <ul>
          <li><a href="https://www.facebook.com/abantebatangsurigaononyouth">Facebook</a></li>
        </ul>
      </div>
    </div>
  </footer>


  <!-- JavaScript for Smooth Scrolling -->
  <script>
    function scrollToSection(sectionId) {
      const section = document.getElementById(sectionId);
      if (section) {
        section.scrollIntoView({ behavior: 'smooth' });
      }
    }
  </script>

  <script>
    let lastScrollTop = 0;
    const navbar = document.querySelector('.navbar');
    const heroSection = document.querySelector('.hero1');
    const heroSectionHeight = heroSection.offsetHeight; // Get the height of the hero section

    window.addEventListener('scroll', function () {
      let currentScrollTop = window.pageYOffset || document.documentElement.scrollTop;

      // Always show the navbar if we're at the top or within the hero section
      if (currentScrollTop <= heroSectionHeight) {
        navbar.classList.remove('hidden');
      } else {
        // Hide the navbar when scrolling down, show when scrolling up
        if (currentScrollTop > lastScrollTop) {
          // Scrolling down
          navbar.classList.add('hidden');
        } else {
          // Scrolling up
          navbar.classList.remove('hidden');
        }
      }

      lastScrollTop = currentScrollTop <= 0 ? 0 : currentScrollTop; // For Mobile or negative scrolling
    });
  </script>
</body>

</html>