
function hitungKurang(v){
  var tunai = $("#tunai").val();
  var dp = $("#dp").val();
  var voucher = $("#voucher").val();
  var card = $("#card").val();
  var kredit = $("#kredit").val();


  var total = parseInt(toInt($("#totale").text()));

  // return total-parseInt(v);
  // console.log(v);
  if (v.length==0) {
    v=0;
  }
  $("#kurang").text(total-parseInt(v));
  // var kurang =toInt($("#kurang").text());

}

function toInt(angka){
  return angka.replace(".", "").replace(".", "");
}
  function subTotal(jumlah_transaksi)
  {

    var harga = $('#harga_produk').val().replace(".", "").replace(".", "");
    var diskon= parseInt($("#diskon_produk").val());
    var totalSemua;

    if (diskon!=0) {
          var hitung = harga- harga*(diskon/100) ;
          var totalDiskon = (harga*(diskon/100)) * jumlah_transaksi;

    }
    else{
          var hitung = harga;
          var totalDiskon=0;

    }

          totalSemua = harga * jumlah_transaksi;

    var htg  = hitung *jumlah_transaksi;
    // console.log(hitung);
    $("#total_diskon").val(totalDiskon);
    $("#diskon_angka").val(hitung);

    $("#total_semua").val(totalSemua);

    $('#total_transaksi').val(convertToRupiah(htg));
  }

  function convertToRupiah(angka)
  {

      var rupiah = '';    
      var angkarev = angka.toString().split('').reverse().join('');
      
      for(var i = 0; i < angkarev.length; i++) 
        if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
      
      return rupiah.split('',rupiah.length-1).reverse().join('');
  
  }

  $('.bayar').maskMoney({
    thousands:'.', 
    decimal:',', 
    precision:0
  });

  function hitungKembalian(str)
    {
      var total = $('#total_transaksi').val().replace(".", "").replace(".", "");
      var bayar = str.replace(".", "").replace(".", "");
      var kembali = bayar-total;

      $('#kembalian_transaksi').val(convertToRupiah(kembali));

    }

  //Date picker
  $('#tanggal').datepicker({
    autoclose: true,
    format: 'dd-mm-yyyy'
  });


$(document).on("click",'.menuiteme',function(){

  var href = $(this).attr('data-href');

  $.get(href,function(res){
    $(".tab-pane").html(res);
  });
});

$(document).on("click",'.btn-modal',function(){
  var href = $(this).attr('data-href');
  var title = $(this).attr("data-title");

  $(".modal-title").text(title);
  $.get(href,function(res){
    $('#tanggal').datepicker({
    autoclose: true,
    format: 'dd-mm-yyyy'
  });
    $("#mdl-bdy").html(res);
  })
})

$(document).on("click",".btn-save-bayar",function(){
var type = $(this).attr('data-type');
// alert(type);

  if ($("#id_meja").val().length==0) {

    console.log($("#id_meja option:selected").val().length);
    alert("Silahkan Pilih Meja Terlebih Dahulu")
  }
  else{

    if ($("#pelanggan").val().length==0) {
    alert("Isikan nama Pelanggan");

    }
    else{
      
$("#type").val(type);
  var form = $("#form").serialize();
  var action = $("#form").attr('action');
  $.ajax({
    url: action,
    method: $("#form").attr('method'),
    data: form,
    dataType: "JSON",
    success:function(res){
      // console.log(res)
      if (res.status==1) {

        if (res.statuse=="bayar") {
        $("#wrappp").show();

        }
        else{
        $("#myModal").modal('hide');
        window.location.href="";          
        }

      }
      else{
        alert('gagal');
      }
    }
  }) 
    }


  }

})