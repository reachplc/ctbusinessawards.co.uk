<?php
/**
 * Plugin Name: CTBA Entries 2016
 * Plugin URI:
 * Description: Entry form fields for 2016 event
 * Version:     1.0.0
 * Author:      Michael Bragg
 * Author URI:  http://www.trinitymirror.com
 * Text Domain: ctba-entries-2016
 */

function ctba_entries_set_title( $field_args, $field ){
		$entry = get_query_var( 'entry' );
		$value = get_the_title( $entry );
		return $value;
	}

function ctba_entries_set_default( $field_args, $field ) {
		$entry = get_query_var( 'entry' );
    $value = get_post_meta( (int) $entry, $field_args[id], true );
    return $value;
}

function ctba_entries_set_entry_id( $field_args, $field ) {

	if( isset( $entry ) ){
		$object_id = $entry;
	} else {
		$object_id = '0';
	}

	return $object_id;

}

/**
 * Register the form and fields for our front-end submission form
 */
function ctba_entries_2016_form() {

	$prefix = '_ctba_entries_2016_';

	$cmb = new_cmb2_box( array(
		'id'           => $prefix . 'common',
		'title'				 => __( 'Common Questions', 'ctba-entries-2016' ),
		'object_types' => array( 'ctba-entries', ),
		//'hookup'       => false,
		//'save_fields'  => false,
		'context'			 => 'normal',
		'priority'		 => 'high',
		'show_names'	 => 'true',
	) );

	$cmb->add_field( array(
		'name'    => __( 'Company Name', 'ctba-entries-2016' ),
		'id'      => 'submitted_post_title',
		'type'    => 'text',
		'default' => 'ctba_entries_set_title',
		'attributes'  => array(
      'placeholder' => __( 'Company Name', 'ctba-entries-2016' ),
      'class' => '',
    ),
	) );

	$cmb->add_field( array(
		'name'    => __( 'Company Address', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_company_address',
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
	        'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

	$cmb->add_field( array(
		'name'    => __( 'Name of contact dealing with submission', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_contact_name',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
	        'placeholder' => __( 'Contact Name', 'ctba-entries-2016' ),
        ),
	) );

	$cmb->add_field( array(
		'name'    => __( 'Contact Telephone', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_contact_telephone',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
	        'placeholder' => __( 'Telephone Number', 'ctba-entries-2016' ),
        ),
	) );

	$cmb->add_field( array(
		'name'    => __( 'Contact Email', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_contact_email',
		'type'    => 'text_email',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
	        'placeholder' => __( 'Contact Email', 'ctba-entries-2016' ),
        ),
	) );

	$cmb->add_field( array(
	    'name' => __( 'Date of formation', 'ctba-entries-2016' ),
	    'id'   => 'ctba_entries_2016_date_of_formation',
	    'default' => 'ctba_entries_set_default',
	    'type' => 'text',
	) );

	$cmb->add_field( array(
	    'name'             => __( 'Company Type', 'ctba-entries-2016' ),
	    'desc'             => __( 'Is the business a sole trader, partnership or limited company', 'ctba-entries-2016' ),
	    'id'               => 'ctba_entries_2016_business_type',
	    'type'             => 'select',
	    'show_option_none' => false,
	    'default'          => 'default',
	    'options'          => array(
	    	'default'  => __( 'Select your business', '' ),
	        'sole-trader' => __( 'Sole Trader', 'sole-trader' ),
	        'partnership'   => __( 'Partnership', 'partnership' ),
	        'limited'     => __( 'Limited Company', 'limited' ),
	    ),
	) );

	$cmb->add_field( array(
		'name'    => __( 'Parent Company Details (if applicable)', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_parent_company',
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

		$cmb->add_field( array(
		'name'    => __( 'Description of products/services', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_description_products_services',
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

	$cmb->add_field( array(
		'name'    => __( 'Other relevant background information', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_background_releveant_info',
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );
	// Financial Information

	// Turnover
	$cmb->add_field( array(
		'name'    => __( 'Turnover This Year', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_turnover_this_year',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
        ),
	) );

	$cmb->add_field( array(
		'name'    => __( 'Turnover Last Year', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_turnover_last_year',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
        ),
	) );

	$cmb->add_field( array(
		'name'    => __( 'Turnover Previous Year', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_turnover_previous_year',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
        ),
	) );

	$cmb->add_field( array(
		'name'    => __( 'Turnover Next Year', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_turnover_next_year',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
        ),
	) );

	// Net Profit
	$cmb->add_field( array(
		'name'    => __( 'Net Profit This Year', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_net_profit_this_year',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
        ),
	) );

	$cmb->add_field( array(
		'name'    => __( 'Net Profit Last Year', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_net_profit_last_year',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
        ),
	) );

	$cmb->add_field( array(
		'name'    => __( 'Net Profit Previous Year', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_net_profit_previous_year',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
        ),
	) );

	$cmb->add_field( array(
		'name'    => __( 'Net Profit Next Year', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_net_profit_next_year',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
        ),
	) );

	// No of Employees
	$cmb->add_field( array(
		'name'    => __( 'No. of Employees This Year', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_employees_this_year',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
        ),
	) );

	$cmb->add_field( array(
		'name'    => __( 'No. of Employees Last Year', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_employees_last_year',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
        ),
	) );

	$cmb->add_field( array(
		'name'    => __( 'No. of Employees Previous Year', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_employees_previous_year',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
        ),
	) );

	$cmb->add_field( array(
		'name'    => __( 'No. of Employees Next Year', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_employees_next_year',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
        ),
	) );

	// Other Categories

	$cmb->add_field( array(
		'name'    => __( 'Choose the categories you would like to enter', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_categories',
		'type'    => 'multicheck',
		'options' => array(
		    'business' => 'Business Start Up & Entrepreneur',
		    'export' => 'Export',
		    'finance' => 'Finance',
		    'legal' => 'Legal',
		    'manufacturing' => 'Manufacturing',
		    'professional' => 'Outstanding Professional',
		    'people' => 'People Development',
		    'property' => 'Property including Regeneration',
		    'sme' => 'Small & Medium Sized Enterprise',
		    'technology' => 'Technology & Digital',
		)
	) );

	/**
	 * Business Start Up & Entrepreneur
	 */

	$business_category = new_cmb2_box( array(
		'id'           => 'ctba-2016-categories-business',
		'title'				 => __( 'Business Start Up & Entrepreneur', 'ctba-entries-2016' ),
		'object_types' => array( 'ctba-entries', ),
		//'hookup'       => false,
		//'save_fields'  => false,
		'context'			 => 'normal',
		'priority'		 => 'high',
		'show_names'	 => 'true',
	) );

	$business_category->add_field( array(
		'name'    => __( 'Briefly describe your product or service', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_business_describe',
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

	$business_category->add_field( array(
		'name'    => __( 'Company Success?', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_business_why',
		'description' => __( 'Why do you deserve this award?', 'ctba-entries-2016' ),
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

	$business_category->add_field( array(
		'name'    => __( 'The Future', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_business_future',
		'description' => 'Please state your company\'s ambitions for the future including new markets you hope to exploit.',
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

	$business_category->add_field( array(
		'name'    => __( 'Any Other Information', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_business_other',
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

	/**
	 * Export
	 */
	$export_category = new_cmb2_box( array(
		'id'           => 'ctba-2016-categories-export',
		'title'				 => __( 'Export', 'ctba-entries-2016' ),
		'object_types' => array( 'ctba-entries', ),
		//'hookup'       => false,
		//'save_fields'  => false,
		'context'			 => 'normal',
		'priority'		 => 'high',
		'show_names'	 => 'true',
	) );

	$export_category->add_field( array(
		'name'    => __( 'Briefly describe your product or service', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_export_describe',
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

	$export_category->add_field( array(
		'name'    => __( 'Company Success' ),
		'id'      => 'ctba_entries_2016_export_why',
		'description' => __( 'Why do you deserve this award?', 'ctba-entries-2016' ),
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

	$export_category->add_field( array(
		'name'    => __( 'The Future', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_export_future',
		'description' => 'Please state your company\'s ambitions for the future including new markets you hope to exploit.',
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

	$export_category->add_field( array(
		'name'    => __( 'Any Other Information', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_export_other',
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

	/**
	 * Finance
	 */
	$finance_category = new_cmb2_box( array(
		'id'           => 'ctba-2016-categories-finance',
		'title'				 => __( 'Finance', 'ctba-entries-2016' ),
		'object_types' => array( 'ctba-entries', ),
		//'hookup'       => false,
		//'save_fields'  => false,
		'context'			 => 'normal',
		'priority'		 => 'high',
		'show_names'	 => 'true',
	) );

	$finance_category->add_field( array(
		'name'    => __( 'Briefly describe your product or service', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_finance_describe',
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

	$finance_category->add_field( array(
		'name'    => __( 'Company Success' ),
		'id'      => 'ctba_entries_2016_finance_why',
		'description' => __( 'Why do you deserve this award?', 'ctba-entries-2016' ),
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

	$finance_category->add_field( array(
		'name'    => __( 'The Future', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_finance_future',
		'description' => 'Please state your company\'s ambitions for the future including new markets you hope to exploit.',
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

	$finance_category->add_field( array(
		'name'    => __( 'Any Other Information', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_finance_other',
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

	/**
	 * Legal
	 */
	$legal_category = new_cmb2_box( array(
		'id'           => 'ctba-2016-categories-legal',
		'title'				 => __( 'Legal', 'ctba-entries-2016' ),
		'object_types' => array( 'ctba-entries', ),
		//'hookup'       => false,
		//'save_fields'  => false,
		'context'			 => 'normal',
		'priority'		 => 'high',
		'show_names'	 => 'true',
	) );

	$legal_category->add_field( array(
		'name'    => __( 'Briefly describe your product or service', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_legal_describe',
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

	$legal_category->add_field( array(
		'name'    => __( 'Company Success', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_legal_why',
		'description' => __( 'Why do you deserve this award?', 'ctba-entries-2016' ),
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

	$legal_category->add_field( array(
		'name'    => __( 'The Future', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_legal_future',
		'description' => 'Please state your company\'s ambitions for the future including new markets you hope to exploit.',
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

	$legal_category->add_field( array(
		'name'    => __( 'Any Other Information', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_legal_other',
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

	/**
	 * Manufacturing
	 */
	$manufacturing_category = new_cmb2_box( array(
		'id'           => 'ctba-2016-categories-manufacturing',
		'title'				 => __( 'Manufacturing', 'ctba-entries-2016' ),
		'object_types' => array( 'ctba-entries', ),
		//'hookup'       => false,
		//'save_fields'  => false,
		'context'			 => 'normal',
		'priority'		 => 'high',
		'show_names'	 => 'true',
	) );

	$manufacturing_category->add_field( array(
		'name'    => __( 'Briefly describe your product or service', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_manufacturing_describe',
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

	$manufacturing_category->add_field( array(
		'name'    => __( 'Company Success', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_manufacturing_why',
		'description' => __( 'Why do you deserve this award?', 'ctba-entries-2016' ),
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

	$manufacturing_category->add_field( array(
		'name'    => __( 'The Future', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_manufacturing_future',
		'description' => 'Please state your company\'s ambitions for the future including new markets you hope to exploit.',
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

	$manufacturing_category->add_field( array(
		'name'    => __( 'Any Other Information', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_manufacturing_other',
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

	/**
	 * Small & medium sized enterprise
	 */
	$sme_category = new_cmb2_box( array(
		'id'           => 'ctba-2016-categories-sme',
		'title'				 => __( 'Small & Medium Sized Enterprise', 'ctba-entries-2016' ),
		'object_types' => array( 'ctba-entries', ),
		//'hookup'       => false,
		//'save_fields'  => false,
		'context'			 => 'normal',
		'priority'		 => 'high',
		'show_names'	 => 'true',
	) );

	$sme_category->add_field( array(
		'name'    => __( 'Briefly describe your product or service', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_sme_describe',
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

	$sme_category->add_field( array(
		'name'    => __( 'Company Success', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_sme_why',
		'description' => __( 'Why do you deserve this award?', 'ctba-entries-2016' ),
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

	$sme_category->add_field( array(
		'name'    => __( 'The Future', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_sme_future',
		'description' => 'Please state your company\'s ambitions for the future including new markets you hope to exploit.',
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

	$sme_category->add_field( array(
		'name'    => __( 'Any Other Information', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_sme_other',
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

	/**
	 * Outstanding Professional
	 */
	$professional_category = new_cmb2_box( array(
		'id'           => 'ctba-2016-categories-professional',
		'title'				 => __( 'Outstanding Professional', 'ctba-entries-2016' ),
		'object_types' => array( 'ctba-entries', ),
		//'hookup'       => false,
		//'save_fields'  => false,
		'context'			 => 'normal',
		'priority'		 => 'high',
		'show_names'	 => 'true',
	) );

	$professional_category->add_field( array(
		'name'    => __( 'Briefly describe your product or service', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_professional_describe',
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

	$professional_category->add_field( array(
		'name'    => __( 'Entrepreneurial Innovation and Flair', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_professional_why',
		'description' => __( 'Please give examples of how and when you/your nominee has demonstrated entrepreneurial innovation and flair, using financial information to support where appropriate.', 'ctba-entries-2016' ),
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

	$professional_category->add_field( array(
		'name'    => __( 'Charities and Community Bodies', 'ctba-entries-2016' ),
		'description' => __( 'Give examples of how you/your nominee supports charities and community bodies in the West Midlands region.', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_professional_supports',
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

	$professional_category->add_field( array(
		'name'    => __( 'Demonstrate how you/your nominee helps to promote the region', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_professional_region',
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

	$professional_category->add_field( array(
		'name'    => __( 'Please detail accreditation, accolades and recognition received', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_professional_accreditation',
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

	/**
	 * People Development
	 */
	$people_category = new_cmb2_box( array(
		'id'           => 'ctba-2016-categories-people',
		'title'				 => __( 'People Development', 'ctba-entries-2016' ),
		'object_types' => array( 'ctba-entries', ),
		//'hookup'       => false,
		//'save_fields'  => false,
		'context'			 => 'normal',
		'priority'		 => 'high',
		'show_names'	 => 'true',
	) );

	$people_category->add_field( array(
		'name'    => __( 'Briefly describe your product or service', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_people_describe',
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

	$people_category->add_field( array(
		'name'    => __( 'Internal Training and Development: Own Staff', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_people_own',
		'type'    => 'textarea',
		'description' => 'Describe the improvements in staff performance and motivation. How many training days per quarter do your staff attend and is it mandatory attendance. Does your organisation provide its staff with recognised qualifications and if so at what level?',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

	$people_category->add_field( array(
		'name'    => __( 'External Training and Development: Training & Development company', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_people_external',
		'type'    => 'textarea',
		'description' => 'Which companies do you deliver training and development for? Does your company provide training and development to any hard to reach sectors of the community? How do you actively source your clients',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

	$people_category->add_field( array(
		'name'    => __( 'Technical Details', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_people_technical',
		'type'    => 'textarea',
		'description' => 'Please describe the types of training and development delivered in more details.',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

	$people_category->add_field( array(
		'name'    => __( 'The Future', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_people_future',
		'description' => 'Please state your company\'s ambitions for the future including new markets you hope to exploit.',
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

	$people_category->add_field( array(
		'name'    => __( 'Any Other Information', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_people_other',
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

	/**
	 * Property including Regeneration
	 */
	$property_category = new_cmb2_box( array(
		'id'           => 'ctba-2016-categories-property',
		'title'				 => __( 'Property including Regeneration', 'ctba-entries-2016' ),
		'object_types' => array( 'ctba-entries', ),
		//'hookup'       => false,
		//'save_fields'  => false,
		'context'			 => 'normal',
		'priority'		 => 'high',
		'show_names'	 => 'true',
	) );

	$property_category->add_field( array(
		'name'    => __( 'Briefly describe your product or service', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_property_describe',
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

	$property_category->add_field( array(
		'name'    => __( 'Company Success', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_property_why',
		'description' => __( 'Why do you deserve this award?', 'ctba-entries-2016' ),
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

	$property_category->add_field( array(
		'name'    => __( 'The Future', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_property_future',
		'description' => 'Please state your company\'s ambitions for the future including new markets you hope to exploit.',
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

	$property_category->add_field( array(
		'name'    => __( 'Any Other Information', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_property_other',
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

	/**
	 * Technology & Digital
	 */
	$technology_category = new_cmb2_box( array(
		'id'           => 'ctba-2016-categories-technology',
		'title'				 => __( 'Technology & Digital', 'ctba-entries-2016' ),
		'object_types' => array( 'ctba-entries', ),
		//'hookup'       => false,
		//'save_fields'  => false,
		'context'			 => 'normal',
		'priority'		 => 'high',
		'show_names'	 => 'true',
	) );

	$technology_category->add_field( array(
		'name'    => __( 'Briefly describe your product or service', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_technology_describe',
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

	$technology_category->add_field( array(
		'name'    => __( 'Company Success', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_technology_why',
		'description' => __( 'Why do you deserve this award?', 'ctba-entries-2016' ),
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

	$technology_category->add_field( array(
		'name'    => __( 'The Future', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_technology_future',
		'description' => 'Please state your company\'s ambitions for the future including new markets you hope to exploit.',
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

	$technology_category->add_field( array(
		'name'    => __( 'Any Other Information', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_technology_other',
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
			//'placeholder' => __( 'Address', 'ctba-entries-2016' ),
        ),
	) );

	/**
	 * Additional
   */

	$additional = new_cmb2_box( array(
		'id'           => 'ctba-entries-2016-additional',
		'title'				 => __( 'Confirm your entry', 'ctba-entries-2016' ),
		'object_types' => array( 'ctba-entries', ),
		//'hookup'       => false,
		//'save_fields'  => false,
		'context'			 => 'normal',
		'priority'		 => 'high',
		'show_names'	 => 'true',
	) );

	$additional->add_field( array(
    'name' => __( 'By Submitting this entry, I certify that the particulars given are correct to the best of my knowledge and belief.', 'ctba-entries-2016' ),
    'id'   => 'ctba_entries_2016_additional_submit',
    'type' => 'checkbox'
	) );

	$additional->add_field( array(
    'name'             => __( 'Will you be sending additional supporting evidence?', 'ctba-entries-2016' ),
    'id'               => 'ctba_entries_2016_additional_evidence',
    'type'             => 'radio',
    'show_option_none' => false,
    'options'          => array(
        'yes' => __( 'Yes', 'ctba-entries-2016' ),
        'no'   => __( 'No', 'ctba-entries-2016' ),
    ),
	) );

}
add_action( 'cmb2_init', 'ctba_entries_2016_form' );


/**
 * Gets the front-end-post-form cmb instance
 *
 * @return CMB2 object
 */
function wds_frontend_cmb2_get( $metabox_id, $object_id ) {
	// Use ID of metabox in ctba_entries_2016_form
	//$metabox_id = '_ctba_entries_2016_common';
	// Post/object ID is not applicable since we're using this form for submission
	//$object_id  = 'fake-oject-id';
	// Get CMB2 metabox object
	return cmb2_get_metabox( $metabox_id, $object_id );
}

/**
 * Handles form submission on save. Redirects if save is successful, otherwise sets an error message as a cmb property
 *
 * @return void
 */
function ctba_cntries_2016_handle_frontend_post_form_submission() {

	// Check to see if this is a new post or belongs to ctba entries post type
	if( ( get_post_type( $_POST['object_id'] ) !== 'ctba-entries' ) && ( $_POST['object_id'] != 0 ) && ( $_POST['object_id'] < 0 ) ){
		remove_query_arg( 'entry' );
		wp_redirect( home_url( $path = 'nominate/entry' ) );
	}


	// If no form submission, bail
	if ( empty( $_POST ) || ! isset( $_POST['submit-cmb'], $_POST['object_id'] ) ) {
		return false;
	}
	// Get CMB2 metabox object
	$cmb = wds_frontend_cmb2_get('_ctba_entries_2016_common', 'fake-object-id');
	$post_data = array();

	// Check security nonce
	if ( ! isset( $_POST[ $cmb->nonce() ] ) || ! wp_verify_nonce( $_POST[ $cmb->nonce() ], $cmb->nonce() ) ) {
		return $cmb->prop( 'submission_error', new WP_Error( 'security_fail', __( 'Security check failed.' ) ) );
	}

	// Check Post ID is valid
	if ( (! is_int( $_POST['object_id'] ) ) || ( ! $_POST['object_id'] >= 0 ) || floor( $_POST['object_id'] ) !== $_POST['object_id']  ) {
		return $cmb->prop( 'submission_error', new WP_Error( 'post_data_missing', __( 'Cannot submit your entry. Please try again' ) ) );
	}

	/**
	 * Fetch sanitized values
	 */
	$sanitized_values = $cmb->get_sanitized_values( $_POST );

	// Set our post data arguments

	// If we are updating a post supply the id from our hidden field.
	$post_data['ID'] = absint( $_POST['object_id'] );

	$post_data['post_title']   = $sanitized_values['submitted_post_title'];
	unset( $sanitized_values['submitted_post_title'] );
	$post_data['post_content'] = '';

	// Set the post type we want to submit.
	$post_data['post_type'] = 'ctba-entries';
	// Set the status of of post
	$post_data['post_status'] = ( $_POST['ctba_entries_2016_additional_submit'] == 'on' ? 'publish' : 'pending' );

	// Create the new post
	$new_submission_id = wp_insert_post( $post_data, true );
	// If we hit a snag, update the user
	if ( is_wp_error( $new_submission_id ) ) {
		return $cmb->prop( 'submission_error', $new_submission_id );
	}

	// Loop through remaining (sanitized) data, and save to post-meta
	foreach ( $sanitized_values as $key => $value ) {
		if ( is_array( $value ) ) {
			$value = array_filter( $value );
			if( ! empty( $value ) ) {
				update_post_meta( $new_submission_id, $key, $value );
			}
		} else {
			update_post_meta( $new_submission_id, $key, $value );
		}
	}


		$array= array(
		'ctba-2016-categories-business',
		'ctba-2016-categories-export',
		'ctba-2016-categories-finance',
		'ctba-2016-categories-legal',
		'ctba-2016-categories-manufacturing',
		'ctba-2016-categories-sme',
		'ctba-2016-categories-professional',
		'ctba-2016-categories-people',
		'ctba-2016-categories-property',
		'ctba-2016-categories-technology',
		'ctba-entries-2016-additional',
	);


foreach ($array as $array_key) {

// Biz
	$origianl_data = wds_frontend_cmb2_get( $array_key, 'fake-oject-id');
	//print_r($biz);
	$sanitized_data = $origianl_data->get_sanitized_values( $_POST );

	foreach ( $sanitized_data as $key => $value ) {
		if ( is_array( $value ) ) {
			$value = array_filter( $value );
			if( ! empty( $value ) ) {
				update_post_meta( $new_submission_id, $key, $value );
			}
		} else {
			update_post_meta( $new_submission_id, $key, $value );
		}
	}


}


	// Remove any previous entry query arguments
	remove_query_arg( 'entry' );
	/*
	 * Redirect back to the form page with a query variable with the new post ID.
	 * This will help double-submissions with browser refreshes
	 */
	wp_redirect( esc_url_raw( add_query_arg( 'entry', $new_submission_id ) ) );
	exit;
}
add_action( 'cmb2_after_init', 'ctba_cntries_2016_handle_frontend_post_form_submission' );
