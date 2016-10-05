<?php
/**
 * Share template
 */

global $devn_wishlist, $devn;

if( !is_user_logged_in() ) { return; }

if( $devn->cfg['wl_facebook'] == 1 || $devn->cfg['wl_twitter'] == 1 || $devn->cfg['wl_pinterest'] == 1 )
    { echo DEVN_WISHLIST_UI::get_share_links( $devn_wishlist->get_wishlist_url() . '&user_id=' . get_current_user_id() ); }