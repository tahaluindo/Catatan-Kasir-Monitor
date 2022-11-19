<script src="{{asset("cdn.jsdelivr.net/npm/sweetalert2@10")}}"></script>
<?php
    if($icon != ""){
        echo "<script>Swal.fire(
            '$title',
            '$msg',
            '$icon'
            )</script>";
    }
    if($timer != -1){
        echo "<script>Swal.fire({
                position: 'top-end',
                icon: '$icon',
                title: '$title',
                showConfirmButton: false,
                timer: $timer
            })</script>";
    }
?>
