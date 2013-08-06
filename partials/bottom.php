<?php
/**
 * BOTTOM SIDEBAR
 */
?>
<div id="bottom" class="row">
	<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'Bottom' ) ) : ?>
    <?php endif; ?>
</div>