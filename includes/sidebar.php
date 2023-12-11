<!-- Side Navbar -->
<nav class="side-navbar z-index-40">
  <!-- Sidebar Header-->
  <div class="sidebar-header d-flex align-items-center py-4 px-3"><img class="avatar shadow-0 img-fluid rounded-circle"
      src="../assets/img/avatar-1.jpg" alt="...">
    <div class="ms-3  title">
      <h5 class="h4 text-xs mb-2">
        <?php if (isset($_SESSION['name'])) {
          echo $_SESSION['name'];
        } ?>
      </h5>
    </div>
  </div>
  <!-- Sidebar Navidation Menus-->
  <div class="text-uppercase">
    <ul class="list-unstyled ">
      <!-- <li class="sidebar-item "><a href="javascript::" onclick="routeView('pages/countries.php')" class="sidebar-link">kkyk</a></li> -->
      <li class="sidebar-item "><a href="countries.php" class="sidebar-link">
          <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
            <use xlink:href="#real-estate-1"> </use>
          </svg> <b>Countries</b> </a></li>
    </ul>
    <ul class="list-unstyled ">
      <li class="sidebar-item "><a href="states.php" class="sidebar-link" name="states" type="submit">
          <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
            <use xlink:href="#real-estate-1"> </use>
          </svg><b>States</b> </a></li>
    </ul>
    <ul class="list-unstyled ">
      <li class="sidebar-item "><a href="cities.php" class="sidebar-link" name="cities" type="submit">
          <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
            <use xlink:href="#real-estate-1"> </use>
          </svg> <b> Cities</b></a></li>
    </ul>
    <ul class="list-unstyled ">
      <li class="sidebar-item "><a href="area.php" class="sidebar-link" name="area" type="submit">
          <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
            <use xlink:href="#real-estate-1"> </use>
          </svg> <b>Area</b></a></li>
    </ul>
  </div>



</nav>