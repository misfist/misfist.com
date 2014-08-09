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

	<div id="footer">
		<a href="http://creativecommons.org/licenses/by-nc-sa/3.0/legalcode" target="_blank"><img src="http://i.creativecommons.org/l/by-nc-sa/3.0/88x31.png" alt="Creative Commons - Non-commercial, Share alike" /></a><br />
		[<a href="https://github.com/misfist/patricialutz.com" target="_blank">Source</a>]
	</div>

</div>

<?php wp_footer(); ?>

</body>
</html>