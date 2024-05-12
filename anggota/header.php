            <?
            if ($user['status'] == 'Anggota') {
            ?>
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Anggota</span>
            </li>
            
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-wallet"></i>
                <div data-i18n="Simpanan">Simpanan</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="<? echo cfg(url); ?>anggota/simpanan" class="menu-link">
                    <div data-i18n="Basic">Simpanan Saya</div>
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
                <? if ($user['pinjaman'] == 'Disetujui') { ?>
                <li class="menu-item">
                  <a href="<? echo cfg(url); ?>anggota/pinjaman/ajukan" class="menu-link">
                    <div data-i18n="Error">Ajukan Pinjaman</div>
                  </a>
                </li>
                <? } ?>
                <li class="menu-item">
                  <a href="<? echo cfg(url); ?>anggota/pinjaman" class="menu-link">
                    <div data-i18n="Error">Pinjaman Saya</div>
                  </a>
                </li>
              </ul>
            </li>
            
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-book"></i>
                <div data-i18n="Angsuran">Angsuran</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="<? echo cfg(url); ?>anggota/angsuran" class="menu-link">
                    <div data-i18n="Error">Angsuran Saya</div>
                  </a>
                </li>
              </ul>
            </li>
            <? } ?>