<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package kia
 */

?>

	<!--Footer Section-->
	<footer class="footer section pt-80 pb-80" id="footer">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="footer-logo d-flex align-items-center">
						<svg class="left-icon d-block f-light">
							<use xlink:href="<?php echo get_template_directory_uri(); ?>/dist/images/dist/sprite.svg#kia-logo-new"></use>
						</svg>
						<span class="divider divider-md"></span>
						<span class="footer-title"><?php the_field('site_name', 'options'); ?></span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="footer-menu">
						<div class="footer-block lg">
							<?php
							wp_nav_menu( [
								'theme_location' => 'footer-menu-1',
								'container' => false,
								'menu_class' => 'footer-menu-item'
							] );
							?>
						</div>
						<div class="footer-block">
							<div class="footer-block-heading">
								Авто
							</div>
							<?php
							wp_nav_menu( [
								'theme_location' => 'footer-menu-2',
								'container' => false,
								'menu_class' => 'footer-menu-item'
							] );
							?>
						</div>
						<div class="footer-block">
							<div class="footer-block-heading">
								Покупателям
							</div>
							<?php
							wp_nav_menu( [
								'theme_location' => 'footer-menu-3',
								'container' => false,
								'menu_class' => 'footer-menu-item'
							] );
							?>
						</div>
						<div class="footer-block">
							<div class="footer-block-heading">
								Владельцам
							</div>
							<?php
							wp_nav_menu( [
								'theme_location' => 'footer-menu-4',
								'container' => false,
								'menu_class' => 'footer-menu-item'
							] );
							?>
						</div>
						<div class="footer-block right-block">
							<ul>
								<li>
									<?php the_field('address', 'options') ?>
								</li>
								<li>
									<a href="#" class="active">
										<?php the_field('phone', 'options') ?>
									</a>
								</li>
								<li>
									<a href="#">
										Мы в социальных сетях
									</a>
									<?php if( have_rows('socials', 'options') ): ?>
									<div class="footer-social">
										<?php while ( have_rows('socials', 'options') ): the_row();
										$sub_value = get_sub_field('social_item');?>
										<a href="<?php echo esc_attr($sub_value['link']) ?>">
											<svg class="inline-svg-icon">
												<use xlink:href="<?php echo get_template_directory_uri(); ?>/dist/images/dist/sprite.svg#<?php echo esc_attr($sub_value['icon']) ?>"></use>
											</svg>
										</a>
										<?php endwhile;?>
									</div>
									<?php endif; ?>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="footer-info d-flex align-items-center">
						<div class="footer-text col-lg-9">
							<p>
								© <?= date('Y') ?> <?= get_field('footer_copyrights', 'options') ?>
							</p>
						</div>
						<div class="footer-btn d-flex justify-content-center align-items-center col-lg-3">
							<div class="btn-wrapper btn-wrapper-lg btn-wrapper-black">
								<a href="<?= get_site_url() ?>/callback" class="btn btn-black btn-lg">
									Заказать звонок
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
</div><!-- #page -->
<?= get_field('footer_scripts', 'options') ?>
<?php wp_footer(); ?>
</body>
</html>
