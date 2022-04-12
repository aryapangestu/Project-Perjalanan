<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ $title === 'Dashboard Admin' ? '' : 'collapsed' }}" href="/">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link {{ $title === 'List-penumpang Admin' ? '' : 'collapsed' }}" href="/list-penumpang">
                <i class="bi bi-layout-text-window-reverse"></i>
                <span>Data Penumpang</span>
            </a>
        </li><!-- End Tables Page Nav -->

        <li class="nav-item">
            <a class="nav-link {{ $title === 'List-pengemudi Admin' ? '' : 'collapsed' }}" href="/list-pengemudi">
                <i class="bi bi-layout-text-window-reverse"></i>
                <span>Data Pengemudi</span>
            </a>
        </li><!-- End Tables Page Nav -->
</aside><!-- End Sidebar-->
