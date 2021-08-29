$(document).ready(function(){

    // Setelah tombol kirim di klik, tombol tsb menghilang
    $(document).on('click', '#tombol_kirim', function(){
      // inisiasi variable harus di dalam function ya (biar terpanggil)

      var nomor_invoice = $('#nomor_invoice').val();
      var bank_penerima = $('#bank_penerima').val();
      var norek_penerima = $('#norek_penerima').val();
      var atas_nama = $('#atas_nama').val();

      if(nomor_invoice != '' && bank_penerima != '' && norek_penerima != '' && atas_nama != ''){
        $(this).hide();
      }
      
    });

});