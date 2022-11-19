@if($totalPemasukan > 0 || $totalPengeluaran > 0)
<h1 style="font-family: 'Bakso Sapi'">Pengeluaran</h1><hr>
@if($totalPengeluaran > 0)
    <canvas id="chart_pengeluaran" height="40vh" width="80vw"></canvas>
    <table class="table mt-5">
        @for ($i=0; $i<count($katName); $i++)
        <tr>
            <td style="width: 70%;"><a href="/user/laporan/{{$jenis}}/{{$idBuku}}/{{$periode}}/{{$katId[$i]}}">{{$katName[$i]}}</a></td>
            <td>Rp</td>
            <td class="text-right"><?=number_format($katNominal[$i],2,',','.')?></td>
        </tr>
        @endfor
    <tr class="font-weight-bold">
        <td>Total</td>
        <td>Rp</td>
        <td class="text-right"><?=number_format($totals,2,',','.')?></td>
    </tr>
</table>
@else
<h3>Tidak ada transaksi pengeluaran</h3>
@endif
@endif
<script>
    var ct1 = document.getElementById('chart_pengeluaran').getContext('2d');
    var chart1 = new Chart(ct1, {
        // The type of chart we want to create
        type: 'pie',

        // The data for our dataset
        data: {
            labels: {!! json_encode($katName) !!},
            datasets: [{
                backgroundColor: {!! json_encode($katColor) !!},
                borderColor: {!! json_encode($katColor) !!},
                data: {!! json_encode($katNominal) !!},
            }]
        },
        options: {
            cutoutPercentage: 10,
        }
    });
</script>
