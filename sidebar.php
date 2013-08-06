<?php
/**
 * MAIN SIDEBAR
 */
?>
<div id="sidebar" class="col-4">
	<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'Sidebar' ) ) : ?>
    <?php endif; ?>
</div>