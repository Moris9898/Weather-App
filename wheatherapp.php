<?php
  if(array_key_exists('submit', $_GET)) {
    if(!($_GET['city'])) {
      $error ="Sorry Input Field is Empty";
    } if($_GET['city']) {
      $apidata = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=" . $_GET['city'] . 
          "&appid=e798086216e5d634fd709778c6dec968");
      $weatherarray = json_decode($apidata, true);
      $tempCel =$weatherarray['main']['temp'] - 273;
      $weather = "<b> " .$weatherarray['name'] . ", " .
        $weatherarray['sys']['country'] . ": " . $tempCel . " C°</b> <br>";
      $weather .= "<b>Weather Condition:</b> " .  $weatherarray['weather'][0]['description'] . "<br>";
      $weather .= "<b>Pression:</b> " .  $weatherarray['main']['pressure'] . "hPa<br>";
      $weather .= "<b>Wind Speed:</b> " .  $weatherarray['wind']['speed'] . "m/s<br>";
      $sunrise = $weatherarray['sys']['sunrise'];
      $weather .= "<b>sunrise:</b> " .  date("g:i a", $sunrise) . "<br>";
      $weather .= "<b>Current Time:</b> " .  date("F j, Y, g:i a", $sunrise) . "<br>";

    }
  }
?>
<!doctype html>
<html lang="ar" dir="ltr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.rtl.min.css"  
      integrity="sha384-WJUUqfoMmnfkBLne5uxXj+na/c7sesSJ32gI7GfCk4zO4GthUKhSEGyvQ839BC51" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">
    <title>Weather App</title>
  </head>
  <body>
    <div class="all-content">
      <div class="container">
        <div class="box">
            <h1 class="text-white fw-bold mb-3">Weather App</h1>
            <form action="" method="GET">
              <p class="text-center text-white-50">Tap Your City Or Country</p>
              <input type="text" name="city" class="mb-2" autocomplete="off">
              <input type="submit" value="Search" name="submit" class="btn btn-success" placeholder="City Name">
              <div class="output mt-3">
                <?php
                if(isset($weather)) {
                  echo "<div class='alert alert-light' role='alert'>" . 
                        $weather . 
                      "</div>";
                }
                if(isset($error)) {
                  echo "<div class='alert alert-warning'>" . $error . "</div>";
                } ?> 
              </div>
            </form>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>