$(document).ready(function(){

      // Setelah tombol kirim di klik, tombol tsb menghilang
      $(document).on('click', '#tombol_kirim', function(){
        // inisiasi variable harus di dalam function ya (biar terpanggil)
        var jenis_pembayaran2 = $('#tipe_transaksi').val();

        var tanggal1 = $('#tgl_min_bayar1').val();
        var tanggal2 = $('#tgl_min_bayar2').val();
        var tanggal3 = $('#tgl_min_bayar3').val();
        var tanggal4 = $('#tgl_min_bayar4').val();
        var tanggal5 = $('#tgl_min_bayar5').val();
        var tanggal6 = $('#tgl_min_bayar6').val();
        var tanggal7 = $('#tgl_min_bayar7').val();
        var tanggal8 = $('#tgl_min_bayar8').val();
        var tanggal9 = $('#tgl_min_bayar9').val();
        var tanggal10 = $('#tgl_min_bayar10').val();
        var tanggal11 = $('#tgl_min_bayar11').val();
        var tanggal12 = $('#tgl_min_bayar12').val();

        var bayar1 = $('#bayar1').val();
        var bayar2 = $('#bayar2').val();
        var bayar3 = $('#bayar3').val();
        var bayar4 = $('#bayar4').val();
        var bayar5 = $('#bayar5').val();
        var bayar6 = $('#bayar6').val();
        var bayar7 = $('#bayar7').val();
        var bayar8 = $('#bayar8').val();
        var bayar9 = $('#bayar9').val();
        var bayar10 = $('#bayar10').val();
        var bayar11 = $('#bayar11').val();
        var bayar12 = $('#bayar12').val();

        var nomor_invoice = $('#nomor_invoice').val();
        var bank_penerima = $('#bank_penerima').val();
        var norek_penerima = $('#norek_penerima').val();
        var atas_nama = $('#atas_nama').val();

        if(jenis_pembayaran2 == 1){
            if(bayar1 == 0){
                alert("Jumlah Bayar Tidak Boleh 0 Di Setiap Termin Pembayaran");
                return false;
            }else{
                if(tanggal1 != '' && nomor_invoice != '' && bank_penerima != '' && norek_penerima != '' && atas_nama != ''){
                    $(this).hide();
                }
            }
        }

        else if(jenis_pembayaran2 == 2){
            if(bayar1 == 0 || bayar2 == 0){
                alert("Jumlah Bayar Tidak Boleh 0 Di Setiap Termin Pembayaran");
                return false;
            }else{
                if(tanggal1 != '' && tanggal2 != '' && nomor_invoice != '' && bank_penerima != '' && norek_penerima != '' && atas_nama != ''){
                    $(this).hide();
                }
            }
        }

        else if(jenis_pembayaran2 == 3){
            if(bayar1 == 0 || bayar2 == 0 || bayar3 == 0){
                alert("Jumlah Bayar Tidak Boleh 0 Di Setiap Termin Pembayaran");
                return false;
            }else{
                if(tanggal1 != '' && tanggal2 != '' && tanggal3 != '' && nomor_invoice != '' && bank_penerima != '' && norek_penerima != '' && atas_nama != ''){
                    $(this).hide();
                }
            }
        }

        else if(jenis_pembayaran2 == 4){
            if(bayar1 == 0 || bayar2 == 0 || bayar3 == 0 || bayar4 == 0){
                alert("Jumlah Bayar Tidak Boleh 0 Di Setiap Termin Pembayaran");
                return false;
            }else{
                if(tanggal1 != '' && tanggal2 != '' && tanggal3 != '' && tanggal4 != '' && nomor_invoice != '' && bank_penerima != '' && norek_penerima != '' && atas_nama != ''){
                    $(this).hide();
                }
            }            
        }

        else if(jenis_pembayaran2 == 5){
            if(bayar1 == 0 || bayar2 == 0 || bayar3 == 0 || bayar4 == 0 || bayar5 == 0){
                alert("Jumlah Bayar Tidak Boleh 0 Di Setiap Termin Pembayaran");
                return false;
            }else{
                if(tanggal1 != '' && tanggal2 != '' && tanggal3 != '' && tanggal4 != '' && tanggal5 != '' && nomor_invoice != '' && bank_penerima != '' && norek_penerima != '' && atas_nama != ''){
                    $(this).hide();
                }
            }      
        }

        else if(jenis_pembayaran2 == 6){
            if(bayar1 == 0 || bayar2 == 0 || bayar3 == 0 || bayar4 == 0 || bayar5 == 0 || bayar6 == 0){
                alert("Jumlah Bayar Tidak Boleh 0 Di Setiap Termin Pembayaran");
                return false;
            }else{
                if(tanggal1 != '' && tanggal2 != '' && tanggal3 != '' && tanggal4 != '' && tanggal5 != '' && tanggal6 != '' && nomor_invoice != '' && bank_penerima != '' && norek_penerima != '' && atas_nama != ''){
                    $(this).hide();
                }
            }
        }

        else if(jenis_pembayaran2 == 7){
            if(bayar1 == 0 || bayar2 == 0 || bayar3 == 0 || bayar4 == 0 || bayar5 == 0 || bayar6 == 0 || bayar7 == 0){
                alert("Jumlah Bayar Tidak Boleh 0 Di Setiap Termin Pembayaran");
                return false;
            }else{
                if(tanggal1 != '' && tanggal2 != '' && tanggal3 != '' && tanggal4 != '' && tanggal5 != '' && tanggal6 != '' && tanggal7 != '' && nomor_invoice != '' && bank_penerima != '' && norek_penerima != '' && atas_nama != ''){
                    $(this).hide();
                }
            }
        }

        else if(jenis_pembayaran2 == 8){
            if(bayar1 == 0 || bayar2 == 0 || bayar3 == 0 || bayar4 == 0 || bayar5 == 0 || bayar6 == 0 || bayar7 == 0 || bayar8 == 0){
                alert("Jumlah Bayar Tidak Boleh 0 Di Setiap Termin Pembayaran");
                return false;
            }else{
                if(tanggal1 != '' && tanggal2 != '' && tanggal3 != '' && tanggal4 != '' && tanggal5 != '' && tanggal6 != '' && tanggal7 != '' && tanggal8 != '' && nomor_invoice != '' && bank_penerima != '' && norek_penerima != '' && atas_nama != ''){
                    $(this).hide();
                }
            }  
        }

        else if(jenis_pembayaran2 == 9){
            if(bayar1 == 0 || bayar2 == 0 || bayar3 == 0 || bayar4 == 0 || bayar5 == 0 || bayar6 == 0 || bayar7 == 0 || bayar8 == 0 || bayar9 == 0){
                alert("Jumlah Bayar Tidak Boleh 0 Di Setiap Termin Pembayaran");
                return false;
            }else{
                if(tanggal1 != '' && tanggal2 != '' && tanggal3 != '' && tanggal4 != '' && tanggal5 != '' && tanggal6 != '' && tanggal7 != '' && tanggal8 != '' && tanggal9 != '' && nomor_invoice != '' && bank_penerima != '' && norek_penerima != '' && atas_nama != ''){
                    $(this).hide();
                }
            }  
        }

        else if(jenis_pembayaran2 == 10){
            if(bayar1 == 0 || bayar2 == 0 || bayar3 == 0 || bayar4 == 0 || bayar5 == 0 || bayar6 == 0 || bayar7 == 0 || bayar8 == 0 || bayar9 == 0 || bayar10 == 0){
                alert("Jumlah Bayar Tidak Boleh 0 Di Setiap Termin Pembayaran");
                return false;
            }else{
                if(tanggal1 != '' && tanggal2 != '' && tanggal3 != '' && tanggal4 != '' && tanggal5 != '' && tanggal6 != '' && tanggal7 != '' && tanggal8 != '' && tanggal9 != '' && tanggal10 != '' && nomor_invoice != '' && bank_penerima != '' && norek_penerima != '' && atas_nama != ''){
                    $(this).hide();
                }
            }
        }

        else if(jenis_pembayaran2 == 11){
            if(bayar1 == 0 || bayar2 == 0 || bayar3 == 0 || bayar4 == 0 || bayar5 == 0 || bayar6 == 0 || bayar7 == 0 || bayar8 == 0 || bayar9 == 0 || bayar10 == 0 || bayar11 == 0){
                alert("Jumlah Bayar Tidak Boleh 0 Di Setiap Termin Pembayaran");
                return false;
            }else{
                if(tanggal1 != '' && tanggal2 != '' && tanggal3 != '' && tanggal4 != '' && tanggal5 != '' && tanggal6 != '' && tanggal7 != '' && tanggal8 != '' && tanggal9 != '' && tanggal10 != '' && tanggal11 != '' && nomor_invoice != '' && bank_penerima != '' && norek_penerima != '' && atas_nama != ''){
                    $(this).hide();
                }
            }
        }

        else if(jenis_pembayaran2 == 12){
            if(bayar1 == 0 || bayar2 == 0 || bayar3 == 0 || bayar4 == 0 || bayar5 == 0 || bayar6 == 0 || bayar7 == 0 || bayar8 == 0 || bayar9 == 0 || bayar10 == 0 || bayar11 == 0 || bayar12 == 0){
                alert("Jumlah Bayar Tidak Boleh 0 Di Setiap Termin Pembayaran");
                return false;
            }else{
                if(tanggal1 != '' && tanggal2 != '' && tanggal3 != '' && tanggal4 != '' && tanggal5 != '' && tanggal6 != '' && tanggal7 != '' && tanggal8 != '' && tanggal9 != '' && tanggal10 != '' && tanggal11 != '' && tanggal12 != '' && nomor_invoice != '' && bank_penerima != '' && norek_penerima != '' && atas_nama != ''){
                    $(this).hide();
                }
            }
        }
        
      });

});