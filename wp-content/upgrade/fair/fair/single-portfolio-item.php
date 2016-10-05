<?php

get_header();
fair_edge_get_title();
get_template_part('slider');
fair_edge_single_portfolio();
do_action('fair_edge_after_container_close');
get_footer();

?>