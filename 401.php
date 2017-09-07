<!DOCTYPE html>
<html>
  <head>
    <title>Unauthorized access</title>
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
        <a href="#" class="brand-logo">Unauthorized access</a>
      </div>
      <div class="nav-content">
        <ul class="tabs tabs-transparent">
          <li class="tab"><a class="active" href="#home">Home</a></li>
          <li class="tab"><a href="#headers">Headers</a></li>
        </ul>
      </div>
    </nav>
    <div class="container">
      <div id="home" class="col s12">
        <h5><?php echo $_SERVER['OIDC_CLAIM_name']; ?> is not unauthorized to access the <?php echo $_SERVER['REQUEST_URI']; ?> page.</h5>
        <div class="divider"></div>
      </div>
      <div id="headers" class="col s12">
        <h5>Details</h5>
        <ul class="collection with-header">
          <li class="collection-header"><h4>Headers</h4></li>
          <?php
            foreach (getallheaders() as $name => $value) {
              echo "<li class='collection-item'><strong>$name</strong>: $value</li>";
            }
          ?>
        </ul>
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
