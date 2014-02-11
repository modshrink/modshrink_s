jQuery(function() {
    jQuery("a").click(function(e) {
        var ahref = jQuery(this).attr('href');
        if (ahref.indexOf("fanblogs.jp/oands") != -1 || ahref.indexOf("http") == -1 ) {
            _gaq.push(['_trackEvent', 'Inbound Links', 'Click', ahref]);
        }
        else {
            _gaq.push(['_trackEvent', 'Outbound Links', 'Click', ahref]);
        }
    });
});