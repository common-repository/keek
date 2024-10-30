<?php
/*
Plugin Name: Keek
Plugin URI: http://wp-time.com/keek/
Description: One shortcode to embedding keek videos.
Version: 1.4
Author: Qassim Hassan
Author URI: http://qass.im
License: GPLv2 or later
*/

/*  Copyright 2015  Qassim Hassan  (email : qassim.pay@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
// WP Time Page
if( !function_exists('WP_Time_Ghozylab_Aff') ) {
	function WP_Time_Ghozylab_Aff() {
		add_menu_page( 'WP Time', 'WP Time', 'update_core', 'WP_Time_Ghozylab_Aff', 'WP_Time_Ghozylab_Aff_Page');
		function WP_Time_Ghozylab_Aff_Page() {
			?>
            	<div class="wrap">
                	<h2>WP Time</h2>
                    
					<div class="tool-box">
                		<h3 class="title">Thanks for using our plugins!</h3>
                    	<p>For more plugins, please visit <a href="http://wp-time.com" target="_blank">WP Time Website</a> and <a href="https://profiles.wordpress.org/qassimdev/#content-plugins" target="_blank">WP Time profile on WordPress</a>.</p>
                        <p>For contact or support, please visit <a href="http://wp-time.com/contact/" target="_blank">WP Time Contact Page</a>.</p>
					</div>
                    
            	<div class="tool-box">
					<h3 class="title">Recommended Links</h3>
					<p>Get collection of 87 WordPress themes for $69 only, a lot of features and free support! <a href="http://j.mp/ET_WPTime_ref_pl" target="_blank">Get it now</a>.</p>
					<p>See also:</p>
						<ul>
							<li><a href="http://j.mp/GL_WPTime" target="_blank">Must Have Awesome Plugins.</a></li>
							<li><a href="http://j.mp/CM_WPTime" target="_blank">Premium WordPress themes on CreativeMarket.</a></li>
							<li><a href="http://j.mp/TF_WPTime" target="_blank">Premium WordPress themes on Themeforest.</a></li>
							<li><a href="http://j.mp/CC_WPTime" target="_blank">Premium WordPress plugins on Codecanyon.</a></li>
							<li><a href="http://j.mp/BH_WPTime" target="_blank">Unlimited web hosting for $3.95 only.</a></li>
						</ul>
					<p><a href="http://j.mp/GL_WPTime" target="_blank"><img src="<?php echo plugins_url( '/banner/global-aff-img.png', __FILE__ ); ?>" width="728" height="90"></a></p>
					<p><a href="http://j.mp/ET_WPTime_ref_pl" target="_blank"><img src="<?php echo plugins_url( '/banner/570x100.jpg', __FILE__ ); ?>"></a></p>
                    <p><a href="http://j.mp/Avada_WP_Theme" target="_blank"><img src="<?php echo plugins_url( '/banner/avada.jpg', __FILE__ ); ?>"></a></p>
				</div>
                
                </div>
			<?php
		}
	}
	add_action( 'admin_menu', 'WP_Time_Ghozylab_Aff' );
}


/* Include Keek Style */
function keek__style(){
	wp_enqueue_style( 'keek-style', plugins_url( '/css/keek-style.css', __FILE__ ), false, null);
}
add_action('wp_enqueue_scripts', 'keek__style');


/* Keek Shortcode */
function keek__shortcode($atts, $content = null){ // Shortcode Function Start
	
	Extract(
		shortcode_atts(
			array(
				"url"		=>	"", // $url var, default is none (required option)
				"width"		=>	"", // $width var, default is 100% (optional option)
				"height"	=>	"", // $height var, default is 405px (optional option)
				"margin"	=>	"" // $margin var, default is 20px for margin top and bottom (optional option)
			),$atts
		)
	);
	
	if( !empty($url) and preg_match("/(keek.com)+/", $url) ){ // Check if keek.com domain name
	
		$regex = array("/.*\\/(?=[^\\/]*\\/)|\\//m");
		$preg_replace = preg_replace($regex, "", $url);
		$str_replace = str_replace("keek", "", $preg_replace);
		$embed_link = "https://www.keek.com/keek/$str_replace/embed?autoplay=0&mute=0&controls=1&loop=0";
		
		if( !empty($width) ){ // if change width
			$width_size = $width.'px';
		}else{
			$width_size = '100%'; //default is 100%
		}
		
		if( !empty($height) ){ // if change height
			$height_size = $height.'px';
		}else{
			$height_size = '405px'; // default is 405px
		}
		
		if( !empty($margin) ){ // if change margin
			$margin_value = $margin.'px';
		}else{
			$margin_value = '20px'; // default is 20px
		}
		
		$iframe = '<iframe src="'.$embed_link.'" class="keek-embedding" style="width:'.$width_size.'; height:'.$height_size.';margin:'.$margin_value.' auto;"></iframe>'; // the result
		return $iframe; // display the result
		
	} // End check if keek.com domain name
	
	else{ // if not keek link
		return '<p>Please enter keek link only.</p>';
	}
	
} // Shortcode Function End
add_shortcode("keek", "keek__shortcode"); // Add shortcode [keek url="" width="" height="" margin=""]

?>