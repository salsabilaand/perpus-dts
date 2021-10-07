<?php 
    include '../koneksi.php'; // menyisipkan/memanggil file koneksi.php untuk koneksi data dengan basis data 
    
    $id_transaksi = $_POST['id_transaksi']; 
    $id_buku = $_POST['id_buku']; 
    $id_anggota = $_POST['id_anggota']; 
    $tglpinjam = $_POST['tglpinjam']; 
    $tglkembali = $_POST['tglkembali']; 
    
    if(isset($_POST['simpan'])) { // cek jika ada form yang di submit 
    
        mysqli_query($db, "UPDATE tbtransaksi 
                            SET tglkembali='$tglkembali'
                            WHERE idtransaksi = '$id_transaksi'"); 
    
        header("location:../index.php?p=transaksi-peminjaman"); 
    }
?>