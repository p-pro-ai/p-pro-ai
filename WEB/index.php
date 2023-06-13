<?php
session_start();
if($_GET['twitterhasantoor']=='true'){
 $_SESSION['twitterhasantoor'] = true;
}

?>
<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="UTF-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>P-PRO | AI </title>

    <link rel="stylesheet" href="style.css" />


    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
    />

    <link rel="stylesheet" type="text/css" href="./aos/aos.css" />

    <meta property="og:type" content="website" />

    <meta property="og:title" content="P-PRO | AI
      " />

      <script>
    function isAndroid() {
      return navigator.userAgent.toLowerCase().indexOf("android") > -1;
    }
  </script>

    <meta
      property="og:description"
      content="AI solver for anything"
    />

    <!-- <meta property="og:image" content="https://media.discordapp.net/attachments/944947022539141140/947002440069312562/Warmaster_logo.png?size=1024"/> -->

    <meta name="theme-color" content="#22b4b7" />

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9172953106196372"
    crossorigin="anonymous"></script>
    
    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-7K3DXKH2RP">
</script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-7K3DXKH2RP');
</script>
  </head>

  <body>
    <div id="particles-js"></div>

    <div class="scroll-up-btn">
      <i class="fas fa-angle-up"></i>
    </div>

    <nav class="navbar">
      <div class="max-width">
        <div class="logo">
          <a href="index.php">P-PRO | AI<span></span></a>
        </div>

        <ul class="menu">
          <li><a href="index.php" class="menu-btn">Home</a></li>
          <li>
            <a href="pricing_not_logged.php" class="menu-btn" class="menu-btn">Pricing</a>
          </li>
          <li>
            <a href="#features" class="menu-btn" class="menu-btn">Our AI products</a>
          </li>

          <li><a href="contacts.html" class="menu-btn">Contact</a></li>

          <li><a href="about_us.html" class="menu-btn">About us</a></li>
        </ul>

        <div class="menu-btn">
          <i class="fas fa-bars"></i>
        </div>
      </div>
    </nav>

    <section class="home" id="home">
      <div class="max-width">
        <div class="home-content">
          <div class="text-1">Hello, this is</div>

          <div class="text-2">P-PRO AI </div>

          <div class="text-3">And it is <span class="typing"></span></div>

          <a class="this-is-pain" href="register.php">FREE REGISTRATION</a>
          <button id="downloadBtn" style="display: none; cursor: pointer;" onclick="redirectandr()"><img src="getgpl3.png" alt="Download from Google Play" style="border: 2px solid gray; border-radius: 5px; width: 200px; position: absolute; margin-top: 80px; "></button>
          <script>
    // Check if the device is Android and show the button
    if (isAndroid()) {
      var downloadBtn = document.getElementById("downloadBtn");
      downloadBtn.style.display = "block";
      function redirectandr(){
        location.href = "https://play.google.com/store/apps/details?id=eu.ppro";
      }
    }
  </script>
        </div>
      </div>
    </section>

    <section class="features" id="features">
      <div class="max-width">
        <h2 class="title">Features</h2>

        <div class="features-content">
          <div class="card">
            <div class="box">
              <i class="fas fa-cogs"></i>

              <div class="text">ALLIN CHAT</div>

              <p>
                Ask me everything you need and I will answer you! I am based on the GPT 4 language model and I am very powerful and helpful.
              </p>
            </div>
          </div>

          <div class="card">
            <div class="box">
              <i class="fas fa-code"></i>

              <div class="text">HUMAN TEXT GENERATOR</div>

              <p>I can generate you any text in the style of a human generated text. It won't be detectable by any AI detectors. Just give me the task and I will complete it!
                
              </p>
            </div>
          </div>

          <div class="card">
            <div class="box">
              <i class="fas fa-music"></i>

              <div class="text">MATH SOLVER</div>
              <p>
               Take a picture of the math problem, you want to solve and I will give you the answer and the steps you have to follow. I can even solve geometry problems.
              </p>
            </div>
          </div>

          <div class="card">
            <div class="box">
              <i class="fas fa-lock"></i>

              <div class="text">ALLIN TRANSLATOR</div>
              <p>
                Type me anything you want me to translate and I will translate it for you. I even have the option to listen, so you will be able to record speech and then translate it. I am AI based, I do not translate word by word. The translated output will be without any type of mistakes.
              </p>
            </div>
          </div>

          
        </div>
      </div>
    </section>

    <section class="stats" id="stats">
      <div class="max-width">
        <h2 class="title">
          Stats
        </h2>

        <div class="stats-content">
          <div class="card">
            <div class="box">
              <i class="fas fa-server"></i>

              <div class="text">Users</div>

              <p>395</p>
            </div>
          </div>

          <div class="card">
            <div class="box">
              <i class="fas fa-user"></i>

              <div class="text">Sended tasks</div>

              <p>92B</p>
            </div>
          </div>

          <div class="card">
            <div class="box">
              <i class="fas fa-user"></i>

              <div class="text">Token used</div>

              <p>890,370</p>
            </div>
          </div>
          
          </div>
        </div>
      </div>
    </section>

    <section class="contributors" id="contributors">
      <div class="max-width">
          <h2 class="title">
              Staff
          </h2>
          <div class="carousel owl-carousel">

              
            
              <div class="cardd">
                  <div class="boxx">
                      <div class="text">Svetoslav Petrov</div>
                      <p>
                          <button class="badges designer">Designer</button>
                          <button class="badges developer">FrontEnd</button>
                      </p>

                  </div>
              </div>
                        
            <div class="cardd">
                  <div class="boxx">
                      <div class="text">Vladimir Pasev</div>
                      <p>
                          <button class="badges owner">Owner</button>
                          <button class="badges developer">Developer</button>
                      </p>
                  </div>
            </div>


                  </div>
              </div>


              

          </div>
      </div>
  </section>


    
    <footer>
      

      <span
        >Designed by
        <a target="_blank">Vladimir Pasev</a
        ><br />
        <span
        >Front end by
        <a target="_blank">Svetoslav Petrov</a
        ><br />Copyright <span class="far fa-copyright"></span> P-PRO <3 2023</span
      >
    </footer>

    <script src="script.js"></script>


    <script>
      $(window).on("load", function() {
        $(".loader-wrapper").fadeOut("slow");
      });
    </script>

    <script src="./particles/particles.js"></script>
    <script src="./particles/app.js"></script>
    <script src="./aos/aos.js"></script>

    <script type="text/javascript">
      AOS.init({
        duration: 1000
      });
    </script>
  </body>
</html>
