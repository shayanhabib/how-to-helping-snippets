1.  Install the Facebook SDK on your website.

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId            : 'your-app-id',
      autoLogAppEvents : true,
      xfbml            : true,
      version          : 'v2.11'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

2.  Whitelist your domain to connect your Facebook Page to your website via the Facebook tool . Page Settings > Messenger Platform > Whitelisted Domains

3.  Add the plugin on your webpage by including a div with the following attribute in your HTML:

<div class="fb-customerchat"
 page_id="<PAGE_ID>"
 ref="<OPTIONAL_WEBHOOK_PARAM>"
 minimized="<true|false>">
</div>