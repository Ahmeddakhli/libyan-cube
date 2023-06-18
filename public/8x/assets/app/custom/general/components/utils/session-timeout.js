"use strict";

var KTSessionTimeoutDemo = function () {

    var initDemo = function () {
        $.sessionTimeout({
            title: global_translations.session_timeout_notification,
            message: global_translations.your_session_is_about_to_expire,
            keepAliveUrl: global_variables.app_keepalive_url,
            redirUrl: global_variables.app_logout_url,
            logoutUrl: global_variables.app_logout_url,
            warnAfter: 1200000, //warn after 20m
            redirAfter: 60000, //redirect after 1m 
            ignoreUserActivity: false,
            logoutButton: global_translations.logout,
            keepAliveButton: global_translations.stay_connected,
            countdownMessage: global_translations.redirecting_in + '{timer} ' + global_translations.seconds,
            countdownBar: true
        });
    }

    return {
        //main function to initiate the module
        init: function () {
            initDemo();
        }
    };

}();

jQuery(document).ready(function() {    
    KTSessionTimeoutDemo.init();
});