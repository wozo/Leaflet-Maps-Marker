<?php
/*
    Pro Upgrade - Leaflet Maps Marker Plugin
*/
//info prevent file from being accessed directly
if (basename($_SERVER['SCRIPT_FILENAME']) == 'leaflet-pro-upgrade.php') { die ("Please do not access this file directly. Thanks!<br/><a href='http://www.mapsmarker.com/go'>www.mapsmarker.com</a>"); }
?>
<div class="wrap">
	<?php include('inc' . DIRECTORY_SEPARATOR . 'admin-header.php'); ?>
<?php
	global $wpdb;
	$mm_pro_name = 'antispam-bee';

	if ( $action = $_POST['action'] ) {
		if (!wp_verify_nonce( $_POST['_wpnonce'], 'pro-upgrade-nonce') ) { wp_die('<br/>'.__('Security check failed - please call this function from the according Leaflet Maps Marker admin page!','lmm').''); };

		if ($action == 'upgrade_to_pro_version') {
			$upgrade_confirm_checkbox = isset($_POST['upgrade_confirm_checkbox']) ? '1' : '0';
		  	if ($upgrade_confirm_checkbox == 1) {
					if ( current_user_can( 'install_plugins' ) ) {
						include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
						$upgrader = new Plugin_Upgrader( new Plugin_Upgrader_Skin() );
						$upgrader->install( "https://www.mapsmarker.com/downloads/{$mm_pro_name}.zip" );
					}
			} else {
				echo '<p><div class="error" style="padding:10px;">' . __('Please confirm that you want to start a free 30 day trial period by checking the checkbox','lmm') . '</div><br/><a class="button-secondary" href="' . LEAFLET_WP_ADMIN_URL . 'admin.php?page=leafletmapsmarker_pro_upgrade">' . __('Back to Pro Upgrade page', 'lmm') . '</a></p>';
			}
  		}
	} else {
?>
	<h3 style="font-size:23px;"><?php _e('Upgrade to pro version','lmm'); ?></h3>
		<form method="post">
			<input type="hidden" name="action" value="upgrade_to_pro_version" />
			<?php wp_nonce_field('pro-upgrade-nonce'); ?>
			<p>Want to have even more features? Upgrade to pro version now. this will download the pro plugin from www.mapsmarker.com and start a free 30 day trial.</p>

			<p>Your admin user email (<em><?php echo get_option('admin_email'); ?></em>) will be used for creating a user account on mapsmarker.com - this is needed for the trial license.</p>

			<p><em>You can switch back to the free version any time.</p>

			<p><strong>2DO: update text.</strong></p>

			
			<?php 
				if ( current_user_can( 'install_plugins' ) ) {
					$submit_button = ' class="submit button-primary"';
					echo '<input type="checkbox" id="upgrade_confirm_checkbox" name="upgrade_confirm_checkbox" /> <label for="upgrade_confirm_checkbox">' . __('I agree','lmm') . '</label><br/>';
				} else {
					function hide_email($email) { $character_set = '+-.0123456789@ABCDEFGHIJKLMNOPQRSTUVWXYZ_abcdefghijklmnopqrstuvwxyz'; $key = str_shuffle($character_set); $cipher_text = ''; $id = 'e'.rand(1,999999999); for ($i=0;$i<strlen($email);$i+=1) $cipher_text.= $key[strpos($character_set,$email[$i])]; $script = 'var a="'.$key.'";var b=a.split("").sort().join("");var c="'.$cipher_text.'";var d="";'; $script.= 'for(var e=0;e<c.length;e++)d+=b.charAt(a.indexOf(c.charAt(e)));'; $script.= 'document.getElementById("'.$id.'").innerHTML="<a href=\\"mailto:"+d+"\\">"+d+"</a>"'; $script = "eval(\"".str_replace(array("\\",'"'),array("\\\\",'\"'), $script)."\")"; $script = '<script type="text/javascript">/*<![CDATA[*/'.$script.'/*]]>*/</script>'; return '<span id="'.$id.'">[javascript protected email address]</span>'.$script; } 
					$submit_button = ' class="submit button-secondary" disabled="disabled"';
					echo '<div class="error" style="padding:10px;"><strong>' . sprintf(__('Warning: your user does not have the capability to install new plugins - please contact your administrator (%1s)','lmm'), hide_email(get_bloginfo('admin_email')) ) . '</strong></div>';
				}
			?>
			<input style="font-weight:bold;" type="submit" name="submit_upgrade_to_pro_version" value="<?php _e('start installation','lmm') ?> &raquo;" <?php echo $submit_button; ?> />
		</form>
</div>
<!--wrap-->
<?php }
include('inc' . DIRECTORY_SEPARATOR . 'admin-footer.php');
?>