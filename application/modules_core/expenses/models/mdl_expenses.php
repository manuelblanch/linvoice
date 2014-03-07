<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_expenses extends MY_Model {
    
   var $expenses_path;
     
    public function __construct() {
        
        parent::__construct();
        
        $this->table_name = 'mcb_expense';
        
        $this->primary_key = 'mcb_expense.mcb_expense_id';
        
        $this->select_fields = "
            SQL_CALC_FOUND_ROWS *";
        
        $this->order_by = 'mcb_expense.mcb_expense_date DESC';
        
        $this->joins = array(
            'mcb_expense_method' => 'mcb_expense_method.expense_category_id = mcb_expense.expense_category_id'
        );
        if ($this->mdl_mcb_data->setting('version') > '0.8.5') {

			$this->joins['mcb_expense_method'] = array('mcb_expense_method.expense_category_id = mcb_expense.expense_category_id', 'left');

	}
        
        $this->limit = $this->mdl_mcb_data->setting('results_per_page');
        
	$this->custom_fields = $this->mdl_fields->get_object_fields(7);
        
        $this->expenses_path = realpath(APPPATH . '../uploads/expenses');
    }
    
    public function validate() {
        
        
        $this->form_validation->set_rules('mcb_expense_name', $this->lang->line('expense_name'), 'required');
        $this->form_validation->set_rules('expense_category_id', $this->lang->line('expense_category'), 'required');
        $this->form_validation->set_rules('mcb_expense_date', $this->lang->line('expense_date'), 'required');
        $this->form_validation->set_rules('mcb_expense_amount', $this->lang->line('expense_amount'), 'required|callback_amount_validate');
        $this->form_validation->set_rules('mcb_expense_note', $this->lang->line('expense_note'));
        $this->form_validation->set_rules('client_id', $this->lang->line('expense_client'));
        $this->form_validation->set_rules('mcb_expense_payto', $this->lang->line('expense_pay'), 'required');
        $this->form_validation->set_rules('mcb_expense_file_url', $this->lang->line('upload_file'));
        
        return parent::validate($this);
    }
    
    public function db_array() {
        
        $db_array = parent::db_array();
        
        if(uri_assoc('mcb_expense_id')) {
            
            $db_array['mcb_expense_id'] = uri_assoc('mcb_expense_id');
            
        }
        else if($this->input->post('mcb_expense_id')) {
            
            $db_array['mcb_expense_id'] = $this->input->post('mcb_expense_id');
            
        }
        
        $db_array['mcb_expense_date'] = strtotime(standardize_date($db_array['mcb_expense_date']));
        $db_array['mcb_expense_amount'] = standardize_number($db_array['mcb_expense_amount']);
        
        
        return $db_array;
    }
    
    public function save() {
        
        $db_array = $this->db_array();
        parent::save($db_array, uri_assoc('mcb_expense_id'));
        return $this->db->insert_id();
        
    }
    
    
    public function set_date() {
        
        $this->set_form_value('mcb_expense_date', format_date(time()));
        
    }
    
    public function save_expense ($id) {
        
        $data = array(
            'mcb_expense_name' => $this->input->post('mcb_expense_name'),
            'expense_category_id' => $this->input->post('expense_category_id'),
            'mcb_expense_date' => strtotime(standardize_date($this->input->post('mcb_expense_date'))),
            'mcb_expense_amount' => $this->input->post('mcb_expense_amount'),
            'mcb_expense_note' => $this->input->post('mcb_expense_note'),
            'client_id' => $this->input->post('client_id'),
            'mcb_expense_payto' => $this->input->post('mcb_expense_payto')
        );
        $this->db->insert('mcb_expense', $data);
        return $this->db->insert_id();
    }
    
    public function insert_file($expense_id) {
        if (basename($_FILES['userfile']['name']) != '') {
                    $data = array(
                            'mcb_expense_file_title' => basename($_FILES['userfile']['name']),
                            'mcb_expense_id'  => $expense_id,
                            'mcb_expense_file_url' => $this->expenses_path
                    );

                    $this->db->insert('mcb_expense_file', $data);
                    return $this->db->insert_id();
        } else {
            return error_reporting();
        }
    }

    public function do_upload()
        {
                $config = array(
                        'upload_path' => $this->expenses_path,
                        'allowed_types' => 'gif|jpg|png|doc|txt|xls|xlsx|pdf|zip|rar',
                        'max_size'  => 20000000,
                        'overwrite' => TRUE
                );
                $this->load->library('upload', $config);
                
                $this->upload->initialize($config);
                
                $this->upload->do_upload();
                
        
        }
        
}
?>
