  <div class="main-sidebar sidebar-style-2">
      <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
              <a href="#">Quản trị Admin</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
              <a href="#">St</a>
          </div>
          <ul class="sidebar-menu">
              <li class="menu-header">Tổng quan</li>
              <li class="dropdown">
                  <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Tổng quan</span></a>
                  <ul class="dropdown-menu">
                      <li><a class="nav-link" href="{{ route('admin.dashboard.index') }}">Quản trị </a></li>
                  </ul>
              </li>
              <li class="menu-header">Quản lý</li>
              <li class="dropdown">
                  <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-th"></i>
                      <span>Đặt lịch</span></a>
                  <ul class="dropdown-menu">
                      <li><a class="nav-link" href="{{ route('admin.bookings.index') }}">Danh sách đặt lịch</a></li>

                  </ul>
              </li>
              <li class="dropdown">
                  <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-th"></i>
                      <span>Dịch vụ</span></a>
                  <ul class="dropdown-menu">
                      <li><a class="nav-link" href="{{ route('admin.service.index') }}">Danh Sách Dịch Vụ</a></li>
                  </ul>
              </li>
              <li class="menu-header">Con người</li>
              <li class="dropdown">
                  <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-th"></i>
                      <span>Nhân viên</span></a>
                  <ul class="dropdown-menu">
                      <li><a class="nav-link" href="{{ route('admin.techs.index') }}">Danh sách nhân viên</a></li>

                  </ul>
              </li>
              <li class="dropdown">
                  <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-th"></i>
                      <span>Khách hàng</span></a>
                  <ul class="dropdown-menu">
                      <li><a class="nav-link" href="{{ route('admin.customers.index') }}">Khách hàng tiềm năng</a></li>
                      <li><a class="nav-link" href="{{ route('admin.contacts.index') }}">Lịch sử phản hồi</a></li>

                  </ul>
              </li>

          </ul>

          <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
              <a href="{{ route('admin.logouts') }}"
                  class="btn btn-primary btn-lg btn-block btn-icon-split btn-loading">
                  <i class="fas fa-rocket"></i> Đăng xuất
              </a>
          </div>

      </aside>
  </div>
  <script type="text/javascript">
      document.querySelectorAll('.btn-loading').forEach(btn => {
          btn.addEventListener('click', function(e) {
              if (btn.tagName.toLowerCase() === 'a') {
                  e.preventDefault();
                  setLoading(btn);
                  window.location.href = btn.href;
              }
          });
      });
  </script>
