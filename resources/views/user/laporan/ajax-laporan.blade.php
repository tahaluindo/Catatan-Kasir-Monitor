@if($totalPemasukan > 0 || $totalPengeluaran > 0)
<input type="hidden" id="pemasukan" value={{$totalPemasukan}}>
<input type="hidden" id="pengeluaran" value={{$totalPengeluaran}}>
<h2 style="font-family: 'Bakso Sapi'; font-size: 30pt">Summary</h2>
    <div class="col mt-3">
        <table class="table" style="font-size: 15pt">
                <tr class="table-success">
                    <td>Semua Pemasukan</td>
                    <td>(+)</td>
                    <td>Rp</td>
                    <td class="text-right"><?=number_format($totalPemasukan,2,',','.')?></td>
                </tr>
                <tr class="table-danger">
                    <td>Semua Pengeluaran</td>
                    <td>(-)</td>
                    <td>Rp</td>
                    <td class="text-right"><?=number_format($totalPengeluaran,2,',','.')?></td>
                </tr>
                <tr class="table-light font-weight-bold">
                    <td colspan="2">Total</td>
                    <td>Rp</td>
                    <td class="text-right <?php if($total < 0) echo 'text-danger'; else echo 'text-success';?>"><?=number_format($total,2,',','.')?></td>
                </tr>
            <?php  ?>
        </table>
    </div>
    <div class="col">
        <canvas id="chartjs_bar"></canvas>
    </div>
@else
<h5 class="text-center mt-5" style="font-size:15pt">Anda tidak memiliki transaksi pada periode ini.</h5>
@endif

<!-- script -->
<script>
    var ctx = document.getElementById('chartjs_bar').getContext('2d');
    var pemasukan = document.getElementById('pemasukan').value;
    var pengeluaran = document.getElementById('pengeluaran').value;
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
        data: {
            labels: ["Pemasukan", "Pengeluaran"],
            datasets: [{
                label: "Pemasukan VS Pengeluaran",
                backgroundColor: ['rgb(194, 242, 115)', 'rgb(255, 99, 132)'],
                data: [pemasukan, pengeluaran],
            }]
        },

        options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
    });
</script>
