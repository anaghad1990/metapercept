<?php if($query_results->max_num_pages>1){ ?>
	<div class="edgtf-ptf-list-paging">
		<span class="edgtf-ptf-list-load-more">
			<?php 
				echo fair_edge_get_button_html(array(
					'link' => 'javascript: void(0)',
					'text' => 'Show more'
				));
			?>
		</span>
	</div>
<?php }