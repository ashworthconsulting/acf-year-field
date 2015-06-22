Advanced Custom Fields - Year Field add-on
================================================================

This is an add-on for the [Advanced Custom Fields](http://www.advancedcustomfields.com/)
WordPress plugin that adds a Year field type.

The year field lets you add a select field to Advanced Custom Fields with pre-populated years as a list to choose from. Previously, you needed to choose "select" as your field type, and then manually add a list of values/labels you wanted to use. Now it's as simple as installing the plugin, adding your field, and tweaking any settings if you don't like the default values.

Currently, you have control over the starting year in the list, as well as the "range", telling the field how far back to populate into the select box.

This new field supports all interactions that other default fields do, such as shortcodes and the `get_value()` api call. For more information on how to use the saved data from this field type, please see "[Displaying field data in your theme](http://www.advancedcustomfields.com/docs/getting-started/displaying-field-data-in-your-theme/)" on the ACF website.

#### Shortcode Examples

    [acf field="{$field_name}"]		// basic useage

…so if your field were named `birth_year`, you could use…

    [acf field="birth_year"]

#### PHP Examples

    <p><?php the_field( 'birth_year' ); ?></p>

…or…

    <?php
    $birth_year = get_field( 'birth_year' );
    // do something with $birth_year
    ?>

…or…

    <?php
    if ( get_field( 'birth_year' ) ) {
    	// Always sanitise/"late escape" your output
    	echo '<p>' . absint( get_field( 'birth_year' ) ) . '</p>';
    }
    ?>

**Please Note:** This is an add-on for the Advanced Custom Fields WordPress plugin and will not provide any functionality to WordPress unless Advanced Custom Fields is installed and activated.

### Source Repository on GitHub
https://github.com/ManxStef/acf-year-field

### Bugs or Suggestions
https://github.com/ManxStef/acf-year-field/issues

Installation
------------

The Year Field plugin can be used as WordPress plugin or included in other plugins or themes.
There is no need to call the Advanced Custom Fields `register_field()` method for this field.

* WordPress plugin
	1. Download the plugin and extract it to `/wp-content/plugins/` directory.
	2. Activate the plugin through the `Plugins` menu in WordPress.
* Added to a Theme or Plugin
	1. Download the plugin and extract it to your theme or plugin directory.
	2. Include the `year-field.php` file in you theme's `functions.php` or plugin file.  
	   `include_once( rtrim( dirname( __FILE__ ), '/' ) . '/fields/year-field.php' );`

Todo
-------

* Not sure yet. What do you want?

Frequently Asked Questions
--------------------------

### I've activated the plugin, but nothing happens!

Make sure you have [Advanced Custom Fields](http://wordpress.org/extend/plugins/advanced-custom-fields/) installed and
activated. This is not a standalone plugin for WordPress, it only adds additional functionality to Advanced Custom Fields.
