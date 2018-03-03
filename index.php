<?php
$config = include('./src/config.php'); 
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, target-densitydpi=device-dpi">
    <title>Faucet - Recordskeeper</title>
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.png">

    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href = "assets/css/style.css" rel="stylesheet">
    <script type= "text/javascript">
    var expUrl = "<?php echo $config['exp_url'] ?>";
    var timed = <?php echo $config['time'] ?>;
    </script>
  </head>

  <body>
  <!-- prelaoder spins here -->
    <div class="se-pre-con"></div>
  <!-- prelaoder spins here -->

 <!-- header here  -->
        <header id="top">
        <p id="logo">
          <img class="img-responsive img-align" src="assets/images/logo.png">
        </p>
        <nav id="skip">
          
        </nav>
        <nav id="nav">
         <!--  <ul>
            <label id="togglecontlabel">TestNetwork</label>
          </ul>  -->
        </nav>
      </header>
<!-- header ends here  -->
<div class="clearfix"></div>
    <!-- Page Content -->
    
    <div class="container faucetcontainer">
      <div class="bodyHeadText text-center">RecordsKeeper (XRK) Testnet Faucet</div>
    <div class="bodyDetails text-center">This faucet drips three RecordsKeeper Testnet XRK in your wallet.<br> These testnet XRK can be used for development and testing process over RecordsKeeper Blockchain (Testnet).</div>
    <div class="waysHeading text-center">
      How to get the RecordsKeeper Testnet XRK?</div>
      <ol id="align-setting">
<li class= "indexed"> First, you need a RecordsKeeper testnet wallet Address! If you don't have one, please <a href="https://wallet.recordskeeper.co" target="_blank">click here</a> to create.</li>
<li class= "indexed"> Enter the test wallet Address over here and recieve 3 testnet XRK!</li>
<li class= "indexed"> Use it in your development to publish your records in RecordsKeeper's Blockchain (Testnet)!</li>
<li class= "indexed"> You can get another shot of Testnet XRK once again after 12 hours only!</li>
      </ol>
        <div class="row">
          <div class="col-lg-offset-3 col-lg-6">
            <div class="input-group">
              <input type="text" id="address" class="form-control" placeholder="Enter your address">
              <span class="input-group-btn">
                <button id="send" class="btn btn-default" type="button">Send me Testnet XRK</button>
              </span>
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
        <div class="row">
            <div class="">
                <div id="html_element"></div>
            </div>
        </div>
    </div>
<hr class="hrwallet">
    <div class="footer ">
      <div class="footerHeading">Don't have a wallet??? </div>
      <button id="toWallet" class="btn btn-default" type="button" onclick="window.location.href='http://wallet.recordskeeper.co'">Click here</button>
    </div>

<div id="" class="footerdiv"> 
<ul class="link-style">
  <li><a id="web" href="https://recordskeeper.co">Website</a></li>
  <li> <a class="blog" href="https://www.recordskeeper.co/blog/" target="_blank">Blog</a></li>
  <li><a class="testExplorer" href="https://test-exp.recordskeeper.co" target="_blank">Testnet Explorer</a></li>
  <li><a class="mainExplorer" href="http://exp.recordskeeper.co/" target="_blank">Mainnet Explorer</a></li>
  <li><a class="demo" href="http://demo.recordskeeper.co" target="_blank">Demos</a></li>
  <li><a class="stats" href="http:/stats.recordskeeper.co" target="_blank">Blockchain Statistcs</a></li>
</ul>
</div>

       
      
       
       
       
       
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.all.min.js"></script>
   <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
        async defer>
    </script>
    <script src="assets/js/faucet.js?j"></script>

  </body>

</html>