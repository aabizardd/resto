<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// IMPORTANT - Replace the following line with your path to the escpos-php autoload script
require_once __DIR__ . '/escpos-php-development/autoload.php';
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;

class ReceiptPrint {
  private $CI;
  private $connector;
  private $printer;
  // TODO: printer settings
  // Make this configurable by printer (32 or 48 probably)
  private $printer_width = 32;

  function __construct()
  {
    $this->CI =& get_instance(); // This allows you to call models or other CI objects with $this->CI->...
    $this->CI->load->model('MWeb');
    $this->CI->load->model('MTransaksi','tb_transaksi');

    
  }

  function connect($ip_address, $port)
  {
    $this->connector = new NetworkPrintConnector($ip_address, $port);
    $this->printer = new Printer($this->connector);
  }

  

  private function check_connection()
  {
    if (!$this->connector OR !$this->printer OR !is_a($this->printer, 'Mike42\Escpos\Printer')) {
      throw new Exception("Tried to create receipt without being connected to a printer.");
    }
  }
  public function close_after_exception()
  {
    if (isset($this->printer) && is_a($this->printer, 'Mike42\Escpos\Printer')) {
      $this->printer->close();
    }
    $this->connector = null;
    $this->printer = null;
    $this->emc_printer = null;
  }
  // Calls printer->text and adds new line
  private function add_line($text = "", $should_wordwrap = true)
  {
    $text = $should_wordwrap ? wordwrap($text, $this->printer_width) : $text;
    $this->printer->text($text."\n");
  }

  public function print_test_receipt($text = "")
  {

    $this->check_connection();
    $transaksi          = $this->CI->tb_transaksi->detail($text)->row();
    $items              = $this->CI->tb_transaksi->datadetailtransaksi($text)->result_array();
    $total_keseluruhan  = $this->CI->tb_transaksi->sum_produk_kasir_fix($text);

    $tanggal_transaksi_struk = date("d-m-Y", strtotime($transaksi->tanggal_transaksi));

    $leftCol = "No      : $transaksi->id_transaksi_penjualan\nPelayan : $transaksi->id_user\nKasir   : $transaksi->id_kasir";
    $rightCol = "Tanggal : $tanggal_transaksi_struk\nMeja    : $transaksi->nama_meja";

    $menuCol = "Menu";
    $jumlahCol = "Jumlah";
    $hargaCol = "Harga";
    $subtotalCol = "Subtotal";

    $this->printer->setJustification(Printer::JUSTIFY_CENTER);
    $this->printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
    $this->add_line($this->CI->MWeb->tampil()->row()->nama_web);
    $this->add_line($this->CI->MWeb->tampil()->row()->slogan_web);
    $this->printer->selectPrintMode();
    $this->add_line($this->CI->MWeb->tampil()->row()->alamat_web);
    $this->add_line("Telp : " .$this->CI->MWeb->tampil()->row()->telp_web);
    $this->printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
    $this->printer -> setEmphasis(true);
    $this->add_line("========================"); // blank line
    $this->printer -> setEmphasis(false);
    $this->printer -> setJustification(Printer::JUSTIFY_LEFT);
    $this->printer->selectPrintMode();
    $this->printer -> text($this->columnify2($leftCol, $rightCol, 22, 22, 4));
    $this->printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
    $this->add_line("========================"); // blank line
    $this->printer->selectPrintMode();
    
    $this->printer -> setJustification(Printer::JUSTIFY_LEFT);
    $this->printer -> setEmphasis(true);
    $this->printer -> text($this->columnify4($menuCol, $jumlahCol, $hargaCol ,$subtotalCol, 22, 6, 8, 9, 1));
    $this->printer -> setEmphasis(false);
    foreach ($items as $item) {
        $this->printer -> text($this->columnify4($item['nama_produk'],$item['jumlah_transaksi'],number_format($item['harga_transaksi'], 0, ',', '.'),number_format($item['total_transaksi'], 0, ',', '.'), 22, 6, 8, 9, 1));
    }
    $this->printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
    $this->add_line("========================"); // blank line
    $this->printer->selectPrintMode();
    $this->printer-> setEmphasis(true);
    $this->printer->text(new item('Total Keseluruhan :','','',number_format($total_keseluruhan, 0, ',', '.')));
    $this->printer->text(new item('Tunai             :','','',number_format($transaksi->bayar_transaksi, 0, ',', '.')));
    $this->printer->text(new item('Kembalian         :','','',number_format($transaksi->kembalian_transaksi, 0, ',', '.')));
    $this->printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
    $this->add_line("========================");// blank line
    $this->printer->selectPrintMode();
    $this->printer-> setEmphasis(true);
    $this->printer -> setJustification(Printer::JUSTIFY_CENTER);
    $this->printer -> feed();
    $this->printer-> text("Terimakasih\n");
    $this->printer -> feed();
    $this->printer->cut(Printer::CUT_PARTIAL);
    $this->printer->close();


/* Copy it over to the printer */
copy($file, "//localhost/KoTickets");
unlink($file);


  }

