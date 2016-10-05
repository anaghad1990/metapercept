!function($) {
	
}(window.jQuery);

function devn_shortcode_setIcon( id ){
	jQuery( '#'+id ).val( event.target.title ).focus();
}
function devn_shortcode_hideIcon( id ){
	jQuery( '#'+id ).get(0).hideTimer = setTimeout(function(){
		jQuery( '#'+id ).css({
			height: '0px',
			padding: '0px',
			border: 'none'
		});
	}, 300 );	
}
function devn_shortcode_showIcon( id ){
	
	clearTimeout( jQuery( '#'+id ).get(0).hideTimer );
	
	jQuery( '#'+id ).css({
		height: '100px',
		padding: '15px 9px',
		border: '1px solid #ccc'
	});
}