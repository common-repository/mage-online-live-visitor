<?php
/**
* Plugin Name: Mage Online Live Visitor
* Plugin URI: http://mage-people.com
* Description: Live Online Visitor Counter for WordPress by MagePeople
* Version: 1.0
* Author: MagePeople Team
* Author URI: http://www.mage-people.com/
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
require_once( ABSPATH . "wp-includes/pluggable.php" );
// function to create the DB / Options / Defaults         
function molv_visitor_db_table() {
global $wpdb;
  $charset_collate = $wpdb->get_charset_collate();
  $table_name = $wpdb->prefix . 'visitors';
  $sql = "CREATE TABLE $table_name (
    timestamp int(15) NOT NULL,
    user_id int(9) NOT NULL,  
    ip varchar(55) NOT NULL,
    mobile int(1) NOT NULL,  
    files varchar(255) DEFAULT '' NOT NULL,
    PRIMARY KEY  (timestamp)
  ) $charset_collate;";
  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
  dbDelta( $sql );
}
// run the install scripts upon plugin activation
register_activation_hook(__FILE__,'molv_visitor_db_table');

if( !is_admin()){ 
  require_once(dirname(__FILE__) . "/inc/molv_visitor.php");
  require_once(dirname(__FILE__) . "/inc/molv_shortcode.php");
}