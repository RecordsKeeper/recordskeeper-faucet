
/////////////////////////////////
   // Recordskeeper Faucet 	  //
  // Shuchi Tyagi			 //
 // Toshblocks innovations  //
/////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////////////////////


$(document).ready(function(){
		 // Animate loader off screen
		   $(".se-pre-con").fadeOut("slow");  // fadeout the preloader

});







function sendXRK(){
    
    jQuery.post("../rk-faucet/php/send.php", { "address": address})
        .done(function(data) {
            if(data.success){
                console.log("Transaction ID",data.result);
                jQuery('#address').val('');
                swal({
                    type: 'success',
                    title: data.result,
                    showConfirmButton: false,
                    timer: 1500
                  })
            }
            else{
                console.log("Could not process request");
                console.log(data);
                jQuery('#address').val('');
                swal({
                    type: 'error',
                    title: 'Please try again!',
                    showConfirmButton: false,
                    timer: 1500
                  })
            }

        });
            
}
jQuery(document).ready(function() {
    document.getElementById('send').addEventListener('click', function(e) {
        address = jQuery('#address').val();
        if(address!=''){
            sendXRK();
        }      
        else{
            $('#address').css('border', '1px solid #ea2121')
        } 
    });
});




//----------------------------------------------------/
  // onloadCallback()
  // this 
  //----------------------------------------------------/

 var onloadCallback = function() {
        grecaptcha.render('html_element', {    // oncallback render a div with id html_element
          'sitekey' : '6Lc1CEMUAAAAADxvB2vR6rxjD4D2T2EyVJmgkKUS', // sitekey for the  captcha 
          'theme' : 'light',           // change the theme for light and dark
          'widgetId': 'widgetId',      // add widget id attribute which is optional
          callback(){
            console.log( 'another callback function here');
            var response = grecaptcha.getResponse();    // get the value of response when user submits recaptcha
            console.log('response from google : ', response);
          
            // send post method to captcha php that is usin curl post request for cross domain
             $.post("captcha.php",
                    {
                      googleResponse: response     // pass the google response
                     
                    },
                      function(response, status){   // pass two parameters respnse  and status 
                           console.log("response after ssv : ", response, status); 

                           if ( status == 'success'){
                             captchaSuccess = status;
                            console.log("captchaSuccess :", captchaSuccess);
                            

                           }
                           // alert response and the status here after verification from google 
                      });
            }
        });
    };
