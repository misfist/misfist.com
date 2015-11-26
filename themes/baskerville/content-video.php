<div class="post-header">
	
    <h2 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
    
    <?php if( is_sticky() ) { ?> <span class="sticky-post"><?php _e('Sticky post', 'baskerville'); ?></span> <?php } ?>
    
</div> <!-- /post-header -->

<?php if ($pos=strpos($post->post_content, '<!--more-->')): ?>

	<div class="featured-media">
	
		<?php
				
			// Fetch post content
			$content = get_post_field( 'post_content', get_the_ID() );
			
			// Get content parts
			$content_parts = get_extended( $content );
			
			// oEmbed part before <!--more--> tag
			$embed_code = wp_oembed_get($content_parts['main']); 
			
			echo $embed_code;
		
		?>
	
	</div> <!-- /featured-media -->

<?php endif; ?>

<div class="post-excerpt">
	
	<?php 
		if ($pos=strpos($post->post_content, '<!--more-->')) {
			echo  '<p>' . mb_strimwidth($content_parts['extended'], 0, 200, '...') . '</p>';
		} else {
			the_excerpt('100');
		}
	?>

</div> <!-- /post-excerpt -->

<?php baskerville_meta(); ?>		                                    	    
            
<div class="clear"></div>