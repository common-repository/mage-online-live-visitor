<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
add_shortcode( 'mv-visitor', 'molv_get_visitor' );
function molv_get_visitor($atts, $content=null){
		$defaults = array(
			"theme"						=> "1"
		);
		$params 					= shortcode_atts($defaults, $atts);
		$theme						= $params['theme'];
global $wpdb;
$table_name = $wpdb->prefix . 'visitors';
$total_ip = $wpdb->get_var("SELECT COUNT(DISTINCT ip) FROM $table_name");
$total_users = $wpdb->get_var( "SELECT COUNT(DISTINCT user_id) FROM $table_name WHERE user_id!=0" );
$total_mobile_users = $wpdb->get_var( "SELECT  COUNT(DISTINCT ip) FROM $table_name WHERE mobile=1" );
$online =   $total_ip; 
$rn     =   $total_users;
$rm     =   $total_mobile_users;
ob_start();
if ($online>=0){
$nn =   0;
$online = $online+$nn;
echo "Total <span id='mvtotalss'>".$online."</span> visitors are online";}

echo "<span id='mvreguserss'>";if($rn>0){echo ", & ".$rn." "." registered member";} echo "</span>";

echo "<span id='mvmbuserss'>"; if($rm>0){echo "( ".$rm." from mobile ) ";} echo "</span>";
$content = ob_get_clean();
return $content;
}