<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle d-flex">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item nav-icon">
                    <div class="position-relative">
                        @php
                            // if($dataUser['status'] == 3){
                            //     $now = strtotime(date("Y-m-d"));
                            //     $dateBuy = strtotime($upgrade);
                            //     $plus = strtotime(date("Y-m-d", strtotime("+1 month", $dateBuy)));
                            //     $selisih = ($plus - $now)/60/60/24;
                            //     if ($selisih <= 0) {
                            //         echo $dataUser['fullname'] .", waktunya premium nih!";
                            //     }
                            // }
                            // else{
                                echo "Halo, ". $dataUser['fullname'];
                            // }
                        @endphp

                    </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-toggle="dropdown">
                    <div class="position-relative">
                        <?php if($dataUser['status'] < 2){ ?>
                            <a href="{{url("user/upgrade")}}"><button type="submit" name="btnUpgrade" class="btn btn-warning" style="color:black">Upgrade</button></a>
                        <?php }else{?>
                            <button type="submit" name="btnUpgrade" class="btn btn-warning" style="color:black" disabled>PREMIUM</button>
                        <?php }?>
                    </div>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle" href="#">
                    <form action="#" method="POST">
                        <div class="position-relative">
                            <a href="{{url("user/logout")}}"><button type="button" style="margin-top: -5px;" class="btn btn-danger">Log Out</button></a>
                        </div>
                    </form>
                </a>
            </li>
        </ul>
    </div>
</nav>
