<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->library('form_validation');
        $this->load->model('M_admin');
    }
    
    public function index()
    {
        if ($this->session->userdata('role_id') == '1' || $this->session->userdata('role_id') == '2') {

            $data['title'] = "Data Barang";
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/templates/sidebar', $data);
            $this->load->view('admin/templates/topbar', $data);
            $this->load->view('admin/barang/data-barang', $data);
            $this->load->view('admin/templates/footer');
        } else {
            echo "Anda tidak berhak mengakses halaman ini";
        }
    }

    public function ajax_list()
    {
        $this->load->helper('url');

        $list = $this->M_admin->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $dataBarang) {
            $no++;
            $row = array();
            $row[] = '<input type="checkbox" class="data-check" value="' . $dataBarang->id . '" onclick="showBottomDelete()"/>';

            if ($dataBarang->foto_barang)
                $row[] = '<a href="' . base_url('./assets/images/uploads/barang/' . $dataBarang->foto_barang) . '" target="_blank" title="Pictures"><img width="50px" height="60px" src="' . base_url('./assets/images/uploads/barang/' . $dataBarang->foto_barang) . '" class="img-thumbnail"/></a>';
            else
                $row[] = '(No photo)';

            $row[] = $dataBarang->nama;
            $row[] = "Rp " . number_format($dataBarang->harga, 2, ",", "."); ;
            $row[] = $dataBarang->stok;
            $row[] = $dataBarang->tanggal_masuk;
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_barang(' . "'" . $dataBarang->id . "'" . ')"><i class="uil-edit"></i></i></a>
        			<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_barang(' . "'" . $dataBarang->id . "'" . ')"><i class="fas fa-trash-alt"></i></a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_admin->count_all(),
            "recordsFiltered" => $this->M_admin->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function ajax_edit($id)
    {
        $data = $this->M_admin->get_by_id($id);
        $data->tanggal_masuk = ($data->tanggal_masuk == '0000-00-00') ? '' : $data->tanggal_masuk;
        echo json_encode($data);
    }

    public function ajax_add()
    {
        $this->_validate();
        $data = array(
            'nama'      => htmlspecialchars($this->input->post('nama', TRUE)),
            'stok'    => htmlspecialchars($this->input->post('stok', TRUE)),
            'harga'    => htmlspecialchars($this->input->post('harga', TRUE)),
            'tanggal_masuk'    => htmlspecialchars($this->input->post('tanggal_masuk', TRUE)),
        );

        if (!empty($_FILES['foto_barang']['name'])) {
            $upload = $this->_do_upload();
            $data['foto_barang'] = $upload;
        }

        $insert = $this->M_admin->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update()
    {
        $this->_validate();
        $data = array(
            'nama'      => htmlspecialchars($this->input->post('nama', TRUE)),
            'stok'    => htmlspecialchars($this->input->post('stok', TRUE)),
            'harga'    => htmlspecialchars($this->input->post('harga', TRUE)),
            'tanggal_masuk'    => htmlspecialchars($this->input->post('tanggal_masuk', TRUE)),
        );

        if ($this->input->post('remove_photo')) {
            if (file_exists('./assets/images/uploads/barang/' . $this->input->post('remove_photo')) && $this->input->post('remove_photo'))
                unlink('./assets/images/uploads/barang/' . $this->input->post('remove_photo'));
            $data['foto_barang'] = '';
        }

        if (!empty($_FILES['foto_barang']['name'])) {
            $upload = $this->_do_upload();

            $barang = $this->M_admin->get_by_id($this->input->post('id'));
            if (file_exists('./assets/images/uploads/barang/' . $barang->foto_barang) && $barang->foto_barang)
                unlink('./assets/images/uploads/barang/' . $barang->foto_barang);

            $data['foto_barang'] = $upload;
        }


        $this->M_admin->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $barang = $this->M_admin->get_by_id($id);

        if (file_exists('./assets/images/uploads/barang/' . $barang->foto_barang) && $barang->foto_barang)
            unlink('./assets/images/uploads/barang/' . $barang->foto_barang);

        $this->M_admin->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_list_delete()
    {
        $list_id = $this->input->post('id');
        foreach ($list_id as $id) {
            $this->M_admin->delete_by_id($id);
        }
        echo json_encode(array("status" => TRUE));
    }

    private function _do_upload()
    {
        $config['upload_path']          = './assets/images/uploads/barang/';
        $config['allowed_types']        = 'gif|jpg|jpeg|png';
        $config['encrypt_name']         = TRUE;
        // $config['max_size']             = 2048;
        // $config['max_width']            = 1000;
        // $config['max_height']           = 1000;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('foto_barang')) {
            $data['inputerror'][] = 'foto_barang';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', '');
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        $id = $this->input->post('id');
      
        if ($this->input->post('nama') == '') {
            $data['inputerror'][] = 'nama';
            $data['error_string'][] = 'Nama barang tidak boleh kosong';
            $data['status'] = FALSE;
        } else {

            if (!$this->_validate_string($this->input->post('nama'))) {
                $data['inputerror'][] = 'nama';
                $data['error_string'][] = 'Invalid Value';
                $data['status'] = FALSE;
            }
        }

        if ($this->input->post('stok') == '') {
            $data['inputerror'][] = 'stok';
            $data['error_string'][] = 'Stok tidak boleh kosong';
            $data['status'] = FALSE;
        } else {

            if (!$this->_validate_number($this->input->post('stok'))) {
                $data['inputerror'][] = 'stok';
                $data['error_string'][] = 'Invalid Value';
                $data['status'] = FALSE;
            }
        }

        if ($this->input->post('harga') == '') {
            $data['inputerror'][] = 'harga';
            $data['error_string'][] = 'Harga tidak boleh kosong';
            $data['status'] = FALSE;
        } else {

            if (!$this->_validate_number($this->input->post('harga'))) {
                $data['inputerror'][] = 'harga';
                $data['error_string'][] = 'Invalid Value';
                $data['status'] = FALSE;
            }
        }


        if ($this->input->post('tanggal_masuk') == '') {
            $data['inputerror'][] = 'tanggal_masuk';
            $data['error_string'][] = 'Tanggal masuk tidak boleh kosong';
            $data['status'] = FALSE;
        }

        // if ($data['status'] === FALSE) {
        //     echo json_encode($data);
        //     exit();
        // }
    }

    private function _validate_string($string)
    {
        $allowed = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz/^([-a-z_ ])";
        for ($i = 0; $i < strlen($string); $i++) {
            if (strpos($allowed, substr($string, $i, 1)) === FALSE) {
                return FALSE;
            }
        }

        return TRUE;
    }

    private function _validate_number($string)
    {
        $allowed = "0123456789";
        for ($i = 0; $i < strlen($string); $i++) {
            if (strpos($allowed, substr($string, $i, 1)) === FALSE) {
                return FALSE;
            }
        }

        return TRUE;
    }

}

/* End of file Barang.php */
