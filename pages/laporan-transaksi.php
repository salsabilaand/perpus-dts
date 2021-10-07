<div id="label-page"><h3>Tampil Data Transaksi</h3></div> 
<div id="content">
    <p id="tombol-tambah-container">
        <div class="form-inline"> 
            <div align="right"> 
                <form method=post> 
                    <input type="text" name="pencarian"> 
                    <input type="submit" name="search" value="search" class="tombol"> 
                </form> 
            </div> 
        </div>
    </p> 
    <table id="tabel-tampil"> 
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
                $batas = 5;
                extract($_GET); 
                if(empty($hal)) { 
                    $posisi = 0; 
                    $hal = 1; 
                    $nomor = 1; 
                }else { 
                    $posisi = ($hal - 1) * $batas; 
                    $nomor = $posisi+1; 
                }

                if($_SERVER['REQUEST_METHOD'] == "POST") { 
                    $pencarian = trim(mysqli_real_escape_string($db, $_POST['pencarian'])); 
                    if($pencarian != "") { 
                        $sql = "SELECT * FROM tbtransaksi WHERE judul LIKE '%$pencarian%' 
                                OR idtransaksi LIKE '%$pencarian%'
                                OR idbuku LIKE '%$pencarian%' 
                                OR idanggota LIKE '%$pencarian%' 
                                OR tglpinjam LIKE '%$pencarian%'
                                OR tglkembali LIKE '%$pencarian%'"; 

                        $query = $sql; 
                        $queryJml = $sql; 

                    } else { 
                        $query = "SELECT * FROM tbtransaksi LIMIT  $posisi, $batas"; 
                        $queryJml = "SELECT * FROM tbtransaksi"; 
                        $no = $posisi * 1; 
                    }
                }
                else { 
                    $query = "SELECT * FROM tbtransaksi LIMIT $posisi, $batas"; 
                    $queryJml = "SELECT * FROM tbtransaksi"; 
                    $no = $posisi * 1; 
                }

                $q_tampil_transaksi = mysqli_query($db, $query); 

                if(mysqli_num_rows($q_tampil_transaksi) > 0) { 
                    while($r_tampil_transaksi=mysqli_fetch_array($q_tampil_transaksi)) {
            ?>
            <tr height="60px">
                <td><?php echo $nomor; ?></td>
                <td><?php echo $r_tampil_transaksi['idtransaksi']; ?></td>
                <td><?php echo $r_tampil_transaksi['idbuku']; ?></td>
                <td><?php echo $r_tampil_transaksi['idanggota']; ?></td>
                <td><?php echo $r_tampil_transaksi['tglpinjam']; ?></td>
                <td><?php echo $r_tampil_transaksi['tglkembali']; ?></td>
            </tr>
            <?php 
                        $nomor++;  
                    }   // selesai looping while 
                } 
                else { 
                    echo "<tr><td colspan=6>Data Tidak Ditemukan</td></tr>"; 
                }
            ?> 
        </tbody>
    </table>
    
    <?php 
    if(isset($_POST['pencarian'])) { 
        if($_POST['pencarian']!='') { 
            echo "<div style=\"float:left;\">"; 
            $jml = mysqli_num_rows(mysqli_query($db, $queryJml)); 
            echo "Data Hasil Pencarian: <b>$jml</b>"; 
            echo "</div>"; 
        }
    } else { 
    ?> 
        <div style="float: left;"> 
        <?php 
            $jml = mysqli_num_rows(mysqli_query($db, $queryJml)); 
            echo "Jumlah Data : <b>$jml</b>"; 
        ?> 
        </div>
        <div class="pagination" style="float: right;"> 
            <?php 
                $jml_hal = ceil($jml / $batas); 
                for($i = 1; $i <= $jml_hal; $i++) { 
                    if($i != $hal) { 
                        echo "<a href=\"?p=laporan-transaksi&hal=$i\">$i</a>"; 
                    } else { 
                        echo "<a class=\"active\">$i</a>"; 
                    } 
                }
            ?>
        </div> 
    <?php 
    } 
    ?> 
</div> 