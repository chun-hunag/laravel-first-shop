Skip to content
Search or jump to…

Pull requests
Issues
Marketplace
Explore
 
@chun-hunag 
Learn Git and GitHub without any code!
Using the Hello World guide, you’ll start a branch, write comments, and open a pull request.


nolimits4web
/
swiper
723
25.8k9.3k
Code
Issues
167
Pull requests
8
Discussions
Actions
Projects
Security
Insights
swiper/demos/300-thumbs-gallery.html
@nolimits4web
nolimits4web update demos
Latest commit 962e911 on 3 Jun 2020
 History
 1 contributor
122 lines (109 sloc)  3.86 KB
  
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Swiper demo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <!-- Link Swiper's CSS -->
  <link rel="stylesheet" href="../package/swiper-bundle.min.css">

  <!-- Demo styles -->
  <style>
    html,
    body {
      position: relative;
      height: 100%;
    }

    body {
      background: #000;
      font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
      font-size: 14px;
      color: #000;
      margin: 0;
      padding: 0;
    }

    .swiper-container {
      width: 100%;
      height: 300px;
      margin-left: auto;
      margin-right: auto;
    }

    .swiper-slide {
      background-size: cover;
      background-position: center;
    }

    .gallery-top {
      height: 80%;
      width: 100%;
    }

    .gallery-thumbs {
      height: 20%;
      box-sizing: border-box;
      padding: 10px 0;
    }

    .gallery-thumbs .swiper-slide {
      width: 25%;
      height: 100%;
      opacity: 0.4;
    }

    .gallery-thumbs .swiper-slide-thumb-active {
      opacity: 1;
    }
  </style>
</head>

<body>
  <!-- Swiper -->
  <div class="swiper-container gallery-top">
    <div class="swiper-wrapper">
      <div class="swiper-slide" style="background-image:url(./images/nature-1.jpg)"></div>
      <div class="swiper-slide" style="background-image:url(./images/nature-2.jpg)"></div>
      <div class="swiper-slide" style="background-image:url(./images/nature-3.jpg)"></div>
      <div class="swiper-slide" style="background-image:url(./images/nature-4.jpg)"></div>
      <div class="swiper-slide" style="background-image:url(./images/nature-5.jpg)"></div>
      <div class="swiper-slide" style="background-image:url(./images/nature-6.jpg)"></div>
      <div class="swiper-slide" style="background-image:url(./images/nature-7.jpg)"></div>
      <div class="swiper-slide" style="background-image:url(./images/nature-8.jpg)"></div>
      <div class="swiper-slide" style="background-image:url(./images/nature-9.jpg)"></div>
      <div class="swiper-slide" style="background-image:url(./images/nature-10.jpg)"></div>
    </div>
    <!-- Add Arrows -->
    <div class="swiper-button-next swiper-button-white"></div>
    <div class="swiper-button-prev swiper-button-white"></div>
  </div>
  <div class="swiper-container gallery-thumbs">
    <div class="swiper-wrapper">
      <div class="swiper-slide" style="background-image:url(./images/nature-1.jpg)"></div>
      <div class="swiper-slide" style="background-image:url(./images/nature-2.jpg)"></div>
      <div class="swiper-slide" style="background-image:url(./images/nature-3.jpg)"></div>
      <div class="swiper-slide" style="background-image:url(./images/nature-4.jpg)"></div>
      <div class="swiper-slide" style="background-image:url(./images/nature-5.jpg)"></div>
      <div class="swiper-slide" style="background-image:url(./images/nature-6.jpg)"></div>
      <div class="swiper-slide" style="background-image:url(./images/nature-7.jpg)"></div>
      <div class="swiper-slide" style="background-image:url(./images/nature-8.jpg)"></div>
      <div class="swiper-slide" style="background-image:url(./images/nature-9.jpg)"></div>
      <div class="swiper-slide" style="background-image:url(./images/nature-10.jpg)"></div>
    </div>
  </div>

  <!-- Swiper JS -->
  <script src="../package/swiper-bundle.min.js"></script>

  <!-- Initialize Swiper -->
  <script>
    var galleryThumbs = new Swiper('.gallery-thumbs', {
      spaceBetween: 10,
      slidesPerView: 4,
      freeMode: true,
      watchSlidesVisibility: true,
      watchSlidesProgress: true,
    });
    var galleryTop = new Swiper('.gallery-top', {
      spaceBetween: 10,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      thumbs: {
        swiper: galleryThumbs
      }
    });
  </script>
</body>

</html>
© 2021 GitHub, Inc.
Terms
Privacy
Security
Status
Help
Contact GitHub
Pricing
API
Training
Blog
About
