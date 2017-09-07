<!DOCTYPE html>
<html>
  <head>
    <title>Welcome to Ice</title>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css" media="screen,projection">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  </head>

  <body>
    <nav class="nav-extended">
      <div class="nav-wrapper">
        <a href="#" class="brand-logo">Ice Promos</a>
      </div>
    </nav>
    <div class="container">
      <div class="col s12">
        <h5>Ice Promos</h5>
        <?php
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => getenv('APIURL', true) ?: getenv('APIURL'),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "authorization: Bearer ".$_SERVER['OIDC_access_token'],
    "cache-control: no-cache"
  ),
));
$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
  $rArray = json_decode($response, true);
  foreach ($rArray as $key => $value) {
    echo "CODE: " . $value["code"] . ": " . $value["description"] . "<br>";
  }
}
        ?>
      </div>

      <div class="divider"></div>

    </div>

    <footer class="page-footer">
      <div class="footer-copyright">
        <div class="container">Footer.</div>
      </div>
    </footer>

    <!--jQuery and materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('select').material_select();
        $(".button-collapse").sideNav();
      });
    </script>
  </body>
</html>
