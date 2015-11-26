<?php
/**
 * @package WordPress
 * @subpackage Chunk
 */
?>
	<?php
		/* A sidebar in the footer? Yep. You can can customize
		 * your footer with widgets. Arranged in three per row.
		 */
		get_sidebar( 'footer' );
	?>

	<footer id="footer">
		<a href="http://www.gnu.org/copyleft/gpl.html" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/gpl3.png" alt="GPL3 - Free as in Freedom" /></a><br />
		[<a href="https://github.com/misfist/patricialutz.com" target="_blank">Source</a>]
	</footer>

</div>

<?php wp_footer(); ?>

</body>
</html>