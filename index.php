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
    var tokenQuantity = <?php echo $config['token_quant'] ?>;
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
    <div class="bodyDetails text-center">This faucet drips <?php echo $config['token_quant'] ?> RecordsKeeper Testnet XRK tokens in your wallet.<br> These Testnet XRK tokens can be used for development and testing purpose on RecordsKeeper Blockchain (Testnet).</div>
    <div class="waysHeading text-center">
      How to get the RecordsKeeper Testnet XRK tokens?</div>
      <ol id="align-setting">
<li class= "indexed"> First, you need a RecordsKeeper Testnet wallet address! If you don't have one, please <a href="https://wallet.recordskeeper.co" target="_blank"><strong>click here</strong></a> to create.</li>
<li class= "indexed"> Enter the Testnet wallet address over here and recieve <?php echo $config['token_quant'] ?> Testnet XRK tokens!</li>
<li class= "indexed"> Use it in your projects to publish your records in RecordsKeeper's Blockchain (Testnet)!</li>
<li class= "indexed"> You can get another shot of Testnet XRK tokens again only after 

  <?php $cooldown = $config['time'];
  $cooldownHours = floor($cooldown / 3600);
  $cooldownMinutes = floor(($cooldown / 60) % 60);
  $cooldownSeconds = $cooldown % 60;

  if ($cooldownHours > 0) echo "$cooldownHours hour(s)";
  if ($cooldownMinutes > 0) echo " $cooldownMinutes minute(s)";
  if ($cooldownSeconds > 0) echo " $cooldownSeconds second(s)";
  echo "!"; ?>
</li>

      </ol>
        <div class="row">
          <div class="col-lg-offset-3 col-lg-6">
            <div class="input-group">
              <input type="text" id="address" class="form-control" placeholder="Enter your address">
              <span class="input-group-btn">
                <button id="send" class="btn btn-default" type="button">Send me Testnet XRK Tokens</button>
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
    <div class="footer ">
      <div class="footerHeading">Don't have a wallet??? </div>
      <button id="toWallet" class="btn btn-default" type="button" onclick="window.open('http://wallet.recordskeeper.co');">Click here</button>
    </div>
<hr class="hrwallet">
    

<div id="" class="footerdiv"> 
<ul class="link-style">
    <li>&copy; RecordsKeeper @<span class="date">2016-2018. All rights reserved</span></li>
    <li><a href="./" target="_blank">Terms</a></li>
    <li><a href="./" target="_blank">Privacy Policy</a></li>
  <li><a id="web" href="https://www.recordskeeper.co/" target="_blank">Website</a></li>
  <li> <a class="blog" href="https://www.recordskeeper.co/blog/" target="_blank">Blog</a></li>
  <li><a class="testExplorer" href="http://test-explorer.recordskeeper.co" target="_blank">Testnet Explorer</a></li>
  <li><a class="mainExplorer" href="http://explorer.recordskeeper.co/" target="_blank">Mainnet Explorer</a></li>
  <li><a class="demo" href="http://demo.recordskeeper.co" target="_blank">Demos</a></li>
  <li><a class="stats" href="http://stats.recordskeeper.co" target="_blank">Blockchain Statistcs</a></li>
  <li><a class="stats" href="http://wallet.recordskeeper.co" target="_blank">Wallet</a></li>
  <li><a class="stats" href="http://stats.recordskeeper.co" target="_blank">Miner Statistcs</a></li>
  <li><a class="stats" href="http://airdrop.recordskeeper.co" target="_blank">Airdrop</a></li>
  <li><a href="https://docs.recordskeeper.co/" target="_blank">Docs</a></li>



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
    <script src="assets/js/faucet.js?ver=0.1.0"></script>

  </body>

</html>
