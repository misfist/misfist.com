<?php
/**
 * @package WordPress
 * @subpackage Greyzed
 */
?>

<hr />
<div id="footer" role="contentinfo">
	<!-- begin widgetized footer left -->
		
	<div class="recent-foot">
	<div class="getintouch">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Left') ) : ?>		
	
	<!--REMOVED COMMENTS CODE - SITE DOESN'T ALLOW COMMENTS-->
	
	<!-- end widgetized footer left -->
	<?php endif; ?>
	</div></div>
	
	<div class="blogroll-foot">
		
		
		<!-- begin widgetized footer -->	
		
		<ul>
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Middle') ) : ?>		
		
		<H4 class="footerwidget">Blog Roll</H4>
		<?php		
		$links = wp_list_bookmarks('title_li=&categorize=0&sort_column=menu_order&echo=0');
		$bookmarks = explode('</li>', $links); 
		$links = $bookmarks;			
		$link_n = count($links) - 1;
		for ($i=0;$i<$link_n;$i++):
			if ($i<$link_n/2):
				$left = $left.''.$links[$i].'</li>';
			elseif ($i>=$link_n/2):
				$right = $right.''.$links[$i].'</li>';
			endif;
		endfor;
		?>
		<ul class="left_blogroll">
			<?php echo $left;?>
		</ul>
		<ul class="right_blogroll">
			<?php echo $right;?>
		</ul>		
	
		
		
			<?php endif; ?>
		</ul>
		
		<!-- end widgetized footer -->	
		
		</div>
		
		<!-- begin widgetized footer right -->
		
	<div class="recent-foot">
	<div class="getintouch">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Right') ) : ?>		
	
	<!--REMOVED COMMENTS CODE - SITE DOESN'T ALLOW COMMENTS-->
	
	<!-- end widgetized footer right -->
	<?php endif; ?>
	</div></div>


</div>
</div>
	
	<div class="footerlinks">
				
		<?php
			$links = get_pages('number=6&sort_column=post_date&depth=1&title_li=');
			foreach($links as $i => $page)
			$links[$i] = '&nbsp;<a href="' . get_page_link($page->ID) . '" title="' . attribute_escape(apply_filters('the_title', $page->post_title)) . '">' . apply_filters('the_title', $page->post_title) . '</a>';
			echo implode('&nbsp; | &nbsp;', $links);
		?>	

	</div>
</div>

<div id="footer-bott"><?php bloginfo('name'); ?><br />
	<a target="_blank" href="http://creativecommons.org/licenses/by-nc-sa/3.0/legalcode">
<img alt="Creative Commons - Non-commercial, Share alike" src="http://i.creativecommons.org/l/by-nc-sa/3.0/88x31.png">
</a>

<?php echo get_option("greyzed_analytics"); ?>
		<?php wp_footer(); ?>
</body>
</html>
