
<!-- Side Navbar -->
<nav class="side-navbar z-index-40">
  <!-- Sidebar Header-->
  <div class="sidebar-header d-flex align-items-center py-4 px-3">
    <!-- img -->
    <!-- <a href="#"><img class="avatar shadow-0 img-fluid rounded-circle"
      src="../assets/img/" alt="...">  </a> -->
    <div class="ms-3  title">
      <h5 class="h4 text-xs mb-2">
        <?php if (isset($_SESSION['user'])) {
          echo $_SESSION['user']['name'];
        } ?>
      
      </h5>
    </div>
  </div>
  <!-- Sidebar Navidation Menus-->
  <div class="text-uppercase">
    <ul class="list-unstyled ">
      <li class="sidebar-item "><a href="files.php" class="sidebar-link" name="states" type="submit">
          <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
            <use xlink:href="#real-estate-1"> </use>
          </svg><b>Shared Files</b> </a></li>
    </ul>
    <!-- <ul class="list-unstyled ">
      <li class="sidebar-item "><a href="edit_categories.php" class="sidebar-link" name="states" type="submit">
          <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
            <use xlink:href="#real-estate-1"> </use>
          </svg><b>Edit Categories</b> </a></li>
    </ul>
    <ul class="list-unstyled ">
      <li class="sidebar-item "><a href="share.php" class="sidebar-link" name="states" type="submit">
          <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
            <use xlink:href="#real-estate-1"> </use>
          </svg><b>Share Files</b> </a></li>
    </ul> -->
  </div>
</nav>