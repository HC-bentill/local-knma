<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Reportmodel');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->helper('mixins');
		
		if($this->session->userdata('user_info')['id'] == ''){
			redirect('login');
		}

		if($this->session->userdata('user_info')['first_login'] == 0){
			redirect('change_passwordd');
		}
	}
	
	//	page structure
	public function load_page($data)
    {
        $this->load->view('page_layout/layout',$data);
    }
	
	//	load data report page	
	public function data_report(){
		//set last page session
		$this->session->set_userdata('last_page', 'data_report');
		buildBreadCrumb(array(
			"url" => "data_report",
			"label" => "Data Report"
		), TRUE);
		$data = array(
			'title' => 'Data Report',
			'page' => 'report/data_report',
			'education' => $this->Reportmodel->get_edu(),
			'profession' => $this->Reportmodel->get_prof(),
		);
		$this->load_page($data);
	}

	private function getFinanceReportData($reportData) {
		$selectedYear = $reportData['selected_year'];
		$lowerDateBound = $reportData['lower_date_bound'];
		$upperDateBound = $reportData['upper_date_bound'];

		$data = array_merge(
			array(
				'total_revenue' => $this->Reportmodel->total_revenue(
					$selectedYear, $lowerDateBound, $upperDateBound
				),
				'area_council_total_revenue' => 
					$this->Reportmodel->area_council_total_revenue(
						$selectedYear, $lowerDateBound, $upperDateBound
					),
				// 'revenue_per_streams' =>
				// 	$this->Reportmodel->revenue_per_streams(
				// 		$selectedYear, $lowerDateBound, $upperDateBound
				// 	),
			),
			$reportData
		);
		return $data;
	}

	//	load finance report page
	public function finance_report(){
		
		//set last page session
		$this->session->set_userdata('last_page', 'finance_report');
		buildBreadCrumb(array(
			"url" => "finance_report",
			"label" => "Finance Report"
		), TRUE);

		$otherData = $this->processFinanceReportDateArgs();
		$error_message = NULL;
		if (array_key_exists('error_message', $otherData)) {
			$error_message = $otherData['error_message'];
			$this->session->set_flashdata(
				'message', "<div class='alert alert-danger'>
					<strong>Oh Snap! </strong> $error_message
				</div>"
			);
			redirect(base_url('Report/finance_report'));
		}

		$data = array_merge(
			array(
				'title' => 'Finance Report',
				'page' => 'report/finance_report'
			),
			$this->getFinanceReportData($otherData),
			$otherData
		);
		$this->load_page($data);
	}
	
    public function download_finance_report($format) {
		$otherData = $this->processFinanceReportDateArgs();
		$data = $this->getFinanceReportData($otherData);
		if ($format == "excel") {
			echo var_dump($data);
		} else if ($format == "pdf") {
			echo "pdf";
		}
	}

	//	load finance report page
	public function finance_report2(){
		buildBreadCrumb(array(
			"url" => "finance_report2",
			"label" => "Per Revenue Stream"
		));
		$otherData = $this->processFinanceReportDateArgs();
		$error_message = NULL;
		if (array_key_exists('error_message', $otherData)) {
			$error_message = $otherData['error_message'];
			$this->session->set_flashdata(
				'message', "<div class='alert alert-danger'>
					<strong>Oh Snap! </strong> $error_message
				</div>"
			);
			redirect(base_url('Report/finance_report2'));
		}
		$data = array_merge(
			array(
				'title' => 'Finance Report',
				'page' => 'report/finance_report2',
				'revenue_per_streams' => 
					$this->Reportmodel->revenue_per_streams(
						$otherData['selected_year'],
						$otherData['lower_date_bound'],
						$otherData['upper_date_bound']
					)
			),
			$otherData
		);
		$this->load_page($data);
	}

	//	load finance report page
	public function finance_report3(){
		buildBreadCrumb(array(
			"url" => "finance_report3",
			"label" => "Per Business Type"
		));
		$otherData = $this->processFinanceReportDateArgs();
		$error_message = NULL;
		if (array_key_exists('error_message', $otherData)) {
			$error_message = $otherData['error_message'];
			$this->session->set_flashdata(
				'message', "<div class='alert alert-danger'>
					<strong>Oh Snap! </strong> $error_message
				</div>"
			);
			redirect(base_url('Report/finance_report3'));
		}
		$data = array_merge(
			array(
				'title' => 'Finance Report',
				'page' => 'report/finance_report3',
				'revenue_per_bustype' => 
					$this->Reportmodel->revenue_per_business_type(
						$otherData['selected_year'],
						$otherData['lower_date_bound'],
						$otherData['upper_date_bound']
					)
			),
			$otherData
		);
		$this->load_page($data);
	}

	//	load finance report page
	public function get_towns_area($id,$channel){
		buildBreadCrumb(array(
			"label" => "Town Breakdown by $channel",
			"url" => "Report/get_towns_area/$id/$channel"
		));
		$town = $this->Reportmodel->get_towns($id);
		if($channel == "Gender"){
			$data = array(
				'title' => 'Gender / Towns',
				'page' => 'report/gender_town',
				'town' => $town

			);
			$this->load_page($data);
		}elseif($channel == "Employment"){
			$data = array(
				'title' => 'Employment / Towns',
				'page' => 'report/employment_town',
				'town' => $town

			);
			$this->load_page($data);
		}elseif($channel == "Data"){
			$data = array(
				'title' => 'Data / Towns',
				'page' => 'report/data_town',
				'town' => $town

			);
			$this->load_page($data);
		}elseif($channel == "com_needs"){
			$area_council = $this->Reportmodel->get_area_council_name($id);
			$data = array(
				'title' => 'Community Needs / Area Council',
				'page' => 'report/com_needs_town',
				'header' => '"Statistic On Top 5 Community Needs In '.$area_council.' Area Council."',
				'town' => $town,
				'graph_data' => get_com_need_area_stats($id)
			);
			$this->load_page($data);
		}
	}

	//	load finance report page
	public function educational_town($id,$edu_id){
		$town = $this->Reportmodel->get_towns($id);
		buildBreadCrumb(array(
			"url" => "Report/educational_town/$id/$edu_id",
			"label" => "Highest Eduction / Towns"
		));
		$data = array(
			'title' => 'Highest Education / Towns',
			'page' => 'report/edu_town',
			'town' => $town,
			'edu_id' => $edu_id

		);
		$this->load_page($data);
	}

	//	load finance report page
	public function get_com_towns($id){
		$town = $this->Reportmodel->get_town_name($id);
		buildBreadCrumb(array(
			"label" => "$town Stats",
			"url" => "Report/get_com_towns/$id"
		));

		$data = array(
			'title' => 'Community Needs / Town',
			'page' => 'report/town_com',
			'header' => '"Statistic On Top 5 Community Needs In '.$town.' Town."',
			'graph_data' => get_com_need_town_stats($id)

		);
		$this->load_page($data);
	}

	//	load finance report page
	public function profession_town($id,$prof_id){
		$town = $this->Reportmodel->get_towns($id);
		buildBreadCrumb(array(
			"label" => "Suburb Profession Breakdown",
			"url" => "Report/profession_town/$id/$prof_id"
		));

		$data = array(
			'title' => 'Profession / Towns',
			'page' => 'report/prof_town',
			'town' => $town,
			'prof_id' => $prof_id

		);
		$this->load_page($data);
	}

	//	load finance report page
	public function gender_data(){
		$gender = $this->uri->segment(3);
		$area_council = $this->uri->segment(4);			
		
		if($area_council == ""){
			$result  = $this->Reportmodel->gender_data($gender);
		}else{
			$result =$this->Reportmodel->gender_area_council_data($gender,$area_council); 
		}
		$data = array(
			'title' => $gender,
			'page' => 'report/gender',
			'result' => $result

		);
		$this->load_page($data);
	}

	//	load data page
	public function data(){
		$data = urldecode($this->uri->segment(3));
		$area_council = $this->uri->segment(4);
		$data = str_replace(" ", "_", $data);
		$url = "Report/data/$data/$area_council";
		$rawData = str_replace("_", " ", $data);
		buildBreadCrumb(array(
			"url" => $url,
			"label" => "$area_council $rawData"
		));
		$data = $rawData;
		if($area_council == ""){
			$result  = $this->Reportmodel->data($data);
		}else{
			$result =$this->Reportmodel->area_council_data($data,$area_council); 
		}
		if($data == "Household"){
			$data = array(
				'title' => $data,
				'page' => 'report/gender',
				'result' => $result

			);
			$this->load_page($data);
		}elseif($data == "Residence"){
			$data = array(
				'title' => $data,
				'page' => 'report/residence',
				'result' => $result

			);
			$this->load_page($data);
		}elseif($data == "Business Property"){
			$data = array(
				'title' => $data,
				'page' => 'report/business',
				'result' => $result

			);
			$this->load_page($data);

		}elseif($data == "Business Occupants"){
			$data = array(
				'title' => $data,
				'page' => 'report/business_occ',
				'result' => $result

			);
			$this->load_page($data);

		}
	}

	//	load data page
	public function data_town_data(){
		$data = urldecode($this->uri->segment(3));
		$town = $this->uri->segment(4);			
		
		buildBreadCrumb(array(
			"url" => "Report/data_town_data/$data/$town",
			"label" => "$data"
		));

		if($data == "Household"){
			$data = array(
				'title' => $data,
				'page' => 'report/gender',
				'result' => $this->Reportmodel->town_data($data,$town)

			);
			$this->load_page($data);
		}elseif($data == "Residence"){
			$data = array(
				'title' => $data,
				'page' => 'report/residence',
				'result' => $this->Reportmodel->town_data($data,$town)

			);
			$this->load_page($data);
		}elseif($data == "Business Property"){
			$data = array(
				'title' => $data,
				'page' => 'report/business',
				'result' => $this->Reportmodel->town_data($data,$town)

			);
			$this->load_page($data);

		}elseif($data == "Business Occupants"){
			$data = array(
				'title' => $data,
				'page' => 'report/business_occ',
				'result' => $this->Reportmodel->town_data($data,$town)

			);
			$this->load_page($data);

		}
	}

	//	load finance report page
	public function gender_town_data(){
		$gender = $this->uri->segment(3);
		$townid = $this->uri->segment(4);
		buildBreadCrumb(array(
			"label" => "$gender",
			"url" => "Report/gender_town_data/$gender/$townid"
		));
		$data = array(
			'title' => $gender,
			'page' => 'report/gender',
			'result' => $this->Reportmodel->gender_town_data($gender,$townid),
		);
		$this->load_page($data);
	}

	//	load finance report page
	public function employment_data(){
		$employment = $this->uri->segment(3);
		$area_council = $this->uri->segment(4);			
		if($area_council == ""){
			$result  = $this->Reportmodel->employment_data($employment);
		}else{
			$result =$this->Reportmodel->employment_area_council_data($employment,$area_council); 
		}
		$data = array(
			'title' => $employment,
			'page' => 'report/gender',
			'result' => $result

		);
		$this->load_page($data);
	}

	//	load finance report page
	public function employment_town_data(){
		$employment = $this->uri->segment(3);
		$townid = $this->uri->segment(4);
		buildBreadCrumb(array(
			"url" => "Report/employment_town_data/$employment/$townid",
			"label" => "$employment details"
		));

		$data = array(
			'title' => $employment,
			'page' => 'report/gender',
			'result' => $this->Reportmodel->employment_town_data($employment,$townid),
		);
		$this->load_page($data);
	}


	//	load finance report page
	public function educational_data(){
		$edu_id = $this->uri->segment(3);			
		
		$data = array(
			'title' => $this->Reportmodel->get_eduname($edu_id),
			'page' => 'report/gender',
			'result' => $this->Reportmodel->educational_data($edu_id),
		);
		$this->load_page($data);
	}

	//	load finance report page
	public function profession_data(){
		$prof_id = $this->uri->segment(3);			
		
		$data = array(
			'title' => $this->Reportmodel->get_profname($prof_id),
			'page' => 'report/gender',
			'result' => $this->Reportmodel->profession_data($prof_id),
		);
		$this->load_page($data);
	}

	//	load finance report page
	public function educational_area_council_data(){
		$edu_id = $this->uri->segment(4);
		$id = $this->uri->segment(3);			
		
		$data = array(
			'title' => $this->Reportmodel->get_eduname($edu_id),
			'page' => 'report/gender',
			'result' => $this->Reportmodel->educational_area_council_data($id,$edu_id),
		);
		$this->load_page($data);
	}

	//	load finance report page
	public function get_com_needs_area(){
		$id = $this->uri->segment(3);			
		
		$data = array(
			'title' => $this->Reportmodel->get_eduname($edu_id),
			'page' => 'report/gender',
			'result' => $this->Reportmodel->educational_area_council_data($id,$edu_id),
		);
		$this->load_page($data);
	}

	//	load finance report page
	public function profession_area_council_data(){
		$prof_id = $this->uri->segment(4);
		$id = $this->uri->segment(3);			
		
		$data = array(
			'title' => $this->Reportmodel->get_profname($prof_id),
			'page' => 'report/gender',
			'result' => $this->Reportmodel->profession_area_council_data($id,$prof_id),
		);
		$this->load_page($data);
	}

	//	load finance report page
	public function get_edu_area_council(){
		$edu_id = $this->uri->segment(3);
		$educationLevelName = $this->Reportmodel->get_eduname($edu_id);
		
		buildBreadCrumb(array(
			"url" => "Report/get_edu_area_council/$edu_id",
			"label" => "$educationLevelName Breakdown By Area Council"
		));
		$data = array(
			'title' => 'Area Council/'.$educationLevelName,
			'page' => 'report/edu_area_council',
			'edu_id' => $edu_id
		);
		$this->load_page($data);
	}

	//	load finance report page
	public function get_prof_area_council(){
		$prof_id = $this->uri->segment(3);			
		buildBreadCrumb(array(
			"url" => "Report/get_prof_area_council/$prof_id",
			"label" => "Profession details"
		));
		$data = array(
			'title' => 'Area Council/'.$this->Reportmodel->get_profname($prof_id),
			'page' => 'report/prof_area_council',
			'prof_id' => $prof_id
		);
		$this->load_page($data);
	}

	//	load finance report page
	public function edu_town_data(){
		$edu_id = $this->uri->segment(4);
		$id = $this->uri->segment(3);
		$eduName = $this->Reportmodel->get_eduname($edu_id);
		buildBreadCrumb(array(
			"url" => "Report/edu_town_data/$id/$edu_id",
			"label" => "$eduName List"
		));
		
		$data = array(
			'title' => $eduName,
			'page' => 'report/gender',
			'result' => $this->Reportmodel->educational_town_data($id,$edu_id),
		);
		$this->load_page($data);
	}

	//	load finance report page
	public function prof_town_data(){
		$prof_id = $this->uri->segment(4);
		$id = $this->uri->segment(3);			
		$profName = $this->Reportmodel->get_profname($prof_id);
		buildBreadCrumb(array(
			"label" => "$profName Professional list",
			"url" => "Report/prof_town_data/$prof_id/$id"
		));
		$data = array(
			'title' => $profName,
			'page' => 'report/gender',
			'result' => $this->Reportmodel->profession_town_data($id,$prof_id),
		);
		$this->load_page($data);
	}

	// This function is responsible for process the date arguments that are 
	//supplied for generating financial reports in the application
	private function processFinanceReportDateArgs() {
		$year = $this->input->get('year');
		$beginMonth = $this->input->get('beginMonth');
		$endMonth = $this->input->get('endMonth');

		$year = is_null($year) ? date('Y') : $year;
		$beginMonth = (
			is_null($beginMonth) || strcmp($beginMonth, '00') == 0 ? 
			'01' : $beginMonth
		);
		$endMonth = (
			is_null($endMonth) || strcmp($endMonth, '00') == 0 ? 
			'12' : $endMonth
		);

		$lower_ = date_create("$year-$beginMonth-01");
		$upper_ = date_sub(
			date_add(
				date_create("$year-$endMonth-01"),
				date_interval_create_from_date_string('1 month')
			),
			date_interval_create_from_date_string('1 day')
		);

		$lowerDateBound = strftime('%Y-%m-%d', $lower_->getTimestamp());
		$upperDateBound = strftime('%Y-%m-%d',$upper_->getTimestamp());

		$data = array(
			'selected_year' => $year,
			'selected_begin_month' => $beginMonth,
			'selected_end_month' => $endMonth,
			'year_months' => $this->getMonthsOfYear(),
			'report_years' => $this->Reportmodel->get_invoice_years(),
			'acclusion_array' => $this->getInvoiceExclusionList(),
			'lower_date_bound' => $lowerDateBound,
			'upper_date_bound' => $upperDateBound
		);

		if ($lower_ > $upper_) {
			$data['error_message'] = (
				"The dates you provided for the report are in reverse".
				". Kindly correct it before proceeding"
			);
		}
		return $data;
	}

	// This function lists the invoices types that must be excluded in the reportss
	private function getInvoiceExclusionList() {
		return array(
			'UNASSESSED_BUSS_PROP', 'UNASSESSED_RESI_PROP',
			'FEES', 'FINES', 'BUILDING PLANS PERMIT',
			'RENT', 'PERMITS'
		);
	}

	// This function just returns the list of months in a year so that it doesn't
	// need to be repeated in the UI
	private function getMonthsOfYear() {
		return array(
			'00' => 'Select Option',
			'01' => 'January',
			'02' => 'Febrary',
			'03' => 'March',
			'04' => 'April',
			'05' => 'May',
			'06' => 'June',
			'07' => 'July',
			'08' => 'August',
			'09' => 'September',
			'10' => 'October',
			'11' => 'November',
			'12' => 'December'
		);
	}
}