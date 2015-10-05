<?php
/**
 * @package gridz
 */
?>
    </div> <!-- End of content wrapper -->
</div> <!-- End of content -->
<footer id="footer">
    <div class="wrapper">
        <?php if(!is_404()) get_sidebar('footer'); ?>
        <div id="footer-credits">
            <?php gridz_footer_credit(); ?>
        </div>
    </div>
</footer>
<a id="scroll-up" href="javascript:void(0)"><span class="genericon-uparrow"></span></a>
<?php wp_footer(); ?>
</body>
</html>