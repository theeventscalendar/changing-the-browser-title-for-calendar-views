<?php
/**
 * Plugin Name: The Events Calendar Extension: Changing the Browser Title for Calendar Views
 * Description: Change the default browser title in calendar views.
 * Version: 1.0.0
 * Author: Modern Tribe, Inc.
 * Author URI: http://m.tri.be/1971
 * License: GPLv2 or later
 */

defined( 'WPINC' ) or die;

class Tribe__Extension__Changing_the_Browser_Title_for_Calendar_Views {

    /**
     * The semantic version number of this extension; should always match the plugin header.
     */
    const VERSION = '1.0.0';

    /**
     * Each plugin required by this extension
     *
     * @var array Plugins are listed in 'main class' => 'minimum version #' format
     */
    public $plugins_required = array(
        'Tribe__Events__Main' => '4.2'
    );

    /**
     * The constructor; delays initializing the extension until all other plugins are loaded.
     */
    public function __construct() {
        add_action( 'plugins_loaded', array( $this, 'init' ), 100 );
    }

    /**
     * Extension hooks and initialization; exits if the extension is not authorized by Tribe Common to run.
     */
    public function init() {

        // Exit early if our framework is saying this extension should not run.
        if ( ! function_exists( 'tribe_register_plugin' ) || ! tribe_register_plugin( __FILE__, __CLASS__, self::VERSION, $this->plugins_required ) ) {
            return;
        }

        /**
         * Modifes the event <title> element.
         *
         * Users of Yoast's SEO plugin may wish to try replacing the below line with:
         *
         *     add_filter('wpseo_title', 'filter_events_title' );
         */
        add_filter( 'tribe_events_title_tag', array( $this, 'filter_events_title' ) );
    }


    /**
     * Defines alternative titles for various event views.
     *
     * @param  string $title
     * @return string
     */
    public function filter_events_title( $title ) {
       
        // Single events
        if ( tribe_is_event() && is_single() ) {
            $title = 'Single event page';
        }

        // Single venues
        elseif ( tribe_is_venue() ) {
            $title = 'Single venue page';
        }

        // Single organizers
        elseif ( tribe_is_organizer() && is_single() ) {
            $title = 'Single organizer page';
        }

        // Month view Page
        elseif ( tribe_is_month() && !is_tax() ) {
            $title = 'Month view page';
        }

        // Month view category page
        elseif ( tribe_is_month() && is_tax() ) {
            $title = 'Month view category page';
        }

        // List view page: upcoming events
        elseif ( tribe_is_upcoming() && ! is_tax() ) {
            $title = 'List view: upcoming events page';
        }

        // List view category page: upcoming events
        elseif ( tribe_is_upcoming() && is_tax() ) {
            $title = 'List view category: upcoming events page';
        }

        // List view page: past events
        elseif ( tribe_is_past() && !is_tax() ) {
            $title = 'List view: past events page';
        }

        // List view category page: past events
        elseif ( tribe_is_past() && is_tax() ) {
            $title = 'List view category: past events page';
        }

        // Week view page
        elseif ( tribe_is_week() && ! is_tax() ) {
            $title = 'Week view page';
        }

        // Week view category page
        elseif ( tribe_is_week() && is_tax() ) {
            $title = 'Week view category page';
        }

        // Day view page
        elseif ( tribe_is_day() && ! is_tax() ) {
            $title = 'Day view page';
        }

        // Day view category page
        elseif ( tribe_is_day() && is_tax() ) {
            $title = 'Day view category page';
        }

        // Map view page
        elseif ( tribe_is_map() && ! is_tax() ) {
            $title = 'Map view page';
        }

        // Map view category page
        elseif ( tribe_is_map() && is_tax() ) {
            $title = 'Map view category page';
        }

        // Photo view page
        elseif ( tribe_is_photo() && ! is_tax() ) {
            $title = 'Photo view page';
        }

        // Photo view category page
        elseif ( tribe_is_photo() && is_tax() ) {
            $title = 'Photo view category page';
        }

        return $title;
    }
}

new Tribe__Extension__Changing_the_Browser_Title_for_Calendar_Views();
