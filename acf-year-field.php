<?php
/*
* Plugin Name: Advanced Custom Fields Year Field add-on
* Plugin URI:  https://github.com/ashworthconsulting/acf-year-field
* Description: The year field lets you add a select field to Advanced Custom Fields with pre-populated years as a list to choose from.
* Author:      Will Ashworth
* Author URI:  https://github.com/ashworthconsulting/acf-year-field
* Version:     1.0.1
* Text Domain: acf-year-field
* License:     GPL2
*/

if( !class_exists( 'ACF_Year_Field' ) && class_exists( 'acf_Field' ) ) :

	class ACF_Year_Field extends acf_Field
	{
		// Number of years to go back
		const YEAR_RANGE = 50;

		// Selected Age
		const AGE_LIMIT = 0;

		/*--------------------------------------------------------------------------------------
		*
		*	Constructor
		*	- This function is called when the field class is initalized on each page.
		*	- Here you can add filters / actions and setup any other functionality for your field
		*
		*	@author Elliot Condon
		*	@since 2.2.0
		*
		*-------------------------------------------------------------------------------------*/

		function __construct($parent)
		{
			// do not delete!
			parent::__construct($parent);

			// set name / title
			$this->name = 'year'; // variable name (no spaces / special characters / etc)
			$this->title = __("Year",'acf'); // field label (Displayed in edit screens)

		}


		/*--------------------------------------------------------------------------------------
		*
		*	create_options
		*	- this function is called from core/field_meta_box.php to create extra options
		*	for your field
		*
		*	@params
		*	- $key (int) - the $_POST obejct key required to save the options to the field
		*	- $field (array) - the field object
		*
		*	@author Elliot Condon
		*	@since 2.2.0
		*
		*-------------------------------------------------------------------------------------*/

		function create_options($key, $field)
		{
			// defaults
			$field['startYear'] = isset($field['startYear']) ? $field['startYear'] : date('Y');
			$field['yearRange'] = isset($field['yearRange']) ? $field['yearRange'] : self::YEAR_RANGE;

			?>
        <tr class="field_option field_option_<?php echo $this->name; ?>">
            <td class="label">
                <label><?php _e("Start Year",'acf'); ?></label>
            </td>
            <td>
				<?php
				$this->parent->create_field(array(
					'type'	=>	'text',
					'name'	=>	'fields['.$key.'][startYear]',
					'value'	=>	$field['startYear'],
				));
				?>
            </td>
        </tr>
        <tr class="field_option field_option_<?php echo $this->name; ?>">
            <td class="label">
                <label><?php _e("Year Range",'acf'); ?></label>
            </td>
            <td>
				<?php
				$this->parent->create_field(array(
					'type'	=>	'text',
					'name'	=>	'fields['.$key.'][yearRange]',
					'value'	=>	$field['yearRange'],
				));
				?>
            </td>
        </tr>
		<?php
		}


		/*--------------------------------------------------------------------------------------
		*
		*	create_field
		*	- this function is called on edit screens to produce the html for this field
		*
		*	@author Elliot Condon
		*	@since 2.2.0
		*
		*-------------------------------------------------------------------------------------*/

		function create_field($field)
		{
			// defaults
			$field['startYear'] = isset($field['startYear']) ? $field['startYear'] : date('Y');
			$field['yearRange'] = isset($field['yearRange']) ? $field['yearRange'] : self::YEAR_RANGE;

			// Generate Options
			$startYear = $field['startYear'];
			$endYear = ( $startYear - $field['yearRange'] );
			//$selectYear = ( $startYear - $field['ageLimit'] );
			$years = range( $startYear, $endYear );

			echo '<select id="' . $field['name'] . '" class="' . $field['class'] . '" name="' . $field['name'] . '">' . "\n";
			foreach ( $years as $year ) {
				$selected = "";
				if( $year == $field['value'] ) {
					$selected = " selected";
				}
				echo '<option value="' . $year . '"' . $selected . '>' . $year . '</option>' . "\n";
			}
			echo '</select>' . "\n";
		}


		/*--------------------------------------------------------------------------------------
		*
		*	admin_head
		*	- this function is called in the admin_head of the edit screen where your field
		*	is created. Use this function to create css and javascript to assist your
		*	create_field() function.
		*
		*	@author Elliot Condon
		*	@since 2.2.0
		*
		*-------------------------------------------------------------------------------------*/

		function admin_head()
		{
			?>
        <style type="text/css">
            .acf_postbox .field select.year {
                width: 20%;
                margin-left: 5px;
            }
        </style>
		<?php
		}


		/*--------------------------------------------------------------------------------------
		*
		*	update_value
		*	- this function is called when saving a post object that your field is assigned to.
		*	the function will pass through the 3 parameters for you to use.
		*
		*	@params
		*	- $post_id (int) - usefull if you need to save extra data or manipulate the current
		*	post object
		*	- $field (array) - usefull if you need to manipulate the $value based on a field option
		*	- $value (mixed) - the new value of your field.
		*
		*	@author Elliot Condon
		*	@since 2.2.0
		*
		*-------------------------------------------------------------------------------------*/

		function update_value($post_id, $field, $value)
		{
			// save value
			parent::update_value($post_id, $field, $value);
		}





		/*--------------------------------------------------------------------------------------
		*
		*	get_value
		*	- called from the edit page to get the value of your field. This function is useful
		*	if your field needs to collect extra data for your create_field() function.
		*
		*	@params
		*	- $post_id (int) - the post ID which your value is attached to
		*	- $field (array) - the field object.
		*
		*	@author Elliot Condon
		*	@since 2.2.0
		*
		*-------------------------------------------------------------------------------------*/

		function get_value($post_id, $field)
		{
			// get value
			$value = parent::get_value($post_id, $field);

			// return value
			return $value;
		}


		/*--------------------------------------------------------------------------------------
		*
		*	get_value_for_api
		*	- called from your template file when using the API functions (get_field, etc).
		*	This function is useful if your field needs to format the returned value
		*
		*	@params
		*	- $post_id (int) - the post ID which your value is attached to
		*	- $field (array) - the field object.
		*
		*	@author Elliot Condon
		*	@since 3.0.0
		*
		*-------------------------------------------------------------------------------------*/

		function get_value_for_api($post_id, $field)
		{
			// get value
			$value = $this->get_value($post_id, $field);

			// return value
			return $value;

		}

	}

