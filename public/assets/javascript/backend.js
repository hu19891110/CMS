/*
 * Backend Javascript File
 */

$(document).ready (function() {
    $('#alert-area').bind('contentchanged', function() {
        alert('Content Changed');
        window.setTimeout(function () {
            $(".autoClose").delay(5000).fadeTo(2000, 500).slideUp(500, function () {
                $(".autoClose").alert('close');
            });
        });
    });
});