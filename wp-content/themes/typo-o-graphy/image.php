<?php get_header(); ?>
<div class="container" id="wrapper"> 
    <div class="wp-pagenavi sixteen columns">
        <div class="alignleft">
            <?php previous_image_link(false, __('&larr; Previous', 'typo-o-graphy')); ?>
        </div>
        <div class="alignright">
            <?php next_image_link(false, __('Next &rarr;', 'typo-o-graphy')); ?>
        </div>
    </div>   
	<div class="sixteen columns">
		<?php if ( have_posts() ) while ( have_posts() ) : the_post();
		?>
		<div <?php post_class('post'); ?>>	
			<div class="entry-content">
				<?php the_title('<h1>', '</h1>'); ?>
								<?php
                                $metadata = wp_get_attachment_metadata();
                                printf(__('<p>Published <time datetime="%1$s">%2$s</time> in <a href="%3$s" title="Return to %4$s" rel="gallery">%5$s</a>.</p>', 'typo-o-graphy'), esc_attr(get_the_date('c')), esc_html(get_the_date()), esc_url(get_permalink($post -> post_parent)), esc_attr(strip_tags(get_the_title($post -> post_parent))), get_the_title($post -> post_parent));
							?>				
				<div class="entry-attachment">
					<?php if ( wp_attachment_is_image() ) :
	$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
	foreach ( $attachments as $k => $attachment ) {
		if ( $attachment->ID == $post->ID )	break; } $k++; 
	if ( count( $attachments ) > 1 ) {
		if ( isset( $attachments[ $k ] ) )
			$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
		else $next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID ); } else {
		$next_attachment_url = wp_get_attachment_url();	}
					?>
					<p>
						<a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr(get_the_title()); ?>" rel="attachment"><?php
                        $attachment_size = apply_filters('', 900);
                        echo wp_get_attachment_image($post -> ID, array($attachment_size, 9999));
						?></a>
					</p>
					<?php else : ?>
					<a href="<?php echo wp_get_attachment_url(); ?>" title="<?php echo esc_attr(get_the_title()); ?>" rel="attachment"><?php echo basename(get_permalink()); ?></a>
					<?php endif; ?>

					<div class="entry-caption">
						<?php
                        if (!empty($post -> post_excerpt))
                            the_excerpt();
						?>
					</div>
					<?php the_content(__('Continue reading &rarr;', 'typo-o-graphy')); ?>
					<?php wp_link_pages(); ?>
				</div>
			</div>
		</div>
		<?php endwhile; ?>
	</div>
	<div class="eleven columns">
		<?php comments_template(); ?>
	</div>
	<div class="four columns">
<?php
$metadata = wp_get_attachment_metadata();

echo "<ul class=\"entry-meta\">\n";
if ($metadata['image_meta']['title'])
    printf(__('<li>Title: %s </li>', 'typo-o-graphy'), ($metadata['image_meta']['title']));
if ($metadata['image_meta']['caption'])
    printf(__('<li>Caption: %s </li>', 'typo-o-graphy'), ($metadata['image_meta']['caption']));
if ($metadata['image_meta']['copyright'])
    printf(__('<li>Copyright: %s </li>', 'typo-o-graphy'), ($metadata['image_meta']['copyright']));
if ($metadata['image_meta']['credit'])
    printf(__('<li>Credit: %s </li>', 'typo-o-graphy'), ($metadata['image_meta']['credit']));
if ($metadata['image_meta']['camera'])
    printf(__('<li>Camera: %s </li>', 'typo-o-graphy'), ($metadata['image_meta']['camera']));
if ($metadata['image_meta']['aperture'])
    printf(__('<li>Aperture: %s </li>', 'typo-o-graphy'), ($metadata['image_meta']['aperture']));
if ($metadata['image_meta']['focal_length'])
    printf(__('<li>Focal Length: %s </li>', 'typo-o-graphy'), ($metadata['image_meta']['focal_length']));
if ($metadata['image_meta']['iso'])
    printf(__('<li>ISO: %s </li>', 'typo-o-graphy'), ($metadata['image_meta']['iso']));
if ($metadata['image_meta']['shutter_speed'])
    printf(__('<li>Shutter Speed: %s s.</li>', 'typo-o-graphy'), number_format($metadata['image_meta']['shutter_speed'], 4));
if ($metadata['width'])
    printf(__('<li>Full size is %s pixels</li>', 'typo-o-graphy'), sprintf('<a href="%1$s" title="%2$s">%3$s &times; %4$s</a>', wp_get_attachment_url(), esc_attr(__('Link to full-size image', 'typo-o-graphy')), $metadata['width'], $metadata['height']));
echo "</ul>";

edit_post_link(__('Edit', 'typo-o-graphy'));
				?>
	</div>
</div>
<?php get_footer(); ?>
