<?php
/*
Template Name: Home
*/
?>

<?php get_header(); ?>

 <?php
/**
 * Detect plugin
 */
if ( ! function_exists( 'is_plugin_active_for_network' ) )
    require_once( ABSPATH . '/wp-admin/includes/plugin.php' );

?> 

			<main id="page-content">
				<div id="main" class="" role="">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

						<!-- <header class="article-header">
							<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
						</header> -->

						<section class="entry-content clearfix" itemprop="articleBody">
							<?php the_content(); ?>
						</section>

						<footer class="article-footer">
							<?php the_tags( '<span class="tags">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '' ); ?>
						</footer>

						<?php// comments_template(); ?>
					</article>

					<?php $sites = wp_get_sites('offset=1'); // Set up variable that holds array of sites ?>

					<section class="network-listings">

						<div class="sites-list">
							<header class="sites-list-header">
								<h2>Network Sites</h2>
							</header>
							<?php
							foreach ($sites as $site) {
								$site_id = $site['blog_id'];
								$site_details = get_blog_details($site_id);

								if(function_exists('community_get_site_image')) {
									$header = community_get_site_image($site_id);
								}
								?>

							<article id="site-<?php echo $site_id; ?>" itemscope class="site-entry">
								<header>
									<h3 class="site-title" itemprop="site-name"><a href="<?php echo $site_details->path; ?>" title="<?php echo $site_details->blogname; ?>"><?php echo $site_details->blogname; ?></a>
									</h3>
									<?php
										if($header) {
									?>
									<a href="<?php echo $site_details->path; ?>" title="<?php echo $site_details->blogname; ?>" class="item-image <?php if(!$header) { echo 'no-image'; } ?>" ><img src="<?php echo $header; ?>"></a>
									<?php } ?>
								</header>
								<section class="site-body">
									<?php
										switch_to_blog($site_id);
										$site_description = get_bloginfo( 'description' );
									?>
									<div class="site-description"><?php echo $site_description; ?></div>
									<?php restore_current_blog(); ?>
								</section>
								<footer class="post-meta">
									<div class="post-date date">
										<span class="modified-title">Last updated</span> <time><?php echo date_i18n(get_option('date_format') ,strtotime($site_details->last_updated));?></time>
									</div>
								</footer>
							</article>
							<?php } ?>
						</div>

						<div class="posts-list">
						<?php
						if(function_exists( 'network_latest_posts' )) {

							$parameters = array(
							'title'         => 'Network Posts',
							'title_link'    => '',
							'title_only'    => 'false',
							'auto_excerpt'  => 'true',
							'full_meta'		=> 'true',
							// 'category'         => 'news',
							'number_posts'     => 10,
							'wrapper_list_css' => 'news-list',
							'wrapper_block_css'=> 'module row news', //The wrapper classe
							'instance'         => 'news-module', //The wrapper ID
							'thumbnail' 		=> 'true',
							'ignore_blog' 		=> '3, 1',
							'use_pub_date' 		=> 'true',
							'excerpt_length'	=> 150,
							);
							// Execute
							$recent_posts = network_latest_posts($parameters);
						}
						?>
		
						</div>
					</section>

					<?php endwhile; else : ?>

							<article id="post-not-found" class="hentry clearfix">
								<header class="article-header">
									<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
								</header>
								<section class="entry-content">
									<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
								</section>
								<footer class="article-footer">
										<p><?php _e( 'This is the error message in the page.php template.', 'bonestheme' ); ?></p>
								</footer>
							</article>

					<?php endif; ?>

				</div>

				<?php// get_sidebar(); ?>

			</main>

			<?php
				// echo "<pre>";
				// var_dump($site_details);
				// echo "</pre>";
			?>



<?php get_footer(); ?>
