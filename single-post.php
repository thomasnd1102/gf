<?php
get_header();

if ( have_posts() ) {
	while ( have_posts() ) : the_post();
		$post_id = get_the_ID();
		$sidebar_position = ct_get_sidebar_position( $post_id );
		$content_class = 'post-content';
		if ( 'no' != $sidebar_position ) $content_class .= ' col-md-9';
		
		$header_img_scr = ct_get_header_image_src( $post_id );
		if ( ! empty( $header_img_scr ) ) {
			$header_img_height = ct_get_header_image_height( $post_id );
			$header_content = get_post_meta( $post_id, '_header_content', true );
			?>

			<section class="parallax-window" data-parallax="scroll" data-image-src="<?php echo esc_url( $header_img_scr ) ?>" data-natural-width="1400" data-natural-height="<?php echo esc_attr( $header_img_height ) ?>">
				<div class="parallax-content-1">
					<?php echo balancetags( $header_content ); ?>
				</div>
			</section><!-- End section -->
			<div id="position">

		<?php } else { ?>
			<div id="position" class="blank-parallax">
		<?php } ?>

			<div class="container"><?php ct_breadcrumbs(); ?></div>
		</div><!-- End Position -->

		<div class="container margin_60">
			<div class="<?php if ( 'no' != $sidebar_position ) echo 'row' ?>">
				<?php if ( 'left' == $sidebar_position ) : ?>
					<aside class="col-md-3 add_bottom_30"><?php generated_dynamic_sidebar(); ?></aside><!-- End aside -->
				<?php endif; ?>

				<div class="<?php echo esc_attr( $content_class ); ?>">
					<div class="box_style_1">
						<div class="post nopadding">
							<?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'full', array('class' => 'img-responsive') ); } ?>
							<div class="post_info clearfix">
								<div class="post-left">
									<ul>
										<li><i class="icon-calendar-empty"></i><?php echo esc_html__( 'On', 'citytours' ) ?> <span><?php echo get_the_date(); ?></span></li>
										<li><i class="icon-inbox-alt"></i><?php echo esc_html__( 'In', 'citytours' ) ?> <?php the_category( ' ' ); ?></li>
										<li><i class="icon-tags"></i><?php echo esc_html__( 'Tags', 'citytours' ) ?> <?php the_tags(); ?></li>
									</ul>
								</div>
								<div class="post-right"><i class="icon-comment"></i><?php comments_number(); ?></div>
							</div>
							<h2><?php the_title(); ?></h2>
							<?php the_content(); ?>
							<?php wp_link_pages('before=<div class="page-links">&after=</div>'); ?>
						</div><!-- end post -->
					</div><!-- end box_style_1 -->

					<?php if ( comments_open() || get_comments_number() ) {
						comments_template();
					} ?>

				</div><!-- End col-md-9-->

				<?php if ( 'right' == $sidebar_position ) : ?>
					<aside class="col-md-3 add_bottom_30"><?php generated_dynamic_sidebar(); ?></aside><!-- End aside -->
				<?php endif; ?>

			</div><!-- End row-->
		</div><!-- End container -->


<?php endwhile;
}
get_footer();