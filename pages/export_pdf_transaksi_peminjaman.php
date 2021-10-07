<?php 
    require ("../vendor/autoload.php");    // load file autoload.php dari composer
    require ("../koneksi.php");            // load konfigurasi untuk koneksi ke DB

    use Dompdf\Dompdf;                  // panggil referensi namespace dari library Dompdf
    use Dompdf\Options;

    $html = '<h1>Data Transaksi Perpustakaan Umum</h1>';
    $html .= '<table width="100%" border="1" cellspacing="0" cellpadding="2">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Transaksi</th>
                        <th>ID Anggota</th>
                        <th>ID Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                    </tr>
                </thead>
                <tbody>';
    $nomor = 1; 
    $query = "SELECT * FROM tbtransaksi ORDER BY idtransaksi DESC"; 
    $q_tampil_transaksi = mysqli_query($db, $query); 

    if(mysqli_num_rows($q_tampil_transaksi) > 0) { 
        // looping semua data pada tabel tbbuku 
        while($r_tampil_transaksi=mysqli_fetch_array($q_tampil_transaksi)) { 
            
            $html .= '<tr>
                        <td>'.$nomor.'</td>
                        <td>'.$r_tampil_transaksi['idtransaksi'].'</td>
                        <td>'.$r_tampil_transaksi['idbuku'].'</td>
                        <td>'.$r_tampil_transaksi['idanggota'].'</td>
                        <td>'.$r_tampil_transaksi['tglpinjam'].'</td>
                        <td>'.$r_tampil_transaksi['tglkembali'].'</td>
                    </tr>';  
                    $nomor++; 
        } // end looping 
    } else {
            $html .= '<tr><td colspan="4" align="center">Tidak Ada Data</td></tr>';
    }         
            
    $html .= '</tbody></html>'; 
    // echo $html;

    $dompdf = new Dompdf();                         // instansiasi class Dompdf
    $dompdf->set_option('isRemoteEnabled', TRUE);
    $dompdf->loadHtml($html);                       // isi konten (format HTML) untuk dokumen pdf
    $dompdf->setPaper('a4','landscape');            // set ukuran dan orientasi dokumen pdf
    $dompdf->render();                              // vender kode HTML menjadi pdf
    $dompdf->stream('data_transaksi_perpustakaan.pdf'); // stream pdf ke browser
?>       