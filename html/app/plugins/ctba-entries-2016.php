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
		$value = get_post_meta( (int) $entry, $field_args['id'], true );
		return $value;
}

function ctba_entries_set_entry_id( $field_args, $field ) {

	if ( isset( $entry ) ) {
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

	$common = new_cmb2_box( array(
		'id'           => $prefix . 'common',
		'title'				 => __( 'Common Questions', 'ctba-entries-2016' ),
		'object_types' => array( 'ctba-entries', ),
		//'hookup'       => false,
		//'save_fields'  => false,
		'context'			 => 'normal',
		'priority'		 => 'high',
		'show_names'	 => 'true',
	) );

	$common->add_field( array(
		'name'    => __( 'Company Name', 'ctba-entries-2016' ),
		'id'      => 'submitted_post_title',
		'type'    => 'text',
		'default' => 'ctba_entries_set_title',
		'attributes'  => array(
		'placeholder' => __( 'Company Name', 'ctba-entries-2016' ),
		'class' => '',
		),
	) );

	$common->add_field( array(
		'name'    => __( 'Company Address', 'ctba-entries-2016' ),
		'id'      => $prefix .'company_address',
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
		'required' => 'required',
		),
	) );

	$common->add_field( array(
		'name'    => __( 'Name of contact dealing with submission', 'ctba-entries-2016' ),
		'id'      => $prefix . 'contact_name',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
		'placeholder' => __( 'Contact Name', 'ctba-entries-2016' ),
		),
	) );

	$common->add_field( array(
		'name'    => __( 'Contact Email', 'ctba-entries-2016' ),
		'id'      => $prefix . 'contact_email',
		'type'    => 'text_email',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
		'placeholder' => __( 'Contact Email', 'ctba-entries-2016' ),
		),
	) );

	$common->add_field( array(
		'name'    => __( 'Contact Telephone', 'ctba-entries-2016' ),
		'id'      => $prefix . 'contact_phone',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(
		'placeholder' => __( 'eg, 01212345678', 'ctba-entries-2016' ),
		'required' => 'required',
		),
	) );

	$common->add_field( array(
		'name' => __( 'Date of formation', 'ctba-entries-2016' ),
		'id'   => $prefix . 'date_of_formation',
		'default' => 'ctba_entries_set_default',
		'type' => 'text',
	) );

	$common->add_field( array(
		'name'             => __( 'Business Type', 'ctba-entries-2016' ),
		'desc'             => __( 'What type of business are you?', 'ctba-entries-2016' ),
		'id'               => $prefix . 'business_type',
		'type'             => 'select',
		'show_option_none' => false,
		'default'          => 'default',
		'options'          =>
		array(
			'default'  => __( 'Select your business', '' ),
			'sole-trader-partnership' => __( 'Sole Trader/Partnership', 'ctba-entries-2016' ),
			'limited'     => __( 'Limited Company', 'ctba-entries-2016' ),
			'charity'     => __( 'Exempt Charity', 'ctba-entries-2016' ),
			'limited-guarantee'     => __( 'Company Limited by Guarantee', 'ctba-entries-2016' ),
			'public-sector'     => __( 'Public Sector Organisation', 'ctba-entries-2016' ),
			'association'     => __( 'Unincorporated Association', 'ctba-entries-2016' ),
			'community-interest'     => __( 'Community Interest Company Limited', 'ctba-entries-2016' ),
		),
	) );

	$common->add_field( array(
		'name'    => __( 'Parent Company Details (if applicable)', 'ctba-entries-2016' ),
		'id'      => $prefix .'parent_company',
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$common->add_field( array(
		'name'    => __( 'No. of employees', 'ctba-entries-2016' ),
		'id'      => $prefix .'number_employees',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$common->add_field( array(
		'name'    => __( 'Turnover for last financial year', 'ctba-entries-2016' ),
		'id'      => $prefix .'turnover_last_year',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$common->add_field( array(
		'name'    => __( 'Description of products/services', 'ctba-entries-2016' ),
		'id'      => $prefix . 'description_products_services',
		'type'    => 'textarea',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	// Other Categories

	$common->add_field( array(
		'name'    => __( 'Choose the categories you would like to enter', 'ctba-entries-2016' ),
		'id'      => 'ctba_entries_2016_categories',
		'type'    => 'multicheck',
		'select_all_button' => false,
		'options' =>
		array(
			$prefix . 'notforprofit' => __( 'Not-for-profit Organisation', 'ctba-entries-2016' ),
			$prefix . 'community' => __( 'Contribution to the Community', 'ctba-entries-2016' ),
			$prefix . 'trade' => __( 'International Trade', 'ctba-entries-2016' ),
			$prefix . 'creative' => __( 'Creative Industries Business of the Year', 'ctba-entries-2016' ),
			$prefix . 'retail' => __( 'Retail Business of the Year', 'ctba-entries-2016' ),
			$prefix . 'technology' => __( 'Excellence in Science and Technology', 'ctba-entries-2016' ),
			$prefix . 'manufacturing' => __( 'Excellence in Manufacturing', 'ctba-entries-2016' ),
			$prefix . 'marketing' => __( 'Sales and Marketing', 'ctba-entries-2016' ),
			$prefix . 'services' => __( 'Services', 'ctba-entries-2016' ),
			$prefix . 'entrepreneur' => __( 'Business Entrepreneur of the Year', 'ctba-entries-2016' ),
			$prefix . 'newbusiness' => __( 'New Business of the Year', 'ctba-entries-2016' ),
			$prefix . 'smallbusiness' => __( 'Small Business of the Year', 'ctba-entries-2016' ),
			$prefix . 'companyyear' => __( 'Company of the Year', 'ctba-entries-2016' ),
		)
	) );

	/**
	 * Not For Profit
	 */

	$notforprofit = new_cmb2_box( array(
		'id'           => $prefix . 'notforprofit',
		'title'				 => __( 'Not for Profit Organisation Award', 'ctba-entries-2016' ),
		'object_types' => array( 'ctba-entries', ),
		//'hookup'       => false,
		//'save_fields'  => false,
		'context'			 => 'normal',
		'priority'		 => 'default',
		'show_names'	 => 'true',
	) );

	$notforprofit->add_field( array(
		'name'						=> __( 'What are your main aims and objectives', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'notforprofit_aims',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$notforprofit->add_field( array(
		'name'						=> __( 'Explain the work you do to achive your overall aims and objectives', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'notforprofit_explain',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$notforprofit->add_field( array(
		'name'						=> __( 'What activities do you undertake to secure funding for your organisation (if applicable)', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'notforprofit_activities',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$notforprofit->add_field( array(
		'name'						=> __( 'Demonstrate the support from partners, customers and employees for your overall aims and objectives', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'notforprofit_demonstrate',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$notforprofit->add_field( array(
		'name'						=> __( 'Give details of significant partnerships and what the key objectives are', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'notforprofit_details',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$notforprofit->add_field( array(
		'name'						=> __( 'Describe the key measures of high performance of the organisation', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'notforprofit_performance',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$notforprofit->add_field( array(
		'name'						=> __( 'Describe the legacy of your organisation as a result of this year&rsquo;s activity', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'notforprofit_legacy',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$notforprofit->add_field( array(
		'name'						=> __( 'Any further information you feel would support this entry', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'notforprofit_information',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	/**
	 * Community
	 */

	$community = new_cmb2_box( array(
		'id'           => $prefix . 'community',
		'title'				 => __( 'Contribution to the Community Award', 'ctba-entries-2016' ),
		'object_types' => array( 'ctba-entries', ),
		//'hookup'       => false,
		//'save_fields'  => false,
		'context'			 => 'normal',
		'priority'		 => 'default',
		'show_names'	 => 'true',
	) );

	$community->add_field( array(
		'name'						=> __( 'Please provide details of your organisation&rsquo;s corporate responsibility policy and outline your entitlemnet to be termed &lsquo;a good corporate citizen&rsquo;', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'community_good',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$community->add_field( array(
		'name'						=> __( 'How is your organnisation&rsquo;s policy implemented and how is this embedded within your organisation', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'community_how',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$community->add_field( array(
		'name'						=> __( 'Explain any successes your company has had through product innovation', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'community_explain',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$community->add_field( array(
		'name'						=> __( 'What engagement do you and your employees have with the communities in which your organisation operates', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'community_engagement',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$community->add_field( array(
		'name'						=> __( 'Outline any successes your company has had with sales growth', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'community_successes',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$community->add_field( array(
		'name'						=> __( 'What engagement do you and your employees have with the communities in which your organisation operates', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'community_engagement',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$community->add_field( array(
		'name'						=> __( 'Please provide details of any charitable/community activities or exceptional projects that your organisation has been involved in over the last 12 months', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'community_details',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	/**
	 * International Trade
	 */

	$trade = new_cmb2_box( array(
		'id'           => $prefix . 'trade',
		'title'				 => __( 'International Trade Award', 'ctba-entries-2016' ),
		'object_types' => array( 'ctba-entries', ),
		//'hookup'       => false,
		//'save_fields'  => false,
		'context'			 => 'normal',
		'priority'		 => 'default',
		'show_names'	 => 'true',
	) );

	$trade->add_field( array(
		'name'						=> __( 'Describe the products/services that have been successful internationally', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'trade_products',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$trade->add_field( array(
		'name'						=> __( 'What proportions of your total sales are international', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'trade_proportions',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$trade->add_field( array(
		'name'						=> __( 'What strategy has been used to drive your international activity', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'trade_strategy',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$trade->add_field( array(
		'name'						=> __( 'Describe the involvement by local companies or authorities in your international success', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'trade_local',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$trade->add_field( array(
		'name'						=> __( 'Describe any new markets (i.e. countries) that you have traded in/to', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'trade_markets',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$trade->add_field( array(
		'name'						=> __( 'What is your strategy for the future in terms of international activity', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'trade_future_strategy',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$trade->add_field( array(
		'name'						=> __( 'Demonstrate the growth of your international activity', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'trade_growth',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$trade->add_field( array(
		'name'						=> __( 'What is the one key thing that has underpinned your international success and underpins this award nomination?', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'trade_nomination',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$trade->add_field( array(
		'name'						=> __( 'Any further information you feel would support this entry', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'trade_information',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	/**
	 * Creative
	 */

	$creative = new_cmb2_box( array(
		'id'           => $prefix . 'creative',
		'title'				 => __( 'Creative Industries Business of the Year', 'ctba-entries-2016' ),
		'object_types' => array( 'ctba-entries', ),
		//'hookup'       => false,
		//'save_fields'  => false,
		'context'			 => 'normal',
		'priority'		 => 'default',
		'show_names'	 => 'true',
	) );

	$creative->add_field( array(
		'name'						=> __( 'How do you stimulate original ideas in your business', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'creative_stimulate',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$creative->add_field( array(
		'name'						=> __( 'Give examples of your personal/business creativity', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'creative_examples',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$creative->add_field( array(
		'name'						=> __( 'How have you applied creativity to producrs, services or business challenges', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'creative_applied',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$creative->add_field( array(
		'name'						=> __( 'What contribution to creative industries have you made regionally to your industry/sector', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'creative_contribution',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$creative->add_field( array(
		'name'						=> __( 'Give an example of work done for a client that you feel establishes your business as a creative industry leader', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'creative_work',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$creative->add_field( array(
		'name'						=> __( 'How will your breative business continue to  adapt to the changing economic environment to ensure its future success', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'creative_success',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$creative->add_field( array(
		'name'						=> __( 'Any further information you feel would support this entry', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'creative_information',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	/**
	 * Retail
	 */

	$retail = new_cmb2_box( array(
		'id'           => $prefix . 'retail',
		'title'				 => __( 'Retail Business of the Year Award', 'ctba-entries-2016' ),
		'object_types' => array( 'ctba-entries', ),
		//'hookup'       => false,
		//'save_fields'  => false,
		'context'			 => 'normal',
		'priority'		 => 'default',
		'show_names'	 => 'true',
	) );

	$retail->add_field( array(
		'name'						=> __( 'What strategy has been used to drive your company forward', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'retail_strategy',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$retail->add_field( array(
		'name'						=> __( 'What investment has been made in any equipment and infrastructure', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'retail_investment',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$retail->add_field( array(
		'name'						=> __( 'Describe how you ensure high quality customer service in your business', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'retail_customer',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$retail->add_field( array(
		'name'						=> __( 'Detail any ongoing commitment to staff development', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'retail_staff',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$retail->add_field( array(
		'name'						=> __( 'Detail any involvement your business has in online retailing', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'retail_online',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$retail->add_field( array(
		'name'						=> __( 'Outline any successes your company has had through innovation in products or services', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'retail_products',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$retail->add_field( array(
		'name'						=> __( 'Detail any sales, marketing and promotional activity that has had a significant beneficial impoact on your business', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'retail_marketing',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$retail->add_field( array(
		'name'						=> __( 'Any further information you feel would support this entry', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'retail_information',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	/**
	 * Science & Technology
	 */

	$technology = new_cmb2_box( array(
		'id'           => $prefix . 'technology',
		'title'				 => __( 'Excellence in Science &amp; Technology Award', 'ctba-entries-2016' ),
		'object_types' => array( 'ctba-entries', ),
		//'hookup'       => false,
		//'save_fields'  => false,
		'context'			 => 'normal',
		'priority'		 => 'default',
		'show_names'	 => 'true',
	) );

	$technology->add_field( array(
		'name'						=> __( 'Describe how investment in science and technology has enhanced your company', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'technology_investment',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$technology->add_field( array(
		'name'						=> __( 'What strategy has been used to drive your company forward', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'technology_strategy',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);
	$technology->add_field( array(
		'name'						=> __( 'What investment has been made into any equipment and infrastructure', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'technology_infrastructure',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$technology->add_field( array(
		'name'						=> __( 'Outline any successes your company has had through product innovation', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'technology_success',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$technology->add_field( array(
		'name'						=> __( 'Any further information you feel would support this entry', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'technology_information',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	/**
	 * Manufacturing
	 */

	$manufacturing = new_cmb2_box( array(
		'id'           => $prefix . 'manufacturing',
		'title'				 => __( 'Excellence in Manufacturing Award', 'ctba-entries-2016' ),
		'object_types' => array( 'ctba-entries', ),
		//'hookup'       => false,
		//'save_fields'  => false,
		'context'			 => 'normal',
		'priority'		 => 'default',
		'show_names'	 => 'true',
	) );

	$manufacturing->add_field( array(
		'name'						=> __( 'Describe the manufacturing process and products manufactured', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'manufacturing_process',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$manufacturing->add_field( array(
		'name'						=> __( 'Describe the specific technical aspects of your manufacturing process; include any relevant standards or approvals', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'manufacturing_technical',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$manufacturing->add_field( array(
		'name'						=> __( 'Explain your trading performance and growth patterns', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'manufacturing_trading',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$manufacturing->add_field( array(
		'name'						=> __( 'Give examples of manufacturing innovation or creativity', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'manufacturing_innovation',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$manufacturing->add_field( array(
		'name'						=> __( 'Give examples of investment in people and/or capital', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'manufacturing_investment',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$manufacturing->add_field( array(
		'name'						=> __( 'What new processes or products have been introduced', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'manufacturing_new',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$manufacturing->add_field( array(
		'name'						=> __( 'Briefly describe the market served both in the UK and abroad if applicable', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'manufacturing_market',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$manufacturing->add_field( array(
		'name'						=> __( 'Explain briefly your environmental practices', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'manufacturing_environmental',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$manufacturing->add_field( array(
		'name'						=> __( 'Are there any particular pressures or challenges that you have had to overcome from a manufactturing perspective? If so, how have you done this', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'manufacturing_challenges',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$manufacturing->add_field( array(
		'name'						=> __( 'Any further information you feel would support this entry', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'manufacturing_information',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	/**
	 * Sales & Marketing
	 */

	$marketing = new_cmb2_box( array(
		'id'           => $prefix . 'marketing',
		'title'				 => __( 'Sales &amp; Marketing Award', 'ctba-entries-2016' ),
		'object_types' => array( 'ctba-entries', ),
		//'hookup'       => false,
		//'save_fields'  => false,
		'context'			 => 'normal',
		'priority'		 => 'default',
		'show_names'	 => 'true',
	) );

	$marketing->add_field( array(
		'name'						=> __( 'What is the geographical scope of your customer/client base', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'marketing_geographical',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$marketing->add_field( array(
		'name'						=> __( 'What competitors do you have in the market(s) and how have you targeted your sales and marketing strategy effectively against them', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'marketing_competitors',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$marketing->add_field( array(
		'name'						=> __( 'How do you measure the effectiveness of your sales and marketing activities.', 'ctba-entries-2016' ),
		'description'			=> __( 'Explain how your customers/clients have reacted to your marketing initiatives', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'marketing_measure',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$marketing->add_field( array(
		'name'						=> __( 'Explain how your sales and marketing initiatives have benefited your business', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'marketing_benefits',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$marketing->add_field( array(
		'name'						=> __( 'To what extent have you opened up new markets, developed existing markets or brought further growth through effective sales and marketing', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'marketing_effective',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$marketing->add_field( array(
		'name'						=> __( 'Explain how e-commerce is incorporated into your sales and marketing strategy', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'marketing_online',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$marketing->add_field( array(
		'name'						=> __( 'Any further information you feel would support this entry', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'marketing_information',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	/**
	 * Services Award
	 */

	$services = new_cmb2_box( array(
		'id'           => $prefix . 'services',
		'title'				 => __( 'Services Award', 'ctba-entries-2016' ),
		'object_types' => array( 'ctba-entries', ),
		//'hookup'       => false,
		//'save_fields'  => false,
		'context'			 => 'normal',
		'priority'		 => 'default',
		'show_names'	 => 'true',
	) );

	$services->add_field( array(
		'name'						=> __( 'Please provide details of the geographical scope of your customer or client base', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'services_geographical',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$services->add_field( array(
		'name'						=> __( 'Please provide the names of 2 customers or clients who would be happy to endorse your award entry', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'services_endorse',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$services->add_field( array(
		'name'						=> __( 'Please provide details of an innovation within your company which has helped you to achieve your objectives', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'services_innovation',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$services->add_field( array(
		'name'						=> __( 'Please provide details of how you have created a competitive edge through service differentiation', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'services_competitive',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$services->add_field( array(
		'name'						=> __( 'Are you accredited with a quality standard? (Please specify)', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'services_standard',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$services->add_field( array(
		'name'						=> __( 'Are you pursuing accreditation?', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'services_accreditation',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$services->add_field( array(
		'name'						=> __( 'Any further information you feel would support this entry', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'services_information',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	/**
	 * Business Entrepreneur
	 */

	$entrepreneur = new_cmb2_box( array(
		'id'           => $prefix . 'entrepreneur',
		'title'				 => __( 'Business Entrepreneur of the Year', 'ctba-entries-2016' ),
		'object_types' => array( 'ctba-entries', ),
		//'hookup'       => false,
		//'save_fields'  => false,
		'context'			 => 'normal',
		'priority'		 => 'default',
		'show_names'	 => 'true',
	) );

	$entrepreneur->add_field( array(
		'id'   => $prefix . 'entrepreneur_pl',
		'name' => __( 'Profit &amp; Loss', 'ctba-entries-2016' ),
		'type' => 'title',
	) );

	// Turnover
	$entrepreneur->add_field( array(
		'name'    => __( 'Turnover (2014)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'entrepreneur_turnover_2014',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$entrepreneur->add_field( array(
		'name'    => __( 'Turnover (2015)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'entrepreneur_turnover_2015',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	// Net Profit

	$entrepreneur->add_field( array(
		'name'    => __( 'Net Profit (pre-tax) (2014)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'entrepreneur_netprofit_2014',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$entrepreneur->add_field( array(
		'name'    => __( 'Net Profit (pre-tax) (2015)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'entrepreneur_netprofit_2015',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$entrepreneur->add_field( array(
		'id'   => $prefix . 'entrepreneur_balance',
		'name' => __( 'Summary of last balance sheet', 'ctba-entries-2016' ),
		'type' => 'title',
	) );

	// Fixed Assets

	$entrepreneur->add_field( array(
		'name'    => __( 'Fixed Assets (2014)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'entrepreneur_fixedassets_2014',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$entrepreneur->add_field( array(
		'name'    => __( 'Fixed Assets (2015)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'entrepreneur_fixedassets_2015',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	// Net Current Assets

	$entrepreneur->add_field( array(
		'name'    => __( 'Net Current Assets (2014)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'entrepreneur_currentassets_2014',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$entrepreneur->add_field( array(
		'name'    => __( 'Net Current Assets (2015)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'entrepreneur_currentassets_2015',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	// Net Assets

	$entrepreneur->add_field( array(
		'name'    => __( 'Net Assets (2014)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'entrepreneur_netassets_2014',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$entrepreneur->add_field( array(
		'name'    => __( 'Net Assets (2015)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'entrepreneur_netassets_2015',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	// Financed by

	$entrepreneur->add_field( array(
		'id'   => $prefix . 'entrepreneur_finance',
		'name' => __( 'Financed by', 'ctba-entries-2016' ),
		'type' => 'title',
	) );

	// Share Capital

	$entrepreneur->add_field( array(
		'name'    => __( 'Share Capital (2014)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'entrepreneur_sharecapital_2014',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$entrepreneur->add_field( array(
		'name'    => __( 'Share Capital (2015)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'entrepreneur_sharecapital_2015',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	// Retained Profit

	$entrepreneur->add_field( array(
		'name'    => __( 'Retained Profit (2014)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'entrepreneur_retainedprofit_2014',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$entrepreneur->add_field( array(
		'name'    => __( 'Retained Profit (2015)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'entrepreneur_retainedprofit_2015',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	// Other Reserves

	$entrepreneur->add_field( array(
		'name'    => __( 'Other Reserves (2014)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'entrepreneur_otherreserves_2014',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$entrepreneur->add_field( array(
		'name'    => __( 'Other Reserves (2015)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'entrepreneur_otherreserves_2015',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	// Long Term Loans

	$entrepreneur->add_field( array(
		'name'    => __( 'Long Term Loans (2014)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'entrepreneur_longtermloans_2014',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$entrepreneur->add_field( array(
		'name'    => __( 'Long Term Loans (2015)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'entrepreneur_longtermloans_2015',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	// No of Employees

	$entrepreneur->add_field( array(
		'name'    => __( 'No. of Employees (2014)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'entrepreneur_employees_2014',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$entrepreneur->add_field( array(
		'name'    => __( 'No. of Employees (2015)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'entrepreneur_employees_2015',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$entrepreneur->add_field( array(
		'name'						=> __( 'Explain your own personal business philosophy', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'entrepreneur_philosophy',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$entrepreneur->add_field( array(
		'name'						=> __( 'Explain any successes your company has had in exploiting new opportuniities', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'entrepreneur_success',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$entrepreneur->add_field( array(
		'name'						=> __( 'Why do you think your personal contribution has made a tangible difference to your business(es)', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'entrepreneur_personal',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$entrepreneur->add_field( array(
		'name'						=> __( 'What examples can you give of the contribution your leadership has made', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'entrepreneur_leadership',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$entrepreneur->add_field( array(
		'name'						=> __( 'What contribution have you made regionally to your industry / sector', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'entrepreneur_regional',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$entrepreneur->add_field( array(
		'name'						=> __( 'How have you developed a strong working relationship with both new and existing clients', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'entrepreneur_relationship',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$entrepreneur->add_field( array(
		'name'						=> __( 'Any further information you feel would support this entry', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'entrepreneur_information',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	/**
	 * New Business of the Year
	 */

	$newbusiness = new_cmb2_box( array(
		'id'           => $prefix . 'newbusiness',
		'title'				 => __( 'New Business of the Year', 'ctba-entries-2016' ),
		'object_types' => array( 'ctba-entries', ),
		//'hookup'       => false,
		//'save_fields'  => false,
		'context'			 => 'normal',
		'priority'		 => 'default',
		'show_names'	 => 'true',
	) );

	$newbusiness->add_field( array(
		'id'   => $prefix . 'newbusiness_figures',
		'name' => __( 'Company figures', 'ctba-entries-2016' ),
		'type' => 'title',
	) );

	// Sales
	$newbusiness->add_field( array(
		'name'    => __( 'Sales (2014)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'newbusiness_sales_2014',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$newbusiness->add_field( array(
		'name'    => __( 'Sales (2015)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'newbusiness_sales_2015',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$newbusiness->add_field( array(
		'name'    => __( 'Sales (Forecast this year)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'newbusiness_sales_this',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$newbusiness->add_field( array(
		'name'    => __( 'Sales (Forecast next year)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'newbusiness_sales_next',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	// Net Profits
	$newbusiness->add_field( array(
		'name'    => __( 'Net Profits (2014)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'newbusiness_netprofit_2014',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$newbusiness->add_field( array(
		'name'    => __( 'Net Profits (2015)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'newbusiness_netprofit_2015',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$newbusiness->add_field( array(
		'name'    => __( 'Net Profits (Forecast this year)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'newbusiness_netprofit_this',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$newbusiness->add_field( array(
		'name'    => __( 'Net Profits (Forecast next year)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'newbusiness_netprofit_next',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	// No. of Employees
	$newbusiness->add_field( array(
		'name'    => __( 'No. of Employees (2014)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'newbusiness_employees_2014',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$newbusiness->add_field( array(
		'name'    => __( 'No. of Employees (2015)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'newbusiness_employees_2015',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$newbusiness->add_field( array(
		'name'    => __( 'No. of Employees (Forecast this year)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'newbusiness_employees_this',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$newbusiness->add_field( array(
		'name'    => __( 'No. of Employees (Forecast next year)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'newbusiness_employees_next',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$newbusiness->add_field( array(
		'name'						=> __( 'What were the initial objectives of the business? How has the business met or exceeed these goals', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'newbusiness_goals',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$newbusiness->add_field( array(
		'name'						=> __( 'If the business started as a result of a venture capital, please explain that involvement', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'newbusiness_venturecapital',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$newbusiness->add_field( array(
		'name'						=> __( 'What difficulties has the business faced in its particular markets', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'newbusiness_difficulties',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$newbusiness->add_field( array(
		'name'						=> __( 'What success has the business had with exploiting new opportunities, product or marketing innovation leading to sales growth', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'newbusiness_success',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$newbusiness->add_field( array(
		'name'						=> __( 'What evidence is there to show that the business has established a position for sustainable future success', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'newbusiness_sustainable',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$newbusiness->add_field( array(
		'name'						=> __( 'How have you maximised the usage of resources, advisors and information available to you to improve business performance', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'newbusiness_performance',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$newbusiness->add_field( array(
		'name'						=> __( 'How has the business developed and maintained good relationships with customers or clients and suppliers (please provide examples)', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'newbusiness_relationship',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$newbusiness->add_field( array(
		'name'						=> __( 'Any further information you feel would support this entry', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'newbusiness_information',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	/**
	 * Small Business of the Year
	 */

	$smallbusiness = new_cmb2_box( array(
		'id'           => $prefix . 'smallbusiness',
		'title'				 => __( 'Small Business of the Year', 'ctba-entries-2016' ),
		'object_types' => array( 'ctba-entries', ),
		//'hookup'       => false,
		//'save_fields'  => false,
		'context'			 => 'normal',
		'priority'		 => 'default',
		'show_names'	 => 'true',
	) );

	$smallbusiness->add_field( array(
		'id'   => $prefix . 'smallbusiness_figures',
		'name' => __( 'Company figures', 'ctba-entries-2016' ),
		'type' => 'title',
	) );

	// Sales
	$smallbusiness->add_field( array(
		'name'    => __( 'Sales (2014)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'smallbusiness_sales_2014',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$smallbusiness->add_field( array(
		'name'    => __( 'Sales (2015)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'smallbusiness_sales_2015',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$smallbusiness->add_field( array(
		'name'    => __( 'Sales (Forecast this year)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'smallbusiness_sales_this',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$smallbusiness->add_field( array(
		'name'    => __( 'Sales (Forecast next year)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'smallbusiness_sales_next',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	// Net Profits
	$smallbusiness->add_field( array(
		'name'    => __( 'Net Profits (2014)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'smallbusiness_netprofit_2014',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$smallbusiness->add_field( array(
		'name'    => __( 'Net Profits (2015)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'smallbusiness_netprofit_2015',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$smallbusiness->add_field( array(
		'name'    => __( 'Net Profits (Forecast this year)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'smallbusiness_netprofit_this',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$smallbusiness->add_field( array(
		'name'    => __( 'Net Profits (Forecast next year)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'smallbusiness_netprofit_next',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	// No. of Employees
	$smallbusiness->add_field( array(
		'name'    => __( 'No. of Employees (2014)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'smallbusiness_employees_2014',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$smallbusiness->add_field( array(
		'name'    => __( 'No. of Employees (2015)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'smallbusiness_employees_2015',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$smallbusiness->add_field( array(
		'name'    => __( 'No. of Employees (Forecast this year)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'smallbusiness_employees_this',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$smallbusiness->add_field( array(
		'name'    => __( 'No. of Employees (Forecast next year)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'smallbusiness_employees_next',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$smallbusiness->add_field( array(
		'name'    => __( 'financial Year End Date (DD/MM)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'smallbusiness_yearend',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$smallbusiness->add_field( array(
		'name'						=> __( 'What is the market for your product/service?', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'smallbusiness_market',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$smallbusiness->add_field( array(
		'name'						=> __( 'Give details of any market research undertaken', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'smallbusiness_research',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$smallbusiness->add_field( array(
		'name'						=> __( 'What export potential does your product/service have', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'smallbusiness_export',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$smallbusiness->add_field( array(
		'name'						=> __( 'Highlight any design or inovation features', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'smallbusiness_features',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$smallbusiness->add_field( array(
		'name'						=> __( 'Indicate the ambitions for the future of the business', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'smallbusiness_future',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$smallbusiness->add_field( array(
		'name'						=> __( 'Any further information you feel would support this entry', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'smallbusiness_information',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	/**
	 * Company of the Year
	 */

	$companyyear = new_cmb2_box( array(
		'id'           => $prefix . 'companyyear',
		'title'				 => __( 'Company of the Year', 'ctba-entries-2016' ),
		'object_types' => array( 'ctba-entries', ),
		//'hookup'       => false,
		//'save_fields'  => false,
		'context'			 => 'normal',
		'priority'		 => 'default',
		'show_names'	 => 'true',
	) );

	$companyyear->add_field( array(
		'id'   => $prefix . 'companyyear_pl',
		'name' => __( 'Profit &amp; Loss', 'ctba-entries-2016' ),
		'type' => 'title',
	) );

	// Turnover
	$companyyear->add_field( array(
		'name'    => __( 'Turnover (2014)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'companyyear_turnover_2014',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$companyyear->add_field( array(
		'name'    => __( 'Turnover (2015)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'companyyear_turnover_2015',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	// Net Profit

	$companyyear->add_field( array(
		'name'    => __( 'Net Profit (pre-tax) (2014)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'companyyear_netprofit_2014',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$companyyear->add_field( array(
		'name'    => __( 'Net Profit (pre-tax) (2015)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'companyyear_netprofit_2015',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$companyyear->add_field( array(
		'id'   => $prefix . 'companyyear_balance',
		'name' => __( 'Summary of last balance sheet', 'ctba-entries-2016' ),
		'type' => 'title',
	) );

	// Fixed Assets

	$companyyear->add_field( array(
		'name'    => __( 'Fixed Assets (2014)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'companyyear_fixedassets_2014',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$companyyear->add_field( array(
		'name'    => __( 'Fixed Assets (2015)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'companyyear_fixedassets_2015',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	// Net Current Assets

	$companyyear->add_field( array(
		'name'    => __( 'Net Current Assets (2014)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'companyyear_currentassets_2014',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$companyyear->add_field( array(
		'name'    => __( 'Net Current Assets (2015)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'companyyear_currentassets_2015',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	// Net Assets

	$companyyear->add_field( array(
		'name'    => __( 'Net Assets (2014)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'companyyear_netassets_2014',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$companyyear->add_field( array(
		'name'    => __( 'Net Assets (2015)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'companyyear_netassets_2015',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	// Financed by

	$companyyear->add_field( array(
		'id'   => $prefix . 'companyyear_finance',
		'name' => __( 'Financed by', 'ctba-entries-2016' ),
		'type' => 'title',
	) );

	// Share Capital

	$companyyear->add_field( array(
		'name'    => __( 'Share Capital (2014)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'companyyear_sharecapital_2014',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$companyyear->add_field( array(
		'name'    => __( 'Share Capital (2015)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'companyyear_sharecapital_2015',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	// Retained Profit

	$companyyear->add_field( array(
		'name'    => __( 'Retained Profit (2014)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'companyyear_retainedprofit_2014',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$companyyear->add_field( array(
		'name'    => __( 'Retained Profit (2015)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'companyyear_retainedprofit_2015',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	// Other Reserves

	$companyyear->add_field( array(
		'name'    => __( 'Other Reserves (2014)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'companyyear_otherreserves_2014',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$companyyear->add_field( array(
		'name'    => __( 'Other Reserves (2015)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'companyyear_otherreserves_2015',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	// Long Term Loans

	$companyyear->add_field( array(
		'name'    => __( 'Long Term Loans (2014)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'companyyear_longtermloans_2014',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$companyyear->add_field( array(
		'name'    => __( 'Long Term Loans (2015)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'companyyear_longtermloans_2015',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	// No of Employees

	$companyyear->add_field( array(
		'name'    => __( 'No. of Employees (2014)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'companyyear_employees_2014',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$companyyear->add_field( array(
		'name'    => __( 'No. of Employees (2015)', 'ctba-entries-2016' ),
		'id'      => $prefix . 'companyyear_employees_2015',
		'type'    => 'text',
		'default' => 'ctba_entries_set_default',
		'attributes'  => array(),
	) );

	$companyyear->add_field( array(
		'name'						=> __( 'Explain any successes your company has had exploiting new opportunities', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'companyyear_opportunities',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$companyyear->add_field( array(
		'name'						=> __( 'Outline any successes you have had with quality improvements', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'companyyear_quality',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);
	$companyyear->add_field( array(
		'name'						=> __( 'Explain any successes your company has had through product innovation', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'companyyear_innovation',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$companyyear->add_field( array(
		'name'						=> __( 'Explain any success your company has had through production improvements', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'companyyear_product',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$companyyear->add_field( array(
		'name'						=> __( 'Outline any successes your company has had with sales growth', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'companyyear_sales',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$companyyear->add_field( array(
		'name'						=> __( 'What contribution have you made regionally to your industry/sector', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'companyyear_regionally',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	$companyyear->add_field( array(
		'name'						=> __( 'Any further information you feel would support this entry', 'ctba-entries-2016' ),
		'id' 							=> $prefix . 'companyyear_information',
		'type'						=> 'textarea',
		'default'					=> 'ctba_entries_set_default',
		'attributes'			=> array(),
		)
	);

	/**
	 * Additional
	 */

	$additional = new_cmb2_box( array(
		'id'           => $prefix . 'additional',
		'title'				 => __( 'Confirm your entry', 'ctba-entries-2016' ),
		'object_types' => array( 'ctba-entries', ),
		//'hookup'       => false,
		//'save_fields'  => false,
		'context'			 => 'normal',
		'priority'		 => 'default',
		'show_names'	 => 'true',
	) );

	$additional->add_field( array(
		'name'             => __( 'Will you be sending additional supporting evidence?', 'ctba-entries-2016' ),
		'description'			 => __( '‘if you wish to include any supporting documents please email your information to Katy Hedge at khedge@championsukplc.com.', 'ctba-entries-2016' ),
		'id'               => 'ctba_entries_2016_additional_evidence',
		'type'             => 'radio',
		'show_option_none' => false,
		'options'          => array(
		'yes'		=> __( 'Yes', 'ctba-entries-2016' ),
		'no'		=> __( 'No', 'ctba-entries-2016' ),
		),
	) );

	$additional->add_field( array(
		'name'							=> __( 'Finalise Submission', 'ctba-entries-2016' ),
		'description'				=> __( 'Please tick to finalise the submission of this entry and you have agreed to the T&C&rsquo;s.', 'ctba-entries-2016' ),
		'id'								=> 'ctba_entries_2016_additional_submit',
		'type'							=> 'checkbox',
	) );

}
add_action( 'cmb2_init', 'ctba_entries_2016_form' );

/**
 * Gets the front-end-post-form cmb instance
 *
 * @return CMB2 object
 */
function wds_frontend_cmb2_get( $metabox_id, $object_id ) {
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
	if ( ( get_post_type( $_POST['object_id'] ) !== 'ctba-entries' ) && ( $_POST['object_id'] != 0 ) && ( $_POST['object_id'] < 0 ) ) {
		remove_query_arg( 'entry' );
		wp_redirect( home_url( $path = 'nominate/entry' ) );
	}

	// If no form submission, bail
	if ( empty( $_POST ) || ! isset( $_POST['submit-cmb'], $_POST['object_id'] ) ) {
		return false;
	}
	// Get CMB2 metabox object
	$cmb = wds_frontend_cmb2_get( '_ctba_entries_2016_common', 'fake-object-id' );
	$post_data = array();

	// Check security nonce
	if ( ! isset( $_POST[ $cmb->nonce() ] ) || ! wp_verify_nonce( $_POST[ $cmb->nonce() ], $cmb->nonce() ) ) {
		return $cmb->prop( 'submission_error', new WP_Error( 'security_fail', __( 'Security check failed.' ) ) );
	}

	// Check Post ID is valid
	/*if ( (! is_int( $_POST['object_id'] ) ) || ( ! $_POST['object_id'] >= 0 ) || floor( $_POST['object_id'] ) !== $_POST['object_id']  ) {
		return $cmb->prop( 'submission_error', new WP_Error( 'post_data_missing', __( 'Cannot submit your entry. Please try again' ) ) );
	}*/

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
	$post_data['post_status'] = ( 'on' === $_POST['ctba_entries_2016_additional_submit'] ? 'publish' : 'pending' );

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
			if ( ! empty( $value ) ) {
				update_post_meta( $new_submission_id, $key, $value );
			}
		} else {
			update_post_meta( $new_submission_id, $key, $value );
		}
	}

	$array = array(
		'_ctba_entries_2016_notforprofit',
		'_ctba_entries_2016_community',
		'_ctba_entries_2016_trade',
		'_ctba_entries_2016_creative',
		'_ctba_entries_2016_retail',
		'_ctba_entries_2016_technology',
		'_ctba_entries_2016_manufacturing',
		'_ctba_entries_2016_marketing',
		'_ctba_entries_2016_services',
		'_ctba_entries_2016_entrepreneur',
		'_ctba_entries_2016_newbusiness',
		'_ctba_entries_2016_smallbusiness',
		'_ctba_entries_2016_companyyear',
		'_ctba_entries_2016_additional',
	);

	foreach ( $array as $array_key ) {

		$origianl_data = wds_frontend_cmb2_get( $array_key, 'fake-oject-id' );
		$sanitized_data = $origianl_data->get_sanitized_values( $_POST );

		foreach ( $sanitized_data as $key => $value ) {
			if ( is_array( $value ) ) {
				$value = array_filter( $value );
				if ( ! empty( $value ) ) {
					update_post_meta( $new_submission_id, $key, $value );
				}
			} else {
				update_post_meta( $new_submission_id, $key, $value );
			}
		}
	}

	// Remove any previous entry query arguments
	remove_query_arg( 'entry' );
	/**
	 * Redirect back to the form page with a query variable with the new post ID.
	 * This will help double-submissions with browser refreshes
	 */
	if ( 'on' === $_POST['ctba_entries_2016_additional_submit'] ) {
		wp_redirect(
			esc_url_raw(
				add_query_arg(
					array(
						'status' => 'submitted',
					),
					home_url( '/nominate/dashboard/' )
				)
			)
		);
		exit;
	}

	wp_redirect(
		esc_url_raw(
			add_query_arg(
				array(
					'entry' => $new_submission_id,
					'status' => 'saved',
				)
			)
		)
	);
	exit;
}

add_action( 'cmb2_after_init', 'ctba_cntries_2016_handle_frontend_post_form_submission' );


/**
 * Export Entires
 */
add_action(
	'admin_menu',
	'ctba_entries_2016_export_page'
);

/**
 * Create export page
 */
function ctba_entries_2016_export_page() {
	add_submenu_page(
		'edit.php?post_type=ctba-entries',
		__( 'Export Entires', 'ctba-entries-2016' ),
		__( 'Export', 'ctba-entries-2016' ),
		'edit_pages',
		'ctba-entries-export',
		'ctba_entries_2016_export_page_content'
	);
}

/**
 * Export page content
 */
function ctba_entries_2016_export_page_content() {

	printf( '<h1>%1$s</h1>', esc_html( get_admin_page_title() ) );

	esc_html_e( 'Export entries feature description.', 'ctba-entries-2016' );

}
