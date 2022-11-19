<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
<link rel="stylesheet" href="../fonts/font.css">
<link rel="stylesheet" href="css.css">
@extends("layout.master")
@section("title", "Report")
@section("content")
<style>
    .form-group{
        margin-bottom: 10px;
    }
    table {
        margin-top : 2%;
    }
    .btnED{
        line-height: 1;
    }
    body{
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        overflow-x: hidden;
        background-image: url("./assets/bgHome.png");
        background-size: 100vw;
        height: 100%;
    }
    .font-navbar{
        font-size: larger;
        font-family:"Bakso Sapi";
    }
    header{
        box-shadow: 0 4px 2px -2px gray;
        width: 100vw;
        background-color: white;
        margin-top: -20px;
    }
    #test{
        width: 8vw;
        margin: -15vw -15vw -15vw -6vw;
    }
</style>
<header>
    <br>
    <nav class="navbar navbar-expand-sm navbar-light">
        <div class="container font-navbar" style="height:7vh;">
            <a class="navbar-brand" href="#">
                <img src="../assets/logo.png" id="test">
            </a>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/admin/dashboard')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/admin/masterUser')}}">Master User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/admin/konfirmasi')}}">Confirm User</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('/admin/laporan')}}">Report</a>
                </li>
            </ul>
            <div class="col-6"></div>
            <a href="{{url('/logout')}}"><button class="btn btn-danger my-2">Logout</button></a>
        </div>
    </nav>
</header>
    <div class="container mt-5">
        <div>
            <h2 style="font-family:'Bakso Sapi'" id="judul">Laporan pada {{$periode}}</h2><br>
            <form action="" method="post">
                @csrf
                <select name="jenis" class="form-control col-3" id="jenis">
                    <option value="bulanan">Bulanan</option>
                    <option value="tahunan">Tahunan</option>
                </select><br>
                <input id="kalenderBulan" type="month" class="form-control col-3" value="">
                <input id="kalenderTahun" type="text" class="form-control col-3" value="">
                <br>
                <button type="submit" class="btn btn-primary" name="btnFilter" value="filter">Set Filter</button>
                <div class="col" id="reportAtas">
                    <canvas id="chartTahunan" style="margin-top: 5vh; margin-bottom: 5vh;" height="75"></canvas>
                </div>
                <input type="hidden" name="report" id="report">
            </form>
        </div>
        <div class="mt-5">
            <h2 style="font-family:'Bakso Sapi'; margin-bottom: 5vh">Insight</h2>
            <div class="row">
                <div class="col-5">
                    <table class="table">
                        <tr>
                            <td><h5>Jumlah user perempuan</h5></td>
                            <td><h5>:</h5></td>
                            <td><h5 id="perempuan">{{$perempuan->count()}}</h5></td>
                        </tr>
                        <tr>
                            <td><h5>Jumlah user laki-laki</h5></td>
                            <td><h5>:</h5></td>
                            <td><h5 id="laki">{{$laki->count()}}</h5></td>
                        </tr>
                    </table>
                </div>
                <div class="col">
                    <canvas id="chartInsight" height="150vh" style="margin-bottom: 15vh;"></canvas>
                </div>
            </div>
        </div>
    </div>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../fonts/font.css">
    <link rel="stylesheet" href="css.css">
    <script src="../css/app.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

    <script>
        var  months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        $(document).ready(function(){
            $("#kalenderTahun").datepicker( {
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years"
            });
            var today = new Date();
            var month = months[today.getMonth()];
            var m = ("0" + (today.getMonth()+1)).slice(-2);
            var year = today.getFullYear();
            $("#kalenderBulan").attr("value", year+"-"+ m);
            $("#kalenderBulan").css("display", "block");
            $("#kalenderTahun").css("display", "none");
            $("#report").val(year+"-"+m);
            $(this).myFunction();


            $("select").on("change", function(){
                if(this.value == 'bulanan'){
                    $("#kalenderBulan").css("display", "block");
                    $("#kalenderTahun").css("display", "none");
                    var today = new Date();
                    var month = ("0" + (today.getMonth()+1)).slice(-2);
                    var year = today.getFullYear();
                    $("#report").val(year+"-"+month);
                    $("#kalenderBulan").attr("type", "month");
                    $("#kalenderBulan").attr("value", year+"-"+ month);
                    month = months[today.getMonth()];

                }else if(this.value == 'tahunan'){
                    $("#kalenderBulan").css("display", "none");
                    $("#kalenderTahun").css("display", "block");
                    $("#kalenderTahun").attr("type", "text");
                    var today = new Date();
                    var year = today.getFullYear();
                    $("#kalenderTahun").attr("value", year);
                    $("#report").val(year);
                }
                $(this).myFunction();
            });

            $("#kalenderBulan").on("change", function(){
                var val = new Date($(this).val());
                var month = months[val.getMonth()];
                var year = val.getFullYear();
                $("#report").val($(this).val());
                $(this).myFunction();
            });

            $("#kalenderTahun").on("change", function(){
                val = new Date($(this).val());
                var year = val.getFullYear();
                $("#report").val(year);
                $(this).myFunction();
            });

        });

        //grafik jk user
        var chartInsight = document.getElementById('chartInsight').getContext('2d');
        var myChart = new Chart("chartInsight", {
            type: "pie",
            data: {
                labels: ["Perempuan", "Laki-Laki"],
                datasets: [{
                    backgroundColor: ["#b91d47", "#00aba9"],
                    data: [$("#perempuan").text(), $("#laki").text()]
                }]
            },
            options: {
                title: {
                display: true,
                text: ""
                }
            }
        });

        //grafik user premium
        (function ($){
            $.fn.myFunction = function(){
                var ct1 = document.getElementById('chartTahunan').getContext('2d');
                var rpt = $("#report").val();
                // alert(rpt);
                var chart1 = new Chart(ct1, {
                    type: 'line',
                    data: {
                        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                        datasets: [{
                            label: "User Premium",
                            backgroundColor: ['transparent'],
                            borderColor: ['red'],
                            data: <?php echo json_encode($data); ?>,
                        }]
                    },
                    options: {
                        title: {
                            display: true,
                            text: ""
                        },
                        elements:{
                            line:{
                                tension: 0
                            }
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    stepSize: 1,
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
                return this;
            };
        })(jQuery);
    </script>
@endsection
