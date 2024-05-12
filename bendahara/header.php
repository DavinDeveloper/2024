            <?
            if ($user['status'] == 'Bendahara') {
            ?>
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Bendahara</span>
            </li>
            
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-wallet"></i>
                <div data-i18n="Simpanan">Simpanan</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="<? echo cfg(url); ?>bendahara/simpanan" class="menu-link">
                    <div data-i18n="Basic">Daftar Simpanan</div>
                  </a>
                </li>
              </ul>
            </li>
            
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-book"></i>
                <div data-i18n="Pinjaman">Pinjaman</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="<? echo cfg(url); ?>bendahara/pinjaman" class="menu-link">
                    <div data-i18n="Error">Daftar Pinjaman</div>
                  </a>
                </li>
              </ul>
            </li>
            <? } ?>