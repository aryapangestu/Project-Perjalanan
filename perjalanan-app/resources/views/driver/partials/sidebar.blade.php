<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ $title === 'Dashboard Driver' ? '' : 'collapsed' }}" href="/driver">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link {{ $title === 'Perjalanan Driver' ? '' : 'collapsed' }}" href="/driver/perjalanan">
                <i class="bi bi-journal-text"></i>
                <span>Perjalanan</span>
            </a>
        </li><!-- End Tables Page Nav -->

        <li class="nav-item">
            <a class="nav-link {{ $title === 'Riwayat Driver' ? '' : 'collapsed' }}" href="/driver/history">
                <i class="bi bi-journal-text"></i>
                <span>Riwayat</span>
            </a>
        </li><!-- End Tables Page Nav -->
</aside><!-- End Sidebar-->
