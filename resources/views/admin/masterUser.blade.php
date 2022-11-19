@extends("layout.master")
@section("title", "Master User")
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
        background-color: whitesmoke;
        overflow-x: hidden;
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
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('/admin/masterUser')}}">Master User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/admin/konfirmasi')}}">Confirm User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/admin/report')}}">Report</a>
                </li>
            </ul>
            <div class="col-6"></div>
            <a href="{{url('/logout')}}"><button class="btn btn-danger my-2">Logout</button></a>
        </div>
    </nav>
</header>

<div class="container mt-5">
    <h3 class="m-5">Users Total : {{$users->count()}}</h3>
    <h5 class="m-5">Premium Users : {{$prem->count()}}</h5>
    <table class="table table-striped" id="dt">
        <thead style="background-color: #582480; color:ghostwhite">
            <tr>
                <th>No.</th>
                <th>Full Name</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @if ($users->count() > 0)
                @for ($i = 0; $i < $users->count(); $i++)
                    <tr>
                        <td>{{$i+1}}</td>
                        <td>{{$users[$i]->fullname}}</td>
                        <?php $status = ""; ?>
                        @if ($users[$i]->status == -1)
                            <?php $status = "not verified";?>
                        @elseif ($users[$i]->status == 0)
                            <?php $status = "standard";?>
                        @elseif ($users[$i]->status == 1)
                            <?php $status = "menunggu konfirmasi admin";?>
                        @else
                            <?php $status = "premium";?>
                        @endif
                        <td>{{$status}}</td>
                    </tr>
                @endfor
            @else

            @endif
        </tbody>
    </table>
</div>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="../fa/css/all.css">
<link rel="stylesheet" href="../fonts/font.css">
<link rel="stylesheet" href="css.css">
@endsection
