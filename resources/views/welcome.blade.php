<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Batang Surigaonon Youth</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
 <!--   * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: sans-serif;
    }

    body {
      background-color: #f9f9ff;
      color: #333;
    }

    .hero-section {
      position: relative;
      width: 100%;
      height: auto;
    }

    .hero-image {
      position: relative;
    }

    .hero-image img {
      width: 100%;
      display: block;
      height: 100vh;
      object-fit: cover;
    }
      
    /* Rest of your existing styles remain the same */
    .logo-circle img {
      width: 100px;
      border-radius: 50%;
      background-color: white;
      padding: 10px;
    }

    .hero-text {
      color: #fff;
    }

    .hero-text h1 {
      font-size: 2.5rem;
      font-weight: bold;
    }

    .hero-text span {
      color: #fff;
      background-color: #6f30d3;
      padding: 0.2rem 0.5rem;
      border-radius: 5px;
    }

    .hero-text p {
      font-style: italic;
      margin-top: 0.5rem;
    }

    .about-section {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 3rem;
      gap: 2rem;
      flex-wrap: wrap;
    }

    .about-text {
      flex: 1 1 400px;
    }

    .about-text h3 {
      color: #1C0BA3;
      text-transform: uppercase;
      font-size: 0.9rem;
      margin-bottom: 0.3rem;
    }

    .about-text h2 {
      font-size: 2rem;
      margin-bottom: 1rem;
    }

    .about-text p {
      font-size: 1rem;
      margin-bottom: 1.5rem;
      line-height: 1.5;
    }

    .buttons button {
      padding: 0.6rem 1.2rem;
      font-size: 1rem;
      margin-right: 1rem;
      border: none;
      border-radius: 5px;
      background-color: #1C0BA3;
      color: white;
      cursor: pointer;
      transition: all 0.3s;
    }

    .buttons button:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .buttons .outline {
      background-color: white;
      color: #1C0BA3;
      border: 2px solid #1C0BA3;
    }

    .buttons .outline:hover {
      background-color: #f5f5ff;
    }

    .about-image img {
      max-width: 100%;
      margin-left: 8.1%;
    }

    .lasthero img {
      width: 120%;
      height: 100vh;
      object-fit: cover;
    } -->
</head>
<body>

  <header class="hero-section">
    <div class="login_redirect">
      <a href="{{ route('login') }}" class="login-link">Login</a>
    </div>
    <div class="semi-circle">
        <div class="title_container">
            <img src="images/BSYLogo.png" class="landing_page_logo" alt="Logo"/>
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
  </header><!--
  <section class="about-section">
    <div class="about-text">
      <h3>ABOUT US</h3>
      <h2>Who Are We?</h2>
      <p>
        Batang Surigaonon Youth is a group or organization centered around the youth of Surigao, 
        typically aiming to uplift and empower young people in the region. The term could symbolize a collective identity 
        for Surigao's younger generation, emphasizing pride in local culture, active participation in community development, 
        and fostering unity among peers.
      </p>
      <div class="buttons">
        <button>Learn More</button>
        <button class="outline" onclick="window.location.href='{{ route('register') }}'">Join Us</button>
      </div>
    </div>
    <div class="about-image">
      <img src="{{ asset('images/BSYSide.png') }}" alt="Event Group" /> 
    </div>
  </section>

  <div class="LastHero">
    <img src="{{ asset('images/BSYLastHero.png') }}" alt="Last Image" />
  </div>-->

</body>
</html>