  function columnify2($leftCol, $rightCol, $leftWidth, $rightWidth, $space = 4) {
    $leftWrapped = wordwrap($leftCol, $leftWidth, "\n", true);
    $rightWrapped = wordwrap($rightCol, $rightWidth, "\n", true);

    $leftLines = explode("\n", $leftWrapped);
    $rightLines = explode("\n", $rightWrapped);
    $allLines = array();
    for ($i = 0; $i < max(count($leftLines), count($rightLines)); $i ++) {
        $leftPart = str_pad(isset($leftLines[$i]) ? $leftLines[$i] : "", $leftWidth, " ");
        $rightPart = str_pad(isset($rightLines[$i]) ? $rightLines[$i] : "", $rightWidth, " ");
        $allLines[] = $leftPart . str_repeat(" ", $space) . $rightPart;
    }
    return implode($allLines, "\n") . "\n";
  }

  function columnify4($menuCol, $jumlahCol, $hargaCol, $subtotalCol, $menuWidth, $jumlahWidth, $hargaWidth, $subtotalWidth, $space = 2){
      $menuWrapped = wordwrap($menuCol, $menuWidth, "\n", true);
      $jumlahWrapped = wordwrap($jumlahCol, $jumlahWidth, "\n", true);
      $hargaWrapped = wordwrap($hargaCol, $hargaWidth, "\n", true);
      $subtotalWrapped = wordwrap($subtotalCol, $subtotalWidth, "\n", true);

      $menuLines = explode("\n", $menuWrapped);
      $jumlahLines = explode("\n", $jumlahWrapped);
      $hargaLines = explode("\n", $hargaWrapped);
      $subtotalLines = explode("\n", $subtotalWrapped);
      $allLines = array();
      for ($i = 0; $i < max(count($menuLines), count($jumlahLines), count($hargaLines), count($subtotalLines)); $i ++) {
          $menuPart = str_pad(isset($menuLines[$i]) ? $menuLines[$i] : "", $menuWidth, " ");
          $jumlahPart = str_pad(isset($jumlahLines[$i]) ? $jumlahLines[$i] : "", $jumlahWidth, " ");
          $hargaPart = str_pad(isset($hargaLines[$i]) ? $hargaLines[$i] : "", $hargaWidth, " ");
          $subtotalPart = str_pad(isset($subtotalLines[$i]) ? $subtotalLines[$i] : "", $hsubtotalWidth, " ");
          $allLines[] = $menuPart . str_repeat(" ", $space) . $jumlahPart . str_repeat(" ", $space) . $hargaPart . str_repeat(" ", $space) . $subtotalPart;
      }
      return implode($allLines, "\n") . "\n";
  }

}

class item
{
    private $produk;
    private $price;
    private $price2;
    private $dollarSign;
    private $dollarSign2;
    private $qtySign;
    private $qty;

    public function __construct($name = '', $price = '', $qty = '', $price2='' , $qtySign = false, $dollarSign2 = false, $dollarSign = false)
    {
        $this -> name = $name;
        $this -> qty = $qty;
        $this -> price = $price;
        $this -> price2 = $price2;
        $this -> qtySign = $qtySign;
        $this -> dollarSign = $dollarSign;
        $this -> dollarSign2 =$dollarSign2;
    }

    public function __toString()
    {
        $rightCols = 5;
        $midCols = 9;
        $midCols2 = 10;
        $leftCols = 22;
        if($this -> qtySign){
            $midCols = $midCols / 4 -  $rightCols/4  ;
        }
        if($this -> dollarSign2){
            $midCols2 = $midCols2 /8 - $midCols/8 ;
        }        
        if ($this -> dollarSign) {
            $leftCols = $leftCols / 6 - $midCols / 6;
        }
        $left = str_pad($this -> name, $leftCols);
       
        $sign2 = ($this -> qtySign ? 'qty' : '');
        $sign3 = ($this -> dollarSign2 ? 'harga' : '');
        $sign = ($this -> dollarSign ? 'sub' : ''); 
        $mid = str_pad($sign2 . $this -> qty, $midCols,' ', STR_PAD_LEFT);
        $mid2 = str_pad($sign3 . $this -> price2, $midCols2,' ', STR_PAD_LEFT);
        $right = str_pad($sign . $this -> price, $rightCols,' ', STR_PAD_LEFT);
        return "$left$right$mid$mid2\n";
    }
}