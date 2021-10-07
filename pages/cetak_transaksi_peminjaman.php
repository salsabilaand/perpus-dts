<?php 
    include "../koneksi.php"; // menyisipkan/memanggil file koneksi.php untuk koneksi data dengan basis data 
?> 
<link rel="stylesheet" type="text/css" href="../style.css"> 
<h3>Data Transaksi</h3> 
<div id="content"> 
    <table border="1" id="tabel-tampil">
        <thead> 
            <tr> 
                <th id="label-tampil-no">No</td> 
                <th>ID Transaksi</th> 
                <th>ID Buku</th>  
                <th>ID Anggota</th>
                <th>Tanggal Peminjaman</th> 
                <th>Tanggal Pengembalian</th> 
            </tr> 
        </thead> 
        <tbody> 
            <?php 
                $nomor = 1; 
                $query = "SELECT * FROM tbtransaksi ORDER BY idtransaksi DESC"; 
                $q_tampil_transaksi = mysqli_query($db, $query); 

                if(mysqli_num_rows($q_tampil_transaksi) > 0) { 
                    // looping semua data pada tabel tbbuku 
                    while($r_tampil_transaksi=mysqli_fetch_array($q_tampil_transaksi)) { 
            ?>
            <tr>
                <td><?php echo $nomor; ?></td>
                <td><?php echo $r_tampil_transaksi['idtransaksi']; ?></td>
                <td><?php echo $r_tampil_transaksi['idbuku']; ?></td>
                <td><?php echo $r_tampil_transaksi['idanggota']; ?></td>
                <td><?php echo $r_tampil_transaksi['tglpinjam']; ?></td>
                <td><?php echo $r_tampil_transaksi['tglkembali']; ?></td>
            </tr> 
            <?php 
                        $nomor++; 
                    } // end looping 
                } // end if 
            ?> 
    </table> 
    <script> 
        window.print(); 
    </script> 
</div>