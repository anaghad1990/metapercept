<?php

//top header bar
add_action('fair_edge_before_page_header', 'fair_edge_get_header_top');

//mobile header
add_action('fair_edge_after_page_header', 'fair_edge_get_mobile_header');