<?php
/**
 * Team info on hover shortcode template
 */
?>

<div <?php fair_edge_class_attribute($team_classes);?>>
	<div class="edgtf-team-inner">
		<?php if ( $team_image !== '' ) { ?>
		<div class="edgtf-team-image">
            <?php echo wp_get_attachment_image($team_image,'full');?>
			<div class="edgtf-team-social-holder">
				<div class="edgtf-team-social">
					<div class="edgtf-team-social-inner">
						<div class="edgtf-team-title-holder">
							<?php if ( $team_name !== '' ) { ?>
							<<?php echo esc_attr($team_name_tag); ?> class="edgtf-team-name">
								<?php echo esc_attr( $team_name ); ?>
							</<?php echo esc_attr($team_name_tag); ?>>
							<?php }
							if ( $team_position !== '' ) { ?>
							<p class="edgtf-team-position">
								<?php echo esc_attr( $team_position ); ?>
							</p>
							<?php } ?>
						</div>
						<?php if ($team_description !== '') { ?>
							<div class="edgtf-team-text">
								<div class="edgtf-team-text-inner">
									<div class="edgtf-team-description">
										<p><?php echo esc_attr( $team_description ); ?></p>
									</div>
								</div>
							</div>
						<?php } ?>
						<?php if(!empty($team_social_icons)) : ?>
							<div class="edgtf-team-social-wrapp">
								<?php foreach( $team_social_icons as $team_social_icon ) {
									print $team_social_icon;
								} ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
</div>