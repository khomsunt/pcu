<?php
include "../include/connection.php";
include "../include/functioin.php";

?>
<nav id="mainTopbar" class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand navbar-btn" href="#" layout="../layout/dashboard.php" page="../dashboard/dashboard.php"
            target_div="display">
            <i class="bi bi-ubuntu"></i>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        ถ่ายโอน
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item navbar-btn" href="#" layout="../layout/dashboard01.php"
                                page="../dashboard/dashboard01.php" target_div="display">Dashboard</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        อุบัติเหตุ
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item navbar-btn" href="#" layout="../layout/map_input.php"
                                page="../map/map_input.php" target_div="display">เพิ่มข้อมูลอุบัติเหตุ</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled">Disabled</a>
                </li>
            </ul>
            <span class="navbar-text" style="padding-top:0px; padding-bottom:0px;">
                <div class="row">
                    <div class="col-lg-8 col-12">
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>

                    </div>
                    <div class="col-lg-4 col-12">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <?php
if (isset($_SESSION['ses_login_userData_val_pcu'])) {
    ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="bi bi-person-fill"></i> ผู้ใช้งาน
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item navbar-btn" href="#" layout="../layout/user.php"
                                            page="../user/profile.php" target_div="display"><i
                                                class="bi bi-person-vcard-fill"></i>
                                            ข้อมูลส่วนตัว</a></li>
                                    <li><a class="dropdown-item navbar-btn" href="#" layout="../layout/dashboard01.php"
                                            page="../dashboard/dashboard01.php" target_div="display"><i
                                                class="bi bi-person-check-fill"></i>
                                            แก้ไขข้อมูลส่วนตัว</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="../line/logout.php"><i
                                                class="bi bi-unlock-fill"></i> Logout</a></li>
                                </ul>
                            </li>
                            <?php
} else {
    ?>
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="https://c77f-61-19-108-218.ngrok-free.app/pcu/line/login.php"><i
                                        class="bi bi-key-fill"></i> Login</a>
                            </li>
                            <?php
}?>
                        </ul>

                    </div>
                </div>

            </span>
        </div>
    </div>
</nav>

<script>
$(function() {
    loadPage("", "../layout/dashboard.php", "display");
    $(document).on("click touchstart", ".navbar-btn", function(e) {
        e.preventDefault();
        setActiveSidebar($(this));
        loadPage($(this).attr("layout"), $(this).attr("page"), $(this).attr("target_div"));
        setCurrentPage($(this).attr("layout"), $(this).attr("page"), $(this).attr("target_div"));
    });
})
</script>