<?php

    /*
    Plugin Name: Codo Player
    Plugin URI: http://www.codoplayer.com/
    Description: A Prime HTML5 FLASH Web Video Player. Easy to setup, highly configurable, cross browser and plays on desktop, tablet and mobile. Now with a powerful VAST advertising plugin to monetise your video content!
    Author: Donato Software House
    Version: 1.0
    Author URI: http://www.donatosoftwarehouse.com/
    */

    function designer() {
        include("designer.php");
    }

    function admin_actions() {
        add_management_page("Codo Player", "Codo Player", 1, "Codo_Player", "designer");
    }

    function renderPlayer($product_cnt=1) {
        $retval = '';
        $retval .= '<h1>Codo Player</h1>';
        return $retval;
    }

    add_action('admin_menu', 'admin_actions');

?>