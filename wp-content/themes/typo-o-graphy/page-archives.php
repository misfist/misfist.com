<?php /**
 * Template Name: Archives
 *  */
?>
<?php get_header(); ?>
<section class="container" id="wrapper">
	<article class="eleven columns">
		<div <?php post_class('post') ?> >
			<div class="meta-description">
				<?php the_title('<h1>', '</h1>'); ?>
			</div>
			<div class="post-content">
				<ul>
	<?php
$sticky = get_option( 'sticky_posts' );
$day_check = '';
$args = array('posts_per_page' => 656, 'post__not_in' => $sticky );
query_posts($args);
while (have_posts()) : the_post();
  $day = get_the_date('m');
  if ($day != $day_check) {
    if ($day_check != '') {
      echo '</ul></li>'; 
    }
    echo '<li>'. get_the_date('F Y') . '<ul>';
  }
?>
<li><a href="<?php the_permalink() ?>"><?php echo get_the_date(); ?> - <i><?php the_title(); ?></i></a></li>
<?php
$day_check = $day;
endwhile; ?>
				</ul>
			</div>
		</div>
	</article>
	<?php get_sidebar(); ?>
</section>
<?php get_footer(); ?>