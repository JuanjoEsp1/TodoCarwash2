<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="apple-touch-icon" sizes="180x180" href="Image/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="Image/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="Image/favicon-16x16.png">
  <link rel="manifest" href="Image/site.webmanifest">
  <link rel="stylesheet" href="Css/Index.css">

  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Home</title>
</head>

<body>
  <?php
  include("Navbar.php");
  ?>

  <div id="slider">
    <figure>
      <img src="/IMG/wp001.jpg">
      <img src="/IMG/wp002.jpg">
      <img src="/IMG/wp003.jpg">
      <img src="/IMG/wp004.jpg">
      <img src="/IMG/wp005.jpg">
    </figure>
  </div>



  <!-- The Band Section -->
  <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="band">
    <h2 class="w3-wide">Sobre Nosotros</h2>
    <p class="w3-opacity"><i></i></p>
    <p class="w3-justify">We have created a fictional band website. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
      ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur
      adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    <div class="w3-row w3-padding-32">
      <div class="w3-third">
        <p>Guillermo</p>
        <img src="/IMG/bandmember.jpg" class="w3-round w3-margin-bottom" alt="Random Name" style="width:60%">
      </div>
      <div class="w3-third">
        <p>Given</p>
        <img src="/IMG/bandmember.jpg" class="w3-round w3-margin-bottom" alt="Random Name" style="width:60%">
      </div>
      <div class="w3-third">
        <p>Juan</p>
        <img src="/IMG/bandmember.jpg" class="w3-round" alt="Random Name" style="width:60%">
      </div>
    </div>
  </div>

  <section class="wrapper style1 container special">
    <div class="row">
      <div class="col-4 col-12-narrower">

        <section>
          <span class="icon solid featured fa-check"></span>
          <header>
            <h3>Vision</h3>
          </header>
          <p>Sed tristique purus vitae volutpat ultrices. Aliquam eu elit eget arcu commodo suscipit dolor nec nibh. Proin a ullamcorper elit, et sagittis turpis. Integer ut fermentum.</p>
        </section>

      </div>
      <div class="col-4 col-12-narrower">

        <section>
          <span class="icon solid featured fa-check"></span>
          <header>
            <h3>Objetivo</h3>
          </header>
          <p>Sed tristique purus vitae volutpat ultrices. Aliquam eu elit eget arcu commodo suscipit dolor nec nibh. Proin a ullamcorper elit, et sagittis turpis. Integer ut fermentum.</p>
        </section>

      </div>
      <div class="col-4 col-12-narrower">

        <section>
          <span class="icon solid featured fa-check"></span>
          <header>
            <h3>Probably Something</h3>
          </header>
          <p>Sed tristique purus vitae volutpat ultrices. Aliquam eu elit eget arcu commodo suscipit dolor nec nibh. Proin a ullamcorper elit, et sagittis turpis. Integer ut fermentum.</p>
        </section>

      </div>
    </div>
  </section>

  <?php include("footer.php"); ?>
</body>

</html>