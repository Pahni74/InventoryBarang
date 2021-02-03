<section class="sidebar">
      <!-- Sidebar user panel -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
          <li><a><span>{{ Auth::user()->name }}</span></a></li>
          <ul class="treeview-menu">
          </ul>
        </ul>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">BERANDA</li>
        <li><a href="{{ url('/beranda') }}"><span class="glyphicon glyphicon-dashboard"></span><span>Home</span></a></li>
        @if (auth()->user()->role == 'admin')
        <li class="header">MASTER DATA</li>
        <li class="treeview {{ ( Request::segment(1) == 'merk' ) ? 'active' : '' }}">
          <a href="#">
              <span class="glyphicon glyphicon-list-alt"></span> <span>Merk</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

              <li class="{{ (Request::path() == 'merk') ? 'active' : '' }}"><a href="{{ url('merk') }}"><i class="fa fa-circle-o"></i> List Merk</a></li>

              {{-- <li class="{{ (Request::path() == 'merk/add') ? 'active' : '' }}"><a href="{{ url('merk/create') }}"><i class="fa fa-circle-o"></i> Tambah Merk</a></li> --}}

            </ul>
        </li>
        <li class="treeview {{ ( Request::segment(1) == 'gedung' ) ? 'active' : '' }}">
            <a href="#">
            <span class="glyphicon glyphicon-home"></span> <span>Gedung</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ (Request::path() == 'gedung') ? 'active' : '' }}"><a href="{{ url('gedung') }}"><i class="fa fa-circle-o"></i> List Gedung</a></li>
        </ul>
    </li>
    <li class="treeview {{ ( Request::segment(1) == 'ruang' ) ? 'active' : '' }}">
        <a href="#">
        <span class="glyphicon glyphicon-home"></span> <span>Ruang</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li class="{{ (Request::path() == 'ruang') ? 'active' : '' }}"><a href="{{ url('ruang') }}"><i class="fa fa-circle-o"></i> List Ruang</a></li>
    </ul>
</li>
        <li class="treeview {{ ( Request::segment(1) == 'barang' ) ? 'active' : '' }}">
          <a href="#">
              <span class="glyphicon glyphicon-folder-close"></span> <span>Barang</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

              <li class="{{ (Request::path() == 'barang') ? 'active' : '' }}"><a href="{{ url('barang') }}"><i class="fa fa-circle-o"></i> List Barang</a></li>
            {{-- <li class="{{ (Request::path() == 'barang/add') ? 'active' : '' }}"><a href="{{ url('barang/add') }}"><i class="fa fa-circle-o"></i> Tambah Supplier</a></li> --}}

          </ul>
        </li>


    <li class="header">MANAGEMEN</li>
        <li class="treeview {{ ( Request::segment(1) == 'peminjaman' ) ? 'active' : '' }}">
            <a href="#">
            <span class="glyphicon glyphicon-check"></span> <span>Peminjaman</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
          <ul class="treeview-menu">
              <li class="{{ (Request::path() == 'peminjaman') ? 'active' : '' }}"><a href="{{ url('peminjaman') }}"><i class="fa fa-circle-o"></i> List Peminjaman</a></li>
            </ul>
            <li><a href="{{ url('/laporan') }}"><span class="glyphicon glyphicon-calendar"></span><span>Laporan</span></a></li>
            {{-- <li class="treeview {{ ( Request::segment(1) == 'file' ) ? 'active' : '' }}">
            <a href="#">
            <span class=" glyphicon glyphicon-calendar"></span> <span>Export File</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
          <ul class="treeview-menu">
              <li class="{{ (Request::path() == 'file') ? 'active' : '' }}"><a href="{{ url('file') }}"><i class="fa fa-circle-o"></i>List Item</a></li>
            </ul>
    </li> --}}
        @endif

        {{-- <li class="header">PENJUALAN</li>
        <li class="{{ (Request::segment(1) == 'penjualan') ? 'active' : '' }}"><a href="{{ url('/penjualan/'.\Uuid::generate(4)) }}"><i class="fa fa-fw fa-dollar"></i> penjualan</span></a></li>

        <li class="{{ (Request::segment(1) == 'pengeluaran') ? 'active' : '' }}"><a href="{{ url('/pengeluaran') }}"><i class="fa fa-fw fa-strikethrough"></i> pengeluaran</span></a></li>

        <li class="header">LAPORAN</li>
        <li class="{{ (Request::segment(1) == 'laporan') ? 'active' : '' }}"><a href="{{ url('/laporan') }}"><i class="fa fa-fw fa-suitcase"></i> Laporan</span></a></li> --}}
        <li class="header">OTHER</li>
        {{-- <li><a href="{{ url('/jasa') }}"><i class="fa fa-fw fa-phone"></i> Jasa Pembuatan Web</span></a></li> --}}
        <li><a href="{{ url('/logout') }}"><span class="glyphicon glyphicon-off"></span><span>Logout</span></a></li>


      </ul>
    </section>
