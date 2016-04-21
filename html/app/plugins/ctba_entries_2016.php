<?php
/**
 * Plugin Name: CTBA Entries 2016 v3
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
		$value = get_post_meta( (int) $entry, $field_args[ id ], true );
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
		'type'    => 'number',
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
		'options' =>
		array(
			'not-for-profit' => __( 'Not-for-profit Organisation', 'ctba-entries-2016' ),
			'community' => __( 'Contribution to the Community', 'ctba-entries-2016' ),
			'international-trade' => __( 'International Trade', 'ctba-entries-2016' ),
			'creative-industries' => __( 'Creative Industries Business of the Year', 'ctba-entries-2016' ),
			'retail' => __( 'Retail Business of the Year', 'ctba-entries-2016' ),
			'science-technology' => __( 'Excellence in Science and Technology', 'ctba-entries-2016' ),
			'manufacturing' => __( 'Excellence in Manufacturing', 'ctba-entries-2016' ),
			'sales-marketing' => __( 'Sales and Marketing', 'ctba-entries-2016' ),
			'legal' => __( 'Legal Services', 'ctba-entries-2016' ),
			'financial' => __( 'Financial Services', 'ctba-entries-2016' ),
			'entrepreneur' => __( 'Business Entrepreneur of the Year', 'ctba-entries-2016' ),
			'new-business' => __( 'New Business of the Year', 'ctba-entries-2016' ),
			'small-business' => __( 'Small Business of the Year', 'ctba-entries-2016' ),
			'company-of-the-year' => __( 'Company of the Year', 'ctba-entries-2016' ),
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
		'id' 							=> $prefix . 'notforprofit_details',
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
		'name'						=> __( 'Please provide details of your organisation&rsquo;s corporate responsibility polict and outline your entitlemnet to be termed &lsquo;a good corporate citizen&rsquo;', 'ctba-entries-2016' ),
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
		'id' 							=> $prefix . 'manufacturing_challenges',
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
		'name' => __( 'By Submitting this entry, I certify that the particulars given are correct to the best of my knowledge and belief.', 'ctba-entries-2016' ),
		'id'   => 'ctba_entries_2016_additional_submit',
		'type' => 'checkbox',
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
			if ( ! empty( $value ) ) {
				update_post_meta( $new_submission_id, $key, $value );
			}
		} else {
			update_post_meta( $new_submission_id, $key, $value );
		}
	}

	$array = array(
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
	wp_redirect( esc_url_raw( add_query_arg( 'entry', $new_submission_id ) ) );
	exit;
}
add_action( 'cmb2_after_init', 'ctba_cntries_2016_handle_frontend_post_form_submission' );
