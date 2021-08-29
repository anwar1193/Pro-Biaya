$(document).ready(function() {

    // Setelah tombol kirim memo di klik, tombol tsb menghilang
    $(document).on('click', '#tombol_memo', function(){
      var nomor_memo = $('#nomor_memo').val();
      var perihal = $('#perihal').val();

      if(nomor_memo != '' && perihal != ''){
        $(this).hide();
      }
      
    });

});