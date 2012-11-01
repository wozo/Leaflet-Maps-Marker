<?php  
/**
 * Leaflet Maps Marker Plugin - settings class
 * based on class by Alison Barrett, http://alisothegeek.com/2011/01/wordpress-settings-api-tutorial-1/
*/
//info prevent file from being accessed directly
if (basename($_SERVER['SCRIPT_FILENAME']) == 'class-leaflet-options.php') { die ("Please do not access this file directly. Thanks!<br/><a href='http://www.mapsmarker.com/go'>www.mapsmarker.com</a>"); }
class Class_leaflet_options {
	private $panes;
	private $sections;
	private $checkboxes;
	private $settings;
	
	 /**
	 *
	 * Construct
	 *
	 */
	public function __construct() {
		//info:  This will keep track of the checkbox options for the validate_settings function.
		$this->checkboxes = array();
		$this->settings = array();
		$this->get_settings();

		$this->panes['mapdefaults'] 	= esc_attr__('Map Defaults','lmm');
		$this->panes['basemaps'] 		= esc_attr__('Basemaps','lmm');
		$this->panes['overlays']		= esc_attr__('Overlays','lmm');
		$this->panes['wms']				= esc_attr__('WMS','lmm');
		$this->panes['google']			= esc_attr__('Google Maps','lmm');
		$this->panes['bing']			= esc_attr__('Bing Maps','lmm');
		$this->panes['directions']		= esc_attr__('Directions','lmm');
		$this->panes['ar']				= esc_attr__('Augmented-Reality','lmm');
		$this->panes['misc']			= esc_attr__('Misc','lmm');
		$this->panes['reset']			= esc_attr__('Reset','lmm');

		$this->sections['mapdefaults-section1']		= esc_attr__('Default basemap for new markers/layers','lmm');
		$this->sections['mapdefaults-section2']		= esc_attr__('Names for default basemaps','lmm');
		$this->sections['mapdefaults-section3']		= esc_attr__('Available basemaps in control box','lmm');
		$this->sections['mapdefaults-section4']		= esc_attr__('Default values for new marker maps','lmm');
		$this->sections['mapdefaults-section5']		= esc_attr__('Default values for marker icons','lmm');
		$this->sections['mapdefaults-section6']		= esc_attr__('Default values for marker popups','lmm');
		$this->sections['mapdefaults-section7']		= esc_attr__('Default values for markers added directly','lmm');
		$this->sections['mapdefaults-section8']		= esc_attr__('Default values for new layer maps','lmm');
		$this->sections['mapdefaults-section9']		= esc_attr__('List marker settings','lmm');
		$this->sections['mapdefaults-section10']	= esc_attr__('Interaction options','lmm');
		$this->sections['mapdefaults-section11']	= esc_attr__('Keyboard navigation options','lmm');
		$this->sections['mapdefaults-section12']	= esc_attr__('Panning inertia options','lmm');
		$this->sections['mapdefaults-section13']	= esc_attr__('Control options','lmm');
		$this->sections['mapdefaults-section14']	= esc_attr__('Scale control','lmm');
		$this->sections['mapdefaults-section15']	= esc_attr__('Retina display detection','lmm');
	
		$this->sections['basemaps-section1']		= esc_attr__('Cloudmade 1 settings','lmm');
		$this->sections['basemaps-section2']		= esc_attr__('Cloudmade 2 settings','lmm');
		$this->sections['basemaps-section3']		= esc_attr__('Cloudmade 3 settings','lmm');
		$this->sections['basemaps-section4']		= esc_attr__('MapBox 1 settings','lmm');
		$this->sections['basemaps-section5']		= esc_attr__('MapBox 2 settings','lmm');
		$this->sections['basemaps-section6']		= esc_attr__('MapBox 3 settings','lmm');
		$this->sections['basemaps-section7']		= esc_attr__('Custom basemap 1 settings','lmm');
		$this->sections['basemaps-section8']		= esc_attr__('Custom basemap 2 settings','lmm');
		$this->sections['basemaps-section9']		= esc_attr__('Custom basemap 3 settings','lmm');
		$this->sections['basemaps-section10']		= esc_attr__('OGD Vienna Selector','lmm');

		$this->sections['overlays-section1']		= esc_attr__('Available overlays for new markers/layers','lmm');
		$this->sections['overlays-section2']		= esc_attr__('Custom overlay settings','lmm');
		$this->sections['overlays-section3']		= esc_attr__('Custom overlay 2 settings','lmm');
		$this->sections['overlays-section4']		= esc_attr__('Custom overlay 3 settings','lmm');
		$this->sections['overlays-section5']		= esc_attr__('Custom overlay 4 settings','lmm');

		$this->sections['wms-sections1']			= esc_attr__('Available WMS layers for new markers/layers','lmm');
		$this->sections['wms-sections2']			= esc_attr__('WMS layer 1 settings','lmm');
		$this->sections['wms-sections3']			= esc_attr__('WMS layer 2 settings','lmm');
		$this->sections['wms-sections4']			= esc_attr__('WMS layer 3 settings','lmm');
		$this->sections['wms-sections5']			= esc_attr__('WMS layer 4 settings','lmm');
		$this->sections['wms-sections6']			= esc_attr__('WMS layer 5 settings','lmm');
		$this->sections['wms-sections7']			= esc_attr__('WMS layer 6 settings','lmm');
		$this->sections['wms-sections8']			= esc_attr__('WMS layer 7 settings','lmm');
		$this->sections['wms-sections9']			= esc_attr__('WMS layer 8 settings','lmm');
		$this->sections['wms-sections10']			= esc_attr__('WMS layer 9 settings','lmm');
		$this->sections['wms-sections11']			= esc_attr__('WMS layer 10 settings','lmm');

		$this->sections['google-section1']			= esc_attr__('Google Maps API key','lmm');
		$this->sections['google-section2']			= esc_attr__('Google language localization','lmm');
		$this->sections['google-section3']			= esc_attr__('Google Maps base domain','lmm');
		$this->sections['google-section4']			= esc_attr__('Google Places bounds','lmm');
		$this->sections['google-section5']			= esc_attr__('Google Places search prefix','lmm');

		$this->sections['bing-section1']			= esc_attr__('Bing Maps API Key','lmm');
		$this->sections['bing-section2']			= esc_attr__('Bing Culture Parameter','lmm');

		$this->sections['directions-section1']		= esc_attr__('General directions settings','lmm');
		$this->sections['directions-section2']		= esc_attr__('Google Maps directions','lmm');
		$this->sections['directions-section3']		= 'yournavigation.org';
		$this->sections['directions-section4']		= 'map.project-osrm.org';
		$this->sections['directions-section5']		= 'openrouteservice.org';

		$this->sections['ar-section1']				= esc_attr__('Wikitude settings','lmm');

		$this->sections['misc-section1']			= esc_attr__('General settings','lmm');
		$this->sections['misc-section2']			= esc_attr__('Language Settings','lmm');
		$this->sections['misc-section3']			= esc_attr__('KML settings','lmm');
		$this->sections['misc-section4']			= esc_attr__('Available columns for marker listing page','lmm');
		$this->sections['misc-section5']			= esc_attr__('Sort order for marker listing page','lmm');
		$this->sections['misc-section6']			= esc_attr__('Available columns for layer listing page','lmm');
		$this->sections['misc-section7']			= esc_attr__('Sort order for layer listing page','lmm');

		$this->sections['reset-section1']			= esc_attr__('Reset Settings','lmm');

		add_action( 'admin_init', array( &$this, 'register_settings' ) );
		if ( ! get_option( 'leafletmapsmarker_options' ) )
			$this->initialize_settings();
	}
	/**
	 * Create settings field
	 *
	 * @since 1.0
	 */
	public function create_setting( $args = array() ) {
		
		$defaults = array(
			'id'      => 'default_field',
			'version' => '',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section1',
			'title'   => esc_attr__( 'Default Field','lmm' ),
			'desc'    => esc_attr__( 'This is a default description.','lmm' ),
			'std'     => '',
			'type'    => 'text',
			'choices' => array(),
			'class'   => ''
		);
			
		extract( wp_parse_args( $args, $defaults ) );
		
		$field_args = array(
			'type'      => $type,
			'id'        => $id,
			'desc'      => $desc,
			'std'       => $std,
			'choices'   => $choices,
			'label_for' => $id,
			'class'     => $class
		);
		
		if ( $type == 'checkbox' )
			$this->checkboxes[] = $id;
		
		add_settings_field( $id, $title, array( $this, 'display_setting' ), 'leafletmapsmarker_settings', $section, $field_args );
	}
	
	/**
	 * Display options page
	 *
	 * @since 1.0
	 */
	public function display_page() {
        
		echo '<div style="float:left;" class="icon32" id="icon-options-general"></div><h3>'.__('Settings','lmm').'</h3><div class="wrap lmmsettings">';
		if ( isset( $_GET['settings-updated'] ) )
			echo '<div class="updated fade"><p>' . __( 'Plugin options updated.','lmm' ) . '</p></div>';
		include(LEAFLET_PLUGIN_DIR . 'inc' . DIRECTORY_SEPARATOR . 'admin-header.php');
        
		echo '<form action="options.php" method="post">';
		settings_fields( 'leafletmapsmarker_options' );
		echo '<div class="ui-tabs tabs-top">
			<ul class="ui-tabs-nav-top">';
		
		foreach ( $this->panes as $pane_slug => $pane )
			echo '<li><a href="#' . $pane_slug . '">' . $pane . '</a></li>';
		  
		echo '</ul>';
          
        foreach($this->panes as $pane_slug => $pane){
            echo '<div id = '.$pane_slug.' class="ui-tabs tabs-left">';
            echo '<ul class="ui-tabs-nav ui-tabs-navleft">'; 
            $sections = array(); 
            foreach ( $this->sections as $key => $row ){
                
                $k = explode("-",$key);
                if($k[0]==$pane_slug){
                echo '<li><a href="#' . $key . '">' . $row . '</a></li>';
                $sections[] = $key;
                }    
            }
            echo '</ul>';    

                foreach($sections as $slug => $section){ 
                    echo '<div class="section">';
                    echo "<h3 class='titl'>".$this->sections[$section]."</h3>";
                    @call_user_func(array(&$this, 'display_'.$pane_slug.'_section'), array());
                    echo '<table class="form-table">'; 
                        do_settings_fields( $_GET['page'], $section );
                    echo '</table>';
                    echo '</div>';
                }
                
            echo '</div>';  
        }
   	
		echo '</div>'; 
		echo '<p class="submit"><input name="Submit" type="submit" class="button-primary" value="' . esc_attr__( 'Save Changes','lmm' ) . '" /></p>
		
	</form>';
    
	
	echo '<script type="text/javascript">
		jQuery(document).ready(function($) {
			var panes = [];';
			
			foreach ( $this->sections as $pane_slug => $pane )
				echo "panes['$pane'] = '$pane_slug';";
			echo 'var wrapped = $(".wrap h3").wrap("<div class=\"ui-tabs-panel\">");
			wrapped.each(function() {
				$(this).parent().append($(this).parent().nextUntil("div.ui-tabs-panel"));
			});
			$(".ui-tabs-panel").each(function(index) {
				$(this).attr("id", panes[$(this).children("h3").text()]);
				if (index > 0)
					$(this).addClass("ui-tabs-hide"); 
			});
			$(".ui-tabs").tabs({
				//fx: { opacity: "toogle", duration: "fast"}
			});
  		$("input[type=text], textarea").each(function() {
				if ($(this).val() == $(this).attr("placeholder") || $(this).val() == "")
					$(this).css("color", "#999");
			});
			
			$("input[type=text], textarea").focus(function() {
				if ($(this).val() == $(this).attr("placeholder") || $(this).val() == "") {
					//$(this).val("");
					$(this).css("color", "#000");
				}
			}).blur(function() {
				if ($(this).val() == "" || $(this).val() == $(this).attr("placeholder")) {
					$(this).val($(this).attr("placeholder"));
					$(this).css("color", "#999");
				}
			});
			
			$(".lmmsettings h3, .lmmsettings table, .leafletmapsmarker-listings").show();
			
			//info:  This will make the "warning" checkbox class really stand out when checked.
			$(".warning").change(function() {
				if ($(this).is(":checked"))
					$(this).parent().css("background", "#c00").css("color", "#fff").css("fontWeight", "bold");
				else
					$(this).parent().css("background", "none").css("color", "inherit").css("fontWeight", "normal");
			});
			
			//info:  Browser compatibility
			if ($.browser.mozilla) 
			         $("form").attr("autocomplete", "off");
		});  
	</script></div>';
	}

	/**
	 * HTML output for text field
	 */
	public function display_setting( $args = array() ) {
		
		extract( $args );
		
		$options = get_option( 'leafletmapsmarker_options' );
		
		if ( ! isset( $options[$id] ) && $type != 'checkbox' )
			$options[$id] = $std;
		elseif ( ! isset( $options[$id] ) )
			$options[$id] = 0;
		
		$field_class = '';
		if ( $class != '' )
			$field_class = ' ' . $class;
		
		switch ( $type ) {
			
			case 'heading':
				echo '</td></tr><tr valign="top"><td colspan="2" rowspan="2"><h4>' . $desc . '</h4>';
				break;
			case 'helptext':
				echo '</td></tr><tr valign="top"><td colspan="2">' . $desc . '';
				break;
			case 'checkbox':
				echo '<input class="checkbox' . $field_class . '" type="checkbox" id="' . $id . '" name="leafletmapsmarker_options[' . $id . ']" value="1" ' . checked( $options[$id], 1, false ) . ' /> <label for="' . $id . '">' . $desc . '</label>';
				break;
			case 'checkbox-readonly':
				echo '<input class="checkbox' . $field_class . '" type="checkbox" id="' . $id . '" name="leafletmapsmarker_options[' . $id . ']" value="1" ' . checked( $options[$id], 1, false ) . ' disabled="disabled" /> <label for="' . $id . '">' . $desc . '</label>';
				break;
			case 'select':
				echo '<select class="select' . $field_class . '" name="leafletmapsmarker_options[' . $id . ']">';
				foreach ( $choices as $value => $label )
					echo '<option value="' . esc_attr( $value ) . '"' . selected( $options[$id], $value, false ) . '>' . $label . '</option>';
				echo '</select>';
				if ( $desc != '' )
					echo '<br /><span class="description">' . $desc . '</span>';
				break;
			case 'radio':
				$i = 0;
				foreach ( $choices as $value => $label ) {
					echo '<input class="radio' . $field_class . '" type="radio" name="leafletmapsmarker_options[' . $id . ']" id="' . $id . $i . '" value="' . esc_attr( $value ) . '" ' . checked( $options[$id], $value, false ) . '> <label for="' . $id . $i . '">' . $label . '</label>';
					if ( $i < count( $options ) - 1 )
						echo '<br />';
					$i++;
				}
				if ( $desc != '' )
					echo '<span class="description">' . $desc . '</span>';
				break;
			
			case 'textarea':
				echo '<textarea class="' . $field_class . '" id="' . $id . '" name="leafletmapsmarker_options[' . $id . ']" placeholder="' . $std . '" rows="5" cols="30">' . wp_htmledit_pre( $options[$id] ) . '</textarea>';
				
				if ( $desc != '' )
					echo '<br /><span class="description">' . $desc . '</span>';
				break;
			case 'password':
				echo '<input class="regular-text' . $field_class . '" type="password" id="' . $id . '" name="leafletmapsmarker_options[' . $id . ']" value="' . esc_attr( $options[$id] ) . '" />';
				if ( $desc != '' )
					echo '<br /><span class="description">' . $desc . '</span>';
				break;
			case 'text':
			default:
		 		echo '<input class="regular-text' . $field_class . '" style="width:30em;" type="text" id="' . $id . '" name="leafletmapsmarker_options[' . $id . ']" placeholder="' . $std . '" value="' . esc_attr( $options[$id] ) . '" />';
		 		if ( $desc != '' )
		 			echo '<br /><span class="description">' . $desc . '</span>';
		 		break;
			case 'text-readonly':
			default:
		 		echo '<input readonly="readonly" class="regular-text' . $field_class . '" style="width:60em;" type="text" id="' . $id . '" name="leafletmapsmarker_options[' . $id . ']" placeholder="' . $std . '" value="' . esc_attr( $options[$id] ) . '" />';
	 		if ( $desc != '' )
		 			echo '<br /><span class="description">' . $desc . '</span>';
		 		break;
			case 'text-deletable':
			default:
		 		echo '<input class="regular-text' . $field_class . '" style="width:60em;" type="text" id="' . $id . '" name="leafletmapsmarker_options[' . $id . ']" value="' . esc_attr( $options[$id] ) . '" />';
	 		if ( $desc != '' )
		 			echo '<br /><span class="description">' . $desc . '</span>';
		 		break;
		}              
	}
	
