
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

var captchaSuccess;
 console.log("captchaSuccess :", captchaSuccess);





function sendXRK(){
    
    jQuery.post("../../src/send.php", { "address": address})
        .done(function(data) {
            if(data.result){
                console.log("Transaction ID", data.result);
                localStorage.lasttx   = Math.round(+new Date()/1000);
                jQuery('#address').val('');
                swal({
                    title:'Sent 10 XRK',
                    html: '<b>Check Transaction status here:</b> <a target="_blank" href="'+txUrl+data.result+'">'+data.result+'</a>',
                    type: 'success',
                    showConfirmButton: false,
                    timer: 15000
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
                    timer: 15000
                  })
            }

        });
            
}
jQuery(document).ready(function() {

    txUrl = "http://35.170.155.89:2750/RecordsKeeper%20Testnet/tx/";
    localStorage.lasttx = 0;

    document.getElementById('send').addEventListener('click', function(e) {
        address = jQuery('#address').val();

        var diff = Math.round(+new Date()/1000) - localStorage.lasttx;

       

        if(address ==''){
            $("#html_element").css('border', '1px solid #ea2121')
        }    
         if(captchaSuccess == undefined){
        	$("#html_element").css('border', '1px solid #ea2121')
        }  
        if(address!=''){
        	$('#address').css('border', 'none');
        }
         if(address!='' && captchaSuccess == 'success'){
         	$("#html_element").css('border', 'none')
            if((localStorage.lasttx == 0 || diff >= 43200))
                sendXRK();
        }   
        else{
            $('#address').css('border', '1px solid #ea2121');
            console.log(diff);
        } 
    });
});




//----------------------------------------------------/
  // onloadCallback()
  // this 
  //----------------------------------------------------/

 var onloadCallback = function() {
        grecaptcha.render('html_element', {    // oncallback render a div with id html_element
          'sitekey' : '6LfcOEcUAAAAAAia1cMp60bnm1PMaFrmJ808il_D', // sitekey for the  captcha 
          'theme' : 'light',           // change the theme for light and dark
          'widgetId': 'widgetId',      // add widget id attribute which is optional
          callback(){
            console.log( 'another callback function here');
            var response = grecaptcha.getResponse();    // get the value of response when user submits recaptcha
            console.log('response from google : ', response);
          
            // send post method to captcha php that is usin curl post request for cross domain
             $.post("../../src/captcha.php",
                    {
                      googleResponse: response     // pass the google response
                     
                    },
                      function(response, status){   // pass two parameters respnse  and status 

                           if ( status == 'success'){
                             captchaSuccess = status;
                            

                           }
                           // alert response and the status here after verification from google 
                      });
            }
        });
    };
