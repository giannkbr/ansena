<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = [
            "title" => "Cart",
            "page" => "user/transaction/cart/index",
            "user" => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
            "keranjang" => $this->cart->contents(),
        ];

        $this->load->view('user/templates/app', $data, FALSE);
    }   



    public function add_to_cart()
    {
        $data = array(
            'id' => $this->input->post('id'),
            'name' => $this->input->post('nama'),
            'harga' => $this->input->post('harga'),
            'jumlah' => $this->input->post('jumlah'),
            'foto_barang' => $this->input->post('foto_barang'),
        );
        $this->cart->insert($data);
        // echo $this->show_cart(); //tampilkan cart setelah added
        // var_dump($data);
    }

    public function total_cart()
    {
        $total = '
            <div class="container">
                <div class="row">
                    <div class="col my-auto">
                        <h5 class="fw-bold">(' . $this->cart->total_items() . ')</h5>
                    </div>
                    <div class="col my-auto justify-content-end d-flex">
                        <p class="my-auto me-5">Total: <span class="yellow-text h5 fw-bold ms-3"> Rp.' . number_format($this->cart->total(), '0', ',', '.')  . '</span></p>
                        <a href="' . base_url('user/checkout/addToCheckout') . '" class="btn px-5 py-2 yellow-button">Pesan</a>
                    </div>
                </div>
            </div>

       ';
        return $total;
    }


    public function getCart()
    {
        $this->load->model('M_admin');
        $keranjang = $this->cart->contents();
        $output = '';
        $no = 0;
        // $foto = $this->barang->getProductByKd($keranjang['id']);
        foreach ($keranjang as $keranjang) {
            $no++;
            $output .= '
            <div class="row mb-5 keranjang-grid">
            <div class="col-md-2">
                <div class="img text-center">
                    <img src="' . base_url("assets/images/uploads/barang" . $keranjang['foto_barang']) . '"alt="" />
                </div>
            </div>
            <div class="col-md my-auto">
                <div class="row">
                    <div class="col-md py-1">
                        <p>' . $keranjang['name'] . '</p>
                    </div>
                    <div class="col-md py-1 text-center isi-keranjang my-auto">
                </div>
                    <div class="col-md py-1 text-center isi-keranjang my-auto">
                        <p class="my-auto">Rp.' . number_format($keranjang['harga'], '0', ',', '.') . '</p>
                    </div>
                    <div class="col-md py-1 text-center isi-keranjang my-auto">
                        <div class="input-group inline-group border-1 border border-dark">
                            <div class="input-group-prepend">
                                <button data-qty="' . $keranjang['jumlah'] . '" id="' . $keranjang['id'] . '" class="kurang_qty btn text-dark btn-minus">
                                    <i class="bi bi-dash"></i>
                                </button>
                            </div>
                            <input class="form-control quantity border-0 text-center" min="0" name="quantity" value="' . $keranjang['jumlah'] . '" type="number" readonly />
                            <div class="input-group-append">
                                <button data-qty="' . $keranjang['jumlah'] . '" id="' . $keranjang['id'] . '" class="tambah_qty btn text-dark btn-plus">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md py-1 text-center isi-keranjang my-auto">
                        <p class="yellow-text my-auto">Rp.' . number_format($keranjang['harga'] * $keranjang['jumlah'], '0', ',', '.') . '</p>
                    </div>
                    <div class="col-md py-1 text-center isi-keranjang my-auto">
                        <button id="' . $keranjang['id'] . '"  class="hapus_cart btn my-auto hapus" >Hapus</button>
                    </div>
                </div>
            </div>
        </div>
        ';
        }
        return $output;
    }

    public function show_items()
    {
        $items = '<span id="total_items" class="cart-basket d-flex align-items-center justify-content-center">' . $this->cart->total_items() . '</span>';

        return $items;
    }

    function load_cart()
    { //load data cart
        echo $this->getCart();
    }

    function load_total()
    { //load total cart
        echo $this->total_cart();
    }

    function load_items()
    {
        echo $this->show_items();
    }


    function tambah_qty()
    { //fungsi untuk menghapus item cart
        $data = array(
            'rowid' => $this->input->post('row_id'),
            'jumlah' => $this->input->post('jumlah') + 1,
        );
        $this->cart->update($data);
        echo $this->getCart();
    }

    function kurang_qty()
    { //fungsi untuk menghapus item cart
        $data = array(
            'rowid' => $this->input->post('row_id'),
            'jumlah' => $this->input->post('jumlah') - 1,
        );
        $this->cart->update($data);
        echo $this->getCart();
    }

    function hapus_cart()
    { //fungsi untuk menghapus item cart
        $data = array(
            'rowid' => $this->input->post('row_id'),
            'jumlah' => 0,
        );
        $this->cart->update($data);
        echo $this->getCart();
    }

}

/* End of file Cart.php */
