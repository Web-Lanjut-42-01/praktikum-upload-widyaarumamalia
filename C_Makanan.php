<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Makanan extends CI_Controller {
	public function __construct()
  	{
  	  parent::__construct();
  	  $this->load->model('M_makanan');
  	  
  	}

	public function index()
	{
	
	}
	public function tampil_makanan()
	{	
		$q= $this->M_makanan->get_makanan()->result();
		$data['makanan'] =$q;
		$this->load->view('tampil_makanan',$data);
	}
	public function tambah_makanan()
	{
		$this->load->view('v_makanan');	
	}
	public function insert_makanan()
	{
		$data= array(
			'id_makanan' =>$this->input->post('id_makanan') , 
			'nama_makanan' =>$this->input->post('nama_makanan') , 
			'harga_makanan' =>$this->input->post('harga_makanan') , 

		);
		if (!empty($_FILES['foto_makanan']['name'])) {
     	$config['upload_path']    ='./foto/';
     	$config['allowed_types']  ='gif|jpg|jpeg|png|jfif';
     	$config['encrypt_name']   =TRUE;
     	$config['max_size']       =2000;
     	$this->load->library('upload', $config);
     	if(! $this->upload->do_upload('foto_makanan'))
     	{
     	  print_r($this->upload->display_errors());
     	  return;
     	}
     	else
     	{
     	  $data['foto_makanan'] = $this->upload->data('file_name');
     	}
     	$q = $this->M_makanan->insert_makanan($data);
     	if($q){
     	  return redirect(base_url('C_Makanan/tampil_makanan'));
     	}
     	echo $q;
	}

	}
    public function edit_makanan($id_makanan)
    {
    $q = $this->M_makanan->get_makanan_single($id_makanan)->row();
    $data['makanan']=$q;
    $this->load->view('edit_makanan', $data);
    }
    public function update_makanan($id_makanan)
    {
        $data= array(
            'id_makanan' =>$this->input->post('id_makanan') , 
            'nama_makanan' =>$this->input->post('nama_makanan') , 
            'harga_makanan' =>$this->input->post('harga_makanan') , 

        );
        if (!empty($_FILES['foto_makanan']['name'])) {
        $config['upload_path']    ='./foto/';
        $config['allowed_types']  ='gif|jpg|jpeg|png|jfif';
        $config['encrypt_name']   =TRUE;
        $config['max_size']       =2000;
        $this->load->library('upload', $config);
        if(! $this->upload->do_upload('foto_makanan'))
        {
          print_r($this->upload->display_errors());
          return;
        }
        else
        {
          $data['foto_makanan'] = $this->upload->data('file_name');
        }
        $q = $this->M_makanan->update_makanan($id_makanan, $data);
        // print_r($data);
         if($q){
        return redirect(base_url('C_Makanan/tampil_makanan'));
        }
         echo "gagal";
    
    }
    }
    public function delete_makanan($id_makanan)
    {
        $q = $this->M_makanan->delete_makanan($id_makanan);
        if ($q) {
            return redirect(base_url('C_Makanan/tampil_makanan'));
        }
        echo "gagal";
    }
}

/* End of file C_Makanan.php */
/* Location: ./application/controllers/C_Makanan.php */