<?php

/**
 * Plugin Name: Juzto Elementor Widgets
 * Description: Custom widgets for juzto.co
 * Plugin URI:  https://www.alexmonroy.com/
 * Version:     1.0.1
 * Author:      Alex Monroy
 * Author URI:  https://alexmonroy.com/
 * Text Domain: juzto-elementor-widgets
 */

namespace Juzto_Widgets;
use Elementor\Plugin;

if (!defined('ABSPATH'))
	exit;

// The Widget_Base class is not available immediately after plugins are loaded, so
// we delay the class' use until Elementor widgets are registered

add_action('elementor/widgets/widgets_registered', function () {
	require_once('widget-card.php');
	require_once('widget-table.php');

	$card_widget = new JZT_Card_Widget();
	$table_widget = new JZT_Table_Widget();

	// Let Elementor know about our widget
	Plugin::instance()->widgets_manager->register_widget_type($card_widget);
	Plugin::instance()->widgets_manager->register_widget_type($table_widget);
});

function register_juzto_widgets($widgets_manager)
{
	require_once('widget-card.php');
	require_once('widget-table.php');

	// Let Elementor know about our widget
	$widgets_manager->register(new JZT_Card_Widget());
	$widgets_manager->register(new JZT_Table_Widget());
// Plugin::instance()->widgets_manager->register_widget_type($table_widget);
}

// add_action('elementor/widgets/register', 'register_juzto_widgets');