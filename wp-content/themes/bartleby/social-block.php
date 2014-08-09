<?php global $bartleby_options; $bartleby_settings = get_option( 'bartleby_options', $bartleby_options ); ?>
<div id="social-bar">
<?php if ( $bartleby_settings['facebook_link'] !='' ) { ?>
<a href="<?php echo $bartleby_settings['facebook_link']; ?>">
<i class="icon-facebook icon-large"></i>
</a>
<?php } ?>
<?php if ( $bartleby_settings['twitter_link'] !='' ) { ?>
<a href="<?php echo $bartleby_settings['twitter_link']; ?>">
<i class="icon-twitter icon-large"></i>
</a>
<?php } ?>
<?php if ( $bartleby_settings['gplus_link'] !='' ) { ?>
<a href="<?php echo $bartleby_settings['gplus_link']; ?>">
<i class="icon-google-plus icon-large"></i>
</a>
<?php } ?>
<?php if ( $bartleby_settings['linkedin_link'] !='' ) { ?>
<a href="<?php echo $bartleby_settings['linkedin_link']; ?>">
<i class="icon-linkedin icon-large"></i>
</a>
<?php } ?>
<?php if ( $bartleby_settings['github_link'] !='' ) { ?>
<a href="<?php echo $bartleby_settings['github_link']; ?>">
<i class="icon-github icon-large"></i>
</a>
<?php } ?>
<?php if ( $bartleby_settings['pinterest_link'] !='' ) { ?>
<a href="<?php echo $bartleby_settings['pinterest_link']; ?>">
<i class="icon-pinterest icon-large"></i>
</a>
<?php } ?>
<?php if ( $bartleby_settings['feed_link'] !='' ) { ?>
<a href="<?php echo $bartleby_settings['feed_link']; ?>"><i class="icon-rss icon-large"></i>
</a>
<?php } ?>
</div>