<?php

include "functions.php";

if(isset($_GET['pub0'])) {
  $pub_request = get_pubs($_GET, $publications);
}
else {
    header("Location: http://localhost/newsrack/index.php");
}

// Set number of articles
if(isset($_GET["art-num"]) && $_GET["art-num"] !== 5) {
  $num_articles = $_GET["art-num"];
} 
else {
  $num_articles = 5;
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
      <meta name="generator" content="Hugo 0.98.0">
      <title>Results</title>

      <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/album/">

      <link rel="stylesheet" href="style.css">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

      <style>
          a {
              text-decoration: none;
          }
        .bd-placeholder-img {
          font-size: 1.125rem;
          text-anchor: middle;
          -webkit-user-select: none;
          -moz-user-select: none;
          user-select: none;
        }

        @media (min-width: 768px) {
          .bd-placeholder-img-lg {
            font-size: 3.5rem;
          }
        }

        .b-example-divider {
          height: 3rem;
          background-color: rgba(0, 0, 0, .1);
          border: solid rgba(0, 0, 0, .15);
          border-width: 1px 0;
          box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
          flex-shrink: 0;
          width: 1.5rem;
          height: 100vh;
        }

        .bi {
          vertical-align: -.125em;
          fill: currentColor;
        }

        .nav-scroller {
          position: relative;
          z-index: 2;
          height: 2.75rem;
          overflow-y: hidden;
        }

        .nav-scroller .nav {
          display: flex;
          flex-wrap: nowrap;
          padding-bottom: 1rem;
          margin-top: -1px;
          overflow-x: auto;
          text-align: center;
          white-space: nowrap;
          -webkit-overflow-scrolling: touch;
        }
      </style>    
  </head>
  <body>
  <header>
  <div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container">
      <a href="#" class="navbar-brand d-flex align-items-center">
      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-newspaper" viewBox="0 0 16 16">
          <path d="M0 2.5A1.5 1.5 0 0 1 1.5 1h11A1.5 1.5 0 0 1 14 2.5v10.528c0 .3-.05.654-.238.972h.738a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 1 1 0v9a1.5 1.5 0 0 1-1.5 1.5H1.497A1.497 1.497 0 0 1 0 13.5v-11zM12 14c.37 0 .654-.211.853-.441.092-.106.147-.279.147-.531V2.5a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0-.5.5v11c0 .278.223.5.497.5H12z"/>
          <path d="M2 3h10v2H2V3zm0 3h4v3H2V6zm0 4h4v1H2v-1zm0 2h4v1H2v-1zm5-6h2v1H7V6zm3 0h2v1h-2V6zM7 8h2v1H7V8zm3 0h2v1h-2V8zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1z"/>
      </svg>
        <strong id="logo">Front Page</strong>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </div>
</header>

<main>
  <section id="header-banner" class="mx-0 py-5 text-center">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 id="header-text" class="fs-1 p-2 text-center">Front Page</h1>
        <p id="slogan" class="lead">All the news on one page</p>
      </div>
    </div>
  </section>

  <div class="album py-5 bg-light">
    <div class="container">
        <!-- <div class="row"> -->
        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-2 g-3 justify-content-center">
          <?php
          foreach($pub_request as $outlet) {
            echo 
            "<div class='col col-md-4 col-lg-4 m-md-3 m-md-3 p-4 p-md-2'>
                <div class ='card'>
                    <img src='$outlet->logo ' class='card-img-top' alt='puplication logo' style='max-width: 400px; max-height: 170px'>
                    <div class='card-body'>
                        <h3 class='card-title fw-bold text-center'>$outlet->pub_name</h3>
                    </div>
                    <ul class='list-group list-group-flush'>";                                    
                    // Articles
                    $articles = $outlet->get_articles($num_articles);
                          // Print error if articles not retrieved
                          if(array_key_exists('error', $articles)) {
                            echo "<li class='list-group-item py-3'>
                                      <p class='fw-normal px-2 mb-0'>" .  $articles['error'] . "</p>
                                  </li>"; 
                          }
                          else {
                                foreach($articles as $article) {
                                  echo "<li class='list-group-item py-3'>
                                            <a href='" .$article['link'] . "' class='mb-0 link-dark text-decoration-none'> 
                                                <p class='fw-bold px-2 mb-0'>" .  $article['headline'] . "</p> 
                                            </a>";
                                            if($outlet->paywall == "true") {
                                              echo "<p class='fw-lighter mb-0 pt-1 px-2'>PAYWALL</p>";
                                            }
                                  echo "</li>";  
                                }                                         
                              } 
                          echo 
                          "</ul>
                  </div>
              </div>";            
              }
           ?>
      </div>
    </div>
  </div>
</main>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
</body>
</html>


