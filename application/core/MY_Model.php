<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {

    protected $table = '';
    protected $perPage = 5;
    protected $primary_key;
    var $column_order = array();
    var $column_search = array(); 
    var $select_field;
    var $join = null;
    var $where = array();
    public function __construct()
    {
        parent::__construct();
        if (!$this->table) {
            $this->table = strtolower(
                str_replace('_model', '', get_class($this))
            );
        }
        
    }
    public function change($id = NULL, $data = array())
    {        
        $this->db->where($this->primary_key, $id);
        $this->db->update($this->table, $data);

        return $this->db->affected_rows();
    }

    public function scurity($input)
    {
        return mysqli_real_escape_string($this->db->conn_id, $input);
    }

    public function store($data = array())
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function from($table)
    {
        $this->db->from($table);
        return $this;
    }

    /**
     * Fungsi validasi input
     * Rules : dideklarasikan dalam masing-masing model
     * 
     * @return void
     */

    public function validate($rules = null)
    {
        
       if ($rules != null) {
            $this->load->library('form_validation');
            // $this->form_validation->set_error_delimiters(
            //     '<small class="form-text text-danger">', '</small>'
            // );

            $validationRules = $this->getValidationRules($rules);
            $this->form_validation->set_rules($validationRules);
        } else {
            $this->load->library('form_validation');

            $validationRules = $this->getValidationRules();
            $this->form_validation->set_rules($validationRules);  
        }
        

        return $this->form_validation->run();
           
        
    }

    /**
     * Seleksi data perkolom
     * Chain Method
     * 
     * @param [type] $columns
     * @return void    
     */

    public function select($columns)
    {
        $this->db->select($columns);
        return $this;
    }

    /**
     * Mecari suatu data pada kolom tertentu dengan data yang sama
     * Chain Method
     * 
     * @param [type] $columns
     * @param [type] $condition
     * @return void
     */
    public function where($columns, $condition)
    {
        $this->db->where($columns, $condition);
        return $this;
    }

    public function where_in($columns, $condition)
    {
        $this->db->where_in($columns, $condition);
        return $this;
    }

    /**
     * Mecari suatu data pada kolom tertentu dengan data   yang di inputkan oleh user
     * Chain Method
     * 
     * @param [type] $columns
     * @param [type] $condition
     * @return void
     */
    public function Like($columns, $condition)
    {
        $this->db->like($columns, $condition);
        return $this;
    }

    /**
     * Mecari suatu data pada kolom tertentu dengan data yang di inputkan oleh user
     * Chain Method
     * 
     * @param [type] $columns
     * @param [type] $condition
     * @return void
     */
    public function orLike($columns, $condition)
    {
        $this->db->or_like($columns, $condition);
        return $this;
    }

    /**
     * MEnghubungkan Table yang berelasi dengan tabel yg memiliki foreign key id_namatable
     * Chain Method
     * 
     * @param [type] $table
     * @param [type] $type
     * @return void
     */
    public function join($table, $type = 'left')
    {
        $this->db->join($table, "$this->table.id_$table = $table.id", $type);
        return $this;
    }

    public function join_ref($table_utama, $table_ref, $type = 'left')
    {
        $this->db->join($table_ref, "$table_ref.id = $table_utama.id_$table_ref", $type);
        return $this;
    }

    /**
     * Mengurutkan data dari hasil query dan kondisi
     * default ascending
     * Chain Method
     * 
     * @param [type] $columns
     * @param [type] $condition
     * @return void
     */
    public function orderBy($columns, $order = 'asc')
    {
        $this->db->order_by($columns, $order);
        return $this;
        
    }

    /**
     * Menampilkan Satu data dari hasil query dan kondisi
     * Chain Method
     * 
     * @param [type] $columns
     * @param [type] $condition
     * @return void
     */
    public function first($table = null)
    {
        if ($table != null) {
            return $this->db->get($table)->row();
                        
        } else {
            return $this->db->get($this->table)->row();

        }
        
    }

    /**
     * Menampilkan Banyak data dari hasil query dan kondisi
     * Chain Method
     * 
     * @param [type] $columns
     * @param [type] $condition
     * @return void
     */
    public function get($table = null)
    {
        if ($table != null) {
            return $this->db->get($table)->result();
            
                        
        } else {
            return $this->db->get($this->table)->result();
           

        }
        
    }

      public function get_result($table = null)
    {
        if ($table != null) {
            return $this->db->get($table)->result_array();
            
                        
        } else {
            return $this->db->get($this->table)->result_array();
           

        }
        
    }

    /**
     * Mecari suatu data pada kolom tertentu dengan data yang sama
     * Chain Method
     * 
     * @param [type] $columns
     * @param [type] $condition
     * @return void
     */
    public function count()
    {
        return $this->db->count_all_results($this->table);
        
    }

    public function count_filtered($table = null)
    {
        if ($table != null) {
           return $this->db->get($table)->num_rows();
        } else {
             return $this->db->get($this->table)->num_rows();
        }
       
        
    }

   

    /**
     * Seleksi data perkolom
     * Chain Method
     * 
     * @param [type] $columns
     * @return void    
     */

    public function distinct()
    {
        $this->db->distinct();
        return $this;
    }

    /**
     * Mecari suatu data pada kolom tertentu dengan data yang sama
     * Chain Method
     * 
     * @param [type] $columns
     * @param [type] $condition
     * @return void
     */
    public function create($data, $table = null)
    {
        if ($table == null) {
           $this->db->insert($this->table, $data);
            return $this->db->insert_id();
        } else{
            $this->db->insert($table, $data);
            return $this->db->insert_id();
        }
        
    }

    public function insert_batch($data, $table = null)
    {
        $count = count($data);
        if ($table == null) {
            $this->db->insert_batch($this->table, $data);
            $first_id = $this->db->insert_id();
            return $last_id = $first_id + ($count-1);
        } else { 
            $this->db->insert_batch($table, $data);
            $first_id = $this->db->insert_id();
            return $last_id = $first_id + ($count-1);
        }
        

    }


    public function update_batch($data, $table = null, $id)
    {
        $count = count($data);
        if ($table == null) {
            $this->db->update_batch($this->table, $data, $id);
             $updated_status = $this->db->affected_rows();
            if($updated_status):
                return $id;
            else:
                return false;
            endif;
        } else { 
            $this->db->update_batch($table, $data,$id);
            $updated_status = $this->db->affected_rows();
            if($updated_status):
                return $id;
            else:
                return false;
            endif;
        }
        

    }

    public function update($data, $table = null)
    {
        if ($table != null) 
            return $this->db->update($table, $data);
       
         return $this->db->update($this->table, $data);
    }

    public function delete($table = null)
    {
        if ($table != null) {
            $this->db->delete($table);
        } else {
             $this->db->delete($this->table);    
        }
       
        return $this->db->affected_rows();
        
        
    }

    public function paginate($page)
    {
        $this->db->limit(
            $this->perPage,
            $this->calculateRealOffset($page)
        );

        return $this;
        
    }

    public function calculateRealOffset($page)
    {
        if (is_null($page) || empty($page)){
            $offset = 0;
        } else {
            $offset = ($page * $this->perPage) - $this->perPage;
        }

        return $offset;
    }

    public function makePagination($baseUrl, $uriSegment, $totalRows = null)
    {
        $this->load->library('pagination');
        
        $config = [
            'base_url'          => $baseUrl,
            'uri_segment'       => $uriSegment,
            'per_page'          => $this->perPage,
            'total_rows'        => $totalRows,
            'use_page_numbers'  => true,

            'full_tag_open'     => '<ul class="pagination">',
            'full_tag_close'    => '</ul>',
            'attributes'        => ['class' => 'page-link'],
            'first_link'        => false,
            'last_link'         => false,
            'first_tag_open'    => '<li class="page-item">',
            'first_tag_close'   => '</li>',
            'prev_link'         => '&laquo',
            'prev_tag_open'     =>'<li class="page-item">',  
            'prev_tag_close'    =>'</li>',
            'next_link'         => '&raquo',
            'next_tag_open'     =>'<li class="page-item">',  
            'next_tag_close'    =>'</li>',
            'last_tag_open'     =>'<li class="page-item">',  
            'last_tag_close'    =>'</li>',
            'cur_tag_open'      => '<li class="page-item active"><a href="#" class="page-link">',
            'cur_tag_close'     => '<span class="sr-only">(current)</span></a></li>',
            'num_tag_open'      => '<li class="page-item">',
            'num_tag_close'     => '</li>',
        ];

        $this->pagination->initialize($config);
        return $this->pagination->create_links();

    }


    public function datatables()
    {
        $this->db->from($this->table);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();  
        return $query->result();   
    }


    //2
    public function search_item($items = array())
    {
        $i = 0;
        foreach ($items as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($items) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        return $this;
    }

    public function column_order($order = [])
    {
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 

        return $this;
    }

    
    public function find($id = NULL, $select_field = [])
    {
        if (is_array($select_field) AND count($select_field)) {
            $this->db->select($select_field);
        }

        $this->db->where("".$this->table.'.'.$this->primary_key,$id);
        $query = $this->db->get($this->table);

        if($query->num_rows()>0)
        {
            return $query->row();
        }
        else
        {
            return FALSE;
        }
    }

    public function cek_data($table = null)
    {
        if ($table == null) {
            $query = $this->db->get($this->table);
        } else {
            $query = $this->db->get($table);
        }

        if($query->num_rows()>0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }


    function count_by_kolom($kolom, $isi){
        $this->db->select('COUNT(*) AS hasil')
                 ->where($kolom, $isi)
                 ->from($this->table);
        return $this->db->get();
    }
    
    function get_by_kolom($kolom, $isi){
        $this->db->where($kolom, $isi)
                 ->from($this->table)
                 ->limit(1);
        return $this->db->get();
    }
    
    function get_datatable($start, $rows, $kolom, $isi){
        $this->db->where('('.$kolom.' LIKE "%'.$isi.'%")')
                 ->from($this->table)
                 ->order_by($kolom, 'ASC')
                 ->limit($rows, $start);
        return $this->db->get();
    }
    
    function get_datatable_count($kolom, $isi){
        $this->db->select('COUNT(*) AS hasil')
                 ->where('('.$kolom.' LIKE "%'.$isi.'%")')
                 ->from($this->table);
        return $this->db->get();
    }

    function get_start() {
        $start = 0;
        if (isset($_GET['iDisplayStart'])) {
            $start = intval($_GET['iDisplayStart']);

            if ($start < 0)
                $start = 0;
        }

        return $start;
    }

    function get_rows() {
        $rows = 10;
        if (isset($_GET['iDisplayLength'])) {
            $rows = intval($_GET['iDisplayLength']);
            if ($rows < 5 || $rows > 500) {
                $rows = 10;
            }
        }

        return $rows;
    }

    function get_by_kolom_limit($kolom, $isi, $limit, $table){
        $this->db->where($kolom, $isi)
                 ->from($table)
                 ->limit($limit);
        return $this->db->get();
    }

    function get_sort_dir() {
        $sort_dir = "ASC";
        $sdir = strip_tags($_GET['sSortDir_0']);
        if (isset($sdir)) {
            if ($sdir != "asc" ) {
                $sort_dir = "DESC";
            }
        }

        return $sort_dir;
    }


  public function _count($where= NUll)
    {
        if (!empty($this->type)) {
            $where['post_type'] = $this->type;
        }

        if ($where) {
            $this->db->where($where);
        }
        $this->db->from($this->table_name);
        return $this->db->count_all_results();
    }


    /* Request Ajax query */

    public function getRequestAjax()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();  
        return $query->result();   
    }

    public function resultData()
    {
        $this->db->from($this->table);
        $i = 0;
        $select_dat = implode(', ', $this->select);
        $this->db->select($select_dat);
        $this->getJoin();
        $this->getWhere();
        $query = $this->db->get();  
        return $query->result(); 
    }


    private function _get_datatables_query($select_data = null, $table = null)
    {
        $this->db->from($this->table);
        $i = 0;
        $select_dat = implode(', ', $this->select);
        $this->db->select($select_dat);
        $this->getJoin();
        $this->getWhere();
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function getJoin()
    {
        $i = 1;
        if ($this->join != null) {
             foreach ($this->join as $key => $value) {
                $a[$i] = $this->db->join($key, $value, 'left');
                $i++;
             }
        } else {
            $a = '';
        }

         return $this;
    }

    public function wheres($columns, $condition)
    {
        $this->db->where($columns, $condition);
        return $this;
    }

    public function getWhere()
    {
        if ($this->where != null) {
            if (is_array($this->where)) {
                return $this->db->where($this->where);
            }
        } else {
            return false;
        }
    }

    public function _count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $this->db->count_all_results();
    }

    

}

/* End of file core/MY_Model.php */
