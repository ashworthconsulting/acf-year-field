<?php 
  class acf_field_Year_Field extends acf_field
	{

		var $settings, // will hold info such as dir / path
		$defaults; // will hold default field options

		/*
		*  __construct
		*
		*  Set name / label needed for actions / filters
		*
		*  @since	3.6
		*  @date	23/01/13
		*/

		function __construct()
		{
			// set name / title
			$this->name = 'year'; // variable name (no spaces / special characters / etc)
			$this->label = __("Year"); // field label (Displayed in edit screens)
			$this->category = __("Basic",'acf');
			$this->defaults = array(
				// add default here to merge into your field. 
				// This makes life easy when creating the field options as you don't need to use any if( isset('') ) logic. eg:
				//'preview_size' => 'thumbnail'
				'year_range' => 20
			);

			// do not delete!
			parent::__construct();

			// settings
			$this->settings = array(
				'path' => apply_filters('acf/helpers/get_path', __FILE__),
				'dir' => apply_filters('acf/helpers/get_dir', __FILE__),
				'version' => '1.0.0'
			);

		}


		/*
		*  create_options()
		*
		*  Create extra options for your field. This is rendered when editing a field.
		*  The value of $field['name'] can be used (like bellow) to save extra data to the $field
		*
		*  @type	action
		*  @since	3.6
		*  @date	23/01/13
		*
		*  @param	$field	- an array holding all the field's data
		*/

		function create_options($field)
		{
			// defaults
			$field['startYear'] = isset($field['startYear']) ? $field['startYear'] : date('Y');
			$field['yearRange'] = isset($field['yearRange']) ? $field['yearRange'] : $this->defaults['year_range'];

			// key is needed in the field names to correctly save the data
			$key = $field['name'];

		?>
	        <tr class="field_option field_option_<?php echo $this->name; ?>">
	            <td class="label">
	                <label><?php _e("Start Year",'acf'); ?></label>
	                <p class="description"><?php _e("Choose Year",'acf'); ?></p>
	            </td>
	            <td>
					<?php
					do_action('acf/create_field', array(
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
					do_action('acf/create_field', array(
						'type'	=>	'text',
						'name'	=>	'fields['.$key.'][yearRange]',
						'value'	=>	$field['yearRange'],
					));
					?>
	            </td>
	        </tr>
		<?php
		}


		/*
		*  create_field()
		*
		*  Create the HTML interface for your field
		*
		*  @param	$field - an array holding all the field's data
		*
		*  @type	action
		*  @since	3.6
		*  @date	23/01/13
		*/

		function create_field($field)
		{
			// defaults
			$field['startYear'] = isset($field['startYear']) ? $field['startYear'] : date('Y');
			$field['yearRange'] = isset($field['yearRange']) ? $field['yearRange'] : $this->defaults['year_range'];

			// Generate Options
			$startYear = $field['startYear'];
			$endYear = ( $startYear + $field['yearRange'] );
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


		/*
		*  input_admin_head()
		*
		*  This action is called in the admin_head action on the edit screen where your field is created.
		*  Use this action to add css and javascript to assist your create_field() action.
		*
		*  @info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_head
		*  @type	action
		*  @since	3.6
		*  @date	23/01/13
		*/

		function input_admin_head()
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


		/*
		*  update_value()
		*
		*  This filter is appied to the $value before it is updated in the db
		*
		*  @type	filter
		*  @since	3.6
		*  @date	23/01/13
		*
		*  @param	$value - the value which will be saved in the database
		*  @param	$post_id - the $post_id of which the value will be saved
		*  @param	$field - the field array holding all the field options
		*
		*  @return	$value - the modified value
		*/

		function update_value( $value, $post_id, $field )
		{
			// save value
			return $value;
		}



	}

  new acf_field_Year_Field();
?>
