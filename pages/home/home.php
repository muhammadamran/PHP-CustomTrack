<title>Dashboard | Customs Track - Application</title>
<div id="main-content">
  <!-- Heading -->
  <div class="page-heading">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
          <h3>Dashboard</h3>
          <p class="text-subtitle text-muted">Date <?= date('d F Y') ?> - Time <?= date('H:i A') ?></p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
          <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item active"><a href="index.php">Dashboard</a></li>
              <!-- <li class="breadcrumb-item active" aria-current="page">Dashboard</li> -->
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <!-- End Heading -->
  <section class="row">
    <div class="col-12 col-lg-9">
      <div class="row">
        <div class="col-6 col-lg-3 col-md-6">
          <div class="card">
            <div class="card-body px-3 py-4-5">
              <div class="row">
                <div class="col-md-4">
                  <div class="stats-icon darkblue">
                    <i class="iconly-boldUpload"></i>
                  </div>
                </div>
                <div class="col-md-8">
                  <h6 class="text-muted font-semibold">Upload BUP</h6>
                  <h6 class="font-extrabold mb-0">112.000</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
          <div class="card">
            <div class="card-body px-3 py-4-5">
              <div class="row">
                <div class="col-md-4">
                  <div class="stats-icon lightblue">
                    <i class="iconly-boldPaper"></i>
                  </div>
                </div>
                <div class="col-md-8">
                  <h6 class="text-muted font-semibold">Record BUP</h6>
                  <h6 class="font-extrabold mb-0">183.000</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
          <div class="card">
            <div class="card-body px-3 py-4-5">
              <div class="row">
                <div class="col-md-4">
                  <div class="stats-icon lightgreen">
                    <i class="iconly-boldUpload"></i>
                  </div>
                </div>
                <div class="col-md-8">
                  <h6 class="text-muted font-semibold">Upload BUE</h6>
                  <h6 class="font-extrabold mb-0">80.000</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
          <div class="card">
            <div class="card-body px-3 py-4-5">
              <div class="row">
                <div class="col-md-4">
                  <div class="stats-icon natural4">
                    <i class="iconly-boldPaper"></i>
                  </div>
                </div>
                <div class="col-md-8">
                  <h6 class="text-muted font-semibold">Record BUE</h6>
                  <h6 class="font-extrabold mb-0">112</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Profile Visit</h4>
            </div>
            <div class="card-body">
              <div id="chart-profile-visit"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-lg-3">
      <div class="card">
        <div class="card-body py-4 px-5">
          <div class="d-flex align-items-center">
            <div class="avatar avatar-xl">
              <div class="header-profiles-home">
                <?php
                $myString = $_SESSION['username'];
                if (strstr($myString, '.')) {
                  $FL    = explode('.', $myString);
                  $F     = $FL[0];
                  $L     = $FL[1];
                  $showU = substr($F, 0, 1) . "" . substr($L, 0, 1);
                  $showD = "<font style='text-transform: capitalize;'>$L</font>, <font style='text-transform: capitalize;'>$F</font> / Kuehne + Nagel";
                } else {
                  $F     = $myString;
                  $L     = $myString;
                  $showU = substr($myString, 0, 1) . "" . substr($myString, 0, 1);
                  $showD = "<font style='text-transform: capitalize;'>$L</font>, <font style='text-transform: capitalize;'>$F</font> / Kuehne + Nagel";
                }
                ?>
                <font style="text-transform: uppercase;"><?= $showU; ?></font>
              </div>
            </div>
            <div class="ms-3 name">
              <h5 class="font-bold"><?= $_SESSION['name']; ?></h5>
              <h6 class="text-muted mb-0" style="font-size: 10px;"><?= $_SESSION['email']; ?></h6>
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header">
          <h4>Record File BUP & BUE</h4>
        </div>
        <div class="card-body">
          <div id="chart-visitors-profile"></div>
        </div>
      </div>
    </div>
  </section>
</div>
<script src="assets/vendors/apexcharts/apexcharts.js"></script>
<script src="assets/js/pages/dashboard.js"></script>