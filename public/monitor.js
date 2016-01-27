/**
 * Created by imake on 19/01/2016.
 */
/**
 * This monitors all AJAX calls that have an error response. If a user's
 * session has expired, then the system will return a 401 status,
 * "Unauthorized", which will trigger this listener and so prompt the user if
 * they'd like to be redirected to the login page.
 */
$(document).ajaxError(function(event, jqxhr, settings, exception) {

    if (exception == 'Unauthorized') {

        // Prompt user if they'd like to be redirected to the login page
        var redirect = confirm("You're session has expired. Would you like to be redirected to the login page?");

        // If the answer is yes
        if (redirect) {
            // Redirect
            window.location = '/login';
        }
    }
});