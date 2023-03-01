<div id="app">
    <div id="sidebar" class="active">
        <div class="sidebar-wrapper active">
            <div class="sidebar-header">
                <div class="d-flex justify-content-between">
                    <div class="logo">
                        <a href="index.php"><img src="assets/apps/logo/logo-white.png" alt="Logo" srcset=""></a>
                    </div>
                    <div class="toggler">
                        <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                    </div>
                </div>
            </div>
            <div class="sidebar-menu">
                <ul class="menu">
                    <li class="sidebar-title">Menu</li>
                    <li class="sidebar-item <?= empty($_GET['m']) ? 'active' : '' ?>">
                        <a href="index.php" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-title">Data</li>


                    <li class="sidebar-item <?= !empty($_GET['m']) && $_GET['m'] == 'BUP' ? 'active' : '' ?>">
                        <a href="index.php?m=BUP&s=index" class='sidebar-link'>
                            <i class="bi bi-file-earmark-medical-fill"></i>
                            <span>BUP</span>
                        </a>
                    </li>
                    <li class="sidebar-item <?= !empty($_GET['m']) && $_GET['m'] == 'BUE' ? 'active' : '' ?>">
                        <a href="index.php?m=BUE&s=index" class='sidebar-link'>
                            <i class="bi bi-file-earmark-medical-fill"></i>
                            <span>BUE</span>
                        </a>
                    </li>
                    <li class="sidebar-title">Pages</li>

                    <li class="sidebar-item <?= !empty($_GET['m']) && $_GET['m'] == 'upload' ? 'active' : '' ?>">
                        <a href="index.php?m=upload&s=index" class='sidebar-link'>
                            <i class="bi bi-cloud-arrow-up-fill"></i>
                            <span>File Uploader</span>
                        </a>
                    </li>

                    <li class="sidebar-title">Raise Support</li>

                    <li class="sidebar-item <?= !empty($_GET['m']) && $_GET['m'] == 'documentation' ? 'active' : '' ?>">
                        <a href="index.php?m=documentation&s=index" class='sidebar-link'>
                            <i class="bi bi-life-preserver"></i>
                            <span>Documentation</span>
                        </a>
                    </li>

                    <li class="sidebar-item  ">
                        <a href="mailto:KNJKT_CI.HELP-RT@KUEHNE-NAGEL.COM?cc=titok.radityo@kuehne-nagel.com,amran.siregar@kuehne-nagel.com&subject=[Add%20Ticket]Report%20Customs%20Track&body=Body-goes-here" target="_blank" class='sidebar-link'>
                            <i class="bi bi-puzzle"></i>
                            <span>RT</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <center>
                            <br>
                            <hr>
                            <img src="assets/apps/kn/knidcore.png" alt="">
                        </center>
                    </li>
                </ul>
            </div>
            <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
        </div>
    </div>