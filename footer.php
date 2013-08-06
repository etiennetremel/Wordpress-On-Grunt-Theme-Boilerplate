        <div id="footer" class="site-footer">
            <div id="copyright" class="span6">
                <?php
                if ( function_exists( 'the_theme_setting' ) )
                    the_theme_setting( 'footer_copyright' );
                ?>
            </div>
            <nav id="footer-menu" class="span6">
                <?php wp_nav_menu_inline( 'footer' ); ?>
            </nav>
        </div>
    </div><!-- #site -->

    <?php wp_footer(); ?>

</body>
</html>