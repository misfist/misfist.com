<?php

// deletes our settings from the options table

if ( !defined('WP_UNINSTALL_PLUGIN') ) {
    exit();
}
delete_option('nextgen_optimizer_settings');

?>