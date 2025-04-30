<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Batang Surigaonon Youth</title>
  <!--<link rel="stylesheet" href="style.css" />-->
  <style>
    * {
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
}

/*.overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(to right, rgba(0,0,0,0.4), rgba(91, 0, 152, 0.8));
  display: flex;
  align-items: center;
  padding: 2rem;
  gap: 2rem;
}
  */

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
  color: #6f30d3;
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
  background-color: #6f30d3;
  color: white;
  cursor: pointer;
}

.buttons .outline {
  background-color: white;
  color: #6f30d3;
  border: 2px solid #6f30d3;
}

.about-image img {
  max-width: 100%;
  border-radius: 15px;
}

.overlay {
  position: absolute;
  top: 0;
  right: 0;
  height: 103%;
  width: 51%;
  display: flex;
  align-items: center;
  justify-content: flex-end;
  background: transparent;
}

.circle-overlay {
  position: relative;
  /*background-color: rgba(109, 36, 165, 0.9); */
  width: 900px;
  height: 900px;
  border-radius: 50%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  /*padding: 2rem;*/
  color: white;
  text-align: center;
}


/*
.overlay {
  position: absolute;
  top: 0;
  right: 0;
  height: 100%;
  width: 50%;
  display: flex;
  align-items: center;
  justify-content: flex-end;
  background: transparent;
}

.circle-overlay {
  position: relative;
  background-color: rgba(109, 36, 165, 0.9); 
  width: 900px;
  height: 900px;
  border-radius: 50%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 2rem;
  color: white;
  text-align: center;
}

.circle-overlay img {
  width: 120px;
  height: 120px;
  border-radius: 50%;
  background: white;
  padding: 10px;
  margin-bottom: 1rem;
}

.circle-overlay h1 {
  font-size: 2rem;
  font-weight: 700;
  margin-bottom: 0.2rem;
}

.circle-overlay h1 span {
  font-size: 2.5rem;
  display: block;
  font-weight: 800;
}

.circle-overlay p {
  font-size: 0.9rem;
  font-style: italic;
  margin-top: 0.5rem;
}
*/

</style>

</head>
<body>

  <header class="hero-section">
    <div class="hero-image">
      <img src="{{ asset('images/BSYCover.png') }}" alt="Group Photo" />
      
      <div class="overlay">
      <div class="circle-overlay">
        <img src="{{ asset('images/BSYOverlay.png') }}" alt="BSY Logo" />  
      </div>
      <!--<div class="overlay">
        <div class="circle-overlay">
          <img src="{{ asset('images/BSYOverlay.png') }}" alt="BSY Logo" />  
        <div class="hero-text">
          <h1>BATANG SURIGAONON <span>YOUTH</span></h1>
          <p>“The first step of leadership is servanthood.”</p>
        </div>
      </div> -->
    </div>
  </header>

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
        <button class="outline">Join Us</button>
      </div>
    </div>
    <div class="about-image">
      <img src="{{ asset('images/BSYSide.png') }}" alt="Event Group" /> 
    </div>
  </section>

  <div class="LastHero">
    <img src="{{ asset('images/BSYLastHero.png') }}" alt="Last Image" />

</body>
</html>
