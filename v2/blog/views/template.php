<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <link rel='stylesheet' type='text/css' href='<?= BASE_URL ?>assets/css/bootstrap.min.css'/>        
    <link rel='stylesheet' type='text/css' href='<?= BASE_URL ?>assets/css/jquery-ui.min.css'/>
    <link rel='stylesheet' type='text/css' href='<?= BASE_URL ?>assets/css/jquery-ui.theme.min.css'/>
    <link rel='stylesheet' type='text/css' href='<?= BASE_URL ?>assets/css/style.css'/>
    <link rel='stylesheet' type='text/css' href='<?= BASE_URL ?>assets/css/fontawesome.min.css'/>
    <link rel='stylesheet' type='text/css' href='<?= BASE_URL ?>assets/css/fontawesome-5/css/all.min.css'/>   
  </head>

  <body>                              

      <?php  $this->loadViewInTemplate($viewName, $viewData); ?>  


    <script type='text/javascript' src='<?= BASE_URL ?>assets/js/jquery-3.2.1.min.js'></script>
    <script type='text/javascript' src='<?= BASE_URL ?>assets/js/bootstrap.min.js'></script>
    <script type='text/javascript' src='<?= BASE_URL ?>assets/js/jquery-ui.min.js'></script>
    <script type='text/javascript' src='<?= BASE_URL ?>assets/js/script.js'></script>
    <script type='text/javascript' src='<?= BASE_URL ?>assets/js/notify.min.js'></script>    
  </body>
</html>
