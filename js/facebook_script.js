/**
 * Created by Harshdeep on 15-08-2015.
 */

window.fbAsyncInit = function() {
    FB.init({
        appId      : '1595920830681773', // replace your app id here
        channelUrl : 'http://localhost/login/',
        status     : true,
        cookie     : true,
        xfbml      : true
    });
};
(function(d){
    var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement('script'); js.id = id; js.async = true;
    js.src = "//connect.facebook.net/en_US/all.js";
    ref.parentNode.insertBefore(js, ref);
}(document));

function FBLogin(){
    FB.login(function(response){
        if(response.authResponse){
            window.location.href = "actions.php?action=fblogin";
        }
    }, {scope: 'email,user_likes'});
}