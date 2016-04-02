<?php
/**
 * Admin View: Settings
 */
if ( ! defined('ABSPATH')) {
	exit;
}
// Exit if accessed directly.
?>
<div class="wrap auto-load-next-post <?php echo $current_tab; ?>">
	<form method="post" id="mainform" action="" enctype="multipart/form-data">
		<h2 class="nav-tab-wrapper">
			<span>Auto Load Next Post v<?php echo AUTO_LOAD_NEXT_POST_VERSION; ?></span>
			<?php
				foreach ($tabs as $name => $label) {
					echo '<a href="'.admin_url('options-general.php?page='.'auto-load-next-post-settings&tab='.$name).'" class="nav-tab '.($current_tab == $name ? 'nav-tab-active' : '').'">'.$label.'</a>';
				}
				do_action('auto_load_next_post_settings_tabs');
			?>
		</h2>
		<?php
		do_action('auto_load_next_post_sections_'.$current_tab);
		do_action('auto_load_next_post_settings_'.$current_tab);
		?>
		<p class="submit">
			<input name="save" class="button-primary" type="submit" value="<?php _e('Save Changes', 'auto-load-next-post'); ?>" />
			<input type="hidden" name="subtab" id="last_tab" />
			<?php wp_nonce_field('auto-load-next-post-settings'); ?>
		</p>
	</form>
</div>
