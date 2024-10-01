<ul class="menu-inner text-capitalize py-1">
    <!-- Dashboards -->
    <li class="menu-item {{ \Request::is('/') || \Request::is('home') ? 'active' : '' }}">
        <a href="{{ url('/') }}" class="menu-link ">
            <i class="menu-icon tf-icons ri-dashboard-line"></i>
            <div data-i18n="Documentation">Dashboards</div>
        </a>
    </li>
    <li class="menu-item {{ \Request::is('dokumen_impor') || \Request::is('dokumen_impor/*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ri-file-download-line"></i>
            <div>Dokumen Impor</div>
        </a>

        <ul class="menu-sub">

            <li class="menu-item {{ \Request::is('dokumen_impor/bc_2_0') || \Request::is('dokumen_impor/bc_2_0/*') ? 'active' : '' }}">
                <a href="{{ url('dokumen_impor/bc_2_0') }}" class="menu-link">
                    <div data-i18n="Fluid">Data Impor BC 2.0</div>
                </a>
            </li>
        </ul>
    </li>
    <li class="menu-item {{ \Request::is('dokumen_ekspor') || \Request::is('dokumen_ekspor/*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ri-file-upload-line"></i>
            <div>Dokumen ekspor</div>
        </a>

        <ul class="menu-sub">

            <li class="menu-item {{ \Request::is('dokumen_ekspor/bc_3_0') || \Request::is('dokumen_ekspor/bc_3_0/*') ? 'active' : '' }}">
                <a href="{{ url('dokumen_ekspor/bc_3_0') }}" class="menu-link">
                    <div data-i18n="Fluid">Dokumen BC 3.0</div>
                </a>
            </li>
            
        </ul>
    </li>
    <li class="menu-item {{ \Request::is('dokumen_tpb') || \Request::is('dokumen_tpb/*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ri-article-line"></i>
            <div>Dokumen TPB</div>
        </a>

        <ul class="menu-sub">

            <li class="menu-item {{ \Request::is('dokumen_tpb/bc_2_3') || \Request::is('dokumen_tpb/bc_2_3/*') ? 'active' : '' }}">
                <a href="{{ url('dokumen_tpb/bc_2_3') }}" class="menu-link">
                    <div data-i18n="Fluid">TPB - BC 2.3</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('dokumen_tpb/bc_2_5') || \Request::is('dokumen_tpb/bc_2_5/*') ? 'active' : '' }}">
                <a href="{{ url('dokumen_tpb/bc_2_5') }}" class="menu-link">
                    <div data-i18n="Fluid">TPB - BC 2.5</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('dokumen_tpb/bc_2_6_1') || \Request::is('dokumen_tpb/bc_2_6_1/*') ? 'active' : '' }}">
                <a href="{{ url('dokumen_tpb/bc_2_6_1') }}" class="menu-link">
                    <div data-i18n="Fluid">TPB - BC 2.6.1</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('dokumen_tpb/bc_2_6_2') || \Request::is('dokumen_tpb/bc_2_6_2/*') ? 'active' : '' }}">
                <a href="{{ url('dokumen_tpb/bc_2_6_2') }}" class="menu-link">
                    <div data-i18n="Fluid">TPB - BC 2.6.2</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('dokumen_tpb/bc_2_7') || \Request::is('dokumen_tpb/bc_2_7/*') ? 'active' : '' }}">
                <a href="{{ url('dokumen_tpb/bc_2_7') }}" class="menu-link">
                    <div data-i18n="Fluid">TPB - BC 2.7</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('dokumen_tpb/bc_4_0') || \Request::is('dokumen_tpb/bc_4_0/*') ? 'active' : '' }}">
                <a href="{{ url('dokumen_tpb/bc_4_0') }}" class="menu-link">
                    <div data-i18n="Fluid">TPB - BC 4.0</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('dokumen_tpb/bc_4_1') || \Request::is('dokumen_tpb/bc_4_1/*') ? 'active' : '' }}">
                <a href="{{ url('dokumen_tpb/bc_4_1') }}" class="menu-link">
                    <div data-i18n="Fluid">TPB - BC 4.1</div>
                </a>
            </li>           
            
        </ul>
    </li>
    <li class="menu-item {{ \Request::is('dokumen_ftz') || \Request::is('dokumen_ftz/*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ri-file-shield-2-line"></i>
            <div>Dokumen FTZ</div>
        </a>

        <ul class="menu-sub">

            <li class="menu-item {{ \Request::is('dokumen_ftz/ftz_01_1') || \Request::is('dokumen_ftz/ftz_01_1/*') ? 'active' : '' }}">
                <a href="{{ url('dokumen_ftz/ftz_01_1') }}" class="menu-link">
                    <div data-i18n="Fluid">FTZ01-1</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('dokumen_ftz/ftz_01_3') || \Request::is('dokumen_ftz/ftz_01_3/*') ? 'active' : '' }}">
                <a href="{{ url('dokumen_ftz/ftz_01_3') }}" class="menu-link">
                    <div data-i18n="Fluid">FTZ01-3</div>
                </a>
            </li>
            
            
        </ul>
    </li>
    <li class="menu-item {{ \Request::is('dokumen_ftz') || \Request::is('dokumen_ftz/*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ri-file-ppt-2-line"></i>
            <div>Dokumen PLB</div>
        </a>

        <ul class="menu-sub">

            <li class="menu-item {{ \Request::is('dokumen_plb/bc_1_6') || \Request::is('dokumen_plb/bc_1_6/*') ? 'active' : '' }}">
                <a href="{{ url('dokumen_plb/bc_1_6') }}" class="menu-link">
                    <div data-i18n="Fluid">BC 1.6</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('dokumen_plb/bc_2_8') || \Request::is('dokumen_plb/bc_2_8/*') ? 'active' : '' }}">
                <a href="{{ url('dokumen_plb/bc_2_8') }}" class="menu-link">
                    <div data-i18n="Fluid">BC 2.8</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('dokumen_plb/bc_3_3') || \Request::is('dokumen_plb/bc_3_3/*') ? 'active' : '' }}">
                <a href="{{ url('dokumen_plb/bc_3_3') }}" class="menu-link">
                    <div data-i18n="Fluid">BC 3.3</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('dokumen_plb/bc_p3bet') || \Request::is('dokumen_plb/bc_p3bet/*') ? 'active' : '' }}">
                <a href="{{ url('dokumen_plb/bc_p3bet') }}" class="menu-link">
                    <div data-i18n="Fluid">P3BET</div>
                </a>
            </li>
            
            
        </ul>
    </li>
    <li class="menu-item {{ \Request::is('referensi') || \Request::is('referensi/*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ri-git-repository-line"></i>
            <div>Data Referensi</div>
        </a>

        <ul class="menu-sub">

            <li class="menu-item {{ \Request::is('referensi/asal_barang') || \Request::is('referensi/asal_barang/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/asal_barang') }}" class="menu-link">
                    <div data-i18n="Fluid">asal barang</div>
                </a>
            </li>
            <li
                class="menu-item {{ \Request::is('referensi/asal_barang_ftz') || \Request::is('referensi/asal_barang_ftz/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/asal_barang_ftz') }}" class="menu-link">
                    <div data-i18n="Fluid">asal barang ftz</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('referensi/bank') || \Request::is('referensi/bank/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/bank') }}" class="menu-link">
                    <div data-i18n="Fluid">bank</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('referensi/cara_angkut') || \Request::is('referensi/cara_angkut/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/cara_angkut') }}" class="menu-link">
                    <div data-i18n="Fluid">cara angkut</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('referensi/cara_bayar') || \Request::is('referensi/cara_bayar/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/cara_bayar') }}" class="menu-link">
                    <div data-i18n="Fluid">cara bayar</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('referensi/cara_dagang') || \Request::is('referensi/cara_dagang/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/cara_dagang') }}" class="menu-link">
                    <div data-i18n="Fluid">cara dagang</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('referensi/daerah_asal') || \Request::is('referensi/daerah_asal/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/daerah_asal') }}" class="menu-link">
                    <div data-i18n="Fluid">daerah asal</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('referensi/dokumen') || \Request::is('referensi/dokumen/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/dokumen') }}" class="menu-link">
                    <div data-i18n="Fluid">dokumen</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('referensi/entitas') || \Request::is('referensi/entitas/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/entitas') }}" class="menu-link">
                    <div data-i18n="Fluid">entitas</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('referensi/fasilitas') || \Request::is('referensi/fasilitas/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/fasilitas') }}" class="menu-link">
                    <div data-i18n="Fluid">fasilitas</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('referensi/fasilitas_tarif') || \Request::is('referensi/fasilitas_tarif/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/fasilitas_tarif') }}" class="menu-link">
                    <div data-i18n="Fluid">fasilitas tarif</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('referensi/ijin') || \Request::is('referensi/ijin/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/ijin') }}" class="menu-link">
                    <div data-i18n="Fluid">ijin</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('referensi/incoterm') || \Request::is('referensi/incoterm/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/incoterm') }}" class="menu-link">
                    <div data-i18n="Fluid">incoterm</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('referensi/jenis_api') || \Request::is('referensi/jenis_api/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/jenis_api') }}" class="menu-link">
                    <div data-i18n="Fluid">jenis api</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('referensi/jenis_ekspor') || \Request::is('referensi/jenis_ekspor/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/jenis_ekspor') }}" class="menu-link">
                    <div data-i18n="Fluid">jenis ekspor</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('referensi/jenis_identitas') || \Request::is('referensi/jenis_identitas/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/jenis_identitas') }}" class="menu-link">
                    <div data-i18n="Fluid">jenis identitas</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('referensi/jenis_impor') || \Request::is('referensi/jenis_impor/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/jenis_impor') }}" class="menu-link">
                    <div data-i18n="Fluid">jenis_impor</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('referensi/jenis_jaminan') || \Request::is('referensi/jenis_jaminan/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/jenis_jaminan') }}" class="menu-link">
                    <div data-i18n="Fluid">jenis jaminan</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('referensi/jenis_kemasan') || \Request::is('referensi/jenis_kemasan/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/jenis_kemasan') }}" class="menu-link">
                    <div data-i18n="Fluid">jenis kemasan</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('referensi/jenis_kontainer') || \Request::is('referensi/jenis_kontainer/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/jenis_kontainer') }}" class="menu-link">
                    <div data-i18n="Fluid">jenis kontainer</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('referensi/jenis_pib') || \Request::is('referensi/jenis_pib/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/jenis_pib') }}" class="menu-link">
                    <div data-i18n="Fluid">jenis pib / Prosedur                    </div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('referensi/jenis_pungutan') || \Request::is('referensi/jenis_pungutan/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/jenis_pungutan') }}" class="menu-link">
                    <div data-i18n="Fluid">jenis pungutan</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('referensi/jenis_tanda_pengaman') || \Request::is('referensi/jenis_tanda_pengaman/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/jenis_tanda_pengaman') }}" class="menu-link">
                    <div data-i18n="Fluid">jenis tanda pengaman</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('referensi/jenis_tarif') || \Request::is('referensi/jenis_tarif/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/jenis_tarif') }}" class="menu-link">
                    <div data-i18n="Fluid">jenis tarif</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('referensi/jenis_tpb') || \Request::is('referensi/jenis_tpb/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/jenis_tpb') }}" class="menu-link">
                    <div data-i18n="Fluid">jenis TPB</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('referensi/jenis_transaksi_perdagangan') || \Request::is('referensi/jenis_transaksi_perdagangan/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/jenis_transaksi_perdagangan') }}" class="menu-link">
                    <div data-i18n="Fluid">jenis transaksi perdagangan</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('referensi/jenis_vd') || \Request::is('referensi/jenis_vd/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/jenis_vd') }}" class="menu-link">
                    <div data-i18n="Fluid">jenis VD</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('referensi/kantor') || \Request::is('referensi/kantor/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/kantor') }}" class="menu-link">
                    <div data-i18n="Fluid">kantor</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('referensi/kategori_barang') || \Request::is('referensi/kategori_barang/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/kategori_barang') }}" class="menu-link">
                    <div data-i18n="Fluid">kategori_barang</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('referensi/kategori_ekspor') || \Request::is('referensi/kategori_ekspor/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/kategori_ekspor') }}" class="menu-link">
                    <div data-i18n="Fluid">kategori_ekspor</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('referensi/kategori_keluar_ftz') || \Request::is('referensi/kategori_keluar_ftz/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/kategori_keluar_ftz') }}" class="menu-link">
                    <div data-i18n="Fluid">kategori_keluar_ftz</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('referensi/kategori_masuk_ftz') || \Request::is('referensi/kategori_masuk_ftz/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/kategori_masuk_ftz') }}" class="menu-link">
                    <div data-i18n="Fluid">kategori_masuk_ftz</div>
                </a>
            </li>
            
            <li class="menu-item {{ \Request::is('referensi/komoditi_cukai') || \Request::is('referensi/komoditi_cukai/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/komoditi_cukai') }}" class="menu-link">
                    <div data-i18n="Fluid">komoditi_cukai</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('referensi/kondisi_barang') || \Request::is('referensi/kondisi_barang/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/kondisi_barang') }}" class="menu-link">
                    <div data-i18n="Fluid">kondisi_barang</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('referensi/lokasi_bayar') || \Request::is('referensi/lokasi_bayar/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/lokasi_bayar') }}" class="menu-link">
                    <div data-i18n="Fluid">lokasi_bayar</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('referensi/negara') || \Request::is('referensi/negara/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/negara') }}" class="menu-link">
                    <div data-i18n="Fluid">negara</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('referensi/respon') || \Request::is('referensi/respon/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/respon') }}" class="menu-link">
                    <div data-i18n="Fluid">respon</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('referensi/satuan_barang') || \Request::is('referensi/satuan_barang/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/satuan_barang') }}" class="menu-link">
                    <div data-i18n="Fluid">satuan_barang</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('referensi/spesifikasi_khusus') || \Request::is('referensi/spesifikasi_khusus/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/spesifikasi_khusus') }}" class="menu-link">
                    <div data-i18n="Fluid">spesifikasi_khusus</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('referensi/status') || \Request::is('referensi/status/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/status') }}" class="menu-link">
                    <div data-i18n="Fluid">status</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('referensi/status_pengusaha') || \Request::is('referensi/status_pengusaha/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/status_pengusaha') }}" class="menu-link">
                    <div data-i18n="Fluid">status_pengusaha</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('referensi/tipe_kontainer') || \Request::is('referensi/tipe_kontainer/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/tipe_kontainer') }}" class="menu-link">
                    <div data-i18n="Fluid">tipe_kontainer</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('referensi/tujuan_pemasukan') || \Request::is('referensi/tujuan_pemasukan/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/tujuan_pemasukan') }}" class="menu-link">
                    <div data-i18n="Fluid">tujuan_pemasukan</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('referensi/tujuan_pengeluaran') || \Request::is('referensi/tujuan_pengeluaran/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/tujuan_pengeluaran') }}" class="menu-link">
                    <div data-i18n="Fluid">tujuan_pengeluaran</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('referensi/tujuan_pengiriman') || \Request::is('referensi/tujuan_pengiriman/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/tujuan_pengiriman') }}" class="menu-link">
                    <div data-i18n="Fluid">tujuan_pengiriman</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('referensi/tutup_pu') || \Request::is('referensi/tutup_pu/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/tutup_pu') }}" class="menu-link">
                    <div data-i18n="Fluid">tutup_pu</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('referensi/ukuran_kontainer') || \Request::is('referensi/ukuran_kontainer/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/ukuran_kontainer') }}" class="menu-link">
                    <div data-i18n="Fluid">ukuran_kontainer</div>
                </a>
            </li>
            <li class="menu-item {{ \Request::is('referensi/valuta') || \Request::is('referensi/valuta/*') ? 'active' : '' }}">
                <a href="{{ url('referensi/valuta') }}" class="menu-link">
                    <div data-i18n="Fluid">valuta</div>
                </a>
            </li>
            
        </ul>
    </li>


    <!-- Misc -->
    @hasanyrole('superadmin|admin')
        <li class="menu-header fw-medium mt-4"><span class="menu-header-text">Config</span></li>
        <li class="menu-item {{ \Request::is('config/user') ? 'active' : '' }}">
            <a href="{{ url('config/user') }}" class="menu-link ">
                <i class="menu-icon tf-icons ri-group-line"></i>
                <div data-i18n="Documentation">User</div>
            </a>
        </li>
        @hasanyrole('superadmin')
            <li class="menu-item {{ \Request::is('config/ceisa') || \Request::is('config/website') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons ri-tools-fill"></i>
                    <div>Setting</div>
                </a>

                <ul class="menu-sub">

                    <li class="menu-item {{ \Request::is('config/ceisa') || \Request::is('config/ceisa/*') ? 'active' : '' }}">
                        <a href="{{ url('config/ceisa') }}" class="menu-link">
                            <div data-i18n="Fluid">CEISA</div>
                        </a>
                    </li>
                    <li
                        class="menu-item {{ \Request::is('config/website') || \Request::is('config/website/*') ? 'active' : '' }}">
                        <a href="{{ url('config/website') }}" class="menu-link">
                            <div data-i18n="Fluid">website</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endhasanyrole
    @endhasanyrole
</ul>
