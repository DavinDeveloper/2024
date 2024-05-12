            <?
            if ($user['status'] == 'Ketua') {
            ?>
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Ketua</span>
            </li>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user-pin"></i>
                <div data-i18n="Pengguna">Pengguna</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="<? echo cfg(url); ?>ketua/anggota" class="menu-link">
                    <div data-i18n="Account">Daftar Anggota</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<? echo cfg(url); ?>ketua/bendahara" class="menu-link">
                    <div data-i18n="Account">Daftar Bendahara</div>
                  </a>
                </li>
              </ul>
            </li>
            
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-paperclip"></i>
                <div data-i18n="Pengguna">Ketentuan</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="<? echo cfg(url); ?>ketua/ketentuan/keanggotaan" class="menu-link">
                    <div data-i18n="Account">Keanggotaan</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<? echo cfg(url); ?>ketua/ketentuan/pinjaman" class="menu-link">
                    <div data-i18n="Account">Pinjaman</div>
                  </a>
                </li>
              </ul>
            </li>
            
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-wallet"></i>
                <div data-i18n="Simpanan">Simpanan</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="<? echo cfg(url); ?>ketua/simpanan" class="menu-link">
                    <div data-i18n="Basic">Daftar Simpanan</div>
                  </a>
                </li>
              </ul>
            </li>
            
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Pinjaman">Pinjaman</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="<? echo cfg(url); ?>ketua/pinjaman" class="menu-link">
                    <div data-i18n="Error">Daftar Pinjaman</div>
                  </a>
                </li>
              </ul>
            </li>
            
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cube-alt"></i>
                <div data-i18n="Misc">Laporan</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="<? echo cfg(url); ?>ketua/laporan" class="menu-link">
                    <div data-i18n="Error">Data Laporan</div>
                  </a>
                </li>
              </ul>
            </li>
            <? } ?>