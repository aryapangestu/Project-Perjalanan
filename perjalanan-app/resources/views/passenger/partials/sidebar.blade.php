<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ $title === 'Dashboard Passenger' ? '' : 'collapsed' }}" href="/passenger">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link {{ $title === 'Pemesanan Passenger' ? '' : 'collapsed' }}" href="/passenger/pemesanan">
                <i class="bi bi-layout-text-window-reverse"></i>
                <span>Pemesanan</span>
            </a>
        </li><!-- End Tables Page Nav -->

        <li class="nav-item">
            <a class="nav-link {{ $title === 'Perjalanan Passenger' ? '' : 'collapsed' }}"
                href="/passenger/perjalanan">
                <i class="bi bi-layout-text-window-reverse"></i>
                <span>Perjalanan</span>
            </a>
        </li><!-- End Tables Page Nav -->

        <li class="nav-item">
            <a class="nav-link {{ $title === 'Riwayat Passenger' ? '' : 'collapsed' }}" href="/passenger/history">
                <i class="bi bi-layout-text-window-reverse"></i>
                <span>Riwayat</span>
            </a>
        </li><!-- End Tables Page Nav -->
</aside><!-- End Sidebar-->
