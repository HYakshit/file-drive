
<!-- Side Navbar -->
<nav class="side-navbar z-index-40">
  <!-- Sidebar Header-->
  <div class="sidebar-header d-flex align-items-center py-4 px-3"><img class="avatar shadow-0 img-fluid rounded-circle"
      src="../assets/img/<?= $_SESSION['img'] ?>" alt="...">
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
      <li class="sidebar-item "><a href="#" class="sidebar-link">
          <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
            <use xlink:href="#real-estate-1"> </use>
          </svg> <b>Upload Files</b> </a></li>
    </ul>
    <ul class="list-unstyled ">
      <li class="sidebar-item "><a href="#" class="sidebar-link" name="states" type="submit">
          <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
            <use xlink:href="#real-estate-1"> </use>
          </svg><b>Change permissions</b> </a></li>
    </ul>
  </div>
</nav>