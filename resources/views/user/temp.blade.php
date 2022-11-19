<?php
    include "../conn.php";
    include "user-helper.php";

    if(isset($_POST['btnCancel'])){
        header("Location: bukus.php?id_buku=".$_GET['idBuku']);

    }else if(isset($_POST['btnSave'])){
        if($_POST['buku1'] != $_POST['buku2']){
            $jumlah = $_POST['jumlah'];
            if($jumlah != ""){
                if(intval($jumlah) > 0){
                    $buku1 = $_POST['buku1'];
                    $buku2 = $_POST['buku2'];
                    $saldoBuku1 = mysqli_query($conn, "SELECT saldo_akhir FROM bukus WHERE id_buku = '$buku1'")->fetch_assoc()['saldo_akhir'];
                    if(intval($jumlah) <= intval($saldoBuku1)){
                        $saldoBuku2 = mysqli_query($conn, "SELECT saldo_akhir FROM bukus WHERE id_buku = '$buku2'")->fetch_assoc()['saldo_akhir'] + intval($jumlah);
                        $saldoBuku1 -= intval($jumlah);
                        $query1 = mysqli_query($conn, "UPDATE bukus SET saldo_akhir = '$saldoBuku1' WHERE id_buku = '$buku1'");
                        $query2 = mysqli_query($conn, "UPDATE bukus SET saldo_akhir = '$saldoBuku2' WHERE id_buku = '$buku2'");
                        header("Location: bukus.php?id_buku=".$_GET['idBuku']);
                    }else {$msg="Nominal melebihi saldo maksimum buku kas!"; $icon="error";}
                }else {$msg="Nominal harus lebih dari 0!"; $icon="error";}
            }else {$msg="Isi nominal!"; $icon="error";}
        }else {$msg="Buku kas pengirim dan penerima harus berbeda!"; $icon="error";}
    }
?>
