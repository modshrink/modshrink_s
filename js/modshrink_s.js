jQuery(document).ready(function($){

	// モバイルビューのメニュー折りたたみ
	$(function(){
		$(".mobile-nav-toggle").click(function() {
			$("#site-navigation .menu").toggleClass("show")
		});
	});

	// <time>挿入用クイックタグ
	$( '#qt_content_time_tag_add_quicktags' ).click( function() {
		//var select = $( '' ).val();
		$( '#dialog-' + select ).dialog( 'open' );
	} );


});