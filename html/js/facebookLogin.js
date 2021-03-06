var FacebookLogin = {

    initLoginButton: function () {
        $('.btn.btn-facebook').click(function (e) {
            e.preventDefault();

            FB.login(function (response) {
                if (response.authResponse) {
                    console.log('Welcome!  Fetching your information.... ');
                    //var access_token = response.authResponse.accessToken;

                    FB.api('/me', {fields: 'name, email, first_name, last_name'}, function (response) {
                        FacebookLogin.sendFBDataToParse(response.email);

                            document.getElementById('status-facebook').innerHTML =
                                'Hetkel sisseloginud Facebooki kasutaja: <br>' +
                                'Nimi: ' + response.name + '<br>' +
                                'Eesnimi: ' + response.first_name + '<br>' +
                                'Perekonnanimi: ' + response.last_name + '<br>' +
                                'Email: ' + response.email + '<br>';
                        }
                    );
                }
                else {
                    console.log('User cancelled login or did not fully authorize.');
                }
            });
        });
    },

    sendFBDataToParse: function (email) {
        var user_id = $('#user_id').text();
        var base_url = $('head base').attr('href');

        $.ajax({
            type: 'post',
            url: base_url + 'idcard_auth.php?action=sendFBDataToParse',
            data: {user_id: user_id, email: email},
            dataType: 'json',
            success: function (result) {
                console.log(result);
            }
        });
    }
};


// This is called with the results from from FB.getLoginStatus().
//function statusChangeCallback(response) {

//    console.log('statusChangeCallback');
//    console.log(response);
//    // The response object is returned with a status field that lets the
//    // app know the current login status of the person.
//    // Full docs on the response object can be found in the documentation
//    // for FB.getLoginStatus().
//    if (response.status === 'connected') {
//        // Logged into your app and Facebook.
//        testAPI();
//    } else if (response.status === 'not_authorized') {
//        // The person is logged into Facebook, but not your app.
//        document.getElementById('status-facebook').innerHTML = 'Please log ' +
//            'into this app.';
//    } else {
//        // The person is not logged into Facebook, so we're not sure if
//        // they are logged into this app or not.
//        document.getElementById('status-facebook').innerHTML = 'Please log ' +
//            'into Facebook.';
//    }
//}

// This function is called when someone finishes with the Login
// Button.  See the onlogin handler attached to it in the sample
// code below.

//function checkLoginState() {
//    FB.getLoginStatus(function (response) {
//        statusChangeCallback(response);
//    });
//}

window.fbAsyncInit = function () {
    FB.init({
        appId: '1002839423108383',
        cookie: true,  // enable cookies to allow the server to access
                       // the session
        xfbml: true,  // parse social plugins on this page
        version: 'v2.2' // use version 2.2
    });

    // Now that we've initialized the JavaScript SDK, we call
    // FB.getLoginStatus().  This function gets the state of the
    // person visiting this page and can return one of three states to
    // the callback you provide.  They can be:
    //
    // 1. Logged into your app ('connected')
    // 2. Logged into Facebook, but not your app ('not_authorized')
    // 3. Not logged into Facebook and can't tell if they are logged into
    //    your app or not.
    //
    // These three cases are handled in the callback function.

    //FB.getLoginStatus(function (response) {
    //    statusChangeCallback(response);
    //});

};

(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.5&appId=1002839423108383";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

// Load the SDK asynchronously
(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));