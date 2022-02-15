<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->library('form_validation');
        $this->load->model('M_transaksi');
    }

    public function index()
    {
        if ($this->session->userdata('role_id') == '1' || $this->session->userdata('role_id') == '2') {

            $data['title'] = "Data Transaksi";
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/templates/sidebar', $data);
            $this->load->view('admin/templates/topbar', $data);
            $this->load->view('admin/transaksi/data-transaksi', $data);
            $this->load->view('admin/templates/footer');
        } else {
            echo "Anda tidak berhak mengakses halaman ini";
        }
    }

    public function ajax_list()
    {
        $this->load->helper('url');

        $list = $this->M_transaksi->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $transaksi) {
            $no++;
            $row = array();
            $row[] = '<input type="checkbox" class="data-check" value="' . $transaksi->id_transaksi . '" onclick="showBottomDelete()"/>';

            $row[] = $transaksi->kode_transaksi;
            $row[] = $transaksi->harga;
            $row[] = $transaksi->jumlah;
            $row[] = $transaksi->total_harga;
            $row[] = $transaksi->tanggal_transaksi;
            $row[] = '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_transaksi(' . "'" . $transaksi->id_transaksi . "'" . ')"><i class="fas fa-trash-alt"></i></a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_transaksi->count_all(),
            "recordsFiltered" => $this->M_transaksi->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }


    public function ajax_delete($id_transaksi)
    {
        $transaksi = $this->M_transaksi->get_by_id($id_transaksi);

        $this->M_transaksi->delete_by_id($id_transaksi);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_list_delete()
    {
        $list_id = $this->input->post('list_id');
        foreach ($list_id as $id_transaksi) {
            $this->M_transaksi->delete_by_id($id_transaksi);
        }
        echo json_encode(array("status" => TRUE));
    }


}

/* End of file Transaksi.php */