endif; //class_exists 'ACF_Address_Field'

if( !class_exists( 'ACF_Address_Field_Helper' ) ) :

/**
 * Advanced Custom Fields - Address Field Helper
 * 
 * This class is a Helper for the ACF_Address_Field class.
 * 
 * It provides:
 * Localization support and registering the textdomain with WordPress.
 * Registering the address field with Advanced Custom Fields. There is no need in your plugin or theme
 * to manually call the register_field() method, just include this file.
 * <code> include_once( rtrim( dirname( __FILE__ ), '/' ) . '/acf-address-field/address-field.php' ); </code>
 * 
 * @author Brian Zoetewey <brian.zoetewey@ccci.org>
 * @todo Provide shortcode support for address fields
 */
class ACF_Address_Field_Helper {
	/**
	* WordPress Localization Text Domain
	*
	* Used in wordpress localization and translation methods.
	* @var string
	*/
	const L10N_DOMAIN = 'acf-address-field';
	
	/**
	 * Singleton instance
	 * @var ACF_Address_Field_Helper
	 */
	private static $instance;
	
	/**
	 * Returns the ACF_Address_Field_Helper singleton
	 * 
	 * <code>$obj = ACF_Address_Field_Helper::singleton();</code>
	 * @return ACF_Address_Field_Helper
	 */
	public static function singleton() {
		if( !isset( self::$instance ) ) {
			$class = __CLASS__;
			self::$instance = new $class();
		}
		return self::$instance;
	}
	
	/**
	 * Prevent cloning of the ACF_Address_Field_Helper object
	 * @internal
	 */
	private function __clone() {
	}
	
	/**
	 * Language directory path
	 * 
	 * Used to build the path for WordPress localization files.
	 * @var string
	 */
	private $lang_dir;
	
	/**
	 * Constructor
	 */
	private function __construct() {
		$this->lang_dir = rtrim( dirname( realpath( __FILE__ ) ), '/' ) . '/languages';
		
		add_action( 'init', array( &$this, 'register_address_field' ), 5, 0 );
		add_action( 'init', array( &$this, 'load_textdomain' ),        2, 0 );
	}
	
	/**
	 * Registers the Address Field with Advanced Custom Fields
	 */
	public function register_address_field() {
		if( function_exists( 'register_field' ) ) {
			register_field( 'ACF_Address_Field', __FILE__ );
		}
	}
	
	/**
	* Loads the textdomain for the current locale if it exists
	*/
	public function load_textdomain() {
		$locale = get_locale();
		$mofile = $this->lang_dir . '/' . self::L10N_DOMAIN . '-' . $locale . '.mo';
		load_textdomain( self::L10N_DOMAIN, $mofile );
	}
}
endif; //class_exists 'ACF_Address_Field_Helper'

// enable year select field
#if( function_exists( 'register_field' ) )
#{
#	register_field('Year_field', dirname(__File__) . '/fields/acf-year.php');
#}

die(dirname(__File__));