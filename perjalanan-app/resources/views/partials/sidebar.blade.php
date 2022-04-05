<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ $title === 'dashboard' ? '' : 'collapsed' }}" href="/">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link {{ $title === 'edit-tambah-detail-penumpang' ? '' : 'collapsed' }}"
                href="/edit-tambah-detail-penumpang">
                <i class="bi bi-journal-text"></i>
                <span>Edit/Tambah Detail Penumpang</span>
            </a>

        </li><!-- End Form Page Nav -->

        <li class="nav-item">
            <a class="nav-link {{ $title === 'edit-tambah-detail-pengemudi' ? '' : 'collapsed' }} "
                href="/edit-tambah-detail-pengemudi">
                <i class="bi bi-journal-text"></i>
                <span>Edit/Tambah Detail Pengemudi</span>
            </a>
        </li><!-- End Form Page Nav -->

        <li class="nav-item">
            <a class="nav-link {{ $title === 'list-penumpang' ? '' : 'collapsed' }}" href="/list-penumpang">
                <i class="bi bi-layout-text-window-reverse"></i>
                <span>Data Penumpang</span>
            </a>
        </li><!-- End Tables Page Nav -->

        <li class="nav-item">
            <a class="nav-link {{ $title === 'list-pengemudi' ? '' : 'collapsed' }}" href="/list-pengemudi">
                <i class="bi bi-layout-text-window-reverse"></i>
                <span>Data Pengemudi</span>
            </a>
        </li><!-- End Tables Page Nav -->

        <li class="nav-item">
            <a class="nav-link {{ $title === 'login' ? '' : 'collapsed' }}" href="/login">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Login</span>
            </a>
        </li><!-- End Login Page Nav -->
    </ul>

</aside><!-- End Sidebar-->
