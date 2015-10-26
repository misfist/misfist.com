<?php
/**
 * @package gridz
 */
?>
<?php
    if(!is_active_sidebar('sidebar-2') && !is_active_sidebar('sidebar-3') && !is_active_sidebar('sidebar-4'))
        return;
?>
<div id="footer-widget-area" <?php gridz_footer_widget_class(); ?>>
    <?php if(is_active_sidebar('sidebar-2')):?>
    <div id="first" class="widget-area" role="complementary">
        <?php dynamic_sidebar('sidebar-2'); ?>
    </div><!-- #first .widget-area -->
    <?php endif; ?>

    <?php if(is_active_sidebar('sidebar-3')):?>
    <div id="second" class="widget-area" role="complementary">
        <?php dynamic_sidebar('sidebar-3'); ?>
    </div><!-- #second .widget-area -->
    <?php endif; ?>

    <?php if(is_active_sidebar('sidebar-4')):?>
    <div id="third" class="widget-area" role="complementary">
        <?php dynamic_sidebar('sidebar-4'); ?>
    </div><!-- #third .widget-area -->
    <?php endif; ?>
</div>