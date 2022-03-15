<?php
     ini_set('display_errors', 0);
     ini_set('display_startup_errors', 0);
    $weather = "";
    $error = "";
     
    if ($_GET['city']) {
         
     $urlContents = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".urlencode($_GET['city'])."&appid=04cb7d18aa8cf4d2c9a6f0de0e27f4b9");
         
        $weatherArray = json_decode($urlContents, true);
         
        if ($weatherArray['cod'] == 200) {
            $tempInCelcius = intval($weatherArray['main']['temp'] - 273);
            $weather = "<b>".$weatherArray['name'].", ".$weatherArray['sys']['country']." : ".$tempInCelcius."&deg;C </b> <br>";
 
 
            $weather .= " <b>Weather Condition : </b> ".$weatherArray['weather'][0]['description']."<br>";
            $weather .= " <b>Atmospheric Pressure : </b>".$weatherArray['main']['pressure']." hPa <br>"; 
            $weather .= " <b>Wind Speed : </b>".$weatherArray['wind']['speed']." meters/sec <br>"; 
            $weather .= " <b>Cloudness : </b>".$weatherArray['clouds']['all']." % <br>"; 

            date_default_timezone_set('Africa/Accra');
            $sunrise = $weatherArray['sys']['sunrise'];
            $weather .= " <b>Sunrise : </b>" .date("F j, Y, g:i:a, $sunrise");
        } else {
             
            $error = "Could not find city - please try again.";
             
        }
         
    }
    
 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css"
        integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">

    <title>Weather App</title>
</head>
<style>
html {
    background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url(background.jpg) no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}

body {

    background: none;
    color: #fafafa;
    font-family: 'Rajdhani'
}

h1 {
    font-size: 3rem;
    font-weight: 600;
}

.container {

    text-align: center;
    margin-top: 100px;
    width: 450px;

}

input {

    margin: 20px 0;

}

#weather {

    margin-top: 15px;

}
</style>

<body>
    <div class="container">

        <h1>What's The Weather?</h1>



        <form>
            <fieldset class="form-group">
                <label for="city">Enter the name of a city.</label>
                <input type="text" class="form-control" name="city" id="city" placeholder="Eg. Tamale, Kumasi"
                    value="<?php echo $_GET['city']; ?>">
            </fieldset>

            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <div id="weather"><?php
               
              if ($weather) {
                   
                  echo '<div class="alert alert-success" role="alert">
  '.$weather.'
</div>';
                   
              } else if ($error) {
                   
                  echo '<div class="alert alert-danger dismissable" role="alert">
  '.$error.'
</div>';
                   
              }
               
              ?></div>
    </div>

    <!-- jQuery first, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js"
        integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous">
    </script>
</body>

</html>