<?php
/**
 * MAIN SIDEBAR
 */
?>
<div id="sidebar" class="span4">
	<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'Sidebar' ) ) : ?>
    <?php endif; ?>
</div>