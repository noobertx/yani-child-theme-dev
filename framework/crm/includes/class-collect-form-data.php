<?php
if ( ! class_exists( 'yani_Collect_Form_Data' ) ) {

	class yani_Collect_Form_Data {

		private $lead_obj;
		private $enquiry_obj;

		public function __construct() {

			$this->lead_obj = new yani_Leads();
			$this->enquiry_obj = new yani_Enquiry();

			add_action( 'yani_after_agent_form_submission', array( $this, 'save_form_data' ) );
			add_action( 'yani_after_contact_form_submission', array( $this, 'save_form_data' ) );
			add_action( 'yani_after_estimation_form_submission', array( $this, 'save_form_data' ) );
		}

		public function save_form_data() {
			
			//$lead_id = $this->lead_obj->lead_exist();

			$lead_id = $this->lead_obj->save_lead();
			

			if( (isset($_POST['is_listing_form']) && $_POST['is_listing_form'] == 'yes') || (isset($_POST['is_estimation']) && $_POST['is_estimation'] == 'yes') ) {
				$this->enquiry_obj->save_enquiry($lead_id);
			}
			
		}

		

	}
	new yani_Collect_Form_Data();
}