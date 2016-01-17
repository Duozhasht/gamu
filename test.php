<?php
echo "ola";
?>
<div id="fb-root">
	<div class="fb-like" data-href="https://www.facebook.com/GAMUPLC" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
</div>


<button type="button" id="teste">Teste</button>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript">
$( document ).ready(function(){
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '416205255235739',
      xfbml      : true,
      version    : 'v2.5'
    });
  };
};





	$('#teste').click(function(){
		FB.login(function(response) {
   		if (response.authResponse) {
     		var access_token =   FB.getAuthResponse()['accessToken'];
     		console.log('Access Token = '+ access_token);
     		
     		FB.api('/https://graph.facebook.com/{147794082264093}?fields=access_token', function(response) {
     			console.log('Good to see you, ' + response.name + '.');
     		});
   		} 
   		else {
     		console.log('User cancelled login or did not fully authorize.');
   		}
 	}, {scope: ''});
	
	});

</script>