	/**
	 * Settings and defaults
	 */
	public function get_settings() {
		     
		/*===========================================
		*
		*
		* pane basemaps
		*
		*
		===========================================*/
		/*
		* Default basemap for new markers/layers
		*/   
		$this->settings['default_basemap_helptext1'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section1',
			'title'   => '',
			'desc'    => esc_attr__( 'Please select the basemap which should be pre-selected as default for new markers and layers. Can be changed afterwards on each marker/layer.', 'lmm').'<br/><br/><img src="'. LEAFLET_PLUGIN_URL .'inc/img/help-default-basemap.jpg" />',
			'type'    => 'helptext'
		);
		$this->settings['standard_basemap'] = array(
			'version' => '1.9',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section1',
			'title'   => esc_attr__('Default basemap','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'ogdwien_basemap',
			'choices' => array(
				'osm_mapnik' => esc_attr__('OpenStreetMap (Mapnik, max zoom 18)','lmm'),
				'mapquest_osm' => esc_attr__('MapQuest (OSM, max zoom 18)','lmm'),
				'mapquest_aerial' => esc_attr__('MapQuest (Aerial, max zoom 12 globally, 12+ in the United States)','lmm'),
				'googleLayer_roadmap' => esc_attr__('Google Maps (Roadmap)','lmm')  . ' - <strong>' . esc_attr__('API key required for commercial usage!','lmm') . '</strong> <a href="http://www.mapsmarker.com/google-maps-api-key" target="_blank"><img src="' . LEAFLET_PLUGIN_URL . 'inc/img/icon-question-mark.png" width="12" height="12" border="0"/></a>',
				'googleLayer_satellite' => esc_attr__('Google Maps (Satellite)','lmm')  . ' - <strong>' . esc_attr__('API key required for commercial usage!','lmm') . '</strong> <a href="http://www.mapsmarker.com/google-maps-api-key" target="_blank"><img src="' . LEAFLET_PLUGIN_URL . 'inc/img/icon-question-mark.png" width="12" height="12" border="0"/></a>',
				'googleLayer_hybrid' => esc_attr__('Google Maps (Hybrid)','lmm')  . ' - <strong>' . esc_attr__('API key required for commercial usage!','lmm') . '</strong> <a href="http://www.mapsmarker.com/google-maps-api-key" target="_blank"><img src="' . LEAFLET_PLUGIN_URL . 'inc/img/icon-question-mark.png" width="12" height="12" border="0"/></a>',
				'googleLayer_terrain' => esc_attr__('Google Maps (Terrain)','lmm')  . ' - <strong>' . esc_attr__('API key required for commercial usage!','lmm') . '</strong> <a href="http://www.mapsmarker.com/google-maps-api-key" target="_blank"><img src="' . LEAFLET_PLUGIN_URL . 'inc/img/icon-question-mark.png" width="12" height="12" border="0"/></a>',
				'bingaerial' => esc_attr__('Bing Maps (Aerial)','lmm') . ' - <strong>' . esc_attr__('API key required!','lmm') . '</strong> <a href="http://www.mapsmarker.com/bing-maps" target="_blank"><img src="' . LEAFLET_PLUGIN_URL . 'inc/img/icon-question-mark.png" width="12" height="12" border="0"/></a>',
				'bingaerialwithlabels' => esc_attr__('Bing Maps (Aerial+Labels)','lmm') . ' - <strong>' . esc_attr__('API key required!','lmm'). '</strong> <a href="http://www.mapsmarker.com/bing-maps" target="_blank"><img src="' . LEAFLET_PLUGIN_URL . 'inc/img/icon-question-mark.png" width="12" height="12" border="0"/></a>',
				'bingroad' => esc_attr__('Bing Maps (Road)','lmm') . ' - <strong>' . esc_attr__('API key required!','lmm'). '</strong> <a href="http://www.mapsmarker.com/bing-maps" target="_blank"><img src="' . LEAFLET_PLUGIN_URL . 'inc/img/icon-question-mark.png" width="12" height="12" border="0"/></a>',
				'ogdwien_basemap' => esc_attr__('OGD Vienna basemap (max zoom 19)','lmm'),
				'ogdwien_satellite' => esc_attr__('OGD Vienna satellite (max zoom 19)','lmm'),
				'cloudmade' => 'Cloudmade',
				'cloudmade2' => 'Cloudmade 2',
				'cloudmade3' => 'Cloudmade 3',
				'mapbox' => 'MapBox 1',
				'mapbox2' => 'MapBox 2',
				'mapbox3' => 'MapBox 3',
				'custom_basemap' => esc_attr__('Custom basemap','lmm'),
				'custom_basemap2' => esc_attr__('Custom basemap 2','lmm'),
				'custom_basemap3' => esc_attr__('Custom basemap 3','lmm')
			)
		);  
		/*
		* Names for default basemaps
		*/
		$this->settings['default_basemap_helptext2'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section2',
			'std'     => '', 
			'title'   => '',
			'desc'    => esc_attr__( 'Optionally you can also change the name of the predefined basemaps in the controlbox.', 'lmm').'<br/><br/><img src="'. LEAFLET_PLUGIN_URL .'inc/img/help-default-basemap-names.jpg" />',
			'type'    => 'helptext'
		);
		$this->settings['default_basemap_name_osm_mapnik'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section2',
			'title'   => 'OpenStreetMap (Mapnik)',
			'desc'    => '',
			'std'     => 'OSM Mapnik',
			'type'    => 'text'
		);
		$this->settings['default_basemap_name_mapquest_osm'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section2',
			'title'   => 'Mapquest',
			'desc'    => '',
			'std'     => 'Mapquest OSM',
			'type'    => 'text'
		);
		$this->settings['default_basemap_name_mapquest_aerial'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section2',
			'title'   => 'Mapquest (Aerial)',
			'desc'    => '',
			'std'     => 'Mapquest (Aerial)',
			'type'    => 'text'
		);
		$this->settings['default_basemap_name_googleLayer_roadmap'] = array(
			'version' => '2.5',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section2',
			'title'   => esc_attr__('Google Maps (Roadmap)','lmm'),
			'desc'    => '',
			'std'   => esc_attr__('Google Maps (Roadmap)','lmm'),
			'type'    => 'text'
		);
		$this->settings['default_basemap_name_googleLayer_satellite'] = array(
			'version' => '2.5',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section2',
			'title'   => esc_attr__('Google Maps (Satellite)','lmm'),
			'desc'    => '',
			'std'   => esc_attr__('Google Maps (Satellite)','lmm'),
			'type'    => 'text'
		);
		$this->settings['default_basemap_name_googleLayer_hybrid'] = array(
			'version' => '2.5',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section2',
			'title'   => esc_attr__('Google Maps (Hybrid)','lmm'),
			'desc'    => '',
			'std'   => esc_attr__('Google Maps (Hybrid)','lmm'),
			'type'    => 'text'
		);
		$this->settings['default_basemap_name_googleLayer_terrain'] = array(
			'version' => '2.6',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section2',			
			'title'   => esc_attr__('Google Maps (Terrain)','lmm'),
			'desc'    => '',
			'std'   => esc_attr__('Google Maps (Terrain)','lmm'),
			'type'    => 'text'
		);
		$this->settings['default_basemap_name_bingaerial'] = array(
			'version' => '2.6',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section2',
			'title'   => esc_attr__('Bing Maps (Aerial)','lmm'),
			'desc'    => '',
			'std'   => esc_attr__('Bing Maps (Aerial)','lmm'),
			'type'    => 'text'
		);
		$this->settings['default_basemap_name_bingaerialwithlabels'] = array(
			'version' => '2.6',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section2',
			'title'   => esc_attr__('Bing Maps (Aerial+Labels)','lmm'),
			'desc'    => '',
			'std'   => esc_attr__('Bing Maps (Aerial+Labels)','lmm'),
			'type'    => 'text'
		);
		$this->settings['default_basemap_name_bingroad'] = array(
			'version' => '2.6',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section2',
			'title'   => esc_attr__('Bing Maps (Road)','lmm'),
			'desc'    => '',
			'std'   => esc_attr__('Bing Maps (Road)','lmm'),
			'type'    => 'text'
		);
		$this->settings['default_basemap_name_ogdwien_basemap'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section2',
			'title'   => 'OGD Vienna basemap',
			'desc'    => '',
			'std'     => 'OGD Vienna basemap',
			'type'    => 'text'
		);
		$this->settings['default_basemap_name_ogdwien_satellite'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section2',
			'title'   => 'OGD Vienna satellite',
			'desc'    => '',
			'std'     => 'OGD Vienna satellite',
			'type'    => 'text'
		);
		$this->settings['cloudmade_name'] = array(
			'version' => '1.6',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section2',
			'title'   => 'Cloudmade',
			'desc'    => '',
			'std'     => 'Cloudmade',
			'type'    => 'text'
		);		
		$this->settings['cloudmade2_name'] = array(
			'version' => '1.6',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section2',
			'title'   => 'Cloudmade 2',
			'desc'    => '',
			'std'     => 'Cloudmade 2',
			'type'    => 'text'
		);		
		$this->settings['cloudmade3_name'] = array(
			'version' => '1.6',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section2',
			'title'   => 'Cloudmade 3',
			'desc'    => '',
			'std'     => 'Cloudmade 3',
			'type'    => 'text'
		);		
		$this->settings['mapbox_name'] = array(
			'version' => '2.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section2',
			'title'   => 'MapBox',
			'desc'    => '',
			'std'     => 'Blue Marble Topography',
			'type'    => 'text'
		);		
		$this->settings['mapbox2_name'] = array(
			'version' => '2.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section2',
			'title'   => 'MapBox 2',
			'desc'    => '',
			'std'     => 'Geography Class',
			'type'    => 'text',
		);		
		$this->settings['mapbox3_name'] = array(
			'version' => '2.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section2',
			'title'   => 'MapBox 3',
			'desc'    => '',
			'std'     => 'MapBox Streets',
			'type'    => 'text'
		);		
		$this->settings['custom_basemap_name'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section2',
			'title'   => esc_attr__( 'Custom Basemap', 'lmm' ),
			'desc'    => '',
			'std'     => 'Custom1',
			'type'    => 'text'
		);		
		$this->settings['custom_basemap2_name'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section2',
			'title'   => esc_attr__( 'Custom Basemap 2', 'lmm' ),
			'desc'    => '',
			'std'     => 'Custom2',
			'type'    => 'text'
		);		
		$this->settings['custom_basemap3_name'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section2',
			'title'   => esc_attr__( 'Custom Basemap 3', 'lmm' ),
			'desc'    => '',
			'std'     => 'Custom3',
			'type'    => 'text'
		);		
		/*
		* Available basemaps in control box
		*/
		$this->settings['default_basemap_helptext3'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section3',
			'std'     => '', 
			'title'    => '',
			'desc'    => esc_attr__( 'Please select the basemaps which should be available in the control box.', 'lmm').'<br/><br/><img src="'. LEAFLET_PLUGIN_URL .'inc/img/help-default-basemap-available-basemaps.jpg" />',
			'type'    => 'helptext'
		);
		$this->settings['controlbox_osm_mapnik'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section3',
			'title'   => esc_attr__( 'Basemaps available in control box', 'lmm' ),
			'desc'    => esc_attr__( 'OpenStreetMap (Mapnik)', 'lmm' ),
			'type'    => 'checkbox',
			'std'     => 1 
		);
		$this->settings['controlbox_mapquest_osm'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section3',
			'title'   => '',
			'desc'    => esc_attr__('MapQuest (OSM)','lmm'),
			'type'    => 'checkbox',
			'std'     => 1 
		);
		$this->settings['controlbox_mapquest_aerial'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section3',
			'title'   => '',
			'desc'    => esc_attr__('MapQuest (Aerial)','lmm'),
			'type'    => 'checkbox',
			'std'     => 1 
		);
		$this->settings['controlbox_googleLayer_roadmap'] = array(
			'version' => '2.5',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section3',
			'title'   => '',
			'desc'    => esc_attr__('Google Maps (Roadmap)','lmm')  . ' - <strong>' . esc_attr__('API key required for commercial usage!','lmm') . '</strong> <a href="http://www.mapsmarker.com/google-maps-api-key" target="_blank"><img src="' . LEAFLET_PLUGIN_URL . 'inc/img/icon-question-mark.png" width="12" height="12" border="0"/></a>',
			'type'    => 'checkbox',
			'std'     => 1 
		);
		$this->settings['controlbox_googleLayer_satellite'] = array(
			'version' => '2.5',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section3',
			'title'   => '',
			'desc'    => esc_attr__('Google Maps (Satellite)','lmm')  . ' - <strong>' . esc_attr__('API key required for commercial usage!','lmm') . '</strong> <a href="http://www.mapsmarker.com/google-maps-api-key" target="_blank"><img src="' . LEAFLET_PLUGIN_URL . 'inc/img/icon-question-mark.png" width="12" height="12" border="0"/></a>',
			'type'    => 'checkbox',
			'std'     => 1 
		);
		$this->settings['controlbox_googleLayer_hybrid'] = array(
			'version' => '2.5',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section3',
			'title'   => '',
			'desc'    => esc_attr__('Google Maps (Hybrid)','lmm')  . ' - <strong>' . esc_attr__('API key required for commercial usage!','lmm') . '</strong> <a href="http://www.mapsmarker.com/google-maps-api-key" target="_blank"><img src="' . LEAFLET_PLUGIN_URL . 'inc/img/icon-question-mark.png" width="12" height="12" border="0"/></a>',
			'type'    => 'checkbox',
			'std'     => 1 
		);
		$this->settings['controlbox_googleLayer_terrain'] = array(
			'version' => '2.6',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section3',
			'title'   => '',
			'desc'    => esc_attr__('Google Maps (Terrain)','lmm')  . ' - <strong>' . esc_attr__('API key required for commercial usage!','lmm') . '</strong> <a href="http://www.mapsmarker.com/google-maps-api-key" target="_blank"><img src="' . LEAFLET_PLUGIN_URL . 'inc/img/icon-question-mark.png" width="12" height="12" border="0"/></a>',
			'type'    => 'checkbox',
			'std'     => 1 
		);
		$this->settings['controlbox_bingaerial'] = array(
			'version' => '2.6',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section3',
			'title'   => '',
			'desc'    => esc_attr__('Bing Maps (Aerial)','lmm') . ' - <strong>' . esc_attr__('API key required!','lmm'). '</strong> <a href="http://www.mapsmarker.com/bing-maps" target="_blank"><img src="' . LEAFLET_PLUGIN_URL . 'inc/img/icon-question-mark.png" width="12" height="12" border="0"/></a>',
			'type'    => 'checkbox',
			'std'     => 0 
		);
		$this->settings['controlbox_bingaerialwithlabels'] = array(
			'version' => '2.6',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section3',
			'title'   => '',
			'desc'    => esc_attr__('Bing Maps (Aerial+Labels)','lmm') . ' - <strong>' . esc_attr__('API key required!','lmm'). '</strong> <a href="http://www.mapsmarker.com/bing-maps" target="_blank"><img src="' . LEAFLET_PLUGIN_URL . 'inc/img/icon-question-mark.png" width="12" height="12" border="0"/></a>',
			'type'    => 'checkbox',
			'std'     => 0 
		);
		$this->settings['controlbox_bingroad'] = array(
			'version' => '2.6',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section3',
			'title'   => '',
			'desc'    => esc_attr__('Bing Maps (Road)','lmm') . ' - <strong>' . esc_attr__('API key required!','lmm'). '</strong> <a href="http://www.mapsmarker.com/bing-maps" target="_blank"><img src="' . LEAFLET_PLUGIN_URL . 'inc/img/icon-question-mark.png" width="12" height="12" border="0"/></a>',
			'type'    => 'checkbox',
			'std'     => 0 
		);
		$this->settings['controlbox_ogdwien_basemap'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section3',
			'title'   => '',
			'desc'    => esc_attr__('OGD Vienna basemap','lmm') . '<br/><span class="description">' . esc_attr__('Info: gets removed from control box automatically if location of marker or layer is outside Vienna','lmm') . '</span>',
			'type'    => 'checkbox',
			'std'     => 1 
		);
		$this->settings['controlbox_ogdwien_satellite'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section3',
			'title'   => '',
			'desc'    => esc_attr__('OGD Vienna satellite','lmm') . '<br/><span class="description">' . esc_attr__('Info: gets removed from control box automatically if location of marker or layer is outside Vienna','lmm') . '</span>',
			'type'    => 'checkbox',
			'std'     => 1 
		);
		$this->settings['controlbox_cloudmade'] = array(
			'version' => '1.6',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section3',
			'title'   => '',
			'desc'    => 'Cloudmade',
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['controlbox_cloudmade2'] = array(
			'version' => '1.6',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section3',
			'title'   => '',
			'desc'    => 'Cloudmade 2',
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['controlbox_cloudmade3'] = array(
			'version' => '1.6',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section3',
			'title'   => '',
			'desc'    => 'Cloudmade 3',
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['controlbox_mapbox'] = array(
			'version' => '2.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section3',
			'title'   => '',
			'desc'    => 'MapBox',
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['controlbox_mapbox2'] = array(
			'version' => '2.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section3',
			'title'   => '',
			'desc'    => 'MapBox 2',
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['controlbox_mapbox3'] = array(
			'version' => '2.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section3',
			'title'   => '',
			'desc'    => 'MapBox 3',
			'type'    => 'checkbox',
			'std'     => 0 
		);
		$this->settings['controlbox_custom_basemap'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section3',
			'title'   => '',
			'desc'    => esc_attr__('Custom basemap','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['controlbox_custom_basemap2'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section3',
			'title'   => '',
			'desc'    => esc_attr__('Custom basemap 2','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['controlbox_custom_basemap3'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section3',
			'title'   => '',
			'desc'    => esc_attr__('Custom basemap 3','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		/*
		* Default values for new marker maps
		*/
		$this->settings['defaults_marker_helptext1'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section4',
			'std'     => '', 
			'title'   => '',
			'desc'    => esc_attr__( 'Will be used when creating a new marker. All values can be changed afterwards on each marker.', 'lmm') . '<br/><br/><img src="'. LEAFLET_PLUGIN_URL .'inc/img/help-marker-defaults.jpg" />',
			'type'    => 'helptext'
		);
		$this->settings['defaults_marker_lat'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section4',
			'title'   => esc_attr__( 'Latitude', 'lmm' ),
			'desc'    => esc_attr__( 'Please use a dot instead of a coma as decimal delimiter!', 'lmm' ),
			'std'     => '48.216038',
			'type'    => 'text'
		);
		$this->settings['defaults_marker_lon'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section4',
			'title'   => esc_attr__( 'Longitude', 'lmm' ),
			'desc'    => esc_attr__( 'Please use a dot instead of a coma as decimal delimiter!', 'lmm' ),
			'std'     => '16.378984',
			'type'    => 'text'
		);
		$this->settings['defaults_marker_zoom'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section4',
			'title'   => esc_attr__( 'Zoom', 'lmm' ),
			'desc'    => '',
			'std'     => '11',
			'type'    => 'text'
		);
		$this->settings['defaults_marker_mapwidth'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section4',
			'title'   => esc_attr__( 'Map width', 'lmm' ),
			'desc'    => '',
			'std'     => '640',
			'type'    => 'text'
		);
		$this->settings['defaults_marker_mapwidthunit'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section4',
			'title'   => esc_attr__('Map width unit','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'px',
			'choices' => array(
				'px' => 'px',
				'%' => '%'
			)
		);
		$this->settings['defaults_marker_mapheight'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section4',
			'title'   => esc_attr__( 'Map height', 'lmm' ) . ' (px)',
			'desc'    => '',
			'std'     => '480',
			'type'    => 'text'
		);
		$this->settings['defaults_marker_openpopup'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section4',
			'title'   => esc_attr__('Open popup by default','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => '0',
			'choices' => array(
				'0' => esc_attr__('disabled','lmm'),
				'1' => esc_attr__('enabled','lmm')
			)
		);
		$this->settings['defaults_marker_controlbox'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section4',
			'title'   => esc_attr__('Basemap/layer controlbox on frontend','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => '1',
			'choices' => array(
				'0' => esc_attr__('hidden','lmm'),
				'1' => esc_attr__('collapsed (except on mobiles)','lmm'),
				'2' => esc_attr__('expanded','lmm')
			)
		);		
		// defaults_marker - which overlays are active by default?
		$this->settings['defaults_marker_overlays_custom_active'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section4',
			'title'    => esc_attr__('Checked overlays in control box','lmm'),
			'desc'    => esc_attr__('Custom overlay','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);
		$this->settings['defaults_marker_overlays_custom2_active'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section4',
			'title'   => '',
			'desc'    => esc_attr__('Custom overlay 2','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);		
		
		$this->settings['defaults_marker_overlays_custom3_active'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section4',
			'title'   => '',
			'desc'    => esc_attr__('Custom overlay 3','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);		
		$this->settings['defaults_marker_overlays_custom4_active'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section4',
			'title'   => '',
			'desc'    => esc_attr__('Custom overlay 4','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);		
		$this->settings['defaults_marker_panel'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section4',
			'title'   => esc_attr__('Panel for displaying marker name and API URLs on top of map','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => '1',
			'choices' => array(
				'1' => esc_attr__('show','lmm'),
				'0' => esc_attr__('hide','lmm'),
			)
		);	
		// defaults_marker - active API links in panel
		$this->settings['defaults_marker_panel_directions'] = array(
			'version' => '1.4',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section4',
			'title'    => esc_attr__('Visible API links in panel','lmm'),
			'desc'    => esc_attr__('Directions','lmm') .  ' <img src="' . LEAFLET_PLUGIN_URL . 'inc/img/icon-car.png">',
			'type'    => 'checkbox',
			'std'     => 1 
		);
		$this->settings['defaults_marker_panel_kml'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section4',
			'title'    => '',
			'desc'    => 'KML <img src="' . LEAFLET_PLUGIN_URL . 'inc/img/icon-kml.png">',
			'type'    => 'checkbox',
			'std'     => 1 
		);
		$this->settings['defaults_marker_panel_fullscreen'] = array(
			'version' => '1.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section4',
			'title'    => '',
			'desc'    => esc_attr__('Fullscreen','lmm') .  ' <img src="' . LEAFLET_PLUGIN_URL . 'inc/img/icon-fullscreen.png">',
			'type'    => 'checkbox',
			'std'     => 1 
		);		
		$this->settings['defaults_marker_panel_qr_code'] = array(
			'version' => '1.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section4',
			'title'    => '',
			'desc'    => esc_attr__('QR code','lmm') .  ' <img src="' . LEAFLET_PLUGIN_URL . 'inc/img/icon-qr-code.png">',
			'type'    => 'checkbox',
			'std'     => 1 
		);		
		$this->settings['defaults_marker_panel_geojson'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section4',
			'title'   => '',
			'desc'    => 'GeoJSON <img src="' . LEAFLET_PLUGIN_URL . 'inc/img/icon-json.png">',
			'type'    => 'checkbox',
			'std'     => 1 
		);
		$this->settings['defaults_marker_panel_georss'] = array(
			'version' => '1.2',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section4',
			'title'   => '',
			'desc'    => 'GeoRSS <img src="' . LEAFLET_PLUGIN_URL . 'inc/img/icon-georss.png">',
			'type'    => 'checkbox',
			'std'     => 1 
		);
		$this->settings['defaults_marker_panel_wikitude'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section4',
			'title'   => '',
			'desc'    => 'Wikitude <img src="' . LEAFLET_PLUGIN_URL . 'inc/img/icon-wikitude.png">',
			'type'    => 'checkbox',
			'std'     => 1 
		);		
		$this->settings['defaults_marker_panel_background_color'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section4',
			'title'   => esc_attr__( 'Panel background color', 'lmm' ),
			'desc'    => 'Please use hexadecimal color values',
			'std'     => '#efefef',
			'type'    => 'text'
		);		
		$this->settings['defaults_marker_panel_paneltext_css'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section4',
			'title'   => esc_attr__( 'Panel text css', 'lmm' ),
			'desc'    => '',
			'std'     => 'font-weight:bold;color:#373737;',
			'type'    => 'text'
		);
		// defaults_marker - which WMS layers are active by default?
		$this->settings['defaults_marker_wms_active'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section4',
			'title'    => esc_attr__('Checked WMS layers','lmm'),
			'desc'    => esc_attr__('WMS 1','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);
		$this->settings['defaults_marker_wms2_active'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section4',
			'title'   => '',
			'desc'    => esc_attr__('WMS 2','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);		
		$this->settings['defaults_marker_wms3_active'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section4',
			'title'   => '',
			'desc'    => esc_attr__('WMS 3','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['defaults_marker_wms4_active'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section4',
			'title'   => '',
			'desc'    => esc_attr__('WMS 4','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['defaults_marker_wms5_active'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section4',
			'title'   => '',
			'desc'    => esc_attr__('WMS 5','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['defaults_marker_wms6_active'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section4',
			'title'   => '',
			'desc'    => esc_attr__('WMS 6','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['defaults_marker_wms7_active'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section4',
			'title'   => '',
			'desc'    => esc_attr__('WMS 7','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['defaults_marker_wms8_active'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section4',
			'title'   => '',
			'desc'    => esc_attr__('WMS 8','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['defaults_marker_wms9_active'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section4',
			'title'   => '',
			'desc'    => esc_attr__('WMS 9','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['defaults_marker_wms10_active'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section4',
			'title'   => '',
			'desc'    => esc_attr__('WMS 10','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		/*
		* Default values for marker icons
		*/
		$this->settings['defaults_marker_icon_helptext1'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section5',
			'std'     => '', 
			'title'   => '',
			'desc'    => '',
			'type'    => 'helptext'
		);
		$this->settings['defaults_marker_icon_url'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section5',
			'title'   => esc_attr__( 'Icons URL', 'lmm' ),
			'desc'    => esc_attr__( 'Icons copied to this directory will automatically be available when creating or editing marker maps (cannot be changed)', 'lmm' ),
			'std'     => LEAFLET_PLUGIN_ICONS_URL,
			'type'    => 'text-readonly'
		);		
		$this->settings['defaults_marker_icon_dir'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section5',
			'title'   => esc_attr__( 'Icons directory', 'lmm' ),
			'desc'    => esc_attr__( 'Directory on server where icons are stored - needed especially for WordPress Multisite blogs (cannot be changed)', 'lmm' ),
			'std'     => LEAFLET_PLUGIN_ICONS_DIR,
			'type'    => 'text-readonly'
		);	
		$this->settings['defaults_marker_icon'] = array(
			'version' => '1.8',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section5',
			'title'   => esc_attr__( 'Default icon', 'lmm' ),
			'desc'    => sprintf(esc_attr__( 'If you want to use another icon than the blue pin (<img src="%sleaflet-dist/images/marker.png">), please enter the file name of the icon (located in the directory %s) in the form field - e.g. smiley_happy.png', 'lmm' ),LEAFLET_PLUGIN_URL,LEAFLET_PLUGIN_ICONS_URL),
			'std'     => '',
			'type'    => 'text'
		);
		$this->settings['defaults_marker_icon_title'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section5',
			'title'   => 'title' . '<br/><img src="' . LEAFLET_PLUGIN_URL . 'inc/img/help-marker-title.jpg">',
			'desc'    => esc_attr__('Show marker name for the browser tooltip that appear on marker hover (tooltip is always hidden if marker name is empty).','lmm'),
			'type'    => 'radio',
			'std'     => 'show',
			'choices' => array(
				'show' => esc_attr__('show','lmm'),
				'hide' => esc_attr__('hide','lmm')
			)
		);
		$this->settings['defaults_marker_icon_opacity'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section5',
			'title'   => esc_attr__( 'Opacity', 'lmm' ),
			'desc'    => esc_attr__( 'The opacity of the markers.', 'lmm' ),
			'std'     => '1.0',
			'type'    => 'text'
		);
		$this->settings['defaults_marker_icon_helptext2'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section5',
			'std'     => '', 
			'title'   => '', 
			'desc'    => '<strong>' . esc_attr__('Only change the values below if you are not using marker or shadow icons from the <a href="http://mapicons.nicolasmollet.com" target="_blank">Map Icons Collection</a>!','lmm') . '</strong>',
			'type'    => 'helptext'
		);
		$this->settings['defaults_marker_icon_iconsize_x'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section5',
			'title'   => esc_attr__( 'Icon size', 'lmm' ) . ' (x)',
			'desc'    => esc_attr__( 'Width of the icons in pixel', 'lmm' ),
			'std'     => '32',
			'type'    => 'text'
		);
		$this->settings['defaults_marker_icon_iconsize_y'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section5',
			'title'   => esc_attr__( 'Icon size', 'lmm' ) . ' (y)',
			'desc'    => esc_attr__( 'Height of the icons in pixel', 'lmm' ),
			'std'     => '37',
			'type'    => 'text'
		);
		$this->settings['defaults_marker_icon_iconanchor_x'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section5',
			'title'   => esc_attr__( 'Icon anchor', 'lmm' ) . ' (x)',
			'desc'    => esc_attr__( 'The x-coordinates of the "tip" of the icons (relative to its top left corner).', 'lmm' ),
			'std'     => '17',
			'type'    => 'text'
		);
		$this->settings['defaults_marker_icon_iconanchor_y'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section5',
			'title'   => esc_attr__( 'Icon anchor', 'lmm' ) . ' (y)',
			'desc'    => esc_attr__( 'The y-coordinates of the "tip" of the icons (relative to its top left corner).', 'lmm' ),
			'std'     => '36',
			'type'    => 'text'
		);
		$this->settings['defaults_marker_icon_popupanchor_x'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section5',
			'title'   => esc_attr__( 'Popup anchor', 'lmm' ) . ' (x)',
			'desc'    => esc_attr__( 'The x-coordinates of the popup anchor (relative to its top left corner)', 'lmm' ),
			'std'     => '-1',
			'type'    => 'text'
		);
		$this->settings['defaults_marker_icon_popupanchor_y'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section5',
			'title'   => esc_attr__( 'Popup anchor', 'lmm' ) . ' (y)',
			'desc'    => esc_attr__( 'The y-coordinates of the popup anchor (relative to its top left corner)', 'lmm' ),
			'std'     => '-32',
			'type'    => 'text'
		);		
		$this->settings['defaults_marker_icon_shadow_url'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section5',
			'title'   => esc_attr__( 'Shadow URL', 'lmm' ),
			'desc'    => esc_attr__( 'The URL to the icons shadow image. If not specified, no shadow image will be created. Default shadow icon:', 'lmm' ) . '<img src="' . LEAFLET_PLUGIN_URL . 'leaflet-dist/images/marker-shadow.png">',
			'std'     => LEAFLET_PLUGIN_URL . 'leaflet-dist/images/marker-shadow.png',
			'type'    => 'text-deletable'
		);
		$this->settings['defaults_marker_icon_shadowsize_x'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section5',
			'title'   => esc_attr__( 'Shadow size', 'lmm' ) . ' (x)',
			'desc'    => esc_attr__( 'Width of the shadow icon in pixel', 'lmm' ),
			'std'     => '41',
			'type'    => 'text'
		);
		$this->settings['defaults_marker_icon_shadowsize_y'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section5',
			'title'   => esc_attr__( 'Shadow size', 'lmm' ) . ' (y)',
			'desc'    => esc_attr__( 'Height of the shadow icon in pixel', 'lmm' ),
			'std'     => '41',
			'type'    => 'text'
		);
		$this->settings['defaults_marker_icon_shadowanchor_x'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section5',
			'title'   => esc_attr__( 'Shadow anchor', 'lmm' ) . ' (x)',
			'desc'    => esc_attr__( 'The x-coordinates of the "tip" of the shadow icon (relative to its top left corner)', 'lmm' ),
			'std'     => '16',
			'type'    => 'text'
		);
		$this->settings['defaults_marker_icon_shadowanchor_y'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section5',
			'title'   => esc_attr__( 'Shadow anchor', 'lmm' ) . ' (y)',
			'desc'    => esc_attr__( 'The y-coordinates of the "tip" of the shadow icon (relative to its top left corner)', 'lmm' ),
			'std'     => '43',
			'type'    => 'text'
		);
		/*
		* Default values for marker popups
		*/
		$this->settings['defaults_marker_popups_helptext1'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section6',
			'std'     => '', 
			'title'   => '',
			'desc'    => '',
			'type'    => 'helptext'
		);
		$this->settings['defaults_marker_popups_maxwidth'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section6',
			'title'   => 'maxWidth (px)',
			'desc'    => esc_attr__( 'Maximum width of popups in pixel', 'lmm' ),
			'std'     => '300',
			'type'    => 'text'
		);
		$this->settings['defaults_marker_popups_minwidth'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section6',
			'title'   => 'minWidth (px)',
			'desc'    => esc_attr__( 'Minimum width of popups in pixel', 'lmm' ),
			'std'     => '250',
			'type'    => 'text'
		);
		$this->settings['defaults_marker_popups_maxheight'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section6',
			'title'   => 'maxHeight (px)',
			'desc'    => esc_attr__( 'If set, creates a scrollable container of the given height in pixel inside popups if its content exceeds it.', 'lmm' ),
			'std'     => '160',
			'type'    => 'text-deletable'
		);
		$this->settings['defaults_marker_popups_image_max_width'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section6',
			'title'   => esc_attr__('maximum image width (px)','lmm'),
			'desc'    => esc_attr__( 'Reduce image width in popups automatically to the given value in pixel (only if is wider). The height of the images gets reduced by the according ratio automatically (this feature only works if your theme supports the wp_head()-hook).', 'lmm' ),
			'std'     => '230',
			'type'    => 'text'
		);
		$this->settings['defaults_marker_popups_autopan'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section6',
			'title'   => 'autoPan',
			'desc'    => esc_attr__('Set it to false if you do not want the map to do panning animation to fit the opened popup.','lmm'),
			'type'    => 'radio',
			'std'     => 'true',
			'choices' => array(
				'true' => esc_attr__('true','lmm'),
				'false' => esc_attr__('false','lmm')
			)
		);
		$this->settings['defaults_marker_popups_closebutton'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section6',
			'title'   => 'closeButton',
			'desc'    => esc_attr__('Controls the presence of a close button in popups.','lmm'),
			'type'    => 'radio',
			'std'     => 'true',
			'choices' => array(
				'true' => esc_attr__('true','lmm'),
				'false' => esc_attr__('false','lmm')
			)
		);
		$this->settings['defaults_marker_popups_autopanpadding_x'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section6',
			'title'   => 'autoPanPadding (x)',
			'desc'    => esc_attr__( 'The x-coordinates of the margin between popups and the edges of the map view after autopanning was performed.', 'lmm' ),
			'std'     => '5',
			'type'    => 'text'
		);
		$this->settings['defaults_marker_popups_autopanpadding_y'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section6',
			'title'   => 'autoPanPadding (y)',
			'desc'    => esc_attr__( 'The y-coordinates of the margin between popups and the edges of the map view after autopanning was performed.', 'lmm' ),
			'std'     => '5',
			'type'    => 'text'
		);		
		/*
		* Default values for markers added directly
		*/
		$this->settings['defaults_marker_shortcode_helptext'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section7',
			'std'     => '', 
			'title'   => '',
			'desc'    => esc_attr__( 'You can also add markers directly to posts or pages without having to save them to your database previously. You just have to use the shortcode with the attributes mlat and mlon (e.g. <strong>[mapsmarker mlat="48.216038" mlon="16.378984"]</strong>).', 'lmm') . '<br/><br/><img src="'. LEAFLET_PLUGIN_URL .'inc/img/help-marker-direct.jpg" /><br/><br/>' . esc_attr__('Defaults values for markers added directly:','lmm'),
			'type'    => 'helptext'
		);
		$this->settings['defaults_marker_shortcode_basemap'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section7',
			'title'   => esc_attr__('Default basemap','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'osm_mapnik',
			'choices' => array(
				'osm_mapnik' => esc_attr__('OpenStreetMap (Mapnik, max zoom 18)','lmm'),
				'mapquest_osm' => esc_attr__('MapQuest (OSM, max zoom 18)','lmm'),
				'mapquest_aerial' => esc_attr__('MapQuest (Aerial, max zoom 12 globally, 12+ in the United States)','lmm'),
				'googleLayer_roadmap' => esc_attr__('Google Maps (Roadmap)','lmm'),
				'googleLayer_satellite' => esc_attr__('Google Maps (Satellite)','lmm'),
				'googleLayer_hybrid' => esc_attr__('Google Maps (Hybrid)','lmm'),
				'googleLayer_terrain' => esc_attr__('Google Maps (Terrain)','lmm'),
				'bingaerial' => esc_attr__('Bing Maps (Aerial)','lmm') . ' - <strong>' . esc_attr__('API key required!','lmm') . '</strong> <a href="http://www.mapsmarker.com/bing-maps" target="_blank"><img src="' . LEAFLET_PLUGIN_URL . 'inc/img/icon-question-mark.png" width="12" height="12" border="0"/></a>',
				'bingaerialwithlabels' => esc_attr__('Bing Maps (Aerial+Labels)','lmm') . ' - <strong>' . esc_attr__('API key required!','lmm'). '</strong> <a href="http://www.mapsmarker.com/bing-maps" target="_blank"><img src="' . LEAFLET_PLUGIN_URL . 'inc/img/icon-question-mark.png" width="12" height="12" border="0"/></a>',
				'bingroad' => esc_attr__('Bing Maps (Road)','lmm') . ' - <strong>' . esc_attr__('API key required!','lmm'). '</strong> <a href="http://www.mapsmarker.com/bing-maps" target="_blank"><img src="' . LEAFLET_PLUGIN_URL . 'inc/img/icon-question-mark.png" width="12" height="12" border="0"/></a>',
				'ogdwien_basemap' => esc_attr__('OGD Vienna basemap (max zoom 19)','lmm'),
				'ogdwien_satellite' => esc_attr__('OGD Vienna satellite (max zoom 19)','lmm'),
				'cloudmade' => 'Cloudmade',
				'cloudmade2' => 'Cloudmade 2',
				'cloudmade3' => 'Cloudmade 3',
				'custom_basemap' => esc_attr__('Custom basemap','lmm'),
				'custom_basemap2' => esc_attr__('Custom basemap 2','lmm'),
				'custom_basemap3' => esc_attr__('Custom basemap 3','lmm')
			)
		);
		$this->settings['defaults_marker_shortcode_zoom'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section7',
			'title'   => esc_attr__( 'Zoom', 'lmm' ),
			'desc'    => '',
			'std'     => '11',
			'type'    => 'text'
		);
		$this->settings['defaults_marker_shortcode_mapwidth'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section7',
			'title'   => esc_attr__( 'Map width', 'lmm' ),
			'desc'    => '',
			'std'     => '640',
			'type'    => 'text'
		);
		$this->settings['defaults_marker_shortcode_mapwidthunit'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section7',
			'title'   => esc_attr__('Map width unit','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'px',
			'choices' => array(
				'px' => 'px',
				'%' => '%'
			)
		);
		$this->settings['defaults_marker_shortcode_mapheight'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section7',
			'title'   => esc_attr__( 'Map height', 'lmm' ) . ' (px)',
			'desc'    => '',
			'std'     => '480',
			'type'    => 'text'
		);
		$this->settings['defaults_marker_shortcode_controlbox'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section7',
			'title'   => esc_attr__('Basemap/layer controlbox on frontend','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => '1',
			'choices' => array(
				'0' => esc_attr__('hidden','lmm'),
				'1' => esc_attr__('collapsed (except on mobiles)','lmm'),
				'2' => esc_attr__('expanded','lmm')
			)
		);		
		// defaults_marker - which overlays are active by default?
		$this->settings['defaults_marker_shortcode_overlays_custom_active'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section7',
			'title'    => esc_attr__('Checked overlays in control box','lmm'),
			'desc'    => esc_attr__('Custom overlay','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);
		$this->settings['defaults_marker_shortcode_overlays_custom2_active'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section7',
			'title'   => '',
			'desc'    => esc_attr__('Custom overlay 2','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);		
		
		$this->settings['defaults_marker_shortcode_overlays_custom3_active'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section7',
			'title'   => '',
			'desc'    => esc_attr__('Custom overlay 3','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);		
		
		$this->settings['defaults_marker_shortcode_overlays_custom4_active'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section7',
			'title'   => '',
			'desc'    => esc_attr__('Custom overlay 4','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);		
		// defaults_marker shortcode - which WMS layers are active by default?
		$this->settings['defaults_marker_shortcode_wms_active'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section7',
			'title'    => esc_attr__('Checked WMS layers','lmm'),
			'desc'    => esc_attr__('WMS 1','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);
		$this->settings['defaults_marker_shortcode_wms2_active'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section7',
			'title'   => '',
			'desc'    => esc_attr__('WMS 2','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);		
		$this->settings['defaults_marker_shortcode_wms3_active'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section7',
			'title'   => '',
			'desc'    => esc_attr__('WMS 3','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['defaults_marker_shortcode_wms4_active'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section7',
			'title'   => '',
			'desc'    => esc_attr__('WMS 4','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['defaults_marker_shortcode_wms5_active'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section7',
			'title'   => '',
			'desc'    => esc_attr__('WMS 5','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['defaults_marker_shortcode_wms6_active'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section7',
			'title'   => '',
			'desc'    => esc_attr__('WMS 6','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['defaults_marker_shortcode_wms7_active'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section7',
			'title'   => '',
			'desc'    => esc_attr__('WMS 7','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['defaults_marker_shortcode_wms8_active'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section7',
			'title'   => '',
			'desc'    => esc_attr__('WMS 8','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['defaults_marker_shortcode_wms9_active'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section7',
			'title'   => '',
			'desc'    => esc_attr__('WMS 9','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['defaults_marker_shortcode_wms10_active'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section7',
			'title'   => '',
			'desc'    => esc_attr__('WMS 10','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		/*
		* Default values for new layer maps
		*/
		$this->settings['defaults_layer_helptext1'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section8',
			'std'     => '', 
			'title'   => '',
			'desc'    => esc_attr__( 'Will be used when creating a new layer. All values can be changed afterwards on each layer.', 'lmm') . '<br/><br/><img src="'. LEAFLET_PLUGIN_URL .'inc/img/help-layer-defaults.jpg" />',
			'type'    => 'helptext'
		);
		$this->settings['defaults_layer_lat'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section8',
			'title'   => esc_attr__( 'Latitude', 'lmm' ),
			'desc'    => esc_attr__( 'Please use a dot instead of a coma as decimal delimiter!', 'lmm' ),
			'std'     => '48.216038',
			'type'    => 'text'
		);
		$this->settings['defaults_layer_lon'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section8',
			'title'   => esc_attr__( 'Longitude', 'lmm' ),
			'desc'    => esc_attr__( 'Please use a dot instead of a coma as decimal delimiter!', 'lmm' ),
			'std'     => '16.378984',
			'type'    => 'text'
		);
		$this->settings['defaults_layer_zoom'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section8',
			'title'   => esc_attr__( 'Zoom', 'lmm' ),
			'desc'    => '',
			'std'     => '11',
			'type'    => 'text'
		);
		$this->settings['defaults_layer_mapwidth'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section8',
			'title'   => esc_attr__( 'Map width', 'lmm' ),
			'desc'    => '',
			'std'     => '640',
			'type'    => 'text'
		);
		$this->settings['defaults_layer_mapwidthunit'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section8',
			'title'   => esc_attr__('Map width unit','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'px',
			'choices' => array(
				'px' => 'px',
				'%' => '%'
			)
		);
		$this->settings['defaults_layer_mapheight'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section8',
			'title'   => esc_attr__( 'Map height', 'lmm' ) . ' (px)',
			'desc'    => '',
			'std'     => '480',
			'type'    => 'text'
		);
		$this->settings['defaults_layer_controlbox'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section8',
			'title'   => esc_attr__('Basemap/layer controlbox on frontend','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => '1',
			'choices' => array(
				'0' => esc_attr__('hidden','lmm'),
				'1' => esc_attr__('collapsed (except on mobiles)','lmm'),
				'2' => esc_attr__('expanded','lmm')
			)
		);		
		// defaults_layer - which overlays are active by default?
		$this->settings['defaults_layer_overlays_custom_active'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section8',
			'title'    => esc_attr__('Checked overlays in control box','lmm'),
			'desc'    => esc_attr__('Custom overlay','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);
		$this->settings['defaults_layer_overlays_custom2_active'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section8',
			'title'   => '',
			'desc'    => esc_attr__('Custom overlay 2','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);		
		$this->settings['defaults_layer_overlays_custom3_active'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section8',
			'title'   => '',
			'desc'    => esc_attr__('Custom overlay 3','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);		
		$this->settings['defaults_layer_overlays_custom4_active'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section8',
			'title'   => '',
			'desc'    => esc_attr__('Custom overlay 4','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);		
		$this->settings['defaults_layer_panel'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section8',
			'title'   => esc_attr__('Panel for displaying layer name and API URLs on top of map','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => '1',
			'choices' => array(
				'1' => esc_attr__('show','lmm'),
				'0' => esc_attr__('hide','lmm'),
			)
		);	
		// defaults_layer - active API links in panel
		$this->settings['defaults_layer_panel_kml'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section8',
			'title'    => esc_attr__('Visible API links in panel','lmm'),
			'desc'    => 'KML <img src="' . LEAFLET_PLUGIN_URL . 'inc/img/icon-kml.png">',
			'type'    => 'checkbox',
			'std'     => 1 
		);
		$this->settings['defaults_layer_panel_fullscreen'] = array(
			'version' => '1.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section8',
			'title'    => '',
			'desc'    => esc_attr__('Fullscreen','lmm') .  ' <img src="' . LEAFLET_PLUGIN_URL . 'inc/img/icon-fullscreen.png">',
			'type'    => 'checkbox',
			'std'     => 1 
		);		
		$this->settings['defaults_layer_panel_qr_code'] = array(
			'version' => '1.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section8',
			'title'    => '',
			'desc'    => esc_attr__('QR code','lmm') .  ' <img src="' . LEAFLET_PLUGIN_URL . 'inc/img/icon-qr-code.png">',
			'type'    => 'checkbox',
			'std'     => 1 
		);		
		$this->settings['defaults_layer_panel_geojson'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section8',
			'title'   => '',
			'desc'    => 'GeoJSON <img src="' . LEAFLET_PLUGIN_URL . 'inc/img/icon-json.png"> (' . esc_attr__('not available on multi layer maps','lmm') . ')',
			'type'    => 'checkbox',
			'std'     => 1 
		);
		$this->settings['defaults_layer_panel_georss'] = array(
			'version' => '1.2',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section8',
			'title'   => '',
			'desc'    => 'GeoRSS <img src="' . LEAFLET_PLUGIN_URL . 'inc/img/icon-georss.png">',
			'type'    => 'checkbox',
			'std'     => 1 
		);
		$this->settings['defaults_layer_panel_wikitude'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section8',
			'title'   => '',
			'desc'    => 'Wikitude <img src="' . LEAFLET_PLUGIN_URL . 'inc/img/icon-wikitude.png">',
			'type'    => 'checkbox',
			'std'     => 1 
		);		
		$this->settings['defaults_layer_panel_background_color'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section8',
			'title'   => esc_attr__( 'Panel background color', 'lmm' ),
			'desc'    => 'Please use hexadecimal color values',
			'std'     => '#efefef',
			'type'    => 'text'
		);		
		$this->settings['defaults_layer_panel_paneltext_css'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section8',
			'title'   => esc_attr__( 'Panel text css', 'lmm' ),
			'desc'    => '',
			'std'     => 'font-weight:bold;color:#373737;',
			'type'    => 'text'
		);		
		// defaults_layer - which WMS layers are active by default?
		$this->settings['defaults_layer_wms_active'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section8',
			'title'    => esc_attr__('Checked WMS layers','lmm'),
			'desc'    => esc_attr__('WMS 1','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);
		$this->settings['defaults_layer_wms2_active'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section8',
			'title'   => '',
			'desc'    => esc_attr__('WMS 2','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);		
		$this->settings['defaults_layer_wms3_active'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section8',
			'title'   => '',
			'desc'    => esc_attr__('WMS 3','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['defaults_layer_wms4_active'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section8',
			'title'   => '',
			'desc'    => esc_attr__('WMS 4','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['defaults_layer_wms5_active'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section8',
			'title'   => '',
			'desc'    => esc_attr__('WMS 5','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['defaults_layer_wms6_active'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section8',
			'title'   => '',
			'desc'    => esc_attr__('WMS 6','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['defaults_layer_wms7_active'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section8',
			'title'   => '',
			'desc'    => esc_attr__('WMS 7','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['defaults_layer_wms8_active'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section8',
			'title'   => '',
			'desc'    => esc_attr__('WMS 8','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['defaults_layer_wms9_active'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section8',
			'title'   => '',
			'desc'    => esc_attr__('WMS 9','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['defaults_layer_wms10_active'] = array(
			'version' => '1.0',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section8',
			'title'   => '',
			'desc'    => esc_attr__('WMS 10','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		/*
		* List marker settings
		*/
		$this->settings['defaults_layer_listmarkers'] = array(
			'version' => '1.5',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section9',
			'title'   => esc_attr__('Display a list of markers under the map','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => '1',
			'choices' => array(
				'0' => esc_attr__('no','lmm'),
				'1' => esc_attr__('yes','lmm')
			)
		);			
		$this->settings['defaults_layer_listmarkers_show_icon'] = array(
			'version' => '2.6',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section9',
			'title'    => esc_attr__('Marker attributes to display in list','lmm'),
			'desc'    => esc_attr__('Icon','lmm'),
			'type'    => 'checkbox',
			'std'     => 1 
		);
		$this->settings['defaults_layer_listmarkers_show_markername'] = array(
			'version' => '2.6',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section9',
			'title'    => '',
			'desc'    => esc_attr__('Marker name','lmm'),
			'type'    => 'checkbox',
			'std'     => 1 
		);
		$this->settings['defaults_layer_listmarkers_show_popuptext'] = array(
			'version' => '2.6',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section9',
			'title'    => '',
			'desc'    => esc_attr__('Popup text','lmm'),
			'type'    => 'checkbox',
			'std'     => 1 
		);
		$this->settings['defaults_layer_listmarkers_order_by'] = array(
			'version' => '1.5',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section9',
			'title'   => esc_attr__('Order list of markers by','lmm'),
			'desc'    =>  esc_attr__('(not available on multi layer maps)','lmm'),
			'type'    => 'radio',
			'std'     => 'm.id',
			'choices' => array(
				'm.id' => 'ID',
				'm.markername' => esc_attr__('marker name','lmm'),
				'm.createdon' => esc_attr__('created on','lmm'),
				'm.updatedon' => esc_attr__('updated on','lmm')
			)
		);
		$this->settings['defaults_layer_listmarkers_sort_order'] = array(
			'version' => '1.5',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section9',
			'title'   => esc_attr__('Sort order','lmm'),
			'desc'    =>  esc_attr__('(not available on multi layer maps)','lmm'),
			'type'    => 'radio',
			'std'     => 'ASC',
			'choices' => array(
				'ASC' => esc_attr__('ascending','lmm'),
				'DESC' => esc_attr__('descending','lmm')
			)
		);
		$this->settings['defaults_layer_listmarkers_limit'] = array(
			'version' => '1.7',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section9',
			'title'   => esc_attr__( 'Limit', 'lmm' ),
			'desc'    => esc_attr__( 'maximum number of markers to display in the list', 'lmm' ) . ' ' .  esc_attr__('(not available on multi layer maps)','lmm'),
			'std'     => '100',
			'type'    => 'text'
		);
		// defaults_layer - active API links in markers list
		$this->settings['defaults_layer_listmarkers_api_directions'] = array(
			'version' => '2.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section9',
			'title'    => esc_attr__('Visible API links for each marker','lmm'),
			'desc'    => esc_attr__('Directions','lmm') .  ' <img src="' . LEAFLET_PLUGIN_URL . 'inc/img/icon-car.png">',
			'type'    => 'checkbox',
			'std'     => 1 
		);
		$this->settings['defaults_layer_listmarkers_api_kml'] = array(
			'version' => '2.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section9',
			'title'    => '',
			'desc'    => 'KML <img src="' . LEAFLET_PLUGIN_URL . 'inc/img/icon-kml.png">',
			'type'    => 'checkbox',
			'std'     => 1 
		);
		$this->settings['defaults_layer_listmarkers_api_fullscreen'] = array(
			'version' => '2.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section9',
			'title'    => '',
			'desc'    => esc_attr__('Fullscreen','lmm') .  ' <img src="' . LEAFLET_PLUGIN_URL . 'inc/img/icon-fullscreen.png">',
			'type'    => 'checkbox',
			'std'     => 1 
		);		
		$this->settings['defaults_layer_listmarkers_api_qr_code'] = array(
			'version' => '2.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section9',
			'title'    => '',
			'desc'    => esc_attr__('QR code','lmm') .  ' <img src="' . LEAFLET_PLUGIN_URL . 'inc/img/icon-qr-code.png">',
			'type'    => 'checkbox',
			'std'     => 0 
		);		
		$this->settings['defaults_layer_listmarkers_api_geojson'] = array(
			'version' => '2.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section9',
			'title'   => '',
			'desc'    => 'GeoJSON <img src="' . LEAFLET_PLUGIN_URL . 'inc/img/icon-json.png">',
			'type'    => 'checkbox',
			'std'     => 0 
		);
		$this->settings['defaults_layer_listmarkers_api_georss'] = array(
			'version' => '2.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section9',
			'title'   => '',
			'desc'    => 'GeoRSS <img src="' . LEAFLET_PLUGIN_URL . 'inc/img/icon-georss.png">',
			'type'    => 'checkbox',
			'std'     => 0 
		);
		$this->settings['defaults_layer_listmarkers_api_wikitude'] = array(
			'version' => '2.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section9',
			'title'   => '',
			'desc'    => 'Wikitude <img src="' . LEAFLET_PLUGIN_URL . 'inc/img/icon-wikitude.png">',
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		/*
		* Interaction options 
		* formerly "General map settings" and moved to "Basemaps" from "Misc" tab
		*/
		$this->settings['map_interaction_options_helptext'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section10',
			'std'     => '', 
			'title'   => '',
			'desc'    => esc_attr__( 'The following settings will be used for all marker and layer maps', 'lmm'),
			'type'    => 'helptext'
		);
		$this->settings['misc_map_dragging'] = array(
			'version' => '2.2',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section10',
			'title'   => 'dragging',
			'desc'    => esc_attr__('Whether the map be draggable with mouse/touch or not.','lmm'),
			'type'    => 'radio',
			'std'     => 'true',
			'choices' => array(
				'true' => esc_attr__('true','lmm'),
				'false' => esc_attr__('false','lmm')
			)
		);			
		$this->settings['misc_map_touchzoom'] = array(
			'version' => '2.2',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section10',
			'title'   => 'touchZoom',
			'desc'    => esc_attr__('Whether the map can be zoomed by touch-dragging with two fingers.','lmm'),
			'type'    => 'radio',
			'std'     => 'true',
			'choices' => array(
				'true' => esc_attr__('true','lmm'),
				'false' => esc_attr__('false','lmm')
			)
		);			
		$this->settings['misc_map_scrollwheelzoom'] = array(
			'version' => '2.2',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section10',
			'title'   => 'scrollWheelZoom',
			'desc'    => esc_attr__('Whether the map can be zoomed by using the mouse wheel.','lmm'),
			'type'    => 'radio',
			'std'     => 'true',
			'choices' => array(
				'true' => esc_attr__('true','lmm'),
				'false' => esc_attr__('false','lmm')
			)
		);	
		$this->settings['misc_map_doubleclickzoom'] = array(
			'version' => '2.2',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section10',
			'title'   => 'doubleClickZoom',
			'desc'    => esc_attr__('Whether the map can be zoomed in by double clicking on it.','lmm'),
			'type'    => 'radio',
			'std'     => 'true',
			'choices' => array(
				'true' => esc_attr__('true','lmm'),
				'false' => esc_attr__('false','lmm')
			)
		);					
		$this->settings['map_interaction_options_boxzoom'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section10',
			'title'   => 'boxzoom',
			'desc'    => esc_attr__('Whether the map can be zoomed to a rectangular area specified by dragging the mouse while pressing shift.','lmm'),
			'type'    => 'radio',
			'std'     => 'true',
			'choices' => array(
				'true' => esc_attr__('true','lmm'),
				'false' => esc_attr__('false','lmm')
			)
		);		
		$this->settings['misc_map_trackresize'] = array(
			'version' => '2.2',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section10',
			'title'   => 'trackResize',
			'desc'    => esc_attr__('Whether the map automatically handles browser window resize to update itself.','lmm'),
			'type'    => 'radio',
			'std'     => 'true',
			'choices' => array(
				'true' => esc_attr__('true','lmm'),
				'false' => esc_attr__('false','lmm')
			)
		);	
		$this->settings['map_interaction_options_worldcopyjump'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section10',
			'title'   => 'worldCopyJump',
			'desc'    => esc_attr__('With this option enabled, the map tracks when you pan to another "copy" of the world and moves all overlays like markers and vector layers there.','lmm'),
			'type'    => 'radio',
			'std'     => 'true',
			'choices' => array(
				'true' => esc_attr__('true','lmm'),
				'false' => esc_attr__('false','lmm')
			)
		);		
		$this->settings['misc_map_closepopuponclick'] = array(
			'version' => '2.2',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section10',
			'title'   => 'closePopupOnClick',
			'desc'    => esc_attr__('Set it to false if you do not want popups to close when user clicks the map.','lmm'),
			'type'    => 'radio',
			'std'     => 'true',
			'choices' => array(
				'true' => esc_attr__('true','lmm'),
				'false' => esc_attr__('false','lmm')
			)
		);			
		/*
		* Keyboard navigation options 
		*/
		$this->settings['map_keyboard_navigation_options_helptext'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section11',
			'std'     => '', 
			'title'   => '',
			'desc'    => esc_attr__( 'The following settings will be used for all marker and layer maps', 'lmm'),
			'type'    => 'helptext'
		);		
		$this->settings['map_keyboard_navigation_options_keyboard'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section11',
			'title'   => 'keyboard',
			'desc'    => esc_attr__('Makes the map focusable and allows users to navigate the map with keyboard arrows and +/- keys','lmm'),
			'type'    => 'radio',
			'std'     => 'true',
			'choices' => array(
				'true' => esc_attr__('true','lmm'),
				'false' => esc_attr__('false','lmm')
			)
		);			
		$this->settings['map_keyboard_navigation_options_keyboardpanoffset'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section11',
			'title'   => 'keyboardPanOffset',
			'desc'    => esc_attr__('Amount of pixels to pan when pressing an arrow key','lmm'),
			'std'     => '80',
			'type'    => 'text'
		);
		$this->settings['map_keyboard_navigation_options_keyboardzoomoffset'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section11',
			'title'   => 'keyboardZoomOffset',
			'desc'    => esc_attr__( 'Number of zoom levels to change when pressing + or - key.', 'lmm' ),
			'std'     => '1',
			'type'    => 'text'
		);
		$this->settings['map_keyboard_navigation_options_helptext2'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section11',
			'std'     => '', 
			'title'   => '',
			'desc'    => '<div style="height:305px;"></div>',
			'type'    => 'helptext'
		);			
		/*
		* Panning inertia options
		*/
		$this->settings['map_panning_inertia_options_helptext'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section12',
			'std'     => '', 
			'title'   => '',
			'desc'    => esc_attr__( 'The following settings will be used for all marker and layer maps', 'lmm'),
			'type'    => 'helptext'
		);		
		$this->settings['map_panning_inertia_options_inertia'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section12',
			'title'   => 'inertia',
			'desc'    => esc_attr__('If enabled, panning of the map will have an inertia effect where the map builds momentum while dragging and continues moving in the same direction for some time. Feels especially nice on touch devices.','lmm'),
			'type'    => 'radio',
			'std'     => 'true',
			'choices' => array(
				'true' => esc_attr__('true','lmm'),
				'false' => esc_attr__('false','lmm')
			)
		);			
		$this->settings['map_panning_inertia_options_inertiadeceleration'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section12',
			'title'   => 'inertiaDeceleration',
			'desc'    => esc_attr__('The rate with which the inertial movement slows down, in pixels/second','lmm'),
			'std'     => '3000',
			'type'    => 'text'
		);
		$this->settings['map_panning_inertia_options_inertiamaxspeed'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section12',
			'title'   => 'inertiaMaxSpeed',
			'desc'    => esc_attr__('Max speed of the inertial movement, in pixels/second.','lmm'),
			'std'     => '1500',
			'type'    => 'text'
		);
		$this->settings['map_panning_inertia_options_helptext2'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section12',
			'std'     => '', 
			'title'   => '',
			'desc'    => '<div style="height:305px;"></div>',
			'type'    => 'helptext'
		);			
		/*
		* Control options
		*/
		$this->settings['map_control_options_helptext'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section13',
			'title'   => '',
			'desc'    => esc_attr__( 'The following settings will be used for all marker and layer maps', 'lmm'),
			'std'     => '', 
			'type'    => 'helptext'
		);	
		$this->settings['misc_map_zoomcontrol'] = array(
			'version' => '2.2',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section13',
			'title'   => 'zoomControl',
			'desc'    => esc_attr__('Whether the zoom control is added to the map by default.','lmm'),
			'type'    => 'radio',
			'std'     => 'true',
			'choices' => array(
				'true' => esc_attr__('true','lmm'),
				'false' => esc_attr__('false','lmm')
			)
		);
		$this->settings['map_control_options_helptext2'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section13',
			'title'   => '',
			'desc'    => '<div style="height:425px;"></div>',
			'std'     => '', 
			'type'    => 'helptext'
		);			
		/*
		* Scale control options
		*/
		$this->settings['map_scale_control_helptext'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section14',
			'std'     => '', 
			'title'   => '',
			'desc'    => esc_attr__( 'A simple scale control that shows the scale of the current center of screen in metric (m/km) and/or imperial (mi/ft) systems. The following settings will be used for all marker and layer maps.', 'lmm').'<br/><br/><img src="'. LEAFLET_PLUGIN_URL .'inc/img/help-basemap-scale-control.jpg" />',
			'type'    => 'helptext'
		);	
		$this->settings['map_scale_control'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section14',
			'title'   => esc_attr__('Scale Control','lmm'),
			'desc'    => esc_attr__('Whether the scale control is added to the map by default.','lmm'),
			'type'    => 'radio',
			'std'     => 'enabled',
			'choices' => array(
				'enabled' => esc_attr__('enabled','lmm'),
				'disabled' => esc_attr__('disabled','lmm')
			)
		);
		$this->settings['map_scale_control_position'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section14',
			'title'   => esc_attr__('Position','lmm'),
			'desc'    => esc_attr__('The position of the control (one of the map corners).','lmm'),
			'type'    => 'radio',
			'std'     => 'bottomleft',
			'choices' => array(
				'bottomleft' => esc_attr__('Bottom left of the map','lmm'),
				'bottomright' => esc_attr__('Bottom right of the map','lmm'),
				'topright' => esc_attr__('Top right of the map','lmm'),
				'topleft' => esc_attr__('Top left of the map','lmm')
			)
		);
		$this->settings['map_scale_control_maxwidth'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section14',
			'title'   => 'maxWidth',
			'desc'    => esc_attr__('Maximum width of the control in pixels. The width is set dynamically to show round values (e.g. 100, 200, 500).','lmm'),
			'std'     => '100',
			'type'    => 'text'
		);		
		$this->settings['map_scale_control_metric'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section14',
			'title'   => 'metric',
			'desc'    => esc_attr__('Whether to show the metric scale line (m/km).','lmm'),
			'type'    => 'radio',
			'std'     => 'true',
			'choices' => array(
				'true' => esc_attr__('true','lmm'),
				'false' => esc_attr__('false','lmm')
			)
		);		
		$this->settings['map_scale_control_imperial'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section14',
			'title'   => 'imperial',
			'desc'    => esc_attr__('Whether to show the imperial scale line (mi/ft).','lmm'),
			'type'    => 'radio',
			'std'     => 'true',
			'choices' => array(
				'true' => esc_attr__('true','lmm'),
				'false' => esc_attr__('false','lmm')
			)
		);			
		$this->settings['map_scale_control_updatewhenidle'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section14',
			'title'   => 'updateWhenIdle',
			'desc'    => esc_attr__('If true, the control is updated on moveend, otherwise it is always up-to-date (updated on move).','lmm'),
			'type'    => 'radio',
			'std'     => 'false',
			'choices' => array(
				'true' => esc_attr__('true','lmm'),
				'false' => esc_attr__('false','lmm')
			)
		);	
		/*
		* Retina display detection
		*/
		$this->settings['map_retina_detection_helptext'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section15',
			'std'     => '', 
			'title'   => '',
			'desc'    => esc_attr__( 'The following settings will be used for all marker and layer maps', 'lmm'),
			'type'    => 'helptext'
		);	
		$this->settings['map_retina_detection'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section15',
			'title'   => 'detectRetina',
			'desc'    => esc_attr__('If true and user is on a retina display (= iPhone 4/4S/5, iPad 3, MacBook Pro 3rd Generation), it will request four tiles of half the specified size and a bigger zoom level in place of one to utilize the high resolution.','lmm'),
			'type'    => 'radio',
			'std'     => 'true',
			'choices' => array(
				'true' => esc_attr__('true','lmm'),
				'false' => esc_attr__('false','lmm')
			)
		);	
		$this->settings['map_retina_detection_helptext2'] = array(
			'version' => '2.7.1',
			'pane'    => 'mapdefaults',
			'section' => 'mapdefaults-section15',
			'std'     => '', 
			'title'   => '',
			'desc'    => '<div style="height:410px;"></div>',
			'type'    => 'helptext'
		);			
		
		/*===========================================
		*
		*
		* pane basemaps
		*
		*
		===========================================*/
		/*
		* Cloudmade settings
		*/
		$this->settings['cloudmade_helptext'] = array(
			'version' => '1.6',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section1',
			'std'     => '', 
			'title'   => '',
			'desc'    => esc_attr__( 'Tutorial for Cloudmade configuration:', 'lmm').'<a href="http://mapsmarker.com/cloudmade" target="_blank">http://mapsmarker.com/cloudmade</a><br/><br/><img src="'. LEAFLET_PLUGIN_URL .'inc/img/help-default-basemap-cloudmade.jpg" />',
			'type'    => 'helptext'
		);
		$this->settings['cloudmade_api_key'] = array(
			'version' => '1.6',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section1',
			'title'   => esc_attr__( 'API key', 'lmm' ),
			'desc'    => '',
			'std'     => '',
			'type'    => 'text'
		);
		$this->settings['cloudmade_styleid'] = array(
			'version' => '1.6',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section1',
			'title'   => 'styleID',
			'desc'    => '',
			'std'     => '',
			'type'    => 'text'
		);
		$this->settings['cloudmade_double_resolution'] = array(
			'version' => '1.6',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section1',
			'title'   => esc_attr__('Double resolution','lmm'),
			'desc'    => esc_attr__('This will improve map look for iPhone 4, Motorola Milestone, etc.','lmm'),
			'type'    => 'radio',
			'std'     => 'enabled',
			'choices' => array(
				'enabled' => esc_attr__('enabled','lmm'),
				'disabled' => esc_attr__('disabled','lmm')
			)
		);	
		/*
		* Cloudmade 2 settings
		*/
		$this->settings['cloudmade2_helptext'] = array(
			'version' => '1.6',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section2',
			'std'     => '', 
			'title'   => '',
			'desc'    => esc_attr__( 'Tutorial for Cloudmade configuration:', 'lmm').'<a href="http://mapsmarker.com/cloudmade" target="_blank">http://mapsmarker.com/cloudmade</a><br/><br/><img src="'. LEAFLET_PLUGIN_URL .'inc/img/help-default-basemap-cloudmade.jpg" />',
			'type'    => 'helptext'
		);
		$this->settings['cloudmade2_api_key'] = array(
			'version' => '1.6',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section2',
			'title'   => esc_attr__( 'API key', 'lmm' ),
			'desc'    => '',
			'std'     => '',
			'type'    => 'text'
		);
		$this->settings['cloudmade2_styleid'] = array(
			'version' => '1.6',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section2',
			'title'   => 'styleID',
			'desc'    => '',
			'std'     => '',
			'type'    => 'text'
		);		
		$this->settings['cloudmade2_double_resolution'] = array(
			'version' => '1.6',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section2',
			'title'   => esc_attr__('Double resolution','lmm'),
			'desc'    => esc_attr__('This will improve map look for iPhone 4, Motorola Milestone, etc.','lmm'),
			'type'    => 'radio',
			'std'     => 'enabled',
			'choices' => array(
				'enabled' => esc_attr__('enabled','lmm'),
				'disabled' => esc_attr__('disabled','lmm')
			)
		);		
		/*
		* Cloudmade 3 settings
		*/
		$this->settings['cloudmade3_helptext'] = array(
			'version' => '1.6',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section3',
			'std'     => '', 
			'title'   => '',
			'desc'    => esc_attr__( 'Tutorial for Cloudmade configuration:', 'lmm').'<a href="http://mapsmarker.com/cloudmade" target="_blank">http://mapsmarker.com/cloudmade</a><br/><br/><img src="'. LEAFLET_PLUGIN_URL .'inc/img/help-default-basemap-cloudmade.jpg" />',
			'type'    => 'helptext'
		);
		$this->settings['cloudmade3_api_key'] = array(
			'version' => '1.6',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section3',
			'title'   => esc_attr__( 'API key', 'lmm' ),
			'desc'    => '',
			'std'     => '',
			'type'    => 'text'
		);
		$this->settings['cloudmade3_styleid'] = array(
			'version' => '1.6',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section3',
			'title'   => 'styleID',
			'desc'    => '',
			'std'     => '',
			'type'    => 'text'
		);		
		$this->settings['cloudmade3_double_resolution'] = array(
			'version' => '1.6',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section3',
			'title'   => esc_attr__('Double resolution','lmm'),
			'desc'    => esc_attr__('This will improve map look for iPhone 4, Motorola Milestone, etc.','lmm'),
			'type'    => 'radio',
			'std'     => 'enabled',
			'choices' => array(
				'enabled' => esc_attr__('enabled','lmm'),
				'disabled' => esc_attr__('disabled','lmm')
			)
		);	
		/*
		* MapBox settings
		*/
		$this->settings['mapbox_helptext'] = array(
			'version' => '2.1',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section4',
			'std'     => '', 
			'title'   => '',
			'desc'    => '<img src="'. LEAFLET_PLUGIN_URL .'inc/img/help-default-basemap-mapbox.jpg" />',
			'type'    => 'helptext'
		);
		$this->settings['mapbox_user'] = array(
			'version' => '2.1',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section4',
			'title'   => esc_attr__( 'User', 'lmm' ),
			'desc'    => esc_attr__('e.g.','lmm') . 'http://tiles.mapbox.com/<strong>mapbox</strong>/map/blue-marble-topo-jul',
			'std'     => 'mapbox',
			'type'    => 'text'
		);
		$this->settings['mapbox_map'] = array(
			'version' => '2.1',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section4',
			'title'   => esc_attr__('map','lmm'),
			'desc'    => esc_attr__('e.g.','lmm') . 'http://tiles.mapbox.com/mapbox/map/<strong>blue-marble-topo-jul</strong>',
			'std'     => 'blue-marble-topo-jul',
			'type'    => 'text'
		);
		$this->settings['mapbox_minzoom'] = array(
			'version' => '2.1',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section4',
			'title'   => esc_attr__('Minimum zoom level','lmm'),
			'desc'    => '',
			'std'     => '0',
			'type'    => 'text'
		);
		$this->settings['mapbox_maxzoom'] = array(
			'version' => '2.1',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section4',
			'title'   => esc_attr__('Maximum zoom level','lmm'),
			'desc'    => '',
			'std'     => '8',
			'type'    => 'text'
		);
		$this->settings['mapbox_attribution'] = array(
			'version' => '2.1',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section4',
			'title'   => esc_attr__('Attribution','lmm'),
			'desc'    => esc_attr__("For example","lmm"). ": Copyright ".date('Y')." &lt;a href=&quot;http://xy.com&quot;&gt;Provider X&lt;/a&gt;",
			'std'     => "MapBox/NASA, <a href=&quot;http://www.mapbox.com&quot; target=&quot;_blank&quot;>http://www.mapbox.com</a>",
			'type'    => 'text'
		);
		/*
		* MapBox 2 settings
		*/
		$this->settings['mapbox2_helptext'] = array(
			'version' => '2.1',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section5',
			'std'     => '', 
			'title'   => '',
			'desc'    => '<img src="'. LEAFLET_PLUGIN_URL .'inc/img/help-default-basemap-mapbox.jpg" />',
			'type'    => 'helptext'
		);
		$this->settings['mapbox2_user'] = array(
			'version' => '2.1',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section5',
			'title'   => esc_attr__( 'User', 'lmm' ),
			'desc'    => esc_attr__('e.g.','lmm') . 'http://tiles.mapbox.com/<strong>mapbox</strong>/map/geography-class',
			'std'     => 'mapbox',
			'type'    => 'text'
		);
		$this->settings['mapbox2_map'] = array(
			'version' => '2.1',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section5',
			'title'   => esc_attr__('map','lmm'),
			'desc'    => esc_attr__('e.g.','lmm') . 'http://tiles.mapbox.com/mapbox/map/<strong>geography-class</strong>',
			'std'     => 'geography-class',
			'type'    => 'text'
		);	
		$this->settings['mapbox2_minzoom'] = array(
			'version' => '2.1',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section5',
			'title'   => esc_attr__('Minimum zoom level','lmm'),
			'desc'    => '',
			'std'     => '0',
			'type'    => 'text'
		);
		$this->settings['mapbox2_maxzoom'] = array(
			'version' => '2.1',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section5',
			'title'   => esc_attr__('Maximum zoom level','lmm'),
			'desc'    => '',
			'std'     => '8',
			'type'    => 'text'
		);
		$this->settings['mapbox2_attribution'] = array(
			'version' => '2.1',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section5',
			'title'   => esc_attr__('Attribution','lmm'),
			'desc'    => esc_attr__("For example","lmm"). ": Copyright ".date('Y')." &lt;a href=&quot;http://xy.com&quot;&gt;Provider X&lt;/a&gt;",
			'std'     => "MapBox, <a href=&quot;http://www.mapbox.com&quot; target=&quot;_blank&quot;>http://www.mapbox.com</a>",
			'type'    => 'text'
		);
		/*
		* MapBox 3 settings
		*/
		$this->settings['mapbox3_helptext'] = array(
			'version' => '2.1',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section6',
			'std'     => '', 
			'title'   => '',
			'desc'    => '<img src="'. LEAFLET_PLUGIN_URL .'inc/img/help-default-basemap-mapbox.jpg" />',
			'type'    => 'helptext'
		);
		$this->settings['mapbox3_user'] = array(
			'version' => '2.1',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section6',
			'title'   => esc_attr__( 'User', 'lmm' ),
			'desc'    => esc_attr__('e.g.','lmm') . 'http://tiles.mapbox.com/<strong>mapbox</strong>/map/mapbox-streets',
			'std'     => 'mapbox',
			'type'    => 'text'
		);
		$this->settings['mapbox3_map'] = array(
			'version' => '2.1',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section6',
			'title'   => esc_attr__('map','lmm'),
			'desc'    => esc_attr__('e.g.','lmm') . 'http://tiles.mapbox.com/mapbox/map/<strong>mapbox-streets</strong>',
			'std'     => 'mapbox-streets',
			'type'    => 'text'
		);					
		$this->settings['mapbox3_minzoom'] = array(
			'version' => '2.1',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section6',
			'title'   => esc_attr__('Minimum zoom level','lmm'),
			'desc'    => '',
			'std'     => '0',
			'type'    => 'text'
		);
		$this->settings['mapbox3_maxzoom'] = array(
			'version' => '2.1',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section6',
			'title'   => esc_attr__('Maximum zoom level','lmm'),
			'desc'    => '',
			'std'     => '17',
			'type'    => 'text'
		);
		$this->settings['mapbox3_attribution'] = array(
			'version' => '2.1',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section6',
			'title'   => esc_attr__('Attribution','lmm'),
			'desc'    => esc_attr__("For example","lmm"). ": Copyright ".date('Y')." &lt;a href=&quot;http://xy.com&quot;&gt;Provider X&lt;/a&gt;",
			'std'     => "MapBox, <a href=&quot;http://www.mapbox.com&quot; target=&quot;_blank&quot;>http://www.mapbox.com</a>",
			'type'    => 'text'
		);
		/*
		* Custom basemap 1 settings
		*/
		$this->settings['custom_basemap_helptext'] = array(
			'version' => '1.0',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section7',
			'std'     => '', 
			'title'   => '',
			'desc'    => esc_attr__( 'Please enter settings for custom basemap', 'lmm').' (custom 1):<br/><br/><img src="'. LEAFLET_PLUGIN_URL .'inc/img/help-default-basemap-custom-basemaps.jpg" />',
			'type'    => 'helptext'
		);
		$this->settings['custom_basemap_tileurl'] = array(
			'version' => '1.0',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section7',
			'title'   => esc_attr__( 'Tiles URL', 'lmm' ),
			'desc'    => esc_attr__("For example","lmm"). ": http://{s}.mqcdn.com/tiles/1.0.0/osm/{z}/{x}/{y}.png",
			'std'     => 'http://{s}.mqcdn.com/tiles/1.0.0/osm/{z}/{x}/{y}.png',
			'type'    => 'text'
		);
		$this->settings['custom_basemap_attribution'] = array(
			'version' => '1.0',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section7',
			'title'   => esc_attr__( 'Attribution', 'lmm' ),
			'desc'    => esc_attr__("For example","lmm"). ": Copyright ".date('Y')." &lt;a href=&quot;http://xy.com&quot;&gt;Provider X&lt;/a&gt;",
			'std'     => "Copyright ".date('Y')." <a href=&quot;http://xy.com&quot;>Provider X</a>",
			'type'    => 'text'
		);
		$this->settings['custom_basemap_minzoom'] = array(
			'version' => '1.0',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section7',
			'title'   => esc_attr__( 'Minimum zoom level', 'lmm' ),
			'desc'    => esc_attr__('Note: maximum zoom level may vary on your basemap','lmm'),
			'std'     => '1',
			'type'    => 'text'
		);
		$this->settings['custom_basemap_maxzoom'] = array(
			'version' => '1.0',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section7',
			'title'   => esc_attr__( 'Maximum zoom level', 'lmm' ),
			'desc'    => esc_attr__('Note: maximum zoom level may vary on your basemap','lmm'),
			'std'     => '18',
			'type'    => 'text'
		);		
		$this->settings['custom_basemap_tms'] = array(
			'version' => '2.7.1',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section7',
			'title'   => 'tms',
			'desc'    => esc_attr__('If true, inverses Y axis numbering for tiles (turn this on for TMS services).','lmm'),
			'type'    => 'radio',
			'std'     => 'false',
			'choices' => array(
				'false' => esc_attr__('false','lmm'),
				'true' => esc_attr__('true','lmm')
			)
		);	
		$this->settings['custom_basemap_subdomains_enabled'] = array(
			'version' => '1.0',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section7',
			'title'   => esc_attr__('Support for subdomains?','lmm'),
			'desc'    => esc_attr__('Will replace {s} from tiles url if available','lmm'),
			'type'    => 'radio',
			'std'     => 'yes',
			'choices' => array(
				'yes' => esc_attr__('Yes (please enter subdomains in next form field)','lmm'),
				'no' => esc_attr__('No','lmm')
			)
		);
		$this->settings['custom_basemap_subdomains_names'] = array(
			'version' => '1.0',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section7',
			'title'   => esc_attr__( 'Subdomain names', 'lmm' ),
			'desc'    => esc_attr__('For example','lmm'). ": &quot;otile1&quot;, &quot;otile2&quot;, &quot;otile3&quot;, &quot;otile4&quot;",
			'std'     => '&quot;otile1&quot;, &quot;otile2&quot;, &quot;otile3&quot;, &quot;otile4&quot;',
			'type'    => 'text'
		);		
		$this->settings['custom_basemap_continuousworld_enabled'] = array(
			'version' => '2.7.1',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section7',
			'title'   => esc_attr__('Enable continuousWorld?','lmm'),
			'desc'    => esc_attr__('If set to true, the tile coordinates will not be wrapped by world width (-180 to 180 longitude) or clamped to lie within world height (-90 to 90). Use this if you use Leaflet for maps that do not reflect the real world (e.g. game, indoor or photo maps).','lmm'),
			'type'    => 'radio',
			'std'     => 'false',
			'choices' => array(
				'false' => esc_attr__('false','lmm'),
				'true' => esc_attr__('true','lmm')
			)
		);
		$this->settings['custom_basemap_nowrap_enabled'] = array(
			'version' => '2.7.1',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section7',
			'title'   => esc_attr__('Enable nowrap?','lmm'),
			'desc'    => esc_attr__('If set to true, the tiles just will not load outside the world width (-180 to 180 longitude) instead of repeating.','lmm'),
			'type'    => 'radio',
			'std'     => 'false',
			'choices' => array(
				'false' => esc_attr__('false','lmm'),
				'true' => esc_attr__('true','lmm')
			)
		);
		/*
		* Custom basemap 2 settings
		*/
		$this->settings['custom_basemap2_helptext'] = array(
			'version' => '1.0',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section8',
			'std'     => '', 
			'title'   => '',
			'desc'    => esc_attr__( 'Please enter settings for custom basemap', 'lmm').' (custom 2):<br/><br/><img src="'. LEAFLET_PLUGIN_URL .'inc/img/help-default-basemap-custom-basemaps.jpg" />',
			'type'    => 'helptext'
		);
		$this->settings['custom_basemap2_tileurl'] = array(
			'version' => '1.0',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section8',
			'title'   => esc_attr__( 'Tiles URL', 'lmm' ),
			'desc'    => esc_attr__("For example","lmm"). ": http://{s}.mqcdn.com/tiles/1.0.0/osm/{z}/{x}/{y}.png",
			'std'     => 'http://{s}.mqcdn.com/tiles/1.0.0/osm/{z}/{x}/{y}.png',
			'type'    => 'text'
		);
		$this->settings['custom_basemap2_attribution'] = array(
			'version' => '1.0',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section8',
			'title'   => esc_attr__( 'Attribution', 'lmm' ),
			'desc'    => esc_attr__("For example","lmm"). ": Copyright ".date('Y')." &lt;a href=&quot;http://xy.com&quot;&gt;Provider X&lt;/a&gt;",
			'std'     => "Copyright ".date('Y')." <a href=&quot;http://xy.com&quot;>Provider Y</a>",
			'type'    => 'text'
		);
		$this->settings['custom_basemap2_minzoom'] = array(
			'version' => '1.0',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section8',
			'title'   => esc_attr__( 'Minimum zoom level', 'lmm' ),
			'desc'    => esc_attr__('Note: maximum zoom level may vary on your basemap','lmm'),
			'std'     => '1',
			'type'    => 'text'
		);
		$this->settings['custom_basemap2_maxzoom'] = array(
			'version' => '1.0',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section8',
			'title'   => esc_attr__( 'Maximum zoom level', 'lmm' ),
			'desc'    => esc_attr__('Note: maximum zoom level may vary on your basemap','lmm'),
			'std'     => '18',
			'type'    => 'text'
		);		
		$this->settings['custom_basemap2_tms'] = array(
			'version' => '2.7.1',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section8',
			'title'   => 'tms',
			'desc'    => esc_attr__('If true, inverses Y axis numbering for tiles (turn this on for TMS services).','lmm'),
			'type'    => 'radio',
			'std'     => 'false',
			'choices' => array(
				'false' => esc_attr__('false','lmm'),
				'true' => esc_attr__('true','lmm')
			)
		);			
		$this->settings['custom_basemap2_subdomains_enabled'] = array(
			'version' => '1.0',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section8',
			'title'   => esc_attr__('Support for subdomains?','lmm'),
			'desc'    => esc_attr__('Will replace {s} from tiles url if available','lmm'),
			'type'    => 'radio',
			'std'     => 'yes',
			'choices' => array(
				'yes' => esc_attr__('Yes (please enter subdomains in next form field)','lmm'),
				'no' => esc_attr__('No','lmm')
			)
		);
		$this->settings['custom_basemap2_subdomains_names'] = array(
			'version' => '1.0',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section8',
			'title'   => esc_attr__( 'Subdomain names', 'lmm' ),
			'desc'    => esc_attr__('For example','lmm'). ": &quot;otile1&quot;, &quot;otile2&quot;, &quot;otile3&quot;, &quot;otile4&quot;",
			'std'     => '&quot;otile1&quot;, &quot;otile2&quot;, &quot;otile3&quot;, &quot;otile4&quot;',
			'type'    => 'text'
		);
		$this->settings['custom_basemap2_continuousworld_enabled'] = array(
			'version' => '2.7.1',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section8',
			'title'   => esc_attr__('Enable continuousWorld?','lmm'),
			'desc'    => esc_attr__('If set to true, the tile coordinates will not be wrapped by world width (-180 to 180 longitude) or clamped to lie within world height (-90 to 90). Use this if you use Leaflet for maps that do not reflect the real world (e.g. game, indoor or photo maps).','lmm'),
			'type'    => 'radio',
			'std'     => 'false',
			'choices' => array(
				'false' => esc_attr__('false','lmm'),
				'true' => esc_attr__('true','lmm')
			)
		);
		$this->settings['custom_basemap2_nowrap_enabled'] = array(
			'version' => '2.7.1',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section8',
			'title'   => esc_attr__('Enable nowrap?','lmm'),
			'desc'    => esc_attr__('If set to true, the tiles just will not load outside the world width (-180 to 180 longitude) instead of repeating.','lmm'),
			'type'    => 'radio',
			'std'     => 'false',
			'choices' => array(
				'false' => esc_attr__('false','lmm'),
				'true' => esc_attr__('true','lmm')
			)
		);
		/*
		* Custom basemap 3 settings
		*/
		$this->settings['custom_basemap3_helptext'] = array(
			'version' => '1.0',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section9',
			'std'     => '', 
			'title'   => '',
			'desc'    => esc_attr__( 'Please enter settings for custom basemap', 'lmm').' (custom 3):<br/><br/><img src="'. LEAFLET_PLUGIN_URL .'inc/img/help-default-basemap-custom-basemaps.jpg" />',
			'type'    => 'helptext'
		);
		$this->settings['custom_basemap3_tileurl'] = array(
			'version' => '1.0',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section9',
			'title'   => esc_attr__( 'Tiles URL', 'lmm' ),
			'desc'    => esc_attr__("For example","lmm"). ": http://{s}.mqcdn.com/tiles/1.0.0/osm/{z}/{x}/{y}.png",
			'std'     => 'http://{s}.mqcdn.com/tiles/1.0.0/osm/{z}/{x}/{y}.png',
			'type'    => 'text'
		);
		$this->settings['custom_basemap3_attribution'] = array(
			'version' => '1.0',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section9',
			'title'   => esc_attr__( 'Attribution', 'lmm' ),
			'desc'    => esc_attr__("For example","lmm"). ": Copyright ".date('Y')." &lt;a href=&quot;http://xy.com&quot;&gt;Provider XY&lt;/a&gt;",
			'std'     => "Copyright ".date('Y')." <a href=&quot;http://xy.com&quot;>Provider Z</a>",
			'type'    => 'text'
		);
		$this->settings['custom_basemap3_minzoom'] = array(
			'version' => '1.0',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section9',
			'title'   => esc_attr__( 'Minimum zoom level', 'lmm' ),
			'desc'    => esc_attr__('Note: maximum zoom level may vary on your basemap','lmm'),
			'std'     => '1',
			'type'    => 'text'
		);
		$this->settings['custom_basemap3_maxzoom'] = array(
			'version' => '1.0',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section9',
			'title'   => esc_attr__( 'Maximum zoom level', 'lmm' ),
			'desc'    => esc_attr__('Note: maximum zoom level may vary on your basemap','lmm'),
			'std'     => '18',
			'type'    => 'text'
		);		
		$this->settings['custom_basemap3_tms'] = array(
			'version' => '2.7.1',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section9',
			'title'   => 'tms',
			'desc'    => esc_attr__('If true, inverses Y axis numbering for tiles (turn this on for TMS services).','lmm'),
			'type'    => 'radio',
			'std'     => 'false',
			'choices' => array(
				'false' => esc_attr__('false','lmm'),
				'true' => esc_attr__('true','lmm')
			)
		);			
		$this->settings['custom_basemap3_subdomains_enabled'] = array(
			'version' => '1.0',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section9',
			'title'   => esc_attr__('Support for subdomains?','lmm'),
			'desc'    => esc_attr__('Will replace {s} from tiles url if available','lmm'),
			'type'    => 'radio',
			'std'     => 'yes',
			'choices' => array(
				'yes' => esc_attr__('Yes (please enter subdomains in next form field)','lmm'),
				'no' => esc_attr__('No','lmm')
			)
		);
		$this->settings['custom_basemap3_subdomains_names'] = array(
			'version' => '1.0',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section9',
			'title'   => esc_attr__( 'Subdomain names', 'lmm' ),
			'desc'    => esc_attr__('For example','lmm'). ": &quot;otile1&quot;, &quot;otile2&quot;, &quot;otile3&quot;, &quot;otile4&quot;",
			'std'     => '&quot;otile1&quot;, &quot;otile2&quot;, &quot;otile3&quot;, &quot;otile4&quot;',
			'type'    => 'text'
		);
		$this->settings['custom_basemap3_continuousworld_enabled'] = array(
			'version' => '2.7.1',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section9',
			'title'   => esc_attr__('Enable continuousWorld?','lmm'),
			'desc'    => esc_attr__('If set to true, the tile coordinates will not be wrapped by world width (-180 to 180 longitude) or clamped to lie within world height (-90 to 90). Use this if you use Leaflet for maps that do not reflect the real world (e.g. game, indoor or photo maps).','lmm'),
			'type'    => 'radio',
			'std'     => 'false',
			'choices' => array(
				'false' => esc_attr__('false','lmm'),
				'true' => esc_attr__('true','lmm')
			)
		);
		$this->settings['custom_basemap3_nowrap_enabled'] = array(
			'version' => '2.7.1',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section9',
			'title'   => esc_attr__('Enable nowrap?','lmm'),
			'desc'    => esc_attr__('If set to true, the tiles just will not load outside the world width (-180 to 180 longitude) instead of repeating.','lmm'),
			'type'    => 'radio',
			'std'     => 'false',
			'choices' => array(
				'false' => esc_attr__('false','lmm'),
				'true' => esc_attr__('true','lmm')
			)
		);		
		/*
		* OGD Vienna Selector
		*/
		$this->settings['ogdvienna_selector_helptext'] = array(
			'version' => '1.0',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section10',
			'std'     => '', 
			'title'   => '',
			'desc'    => esc_attr__( 'If coordinates within boundaries of Vienna/Austria are selected for a marker or layer, the basemap automatically switches to OGD Vienna basemap and the overlay OGD Vienna addresses gets checked.', 'lmm').'<br/><br/><img src="'. LEAFLET_PLUGIN_URL .'inc/img/help-default-basemap-ogdvienna-selector.jpg" />',
			'type'    => 'helptext'
		);
		$this->settings['ogdvienna_selector'] = array(
			'version' => '1.0',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section10',
			'title'   => esc_attr__('OGD Vienna Selector','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'ogdwien_basemap',
			'choices' => array(
				'ogdwien_basemap' => esc_attr__('enabled (use OGD Vienna basemap)','lmm'),
				'ogdwien_satellite' => esc_attr__('enabled (use OGD Vienna satellite)','lmm'),
				'disabled' => esc_attr__('disabled (use default basemap)','lmm')
			)
		);
		$this->settings['ogdvienna_selector_addresses'] = array(
			'version' => '1.0',
			'pane'    => 'basemaps',
			'section' => 'basemaps-section10',
			'title'   => '',
			'desc'    => esc_attr__( 'enable OGD Vienna addresses overlay', 'lmm' ),
			'type'    => 'checkbox',
			'std'     => 1 
		);
			
		/*===========================================
		*
		*
		* pane overlays
		*
		*
		===========================================*/
		/*
		* Available overlays for new markers/layers
		*/
		$this->settings['overlays_available_helptext'] = array(
			'version' => '1.0',
			'pane'    => 'overlays',
			'section' => 'overlays-section1',
			'std'     => '', 
			'title'   => '',
			'desc'    => esc_attr__( 'Please select the overlays which should be available in the control box.', 'lmm').'<br/><br/><img src="'. LEAFLET_PLUGIN_URL .'inc/img/help-custom-overlays-available-overlays.jpg" />',
			'type'    => 'helptext'
		);
		$this->settings['overlays_custom'] = array(
			'version' => '1.0',
			'pane'    => 'overlays',
			'section' => 'overlays-section1',
			'title'    => esc_attr__('Available overlays in control box','lmm'),
			'desc'    => esc_attr__('Custom overlay','lmm'),
			'type'    => 'checkbox',
			'std'     => 1 
		);
		$this->settings['overlays_custom2'] = array(
			'version' => '1.0',
			'pane'    => 'overlays',
			'section' => 'overlays-section1',
			'title'   => '',
			'desc'    => esc_attr__('Custom overlay 2','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);		
		
		$this->settings['overlays_custom3'] = array(
			'version' => '1.0',
			'pane'    => 'overlays',
			'section' => 'overlays-section1',
			'title'   => '',
			'desc'    => esc_attr__('Custom overlay 3','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);		
		
		$this->settings['overlays_custom4'] = array(
			'version' => '1.0',
			'pane'    => 'overlays',
			'section' => 'overlays-section1',
			'title'   => '',
			'desc'    => esc_attr__('Custom overlay 4','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);		
		/*
		* Custom overlay settings
		*/
		$this->settings['overlays_custom_helptext'] = array(
			'version' => '1.0',
			'pane'    => 'overlays',
			'section' => 'overlays-section2',
			'std'     => '', 
			'title'   => '',
			'desc'    => esc_attr__( 'Please enter settings for custom overlay', 'lmm').':<br/><br/><img src="'. LEAFLET_PLUGIN_URL .'inc/img/help-overlays-custom.jpg" />',
			'type'    => 'helptext'
		);
		$this->settings['overlays_custom_name'] = array(
			'version' => '1.0',
			'pane'    => 'overlays',
			'section' => 'overlays-section2',
			'title'   => esc_attr__( 'Name', 'lmm' ),
			'desc'   => esc_attr__( 'Will be displayed in controlbox if selected', 'lmm' ),
			'std'     => esc_attr__('OGD Vienna addresses','lmm'),
			'type'    => 'text'
		);		
		
		$this->settings['overlays_custom_tileurl'] = array(
			'version' => '1.0',
			'pane'    => 'overlays',
			'section' => 'overlays-section2',
			'title'   => esc_attr__( 'Tiles URL', 'lmm' ),
			'desc'    => esc_attr__('For example','lmm'). ": http://{s}.wien.gv.at/wmts/beschriftung/normal/google3857/{z}/{y}/{x}.png",
			'std'     => 'http://{s}.wien.gv.at/wmts/beschriftung/normal/google3857/{z}/{y}/{x}.png',
			'type'    => 'text'
		);
		$this->settings['overlays_custom_attribution'] = array(
			'version' => '1.1',
			'pane'    => 'overlays',
			'section' => 'overlays-section2',
			'title'   => esc_attr__( 'Attribution', 'lmm' ),
			'desc'    => '',
			'std'     => 'Addresses: City of Vienna (<a href=&quot;http://data.wien.gv.at&quot; target=&quot;_blank&quot;>data.wien.gv.at</a>)',
			'type'    => 'text'
		);
		$this->settings['overlays_custom_minzoom'] = array(
			'version' => '1.0',
			'pane'    => 'overlays',
			'section' => 'overlays-section2',
			'title'   => esc_attr__( 'Minimum zoom level', 'lmm' ),
			'desc'    => esc_attr__('Note: maximum zoom level may vary on your basemap','lmm'),
			'std'     => '1',
			'type'    => 'text'
		);
		$this->settings['overlays_custom_maxzoom'] = array(
			'version' => '1.0',
			'pane'    => 'overlays',
			'section' => 'overlays-section2',
			'title'   => esc_attr__( 'Maximum zoom level', 'lmm' ),
			'desc'    => esc_attr__('Note: maximum zoom level may vary on your basemap','lmm'),
			'std'     => '19',
			'type'    => 'text'
		);		
		$this->settings['overlays_custom_opacity'] = array(
			'version' => '2.7.1',
			'pane'    => 'overlays',
			'section' => 'overlays-section2',
			'title'   => esc_attr__( 'Opacity', 'lmm' ),
			'desc'    => esc_attr__('The opacity of the tile layer.','lmm'),
			'std'     => '1.0',
			'type'    => 'text'
		);		
		$this->settings['overlays_custom_subdomains_enabled'] = array(
			'version' => '1.0',
			'pane'    => 'overlays',
			'section' => 'overlays-section2',
			'title'   => esc_attr__('Support for subdomains?','lmm'),
			'desc'    => esc_attr__('Will replace {s} from tiles url if available','lmm'),
			'type'    => 'radio',
			'std'     => 'yes',
			'choices' => array(
				'yes' => esc_attr__('Yes (please enter subdomains in next form field)','lmm'),
				'no' => esc_attr__('No','lmm')
			)
		);
		$this->settings['overlays_custom_subdomains_names'] = array(
			'version' => '1.0',
			'pane'    => 'overlays',
			'section' => 'overlays-section2',
			'title'   => esc_attr__( 'Subdomain names', 'lmm' ),
			'desc'    => esc_attr__('For example','lmm'). ": &quot;maps&quot;, &quot;maps1&quot;, &quot;maps2&quot;, &quot;maps3&quot;",
			'std'     => '&quot;maps&quot;, &quot;maps1&quot;, &quot;maps2&quot;, &quot;maps3&quot;',
			'type'    => 'text'
		);
		/*
		* Custom overlay 2 settings
		*/
		$this->settings['overlays_custom2_helptext'] = array(
			'version' => '1.0',
			'pane'    => 'overlays',
			'section' => 'overlays-section3',
			'std'     => '', 
			'title'   => '',
			'desc'    => esc_attr__( 'Please enter settings for custom overlay', 'lmm').' 2:<br/><br/><img src="'. LEAFLET_PLUGIN_URL .'inc/img/help-overlays-custom2.jpg" />',
			'type'    => 'helptext'
		);
		$this->settings['overlays_custom2_name'] = array(
			'version' => '1.0',
			'pane'    => 'overlays',
			'section' => 'overlays-section3',
			'title'   => esc_attr__( 'Name', 'lmm' ),
			'desc'   => esc_attr__( 'Will be displayed in controlbox if selected', 'lmm' ),
			'std'     => 'Custom2',
			'type'    => 'text'
		);		
		
		$this->settings['overlays_custom2_tileurl'] = array(
			'version' => '1.0',
			'pane'    => 'overlays',
			'section' => 'overlays-section3',
			'title'   => esc_attr__( 'Tiles URL', 'lmm' ),
			'desc'    => esc_attr__('For example','lmm'). ": http://{s}.wien.gv.at/wmts/beschriftung/normal/google3857/{z}/{y}/{x}.png",
			'std'     => 'http://{s}.wien.gv.at/wmts/beschriftung/normal/google3857/{z}/{y}/{x}.png',
			'type'    => 'text'
		);
		$this->settings['overlays_custom2_attribution'] = array(
			'version' => '1.1',
			'pane'    => 'overlays',
			'section' => 'overlays-section3',
			'title'   => esc_attr__( 'Attribution', 'lmm' ),
			'desc'    => '',
			'std'     => 'Addresses: City of Vienna (<a href=&quot;http://data.wien.gv.at&quot; target=&quot;_blank&quot;>data.wien.gv.at</a>)',
			'type'    => 'text'
		);	
		$this->settings['overlays_custom2_minzoom'] = array(
			'version' => '1.0',
			'pane'    => 'overlays',
			'section' => 'overlays-section3',
			'title'   => esc_attr__( 'Minimum zoom level', 'lmm' ),
			'desc'    => esc_attr__('Note: maximum zoom level may vary on your basemap','lmm'),
			'std'     => '1',
			'type'    => 'text'
		);
		$this->settings['overlays_custom2_maxzoom'] = array(
			'version' => '1.0',
			'pane'    => 'overlays',
			'section' => 'overlays-section3',
			'title'   => esc_attr__( 'Maximum zoom level', 'lmm' ),
			'desc'    => esc_attr__('Note: maximum zoom level may vary on your basemap','lmm'),
			'std'     => '17',
			'type'    => 'text'
		);		
		$this->settings['overlays_custom2_opacity'] = array(
			'version' => '2.7.1',
			'pane'    => 'overlays',
			'section' => 'overlays-section3',
			'title'   => esc_attr__( 'Opacity', 'lmm' ),
			'desc'    => esc_attr__('The opacity of the tile layer.','lmm'),
			'std'     => '1.0',
			'type'    => 'text'
		);		
		$this->settings['overlays_custom2_subdomains_enabled'] = array(
			'version' => '1.0',
			'pane'    => 'overlays',
			'section' => 'overlays-section3',
			'title'   => esc_attr__('Support for subdomains?','lmm'),
			'desc'    => esc_attr__('Will replace {s} from tiles url if available','lmm'),
			'type'    => 'radio',
			'std'     => 'yes',
			'choices' => array(
				'yes' => esc_attr__('Yes (please enter subdomains in next form field)','lmm'),
				'no' => esc_attr__('No','lmm')
			)
		);
		$this->settings['overlays_custom2_subdomains_names'] = array(
			'version' => '1.0',
			'pane'    => 'overlays',
			'section' => 'overlays-section3',
			'title'   => esc_attr__( 'Subdomain names', 'lmm' ),
			'desc'    => esc_attr__('For example','lmm'). ": &quot;maps&quot;, &quot;maps1&quot;, &quot;maps2&quot;, &quot;maps3&quot;",
			'std'     => '&quot;maps&quot;, &quot;maps1&quot;, &quot;maps2&quot;, &quot;maps3&quot;',
			'type'    => 'text'
		);
		/*
		* Custom overlay 3 settings
		*/
		$this->settings['overlays_custom3_helptext'] = array(
			'version' => '1.0',
			'pane'    => 'overlays',
			'section' => 'overlays-section4',
			'std'     => '', 
			'title'   => '',
			'desc'    => esc_attr__( 'Please enter settings for custom overlay', 'lmm').' 3:<br/><br/><img src="'. LEAFLET_PLUGIN_URL .'inc/img/help-overlays-custom3.jpg" />',
			'type'    => 'helptext'
		);
		$this->settings['overlays_custom3_name'] = array(
			'version' => '1.0',
			'pane'    => 'overlays',
			'section' => 'overlays-section4',
			'title'   => esc_attr__( 'Name', 'lmm' ),
			'desc'   => esc_attr__( 'Will be displayed in controlbox if selected', 'lmm' ),
			'std'     => 'Custom3',
			'type'    => 'text'
		);		
		$this->settings['overlays_custom3_tileurl'] = array(
			'version' => '1.0',
			'pane'    => 'overlays',
			'section' => 'overlays-section4',
			'title'   => esc_attr__( 'Tiles URL', 'lmm' ),
			'desc'    => esc_attr__("For example","lmm"). ": http://maps.wien.gv.at/wmts/beschriftung/normal/google3857/{z}/{y}/{x}.png",
			'std'     => 'http://maps.wien.gv.at/wmts/beschriftung/normal/google3857/{z}/{y}/{x}.png',
			'type'    => 'text'
		);
		$this->settings['overlays_custom3_attribution'] = array(
			'version' => '1.1',
			'pane'    => 'overlays',
			'section' => 'overlays-section4',
			'title'   => esc_attr__( 'Attribution', 'lmm' ),
			'desc'    => '',
			'std'     => 'Addresses: City of Vienna (<a href=&quot;http://data.wien.gv.at&quot; target=&quot;_blank&quot;>data.wien.gv.at</a>)',
			'type'    => 'text'
		);	
		$this->settings['overlays_custom3_minzoom'] = array(
			'version' => '1.0',
			'pane'    => 'overlays',
			'section' => 'overlays-section4',
			'title'   => esc_attr__( 'Minimum zoom level', 'lmm' ),
			'desc'    => esc_attr__('Note: maximum zoom level may vary on your basemap','lmm'),
			'std'     => '1',
			'type'    => 'text'
		);
		$this->settings['overlays_custom3_maxzoom'] = array(
			'version' => '1.0',
			'pane'    => 'overlays',
			'section' => 'overlays-section4',
			'title'   => esc_attr__( 'Maximum zoom level', 'lmm' ),
			'desc'    => esc_attr__('Note: maximum zoom level may vary on your basemap','lmm'),
			'std'     => '17',
			'type'    => 'text'
		);		
		$this->settings['overlays_custom3_opacity'] = array(
			'version' => '2.7.1',
			'pane'    => 'overlays',
			'section' => 'overlays-section4',
			'title'   => esc_attr__( 'Opacity', 'lmm' ),
			'desc'    => esc_attr__('The opacity of the tile layer.','lmm'),
			'std'     => '1.0',
			'type'    => 'text'
		);		
		$this->settings['overlays_custom3_subdomains_enabled'] = array(
			'version' => '1.0',
			'pane'    => 'overlays',
			'section' => 'overlays-section4',
			'title'   => esc_attr__('Support for subdomains?','lmm'),
			'desc'    => esc_attr__('Will replace {s} from tiles url if available','lmm'),
			'type'    => 'radio',
			'std'     => 'yes',
			'choices' => array(
				'yes' => esc_attr__('Yes (please enter subdomains in next form field)','lmm'),
				'no' => esc_attr__('No','lmm')
			)
		);
		$this->settings['overlays_custom3_subdomains_names'] = array(
			'version' => '1.0',
			'pane'    => 'overlays',
			'section' => 'overlays-section4',
			'title'   => esc_attr__( 'Subdomain names', 'lmm' ),
			'desc'    => esc_attr__('For example','lmm'). ": &quot;maps&quot;, &quot;maps1&quot;, &quot;maps2&quot;, &quot;maps3&quot;",
			'std'     => '&quot;maps&quot;, &quot;maps1&quot;, &quot;maps2&quot;, &quot;maps3&quot;',
			'type'    => 'text'
		);
		/*
		* Custom overlay 4 settings
		*/
		$this->settings['overlays_custom4_helptext'] = array(
			'version' => '1.0',
			'pane'    => 'overlays',
			'section' => 'overlays-section5',
			'std'     => '', 
			'title'   => '',
			'desc'    => esc_attr__( 'Please enter settings for custom overlay', 'lmm').' 4:<br/><br/><img src="'. LEAFLET_PLUGIN_URL .'inc/img/help-overlays-custom4.jpg" />',
			'type'    => 'helptext'
		);
		$this->settings['overlays_custom4_name'] = array(
			'version' => '1.0',
			'pane'    => 'overlays',
			'section' => 'overlays-section5',
			'title'   => esc_attr__( 'Name', 'lmm' ),
			'desc'   => esc_attr__( 'Will be displayed in controlbox if selected', 'lmm' ),
			'std'     => 'Custom4',
			'type'    => 'text'
		);		
		
		$this->settings['overlays_custom4_tileurl'] = array(
			'version' => '1.0',
			'pane'    => 'overlays',
			'section' => 'overlays-section5',
			'title'   => esc_attr__( 'Tiles URL', 'lmm' ),
			'desc'    => esc_attr__("For example","lmm"). ": http://maps.wien.gv.at/wmts/beschriftung/normal/google3857/{z}/{y}/{x}.png",
			'std'     => 'http://maps.wien.gv.at/wmts/beschriftung/normal/google3857/{z}/{y}/{x}.png',
			'type'    => 'text'
		);
		$this->settings['overlays_custom4_attribution'] = array(
			'version' => '1.1',
			'pane'    => 'overlays',
			'section' => 'overlays-section5',
			'title'   => esc_attr__( 'Attribution', 'lmm' ),
			'desc'    => '',
			'std'     => 'Addresses: City of Vienna (<a href=&quot;http://data.wien.gv.at&quot; target=&quot;_blank&quot;>data.wien.gv.at</a>)',
			'type'    => 'text'
		);		
		$this->settings['overlays_custom4_minzoom'] = array(
			'version' => '1.0',
			'pane'    => 'overlays',
			'section' => 'overlays-section5',
			'title'   => esc_attr__( 'Minimum zoom level', 'lmm' ),
			'desc'    => esc_attr__('Note: maximum zoom level may vary on your basemap','lmm'),
			'std'     => '1',
			'type'    => 'text'
		);
		$this->settings['overlays_custom4_maxzoom'] = array(
			'version' => '1.0',
			'pane'    => 'overlays',
			'section' => 'overlays-section5',
			'title'   => esc_attr__( 'Maximum zoom level', 'lmm' ),
			'desc'    => esc_attr__('Note: maximum zoom level may vary on your basemap','lmm'),
			'std'     => '17',
			'type'    => 'text'
		);		
		$this->settings['overlays_custom4_opacity'] = array(
			'version' => '2.7.1',
			'pane'    => 'overlays',
			'section' => 'overlays-section5',
			'title'   => esc_attr__( 'Opacity', 'lmm' ),
			'desc'    => esc_attr__('The opacity of the tile layer.','lmm'),
			'std'     => '1.0',
			'type'    => 'text'
		);		
		$this->settings['overlays_custom4_subdomains_enabled'] = array(
			'version' => '1.0',
			'pane'    => 'overlays',
			'section' => 'overlays-section5',
			'title'   => esc_attr__('Support for subdomains?','lmm'),
			'desc'    => esc_attr__('Will replace {s} from tiles url if available','lmm'),
			'type'    => 'radio',
			'std'     => 'yes',
			'choices' => array(
				'yes' => esc_attr__('Yes (please enter subdomains in next form field)','lmm'),
				'no' => esc_attr__('No','lmm')
			)
		);
		$this->settings['overlays_custom4_subdomains_names'] = array(
			'version' => '1.0',
			'pane'    => 'overlays',
			'section' => 'overlays-section5',
			'title'   => esc_attr__( 'Subdomain names', 'lmm' ),
			'desc'    => esc_attr__('For example','lmm'). ": &quot;maps&quot;, &quot;maps1&quot;, &quot;maps2&quot;, &quot;maps3&quot;",
			'std'     => '&quot;maps&quot;, &quot;maps1&quot;, &quot;maps2&quot;, &quot;maps3&quot;',
			'type'    => 'text'
		);
		
		/*===========================================
		*
		*
		* pane wms
		*
		*
		===========================================*/
		/*
		* Available WMS layers for new markers/layers
		*/
		$this->settings['wms_available_helptext2'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections1',
			'std'     => '', 
			'title'   => '',
			'desc'    => esc_attr__('WMS stands for <a href="http://www.opengeospatial.org/standards/wms" target="_blank">Web Map Service</a> and is a standard protocol for serving georeferenced map images over the Internet that are generated by a map server using data from a GIS database.<br/>With Leaflet Maps Marker you can configure up to 10 WMS layers which can be enabled for each map. As default, 10 WMS layers from <a href="http://data.wien.gv.at" target="_blank">OGD Vienna</a> and from the <a href="http://www.eea.europa.eu/code/gis" target="_blank">European Environment Agency</a> have been predefined for you.<br/>A selection of further possible WMS layers can be found at <a href="http://www.mapsmarker.com/wms" target="_blank">http://www.mapsmarker.com/wms</a>', 'lmm'),
			'type'    => 'helptext'
		);		
		$this->settings['wms_available_heading'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections1',
			'title'   => '', 
			'desc'    => '<a name="wms1" class="lmm-index-links"></a>' . esc_attr__( 'Available WMS layers for new markers/layers', 'lmm'),
			'type'    => 'heading'
		);
		$this->settings['wms_available_helptext'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections1',
			'std'     => '', 
			'title'   => '',
			'desc'    => esc_attr__( 'Please select the WMS layers which should be available when creating new markers/layers', 'lmm').'<br/><br/><img src="'. LEAFLET_PLUGIN_URL .'inc/img/help-wms-available-wms-layers.jpg" />',
			'type'    => 'helptext'
		);
		$this->settings['wms_wms_available'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections1',
			'title'    => esc_attr__('Available WMS layers','lmm'),
			'desc'    => 'WMS 1',
			'type'    => 'checkbox',
			'std'     => 1 
		);
		$this->settings['wms_wms2_available'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections1',
			'title'    => '',
			'desc'    => 'WMS 2',
			'type'    => 'checkbox',
			'std'     => 1 
		);
		$this->settings['wms_wms3_available'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections1',
			'title'    => '',
			'desc'    => 'WMS 3',
			'type'    => 'checkbox',
			'std'     => 1 
		);
		$this->settings['wms_wms4_available'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections1',
			'title'    => '',
			'desc'    => 'WMS 4',
			'type'    => 'checkbox',
			'std'     => 1 
		);
		$this->settings['wms_wms5_available'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections1',
			'title'    => '',
			'desc'    => 'WMS 5',
			'type'    => 'checkbox',
			'std'     => 1 
		);
		$this->settings['wms_wms6_available'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections1',
			'title'    => '',
			'desc'    => 'WMS 6',
			'type'    => 'checkbox',
			'std'     => 1 
		);
		$this->settings['wms_wms7_available'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections1',
			'title'    => '',
			'desc'    => 'WMS 7',
			'type'    => 'checkbox',
			'std'     => 1 
		);
		$this->settings['wms_wms8_available'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections1',
			'title'    => '',
			'desc'    => 'WMS 8',
			'type'    => 'checkbox',
			'std'     => 1 
		);
		$this->settings['wms_wms9_available'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections1',
			'title'    => '',
			'desc'    => 'WMS 9',
			'type'    => 'checkbox',
			'std'     => 1 
		);
		$this->settings['wms_wms10_available'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections1',
			'title'    => '',
			'desc'    => 'WMS 10',
			'type'    => 'checkbox',
			'std'     => 1 
		);
		/*
		* WMS layer settings
		*/
		$this->settings['wms_wms_helptext'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections2',
			'std'     => '', 
			'title'   => '',
			'desc'    => '', //empty for not breaking settings layout
			'type'    => 'helptext'
		);
		$this->settings['wms_wms_name'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections2',
			'title'    => esc_attr__('Name','lmm'),
			'desc'    => '',
			'type'    => 'text',
			'std'     => '<a href=&quot;http://data.wien.gv.at/katalog/wc-anlagen.html&quot; target=&quot;_blank&quot;>OGD Vienna - Public Toilets</a>' 
		);
		$this->settings['wms_wms_baseurl'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections2',
			'title'    => esc_attr__('baseURL','lmm'),
			'desc'    => '',
			'type'    => 'text',
			'std'     => 'http://data.wien.gv.at/daten/wms' 
		);
		$this->settings['wms_wms_layers'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections2',
			'title'    => esc_attr__('Layers','lmm'),
			'desc'    => esc_attr__('(required) Comma-separated list of WMS layers to show','lmm'),
			'type'    => 'text',
			'std'     => 'OEFFWCOGD' 
		);
		$this->settings['wms_wms_styles'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections2',
			'title'    => esc_attr__('Styles','lmm'),
			'desc'    => esc_attr__('Comma-separated list of WMS styles','lmm'),
			'type'    => 'text',
			'std'     => '' 
		);
		$this->settings['wms_wms_format'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections2',
			'title'    => esc_attr__('Format','lmm'),
			'desc'    => '',
			'type'    => 'text',
			'std'     => 'image/gif' 
		);		
		$this->settings['wms_wms_transparent'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections2',
			'title'   => esc_attr__('Transparent','lmm'),
			'desc'    => esc_attr__('If yes, the WMS service will return images with transparency','lmm'),
			'type'    => 'radio',
			'std'     => 'TRUE',
			'choices' => array(
				'TRUE' => esc_attr__('true','lmm'),
				'FALSE' => esc_attr__('false','lmm')
			)
		);
		$this->settings['wms_wms_version'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections2',
			'title'    => esc_attr__('Version','lmm'),
			'desc'    => esc_attr__('Version of the WMS service to use','lmm'),
			'type'    => 'text',
			'std'     => '1.1.1' 
		);
		$this->settings['wms_wms_attribution'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections2',
			'title'    => esc_attr__('Attribution','lmm'),
			'desc'    => '',
			'type'    => 'text',
			'std'     => 'WMS: City of Vienna (<a href=&quot;http://data.wien.gv.at&quot; target=&quot;_blank&quot;>http://data.wien.gv.at</a>)' 
		);		
		$this->settings['wms_wms_legend_enabled'] = array(
			'version' => '1.1',
			'pane'    => 'wms',
			'section' => 'wms-sections2',
			'title'   => esc_attr__('Display legend?','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'yes',
			'choices' => array(
				'yes' => esc_attr__('Yes','lmm'),
				'no' => esc_attr__('No','lmm')
			)
		);		
		$this->settings['wms_wms_legend'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections2',
			'title'    => esc_attr__('Legend','lmm'),
			'desc'    => esc_attr__('URL of image which gets show when hovering the text "(Legend)" next to WMS attribution text','lmm'),
			'type'    => 'text',
			'std'     => '' 
		);		
		$this->settings['wms_wms_subdomains_enabled'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections2',
			'title'   => esc_attr__('Support for subdomains?','lmm'),
			'desc'    => esc_attr__('Will replace {s} from base url if available','lmm'),
			'type'    => 'radio',
			'std'     => 'no',
			'choices' => array(
				'no' => esc_attr__('No','lmm'),
				'yes' => esc_attr__('Yes (please enter subdomains in next form field)','lmm')
			)
		);
		$this->settings['wms_wms_subdomains_names'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections2',
			'title'   => esc_attr__( 'Subdomain names', 'lmm' ),
			'desc'    => esc_attr__('For example','lmm'). ": &quot;subdomain1&quot;, &quot;subdomain2&quot;, &quot;subdomain3&quot;",
			'std'     => '&quot;subdomain1&quot;, &quot;subdomain2&quot;, &quot;subdomain3&quot;',
			'type'    => 'text'
		);	
		$this->settings['wms_wms_kml_helptext'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections2',
			'std'     => '', 
			'title'   => '<strong>' . esc_attr__('KML settings','lmm') . '</strong>',
			'desc'    => esc_attr__('If the WMS server supports KML output of the WMS layer, the settings below will be used when a marker or layer map with this active WMS layer is exported as KML.','lmm'),
			'type'    => 'helptext'
		);
		$this->settings['wms_wms_kml_support'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections2',
			'title'   => esc_attr__('Does the WMS server support KML output?','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'yes',
			'choices' => array(
				'yes' => esc_attr__('yes','lmm'),
				'no' => esc_attr__('no','lmm')
			)
		);	
		$this->settings['wms_wms_kml_href'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections2',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#href" target="_blank">href</a>',
			'desc'    => esc_attr__('http-address of the KML-webservice of the WMS layer','lmm'),
			'type'    => 'text',
			'std'     => 'http://data.wien.gv.at/daten/geoserver/ows?version=1.3.0&service=WMS&request=GetMap&crs=EPSG:4326&bbox=48.10,16.16,48.34,16.59&width=1&height=1&layers=ogdwien:OEFFWCOGD&styles=&format=application/vnd.google-earth.kml+xml' 
		);	
		$this->settings['wms_wms_kml_refreshMode'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections2',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#refreshmode" target="_blank">refreshMode</a>',
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'onChange',
			'choices' => array(
				'onChange' => esc_attr__('onChange (refresh when the file is loaded and whenever the Link parameters change)','lmm'),
				'onInterval' => esc_attr__('onInterval (refresh every n seconds (specified in refreshInterval)','lmm'),
				'onExpire' => esc_attr__('onExpire (refresh the file when the expiration time is reached)','lmm'),
				'onStop' => esc_attr__('onStop (after camera movement stops)','lmm')
			)
		);	
		$this->settings['wms_wms_kml_refreshInterval'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections2',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#refreshinterval" target="_blank">refreshInterval</a>',
			'desc'    => esc_attr__('Indicates to refresh the file every n seconds','lmm'),
			'type'    => 'text',
			'std'     => '30' 
		);		
		$this->settings['wms_wms_kml_viewRefreshMode'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections2',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#viewrefreshmode" target="_blank">viewrefreshMode</a>',
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'never',
			'choices' => array(
				'never' => esc_attr__('never (ignore changes in the view)','lmm'),
				'onStop' => esc_attr__('onStop (refresh the file n seconds after movement stops, where n is specified in viewRefreshTime)','lmm'),
				'onRequest' => esc_attr__('onRequest (refresh the file only when the user explicitly requests it)','lmm')
			)
		);			
		$this->settings['wms_wms_kml_viewRefreshTime'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections2',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#viewrefreshtime" target="_blank">viewRefreshTime</a>',
			'desc'    => esc_attr__('After camera movement stops, specifies the number of seconds to wait before refreshing the view (is used when viewRefreshMode is set to onStop)','lmm'),
			'type'    => 'text',
			'std'     => '1' 
		);
		
		/*
		* WMS layer 2 settings
		*/
		$this->settings['wms_wms2_helptext'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections3',
			'std'     => '', 
			'title'   => '',
			'desc'    => '', //empty for not breaking settings layout
			'type'    => 'helptext'
		);
		$this->settings['wms_wms2_name'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections3',
			'title'    => esc_attr__('Name','lmm'),
			'desc'    => '',
			'type'    => 'text',
			'std'     => '<a href=&quot;http://data.wien.gv.at/katalog/aufzuege.html&quot; target=&quot;_blank&quot;>OGD Vienna - Elevators at stations</a>' 
		);
		$this->settings['wms_wms2_baseurl'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections3',
			'title'    => esc_attr__('baseURL','lmm'),
			'desc'    => '',
			'type'    => 'text',
			'std'     => 'http://data.wien.gv.at/daten/wms' 
		);
		$this->settings['wms_wms2_layers'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections3',
			'title'    => esc_attr__('Layers','lmm'),
			'desc'    => esc_attr__('(required) Comma-separated list of WMS layers to show','lmm'),
			'type'    => 'text',
			'std'     => 'AUFZUGOGD' 
		);
		$this->settings['wms_wms2_styles'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections3',
			'title'    => esc_attr__('Styles','lmm'),
			'desc'    => esc_attr__('Comma-separated list of WMS styles','lmm'),
			'type'    => 'text',
			'std'     => '' 
		);
		$this->settings['wms_wms2_format'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections3',
			'title'    => esc_attr__('Format','lmm'),
			'desc'    => '',
			'type'    => 'text',
			'std'     => 'image/gif' 
		);		
		$this->settings['wms_wms2_transparent'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections3',
			'title'   => esc_attr__('Transparent','lmm'),
			'desc'    => esc_attr__('If yes, the WMS service will return images with transparency','lmm'),
			'type'    => 'radio',
			'std'     => 'TRUE',
			'choices' => array(
				'TRUE' => esc_attr__('true','lmm'),
				'FALSE' => esc_attr__('false','lmm')
			)
		);
		$this->settings['wms_wms2_version'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections3',
			'title'    => esc_attr__('Version','lmm'),
			'desc'    => esc_attr__('Version of the WMS service to use','lmm'),
			'type'    => 'text',
			'std'     => '1.1.1' 
		);	
		$this->settings['wms_wms2_attribution'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections3',
			'title'    => esc_attr__('Attribution','lmm'),
			'desc'    => '',
			'type'    => 'text',
			'std'     => 'WMS: City of Vienna (<a href=&quot;http://data.wien.gv.at&quot; target=&quot;_blank&quot;>http://data.wien.gv.at</a>)' 
		);		
		$this->settings['wms_wms2_legend_enabled'] = array(
			'version' => '1.1',
			'pane'    => 'wms',
			'section' => 'wms-sections3',
			'title'   => esc_attr__('Display legend?','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'yes',
			'choices' => array(
				'yes' => esc_attr__('Yes','lmm'),
				'no' => esc_attr__('No','lmm')
			)
		);		
		$this->settings['wms_wms2_legend'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections3',
			'title'    => esc_attr__('Legend','lmm'),
			'desc'    => esc_attr__('URL of image which gets show when hovering the text "(Legend)" next to WMS attribution text','lmm'),
			'type'    => 'text',
			'std'     => '' 
		);		
		$this->settings['wms_wms2_subdomains_enabled'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections3',
			'title'   => esc_attr__('Support for subdomains?','lmm'),
			'desc'    => esc_attr__('Will replace {s} from base url if available','lmm'),
			'type'    => 'radio',
			'std'     => 'no',
			'choices' => array(
				'no' => esc_attr__('No','lmm'),
				'yes' => esc_attr__('Yes (please enter subdomains in next form field)','lmm')
			)
		);
		$this->settings['wms_wms2_subdomains_names'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections3',
			'title'   => esc_attr__( 'Subdomain names', 'lmm' ),
			'desc'    => esc_attr__('For example','lmm'). ": &quot;subdomain1&quot;, &quot;subdomain2&quot;, &quot;subdomain3&quot;",
			'std'     => '&quot;subdomain1&quot;, &quot;subdomain2&quot;, &quot;subdomain3&quot;',
			'type'    => 'text'
		);	
		$this->settings['wms_wms2_kml_helptext'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections3',
			'std'     => '', 
			'title'   => '<strong>' . esc_attr__('KML settings','lmm') . '</strong>',
			'desc'    => esc_attr__('If the WMS server supports KML output of the WMS layer, the settings below will be used when a marker or layer map with this active WMS layer is exported as KML.','lmm'),
			'type'    => 'helptext'
		);
		$this->settings['wms_wms2_kml_support'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections3',
			'title'   => esc_attr__('Does the WMS server support KML output?','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'yes',
			'choices' => array(
				'yes' => esc_attr__('yes','lmm'),
				'no' => esc_attr__('no','lmm')
			)
		);	
		$this->settings['wms_wms2_kml_href'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections3',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#href" target="_blank">href</a>',
			'desc'    => esc_attr__('http-address of the KML-webservice of the WMS layer','lmm'),
			'type'    => 'text',
			'std'     => 'http://data.wien.gv.at/daten/geoserver/ows?version=1.3.0&service=WMS&request=GetMap&crs=EPSG:4326&bbox=48.10,16.16,48.34,16.59&width=1&height=1&layers=ogdwien:AUFZUGOGD&styles=&format=application/vnd.google-earth.kml+xml' 
		);	
		$this->settings['wms_wms2_kml_refreshMode'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections3',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#refreshmode" target="_blank">refreshMode</a>',
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'onChange',
			'choices' => array(
				'onChange' => esc_attr__('onChange (refresh when the file is loaded and whenever the Link parameters change)','lmm'),
				'onInterval' => esc_attr__('onInterval (refresh every n seconds (specified in refreshInterval)','lmm'),
				'onExpire' => esc_attr__('onExpire (refresh the file when the expiration time is reached)','lmm'),
				'onStop' => esc_attr__('onStop (after camera movement stops)','lmm')
			)
		);	
		$this->settings['wms_wms2_kml_refreshInterval'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections3',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#refreshinterval" target="_blank">refreshInterval</a>',
			'desc'    => esc_attr__('Indicates to refresh the file every n seconds','lmm'),
			'type'    => 'text',
			'std'     => '30' 
		);		
		$this->settings['wms_wms2_kml_viewRefreshMode'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections3',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#viewrefreshmode" target="_blank">viewrefreshMode</a>',
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'never',
			'choices' => array(
				'never' => esc_attr__('never (ignore changes in the view)','lmm'),
				'onStop' => esc_attr__('onStop (refresh the file n seconds after movement stops, where n is specified in viewRefreshTime)','lmm'),
				'onRequest' => esc_attr__('onRequest (refresh the file only when the user explicitly requests it)','lmm')
			)
		);			
		$this->settings['wms_wms2_kml_viewRefreshTime'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections3',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#viewrefreshtime" target="_blank">viewRefreshTime</a>',
			'desc'    => esc_attr__('After camera movement stops, specifies the number of seconds to wait before refreshing the view (is used when viewRefreshMode is set to onStop)','lmm'),
			'type'    => 'text',
			'std'     => '1' 
		);		
		/*
		* WMS layer 3 settings
		*/
		$this->settings['wms_wms3_helptext'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections4',
			'std'     => '', 
			'title'   => '',
			'desc'    => '', //empty for not breaking settings layout
			'type'    => 'helptext'
		);
		$this->settings['wms_wms3_name'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections4',
			'title'    => esc_attr__('Name','lmm'),
			'desc'    => '',
			'type'    => 'text',
			'std'     => '<a href=&quot;http://discomap.eea.europa.eu/ArcGIS/rest/services/Air/EPRTRDiffuseAir_Dyna_WGS84/MapServer/7&quot; target=&quot;_blank&quot;>EEA - CO emissions from road transport</a>' 
		);
		$this->settings['wms_wms3_baseurl'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections4',
			'title'    => esc_attr__('baseURL','lmm'),
			'desc'    => '',
			'type'    => 'text',
			'std'     => 'http://discomap.eea.europa.eu/ArcGIS/services/Air/EPRTRDiffuseAir_Dyna_WGS84/MapServer/WMSServer' 
		);
		$this->settings['wms_wms3_layers'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections4',
			'title'    => esc_attr__('Layers','lmm'),
			'desc'    => esc_attr__('(required) Comma-separated list of WMS layers to show','lmm'),
			'type'    => 'text',
			'std'     => '24' 
		);
		$this->settings['wms_wms3_styles'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections4',
			'title'    => esc_attr__('Styles','lmm'),
			'desc'    => esc_attr__('Comma-separated list of WMS styles','lmm'),
			'type'    => 'text',
			'std'     => '' 
		);
		$this->settings['wms_wms3_format'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections4',
			'title'    => esc_attr__('Format','lmm'),
			'desc'    => '',
			'type'    => 'text',
			'std'     => 'image/png' 
		);		
		$this->settings['wms_wms3_transparent'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections4',
			'title'   => esc_attr__('Transparent','lmm'),
			'desc'    => esc_attr__('If yes, the WMS service will return images with transparency','lmm'),
			'type'    => 'radio',
			'std'     => 'TRUE',
			'choices' => array(
				'TRUE' => esc_attr__('true','lmm'),
				'FALSE' => esc_attr__('false','lmm')
			)
		);
		$this->settings['wms_wms3_attribution'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections4',
			'title'    => esc_attr__('Attribution','lmm'),
			'desc'    => '',
			'type'    => 'text',
			'std'     => 'WMS: <a href=&quot;http://www.eea.europa.eu/code/gis&quot; target=&quot;_blank&quot;>European Environment Agency</a>' 
		);		
		$this->settings['wms_wms3_legend_enabled'] = array(
			'version' => '1.1',
			'pane'    => 'wms',
			'section' => 'wms-sections4',
			'title'   => esc_attr__('Display legend?','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'yes',
			'choices' => array(
				'yes' => esc_attr__('Yes','lmm'),
				'no' => esc_attr__('No','lmm')
			)
		);		
		$this->settings['wms_wms3_legend'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections4',
			'title'    => esc_attr__('Legend','lmm'),
			'desc'    => esc_attr__('URL of image which gets show when hovering the text "(Legend)" next to WMS attribution text','lmm'),
			'type'    => 'text',
			'std'     => 'http://discomap.eea.europa.eu/ArcGIS/services/Air/EPRTRDiffuseAir_Dyna_WGS84/MapServer/WMSServer?request=GetLegendGraphic%26version=1.3.0%26format=image/png%26layer=1' 
		);		
		$this->settings['wms_wms3_version'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections4',
			'title'    => esc_attr__('Version','lmm'),
			'desc'    => esc_attr__('Version of the WMS service to use','lmm'),
			'type'    => 'text',
			'std'     => '1.3.0' 
		);		
		$this->settings['wms_wms3_subdomains_enabled'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections4',
			'title'   => esc_attr__('Support for subdomains?','lmm'),
			'desc'    => esc_attr__('Will replace {s} from base url if available','lmm'),
			'type'    => 'radio',
			'std'     => 'no',
			'choices' => array(
				'no' => esc_attr__('No','lmm'),
				'yes' => esc_attr__('Yes (please enter subdomains in next form field)','lmm')
			)
		);
		$this->settings['wms_wms3_subdomains_names'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections4',
			'title'   => esc_attr__( 'Subdomain names', 'lmm' ),
			'desc'    => esc_attr__('For example','lmm'). ": &quot;subdomain1&quot;, &quot;subdomain2&quot;, &quot;subdomain3&quot;",
			'std'     => '&quot;subdomain1&quot;, &quot;subdomain2&quot;, &quot;subdomain3&quot;',
			'type'    => 'text'
		);	
		$this->settings['wms_wms3_kml_helptext'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections4',
			'std'     => '', 
			'title'   => '<strong>' . esc_attr__('KML settings','lmm') . '</strong>',
			'desc'    => esc_attr__('If the WMS server supports KML output of the WMS layer, the settings below will be used when a marker or layer map with this active WMS layer is exported as KML.','lmm'),
			'type'    => 'helptext'
		);
		$this->settings['wms_wms3_kml_support'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections4',
			'title'   => esc_attr__('Does the WMS server support KML output?','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'yes',
			'choices' => array(
				'yes' => esc_attr__('yes','lmm'),
				'no' => esc_attr__('no','lmm')
			)
		);	
		$this->settings['wms_wms3_kml_href'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections4',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#href" target="_blank">href</a>',
			'desc'    => esc_attr__('http-address of the KML-webservice of the WMS layer','lmm'),
			'type'    => 'text',
			'std'     => 'http://discomap.eea.europa.eu/ArcGIS/rest/services/Air/EPRTRDiffuseAir_Dyna_WGS84/MapServer/generatekml?docName=&l%3A7=on&layers=7&layerOptions=nonComposite' 
		);	
		$this->settings['wms_wms3_kml_refreshMode'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections4',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#refreshmode" target="_blank">refreshMode</a>',
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'onChange',
			'choices' => array(
				'onChange' => esc_attr__('onChange (refresh when the file is loaded and whenever the Link parameters change)','lmm'),
				'onInterval' => esc_attr__('onInterval (refresh every n seconds (specified in refreshInterval)','lmm'),
				'onExpire' => esc_attr__('onExpire (refresh the file when the expiration time is reached)','lmm'),
				'onStop' => esc_attr__('onStop (after camera movement stops)','lmm')
			)
		);	
		$this->settings['wms_wms3_kml_refreshInterval'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections4',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#refreshinterval" target="_blank">refreshInterval</a>',
			'desc'    => esc_attr__('Indicates to refresh the file every n seconds','lmm'),
			'type'    => 'text',
			'std'     => '30' 
		);		
		$this->settings['wms_wms3_kml_viewRefreshMode'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections4',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#viewrefreshmode" target="_blank">viewrefreshMode</a>',
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'never',
			'choices' => array(
				'never' => esc_attr__('never (ignore changes in the view)','lmm'),
				'onStop' => esc_attr__('onStop (refresh the file n seconds after movement stops, where n is specified in viewRefreshTime)','lmm'),
				'onRequest' => esc_attr__('onRequest (refresh the file only when the user explicitly requests it)','lmm')
			)
		);			
		$this->settings['wms_wms3_kml_viewRefreshTime'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections4',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#viewrefreshtime" target="_blank">viewRefreshTime</a>',
			'desc'    => esc_attr__('After camera movement stops, specifies the number of seconds to wait before refreshing the view (is used when viewRefreshMode is set to onStop)','lmm'),
			'type'    => 'text',
			'std'     => '1' 
		);	
		/*
		* WMS layer 4 settings
		*/
		$this->settings['wms_wms4_helptext'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections5',
			'std'     => '', 
			'title'   => '',
			'desc'    => '', //empty for not breaking settings layout
			'type'    => 'helptext'
		);
		$this->settings['wms_wms4_name'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections5',
			'title'    => esc_attr__('Name','lmm'),
			'desc'    => '',
			'type'    => 'text',
			'std'     => '<a href=&quot;http://discomap.eea.europa.eu/ArcGIS/rest/services/Land/CLC2006_Dyna_WM/MapServer&quot; target=&quot;_blank&quot;>EEA - Agricultural areas</a>' 
		);
		$this->settings['wms_wms4_baseurl'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections5',
			'title'    => esc_attr__('baseURL','lmm'),
			'desc'    => '',
			'type'    => 'text',
			'std'     => 'http://discomap.eea.europa.eu/ArcGIS/services/Land/CLC2006_Dyna_WM/MapServer/WMSServer' 
		);
		$this->settings['wms_wms4_layers'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections5',
			'title'    => esc_attr__('Layers','lmm'),
			'desc'    => esc_attr__('(required) Comma-separated list of WMS layers to show','lmm'),
			'type'    => 'text',
			'std'     => '10' 
		);
		$this->settings['wms_wms4_styles'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections5',
			'title'    => esc_attr__('Styles','lmm'),
			'desc'    => esc_attr__('Comma-separated list of WMS styles','lmm'),
			'type'    => 'text',
			'std'     => '' 
		);
		$this->settings['wms_wms4_format'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections5',
			'title'    => esc_attr__('Format','lmm'),
			'desc'    => '',
			'type'    => 'text',
			'std'     => 'image/png' 
		);		
		$this->settings['wms_wms4_transparent'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections5',
			'title'   => esc_attr__('Transparent','lmm'),
			'desc'    => esc_attr__('If yes, the WMS service will return images with transparency','lmm'),
			'type'    => 'radio',
			'std'     => 'TRUE',
			'choices' => array(
				'TRUE' => esc_attr__('true','lmm'),
				'FALSE' => esc_attr__('false','lmm')
			)
		);
		$this->settings['wms_wms4_version'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections5',
			'title'    => esc_attr__('Version','lmm'),
			'desc'    => esc_attr__('Version of the WMS service to use','lmm'),
			'type'    => 'text',
			'std'     => '1.3.0' 
		);
		$this->settings['wms_wms4_attribution'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections5',
			'title'    => esc_attr__('Attribution','lmm'),
			'desc'    => '',
			'type'    => 'text',
			'std'     => 'WMS: <a href=&quot;http://www.eea.europa.eu/code/gis&quot; target=&quot;_blank&quot;>European Environment Agency</a>' 
		);		
		$this->settings['wms_wms4_legend_enabled'] = array(
			'version' => '1.1',
			'pane'    => 'wms',
			'section' => 'wms-sections5',
			'title'   => esc_attr__('Display legend?','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'yes',
			'choices' => array(
				'yes' => esc_attr__('Yes','lmm'),
				'no' => esc_attr__('No','lmm')
			)
		);		
		$this->settings['wms_wms4_legend'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections5',
			'title'    => esc_attr__('Legend','lmm'),
			'desc'    => esc_attr__('URL of image which gets show when hovering the text "(Legend)" next to WMS attribution text','lmm'),
			'type'    => 'text',
			'std'     => 'http://discomap.eea.europa.eu/ArcGIS/services/Land/CLC2000_Cach_WM/MapServer/WMSServer?request=GetLegendGraphic%26version=1.3.0%26format=image/png%26layer=11'			
		);		
		$this->settings['wms_wms4_subdomains_enabled'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections5',
			'title'   => esc_attr__('Support for subdomains?','lmm'),
			'desc'    => esc_attr__('Will replace {s} from base url if available','lmm'),
			'type'    => 'radio',
			'std'     => 'no',
			'choices' => array(
				'no' => esc_attr__('No','lmm'),
				'yes' => esc_attr__('Yes (please enter subdomains in next form field)','lmm')
			)
		);
		$this->settings['wms_wms4_subdomains_names'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections5',
			'title'   => esc_attr__( 'Subdomain names', 'lmm' ),
			'desc'    => esc_attr__('For example','lmm'). ": &quot;subdomain1&quot;, &quot;subdomain2&quot;, &quot;subdomain3&quot;",
			'std'     => '&quot;subdomain1&quot;, &quot;subdomain2&quot;, &quot;subdomain3&quot;',
			'type'    => 'text'
		);	
		$this->settings['wms_wms4_kml_helptext'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections5',
			'std'     => '', 
			'title'   => '<strong>' . esc_attr__('KML settings','lmm') . '</strong>',
			'desc'    => esc_attr__('If the WMS server supports KML output of the WMS layer, the settings below will be used when a marker or layer map with this active WMS layer is exported as KML.','lmm'),
			'type'    => 'helptext'
		);
		$this->settings['wms_wms4_kml_support'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections5',
			'title'   => esc_attr__('Does the WMS server support KML output?','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'yes',
			'choices' => array(
				'yes' => esc_attr__('yes','lmm'),
				'no' => esc_attr__('no','lmm')
			)
		);	
		$this->settings['wms_wms4_kml_href'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections5',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#href" target="_blank">href</a>',
			'desc'    => esc_attr__('http-address of the KML-webservice of the WMS layer','lmm'),
			'type'    => 'text',
			'std'     => 'http://discomap.eea.europa.eu/ArcGIS/rest/services/Land/CLC2006_Dyna_WM/MapServer/generatekml?docName=&l%3A5=on&layers=5&layerOptions=nonComposite' 
		);	
		$this->settings['wms_wms4_kml_refreshMode'] = array(
			'version' => '1.4.3',


			'pane'    => 'wms',
			'section' => 'wms-sections5',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#refreshmode" target="_blank">refreshMode</a>',
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'onChange',
			'choices' => array(
				'onChange' => esc_attr__('onChange (refresh when the file is loaded and whenever the Link parameters change)','lmm'),
				'onInterval' => esc_attr__('onInterval (refresh every n seconds (specified in refreshInterval)','lmm'),
				'onExpire' => esc_attr__('onExpire (refresh the file when the expiration time is reached)','lmm'),
				'onStop' => esc_attr__('onStop (after camera movement stops)','lmm')
			)
		);	
		$this->settings['wms_wms4_kml_refreshInterval'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections5',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#refreshinterval" target="_blank">refreshInterval</a>',
			'desc'    => esc_attr__('Indicates to refresh the file every n seconds','lmm'),
			'type'    => 'text',
			'std'     => '30' 
		);		
		$this->settings['wms_wms4_kml_viewRefreshMode'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections5',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#viewrefreshmode" target="_blank">viewrefreshMode</a>',
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'never',
			'choices' => array(
				'never' => esc_attr__('never (ignore changes in the view)','lmm'),
				'onStop' => esc_attr__('onStop (refresh the file n seconds after movement stops, where n is specified in viewRefreshTime)','lmm'),
				'onRequest' => esc_attr__('onRequest (refresh the file only when the user explicitly requests it)','lmm')
			)
		);			
		$this->settings['wms_wms4_kml_viewRefreshTime'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections5',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#viewrefreshtime" target="_blank">viewRefreshTime</a>',
			'desc'    => esc_attr__('After camera movement stops, specifies the number of seconds to wait before refreshing the view (is used when viewRefreshMode is set to onStop)','lmm'),
			'type'    => 'text',
			'std'     => '1' 
		);	
		/*
		* WMS layer 5 settings
		*/
		$this->settings['wms_wms5_helptext'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections6',
			'std'     => '', 
			'title'   => '',
			'desc'    => '', //empty for not breaking settings layout
			'type'    => 'helptext'
		);
		$this->settings['wms_wms5_name'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections6',
			'title'    => esc_attr__('Name','lmm'),
			'desc'    => '',
			'type'    => 'text',
			'std'     => '<a href=&quot;http://discomap.eea.europa.eu/ArcGIS/rest/services/Noise/Noise_Dyna_LAEA/MapServer/460&quot; target=&quot;_blank&quot;>EEA - Airport Annual Traffic</a>' 
		);
		$this->settings['wms_wms5_baseurl'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections6',
			'title'    => esc_attr__('baseURL','lmm'),
			'desc'    => '',
			'type'    => 'text',
			'std'     => 'http://discomap.eea.europa.eu/ArcGIS/services/Noise/Noise_Dyna_LAEA/MapServer/WMSServer' 
		);
		$this->settings['wms_wms5_layers'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections6',
			'title'    => esc_attr__('Layers','lmm'),
			'desc'    => esc_attr__('(required) Comma-separated list of WMS layers to show','lmm'),
			'type'    => 'text',
			'std'     => '8' 
		);
		$this->settings['wms_wms5_styles'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections6',
			'title'    => esc_attr__('Styles','lmm'),
			'desc'    => esc_attr__('Comma-separated list of WMS styles','lmm'),
			'type'    => 'text',
			'std'     => '' 
		);
		$this->settings['wms_wms5_format'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections6',
			'title'    => esc_attr__('Format','lmm'),
			'desc'    => '',
			'type'    => 'text',
			'std'     => 'image/png' 
		);		
		$this->settings['wms_wms5_transparent'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections6',
			'title'   => esc_attr__('Transparent','lmm'),
			'desc'    => esc_attr__('If yes, the WMS service will return images with transparency','lmm'),
			'type'    => 'radio',
			'std'     => 'TRUE',
			'choices' => array(
				'TRUE' => esc_attr__('true','lmm'),
				'FALSE' => esc_attr__('false','lmm')
			)
		);
		$this->settings['wms_wms5_version'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections6',
			'title'    => esc_attr__('Version','lmm'),
			'desc'    => esc_attr__('Version of the WMS service to use','lmm'),
			'type'    => 'text',
			'std'     => '1.3.0' 
		);	
		$this->settings['wms_wms5_attribution'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections6',
			'title'    => esc_attr__('Attribution','lmm'),
			'desc'    => '',
			'type'    => 'text',
			'std'     => 'WMS: <a href=&quot;http://www.eea.europa.eu/code/gis&quot; target=&quot;_blank&quot;>European Environment Agency</a>' 
		);		
		$this->settings['wms_wms5_legend_enabled'] = array(
			'version' => '1.1',
			'pane'    => 'wms',
			'section' => 'wms-sections6',
			'title'   => esc_attr__('Display legend?','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'yes',
			'choices' => array(
				'yes' => esc_attr__('Yes','lmm'),
				'no' => esc_attr__('No','lmm')
			)
		);		
		$this->settings['wms_wms5_legend'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections6',
			'title'    => esc_attr__('Legend','lmm'),
			'desc'    => esc_attr__('URL of image which gets show when hovering the text "(Legend)" next to WMS attribution text','lmm'),
			'type'    => 'text',
			'std'     => 'http://discomap.eea.europa.eu/ArcGIS/services/Noise/Noise_Dyna_LAEA/MapServer/WMSServer?request=GetLegendGraphic%26version=1.3.0%26format=image/png%26layer=8'			
		);		
		$this->settings['wms_wms5_subdomains_enabled'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections6',
			'title'   => esc_attr__('Support for subdomains?','lmm'),
			'desc'    => esc_attr__('Will replace {s} from base url if available','lmm'),
			'type'    => 'radio',
			'std'     => 'no',
			'choices' => array(
				'no' => esc_attr__('No','lmm'),
				'yes' => esc_attr__('Yes (please enter subdomains in next form field)','lmm')
			)
		);
		$this->settings['wms_wms5_subdomains_names'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections6',
			'title'   => esc_attr__( 'Subdomain names', 'lmm' ),
			'desc'    => esc_attr__('For example','lmm'). ": &quot;subdomain1&quot;, &quot;subdomain2&quot;, &quot;subdomain3&quot;",
			'std'     => '&quot;subdomain1&quot;, &quot;subdomain2&quot;, &quot;subdomain3&quot;',
			'type'    => 'text'
		);	
		$this->settings['wms_wms5_kml_helptext'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections6',
			'std'     => '', 
			'title'   => '<strong>' . esc_attr__('KML settings','lmm') . '</strong>',
			'desc'    => esc_attr__('If the WMS server supports KML output of the WMS layer, the settings below will be used when a marker or layer map with this active WMS layer is exported as KML.','lmm'),
			'type'    => 'helptext'
		);
		$this->settings['wms_wms5_kml_support'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections6',

			'title'   => esc_attr__('Does the WMS server support KML output?','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'yes',
			'choices' => array(
				'yes' => esc_attr__('yes','lmm'),
				'no' => esc_attr__('no','lmm')
			)
		);	
		$this->settings['wms_wms5_kml_href'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections6',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#href" target="_blank">href</a>',
			'desc'    => esc_attr__('http-address of the KML-webservice of the WMS layer','lmm'),
			'type'    => 'text',
			'std'     => 'http://discomap.eea.europa.eu/ArcGIS/rest/services/Noise/Noise_Dyna_LAEA/MapServer/generatekml?docName=&l%3A460=on&layers=460&layerOptions=nonComposite' 
		);	
		$this->settings['wms_wms5_kml_refreshMode'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections6',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#refreshmode" target="_blank">refreshMode</a>',
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'onChange',
			'choices' => array(
				'onChange' => esc_attr__('onChange (refresh when the file is loaded and whenever the Link parameters change)','lmm'),
				'onInterval' => esc_attr__('onInterval (refresh every n seconds (specified in refreshInterval)','lmm'),
				'onExpire' => esc_attr__('onExpire (refresh the file when the expiration time is reached)','lmm'),
				'onStop' => esc_attr__('onStop (after camera movement stops)','lmm')
			)
		);	
		$this->settings['wms_wms5_kml_refreshInterval'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections6',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#refreshinterval" target="_blank">refreshInterval</a>',
			'desc'    => esc_attr__('Indicates to refresh the file every n seconds','lmm'),
			'type'    => 'text',
			'std'     => '30' 
		);		
		$this->settings['wms_wms5_kml_viewRefreshMode'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections6',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#viewrefreshmode" target="_blank">viewrefreshMode</a>',
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'never',
			'choices' => array(
				'never' => esc_attr__('never (ignore changes in the view)','lmm'),
				'onStop' => esc_attr__('onStop (refresh the file n seconds after movement stops, where n is specified in viewRefreshTime)','lmm'),
				'onRequest' => esc_attr__('onRequest (refresh the file only when the user explicitly requests it)','lmm')
			)
		);			
		$this->settings['wms_wms5_kml_viewRefreshTime'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections6',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#viewrefreshtime" target="_blank">viewRefreshTime</a>',
			'desc'    => esc_attr__('After camera movement stops, specifies the number of seconds to wait before refreshing the view (is used when viewRefreshMode is set to onStop)','lmm'),
			'type'    => 'text',
			'std'     => '1' 
		);				
		/*
		* WMS layer 6 settings
		*/
		$this->settings['wms_wms6_helptext'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections7',
			'std'     => '', 
			'title'   => '',
			'desc'    => '', //empty for not breaking settings layout
			'type'    => 'helptext'
		);
		$this->settings['wms_wms6_name'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections7',
			'title'    => esc_attr__('Name','lmm'),
			'desc'    => '',
			'type'    => 'text',
			'std'     => '<a href=&quot;http://discomap.eea.europa.eu/ArcGIS/rest/services/Land/CLC2006_Dyna_WM/MapServer&quot; target=&quot;_blank&quot;>EEA - WaterBodies</a>' 
		);
		$this->settings['wms_wms6_baseurl'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections7',
			'title'    => esc_attr__('baseURL','lmm'),
			'desc'    => '',
			'type'    => 'text',
			'std'     => 'http://discomap.eea.europa.eu/ArcGIS/services/Land/CLC2006_Dyna_WM/MapServer/WMSServer' 
		);
		$this->settings['wms_wms6_layers'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections7',
			'title'    => esc_attr__('Layers','lmm'),
			'desc'    => esc_attr__('(required) Comma-separated list of WMS layers to show','lmm'),
			'type'    => 'text',
			'std'     => '2' 
		);
		$this->settings['wms_wms6_styles'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections7',
			'title'    => esc_attr__('Styles','lmm'),
			'desc'    => esc_attr__('Comma-separated list of WMS styles','lmm'),
			'type'    => 'text',
			'std'     => '' 
		);
		$this->settings['wms_wms6_format'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections7',
			'title'    => esc_attr__('Format','lmm'),
			'desc'    => '',
			'type'    => 'text',
			'std'     => 'image/png' 
		);		
		$this->settings['wms_wms6_transparent'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections7',
			'title'   => esc_attr__('Transparent','lmm'),
			'desc'    => esc_attr__('If yes, the WMS service will return images with transparency','lmm'),
			'type'    => 'radio',
			'std'     => 'TRUE',
			'choices' => array(
				'TRUE' => esc_attr__('true','lmm'),
				'FALSE' => esc_attr__('false','lmm')
			)
		);
		$this->settings['wms_wms6_version'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections7',
			'title'    => esc_attr__('Version','lmm'),
			'desc'    => esc_attr__('Version of the WMS service to use','lmm'),
			'type'    => 'text',
			'std'     => '1.3.0' 
		);	
		$this->settings['wms_wms6_attribution'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections7',
			'title'    => esc_attr__('Attribution','lmm'),
			'desc'    => '',
			'type'    => 'text',
			'std'     => 'WMS: <a href=&quot;http://www.eea.europa.eu/code/gis&quot; target=&quot;_blank&quot;>European Environment Agency</a>' 
		);		
		$this->settings['wms_wms6_legend_enabled'] = array(
			'version' => '1.1',
			'pane'    => 'wms',
			'section' => 'wms-sections7',
			'title'   => esc_attr__('Display legend?','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'yes',
			'choices' => array(
				'yes' => esc_attr__('Yes','lmm'),
				'no' => esc_attr__('No','lmm')
			)
		);		
		$this->settings['wms_wms6_legend'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections7',
			'title'    => esc_attr__('Legend','lmm'),
			'desc'    => esc_attr__('URL of image which gets show when hovering the text "(Legend)" next to WMS attribution text','lmm'),
			'type'    => 'text',
			'std'     => 'http://discomap.eea.europa.eu/ArcGIS/services/Land/CLC2006_Dyna_WM/MapServer/WMSServer?request=GetLegendGraphic%26version=1.3.0%26format=image/png%26layer=2'			
		);		
		$this->settings['wms_wms6_subdomains_enabled'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections7',
			'title'   => esc_attr__('Support for subdomains?','lmm'),
			'desc'    => esc_attr__('Will replace {s} from base url if available','lmm'),
			'type'    => 'radio',
			'std'     => 'no',
			'choices' => array(
				'no' => esc_attr__('No','lmm'),
				'yes' => esc_attr__('Yes (please enter subdomains in next form field)','lmm')
			)
		);
		$this->settings['wms_wms6_subdomains_names'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections7',
			'title'   => esc_attr__( 'Subdomain names', 'lmm' ),
			'desc'    => esc_attr__('For example','lmm'). ": &quot;subdomain1&quot;, &quot;subdomain2&quot;, &quot;subdomain3&quot;",
			'std'     => '&quot;subdomain1&quot;, &quot;subdomain2&quot;, &quot;subdomain3&quot;',
			'type'    => 'text'
		);	
		$this->settings['wms_wms6_kml_helptext'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections7',
			'std'     => '', 
			'title'   => '<strong>' . esc_attr__('KML settings','lmm') . '</strong>',
			'desc'    => esc_attr__('If the WMS server supports KML output of the WMS layer, the settings below will be used when a marker or layer map with this active WMS layer is exported as KML.','lmm'),
			'type'    => 'helptext'
		);
		$this->settings['wms_wms6_kml_support'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections7',
			'title'   => esc_attr__('Does the WMS server support KML output?','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'yes',
			'choices' => array(
				'yes' => esc_attr__('yes','lmm'),
				'no' => esc_attr__('no','lmm')
			)
		);	
		$this->settings['wms_wms6_kml_href'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections7',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#href" target="_blank">href</a>',
			'desc'    => esc_attr__('http-address of the KML-webservice of the WMS layer','lmm'),
			'type'    => 'text',
			'std'     => 'http://discomap.eea.europa.eu/ArcGIS/rest/services/Land/CLC2006_Dyna_WM/MapServer/generatekml?docName=&l%3A14=on&layers=14&layerOptions=nonComposite' 
		);	
		$this->settings['wms_wms6_kml_refreshMode'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections7',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#refreshmode" target="_blank">refreshMode</a>',
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'onChange',
			'choices' => array(
				'onChange' => esc_attr__('onChange (refresh when the file is loaded and whenever the Link parameters change)','lmm'),
				'onInterval' => esc_attr__('onInterval (refresh every n seconds (specified in refreshInterval)','lmm'),
				'onExpire' => esc_attr__('onExpire (refresh the file when the expiration time is reached)','lmm'),
				'onStop' => esc_attr__('onStop (after camera movement stops)','lmm')
			)
		);	
		$this->settings['wms_wms6_kml_refreshInterval'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections7',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#refreshinterval" target="_blank">refreshInterval</a>',
			'desc'    => esc_attr__('Indicates to refresh the file every n seconds','lmm'),
			'type'    => 'text',
			'std'     => '30' 
		);		
		$this->settings['wms_wms6_kml_viewRefreshMode'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections7',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#viewrefreshmode" target="_blank">viewrefreshMode</a>',
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'never',
			'choices' => array(
				'never' => esc_attr__('never (ignore changes in the view)','lmm'),
				'onStop' => esc_attr__('onStop (refresh the file n seconds after movement stops, where n is specified in viewRefreshTime)','lmm'),
				'onRequest' => esc_attr__('onRequest (refresh the file only when the user explicitly requests it)','lmm')
			)
		);			
		$this->settings['wms_wms6_kml_viewRefreshTime'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections7',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#viewrefreshtime" target="_blank">viewRefreshTime</a>',
			'desc'    => esc_attr__('After camera movement stops, specifies the number of seconds to wait before refreshing the view (is used when viewRefreshMode is set to onStop)','lmm'),
			'type'    => 'text',
			'std'     => '1' 
		);		
		/*
		* WMS layer 7 settings
		*/
		$this->settings['wms_wms7_helptext'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections8',
			'std'     => '', 
			'title'   => '',
			'desc'    => '', //empty for not breaking settings layout
			'type'    => 'helptext'
		);
		$this->settings['wms_wms7_name'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections8',
			'title'    => esc_attr__('Name','lmm'),
			'desc'    => '',
			'type'    => 'text',
			'std'     => '<a href=&quot;http://discomap.eea.europa.eu/ArcGIS/rest/services/Water/RiverAndLakes_Dyna_WM/MapServer&quot; target=&quot;_blank&quot;>EEA - Mean annual nitrates in rivers 2008</a>' 
		);
		$this->settings['wms_wms7_baseurl'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections8',
			'title'    => esc_attr__('baseURL','lmm'),
			'desc'    => '',
			'type'    => 'text',
			'std'     => 'http://discomap.eea.europa.eu/ArcGIS/services/Water/RiverAndLakes_Dyna_WM/MapServer/WMSServer' 
		);
		$this->settings['wms_wms7_layers'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections8',
			'title'    => esc_attr__('Layers','lmm'),
			'desc'    => esc_attr__('(required) Comma-separated list of WMS layers to show','lmm'),
			'type'    => 'text',
			'std'     => '14' 
		);
		$this->settings['wms_wms7_styles'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections8',
			'title'    => esc_attr__('Styles','lmm'),
			'desc'    => esc_attr__('Comma-separated list of WMS styles','lmm'),
			'type'    => 'text',
			'std'     => '' 
		);
		$this->settings['wms_wms7_format'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections8',
			'title'    => esc_attr__('Format','lmm'),
			'desc'    => '',
			'type'    => 'text',
			'std'     => 'image/png' 
		);		
		$this->settings['wms_wms7_transparent'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections8',
			'title'   => esc_attr__('Transparent','lmm'),
			'desc'    => esc_attr__('If yes, the WMS service will return images with transparency','lmm'),
			'type'    => 'radio',
			'std'     => 'TRUE',
			'choices' => array(
				'TRUE' => esc_attr__('true','lmm'),
				'FALSE' => esc_attr__('false','lmm')
			)
		);
		$this->settings['wms_wms7_version'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections8',
			'title'    => esc_attr__('Version','lmm'),
			'desc'    => esc_attr__('Version of the WMS service to use','lmm'),
			'type'    => 'text',
			'std'     => '1.3.0' 
		);	
		$this->settings['wms_wms7_attribution'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections8',
			'title'    => esc_attr__('Attribution','lmm'),
			'desc'    => '',
			'type'    => 'text',
			'std'     => 'WMS: <a href=&quot;http://www.eea.europa.eu/code/gis&quot; target=&quot;_blank&quot;>European Environment Agency</a>' 
		);		
		$this->settings['wms_wms7_legend_enabled'] = array(
			'version' => '1.1',
			'pane'    => 'wms',
			'section' => 'wms-sections8',
			'title'   => esc_attr__('Display legend?','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'yes',
			'choices' => array(
				'yes' => esc_attr__('Yes','lmm'),
				'no' => esc_attr__('No','lmm')
			)
		);		
		$this->settings['wms_wms7_legend'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections8',
			'title'    => esc_attr__('Legend','lmm'),
			'desc'    => esc_attr__('URL of image which gets show when hovering the text "(Legend)" next to WMS attribution text','lmm'),
			'type'    => 'text',
			'std'     => 'http://discomap.eea.europa.eu/ArcGIS/services/Water/RiverAndLakes_Dyna_WM/MapServer/WMSServer?request=GetLegendGraphic%26version=1.3.0%26format=image/png%26layer=14'			
		);		
		$this->settings['wms_wms7_subdomains_enabled'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections8',
			'title'   => esc_attr__('Support for subdomains?','lmm'),
			'desc'    => esc_attr__('Will replace {s} from base url if available','lmm'),
			'type'    => 'radio',
			'std'     => 'no',
			'choices' => array(
				'no' => esc_attr__('No','lmm'),
				'yes' => esc_attr__('Yes (please enter subdomains in next form field)','lmm')
			)
		);
		$this->settings['wms_wms7_subdomains_names'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections8',
			'title'   => esc_attr__( 'Subdomain names', 'lmm' ),
			'desc'    => esc_attr__('For example','lmm'). ": &quot;subdomain1&quot;, &quot;subdomain2&quot;, &quot;subdomain3&quot;",
			'std'     => '&quot;subdomain1&quot;, &quot;subdomain2&quot;, &quot;subdomain3&quot;',
			'type'    => 'text'
		);	
		$this->settings['wms_wms7_kml_helptext'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections8',
			'std'     => '', 
			'title'   => '<strong>' . esc_attr__('KML settings','lmm') . '</strong>',
			'desc'    => esc_attr__('If the WMS server supports KML output of the WMS layer, the settings below will be used when a marker or layer map with this active WMS layer is exported as KML.','lmm'),
			'type'    => 'helptext'
		);
		$this->settings['wms_wms7_kml_support'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections8',
			'title'   => esc_attr__('Does the WMS server support KML output?','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'yes',
			'choices' => array(
				'yes' => esc_attr__('yes','lmm'),
				'no' => esc_attr__('no','lmm')
			)
		);	
		$this->settings['wms_wms7_kml_href'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections8',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#href" target="_blank">href</a>',
			'desc'    => esc_attr__('http-address of the KML-webservice of the WMS layer','lmm'),
			'type'    => 'text',
			'std'     => 'http://discomap.eea.europa.eu/ArcGIS/rest/services/Water/RiverAndLakes_Dyna_WM/MapServer/generatekml?docName=&l%3A9=on&layers=9&layerOptions=nonComposite' 
		);	
		$this->settings['wms_wms7_kml_refreshMode'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections8',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#refreshmode" target="_blank">refreshMode</a>',
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'onChange',
			'choices' => array(
				'onChange' => esc_attr__('onChange (refresh when the file is loaded and whenever the Link parameters change)','lmm'),
				'onInterval' => esc_attr__('onInterval (refresh every n seconds (specified in refreshInterval)','lmm'),
				'onExpire' => esc_attr__('onExpire (refresh the file when the expiration time is reached)','lmm'),
				'onStop' => esc_attr__('onStop (after camera movement stops)','lmm')
			)
		);	
		$this->settings['wms_wms7_kml_refreshInterval'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections8',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#refreshinterval" target="_blank">refreshInterval</a>',
			'desc'    => esc_attr__('Indicates to refresh the file every n seconds','lmm'),
			'type'    => 'text',
			'std'     => '30' 
		);		
		$this->settings['wms_wms7_kml_viewRefreshMode'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections8',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#viewrefreshmode" target="_blank">viewrefreshMode</a>',
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'never',
			'choices' => array(
				'never' => esc_attr__('never (ignore changes in the view)','lmm'),
				'onStop' => esc_attr__('onStop (refresh the file n seconds after movement stops, where n is specified in viewRefreshTime)','lmm'),
				'onRequest' => esc_attr__('onRequest (refresh the file only when the user explicitly requests it)','lmm')
			)
		);			
		$this->settings['wms_wms7_kml_viewRefreshTime'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections8',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#viewrefreshtime" target="_blank">viewRefreshTime</a>',
			'desc'    => esc_attr__('After camera movement stops, specifies the number of seconds to wait before refreshing the view (is used when viewRefreshMode is set to onStop)','lmm'),
			'type'    => 'text',
			'std'     => '1' 
		);
		/*
		* WMS layer 8 settings
		*/
		$this->settings['wms_wms8_helptext'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections9',
			'std'     => '', 
			'title'   => '',
			'desc'    => '', //empty for not breaking settings layout
			'type'    => 'helptext'
		);
		$this->settings['wms_wms8_name'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections9',
			'title'    => esc_attr__('Name','lmm'),
			'desc'    => '',
			'type'    => 'text',
			'std'     => '<a href=&quot;http://discomap.eea.europa.eu/ArcGIS/rest/services/Reports2010/Reports2008_Dyna_WGS84/MapServer&quot; target=&quot;_blank&quot;>EEA - Temperature Change</a>' 
		);
		$this->settings['wms_wms8_baseurl'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections9',
			'title'    => esc_attr__('baseURL','lmm'),
			'desc'    => '',
			'type'    => 'text',
			'std'     => 'http://discomap.eea.europa.eu/ArcGIS/services/Reports2010/Reports2008_Dyna_WGS84/MapServer/WMSServer' 
		);
		$this->settings['wms_wms8_layers'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections9',
			'title'    => esc_attr__('Layers','lmm'),
			'desc'    => esc_attr__('(required) Comma-separated list of WMS layers to show','lmm'),
			'type'    => 'text',
			'std'     => '5' 
		);
		$this->settings['wms_wms8_styles'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections9',
			'title'    => esc_attr__('Styles','lmm'),
			'desc'    => esc_attr__('Comma-separated list of WMS styles','lmm'),
			'type'    => 'text',
			'std'     => '' 
		);
		$this->settings['wms_wms8_format'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections9',
			'title'    => esc_attr__('Format','lmm'),
			'desc'    => '',
			'type'    => 'text',
			'std'     => 'image/png' 
		);		
		$this->settings['wms_wms8_transparent'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections9',
			'title'   => esc_attr__('Transparent','lmm'),
			'desc'    => esc_attr__('If yes, the WMS service will return images with transparency','lmm'),
			'type'    => 'radio',
			'std'     => 'TRUE',
			'choices' => array(
				'TRUE' => esc_attr__('true','lmm'),
				'FALSE' => esc_attr__('false','lmm')
			)
		);
		$this->settings['wms_wms8_version'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections9',
			'title'    => esc_attr__('Version','lmm'),
			'desc'    => esc_attr__('Version of the WMS service to use','lmm'),
			'type'    => 'text',
			'std'     => '1.3.0' 
		);	
		$this->settings['wms_wms8_attribution'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections9',
			'title'    => esc_attr__('Attribution','lmm'),
			'desc'    => '',
			'type'    => 'text',
			'std'     => 'WMS: <a href=&quot;http://www.eea.europa.eu/code/gis&quot; target=&quot;_blank&quot;>European Environment Agency</a>' 
		);		
		$this->settings['wms_wms8_legend_enabled'] = array(
			'version' => '1.1',
			'pane'    => 'wms',
			'section' => 'wms-sections9',
			'title'   => esc_attr__('Display legend?','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'yes',
			'choices' => array(
				'yes' => esc_attr__('Yes','lmm'),
				'no' => esc_attr__('No','lmm')
			)
		);		
		$this->settings['wms_wms8_legend'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections9',
			'title'    => esc_attr__('Legend','lmm'),
			'desc'    => esc_attr__('URL of image which gets show when hovering the text "(Legend)" next to WMS attribution text','lmm'),
			'type'    => 'text',
			'std'     => 'http://cow6/ArcGIS/services/Reports2010/Reports2008_Dyna_WGS84/MapServer/WMSServer?request=GetLegendGraphic%26version=1.3.0%26format=image/png%26layer=5'			
		);		
		$this->settings['wms_wms8_subdomains_enabled'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections9',
			'title'   => esc_attr__('Support for subdomains?','lmm'),
			'desc'    => esc_attr__('Will replace {s} from base url if available','lmm'),
			'type'    => 'radio',
			'std'     => 'no',
			'choices' => array(
				'no' => esc_attr__('No','lmm'),
				'yes' => esc_attr__('Yes (please enter subdomains in next form field)','lmm')
			)
		);
		$this->settings['wms_wms8_subdomains_names'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections9',
			'title'   => esc_attr__( 'Subdomain names', 'lmm' ),
			'desc'    => esc_attr__('For example','lmm'). ": &quot;subdomain1&quot;, &quot;subdomain2&quot;, &quot;subdomain3&quot;",
			'std'     => '&quot;subdomain1&quot;, &quot;subdomain2&quot;, &quot;subdomain3&quot;',
			'type'    => 'text'
		);	
		$this->settings['wms_wms8_kml_helptext'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections9',
			'std'     => '', 
			'title'   => '<strong>' . esc_attr__('KML settings','lmm') . '</strong>',
			'desc'    => esc_attr__('If the WMS server supports KML output of the WMS layer, the settings below will be used when a marker or layer map with this active WMS layer is exported as KML.','lmm'),
			'type'    => 'helptext'
		);
		$this->settings['wms_wms8_kml_support'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections9',
			'title'   => esc_attr__('Does the WMS server support KML output?','lmm'),
			'desc'    => '',
			'type'    => 'radio',

			'std'     => 'yes',
			'choices' => array(
				'yes' => esc_attr__('yes','lmm'),
				'no' => esc_attr__('no','lmm')
			)
		);	
		$this->settings['wms_wms8_kml_href'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections9',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#href" target="_blank">href</a>',
			'desc'    => esc_attr__('http-address of the KML-webservice of the WMS layer','lmm'),
			'type'    => 'text',
			'std'     => 'http://discomap.eea.europa.eu/ArcGIS/rest/services/Reports2010/Reports2008_Dyna_WGS84/MapServer/generatekml?docName=&l%3A26=on&layers=26&layerOptions=nonComposite' 
		);	
		$this->settings['wms_wms8_kml_refreshMode'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections9',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#refreshmode" target="_blank">refreshMode</a>',
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'onChange',
			'choices' => array(
				'onChange' => esc_attr__('onChange (refresh when the file is loaded and whenever the Link parameters change)','lmm'),
				'onInterval' => esc_attr__('onInterval (refresh every n seconds (specified in refreshInterval)','lmm'),
				'onExpire' => esc_attr__('onExpire (refresh the file when the expiration time is reached)','lmm'),
				'onStop' => esc_attr__('onStop (after camera movement stops)','lmm')
			)
		);	
		$this->settings['wms_wms8_kml_refreshInterval'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections9',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#refreshinterval" target="_blank">refreshInterval</a>',
			'desc'    => esc_attr__('Indicates to refresh the file every n seconds','lmm'),
			'type'    => 'text',
			'std'     => '30' 
		);		
		$this->settings['wms_wms8_kml_viewRefreshMode'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections9',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#viewrefreshmode" target="_blank">viewrefreshMode</a>',
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'never',
			'choices' => array(
				'never' => esc_attr__('never (ignore changes in the view)','lmm'),
				'onStop' => esc_attr__('onStop (refresh the file n seconds after movement stops, where n is specified in viewRefreshTime)','lmm'),
				'onRequest' => esc_attr__('onRequest (refresh the file only when the user explicitly requests it)','lmm')
			)
		);			
		$this->settings['wms_wms8_kml_viewRefreshTime'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections9',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#viewrefreshtime" target="_blank">viewRefreshTime</a>',
			'desc'    => esc_attr__('After camera movement stops, specifies the number of seconds to wait before refreshing the view (is used when viewRefreshMode is set to onStop)','lmm'),
			'type'    => 'text',
			'std'     => '1' 
		);
		/*
		* WMS layer 9 settings
		*/
		$this->settings['wms_wms9_helptext'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections10',
			'std'     => '', 
			'title'   => '',
			'desc'    => '', //empty for not breaking settings layout
			'type'    => 'helptext'
		);
		$this->settings['wms_wms9_name'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections10',
			'title'    => esc_attr__('Name','lmm'),
			'desc'    => '',
			'type'    => 'text',
			'std'     => '<a href=&quot;http://discomap.eea.europa.eu/ArcGIS/rest/services/Bio/CDDA_Dyna_WGS84/MapServer&quot; target=&quot;_blank&quot;>EEA - Common Database on Designated Areas</a>' 
		);
		$this->settings['wms_wms9_baseurl'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections10',
			'title'    => esc_attr__('baseURL','lmm'),
			'desc'    => '',
			'type'    => 'text',
			'std'     => 'http://discomap.eea.europa.eu/ArcGIS/services/Bio/CDDA_Dyna_WGS84/MapServer/WMSServer' 
		);
		$this->settings['wms_wms9_layers'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections10',
			'title'    => esc_attr__('Layers','lmm'),
			'desc'    => esc_attr__('(required) Comma-separated list of WMS layers to show','lmm'),
			'type'    => 'text',
			'std'     => '0' 
		);
		$this->settings['wms_wms9_styles'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections10',
			'title'    => esc_attr__('Styles','lmm'),
			'desc'    => esc_attr__('Comma-separated list of WMS styles','lmm'),
			'type'    => 'text',
			'std'     => '' 
		);
		$this->settings['wms_wms9_format'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections10',
			'title'    => esc_attr__('Format','lmm'),
			'desc'    => '',
			'type'    => 'text',
			'std'     => 'image/png' 
		);		
		$this->settings['wms_wms9_transparent'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections10',
			'title'   => esc_attr__('Transparent','lmm'),
			'desc'    => esc_attr__('If yes, the WMS service will return images with transparency','lmm'),
			'type'    => 'radio',
			'std'     => 'TRUE',
			'choices' => array(
				'TRUE' => esc_attr__('true','lmm'),
				'FALSE' => esc_attr__('false','lmm')
			)
		);
		$this->settings['wms_wms9_version'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections10',
			'title'    => esc_attr__('Version','lmm'),
			'desc'    => esc_attr__('Version of the WMS service to use','lmm'),
			'type'    => 'text',
			'std'     => '1.3.0' 
		);	
		$this->settings['wms_wms9_attribution'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections10',
			'title'    => esc_attr__('Attribution','lmm'),
			'desc'    => '',
			'type'    => 'text',
			'std'     => 'WMS: <a href=&quot;http://www.eea.europa.eu/code/gis&quot; target=&quot;_blank&quot;>European Environment Agency</a>' 
		);		
		$this->settings['wms_wms9_legend_enabled'] = array(
			'version' => '1.1',
			'pane'    => 'wms',
			'section' => 'wms-sections10',
			'title'   => esc_attr__('Display legend?','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'yes',
			'choices' => array(
				'yes' => esc_attr__('Yes','lmm'),
				'no' => esc_attr__('No','lmm')
			)
		);		
		$this->settings['wms_wms9_legend'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections10',
			'title'    => esc_attr__('Legend','lmm'),
			'desc'    => esc_attr__('URL of image which gets show when hovering the text "(Legend)" next to WMS attribution text','lmm'),
			'type'    => 'text',
			'std'     => 'http://discomap.eea.europa.eu/ArcGIS/services/Bio/CDDA_Dyna_WGS84/MapServer/WMSServer?request=GetLegendGraphic%26version=1.3.0%26format=image/png%26layer=0'			
		);		
		$this->settings['wms_wms9_subdomains_enabled'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections10',
			'title'   => esc_attr__('Support for subdomains?','lmm'),
			'desc'    => esc_attr__('Will replace {s} from base url if available','lmm'),
			'type'    => 'radio',
			'std'     => 'no',
			'choices' => array(
				'no' => esc_attr__('No','lmm'),
				'yes' => esc_attr__('Yes (please enter subdomains in next form field)','lmm')
			)
		);
		$this->settings['wms_wms9_subdomains_names'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections10',
			'title'   => esc_attr__( 'Subdomain names', 'lmm' ),
			'desc'    => esc_attr__('For example','lmm'). ": &quot;subdomain1&quot;, &quot;subdomain2&quot;, &quot;subdomain3&quot;",
			'std'     => '&quot;subdomain1&quot;, &quot;subdomain2&quot;, &quot;subdomain3&quot;',
			'type'    => 'text'
		);	
		$this->settings['wms_wms9_kml_helptext'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections10',
			'std'     => '', 
			'title'   => '<strong>' . esc_attr__('KML settings','lmm') . '</strong>',
			'desc'    => esc_attr__('If the WMS server supports KML output of the WMS layer, the settings below will be used when a marker or layer map with this active WMS layer is exported as KML.','lmm'),
			'type'    => 'helptext'
		);
		$this->settings['wms_wms9_kml_support'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections10',
			'title'   => esc_attr__('Does the WMS server support KML output?','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'yes',
			'choices' => array(
				'yes' => esc_attr__('yes','lmm'),
				'no' => esc_attr__('no','lmm')
			)
		);	
		$this->settings['wms_wms9_kml_href'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections10',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#href" target="_blank">href</a>',
			'desc'    => esc_attr__('http-address of the KML-webservice of the WMS layer','lmm'),
			'type'    => 'text',
			'std'     => 'http://discomap.eea.europa.eu/ArcGIS/rest/services/Bio/CDDA_Dyna_WGS84/MapServer/generatekml?docName=&l%3A2=on&layers=2&layerOptions=nonComposite' 
		);	
		$this->settings['wms_wms9_kml_refreshMode'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections10',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#refreshmode" target="_blank">refreshMode</a>',
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'onChange',
			'choices' => array(
				'onChange' => esc_attr__('onChange (refresh when the file is loaded and whenever the Link parameters change)','lmm'),
				'onInterval' => esc_attr__('onInterval (refresh every n seconds (specified in refreshInterval)','lmm'),
				'onExpire' => esc_attr__('onExpire (refresh the file when the expiration time is reached)','lmm'),
				'onStop' => esc_attr__('onStop (after camera movement stops)','lmm')
			)
		);	
		$this->settings['wms_wms9_kml_refreshInterval'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections10',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#refreshinterval" target="_blank">refreshInterval</a>',
			'desc'    => esc_attr__('Indicates to refresh the file every n seconds','lmm'),
			'type'    => 'text',
			'std'     => '30' 
		);		
		$this->settings['wms_wms9_kml_viewRefreshMode'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections10',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#viewrefreshmode" target="_blank">viewrefreshMode</a>',
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'never',
			'choices' => array(
				'never' => esc_attr__('never (ignore changes in the view)','lmm'),
				'onStop' => esc_attr__('onStop (refresh the file n seconds after movement stops, where n is specified in viewRefreshTime)','lmm'),
				'onRequest' => esc_attr__('onRequest (refresh the file only when the user explicitly requests it)','lmm')
			)
		);			
		$this->settings['wms_wms9_kml_viewRefreshTime'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections10',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#viewrefreshtime" target="_blank">viewRefreshTime</a>',
			'desc'    => esc_attr__('After camera movement stops, specifies the number of seconds to wait before refreshing the view (is used when viewRefreshMode is set to onStop)','lmm'),
			'type'    => 'text',
			'std'     => '1' 
		);
		/*
		* WMS layer 10 settings
		*/
		$this->settings['wms_wms10_helptext'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections11',
			'std'     => '', 
			'title'   => '',
			'desc'    => '', //empty for not breaking settings layout
			'type'    => 'helptext'
		);
		$this->settings['wms_wms10_name'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections11',
			'title'    => esc_attr__('Name','lmm'),
			'desc'    => '',
			'type'    => 'text',
			'std'     => '<a href=&quot;http://discomap.eea.europa.eu/ArcGIS/rest/services/Noise/Noise_Dyna_LAEA/MapServer&quot; target=&quot;_blank&quot;>EEA - Road noise Austria</a>' 
		);
		$this->settings['wms_wms10_baseurl'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections11',
			'title'    => esc_attr__('baseURL','lmm'),
			'desc'    => '',
			'type'    => 'text',
			'std'     => 'http://discomap.eea.europa.eu/ArcGIS/services/Noise/Noise_Dyna_LAEA/MapServer/WMSServer' 
		);
		$this->settings['wms_wms10_layers'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections11',
			'title'    => esc_attr__('Layers','lmm'),
			'desc'    => esc_attr__('(required) Comma-separated list of WMS layers to show','lmm'),
			'type'    => 'text',
			'std'     => '247' 
		);
		$this->settings['wms_wms10_styles'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections11',
			'title'    => esc_attr__('Styles','lmm'),
			'desc'    => esc_attr__('Comma-separated list of WMS styles','lmm'),
			'type'    => 'text',
			'std'     => '' 
		);
		$this->settings['wms_wms10_format'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections11',
			'title'    => esc_attr__('Format','lmm'),
			'desc'    => '',
			'type'    => 'text',
			'std'     => 'image/png' 
		);		
		$this->settings['wms_wms10_transparent'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections11',
			'title'   => esc_attr__('Transparent','lmm'),
			'desc'    => esc_attr__('If yes, the WMS service will return images with transparency','lmm'),
			'type'    => 'radio',
			'std'     => 'TRUE',
			'choices' => array(
				'TRUE' => esc_attr__('true','lmm'),
				'FALSE' => esc_attr__('false','lmm')
			)
		);
		$this->settings['wms_wms10_version'] = array(

			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections11',
			'title'    => esc_attr__('Version','lmm'),
			'desc'    => esc_attr__('Version of the WMS service to use','lmm'),
			'type'    => 'text',
			'std'     => '1.3.0' 
		);	
		$this->settings['wms_wms10_attribution'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections11',
			'title'    => esc_attr__('Attribution','lmm'),
			'desc'    => '',
			'type'    => 'text',
			'std'     => 'WMS: <a href=&quot;http://www.eea.europa.eu/code/gis&quot; target=&quot;_blank&quot;>European Environment Agency</a>' 
		);		
		$this->settings['wms_wms10_legend_enabled'] = array(
			'version' => '1.1',
			'pane'    => 'wms',
			'section' => 'wms-sections11',
			'title'   => esc_attr__('Display legend?','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'yes',
			'choices' => array(
				'yes' => esc_attr__('Yes','lmm'),
				'no' => esc_attr__('No','lmm')
			)
		);		
		$this->settings['wms_wms10_legend'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections11',
			'title'    => esc_attr__('Legend','lmm'),
			'desc'    => esc_attr__('URL of image which gets show when hovering the text "(Legend)" next to WMS attribution text','lmm'),
			'type'    => 'text',
			'std'     => 'http://discomap.eea.europa.eu/ArcGIS/services/Noise/Noise_Dyna_LAEA/MapServer/WMSServer?request=GetLegendGraphic%26version=1.3.0%26format=image/png%26layer=247'			
		);		
		$this->settings['wms_wms10_subdomains_enabled'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections11',
			'title'   => esc_attr__('Support for subdomains?','lmm'),
			'desc'    => esc_attr__('Will replace {s} from base url if available','lmm'),
			'type'    => 'radio',
			'std'     => 'no',
			'choices' => array(
				'no' => esc_attr__('No','lmm'),
				'yes' => esc_attr__('Yes (please enter subdomains in next form field)','lmm')
			)
		);
		$this->settings['wms_wms10_subdomains_names'] = array(
			'version' => '1.0',
			'pane'    => 'wms',
			'section' => 'wms-sections11',
			'title'   => esc_attr__( 'Subdomain names', 'lmm' ),
			'desc'    => esc_attr__('For example','lmm'). ": &quot;subdomain1&quot;, &quot;subdomain2&quot;, &quot;subdomain3&quot;",
			'std'     => '&quot;subdomain1&quot;, &quot;subdomain2&quot;, &quot;subdomain3&quot;',
			'type'    => 'text'
		);											
		$this->settings['wms_wms10_kml_helptext'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections11',
			'std'     => '', 
			'title'   => '<strong>' . esc_attr__('KML settings','lmm') . '</strong>',
			'desc'    => esc_attr__('If the WMS server supports KML output of the WMS layer, the settings below will be used when a marker or layer map with this active WMS layer is exported as KML.','lmm'),
			'type'    => 'helptext'
		);
		$this->settings['wms_wms10_kml_support'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections11',
			'title'   => esc_attr__('Does the WMS server support KML output?','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'yes',
			'choices' => array(
				'yes' => esc_attr__('yes','lmm'),
				'no' => esc_attr__('no','lmm')
			)
		);	
		$this->settings['wms_wms10_kml_href'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections11',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#href" target="_blank">href</a>',
			'desc'    => esc_attr__('http-address of the KML-webservice of the WMS layer','lmm'),
			'type'    => 'text',
			'std'     => 'http://discomap.eea.europa.eu/ArcGIS/rest/services/Noise/Noise_Dyna_LAEA/MapServer/generatekml?docName=&l%3A222=on&layers=222&layerOptions=nonComposite' 
		);	
		$this->settings['wms_wms10_kml_refreshMode'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections11',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#refreshmode" target="_blank">refreshMode</a>',
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'onChange',
			'choices' => array(
				'onChange' => esc_attr__('onChange (refresh when the file is loaded and whenever the Link parameters change)','lmm'),
				'onInterval' => esc_attr__('onInterval (refresh every n seconds (specified in refreshInterval)','lmm'),
				'onExpire' => esc_attr__('onExpire (refresh the file when the expiration time is reached)','lmm'),
				'onStop' => esc_attr__('onStop (after camera movement stops)','lmm')
			)
		);	
		$this->settings['wms_wms10_kml_refreshInterval'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections11',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#refreshinterval" target="_blank">refreshInterval</a>',
			'desc'    => esc_attr__('Indicates to refresh the file every n seconds','lmm'),
			'type'    => 'text',
			'std'     => '30' 
		);		
		$this->settings['wms_wms10_kml_viewRefreshMode'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections11',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#viewrefreshmode" target="_blank">viewrefreshMode</a>',
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'never',
			'choices' => array(
				'never' => esc_attr__('never (ignore changes in the view)','lmm'),
				'onStop' => esc_attr__('onStop (refresh the file n seconds after movement stops, where n is specified in viewRefreshTime)','lmm'),
				'onRequest' => esc_attr__('onRequest (refresh the file only when the user explicitly requests it)','lmm')
			)
		);			
		$this->settings['wms_wms10_kml_viewRefreshTime'] = array(
			'version' => '1.4.3',
			'pane'    => 'wms',
			'section' => 'wms-sections11',
			'title'   => '<a href="http://code.google.com/apis/kml/documentation/kmlreference.html#viewrefreshtime" target="_blank">viewRefreshTime</a>',
			'desc'    => esc_attr__('After camera movement stops, specifies the number of seconds to wait before refreshing the view (is used when viewRefreshMode is set to onStop)','lmm'),
			'type'    => 'text',
			'std'     => '1' 
		);
	
		/*===========================================
		*
		*
		* pane Google
		*
		*
		===========================================*/	
		/*
		* Google Maps API Key
		*/
		$this->settings['google_maps_api_key_helptext'] = array(
			'version' => '2.6',
			'pane'    => 'google',
			'section' => 'google-section1',
			'std'     => '', 
			'title'   => '',
			'desc'    => esc_attr__( 'The usage of Google Maps is free for non-commercial users. Since 01/2012, commercial users have a current usage limit of 25.000 free requests a day - with additional usage cost of 0.5$/1000 requests. In order to comply with the <a href="https://developers.google.com/maps/faq" target="_blank">Google Maps terms of services</a>, commercial users have to <a href="https://developers.google.com/maps/documentation/javascript/tutorial#api_key">register for a free API key</a>. This API key can also be used by non-commercial users in order to monitor their Google Maps API usage.', 'lmm'),
			'type'    => 'helptext'
		);
		$this->settings['google_maps_api_key'] = array(
			'version' => '2.6',
			'pane'    => 'google',
			'section' => 'google-section1',
			'title'   => esc_attr__( 'Google Maps API key', 'lmm'),
			'desc'    => esc_attr__( 'Please enter your Google Maps API key here', 'lmm' ),
			'std'     => '',
			'type'    => 'text'
		);
		/*
		* Google language localization
		* https://spreadsheets.google.com/spreadsheet/pub?key=0Ah0xU81penP1cDlwZHdzYWkyaERNc0xrWHNvTTA1S1E&gid=1
		*/
		$this->settings['google_maps_language_localization_helptext'] = array(
			'version' => '2.7.1',
			'pane'    => 'google',
			'section' => 'google-section2',
			'std'     => '', 
			'title'   => '',
			'desc'    => esc_attr__( 'Language used when displaying textual information such as the names for controls, copyright notices, driving directions and labels on Google maps, direction links and autocomplete for address search.', 'lmm'),
			'type'    => 'helptext'
		);
		$this->settings['google_maps_language_localization'] = array(
			'version' => '2.7.1',
			'pane'    => 'google',
			'section' => 'google-section2',
			'title'   => esc_attr__('Default language','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'browser_setting',
			'choices' => array(
				'browser_setting' => esc_attr__('automatic 1 (distinct language for each user - detects the users browser language setting, preferred method by Google)','lmm'),
				'wordpress_setting' => sprintf(esc_attr__('automatic 2 (same language for each user - uses the first two letters from the constant WPLANG defined in wp-config.php = %s)','lmm'),substr(WPLANG,0,2)),
				'ar' => esc_attr__('Arabic','lmm') . ' (' . esc_attr__('language code','lmm') . ': ar)',
				'bg' => esc_attr__('Bulgarian','lmm') . ' (' . esc_attr__('language code','lmm') . ': bg)',
				'ca' => esc_attr__('Catalan','lmm') . ' (' . esc_attr__('language code','lmm') . ': ca)',
				'cs' => esc_attr__('Czech','lmm') . ' (' . esc_attr__('language code','lmm') . ': cs)',
				'da' => esc_attr__('Danish','lmm') . ' (' . esc_attr__('language code','lmm') . ': da)',
				'de' => esc_attr__('German','lmm') . ' (' . esc_attr__('language code','lmm') . ': de)',
				'el' => esc_attr__('Greek','lmm') . ' (' . esc_attr__('language code','lmm') . ': el)',
				'en' => esc_attr__('English','lmm') . ' (' . esc_attr__('language code','lmm') . ': en)',
				'en-AU' => esc_attr__('English (Australian)','lmm') . ' (' . esc_attr__('language code','lmm') . ': en-AU)',
				'en-GB' => esc_attr__('English (Great Britain)','lmm') . ' (' . esc_attr__('language code','lmm') . ': en-GB)',
				'es' => esc_attr__('Spanish','lmm') . ' (' . esc_attr__('language code','lmm') . ': es)',
				'eu' => esc_attr__('Basque','lmm') . ' (' . esc_attr__('language code','lmm') . ': eu)',
				'fa' => esc_attr__('Farsi','lmm') . ' (' . esc_attr__('language code','lmm') . ': fa)',
				'fi' => esc_attr__('Finnish','lmm') . ' (' . esc_attr__('language code','lmm') . ': fi)',
				'fil' => esc_attr__('Filipino','lmm') . ' (' . esc_attr__('language code','lmm') . ': fil)',
				'fr' => esc_attr__('French','lmm') . ' (' . esc_attr__('language code','lmm') . ': fr)',
				'gl' => esc_attr__('Galician','lmm') . ' (' . esc_attr__('language code','lmm') . ': gl)',
				'gu' => esc_attr__('Gujarati','lmm') . ' (' . esc_attr__('language code','lmm') . ': gu)',
				'hi' => esc_attr__('Hindi','lmm') . ' (' . esc_attr__('language code','lmm') . ': hi)',
				'hr' => esc_attr__('Croatian','lmm') . ' (' . esc_attr__('language code','lmm') . ': hr)',
				'hu' => esc_attr__('Hungarian','lmm') . ' (' . esc_attr__('language code','lmm') . ': hu)',
				'id' => esc_attr__('Indonesian','lmm') . ' (' . esc_attr__('language code','lmm') . ': id)',
				'it' => esc_attr__('Italian','lmm') . ' (' . esc_attr__('language code','lmm') . ': it)',
				'iw' => esc_attr__('Hebrew','lmm') . ' (' . esc_attr__('language code','lmm') . ': iw)',
				'ja' => esc_attr__('Japanese','lmm') . ' (' . esc_attr__('language code','lmm') . ': ja)',
				'kn' => esc_attr__('Kannada','lmm') . ' (' . esc_attr__('language code','lmm') . ': kn)',
				'ko' => esc_attr__('Korean','lmm') . ' (' . esc_attr__('language code','lmm') . ': ko)',
				'lt' => esc_attr__('Lithuanian','lmm') . ' (' . esc_attr__('language code','lmm') . ': lt)',
				'lv' => esc_attr__('Latvian','lmm') . ' (' . esc_attr__('language code','lmm') . ': lv)',
				'ml' => esc_attr__('Malayalam','lmm') . ' (' . esc_attr__('language code','lmm') . ': ml)',
				'mr' => esc_attr__('Marathi','lmm') . ' (' . esc_attr__('language code','lmm') . ': mr)',
				'nl' => esc_attr__('Dutch','lmm') . ' (' . esc_attr__('language code','lmm') . ': nl)',
				'no' => esc_attr__('Norwegian','lmm') . ' (' . esc_attr__('language code','lmm') . ': no)',
				'pl' => esc_attr__('Polish','lmm') . ' (' . esc_attr__('language code','lmm') . ': pl)',
				'pt' => esc_attr__('Portuguese','lmm') . ' (' . esc_attr__('language code','lmm') . ': pt)',
				'pt-BR' => esc_attr__('Portuguese (Brazil)','lmm') . ' (' . esc_attr__('language code','lmm') . ': pt-BR)',
				'pt-PT' => esc_attr__('Portuguese (Portugal)','lmm') . ' (' . esc_attr__('language code','lmm') . ': pt-PT)',
				'ro' => esc_attr__('Romanian','lmm') . ' (' . esc_attr__('language code','lmm') . ': ro)',
				'ru' => esc_attr__('Russian','lmm') . ' (' . esc_attr__('language code','lmm') . ': ru)',
				'sk' => esc_attr__('Slovak','lmm') . ' (' . esc_attr__('language code','lmm') . ': sk)',
				'sl' => esc_attr__('Slovenian','lmm') . ' (' . esc_attr__('language code','lmm') . ': sl)',
				'sr' => esc_attr__('Serbian','lmm') . ' (' . esc_attr__('language code','lmm') . ': sr)',
				'sv' => esc_attr__('Swedish','lmm') . ' (' . esc_attr__('language code','lmm') . ': sv)',
				'tl' => esc_attr__('Tagalog','lmm') . ' (' . esc_attr__('language code','lmm') . ': tl)',
				'ta' => esc_attr__('Tamil','lmm') . ' (' . esc_attr__('language code','lmm') . ': ta)',
				'te' => esc_attr__('Telugu','lmm') . ' (' . esc_attr__('language code','lmm') . ': te)',
				'th' => esc_attr__('Thai','lmm') . ' (' . esc_attr__('language code','lmm') . ': th)',
				'uk' => esc_attr__('Ukrainian','lmm') . ' (' . esc_attr__('language code','lmm') . ': uk)',
				'vi' => esc_attr__('Vietnamese','lmm') . ' (' . esc_attr__('language code','lmm') . ': vi)',
				'zh-CN' => esc_attr__('Chinese (simplified)','lmm') . ' (' . esc_attr__('language code','lmm') . ': zh-CN)',
				'zh-TW' => esc_attr__('Chinese (traditional)','lmm') . ' (' . esc_attr__('language code','lmm') . ': zh-TW)',
			)
		);
		/*
		* Google Maps base domain
		*/
		$this->settings['google_maps_base_domain_helptext'] = array(
			'version' => '2.7.1',
			'pane'    => 'google',
			'section' => 'google-section3',
			'std'     => '', 
			'title'   => '',
			'desc'    => esc_attr__( 'The base domain from which to load the Google Maps API (used for geocoding for example). If you want to change the language of the Google Maps interface (buttons etc) only, please change the option "Google language localization" above.', 'lmm'),
			'type'    => 'helptext'
		);
		$this->settings['google_maps_base_domain'] = array(
			'version' => '2.7.1',
			'pane'    => 'google',
			'section' => 'google-section3',
			'title'   => esc_attr__('Google Maps base domain','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'maps.google.com',
			'choices' => array(
				'maps.google.com' => 'maps.google.com',
				'maps.google.at' => 'maps.google.at',
				'maps.google.com.au' => 'maps.google.com.au',
				'maps.google.com.ba' => 'maps.google.com.ba',
				'maps.google.be' => 'maps.google.be',
				'maps.google.bg' => 'maps.google.bg',
				'maps.google.com.br' => 'maps.google.com.br',
				'maps.google.ca' => 'maps.google.ca',
				'maps.google.ch' => 'maps.google.ch',
				'maps.google.cm' => 'maps.google.cm',
				'ditu.google.cn' => 'ditu.google.cn',
				'maps.google.cz' => 'maps.google.cz',
				'maps.google.de' => 'maps.google.de',
				'maps.google.dk' => 'maps.google.dk',
				'maps.google.es' => 'maps.google.es',
				'maps.google.fi' => 'maps.google.fi',
				'maps.google.fr' => 'maps.google.fr',
				'maps.google.it' => 'maps.google.it',
				'maps.google.lk' => 'maps.google.lk',
				'maps.google.jp' => 'maps.google.jp',
				'maps.google.nl' => 'maps.google.nl',
				'maps.google.no' => 'maps.google.no',
				'maps.google.co.nz' => 'maps.google.co.nz',
				'maps.google.pl' => 'maps.google.pl',
				'maps.google.ru' => 'maps.google.ru',
				'maps.google.se' => 'maps.google.se',
				'maps.google.tw' => 'maps.google.tw',
				'maps.google.co.uk' => 'maps.google.co.uk',
				'maps.google.co.ve' => 'maps.google.co.ve'
			)
		);
		$this->settings['google_maps_base_domain_custom'] = array(
			'version' => '2.7.1',
			'pane'    => 'google',
			'section' => 'google-section3',
			'title'   => esc_attr__( 'Custom base domain', 'lmm'),
			'desc'    => esc_attr__( 'If your localized Google Maps basedomain is not available in the list above, please enter the domain name here (without http://, for example maps.google.com). If a domain name is entered, the setting "Google Maps base domain" from above gets overwritten.', 'lmm' ),
			'std'     => '',
			'type'    => 'text'
		);		
		/*
		* Google Places Bounds
		*/
		$this->settings['google_places_bounds_helptext2'] = array(
			'version' => '1.0',
			'pane'    => 'google',
			'section' => 'google-section4',
			'std'     => '', 
			'title'   => '',
			'desc'    => esc_attr__( 'Leaflet Maps Marker uses the <a href="http://code.google.com/intl/de-AT/apis/maps/documentation/places/autocomplete.html" target="_blank">Google Places Autocomplete API</a> to easily find coordinates for places or addresses. This feature is enabled by default. Preview:', 'lmm') . '<br/><br/><img src="'. LEAFLET_PLUGIN_URL .'inc/img/help-google-places-preview.png" /><br/>' . esc_attr__( 'You can get better search results if you enable the bounds feature. This allows you to specify the area in which to primarily search for places or addresses. Please note: the results are biased towards, but not restricted to places or addresses contained within these bounds.', 'lmm'),
			'type'    => 'helptext'
		);
		$this->settings['google_places_bounds_status'] = array(
			'version' => '1.0',
			'pane'    => 'google',
			'section' => 'google-section4',
			'title'   => esc_attr__('Google Places bounds','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'disabled',
			'choices' => array(
				'disabled' => esc_attr__('disabled','lmm'),
				'enabled' => esc_attr__('enabled','lmm')
			)
		);
		$this->settings['google_places_bounds_helptext3'] = array(
			'version' => '1.0',
			'pane'    => 'google',
			'section' => 'google-section4',
			'std'     => '', 
			'title'   => '',
			'desc'    => esc_attr__( 'If enabled, please enter longitude and latitude values below for the corner points of the prefered search area. Below you find an example for Vienna/Austria:', 'lmm') . '<br/><br/><img src="'. LEAFLET_PLUGIN_URL .'inc/img/help-google-places-bounds.jpg" />',
			'type'    => 'helptext'
		);
		$this->settings['google_places_bounds_lat1'] = array(
			'version' => '1.0',
			'pane'    => 'google',
			'section' => 'google-section4',
			'title'   => esc_attr__( 'Latitude', 'lmm' ) . ' 1',
			'desc'    => esc_attr__( 'Please use a dot instead of a coma as decimal delimiter!', 'lmm' ),
			'std'     => '48.326583',
			'type'    => 'text'
		);
		$this->settings['google_places_bounds_lon1'] = array(
			'version' => '1.0',
			'pane'    => 'google',
			'section' => 'google-section4',
			'title'   => esc_attr__( 'Longitude', 'lmm' ) . ' 1',
			'desc'    => esc_attr__( 'Please use a dot instead of a coma as decimal delimiter!', 'lmm' ),
			'std'     => '16.55056',
			'type'    => 'text'
		);
		$this->settings['google_places_bounds_lat2'] = array(
			'version' => '1.0',
			'pane'    => 'google',
			'section' => 'google-section4',
			'title'   => esc_attr__( 'Latitude', 'lmm' ) . ' 2',
			'desc'    => esc_attr__( 'Please use a dot instead of a coma as decimal delimiter!', 'lmm' ),
			'std'     => '48.114308',
			'type'    => 'text'
		);
		$this->settings['google_places_bounds_lon2'] = array(
			'version' => '1.0',
			'pane'    => 'google',
			'section' => 'google-section4',
			'title'   => esc_attr__( 'Longitude', 'lmm' ) . ' 2',
			'desc'    => esc_attr__( 'Please use a dot instead of a coma as decimal delimiter!', 'lmm' ),
			'std'     => '16.187325',
			'type'    => 'text'
		);		
		/*
		* Google Places Search Prefix
		*/
		$this->settings['google_places_search_prefix_helptext1'] = array(
			'version' => '1.0',
			'pane'    => 'google',
			'section' => 'google-section5',
			'std'     => '', 
			'title'   => '',
			'desc'    => esc_attr__( 'You can also select a search prefix, which automatically gets added to search form when creating a new marker or layer.', 'lmm') . '<br/><br/><img src="'. LEAFLET_PLUGIN_URL .'inc/img/help-google-places-prefix.png" />',
			'type'    => 'helptext'
		);
		$this->settings['google_places_search_prefix_status'] = array(
			'version' => '1.0',
			'pane'    => 'google',
			'section' => 'google-section5',
			'title'   => esc_attr__('Google Places search prefix','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'disabled',
			'choices' => array(
				'disabled' => esc_attr__('disabled','lmm'),
				'enabled' => esc_attr__('enabled','lmm')
			)
		);
		$this->settings['google_places_search_prefix'] = array(
			'version' => '1.0',
			'pane'    => 'google',
			'section' => 'google-section5',
			'title'   => esc_attr__( 'Prefix to use', 'lmm' ),
			'desc'    => '',
			'std'     => 'Wien, ',
			'type'    => 'text'
		);	
		
		/*===========================================
		*
		*
		* pane Bing
		*
		*
		===========================================*/	
		/*
		* Bing Maps API Key
		*/
		$this->settings['bingmaps_api_key_helptext'] = array(
			'version' => '2.6',
			'pane'    => 'bing',
			'section' => 'bing-section1',
			'std'     => '', 
			'title'   => '',
			'desc'    => esc_attr__( 'An API key is required if you want to use Bing Maps as basemap for marker or layer maps. Please click on the question mark for more info on how to get your API key.', 'lmm') . ' <a href="http://www.mapsmarker.com/bing-maps" target="_blank"><img src="' . LEAFLET_PLUGIN_URL . 'inc/img/icon-question-mark.png" width="12" height="12" border="0"/></a>',
			'type'    => 'helptext'
		);		
		$this->settings['bingmaps_api_key'] = array(
			'version' => '2.6',
			'pane'    => 'bing',
			'section' => 'bing-section1',
			'title'   => esc_attr__( 'Bing Maps API key', 'lmm' ),
			'desc'    => '',
			'std'     => '',
			'type'    => 'text'
		);				
		/*
		* Bing culture parameter
		* http://msdn.microsoft.com/en-us/library/hh441729.aspx
		*/
		$this->settings['bingmaps_culture_helptext'] = array(
			'version' => '2.9',
			'pane'    => 'bing',
			'section' => 'bing-section2',
			'std'     => '', 
			'title'   => '',
			'desc'    => esc_attr__( 'The culture parameter allows you to select the language of the culture for geographic entities, place names and map labels on bing map images. For supported cultures, street names are localized to the local culture. For example, if you request a location in France, the street names are localized in French. For other localized data such as country names, the level of localization will vary for each culture. For example, there may not be a localized name for the "United States" for every culture code. See <a href="http://msdn.microsoft.com/en-us/library/hh441729.aspx" target="_blank">this page</a> for more details.', 'lmm'),
			'type'    => 'helptext'
		);
		$this->settings['bingmaps_culture'] = array(
			'version' => '2.9',
			'pane'    => 'bing',
			'section' => 'bing-section2',
			'title'   => esc_attr__('Default culture','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'automatic',
			'choices' => array(
				'automatic' => sprintf(esc_attr__('automatic (uses constant WPLANG defined in wp-config.php = %s - fallback to en_US if not supported by bing)','lmm'),WPLANG),
				'af' => esc_attr__('Afrikaans','lmm') . ' (' . esc_attr__('culture code','lmm') . ': af)',
				'am' => esc_attr__('Amharic','lmm') . ' (' . esc_attr__('culture code','lmm') . ': am)',
				'ar-sa' => esc_attr__('Arabic (Saudi Arabia)','lmm') . ' (' . esc_attr__('culture code','lmm') . ': ar-sa)',
				'as' => esc_attr__('Assamese','lmm') . ' (' . esc_attr__('culture code','lmm') . ': as)',
				'az-Latn' => esc_attr__('Azerbaijani (Latin)','lmm') . ' (' . esc_attr__('culture code','lmm') . ': az-Latn)',
				'be' => esc_attr__('Belarusian','lmm') . ' (' . esc_attr__('culture code','lmm') . ': be)',
				'bg' => esc_attr__('Bulgarian','lmm') . ' (' . esc_attr__('culture code','lmm') . ': bg)',
				'bn-BD' => esc_attr__('Bangla (Bangladesh)','lmm') . ' (' . esc_attr__('culture code','lmm') . ': bn-BD)',
				'bn-IN' => esc_attr__('Bangla (India)','lmm') . ' (' . esc_attr__('culture code','lmm') . ': bn-IN)',
				'bs' => esc_attr__('Bosnian (Latin)','lmm') . ' (' . esc_attr__('culture code','lmm') . ': bs)',
				'ca' => esc_attr__('Catalan Spanish','lmm') . ' (' . esc_attr__('culture code','lmm') . ': ca)',
				'ca-ES-valencia' => esc_attr__('Valencian','lmm') . ' (' . esc_attr__('culture code','lmm') . ': ca-ES-valencia)',
				'cs' => esc_attr__('Czech','lmm') . ' (' . esc_attr__('culture code','lmm') . ': cs)',
				'cy' => esc_attr__('Welsh','lmm') . ' (' . esc_attr__('culture code','lmm') . ': cy)',
				'da' => esc_attr__('Danish','lmm') . ' (' . esc_attr__('culture code','lmm') . ': da)',
				'de' => esc_attr__('German (Germany)','lmm') . ' (' . esc_attr__('culture code','lmm') . ': de)',
				'de-de' => esc_attr__('German (Germany)','lmm') . ' (' . esc_attr__('culture code','lmm') . ': de-de)',
				'el' => esc_attr__('Greek','lmm') . ' (' . esc_attr__('culture code','lmm') . ': el)',
				'en-GB' => esc_attr__('English (United Kingdom)','lmm') . ' (' . esc_attr__('culture code','lmm') . ': en-GB)',
				'en-US' => esc_attr__('English (United States)','lmm') . ' (' . esc_attr__('culture code','lmm') . ': en-US)',
				'es' => esc_attr__('Spanish (Spain)','lmm') . ' (' . esc_attr__('culture code','lmm') . ': es)',
				'es-ES' => esc_attr__('Spanish (Spain)','lmm') . ' (' . esc_attr__('culture code','lmm') . ': es-ES)',
				'es-US' => esc_attr__('Spanish (United States)','lmm') . ' (' . esc_attr__('culture code','lmm') . ': es-US)',
				'es-MX' => esc_attr__('Spanish (Mexico)','lmm') . ' (' . esc_attr__('culture code','lmm') . ': es-MX)',
				'et' => esc_attr__('Estonian','lmm') . ' (' . esc_attr__('culture code','lmm') . ': et)',
				'eu' => esc_attr__('Basque','lmm') . ' (' . esc_attr__('culture code','lmm') . ': eu)',
				'fa' => esc_attr__('Persian','lmm') . ' (' . esc_attr__('culture code','lmm') . ': fa)',
				'fi' => esc_attr__('Finnish','lmm') . ' (' . esc_attr__('culture code','lmm') . ': fi)',
				'fil-Latn' => esc_attr__('Filipino','lmm') . ' (' . esc_attr__('culture code','lmm') . ': fil-Latn)',
				'fr' => esc_attr__('French (France)','lmm') . ' (' . esc_attr__('culture code','lmm') . ': fr)',
				'fr-FR' => esc_attr__('French (France)','lmm') . ' (' . esc_attr__('culture code','lmm') . ': fr-FR)',
				'fr-CA' => esc_attr__('French (Canada)','lmm') . ' (' . esc_attr__('culture code','lmm') . ': fr-CA)',
				'ga' => esc_attr__('Irish','lmm') . ' (' . esc_attr__('culture code','lmm') . ': ga)',
				'gd-Latn' => esc_attr__('Scottish Gaelic','lmm') . ' (' . esc_attr__('culture code','lmm') . ': gd-Latn)',
				'gl' => esc_attr__('Galician','lmm') . ' (' . esc_attr__('culture code','lmm') . ': gl)',
				'gu' => esc_attr__('Gujarati','lmm') . ' (' . esc_attr__('culture code','lmm') . ': gu)',
				'ha-Latn' => esc_attr__('Hausa (Latin)','lmm') . ' (' . esc_attr__('culture code','lmm') . ': ha-Latn)',
				'he' => esc_attr__('Hebrew','lmm') . ' (' . esc_attr__('culture code','lmm') . ': he)',
				'hi' => esc_attr__('Hindi','lmm') . ' (' . esc_attr__('culture code','lmm') . ': hi)',
				'hr' => esc_attr__('Croatian','lmm') . ' (' . esc_attr__('culture code','lmm') . ': hr)',
				'hu' => esc_attr__('Hungarian','lmm') . ' (' . esc_attr__('culture code','lmm') . ': hu)',
				'hy' => esc_attr__('Armenian','lmm') . ' (' . esc_attr__('culture code','lmm') . ': hy)',
				'id' => esc_attr__('Indonesian','lmm') . ' (' . esc_attr__('culture code','lmm') . ': id)',
				'ig-Latn' => esc_attr__('Igbo','lmm') . ' (' . esc_attr__('culture code','lmm') . ': ig-Latn)',
				'is' => esc_attr__('Icelandic','lmm') . ' (' . esc_attr__('culture code','lmm') . ': )',
				'it' => esc_attr__('Italian (Italy)','lmm') . ' (' . esc_attr__('culture code','lmm') . ': it)',
				'it-it' => esc_attr__('Italian (Italy)','lmm') . ' (' . esc_attr__('culture code','lmm') . ': it-it)',
				'ja' => esc_attr__('Japanese','lmm') . ' (' . esc_attr__('culture code','lmm') . ': ja)',
				'ka' => esc_attr__('Georgian','lmm') . ' (' . esc_attr__('culture code','lmm') . ': ka)',
				'kk' => esc_attr__('Kazakh','lmm') . ' (' . esc_attr__('culture code','lmm') . ': kk)',
				'km' => esc_attr__('Khmer','lmm') . ' (' . esc_attr__('culture code','lmm') . ': km)',
				'kn' => esc_attr__('Kannada','lmm') . ' (' . esc_attr__('culture code','lmm') . ': kn)',
				'ko' => esc_attr__('Korean','lmm') . ' (' . esc_attr__('culture code','lmm') . ': ko)',
				'kok' => esc_attr__('Konkani','lmm') . ' (' . esc_attr__('culture code','lmm') . ': kok)',
				'ku-Arab' => esc_attr__('Central Curdish','lmm') . ' (' . esc_attr__('culture code','lmm') . ': ku-Arab)',
				'ky-Cyrl' => esc_attr__('Kyrgyz','lmm') . ' (' . esc_attr__('culture code','lmm') . ': ky-Cyrl)',
				'lb' => esc_attr__('Luxembourgish','lmm') . ' (' . esc_attr__('culture code','lmm') . ': lb)',
				'lt' => esc_attr__('Lithuanian','lmm') . ' (' . esc_attr__('culture code','lmm') . ': lt)',
				'lv' => esc_attr__('Latvian','lmm') . ' (' . esc_attr__('culture code','lmm') . ': lv)',
				'mi-Latn' => esc_attr__('Maori','lmm') . ' (' . esc_attr__('culture code','lmm') . ': mi-Latn)',
				'mk' => esc_attr__('Macedonian','lmm') . ' (' . esc_attr__('culture code','lmm') . ': mk)',
				'ml' => esc_attr__('Malayalam','lmm') . ' (' . esc_attr__('culture code','lmm') . ': ml)',
				'mn-Cyrl' => esc_attr__('Mongolian (Cyrillic)','lmm') . ' (' . esc_attr__('culture code','lmm') . ': mn-Cyrl)',
				'mr' => esc_attr__('Marathi','lmm') . ' (' . esc_attr__('culture code','lmm') . ': mr)',
				'ms' => esc_attr__('Malay (Malaysia)','lmm') . ' (' . esc_attr__('culture code','lmm') . ': ms)',
				'mt' => esc_attr__('Maltese','lmm') . ' (' . esc_attr__('culture code','lmm') . ': mt)',
				'nb' => esc_attr__('Norwegian (Bokmal)','lmm') . ' (' . esc_attr__('culture code','lmm') . ': nb)',
				'ne' => esc_attr__('Nepali (Nepal)','lmm') . ' (' . esc_attr__('culture code','lmm') . ': ne)',
				'nl' => esc_attr__('Dutch (Netherlands)','lmm') . ' (' . esc_attr__('culture code','lmm') . ': nl)',
				'nl-BE' => esc_attr__('Dutch (Netherlands)','lmm') . ' (' . esc_attr__('culture code','lmm') . ': nl-BE)',
				'nn' => esc_attr__('Norwegian (Nynorsk)','lmm') . ' (' . esc_attr__('culture code','lmm') . ': nn)',
				'nso' => esc_attr__('Sesotho sa Leboa','lmm') . ' (' . esc_attr__('culture code','lmm') . ': nso)',
				'or' => esc_attr__('Odia','lmm') . ' (' . esc_attr__('culture code','lmm') . ': or)',
				'pa' => esc_attr__('Punjabi (Gurmukhi)','lmm') . ' (' . esc_attr__('culture code','lmm') . ': pa)',
				'pa-Arab' => esc_attr__('Punjabi (Arabic)','lmm') . ' (' . esc_attr__('culture code','lmm') . ': pa-Arab)',
				'pl' => esc_attr__('Polish','lmm') . ' (' . esc_attr__('culture code','lmm') . ': pl)',
				'prs-Arab' => esc_attr__('Dari','lmm') . ' (' . esc_attr__('culture code','lmm') . ': prs-Arab)',
				'pt-BR' => esc_attr__('Portuguese (Brazil)','lmm') . ' (' . esc_attr__('culture code','lmm') . ': pt-BR)',
				'pt-PT' => esc_attr__('Portuguese (Portugal)','lmm') . ' (' . esc_attr__('culture code','lmm') . ': pt-PT)',
				'qut-Latn' => esc_attr__('Kiche','lmm') . ' (' . esc_attr__('culture code','lmm') . ': qut-Latn)',
				'quz' => esc_attr__('Quechua (Peru)','lmm') . ' (' . esc_attr__('culture code','lmm') . ': quz)',
				'ro' => esc_attr__('Romanian (Romania)','lmm') . ' (' . esc_attr__('culture code','lmm') . ': ro)',
				'ru' => esc_attr__('Russian','lmm') . ' (' . esc_attr__('culture code','lmm') . ': ru)',
				'rw' => esc_attr__('Kinyarwanda','lmm') . ' (' . esc_attr__('culture code','lmm') . ': rw)',
				'sd-Arab' => esc_attr__('Sindhi (Arabic)','lmm') . ' (' . esc_attr__('culture code','lmm') . ': sd-Arab)',
				'si' => esc_attr__('Sinhala','lmm') . ' (' . esc_attr__('culture code','lmm') . ': si)',
				'sk' => esc_attr__('Slovak','lmm') . ' (' . esc_attr__('culture code','lmm') . ': sk)',
				'sl' => esc_attr__('Slovenian','lmm') . ' (' . esc_attr__('culture code','lmm') . ': sl)',
				'sq' => esc_attr__('Albanian','lmm') . ' (' . esc_attr__('culture code','lmm') . ': sq)',
				'sr-Cyrl-BA' => esc_attr__('Serbian (Cyrillic, Bosnia and Herzegovina)','lmm') . ' (' . esc_attr__('culture code','lmm') . ': sr-Cyrl-BA)',
				'sr-Cyrl-RS' => esc_attr__('Serbian (Cyrillic, Serbia)','lmm') . ' (' . esc_attr__('culture code','lmm') . ': sr-Cyrl-RS)',
				'sr-Latn-RS' => esc_attr__('Serbian (Latin, Serbia)','lmm') . ' (' . esc_attr__('culture code','lmm') . ': sr-Latn-RS)',
				'sv' => esc_attr__('Swedish (Sweden)','lmm') . ' (' . esc_attr__('culture code','lmm') . ': sv)',
				'sw' => esc_attr__('Kiswahili','lmm') . ' (' . esc_attr__('culture code','lmm') . ': sw)',
				'ta' => esc_attr__('Tamil','lmm') . ' (' . esc_attr__('culture code','lmm') . ': ta)',
				'te' => esc_attr__('Telugu','lmm') . ' (' . esc_attr__('culture code','lmm') . ': te)',
				'tg-Cyrl' => esc_attr__('Tajik (Cyrillic)','lmm') . ' (' . esc_attr__('culture code','lmm') . ': tg-Cyrl)',
				'th' => esc_attr__('Thai','lmm') . ' (' . esc_attr__('culture code','lmm') . ': th)',
				'ti' => esc_attr__('Tigrinya','lmm') . ' (' . esc_attr__('culture code','lmm') . ': ti)',
				'tk-Latn' => esc_attr__('Turkmen (Latin)','lmm') . ' (' . esc_attr__('culture code','lmm') . ': tk-Latn)',
				'tn' => esc_attr__('Setswana','lmm') . ' (' . esc_attr__('culture code','lmm') . ': tn)',
				'tr' => esc_attr__('Turkish','lmm') . ' (' . esc_attr__('culture code','lmm') . ': tr)',
				'tt-Cyrl' => esc_attr__('Tatar (Cyrillic)','lmm') . ' (' . esc_attr__('culture code','lmm') . ': tt-Cyrl)',
				'ug-Arab' => esc_attr__('Uyghur','lmm') . ' (' . esc_attr__('culture code','lmm') . ': ug-Arab)',
				'uk' => esc_attr__('Ukrainian','lmm') . ' (' . esc_attr__('culture code','lmm') . ': uk)',
				'ur' => esc_attr__('Urdu','lmm') . ' (' . esc_attr__('culture code','lmm') . ': ur)',
				'uz-Latn' => esc_attr__('Uzbek (Latin)','lmm') . ' (' . esc_attr__('culture code','lmm') . ': uz-Latn)',
				'vi' => esc_attr__('Vietnamese','lmm') . ' (' . esc_attr__('culture code','lmm') . ': vi)',
				'wo' => esc_attr__('Wolof','lmm') . ' (' . esc_attr__('culture code','lmm') . ': wo)',
				'xh' => esc_attr__('isiXhosa','lmm') . ' (' . esc_attr__('culture code','lmm') . ': xh)',
				'yo-Latn' => esc_attr__('Yoruba','lmm') . ' (' . esc_attr__('culture code','lmm') . ': yo-Latn)',
				'zh-Hans' => esc_attr__('Chinese (Simplified)','lmm') . ' (' . esc_attr__('culture code','lmm') . ': zh-Hans)',
				'zh-Hant' => esc_attr__('Chinese (Traditional)','lmm') . ' (' . esc_attr__('culture code','lmm') . ': zh-Hant)',
				'zu' => esc_attr__('isiZulu','lmm') . ' (' . esc_attr__('culture code','lmm') . ': zu)'
			)
		);		
		/*===========================================
		*
		*
		* pane Directions
		*
		*
		===========================================*/	
		/*
		* Directions General
		*/
		$this->settings['directions_general_helptext1'] = array(
			'version' => '1.4',
			'pane'    => 'directions',
			'section' => 'directions-section1',
			'std'     => '', 
			'title'   => '',
			'desc'    => esc_attr__( 'Please select your prefered directions provider. This setting will be used for the directions link in the panel on top of marker maps and for the action panel which gets attached to the popup text on each marker if enabled.', 'lmm'),
			'type'    => 'helptext'
		);
		$this->settings['directions_provider'] = array(
			'version' => '1.4',
			'pane'    => 'directions',
			'section' => 'directions-section1',
			'title'   => esc_attr__('Use the following directions provider','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'googlemaps',
			'choices' => array(
				'googlemaps' => esc_attr__('Google Maps (worldwide)','lmm') . ' - <a href="http://maps.google.com/maps?saddr=Vienna&daddr=Linz&hl=de&sll=37.0625,-95.677068&sspn=59.986788,135.263672&geocode=FS6Z3wIdO9j5ACmfyjZRngdtRzFGW6JRiuXC_Q%3BFfwa4QIdBvzZAClNhZn6lZVzRzHEdXlXLClTfA&vpsrc=0&mra=ls&t=m&z=9&layer=t" style="text-decoration:none;" target="_blank">Demo</a>',
				'yours' => esc_attr__('yournavigation.org (based on OpenStreetMap, worldwide)','lmm') . ' - <a href="http://www.yournavigation.org/?flat=52.215636&flon=6.963946&tlat=52.2573&tlon=6.1799&v=motorcar&fast=1&layer=mapnik" style="text-decoration:none;" target="_blank">Demo</a>',
				'osrm' => esc_attr__('map.project-osrm.org (based on OpenStreetMap, worldwide)','lmm') . ' - <a href="http://map.project-osrm.org/?hl=en&loc=48.242330,16.433030&loc=48.219069,16.380959" style="text-decoration:none;" target="_blank">Demo</a>',
				'ors' => esc_attr__('openrouteservice.org (based on OpenStreetMap, Europe only)','lmm') . ' - <a href="http://openrouteservice.org/index.php?start=7.0892567,50.7265543&end=7.0986258,50.7323634&lat=50.72905&lon=7.09574&zoom=15&pref=Fastest&lang=de" style="text-decoration:none;" target="_blank">Demo</a>'
			)
		);	
		$this->settings['directions_popuptext_panel'] = array(
			'version' => '1.4',
			'pane'    => 'directions',
			'section' => 'directions-section1',
			'title'   => esc_attr__('Attach directions panel to popup text on each marker','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'yes',
			'choices' => array(
				'yes' => esc_attr__('yes','lmm'),
				'no' => esc_attr__('no','lmm')			)
		);			
		$this->settings['directions_general_helptext2'] = array(
			'version' => '1.4',
			'pane'    => 'directions',
			'section' => 'directions-section1',
			'std'     => '', 
			'title'   => '',	
			'desc'    => '<img src="'. LEAFLET_PLUGIN_URL .'inc/img/help-directions-popuptext-panel.jpg" />',
			'type'    => 'helptext'
		);
		/*
		* Google Maps
		*/
		$this->settings['directions_googlemaps_helptext1'] = array(
			'version' => '1.4',
			'pane'    => 'directions',
			'section' => 'directions-section2',
			'title'   => '',
			'desc'    => '',
			'type'    => 'helptext',
			'std'     => ''
		);			
		$this->settings['directions_googlemaps_map_type'] = array(
			'version' => '1.4',
			'pane'    => 'directions',
			'section' => 'directions-section2',
			'title'   => esc_attr__('Map type','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'm',
			'choices' => array(
				'm' => esc_attr__('Map','lmm'),
				'k' => esc_attr__('Satellite','lmm'),
				'h' => esc_attr__('Hybrid','lmm'),
				'p' => esc_attr__('Terrain','lmm')							
			)
		);	
		$this->settings['directions_googlemaps_traffic'] = array(
			'version' => '1.4',
			'pane'    => 'directions',
			'section' => 'directions-section2',
			'title'   => esc_attr__('Show traffic layer?','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => '1',
			'choices' => array(
				'1' => esc_attr__('yes','lmm'),
				'0' => esc_attr__('no','lmm')
			)
		);	
		$this->settings['directions_googlemaps_distance_units'] = array(
			'version' => '1.4',
			'pane'    => 'directions',
			'section' => 'directions-section2',
			'title'   => esc_attr__('Distance units','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'ptk',
			'choices' => array(
				'ptk' => esc_attr__('metric (km)','lmm'),
				'ptm' => esc_attr__('imperial (miles)','lmm')							
			)
		);		
		$this->settings['directions_googlemaps_route_type_highways'] = array(
			'version' => '1.0',
			'pane'    => 'directions',
			'section' => 'directions-section2',
			'title'    => esc_attr__('Route type','lmm'),
			'desc'    => esc_attr__('Avoid highways','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);				
		$this->settings['directions_googlemaps_route_type_tolls'] = array(
			'version' => '1.0',
			'pane'    => 'directions',
			'section' => 'directions-section2',
			'title'    => '',
			'desc'    => esc_attr__('Avoid tolls','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['directions_googlemaps_route_type_public_transport'] = array(
			'version' => '1.0',
			'pane'    => 'directions',
			'section' => 'directions-section2',
			'title'    => '',
			'desc'    => esc_attr__('Public transport (works only in some areas)','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['directions_googlemaps_route_type_walking'] = array(
			'version' => '1.0',
			'pane'    => 'directions',
			'section' => 'directions-section2',
			'title'    => '',
			'desc'    => esc_attr__('Walking directions','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);					
		$this->settings['directions_googlemaps_overview_map'] = array(
			'version' => '1.4',
			'pane'    => 'directions',
			'section' => 'directions-section2',
			'title'   => esc_attr__('Overview map','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => '0',
			'choices' => array(
				'0' => esc_attr__('hidden','lmm'),
				'1' => esc_attr__('visible','lmm')
			)
		);			
		
		/*
		* yournavigation.org
		*/
		$this->settings['directions_yours_helptext1'] = array(
			'version' => '1.4',
			'pane'    => 'directions',
			'section' => 'directions-section3',
			'std'     => '', 
			'title'   => '',
			'desc'    => '',
			'type'    => 'helptext'
		);		
		$this->settings['directions_yours_type_of_transport'] = array(
			'version' => '1.4',
			'pane'    => 'directions',
			'section' => 'directions-section3',
			'title'   => esc_attr__('Type of transport','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'motorcar',
			'choices' => array(
				'motorcar' => esc_attr__('Motorcar','lmm'),
				'bicycle' => esc_attr__('Bicycle','lmm'),
				'foot' => esc_attr__('Foot','lmm')
			)
		);		
		$this->settings['directions_yours_route_type'] = array(
			'version' => '1.4',
			'pane'    => 'directions',
			'section' => 'directions-section3',
			'title'   => esc_attr__('Route type','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => '1',
			'choices' => array(
				'0' => esc_attr__('fastest route','lmm'),
				'1' => esc_attr__('shortest route','lmm')
			)
		);		
		$this->settings['directions_yours_layer'] = array(
			'version' => '1.4',
			'pane'    => 'directions',
			'section' => 'directions-section3',
			'title'   => esc_attr__('Gosmore instance to calculate the route','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'mapnik',
			'choices' => array(
				'mapnik' => esc_attr__('mapnik (for normal routing using car, bicycle or foot)','lmm'),
				'cn' => esc_attr__('cn (for using bicycle routing using cycle route networks only)','lmm')
			)
		);		
		/*
		* map.project-osrm.org
		*/
		$this->settings['directions_osrm_helptext1'] = array(
			'version' => '2.7.1',
			'pane'    => 'directions',
			'section' => 'directions-section4',
			'title'   => '',
			'desc'    => '',
			'type'    => 'helptext',
			'std'     => ''
		);			
		$this->settings['directions_osrm_language'] = array(
			'version' => '2.7.1',
			'pane'    => 'directions',
			'section' => 'directions-section4',
			'title'   => esc_attr__('Language of route instructions','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'en',
			'choices' => array(
				'en' => esc_attr__('English','lmm'),
				'de' => esc_attr__('German','lmm'),
				'dk' => esc_attr__('Danish','lmm'),
				'es' => esc_attr__('Spanish','lmm'),
				'fi' => esc_attr__('Finnish','lmm'),
				'fr' => esc_attr__('French','lmm'),
				'it' => esc_attr__('Italian','lmm'),
				'lv' => esc_attr__('Latvian','lmm'),
				'pl' => esc_attr__('Polish','lmm'),
				'ru' => esc_attr__('Russian','lmm')								
			)
		);	
		$this->settings['directions_osrm_units'] = array(
			'version' => '2.7.1',
			'pane'    => 'directions',
			'section' => 'directions-section4',
			'title'   => esc_attr__('Units','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => '0',
			'choices' => array(
				'0' => esc_attr__('metric (kilometer)','lmm'),
				'1' => esc_attr__('imperial (miles)','lmm')
			)
		);
		/*
		* openrouteservice.org
		*/
		$this->settings['directions_ors_helptext1'] = array(
			'version' => '1.4',
			'pane'    => 'directions',
			'section' => 'directions-section5',
			'std'     => '', 
			'title'   => '',
			'desc'    => '',
			'type'    => 'helptext'
		);			
		$this->settings['directions_ors_route_preferences'] = array(
			'version' => '1.4',
			'pane'    => 'directions',
			'section' => 'directions-section5',
			'title'   => esc_attr__('Route preferences','lmm'),
			'desc'    => '',
			'type'    => 'radio',

			'std'     => 'Shortest',
			'choices' => array(
				'Fastest' => esc_attr__('fastest route','lmm'),
				'Shortest' => esc_attr__('shortest route','lmm'),
				'Pedestrian' => esc_attr__('route for pedestrians','lmm'),
				'Bicycle' => esc_attr__('route for bicycles','lmm')								
			)
		);	
		$this->settings['directions_ors_language'] = array(
			'version' => '1.4',
			'pane'    => 'directions',
			'section' => 'directions-section5',
			'title'   => esc_attr__('Language of route instructions','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'en',
			'choices' => array(
				'en' => esc_attr__('English','lmm'),
				'de' => esc_attr__('German','lmm'),
				'it' => esc_attr__('Italian','lmm'),
				'fr' => esc_attr__('French','lmm'),
				'es' => esc_attr__('Spanish','lmm')
			)
		);	
		$this->settings['directions_ors_no_motorways'] = array(
			'version' => '1.4',
			'pane'    => 'directions',
			'section' => 'directions-section5',
			'title'   => esc_attr__('No motorways?','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'false',
			'choices' => array(
				'false' => esc_attr__('false','lmm'),
				'true' => esc_attr__('true','lmm')
			)
		);	
		$this->settings['directions_ors_no_tollways'] = array(
			'version' => '1.4',
			'pane'    => 'directions',
			'section' => 'directions-section5',
			'title'   => esc_attr__('No tollways?','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'false',
			'choices' => array(
				'false' => esc_attr__('false','lmm'),
				'true' => esc_attr__('true','lmm')							
			)
		);		
		/*===========================================
		*
		*
		* pane Augmented-Reality
		*
		*
		===========================================*/	
		/*
		* AR General
		*/
		$this->settings['ar_general_helptext1'] = array(
			'version' => '1.0',
			'pane'    => 'ar',
			'section' => 'ar-section1',
			'std'     => '', 
			'title'   => '',
			'desc'    => esc_attr__( 'Markers created with Leaflet Maps Marker can also be displayed via <a href="http://en.wikipedia.org/wiki/Augmented_reality" target="_blank">Augmented-Reality technology</a> on mobile devices. As a first steps, an API to <a href="http://www.wikitude.com" target="_blank">Wikitude</a> has been implemented. APIs to other Augmented-Reality-Providers (like <a href="http://www.layar.com" target="_blank">Layar</a> or <a href="http://www.junaio.de" target="_blank">Junaio</a>) will probably follow in one of the next versions. Sample screenshots:', 'lmm') . '<br/><br/><img src="'. LEAFLET_PLUGIN_URL .'/screenshot-6.jpg" />',
			'type'    => 'helptext'
		);
		/*
		* AR Wikitude
		*/
		$this->settings['ar_wikitude_helptext'] = array(
			'version' => '1.0',
			'pane'    => 'ar',
			'section' => 'ar-section1',
			'std'     => '', 
			'title'   => '',
			'desc'    => esc_attr__( 'Please visit <a href="http://www.mapsmarker.com/wikitude" target="_blank">http://www.mapsmarker.com/wikitude</a> for instructions how to submit your marker or layer maps to Wikitude.', 'lmm'),
			'type'    => 'helptext'
		);
		$this->settings['ar_wikitude_provider_name'] = array(
			'version' => '1.0',
			'pane'    => 'ar',
			'section' => 'ar-section1',
			'title'   => esc_attr__( 'Provider name', 'lmm' ),
			'desc'    => '<strong>' . esc_attr__( 'Identifies the content provider or content channel, no spaces/special characters', 'lmm' ) . '</strong>',
			'std'     => 'www_mapsmarker_com',
			'type'    => 'text'
		);
		$this->settings['ar_wikitude_provider_url'] = array(
			'version' => '1.0',
			'pane'    => 'ar',
			'section' => 'ar-section1',
			'title'   => esc_attr__( 'Provider URL', 'lmm' ),
			'desc'    => esc_attr__( 'Link to content provider', 'lmm' ),
			'std'     => 'http://www.mapsmarker.com',
			'type'    => 'text'
		);
		$this->settings['ar_wikitude_logo'] = array(
			'version' => '1.0',
			'pane'    => 'ar',
			'section' => 'ar-section1',
			'title'   => esc_attr__( 'Logo', 'lmm' ),
			'desc'    => esc_attr__( 'The logo is displayed on the left bottom corner on Wikitude when an icon is selected - 96x96 pixel, transparent PNG', 'lmm' ),
			'std'     => LEAFLET_PLUGIN_URL . 'inc/img/wikitude-logo-96x96.png',
			'type'    => 'text'
		);
		$this->settings['ar_wikitude_icon'] = array(
			'version' => '1.0',
			'pane'    => 'ar',
			'section' => 'ar-section1',
			'title'   => esc_attr__( 'Icon', 'lmm' ),
			'desc'    => esc_attr__( 'The icon is displayed in the cam view of Wikitude to indicate a marker - 32x32 pixel, transparent PNG', 'lmm' ),
			'std'     => LEAFLET_PLUGIN_URL . 'inc/img/wikitude-icon-32x32.png',
			'type'    => 'text'
		);		
		$this->settings['ar_wikitude_email'] = array(
			'version' => '1.0',
			'pane'    => 'ar',
			'section' => 'ar-section1',
			'title'   => esc_attr__( 'E-Mail', 'lmm' ),
			'desc'    => esc_attr__( 'Optional: displayed on each marker; used for sending an email directly from Wikitude', 'lmm' ),
			'std'     => '',
			'type'    => 'text'
		);		
		$this->settings['ar_wikitude_phone'] = array(
			'version' => '1.0',
			'pane'    => 'ar',
			'section' => 'ar-section1',
			'title'   => esc_attr__( 'Phone', 'lmm' ),
			'desc'    => esc_attr__( 'Optional: example: +4312345 - when a phone number is given, Wikitude displays a "call me" button in the bubble; used for every marker.', 'lmm' ),
			'std'     => '',
			'type'    => 'text'
		);		
		$this->settings['ar_wikitude_attachment'] = array(
			'version' => '1.0',
			'pane'    => 'ar',
			'section' => 'ar-section1',
			'title'   => esc_attr__( 'Attachment', 'lmm' ),
			'desc'    => esc_attr__( 'Optional: displayed on each marker; can be a link to a resource (image, PDF file...). You could use this to issue coupons or vouchers for potential clients that found you via Wikitude.', 'lmm' ),
			'std'     => '',
			'type'    => 'text'
		);		
		$this->settings['ar_wikitude_radius'] = array(
			'version' => '1.0',
			'pane'    => 'ar',
			'section' => 'ar-section1',
			'title'   => esc_attr__( 'Search radius (in meter)', 'lmm' ),
			'desc'    => esc_attr__( 'Retrieve POIs (Points of Interests) from database within this search radius in meters from the current location of the Wikitude user', 'lmm' ),
			'std'     => '100000',
			'type'    => 'text'
		);		
		$this->settings['ar_wikitude_maxnumberpois'] = array(
			'version' => '1.0',
			'pane'    => 'ar',
			'section' => 'ar-section1',
			'title'   => esc_attr__( 'Maximum number of POIs', 'lmm' ),
			'desc'    => esc_attr__( 'Used if Wikitude does not pass the variable maxNumberofPois - 50 is the maximum recommended', 'lmm' ),
			'std'     => '50',
			'type'    => 'text'
		);		
		
		/*===========================================
		*
		*
		* pane miscellaneous
		*
		*
		===========================================*/
		$this->settings['misc_general_helptext'] = array(
			'version' => '1.0',
			'pane'    => 'misc',
			'section' => 'misc-section1',
			'std'     => '', 
			'title'   => '',
			'desc'    => '', //empty for not breaking settings layout
			'type'    => 'helptext'
		);
		$this->settings['capabilities_edit'] = array(
			'version' => '1.0',
			'pane'    => 'misc',
			'section' => 'misc-section1',
			'title'   => esc_attr__( 'User role needed for adding and editing markers/layers', 'lmm' ),
			'desc'    => esc_attr__( 'Note: the settings and tools pages are always visible to admins only.', 'lmm' ),
			'type'    => 'radio',
			'std'     => 'edit_posts',
			'choices' => array(
				'activate_plugins' => esc_attr__('Administrator (Capability activate_plugins)', 'lmm'),
				'moderate_comments' => esc_attr__('Editor (Capability moderate_comments)', 'lmm'),
				'edit_published_posts' => esc_attr__('Author (Capability edit_published_posts)', 'lmm'),
				'edit_posts' => esc_attr__('Contributor (Capability edit_posts)', 'lmm'),
				'read' => esc_attr__('Subscriber (Capability read)', 'lmm')				
			)
		);
		$this->settings['capabilities_delete'] = array(
			'version' => '1.0',
			'pane'    => 'misc',
			'section' => 'misc-section1',
			'title'   => esc_attr__( 'User role needed for deleting markers/layers', 'lmm' ),
			'desc'    => esc_attr__( 'Note: the settings and tool pages are always visible to admins only.', 'lmm' ),
			'type'    => 'radio',
			'std'     => 'edit_posts',
			'choices' => array(
				'activate_plugins' => esc_attr__('Administrator (Capability activate_plugins)', 'lmm'),
				'moderate_comments' => esc_attr__('Editor (Capability moderate_comments)', 'lmm'),
				'edit_published_posts' => esc_attr__('Author (Capability edit_published_posts)', 'lmm'),
				'edit_posts' => esc_attr__('Contributor (Capability edit_posts)', 'lmm'),
				'read' => esc_attr__('Subscriber (Capability read)', 'lmm')		
			)
		);
		$this->settings['markers_per_page'] = array(
			'version' => '1.0',
			'pane'    => 'misc',
			'section' => 'misc-section1',
			'title'   => esc_attr__( 'Markers per page', 'lmm' ),
			'desc'    => esc_attr__( 'How many markers should be listed on one page at the page "list all markers"?', 'lmm' ),
			'std'     => '30',
			'type'    => 'text'
		);
		$this->settings['shortcode'] = array(
			'version' => '1.0',
			'pane'    => 'misc',
			'section' => 'misc-section1',
			'title'   => esc_attr__( 'Shortcode', 'lmm' ),
			'desc'    => esc_attr__( 'Shortcode to add markers or layers into articles or pages  - Example: [mapsmarker marker="1"].<br/> Attention: if you change the shortcode after having embedded shortcodes into posts/Pages, the shortcode on these specific articles/pages has to be changed also manually - otherwise these markers/layers will not be show on frontend!', 'lmm' ),
			'std'     => 'mapsmarker',
			'type'    => 'text'
		);
		$this->settings['misc_tinymce_button'] = array(
			'version' => '1.9',
			'pane'    => 'misc',
			'section' => 'misc-section1',
			'title'   => esc_attr__('TinyMCE button','lmm'),
			'desc'    => esc_attr__('if enabled, an "Insert map" button gets added to the TinyMCE toolbar and the media bar on post and page edit screens for easily searching and inserting maps','lmm'),
			'type'    => 'radio',
			'std'     => 'enabled',
			'choices' => array(
				'enabled' => esc_attr__('enabled','lmm'),
				'disabled' => esc_attr__('disabled','lmm')
			)
		);
		$this->settings['misc_add_georss_to_head'] = array(
			'version' => '1.5',
			'pane'    => 'misc',
			'section' => 'misc-section1',
			'title'   => esc_attr__('Add GeoRSS feed to &lt;head&gt;','lmm'),
			'desc'    => esc_attr__('if enabled, a GeoRSS feed for all markers will be added to the &lt;head&gt;-section of the website, allowing users to subscribe to your markers','lmm'),
			'type'    => 'radio',
			'std'     => 'enabled',
			'choices' => array(
				'enabled' => esc_attr__('enabled','lmm'),
				'disabled' => esc_attr__('disabled','lmm')
			)
		);
		$this->settings['admin_bar_integration'] = array(
			'version' => '1.0',
			'pane'    => 'misc',
			'section' => 'misc-section1',
			'title'   => esc_attr__('WordPress Admin Bar integration','lmm'),
			'desc'    => esc_attr__('show or hide drop down menu for Leaflet Maps Marker in Wordpress Admin Bar','lmm'),
			'type'    => 'radio',
			'std'     => 'enabled',
			'choices' => array(
				'enabled' => esc_attr__('enabled','lmm'),
				'disabled' => esc_attr__('disabled','lmm')
			)
		);
		$this->settings['misc_admin_dashboard_widget'] = array(
			'version' => '2.5',
			'pane'    => 'misc',
			'section' => 'misc-section1',
			'title'   => esc_attr__('WordPress admin dashboard widget','lmm'),
			'desc'    => esc_attr__('shows a widget on the admin dashboard which displays latest markers and blog posts from mapsmarker.com','lmm'),
			'type'    => 'radio',
			'std'     => 'enabled',
			'choices' => array(
				'enabled' => esc_attr__('enabled','lmm'),
				'disabled' => esc_attr__('disabled','lmm')
			)
		);
		$this->settings['misc_pointers'] = array(
			'version' => '2.8',
			'pane'    => 'misc',
			'section' => 'misc-section1',
			'title'   => esc_attr__('WordPress Pointers','lmm'),
			'desc'    => esc_attr__('display WordPress pointers on plugin updates','lmm'),
			'type'    => 'radio',
			'std'     => 'enabled',
			'choices' => array(
				'enabled' => esc_attr__('enabled','lmm'),
				'disabled' => esc_attr__('disabled','lmm')
			)
		);
		$this->settings['misc_qrcode_size'] = array(
			'version' => '1.1',
			'pane'    => 'misc',
			'section' => 'misc-section1',
			'title'   => esc_attr__( 'QR code image size', 'lmm' ),
			'desc'    => esc_attr__( 'Width and height in pixel of QR code image for marker/layer standalone fullscreen map links', 'lmm' ),
			'std'     => '150',
			'type'    => 'text'
		);
		$this->settings['misc_projections'] = array(
			'version' => '1.0',
			'pane'    => 'misc',
			'section' => 'misc-section1',
			'title'   => esc_attr__( 'Coordinate Reference System', 'lmm' ),
			'desc'    => esc_attr__( 'Used for created maps - do not change this if you are not sure what it means!', 'lmm'),
			'type'    => 'radio',
			'std'     => 'L.CRS.EPSG3857',
			'choices' => array(
				'L.CRS.EPSG3857' => esc_attr__('EPSG:3857 (Spherical Mercator), used by most of commercial map providers (CloudMade, Google, Yahoo, Bing, etc.)', 'lmm'),
				'L.CRS.EPSG4326' => esc_attr__('EPSG:4326 (Plate Carree), very popular among GIS enthusiasts', 'lmm'),
				'L.CRS.EPSG3395' => esc_attr__('EPSG:4326 (Mercator), used by some map providers.', 'lmm')
			)
		);
		/*
		* Language Settings
		*/
		$this->settings['misc_language_helptext'] = array(
			'version' => '2.4',
			'pane'    => 'misc',
			'section' => 'misc-section2',
			'std'     => '', 
			'title'   => '',
			'desc'    => esc_attr__('The language used on plugin pages on backend and/or on maps on frontend. Please note that the language for Google Services can be set seperately via Settings / tab "Google", section "Google language localization".','lmm'),
			'type'    => 'helptext'
		);
		$this->settings['misc_plugin_language'] = array(
			'version' => '2.4',
			'pane'    => 'misc',
			'section' => 'misc-section2',
			'title'   => esc_attr__('Default language','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'automatic',
			'choices' => array(
				'automatic' => esc_attr__('automatic (use WordPress default)','lmm'),
				'bg_BG' => esc_attr__('Bulgarian','lmm') . ' (bg_BG)',
				'ca' => esc_attr__('Catalan','lmm') . ' (ca)',
				'zh_CN' => esc_attr__('Chinese','lmm') . ' (zh_CN)',
				'nl_NL' => esc_attr__('Dutch','lmm') . ' (nl_NL)',
				'en_US' => esc_attr__('English','lmm') . ' (en_US)',
				'fr_FR' => esc_attr__('French','lmm') . ' (fr_FR)',
				'de_DE' => esc_attr__('German','lmm') . ' (de_DE)',
				'hi_IN' => esc_attr__('Hindi','lmm') . ' (hi_IN)',
				'it_IT' => esc_attr__('Italian','lmm') . ' (it_IT)',
				'ja' => esc_attr__('Japanese','lmm') . ' (ja)',
				'pl_PL' => esc_attr__('Polish','lmm') . ' (pl_PL)',
				'ru_RU' => esc_attr__('Russian','lmm') . ' (ru_RU)',
				'sk_SK' => esc_attr__('Slovak','lmm') . ' (sk_SK)',
				'es_ES' => esc_attr__('Spanish','lmm') . ' (es_ES)',
				'tr_TR' => esc_attr__('Turkish','lmm') . ' (tr_TR)',
				'uk_UK' => esc_attr__('Ukrainian','lmm') . ' (uk_UK)',
				'yi' => esc_attr__('Yiddish','lmm') . ' (yi)'
			)
		);
		$this->settings['misc_plugin_language_area'] = array(
			'version' => '2.4',
			'pane'    => 'misc',
			'section' => 'misc-section2',
			'title'   => esc_attr__('Where to change the default language','lmm'),
			'desc'    => esc_attr__('This setting will only be used when the plugin language is not selected automatically','lmm'),
			'type'    => 'radio',
			'std'     => 'backend',
			'choices' => array(
				'backend' => esc_attr__('WordPress admin area only','lmm'),
				'frontend' => esc_attr__('WordPress frontend only','lmm'),
				'both' => esc_attr__('WordPress admin area and frontend','lmm')
			)
		);		
		/*
		* KML Settings
		*/
		$this->settings['misc_kml_helptext'] = array(
			'version' => '1.8',
			'pane'    => 'misc',
			'section' => 'misc-section3',
			'std'     => '', 
			'title'   => '',
			'desc'    => esc_attr__( 'Choose how marker names should be displayed in KML files', 'lmm') . ' <a href="http://www.mapsmarker.com/kml-names" target="_blank"><img src="' . LEAFLET_PLUGIN_URL . 'inc/img/icon-question-mark.png" width="12" height="12" border="0"/></a>',
			'type'    => 'helptext'
		);
		$this->settings['misc_kml'] = array(
			'version' => '1.8',
			'pane'    => 'misc',
			'section' => 'misc-section3',
			'title'   => esc_attr__( 'Marker names in KML', 'lmm' ),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'show',
			'choices' => array(
				'show' => esc_attr__('show', 'lmm'),
				'hide' => esc_attr__('hide', 'lmm'),
				'popup' => esc_attr__('put in front of popup-text', 'lmm')
			)
		);
		$this->settings['misc_kml_helptext2'] = array(
			'version' => '1.8',
			'pane'    => 'misc',
			'section' => 'misc-section3',
			'std'     => '', 
			'title'   => '',
			'desc'    => '<div style="height:80px;"></div>',
			'type'    => 'helptext'
		);
		
		/*
		* Available columns for marker listing page
		*/
		$this->settings['misc_marker_listing_columns_helptext'] = array(
			'version' => '1.0',
			'pane'    => 'misc',
			'section' => 'misc-section4',
			'std'     => '', 
			'title'   => '',
			'desc'    => esc_attr__( 'Please select the columns which should be available on the page "List all markers"', 'lmm'),
			'type'    => 'helptext'
		);
		$this->settings['misc_marker_listing_columns_id'] = array(
			'version' => '1.0',
			'pane'    => 'misc',
			'section' => 'misc-section4',
			'title'    => esc_attr__('Columns to show','lmm'),
			'desc'    => 'ID',
			'type'    => 'checkbox-readonly',
			'std'     => 1 
		);
		$this->settings['misc_marker_listing_columns_icon'] = array(
			'version' => '1.0',
			'pane'    => 'misc',
			'section' => 'misc-section4',
			'title'    => '',
			'desc'    => esc_attr__('Icon','lmm'),
			'type'    => 'checkbox-readonly',
			'std'     => 1 
		);
		$this->settings['misc_marker_listing_columns_markername'] = array(
			'version' => '1.0',
			'pane'    => 'misc',
			'section' => 'misc-section4',
			'title'    => '',
			'desc'    => esc_attr__('Marker name','lmm'),
			'type'    => 'checkbox-readonly',
			'std'     => 1 
		);
		$this->settings['misc_marker_listing_columns_popuptext'] = array(
			'version' => '1.0',
			'pane'    => 'misc',
			'section' => 'misc-section4',
			'title'    => '',
			'desc'    => esc_attr__('Popup text','lmm'),
			'type'    => 'checkbox',
			'std'     => 1 
		);	
		$this->settings['misc_marker_listing_columns_layername'] = array(
			'version' => '2.7.1',
			'pane'    => 'misc',
			'section' => 'misc-section4',
			'title'    => '',
			'desc'    => esc_attr__('Layer name','lmm') . ' ' . esc_attr__('(for marker listings below multi-layer maps only)','lmm'),
			'type'    => 'checkbox',
			'std'     => 1 
		);			
		$this->settings['misc_marker_listing_columns_basemap'] = array(
			'version' => '1.0',
			'pane'    => 'misc',
			'section' => 'misc-section4',
			'title'    => '',
			'desc'    => esc_attr__('Basemap','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['misc_marker_listing_columns_layer'] = array(
			'version' => '1.0',
			'pane'    => 'misc',
			'section' => 'misc-section4',
			'title'    => '',
			'desc'    => esc_attr__('Layer','lmm'),
			'type'    => 'checkbox',
			'std'     => 1 
		);	
		$this->settings['misc_marker_listing_columns_coordinates'] = array(
			'version' => '1.0',
			'pane'    => 'misc',
			'section' => 'misc-section4',
			'title'    => '',
			'desc'    => esc_attr__('Coordinates','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['misc_marker_listing_columns_zoom'] = array(
			'version' => '1.0',
			'pane'    => 'misc',
			'section' => 'misc-section4',
			'title'    => '',
			'desc'    => esc_attr__('Zoom','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['misc_marker_listing_columns_openpopup'] = array(
			'version' => '1.0',
			'pane'    => 'misc',
			'section' => 'misc-section4',
			'title'    => '',
			'desc'    => esc_attr__('Popup status','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['misc_marker_listing_columns_panelstatus'] = array(
			'version' => '1.4',
			'pane'    => 'misc',
			'section' => 'misc-section4',
			'title'    => '',
			'desc'    => esc_attr__('Panel status','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['misc_marker_listing_columns_mapsize'] = array(
			'version' => '1.0',
			'pane'    => 'misc',
			'section' => 'misc-section4',
			'title'    => '',
			'desc'    => esc_attr__('Map size','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['misc_marker_listing_columns_createdby'] = array(
			'version' => '1.0',
			'pane'    => 'misc',
			'section' => 'misc-section4',
			'title'    => '',
			'desc'    => esc_attr__('Created by','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['misc_marker_listing_columns_createdon'] = array(
			'version' => '1.0',
			'pane'    => 'misc',
			'section' => 'misc-section4',
			'title'    => '',
			'desc'    => esc_attr__('Created on','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['misc_marker_listing_columns_updatedby'] = array(
			'version' => '1.0',
			'pane'    => 'misc',
			'section' => 'misc-section4',
			'title'    => '',
			'desc'    => esc_attr__('Updated by','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['misc_marker_listing_columns_updatedon'] = array(
			'version' => '1.0',
			'pane'    => 'misc',
			'section' => 'misc-section4',
			'title'    => '',
			'desc'    => esc_attr__('Updated on','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['misc_marker_listing_columns_controlbox'] = array(
			'version' => '1.0',
			'pane'    => 'misc',
			'section' => 'misc-section4',
			'title'    => '',
			'desc'    => esc_attr__('Controlbox status','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);
		$this->settings['misc_marker_listing_columns_shortcode'] = array(
			'version' => '1.0',
			'pane'    => 'misc',
			'section' => 'misc-section4',
			'title'    => '',
			'desc'    => esc_attr__('Shortcode','lmm'),
			'type'    => 'checkbox',
			'std'     => 1 
		);	
		$this->settings['misc_marker_listing_columns_kml'] = array(
			'version' => '1.0',
			'pane'    => 'misc',
			'section' => 'misc-section4',
			'title'    => '',
			'desc'    => 'KML',
			'type'    => 'checkbox',
			'std'     => 1 
		);	
		$this->settings['misc_marker_listing_columns_fullscreen'] = array(
			'version' => '1.1',
			'pane'    => 'misc',
			'section' => 'misc-section4',
			'title'    => '',
			'desc'    => esc_attr__('Fullscreen','lmm'),
			'type'    => 'checkbox',
			'std'     => 1 
		);	
		$this->settings['misc_marker_listing_columns_qr_code'] = array(
			'version' => '1.1',
			'pane'    => 'misc',
			'section' => 'misc-section4',
			'title'    => '',
			'desc'    => esc_attr__('QR code','lmm'),
			'type'    => 'checkbox',
			'std'     => 1 
		);	
		$this->settings['misc_marker_listing_columns_geojson'] = array(
			'version' => '1.0',
			'pane'    => 'misc',
			'section' => 'misc-section4',
			'title'    => '',
			'desc'    => 'GeoJSON',
			'type'    => 'checkbox',
			'std'     => 1 
		);	
		$this->settings['misc_marker_listing_columns_georss'] = array(
			'version' => '1.2',
			'pane'    => 'misc',
			'section' => 'misc-section4',
			'title'    => '',
			'desc'    => 'GeoRSS',
			'type'    => 'checkbox',
			'std'     => 1 
		);	
		$this->settings['misc_marker_listing_columns_wikitude'] = array(
			'version' => '1.0',
			'pane'    => 'misc',
			'section' => 'misc-section4',
			'title'    => '',
			'desc'    => 'Wikitude',
			'type'    => 'checkbox',
			'std'     => 1 
		);		
		/*
		* Sort order for marker listing page
		*/
		$this->settings['misc_marker_listing_sort_helptext'] = array(
			'version' => '2.3',
			'pane'    => 'misc',
			'section' => 'misc-section5',
			'std'     => '', 
			'title'   => '',
			'desc'    => esc_attr__( 'Please select order by and sort order for "List all markers" page', 'lmm'),
			'type'    => 'helptext'
		);
		$this->settings['misc_marker_listing_sort_order_by'] = array(
			'version' => '2.3',
			'pane'    => 'misc',
			'section' => 'misc-section5',
			'title'   => esc_attr__('Order list of markers by','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'm.id',
			'choices' => array(
				'm.id' => 'ID',
				'm.markername' => esc_attr__('marker name','lmm'),
				'm.layer' => esc_attr__('assigned layer','lmm') . '(ID)',
				'm.createdon' => esc_attr__('created on','lmm'),
				'm.createdby' => esc_attr__('created by','lmm'),
				'm.updatedon' => esc_attr__('updated on','lmm'),
				'm.updatedby' => esc_attr__('updated by','lmm')
			)
		);
		$this->settings['misc_marker_listing_sort_sort_order'] = array(
			'version' => '2.3',
			'pane'    => 'misc',
			'section' => 'misc-section5',
			'title'   => esc_attr__('Sort order','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'ASC',
			'choices' => array(
				'ASC' => esc_attr__('ascending','lmm'),
				'DESC' => esc_attr__('descending','lmm')
			)
		);
		$this->settings['misc_marker_listing_sort_helptext2'] = array(
			'version' => '2.3',
			'pane'    => 'misc',
			'section' => 'misc-section5',
			'std'     => '', 
			'title'   => '',
			'desc'    => '<div style="height:0px;"></div>',
			'type'    => 'helptext'
		);		
		/*
		* Available columns for layer listing page
		*/
		$this->settings['misc_layer_listing_columns_helptext'] = array(
			'version' => '1.0',
			'pane'    => 'misc',
			'section' => 'misc-section6',
			'std'     => '', 
			'title'   => '',
			'desc'    => esc_attr__( 'Please select the columns which should be available on the page "List all layers"', 'lmm'),
			'type'    => 'helptext'
		);
		$this->settings['misc_layer_listing_columns_id'] = array(
			'version' => '1.0',
			'pane'    => 'misc',
			'section' => 'misc-section6',
			'title'    => esc_attr__('Columns to show','lmm'),
			'desc'    => 'ID',
			'type'    => 'checkbox-readonly',
			'std'     => 1 
		);
		$this->settings['misc_layer_listing_columns_type'] = array(
			'version' => '1.7',
			'pane'    => 'misc',
			'section' => 'misc-section6',
			'title'    => '',
			'desc'    => esc_attr__('Type','lmm'),
			'type'    => 'checkbox-readonly',
			'std'     => 1 
		);		
		$this->settings['misc_layer_listing_columns_layername'] = array(
			'version' => '1.0',
			'pane'    => 'misc',
			'section' => 'misc-section6',
			'title'    => '',
			'desc'    => esc_attr__('Layer name','lmm'),
			'type'    => 'checkbox-readonly',
			'std'     => 1 
		);
		$this->settings['misc_layer_listing_columns_markercount'] = array(
			'version' => '1.0',
			'pane'    => 'misc',
			'section' => 'misc-section6',
			'title'    => '',
			'desc'    => esc_attr__('Number of markers','lmm'),
			'type'    => 'checkbox-readonly',
			'std'     => 1 
		);		
		$this->settings['misc_layer_listing_columns_basemap'] = array(
			'version' => '1.0',
			'pane'    => 'misc',
			'section' => 'misc-section6',
			'title'    => '',
			'desc'    => esc_attr__('Basemap','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['misc_layer_listing_columns_layercenter'] = array(
			'version' => '1.0',
			'pane'    => 'misc',
			'section' => 'misc-section6',
			'title'    => '',
			'desc'    => esc_attr__('Layer center','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['misc_layer_listing_columns_zoom'] = array(
			'version' => '1.0',
			'pane'    => 'misc',
			'section' => 'misc-section6',
			'title'    => '',
			'desc'    => esc_attr__('Zoom','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['misc_layer_listing_columns_mapsize'] = array(
			'version' => '1.0',
			'pane'    => 'misc',
			'section' => 'misc-section6',
			'title'    => '',
			'desc'    => esc_attr__('Map size','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['misc_layer_listing_columns_panelstatus'] = array(
			'version' => '1.4',
			'pane'    => 'misc',
			'section' => 'misc-section6',
			'title'    => '',
			'desc'    => esc_attr__('Panel status','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['misc_layer_listing_columns_createdby'] = array(
			'version' => '1.0',
			'pane'    => 'misc',
			'section' => 'misc-section6',
			'title'    => '',
			'desc'    => esc_attr__('Created by','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['misc_layer_listing_columns_createdon'] = array(
			'version' => '1.0',
			'pane'    => 'misc',
			'section' => 'misc-section6',
			'title'    => '',
			'desc'    => esc_attr__('Created on','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['misc_layer_listing_columns_updatedby'] = array(
			'version' => '1.0',
			'pane'    => 'misc',
			'section' => 'misc-section6',
			'title'    => '',
			'desc'    => esc_attr__('Updated by','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['misc_layer_listing_columns_updatedon'] = array(
			'version' => '1.0',
			'pane'    => 'misc',
			'section' => 'misc-section6',
			'title'    => '',
			'desc'    => esc_attr__('Updated on','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);	
		$this->settings['misc_layer_listing_columns_controlbox'] = array(
			'version' => '1.0',
			'pane'    => 'misc',
			'section' => 'misc-section6',
			'title'    => '',
			'desc'    => esc_attr__('Controlbox status','lmm'),
			'type'    => 'checkbox',
			'std'     => 0 
		);
		$this->settings['misc_layer_listing_columns_shortcode'] = array(
			'version' => '1.0',
			'pane'    => 'misc',
			'section' => 'misc-section6',
			'title'    => '',
			'desc'    => esc_attr__('Shortcode','lmm'),
			'type'    => 'checkbox',
			'std'     => 1 
		);	
		$this->settings['misc_layer_listing_columns_kml'] = array(
			'version' => '1.0',
			'pane'    => 'misc',
			'section' => 'misc-section6',
			'title'    => '',
			'desc'    => 'KML',
			'type'    => 'checkbox',
			'std'     => 1 
		);	
		$this->settings['misc_layer_listing_columns_fullscreen'] = array(
			'version' => '1.1',
			'pane'    => 'misc',
			'section' => 'misc-section6',
			'title'    => '',
			'desc'    => esc_attr__('Fullscreen','lmm'),
			'type'    => 'checkbox',
			'std'     => 1 
		);	
		$this->settings['misc_layer_listing_columns_qr_code'] = array(
			'version' => '1.1',
			'pane'    => 'misc',
			'section' => 'misc-section6',
			'title'    => '',
			'desc'    => esc_attr__('QR code','lmm'),
			'type'    => 'checkbox',
			'std'     => 1 
		);	
		$this->settings['misc_layer_listing_columns_geojson'] = array(
			'version' => '1.0',
			'pane'    => 'misc',
			'section' => 'misc-section6',
			'title'    => '',
			'desc'    => 'GeoJSON',
			'type'    => 'checkbox',
			'std'     => 1 
		);	
		$this->settings['misc_layer_listing_columns_georss'] = array(
			'version' => '1.2',
			'pane'    => 'misc',
			'section' => 'misc-section6',
			'title'    => '',
			'desc'    => 'GeoRSS',
			'type'    => 'checkbox',
			'std'     => 1 
		);	
		$this->settings['misc_layer_listing_columns_wikitude'] = array(
			'version' => '1.0',
			'pane'    => 'misc',
			'section' => 'misc-section6',
			'title'    => '',
			'desc'    => 'Wikitude',
			'type'    => 'checkbox',
			'std'     => 1 
		);	
		/*
		* Sort order for layer listing page
		*/
		$this->settings['misc_layer_listing_sort_helptext'] = array(
			'version' => '2.3',
			'pane'    => 'misc',
			'section' => 'misc-section7',
			'std'     => '', 
			'title'   => '',
			'desc'    => esc_attr__( 'Please select order by and sort order for "List all layers" page', 'lmm'),
			'type'    => 'helptext'
		);
		$this->settings['misc_layer_listing_sort_order_by'] = array(
			'version' => '2.3',
			'pane'    => 'misc',
			'section' => 'misc-section7',
			'title'   => esc_attr__('Order list of markers by','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'id',
			'choices' => array(
				'id' => 'ID',
				'name' => esc_attr__('layer name','lmm'),
				'createdon' => esc_attr__('created on','lmm'),
				'createdby' => esc_attr__('created by','lmm'),
				'updatedon' => esc_attr__('updated on','lmm'),
				'updatedby' => esc_attr__('updated by','lmm')
			)
		);
		$this->settings['misc_layer_listing_sort_sort_order'] = array(
			'version' => '2.3',
			'pane'    => 'misc',
			'section' => 'misc-section7',
			'title'   => esc_attr__('Sort order','lmm'),
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'ASC',
			'choices' => array(
				'ASC' => esc_attr__('ascending','lmm'),
				'DESC' => esc_attr__('descending','lmm')
			)
		);		
		$this->settings['misc_layer_listing_sort_helptext2'] = array(
			'version' => '2.3',
			'pane'    => 'misc',
			'section' => 'misc-section7',
			'std'     => '', 
			'title'   => '',
			'desc'    => '<div style="height:0px;"></div>',
			'type'    => 'helptext'
		);
		/*===========================================
		*
		*
		* pane reset
		*
		*
		===========================================*/	
		$this->settings['reset_settings'] = array(
			'version' => '1.0',
			'pane'    => 'reset',
			'section' => 'reset-section1',
			'title'   => esc_attr__('Warning - cannot be undone!','lmm'),
			'type'    => 'checkbox',
			'std'     => 0,
			'class'   => 'warning', // Custom class for CSS
			'desc'    => esc_attr__( 'Check this box and click "Save Changes" below to reset plugin options to their defaults.','lmm' )
		);
	}
	
	/**
	 * Initialize settings to their default values
	 */ 
	public function initialize_settings() {
		$default_settings = array();
		foreach ( $this->settings as $id => $setting ) {
			if ( $setting['type'] != 'heading' && $setting['type'] != 'helptext' ) {
				$default_settings[$id] = $setting['std'];
				}
		}
		update_option( 'leafletmapsmarker_options', $default_settings );
	}
	/**
	* Register settings
	*/
    
	public function register_settings() {
		
		register_setting( 'leafletmapsmarker_options', 'leafletmapsmarker_options', array ( &$this, 'validate_settings' ) );
		
		$this->get_settings();

		    foreach ( $this->settings as $id => $setting ) {
			    $setting['id'] = $id;
			    $this->create_setting( $setting );  // ----setttings
        }
	}   
	/**
	 * save defaults for new options after plugin updates but keep values of old settings
	 */
	public function save_defaults_for_new_options() {
		//info:  set defaults for options introduced in v1.1
		if (get_option('leafletmapsmarker_version') == '1.0' )
		{
			$new_options_defaults = array();
			foreach ( $this->settings as $id => $setting ) 
			{
				if ( $setting['type'] != 'heading' && $setting['type'] != 'helptext' && $setting['version'] == '1.1')
				{
				$new_options_defaults[$id] = $setting['std'];
				}
			}
		$options_current = get_option( 'leafletmapsmarker_options' );
		$options_new = array_merge($options_current, $new_options_defaults);
		update_option( 'leafletmapsmarker_options', $options_new );
		}
		//info:  set defaults for options introduced in v1.2
		if (get_option('leafletmapsmarker_version') == '1.1' )
		{
			$new_options_defaults = array();
			foreach ( $this->settings as $id => $setting ) 
			{
				if ( $setting['type'] != 'heading' && $setting['type'] != 'helptext' && $setting['version'] == '1.2')
				{
				$new_options_defaults[$id] = $setting['std'];
				}
			}
		$options_current = get_option( 'leafletmapsmarker_options' );
		$options_new = array_merge($options_current, $new_options_defaults);
		update_option( 'leafletmapsmarker_options', $options_new );
		}
		//info:  set defaults for options introduced in v1.4
		if (get_option('leafletmapsmarker_version') == '1.3' )
		{
			$new_options_defaults = array();
			foreach ( $this->settings as $id => $setting ) 
			{
				if ( $setting['type'] != 'heading' && $setting['type'] != 'helptext' && $setting['version'] == '1.4')
				{
				$new_options_defaults[$id] = $setting['std'];
				}
			}
		$options_current = get_option( 'leafletmapsmarker_options' );
		$options_new = array_merge($options_current, $new_options_defaults);
		update_option( 'leafletmapsmarker_options', $options_new );
		}
		//info:  set defaults for options introduced in v1.4.3		
		if (get_option('leafletmapsmarker_version') == '1.4.2' )
		{
			$new_options_defaults = array();
			foreach ( $this->settings as $id => $setting ) 
			{
				if ( $setting['type'] != 'heading' && $setting['type'] != 'helptext' && $setting['version'] == '1.4.3')
				{
				$new_options_defaults[$id] = $setting['std'];
				}
			}
		$options_current = get_option( 'leafletmapsmarker_options' );
		$options_new = array_merge($options_current, $new_options_defaults);
		update_option( 'leafletmapsmarker_options', $options_new );
		}
		//info:  set defaults for options introduced in v1.5
		if (get_option('leafletmapsmarker_version') == '1.4.3' )
		{
			$new_options_defaults = array();
			foreach ( $this->settings as $id => $setting ) 
			{
				if ( $setting['type'] != 'heading' && $setting['type'] != 'helptext' && $setting['version'] == '1.5')
				{
				$new_options_defaults[$id] = $setting['std'];
				}
			}
		$options_current = get_option( 'leafletmapsmarker_options' );
		$options_new = array_merge($options_current, $new_options_defaults);
		update_option( 'leafletmapsmarker_options', $options_new );
		}
		//info:  set defaults for options introduced in v1.6
		if (get_option('leafletmapsmarker_version') == '1.5.1' )
		{
			$new_options_defaults = array();
			foreach ( $this->settings as $id => $setting ) 
			{
				if ( $setting['type'] != 'heading' && $setting['type'] != 'helptext' && $setting['version'] == '1.6')
				{
				$new_options_defaults[$id] = $setting['std'];
				}
			}
		$options_current = get_option( 'leafletmapsmarker_options' );
		$options_new = array_merge($options_current, $new_options_defaults);
		update_option( 'leafletmapsmarker_options', $options_new );
		}
		//info:  set defaults for options introduced in v1.7
		if (get_option('leafletmapsmarker_version') == '1.6' )
		{
			$new_options_defaults = array();
			foreach ( $this->settings as $id => $setting ) 
			{
				if ( $setting['type'] != 'heading' && $setting['type'] != 'helptext' && $setting['version'] == '1.7')
				{
				$new_options_defaults[$id] = $setting['std'];
				}
			}
		$options_current = get_option( 'leafletmapsmarker_options' );
		$options_new = array_merge($options_current, $new_options_defaults);
		update_option( 'leafletmapsmarker_options', $options_new );
		}
		//info:  set defaults for options introduced in v1.8
		if (get_option('leafletmapsmarker_version') == '1.7' )
		{
			$new_options_defaults = array();
			foreach ( $this->settings as $id => $setting ) 
			{
				if ( $setting['type'] != 'heading' && $setting['type'] != 'helptext' && $setting['version'] == '1.8')
				{
				$new_options_defaults[$id] = $setting['std'];
				}
			}
		$options_current = get_option( 'leafletmapsmarker_options' );
		$options_new = array_merge($options_current, $new_options_defaults);
		update_option( 'leafletmapsmarker_options', $options_new );
		}
		//info:  set defaults for options introduced in v1.9
		if (get_option('leafletmapsmarker_version') == '1.8' )
		{
			$new_options_defaults = array();
			foreach ( $this->settings as $id => $setting ) 
			{
				if ( $setting['type'] != 'heading' && $setting['type'] != 'helptext' && $setting['version'] == '1.9')
				{
				$new_options_defaults[$id] = $setting['std'];
				}
			}
		$options_current = get_option( 'leafletmapsmarker_options' );
		$options_new = array_merge($options_current, $new_options_defaults);
		update_option( 'leafletmapsmarker_options', $options_new );
		}
		//info:  set defaults for options introduced in v2.1
		if (get_option('leafletmapsmarker_version') == '2.0' )
		{
			$new_options_defaults = array();
			foreach ( $this->settings as $id => $setting ) 
			{
				if ( $setting['type'] != 'heading' && $setting['type'] != 'helptext' && $setting['version'] == '2.1')
				{
				$new_options_defaults[$id] = $setting['std'];
				}
			}
		$options_current = get_option( 'leafletmapsmarker_options' );
		$options_new = array_merge($options_current, $new_options_defaults);
		update_option( 'leafletmapsmarker_options', $options_new );
		}
		//info:  set defaults for options introduced in v2.2
		if (get_option('leafletmapsmarker_version') == '2.1' )
		{
			$new_options_defaults = array();
			foreach ( $this->settings as $id => $setting ) 
			{
				if ( $setting['type'] != 'heading' && $setting['type'] != 'helptext' && $setting['version'] == '2.2')
				{
				$new_options_defaults[$id] = $setting['std'];
				}
			}
		$options_current = get_option( 'leafletmapsmarker_options' );
		$options_new = array_merge($options_current, $new_options_defaults);
		update_option( 'leafletmapsmarker_options', $options_new );
		}
		//info:  set defaults for options introduced in v2.3
		if (get_option('leafletmapsmarker_version') == '2.2' )
		{
			$new_options_defaults = array();
			foreach ( $this->settings as $id => $setting ) 
			{
				if ( $setting['type'] != 'heading' && $setting['type'] != 'helptext' && $setting['version'] == '2.3')
				{
				$new_options_defaults[$id] = $setting['std'];
				}
			}
		$options_current = get_option( 'leafletmapsmarker_options' );
		$options_new = array_merge($options_current, $new_options_defaults);
		update_option( 'leafletmapsmarker_options', $options_new );
		}
		//info:  set defaults for options introduced in v2.4
		if (get_option('leafletmapsmarker_version') == '2.3' )
		{
			$new_options_defaults = array();
			foreach ( $this->settings as $id => $setting ) 
			{
				if ( $setting['type'] != 'heading' && $setting['type'] != 'helptext' && $setting['version'] == '2.4')
				{
				$new_options_defaults[$id] = $setting['std'];
				}
			}
		$options_current = get_option( 'leafletmapsmarker_options' );
		$options_new = array_merge($options_current, $new_options_defaults);
		update_option( 'leafletmapsmarker_options', $options_new );
		}
		//info:  set defaults for options introduced in v2.5
		if (get_option('leafletmapsmarker_version') == '2.4' )
		{
			$new_options_defaults = array();
			foreach ( $this->settings as $id => $setting ) 
			{
				if ( $setting['type'] != 'heading' && $setting['type'] != 'helptext' && $setting['version'] == '2.5')
				{
				$new_options_defaults[$id] = $setting['std'];
				}
			}
		$options_current = get_option( 'leafletmapsmarker_options' );
		$options_new = array_merge($options_current, $new_options_defaults);
		update_option( 'leafletmapsmarker_options', $options_new );
		}
		//info:  set defaults for options introduced in v2.6
		if (get_option('leafletmapsmarker_version') == '2.5' )
		{
			$new_options_defaults = array();
			foreach ( $this->settings as $id => $setting ) 
			{
				if ( $setting['type'] != 'heading' && $setting['type'] != 'helptext' && $setting['version'] == '2.6')
				{
				$new_options_defaults[$id] = $setting['std'];
				}
			}
		$options_current = get_option( 'leafletmapsmarker_options' );
		$options_new = array_merge($options_current, $new_options_defaults);
		update_option( 'leafletmapsmarker_options', $options_new );
		}
		//info:  set defaults for options introduced in v2.7.1
		if (get_option('leafletmapsmarker_version') == '2.7' )
		{
			$new_options_defaults = array();
			foreach ( $this->settings as $id => $setting ) 
			{
				if ( $setting['type'] != 'heading' && $setting['type'] != 'helptext' && $setting['version'] == '2.7.1')
				{
				$new_options_defaults[$id] = $setting['std'];
				}
			}
		$options_current = get_option( 'leafletmapsmarker_options' );
		$options_new = array_merge($options_current, $new_options_defaults);
		update_option( 'leafletmapsmarker_options', $options_new );
		}
		//info:  set defaults for options introduced in v2.8
		if (get_option('leafletmapsmarker_version') == '2.7.1' )
		{
			$new_options_defaults = array();
			foreach ( $this->settings as $id => $setting ) 
			{
				if ( $setting['type'] != 'heading' && $setting['type'] != 'helptext' && $setting['version'] == '2.8')
				{
				$new_options_defaults[$id] = $setting['std'];
				}
			}
		$options_current = get_option( 'leafletmapsmarker_options' );
		$options_new = array_merge($options_current, $new_options_defaults);
		update_option( 'leafletmapsmarker_options', $options_new );
		}
		//info:  set defaults for options introduced in v2.9
		if (get_option('leafletmapsmarker_version') == '2.8.2' )
		{
			$new_options_defaults = array();
			foreach ( $this->settings as $id => $setting ) 
			{
				if ( $setting['type'] != 'heading' && $setting['type'] != 'helptext' && $setting['version'] == '2.9')
				{
				$new_options_defaults[$id] = $setting['std'];
				}
			}
		$options_current = get_option( 'leafletmapsmarker_options' );
		$options_new = array_merge($options_current, $new_options_defaults);
		update_option( 'leafletmapsmarker_options', $options_new );
		}
		/* template for plugin updates 
		//info:  set defaults for options introduced in v3.0
		if (get_option('leafletmapsmarker_version') == '2.9' )
		{
			$new_options_defaults = array();
			foreach ( $this->settings as $id => $setting ) 
			{
				if ( $setting['type'] != 'heading' && $setting['type'] != 'helptext' && $setting['version'] == '3.0')
				{
				$new_options_defaults[$id] = $setting['std'];
				}
			}
		$options_current = get_option( 'leafletmapsmarker_options' );
		$options_new = array_merge($options_current, $new_options_defaults);
		update_option( 'leafletmapsmarker_options', $options_new );
		}
		*/
	}
	
	/**
	* Validate settings
	*/
	public function validate_settings( $input ) {
		
		if ( ! isset( $input['reset_settings'] ) ) {
			$options = get_option( 'leafletmapsmarker_options' );
			
			foreach ( $this->checkboxes as $id ) {
				if ( isset( $options[$id] ) && ! isset( $input[$id] ) )
					unset( $options[$id] );
			}
			return $input;
		}
		return false;
	}
}
$leafletmapsmarker_options = new Class_leaflet_options();
function lmm_option( $option ) {
	$options = get_option( 'leafletmapsmarker_options' );
	if ( isset( $options[$option] ) )
		return $options[$option];
	else
		return false;
}
?>