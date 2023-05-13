<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="dashboard.php"><i class="icofont-cow"></i>Agrotechfarm</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="dashboard.php">AF</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown <?= activeLink("dashboard.php") ?>">
                <a href="dashboard.php" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Data List</li>
            <?php if (visible("user", $data['status'])) : ?>
                <li class="dropdown <?= activeLink("hewanUser.php") ?>">
                    <a href="hewanUser.php" class="nav-link"><i class="fas fa-box"></i><span>Data Hewan</span></a>
                </li>
            <?php endif; ?>
            <?php if (visible("admin|manager", $data['status'])) : ?>
                <li class="dropdown <?= activeLink("user.php") ?>">
                    <a href="user.php" class="nav-link"><i class="fas fa-user"></i><span>Pegawai</span></a>
                </li>
            <?php endif; ?>
            <?php if (visible("admin|manager", $data['status'])) : ?>
                <li class="dropdown <?= activeLink("hewan.php") ?>">
                    <a href="hewan.php" class="nav-link"><i class="fas fa-box"></i><span>Data Hewan</span></a>
                </li>
            <?php endif; ?>
            <li class="menu-header">Market</li>
            <?php if (visible("user", $data['status'])) : ?>
                <li class="dropdown <?= activeLink("pemesananUser.php") ?>">
                    <a href="pemesananUser.php" class="nav-link"><i class="fas fa-user-friends"></i><span>Pemesanan</span></a>
                </li>
            <?php endif; ?>
            <?php if (visible("user", $data['status'])) : ?>
                <li class="dropdown <?= activeLink("transaksiUser.php") ?>">
                    <a href="transaksiUser.php" class="nav-link"><i class="fas fa-coins"></i><span>Transaksi</span></a>
                </li>
            <?php endif; ?>
            <?php if (visible("admin|kasir", $data['status'])) : ?>
                <li class="dropdown <?= activeLink("pemesanan.php") ?>">
                    <a href="pemesanan.php" class="nav-link"><i class="fas fa-user-friends"></i><span>Pemesanan</span></a>
                </li>
            <?php endif; ?>
            <?php if (visible("admin|kasir", $data['status'])) : ?>
                <li class="dropdown <?= activeLink("transaksi.php") ?>">
                    <a href="transaksi.php" class="nav-link"><i class="fas fa-coins"></i><span>Transaksi</span></a>
                </li>
            <?php endif; ?>
            <?php if (visible("admin|manager|kasir", $data['status'])) : ?>
                <li class="dropdown <?= activeLink("pesan.php") ?>">
                    <a href="pesan.php" class="nav-link"><i class="fas fa-envelope"></i><span>Pengaduan</span></a>
                </li>
            <?php endif; ?>
        </ul>
    </aside>
</div>