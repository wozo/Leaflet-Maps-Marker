<?php
/*
    Pro Upgrade - Leaflet Maps Marker Plugin
*/
//info prevent file from being accessed directly
if (basename($_SERVER['SCRIPT_FILENAME']) == 'leaflet-pro-upgrade.php') { die ("Please do not access this file directly. Thanks!<br/><a href='http://www.mapsmarker.com/go'>www.mapsmarker.com</a>"); }
?>
<div class="wrap">
<?php 
include('inc' . DIRECTORY_SEPARATOR . 'admin-header.php'); 
//$lmm_pro_readme = WP_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'leaflet-maps-marker-pro' . DIRECTORY_SEPARATOR . 'readme.txt';
$lmm_pro_readme = WP_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'antispam-bee' . DIRECTORY_SEPARATOR . 'readme.txt';
//if (!file_exists($lmm_pro_readme)) {
	$action = isset($_POST['action']) ? $_POST['action'] : '';
	if ( $action != NULL ) {
		if (!wp_verify_nonce( $_POST['_wpnonce'], 'pro-upgrade-nonce') ) { wp_die('<br/>'.__('Security check failed - please call this function from the according Leaflet Maps Marker admin page!','lmm').''); };
		if ($action == 'upgrade_to_pro_version') {
			echo 'upgrader startet...';
			include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
			$upgrader = new Plugin_Upgrader( new Plugin_Upgrader_Skin() );
			//$upgrader->install( "https://www.mapsmarker.com/download" );
		} else if ( $action == 'activate-pro-plugin') {
			echo 'activate plugin';	
			//activate_plugin('leaflet-maps-marker-pro/leaflet-maps-marker.php', $redirect = 'plugins.php?activate=true');
		}
	} else {
	?>
		<h3 style="font-size:23px;"><?php _e('Upgrade to pro version','lmm'); ?></h3>
			<form method="post">
				<input type="hidden" name="action" value="upgrade_to_pro_version" />
				<?php wp_nonce_field('pro-upgrade-nonce'); ?>
				<p><?php _e('Einleitungstext - teaser-hinweis','lmm'); ?></p>
				<p>
				<ul>
					<li>- <?php _e('a','lmm'); ?></li>
					<li>- <?php _e('b','lmm'); ?></li>
					<li>- <?php _e('b','lmm'); ?></li>
					<li>- <?php _e('c','lmm'); ?></li>
				</ul>
				</p>
				<p><?php _e('Link zu pro page','lmm'); ?></p>

				<?php
					if ( current_user_can( 'install_plugins' ) ) {
						$submit_button = ' class="submit button-primary"';
					} else {
						function hide_email($email) { $character_set = '+-.0123456789@ABCDEFGHIJKLMNOPQRSTUVWXYZ_abcdefghijklmnopqrstuvwxyz'; $key = str_shuffle($character_set); $cipher_text = ''; $id = 'e'.rand(1,999999999); for ($i=0;$i<strlen($email);$i+=1) $cipher_text.= $key[strpos($character_set,$email[$i])]; $script = 'var a="'.$key.'";var b=a.split("").sort().join("");var c="'.$cipher_text.'";var d="";'; $script.= 'for(var e=0;e<c.length;e++)d+=b.charAt(a.indexOf(c.charAt(e)));'; $script.= 'document.getElementById("'.$id.'").innerHTML="<a href=\\"mailto:"+d+"\\">"+d+"</a>"'; $script = "eval(\"".str_replace(array("\\",'"'),array("\\\\",'\"'), $script)."\")"; $script = '<script type="text/javascript">/*<![CDATA[*/'.$script.'/*]]>*/</script>'; return '<span id="'.$id.'">[javascript protected email address]</span>'.$script; }
						$submit_button = ' class="submit button-secondary" disabled="disabled"';
						echo '<div class="error" style="padding:10px;"><strong>' . sprintf(__('Warning: your user does not have the capability to install new plugins - please contact your administrator (%1s)','lmm'), hide_email(get_bloginfo('admin_email')) ) . '</strong></div>';
					}
				?>
				<input style="font-weight:bold;" type="submit" name="submit_upgrade_to_pro_version" value="<?php _e('start installation','lmm') ?> &raquo;" <?php echo $submit_button; ?> />
			</form>
			
			<p><?php echo sprintf(__('You can also download the pro plugin package manually at <a href="%1$s" target="_blank">%1$s</a>','lmm'), 'http://www.mapsmarker.com/download'); ?></p>
			
<?php 
	} 
//} else {
	echo '<p>' . __('You already downloaded the pro plugin package but did not activate the plugin yet.','lmm') . '</p>';
	echo '<form method="post">' . wp_nonce_field('pro-upgrade-nonce') . '<input type="hidden" name="action" value="activate-pro-plugin" />';
	echo '<input style="font-weight:bold;" type="submit" name="activate-pro-plugin" value="' . __('activate pro plugin','lmm') . ' &raquo;" class="submit button-primary" /></form>';
//}
?>
</div>
<!--wrap-->