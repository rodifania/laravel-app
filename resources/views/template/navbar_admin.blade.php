<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    @if($level == 'admin')
    <a class="navbar-brand ps-3" href="#">Admin Dashboard</a>
    @elseif($level == 'siswa')
    <a class="navbar-brand ps-3" href="#">Siswa Dashboard</a>
    @endif
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i 
        class="fas fa-bars"></i></button>
</nav>