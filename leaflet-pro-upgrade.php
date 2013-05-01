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
$lmm_pro_readme = WP_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'leaflet-maps-marker-pro' . DIRECTORY_SEPARATOR . 'readme.txt';
//2do testing - remove - $lmm_pro_readme = WP_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'antispam-bee' . DIRECTORY_SEPARATOR . 'readme.txt';
$action = isset($_POST['action']) ? $_POST['action'] : '';
if ( $action != NULL ) {
	if (!wp_verify_nonce( $_POST['_wpnonce'], 'pro-upgrade-nonce') ) { wp_die('<br/>'.__('Security check failed - please call this function from the according Leaflet Maps Marker admin page!','lmm').''); };
	if ($action == 'upgrade_to_pro_version') {
		include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
		$upgrader = new Plugin_Upgrader( new Plugin_Upgrader_Skin() );
		//2do: $upgrader->install( "https://www.mapsmarker.com/download" );
	} 
} else {
	if (!file_exists($lmm_pro_readme)) {
		echo '<h3 style="font-size:23px;">' . __('Upgrade to pro version','lmm') . '</h3>';
		echo '<form method="post"><input type="hidden" name="action" value="upgrade_to_pro_version" />';
		wp_nonce_field('pro-upgrade-nonce');
		//2do: add texts
		echo '<p>' . __('If you like using Leaflet Maps Marker, you might also be interested in starting a free 30-day-trial of Leaflet Maps Marker Pro, which offers even more features, higher performance and more. <br/>Below you find some highlights you will get when going pro (please click on the heading for more details):','lmm') . '</p>';
		echo '<p>
			<div id="accordion">
				<h3>Latest leaflet version</h3>
				<div>
				<p></p>
				</div>
				
				<h3>mobile optimized maps through use of native javascript instead of jQuery</h3>
				<div>
				<p></p>
				</div>

				<h3>remove backlinks</h3>
				<div>
				<p></p>
				</div>

				<h3>HTML5 fullscreen maps</h3>
				<div>
				<p></p>
				</div>
				
				<h3>Minimaps</h3>
				<div>
				<p></p>
				</div>

				<h3>mobile web app support for fullscreen maps</h3>
				<div>
				<p></p>
				</div>
				
				<h3>custom Google Maps styling</h3>
				<div>
				<p></p>
				</div>
				
				<h3>QR codes with custom backgrounds thanks to Visualead.com</h3>
				<div>
				<p></p>
				</div>

				<h3>upload icon button & custom icon directory</h3>
				<div>
				<p></p>
				</div>
				
				<h3>Google Adsense for maps integration</h3>
				<div>
				<p>Nam enim risus, molestie et, porta ac, aliquam ac, risus. Quisque lobortis. Phasellus pellentesque purus in massa. Aenean in pede. Phasellus ac libero ac tellus pellentesque semper. Sed ac felis. Sed commodo, magna quis lacinia ornare, quam ante aliquam nisi, eu iaculis leo purus venenatis dui. </p>
				<ul>
					<li>- ' . __('a','lmm') . '</li>
					<li>- ' . __('b','lmm') . '</li>
					<li>- ' . __('b','lmm') . '</li>
					<li>- ' . __('c','lmm') . '</li>
				</ul>
				</div>

				<h3>backup and restore of settings</h3>
				<div>
				<p></p>
				</div>

			</div>
				<script type="text/javascript">
					(function($) {
						$(document).ready(function(){
							$( "#accordion" ).accordion({
								active: "false",
								icons: { header: "ui-icon-circle-arrow-e", activeHeader: "ui-icon-circle-arrow-s" },
								heightStyle: "content",
								collapsible: "true"
							});
						})
					})(jQuery);
				</script>
				</p>';
		echo '<p>' . __('For more details, showcases and reviews please also visit <a href="http://www.mapsmarker.com">www.mapsmarker.com</a>','lmm') . '</p>';
		echo '<p>' . sprintf(__('To start your free 30-day-trial of Leaflet Maps Marker Pro, please click on the button "start installation" below. This will start the download of Leaflet Maps Marker Pro from <a href="%1s">%2s</a> and installation as a separate plugin.<br/>Afterwards please activate the pro plugin and you will be guided through the process to receive a free 30-day-trial license without any obligations. Your trial will expire automatically unless you purchase a valid pro license. You can also switch back to the free version at any time.','lmm'), 'http://www.mapsmarker.com/download', 'www.mapsmarker.com/download') . '</p>';
		if ( current_user_can( 'install_plugins' ) ) {
			$submit_button = ' class="submit button-primary"';
		} else {
			function hide_email($email) { $character_set = '+-.0123456789@ABCDEFGHIJKLMNOPQRSTUVWXYZ_abcdefghijklmnopqrstuvwxyz'; $key = str_shuffle($character_set); $cipher_text = ''; $id = 'e'.rand(1,999999999); for ($i=0;$i<strlen($email);$i+=1) $cipher_text.= $key[strpos($character_set,$email[$i])]; $script = 'var a="'.$key.'";var b=a.split("").sort().join("");var c="'.$cipher_text.'";var d="";'; $script.= 'for(var e=0;e<c.length;e++)d+=b.charAt(a.indexOf(c.charAt(e)));'; $script.= 'document.getElementById("'.$id.'").innerHTML="<a href=\\"mailto:"+d+"\\">"+d+"</a>"'; $script = "eval(\"".str_replace(array("\\",'"'),array("\\\\",'\"'), $script)."\")"; $script = '<script type="text/javascript">/*<![CDATA[*/'.$script.'/*]]>*/</script>'; return '<span id="'.$id.'">[javascript protected email address]</span>'.$script; }
			$submit_button = ' class="submit button-secondary" disabled="disabled"';
			echo '<div class="error" style="padding:10px;"><strong>' . sprintf(__('Warning: your user does not have the capability to install new plugins - please contact your administrator (%1s)','lmm'), hide_email(get_bloginfo('admin_email')) ) . '</strong></div>';
		}
		echo '<input style="font-weight:bold;" type="submit" name="submit_upgrade_to_pro_version" value="' . __('start installation','lmm') . ' &raquo;" ' . $submit_button . ' /></form>';
	} else if (file_exists($lmm_pro_readme)) {
		echo '<h3 style="font-size:23px;">' . __('Upgrade to pro version','lmm') . '</h3>';
		echo '<div class="error" style="padding:10px;"><strong>' . __('You already downloaded "Leaflet Maps Marker Pro" to your server but did not activate the plugin yet!','lmm') . '</strong></div>';
		if ( current_user_can( 'install_plugins' ) ) {
			echo sprintf(__('Please navigate to <a href="%1$s">Plugins / Installed Plugins</a> and activate the plugin "Leaflet Maps Marker Pro".','lmm'), LEAFLET_WP_ADMIN_URL . 'plugins.php');
		} else {
				function hide_email($email) { $character_set = '+-.0123456789@ABCDEFGHIJKLMNOPQRSTUVWXYZ_abcdefghijklmnopqrstuvwxyz'; $key = str_shuffle($character_set); $cipher_text = ''; $id = 'e'.rand(1,999999999); for ($i=0;$i<strlen($email);$i+=1) $cipher_text.= $key[strpos($character_set,$email[$i])]; $script = 'var a="'.$key.'";var b=a.split("").sort().join("");var c="'.$cipher_text.'";var d="";'; $script.= 'for(var e=0;e<c.length;e++)d+=b.charAt(a.indexOf(c.charAt(e)));'; $script.= 'document.getElementById("'.$id.'").innerHTML="<a href=\\"mailto:"+d+"\\">"+d+"</a>"'; $script = "eval(\"".str_replace(array("\\",'"'),array("\\\\",'\"'), $script)."\")"; $script = '<script type="text/javascript">/*<![CDATA[*/'.$script.'/*]]>*/</script>'; return '<span id="'.$id.'">[javascript protected email address]</span>'.$script; }
			echo sprintf(__('Please contact your administrator (%1s) to activate the plugin "Leaflet Maps Marker Pro".','lmm'), hide_email(get_bloginfo('admin_email')) );
		}
	}
}
?>
</div>
<!--wrap-->