<?php

include "Class_Publication.php";
include "publications_data.php";

$regions = [];
$types = [];

// Add filter categories for drop-down menu
foreach($publications as $outlet => $data){

      // Do not include if already in array
     if(in_array($data->region, $regions) == false) {
      
       // Add region to array to be iterated for options boxes
        array_push($regions, $data->region);
      }
      // Publication type - tabloid, agency, broadsheet
        // Do not include if already in array
      if(in_array($data->type, $types) == false) {
      // Add type to array to be iterated for options boxes
        array_push($types, $data->type);
      }
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.98.0">
    <title>Front Page</title>

    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    
    
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
      <div class="row">
        <div class="col-12 col-md-6">
    <!-- Options/Filters -->
        <div class="accordion accordion-flush" id="accordionFlushExample">
          <div class="accordion-item">
              <h2 class="accordion-header" id="flush-headingOne">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
              Options
             </button>
             <div id="flush-collapseOne" class="accordion-collapse collapse p-3" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="row">
                  <div class="col-12">
                       <h6 class="mb-0 mt-3 fw-bold">Regions</h6>
                  </div>
                    <div class="col-12">
                      <?php 
                        foreach($regions as $region) {
                          echo "<div class='form-check form-check-inline'>
                                  <input class='form-check-input' type='checkbox' id='inlineCheckbox2' data-type='region' value=$region>
                                  <label class='form-check-label' for='inlineCheckbox2'>$region</label>
                                </div>";
                        }                  
                      ?>
                    </div>
                </div>

                <div class="row">
                  <div class="col-12">
                      <h6 class="mb-0 mt-3 fw-bold">Type</h6>
                  </div>
                  <div class="col-12">
                  <?php 
                      foreach($types as $type) {
                        echo "<div class='form-check form-check-inline'>
                                <input class='form-check-input' type='checkbox' id='inlineCheckbox2' data-type='type' value=$type>
                                <label class='form-check-label' for='inlineCheckbox2'>$type</label>
                              </div>";
                      }                  
                  ?>
                  </div>
                </div>

                <div class="row">
                  <div class="col-12">
                      <h6 class="mb-0 mt-3 fw-bold">Paywall</h6>
                  </div>
                  <div class="col-12">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="inlineCheckbox1" data-type='paywall' value="false">
                      <label class="form-check-label" for="inlineCheckbox1">Free</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="inlineCheckbox2" data-type='paywall' value="true">
                      <label class="form-check-label" for="inlineCheckbox2">Subscription</label>
                    </div>
                  </div>
                </div>
          <!-- Dropdown for # articles -->
                <div class="row mb-0 mt-3">
                  <div class="col-3">
                      <label for="art-num fw-bold">No. articles</label>
                  </div>
                  <div class="col">
                    <select name="articles" id="num-articles">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5" selected>5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                      <option value="10">10</option>
                    </select>
                  </div>
                </div>
          <!-- Dropdown for # articles -->
 
              </div>
            </div>
          </div>
        </div>
        <!-- End of Options/Filters -->

        <div class="row row-cols-4 row-cols-sm-2 row-cols-md-5 justify-content-center g-3">
            <?php
              foreach($publications as $outlet => $data) {
                  echo "<div class='col mx-2 my-4 p-1 outlet-logo' data-name=$outlet data-region=$data->region data-type=$data->type data-paywall= $data->paywall>
                  <div class='card shadow-sm btn-outline-secondary' data-name=$outlet>
                  <svg xmlns='http://www.w3.org/2000/svg' width='25' height='25' fill='currentColor' class='bi bi-plus-circle-fill unselected-icon' viewBox='0 0 16 16'>
                      <path d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z'/>
                    </svg>
                    <img class='bd-placeholder-img card-img-top' src=' " . $data->logo . "' width='100%' height='225' role='img' aria-label='Placeholder: Thumbnail' preserveAspectRatio='xMidYMid slice' focusable='false'>
        
                    <div class='card-body bg-light px-0'>
                      <p class='pub-title card-text text-center text-break'><strong>" . $data->pub_name . "</strong></p>                  
                    </div>
                  </div>
                </div>";
              }
            ?>
        </div>
        <div class="row">
            <div class="d-grid gap-2">
                <button id="get-news" class="btn btn-primary" type="button">Get News</button>
            </div>
        </div>    
      </div>      
  </div>
</main>

<footer class="text-muted py-5">
  <div class="container">
    <p class="float-end mb-1">
      <a href="#">Back to top</a>
    </p>
    <p class="mb-1">&copy; brian-ess.com</p>
  </div>
</footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <script src="logic.js" crossorigin="anonymous" defer></script>    
</body>
</html>