<div class = "edgtf-portfolio-filter-holder <?php echo esc_attr($masonry_filter)?>">
	<div class = "edgtf-portfolio-filter-holder-inner">
		<?php 
		$rand_number = rand();
		if(is_array($filter_categories) && count($filter_categories)){ ?>
		<ul>
			<?php if($type == 'masonry' || $type == 'pinterest' || $type == 'masonry-with-space'){ ?>
				<li class="filter" data-filter="*"><span><?php  print __('All', 'edge-cpt')?></span></li>
			<?php } else{ ?>
				<li data-class="filter_<?php print $rand_number ?>" class="filter_<?php print $rand_number ?>" data-filter="all"><span><?php  print __('All', 'edge-cpt')?></span></li>
			<?php } ?>
			<?php foreach($filter_categories as $cat){				
				if($type == 'masonry' || $type == 'pinterest' || $type == 'masonry-with-space'){?>
					<li data-class="filter" class="filter" data-filter = ".portfolio_category_<?php print $cat->term_id  ?>">
						<span>
							<?php print $cat->name ?>
						</span>
					</li>
				<?php }else{ ?>
					<li data-class="filter_<?php print $rand_number ?>" class="filter_<?php print $rand_number ?>" data-filter = ".portfolio_category_<?php print $cat->term_id  ?>">
					<span>
						<?php print $cat->name ?>
					</span>
				</li>
			<?php }} ?>
		</ul> 
		<?php }?>
	</div>		
</div>