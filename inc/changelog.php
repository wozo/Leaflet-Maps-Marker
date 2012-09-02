<?php 
//info prevent file from being accessed directly
if (basename($_SERVER['SCRIPT_FILENAME']) == 'changelog.php') { die ("Please do not access this file directly. Thanks!<br/><a href='http://www.mapsmarker.com/go'>www.mapsmarker.com</a>"); }

if (get_option('leafletmapsmarker_update_info') == 'show') {
	$lmm_version_old = get_option( 'leafletmapsmarker_version_before_update' );
	$lmm_version_new = get_option( 'leafletmapsmarker_version' );
	$lmm_changelog_new_version = '<a href="http://www.mapsmarker.com/v' . $lmm_version_new . '" target="_blank">http://www.mapsmarker.com/v' . $lmm_version_new . '</a>';
	$lmm_full_changelog = '<a href="http://www.mapsmarker.com/changelog" target="_blank">http://www.mapsmarker.com/changelog</a>';
	echo '<div class="updated" style="padding:10px;">
		<p><span style="font-weight:bold;font-size:125%;">' . sprintf(__('Leaflet Maps Marker has been successfully updated from version %1s to %2s!','lmm'), '2.7.1', '2.8') . '</span></p>
		<p>' . sprintf(__('For more details about this release, please visit %s','lmm'), $lmm_changelog_new_version) . '</p>
		<p>' . __('If you like using the plugin, please consider <a href="http://www.mapsmarker.com/donations" target="_blank">making a donation</a> and <a href="http://wordpress.org/extend/plugins/leaflet-maps-marker/" target="_blank">rate the plugin on wordpress.org</a> - thanks!','lmm') . '</p>'.PHP_EOL;

	if ( ($lmm_version_old <= '2.7.1' ) || 1==1 ){
		echo '<hr noshade size="1"><p style="margin:0.5em 0 0 0;"><strong>' . sprintf(__('Changelog for version %s','lmm'), '2.8') . '</strong> - ' . __('released on','lmm') . ' xx.xx.2012 (<a href="http://www.mapsmarker.com/v2.8" target="_blank">' . __('blog post with more details about this release','lmm') . '</a>):</p>
			<table style="line-height:0.7em;">
			<tr><td>
			<img src="' . LEAFLET_PLUGIN_URL .'inc/img/icon-changelog-new.png">
			</td><td>
			added subnavigations in settings for higher usability
			</td></tr>
			<tr><td>
			<img src="' . LEAFLET_PLUGIN_URL .'inc/img/icon-changelog-changed.png">
			</td><td>
			updated jQuery-Timepicker-Addon by Trent Richardson to v1.0.1
			</td></tr>
			<tr><td>
			<img src="' . LEAFLET_PLUGIN_URL .'inc/img/icon-changelog-changed.png">
			</td><td>
			started code refactoring for better readability and extensability
			</td></tr>
			<tr><td>
			<img src="' . LEAFLET_PLUGIN_URL .'inc/img/icon-changelog-fixed.png">
			</td><td>
			markers and layers with lat = 0 could not be created
			</td></tr>
			<tr><td>
			<img src="' . LEAFLET_PLUGIN_URL .'inc/img/icon-changelog-fixed.png">
			</td><td>
			fixed broken zoom for Google Maps with tilt (<a href="https://github.com/robertharm/Leaflet-Maps-Marker/issues/31" target="_blank">github issue #31</a>)
			</td></tr>
			<tr><td>
			<img src="' . LEAFLET_PLUGIN_URL .'inc/img/icon-changelog-fixed.png">
			</td><td>
			autoPanPadding for popups was broken
			</td></tr>
			<tr><td>
			<img src="' . LEAFLET_PLUGIN_URL .'inc/img/icon-changelog-fixed.png">
			</td><td>
			widget width was not 100% of sidebar on some templates
			</td></tr>
			</table>'.PHP_EOL;
	}
	if ( ( $lmm_version_old <= '2.7' ) && ( $lmm_version_old > '0' ) ){
		echo '<hr noshade size="1"><p style="margin:0.5em 0 0 0;"><strong>' . sprintf(__('Changelog for version %s','lmm'), '2.7') . '</strong> - ' . __('released on','lmm') . ' 21.07.2012:</p>
			<table style="line-height:0.7em;">
			<tr><td>
			 "Special Collectors Edition" :-)
			</td></tr>
			</table>'.PHP_EOL;
	}
	if ( ( $lmm_version_old <= '2.6.1' ) && ( $lmm_version_old > '0' ) ){
		echo '<hr noshade size="1"><p style="margin:0.5em 0 0 0;"><strong>' . sprintf(__('Changelog for version %s','lmm'), '2.6.1') . '</strong> - ' . __('released on','lmm') . ' 20.07.2012 (<a href="http://www.mapsmarker.com/v2.6.1" target="_blank">' . __('blog post with more details about this release','lmm') . '</a>):</p>
			<table style="line-height:0.7em;">
			<tr><td>
			<img src="' . LEAFLET_PLUGIN_URL .'inc/img/icon-changelog-fixed.png">
			</td><td>
			bing maps should now work as designed - thank to Pavel Shramov, <a href="https://github.com/shramov/" target="_blank">https://github.com/shramov/</a>!
			</td></tr>
			</table>'.PHP_EOL;
	}
	if ( ( $lmm_version_old <= '2.6' ) && ( $lmm_version_old > '0' ) ){
		echo '<hr noshade size="1"><p style="margin:0.5em 0 0 0;"><strong>' . sprintf(__('Changelog for version %s','lmm'), '2.6') . '</strong> - ' . __('released on','lmm') . ' 19.07.2012 (<a href="http://www.mapsmarker.com/v2.6" target="_blank">' . __('blog post with more details about this release','lmm') . '</a>):</p>
			<table style="line-height:0.7em;">
			<tr><td>
			<img src="' . LEAFLET_PLUGIN_URL .'inc/img/icon-changelog-new.png">
			</td><td>
			support for bing maps as basemaps (<a href="http://www.mapsmarker.com/bing-maps" target="_blank">API key required</a>)
			</td></tr>
			<tr><td>
			<img src="' . LEAFLET_PLUGIN_URL .'inc/img/icon-changelog-new.png">
			</td><td>
			configure marker attributes to show in marker list below layer maps (icon, marker name, popuptext)
			</td></tr>
			<tr><td>
			<img src="' . LEAFLET_PLUGIN_URL .'inc/img/icon-changelog-new.png">
			</td><td>
			option to use Google Maps (Terrain) as basemap
			</td></tr>
			<tr><td>
			<img src="' . LEAFLET_PLUGIN_URL .'inc/img/icon-changelog-new.png">
			</td><td>
			option to add Google Maps API key (required for commercial usage) - see <a href="http://www.mapsmarker.com/google-maps-api-key" target="_blank">http://www.mapsmarker.com/google-maps-api-key</a> for more details
			</td></tr>
			<tr><td>
			<img src="' . LEAFLET_PLUGIN_URL .'inc/img/icon-changelog-new.png">
			</td><td>
			Hindi translation thanks to Outshine Solutions, <a href="http://outshinesolutions.com" target="_blank">http://outshinesolutions.com</a> and Guntupalli Karunakar, <a href="http://indlinux.org" target="_blank">http://indlinux.org</a>
			</td></tr>
			<tr><td>
			<img src="' . LEAFLET_PLUGIN_URL .'inc/img/icon-changelog-new.png">
			</td><td>
			Yiddish translation thanks to Raphael Finkel, <a href="http://www.cs.uky.edu/~raphael/yiddish.html" target="_blank">http://www.cs.uky.edu/~raphael/yiddish.html</a>
			</td></tr>
			<tr><td>
			<img src="' . LEAFLET_PLUGIN_URL .'inc/img/icon-changelog-new.png">
			</td><td>
			Catalan translation thanks to Vicent Cubells, <a href="http://vcubells.net" target="_blank">http://vcubells.net</a>
			</td></tr>
			<tr><td>
			<img src="' . LEAFLET_PLUGIN_URL .'inc/img/icon-changelog-new.png">
			</td><td>
			Added compatibility check for plugin <a href="http://wordpress.org/extend/plugins/bwp-minify/" target="_blank">WordPress Better Minify</a>
			</td></tr>
			<tr><td>
			<img src="' . LEAFLET_PLUGIN_URL .'inc/img/icon-changelog-changed.png">
			</td><td>
			increased Google Maps maximal zoom level from 18 to 22
			</td></tr>
			<tr><td>
			<img src="' . LEAFLET_PLUGIN_URL .'inc/img/icon-changelog-changed.png">
			</td><td>
			changed the way Google Maps API is called in order to prevent errors with unset sensor parameter when using certain proxy servers (thanks <a href="http://EdWeWo.com" target="_blank">Dragan</a>!)
			</td></tr>
			<tr><td>
			<img src="' . LEAFLET_PLUGIN_URL .'inc/img/icon-changelog-changed.png">
			</td><td>
			updated Italian translation thanks to <a href="http://twitter.com/okibone" target="_blank">Luca Barbetti</a>
			</td></tr>
			<tr><td>
			<img src="' . LEAFLET_PLUGIN_URL .'inc/img/icon-changelog-changed.png">
			</td><td>
			updated Chinese translation thanks to John Shen, <a href="http://www.synyan.net" target="_blank">http://www.synyan.net</a>
			</td></tr>
			<tr><td>
			<img src="' . LEAFLET_PLUGIN_URL .'inc/img/icon-changelog-changed.png">
			</td><td>
			updated Spanish translation thanks to Alvaro Lara, <a href="http://www.alvarolara.com" target="_blank">http://www.alvarolara.com</a>
			</td></tr>
			<tr><td>
			<img src="' . LEAFLET_PLUGIN_URL .'inc/img/icon-changelog-changed.png">
			</td><td>
			updated French translation thanks to Vincèn Pujol, <a href="http://www.skivr.com" target="_blank">http://www.skivr.com</a>
			</td></tr>
			<tr><td>
			<img src="' . LEAFLET_PLUGIN_URL .'inc/img/icon-changelog-fixed.png">
			</td><td>
			maps using Google Maps Satellite as basemaps were broken
			</td></tr>
			<tr><td>
			<img src="' . LEAFLET_PLUGIN_URL .'inc/img/icon-changelog-fixed.png">
			</td><td>
			fixed vertical alignment of basemaps in layer control box in backend
			</td></tr>
			</table>'.PHP_EOL;
	}		
	if ( ( $lmm_version_old <= '2.5' ) && ( $lmm_version_old > '0' ) ){

	}		
	if ( ( $lmm_version_old <= '2.4' ) && ( $lmm_version_old > '0' ) ){

	}		
	if ( ( $lmm_version_old <= '2.3' ) && ( $lmm_version_old > '0' ) ){

	}		
	if ( ( $lmm_version_old <= '2.2' ) && ( $lmm_version_old > '0' ) ){

	}		
	if ( ( $lmm_version_old <= '2.1' ) && ( $lmm_version_old > '0' ) ){

	}		
	if ( ( $lmm_version_old <= '2.0' ) && ( $lmm_version_old > '0' ) ){

	}		
	if ( ( $lmm_version_old <= '1.9' ) && ( $lmm_version_old > '0' ) ){

	}		
	if ( ( $lmm_version_old <= '1.8' ) && ( $lmm_version_old > '0' ) ){

	}		
	if ( ( $lmm_version_old <= '1.7' ) && ( $lmm_version_old > '0' ) ){

	}		
	if ( ( $lmm_version_old <= '1.6' ) && ( $lmm_version_old > '0' ) ){

	}		
	if ( ( $lmm_version_old <= '1.5.1' ) && ( $lmm_version_old > '0' ) ){

	}		
	if ( ( $lmm_version_old <= '1.5' ) && ( $lmm_version_old > '0' ) ){

	}		
	if ( ( $lmm_version_old <= '1.4.3' ) && ( $lmm_version_old > '0' ) ){

	}		
	if ( ( $lmm_version_old <= '1.4.2' ) && ( $lmm_version_old > '0' ) ){

	}		
	if ( ( $lmm_version_old <= '1.4.1' ) && ( $lmm_version_old > '0' ) ){

	}		
	if ( ( $lmm_version_old <= '1.4' ) && ( $lmm_version_old > '0' ) ){

	}		
	if ( ( $lmm_version_old <= '1.3' ) && ( $lmm_version_old > '0' ) ){

	}		
	if ( ( $lmm_version_old <= '1.2.2' ) && ( $lmm_version_old > '0' ) ){

	}		
	if ( ( $lmm_version_old <= '1.2.1' ) && ( $lmm_version_old > '0' ) ){

	}		
	if ( ( $lmm_version_old <= '1.2' ) && ( $lmm_version_old > '0' ) ){

	}		
	if ( ( $lmm_version_old <= '1.1' ) && ( $lmm_version_old > '0' ) ){

	}		
	if ( $lmm_version_old == '1.0' ) {

	}		
	//info: show hide button
	echo '<form method="post" style="margin-top:10px;">
			<input type="hidden" name="update_info_action" value="hide" />
			<input class="button-secondary" type="submit" value="' . __('remove message', 'lmm') . '"/></form></div>';
}
?>