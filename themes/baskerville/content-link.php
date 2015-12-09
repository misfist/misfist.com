<?php $link_url = get_post_meta($post->ID, 'link_url', true); ?>
<?php $link_title = get_post_meta($post->ID, 'link_title', true); ?>

<div class="post-header">
	
    <h2 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
    
    <?php if( is_sticky() ) { ?> <span class="sticky-post"><?php _e('Sticky post', 'baskerville'); ?></span> <?php } ?>
    
</div> <!-- /post-header -->

<div class="post-link">
	
	<?php
		
		// Fetch post content
		$content = get_post_field( 'post_content', get_the_ID() );
		
		// Get content parts
		$content_parts = get_extended( $content );
		
		// Output part before <!--more--> tag
		echo $content_parts['main'];
	
	?>

</div> <!-- /post-link -->

<?php if($post->post_content != "") : ?>
									                                    	    
	<div class="post-excerpt">
		
		<?php 
			if ($pos=strpos($post->post_content, '<!--more-->')) {
				echo  '<p>' . mb_strimwidth($content_parts['extended'], 0, 200, '...') . '</p>';
			} else {
				the_excerpt('100');
			}
		?>
	
	</div> <!-- /post-excerpt -->

<?php endif; ?>
									                                    	    
<?php baskerville_meta(); ?>
            
<div class="clear"></div>