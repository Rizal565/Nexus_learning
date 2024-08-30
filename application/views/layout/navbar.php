<nav class="main-header navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a href="<?= base_url() ?>" class="navbar-brand">
            <span class="navbar-brand">Nexus Learning</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <div class="container">
            <!-- Left navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item <?= ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'home') ? 'active' : '' ?>">
                    <a href="<?= base_url() ?>" class="nav-link">Home</a>
                </li>
                <?php if ($this->session->userdata('role') === 'administrator') : ?>
                    <li class="nav-item dropdown <?= ($this->uri->segment(1) == 'data-admin' || $this->uri->segment(1) == 'data-pengunjung' || $this->uri->segment(1) == 'data-kategori') ? 'active' : '' ?>">
                        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Data Master</a>
                        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                            <li><a href="<?= base_url('data-admin') ?>" class="dropdown-item">Data Admin</a></li>
                            <li><a href="<?= base_url('data-pengunjung') ?>" class="dropdown-item">Data Pengunjung</a></li>
                            <li><a href="<?= base_url('data-kategori') ?>" class="dropdown-item">Data Kategori</a></li>
                        </ul>
                    </li>
                    <li class="nav-item <?= ($this->uri->segment(1) == 'materi') ? 'active' : '' ?>">
                        <a href="<?= base_url('materi') ?>" class="nav-link">Materi</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item <?= ($this->uri->segment(1) == 'materi') ? 'active' : '' ?>">
                        <a href="<?= base_url('materi') ?>" class="nav-link">Materi</a>
                    </li>
                <?php endif; ?>
            </ul>
            </div>
        </div>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav ml-auto">
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
             <a class="nav-link" data-toggle="dropdown" href="#">
                 <i class="fas fa-cog"></i>
             </a>
            <div class="dropdown-menu dropdown-menu-right">
        <a href="<?= base_url('user/index/' . $this->session->id) ?>" class="dropdown-item">
            <i class="fas fa-user"></i> Edit Profile
        </a>
        <div class="dropdown-divider"></div>
        <a href="<?= base_url('logout') ?>" class="dropdown-item">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>
</li>

        </ul>
    </div>
</nav>