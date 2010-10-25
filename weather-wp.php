<?php
/*
Plugin Name: Weather WP
Plugin URI: http://plugins.sonicity.eu/weather-plugin/
Description: Displays the current weather in your desired city.
Version: 1.0.2
Author: Sonicity Plugins
Author URI: http://plugins.sonicity.eu
*/

/*  Copyright 2010 Sonicity.EU - support@sonicity.eu

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Hook for adding admin menus
add_action('admin_menu', 'weather_add_pages');

// action function for above hook
function weather_add_pages() {
    add_options_page('Weather', 'Weather', 'administrator', 'weather', 'weather_options_page');
}

// weather_options_page() displays the page content for the Test Options submenu
function weather_options_page() {

    // variables for the field and option names 
    $opt_name = 'mt_weather_header';
	$opt_name_2 = 'mt_weather_color';
    $opt_name_3 = 'mt_weather_city';
	$opt_name_4 = 'mt_weather_header2';
    $opt_name_6 = 'mt_weather_plugin_support';
	$opt_name_7 = 'mt_weather_temp';
	$opt_name_8 = 'mt_weather_wind';
    $hidden_field_name = 'mt_weather_submit_hidden';
    $data_field_name = 'mt_weather_header';
	$data_field_name_2 = 'mt_weather_color';
    $data_field_name_3 = 'mt_weather_type';
	$data_field_name_4 = 'mt_weather_header2';
    $data_field_name_6 = 'mt_weather_plugin_support';
	$data_field_name_7 = 'mt_weather_temp';
	$data_field_name_8 = 'mt_weather_wind';

    // Read in existing option value from database
    $opt_val = get_option( $opt_name );
	$opt_val_2 = get_option( $opt_name_2 );
    $opt_val_3 = get_option( $opt_name_3 );
	$opt_val_4 = get_option( $opt_name_4 );
    $opt_val_6 = get_option($opt_name_6);
	$opt_val_7 = get_option($opt_name_7);
	$opt_val_8 = get_option($opt_name_8);
    

    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( $_POST[ $hidden_field_name ] == 'Y' ) {
        // Read their posted value
        $opt_val = $_POST[ $data_field_name ];
		$opt_val_2 = $_POST[ $data_field_name_2 ];
        $opt_val_3 = $_POST[ $data_field_name_3 ];
		$opt_val_4 = $_POST[ $data_field_name_4 ];
        $opt_val_6 = $_POST[$data_field_name_6];
		$opt_val_7 = $_POST[$data_field_name_7];
		$opt_val_8 = $_POST[$data_field_name_8];

        // Save the posted value in the database
        update_option( $opt_name, $opt_val );
		update_option( $opt_name_2, $opt_val_2 );
        update_option( $opt_name_3, $opt_val_3 );
		update_option( $opt_name_4, $opt_val_4 );
        update_option( $opt_name_6, $opt_val_6 );
        update_option( $opt_name_7, $opt_val_7 );
        update_option( $opt_name_8, $opt_val_8 );		

        // Put an options updated message on the screen

?>
<div class="updated"><p><strong><?php _e('Options saved.', 'mt_trans_domain' ); ?></strong></p></div>
<?php

    }

    // Now display the options editing screen

    echo '<div class="wrap">';

    // header

    echo "<h2>" . __( 'Weather Plugin Options', 'mt_trans_domain' ) . "</h2>";

    // options form
    
    $change4 = get_option("mt_weather_plugin_support");
	$change5 = get_option("mt_weather_temp");
	$change6 = get_option("mt_weather_wind");

if ($change4=="Yes" || $change4=="") {
$change4="checked";
$change41="";
} else {
$change4="";
$change41="checked";
}

if ($change5=="c" || $change5=="") {
$change5="checked";
$change51="";
} else {
$change5="";
$change51="checked";
}

if ($change6=="Yes") {
$change6="checked";
$change61="";
} else {
$change6="";
$change61="checked";
}

if ($change7=="c" || $change7=="") {
$change7="checked";
$change71="";
} else {
$change7="";
$change71="checked";
}
    ?>
<form name="form1" method="post" action="">
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">

<h3>Current Weather Widget</h3>
<p><?php _e("Widget Title", 'mt_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name; ?>" value="<?php echo $opt_val; ?>" size="50">
</p><hr />

<h3>Forecasted Weather Widget</h3>
<p><?php _e("Widget Title", 'mt_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name_4; ?>" value="<?php echo $opt_val_4; ?>" size="50">
</p><hr />

<h3>General Settings</h3>
<p><?php _e("Location (In the form City,Country):", 'mt_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name_3; ?>" value="<?php echo $opt_val_3; ?>" size="40">
</p><hr />

<p><?php _e("Temperature measured in...", 'mt_trans_domain' ); ?> 
<input type="radio" name="<?php echo $data_field_name_7; ?>" value="c" <?php echo $change7; ?>>Celcius
<input type="radio" name="<?php echo $data_field_name_7; ?>" value="f" <?php echo $change71; ?>>Fahrenheit
</p><hr />

<p><?php _e("Colour:", 'mt_trans_domain' ); ?> 
#<input size="7" name="<?php echo $data_field_name_2; ?>" value="<?php echo $opt_val_2; ?>">
(For help, go to <a href="http://html-color-codes.com/">HTML Color Codes</a>).
</p><hr />

<p><?php _e("Support the Plugin?", 'mt_trans_domain' ); ?> 
<input type="radio" name="<?php echo $data_field_name_6; ?>" value="Yes" <?php echo $change4; ?>>Yes
<input type="radio" name="<?php echo $data_field_name_6; ?>" value="No" <?php echo $change41; ?>>No
</p><hr />

<p class="submit">
<input type="submit" name="Submit" value="<?php _e('Update Options', 'mt_trans_domain' ) ?>" />
</p><hr />

</form>
<?php
}

function show_weather_current($args) {

extract($args);

  $weather_header = get_option("mt_weather_header"); 
  $plugin_support2 = get_option("mt_weather_plugin_support");
  $option_city = get_option("mt_weather_city");
  $option_country = get_option("mt_weather_country");
  $weathercolor = get_option("mt_weather_color");
  
    if ($option_city=="") {
  $option_city="London,England";
  }
  
  $docload='http://www.google.com/ig/api?weather='.$option_city;
  $temp_u = get_option("mt_weather_temp");
  $winddone = get_option("mt_weather_wind");

if ($weather_header=="") {
$weather_header="Weather in ".$option_city;
}

$i=0;

$docload=str_replace(" ", "%20", $docload);

echo $before_widget.$before_title.$weather_header.$after_title."<br />"; 
echo "<ul>";
		$output = wp_remote_fopen($docload);
		$xml  = simplexml_load_string($output);
    
    $unit_system = $xml->weather->forecast_information->unit_system['data'];
	
	if ($temp_u=="c" || $temp_u=="") {
	$temp=$xml->weather->current_conditions->temp_c['data'].'&deg;C';
	$tempa=" ¡C";
	} else {
	$temp=$xml->weather->current_conditions->temp_f['data'].'&deg;F';
	$tempa=" ¡F";
	}
	
	$condition=$xml->weather->current_conditions->condition['data'];
	$icon=$xml->weather->current_conditions->icon['data'];

echo "<li style='color:#".$weathercolor."'><img src='http://www.google.com/".$icon."' align='left'/>".$condition." <br /> ".$temp.$tempa."</li>";

$i ++;

echo "</ul>";

if ($plugin_support2=="Yes" || $plugin_support2=="") {
echo "<br /><br /><br /><p style='color:#".$weathercolor.";font-size:x-small'>Weather Plugin made by <a href='http://www.xeromi.net'>Web Hosting</a></p>";
}

echo $after_widget;
}

function show_weather_forecast($args) {

extract($args);

  $weather_header2 = get_option("mt_weather_header2"); 
  $plugin_support2 = get_option("mt_weather_plugin_support");
  $option_city = get_option("mt_weather_city");
  $weathercolor = get_option("mt_weather_color");
  
    if ($option_city=="") {
  $option_city="London,England";
  }
  
  $option_city2=str_replace(" ", "%20", $option_city);
  
  $docload='http://www.google.com/ig/api?weather='.$option_city;
  $temp_u = get_option("mt_weather_temp");

if ($weather_header2=="") {
$weather_header2="Weather Forecast in ".$option_city;
}

$i=0;

echo $before_widget.$before_title.$weather_header2.$after_title."<br />"; 
echo "<ul>";
		$output = wp_remote_fopen($docload);
		$xml  = simplexml_load_string($output);
	
	for($i=0; $i<=3; $i++) {		
			$day = $xml->weather->forecast_conditions[$i]->day_of_week['data'];
			$icon = $xml->weather->forecast_conditions[$i]->icon['data'];
			$high = $xml->weather->forecast_conditions[$i]->high['data'];
			$low = $xml->weather->forecast_conditions[$i]->low['data'];
			$condition = $xml->weather->forecast_conditions[$i]->condition['data'];
		
	echo "<li style='color:#".$weathercolor."'><img src='http://www.google.com".$icon."' align='left'/>".$day. " - " . $condition.", " . $low . " - " . $high . " Degrees</li><br /><br />";
	$j ++;
	}

$i ++;

echo "</ul>";

if ($plugin_support2=="Yes" || $plugin_support2=="") {
echo "<br /><br /><br /><p style='color:#".$weathercolor.";font-size:x-small'>Weather Plugin made by <a href='http://www.xeromi.net'>Web Hosting</a></p>";
}

echo $after_widget;
}

function init_weather_widget() {
register_sidebar_widget("Current Weather", "show_weather_current");
register_sidebar_widget("Forecasted Weather", "show_weather_forecast");
}

add_action("plugins_loaded", "init_weather_widget");

?>
