<nav class="navbar navbar-light navbar-vertical navbar-expand-xl" style="display: none;">
  <script>
    var navbarStyle = localStorage.getItem("navbarStyle");
    if (navbarStyle && navbarStyle !== 'transparent') {
      document.querySelector('.navbar-vertical').classList.add(`navbar-${navbarStyle}`);
    }
  </script>
  <div class="d-flex align-items-center">
    <div class="toggle-icon-wrapper">
      <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
    </div>
    <a class="navbar-brand" href="../index.html">
      <div class="d-flex align-items-center py-3">
        <!-- <img class="me-2" src="../assets/img/icons/spot-illustrations/falcon.png" alt="" width="40">  -->
        <span class="font-sans-serif text-primary">Flex Quiz</span>
      </div>
    </a>
  </div>
  <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
    <div class="navbar-vertical-content scrollbar">
      <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}" role="button">
            <div class="d-flex align-items-center">
              <span class="nav-link-icon">
                <span class="fas fa-chart-pie"></span>
              </span>
              <span class="nav-link-text ps-1">Dashboard</span>
            </div>
          </a>
        </li>
        <li class="nav-item"><!-- label-->
          <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
            <div class="col-auto navbar-vertical-label">App</div>
            <div class="col ps-0">
              <hr class="mb-0 navbar-vertical-divider" />
            </div>
          </div><!-- parent pages--><a class="nav-link" href="../app/calendar.html" role="button">
            <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-calendar-alt"></span></span><span class="nav-link-text ps-1">Calendar</span></div>
          </a><!-- parent pages--><a class="nav-link" href="../app/chat.html" role="button">
            <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-comments"></span></span><span class="nav-link-text ps-1">Chat</span></div>
          </a><!-- parent pages--><a class="nav-link dropdown-indicator" href="#email" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="email">
            <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-envelope-open"></span></span><span class="nav-link-text ps-1">Email</span></div>
          </a>
          <ul class="nav collapse" id="email">
            <li class="nav-item"><a class="nav-link" href="../app/email/inbox.html">
                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Inbox</span></div>
              </a><!-- more inner pages--></li>
            <li class="nav-item"><a class="nav-link" href="../app/email/email-detail.html">
                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Email detail</span></div>
              </a><!-- more inner pages--></li>
            <li class="nav-item"><a class="nav-link" href="../app/email/compose.html">
                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Compose</span></div>
              </a><!-- more inner pages--></li>
          </ul><!-- parent pages--><a class="nav-link dropdown-indicator" href="#events" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="events">
            <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-calendar-day"></span></span><span class="nav-link-text ps-1">Events</span></div>
          </a>
          <ul class="nav collapse" id="events">
            <li class="nav-item"><a class="nav-link" href="../app/events/create-an-event.html">
                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Create an event</span></div>
              </a><!-- more inner pages--></li>
            <li class="nav-item"><a class="nav-link" href="../app/events/event-detail.html">
                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Event detail</span></div>
              </a><!-- more inner pages--></li>
            <li class="nav-item"><a class="nav-link" href="../app/events/event-list.html">
                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Event list</span></div>
              </a><!-- more inner pages--></li>
          </ul><!-- parent pages--><a class="nav-link dropdown-indicator" href="#e-commerce" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="e-commerce">
            <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-shopping-cart"></span></span><span class="nav-link-text ps-1">E commerce</span></div>
          </a>
          <ul class="nav collapse" id="e-commerce">
            <li class="nav-item"><a class="nav-link dropdown-indicator" href="#product" data-bs-toggle="collapse" aria-expanded="false" aria-controls="e-commerce">
                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Product</span></div>
              </a><!-- more inner pages-->
              <ul class="nav collapse" id="product">
                <li class="nav-item"><a class="nav-link" href="../app/e-commerce/product/product-list.html">
                    <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Product list</span></div>
                  </a><!-- more inner pages--></li>
                <li class="nav-item"><a class="nav-link" href="../app/e-commerce/product/product-grid.html">
                    <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Product grid</span></div>
                  </a><!-- more inner pages--></li>
                <li class="nav-item"><a class="nav-link" href="../app/e-commerce/product/product-details.html">
                    <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Product details</span></div>
                  </a><!-- more inner pages--></li>
                <li class="nav-item"><a class="nav-link" href="../app/e-commerce/product/add-product.html">
                    <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Add product</span></div>
                  </a><!-- more inner pages--></li>
              </ul>
            </li>
            <li class="nav-item"><a class="nav-link dropdown-indicator" href="#orders" data-bs-toggle="collapse" aria-expanded="false" aria-controls="e-commerce">
                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Orders</span></div>
              </a><!-- more inner pages-->
              <ul class="nav collapse" id="orders">
                <li class="nav-item"><a class="nav-link" href="../app/e-commerce/orders/order-list.html">
                    <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Order list</span></div>
                  </a><!-- more inner pages--></li>
                <li class="nav-item"><a class="nav-link" href="../app/e-commerce/orders/order-details.html">
                    <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Order details</span></div>
                  </a><!-- more inner pages--></li>
              </ul>
            </li>
            <li class="nav-item"><a class="nav-link" href="../app/e-commerce/customers.html">
                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Customers</span></div>
              </a><!-- more inner pages--></li>
            <li class="nav-item"><a class="nav-link" href="../app/e-commerce/customer-details.html">
                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Customer details</span></div>
              </a><!-- more inner pages--></li>
            <li class="nav-item"><a class="nav-link" href="../app/e-commerce/shopping-cart.html">
                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Shopping cart</span></div>
              </a><!-- more inner pages--></li>
            <li class="nav-item"><a class="nav-link" href="../app/e-commerce/checkout.html">
                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Checkout</span></div>
              </a><!-- more inner pages--></li>
            <li class="nav-item"><a class="nav-link" href="../app/e-commerce/billing.html">
                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Billing</span></div>
              </a><!-- more inner pages--></li>
            <li class="nav-item"><a class="nav-link" href="../app/e-commerce/invoice.html">
                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Invoice</span></div>
              </a><!-- more inner pages--></li>
          </ul><!-- parent pages--><a class="nav-link dropdown-indicator" href="#e-learning" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="e-learning">
            <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-graduation-cap"></span></span><span class="nav-link-text ps-1">E learning</span><span class="badge rounded-pill ms-2 badge-subtle-success">New</span></div>
          </a>
          <ul class="nav collapse" id="e-learning">
            <li class="nav-item"><a class="nav-link dropdown-indicator" href="#course" data-bs-toggle="collapse" aria-expanded="false" aria-controls="e-learning">
                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Course</span></div>
              </a><!-- more inner pages-->
              <ul class="nav collapse" id="course">
                <li class="nav-item"><a class="nav-link" href="../app/e-learning/course/course-list.html">
                    <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Course list</span></div>
                  </a><!-- more inner pages--></li>
                <li class="nav-item"><a class="nav-link" href="../app/e-learning/course/course-grid.html">
                    <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Course grid</span></div>
                  </a><!-- more inner pages--></li>
                <li class="nav-item"><a class="nav-link" href="../app/e-learning/course/course-details.html">
                    <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Course details</span></div>
                  </a><!-- more inner pages--></li>
                <li class="nav-item"><a class="nav-link" href="../app/e-learning/course/create-a-course.html">
                    <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Create a course</span></div>
                  </a><!-- more inner pages--></li>
              </ul>
            </li>
            <li class="nav-item"><a class="nav-link" href="../app/e-learning/student-overview.html">
                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Student overview</span></div>
              </a><!-- more inner pages--></li>
            <li class="nav-item"><a class="nav-link" href="../app/e-learning/trainer-profile.html">
                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Trainer profile</span></div>
              </a><!-- more inner pages--></li>
          </ul><!-- parent pages--><a class="nav-link" href="../app/kanban.html" role="button">
            <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fab fa-trello"></span></span><span class="nav-link-text ps-1">Kanban</span></div>
          </a><!-- parent pages-->
          <a class="nav-link dropdown-indicator" href="#social" role="button" data-bs-toggle="collapse" aria-expanded="{{ request()->is('param/*') ? 'true' : 'false' }}" aria-controls="social">
            <div class="d-flex align-items-center">
              <span class="nav-link-icon">
                <span class="fas fa-share-alt"></span>
              </span>
              <span class="nav-link-text ps-1">Paramètres</span>
            </div>
          </a>
          <ul class="nav collapse {{ request()->is('param/*') ? 'show' : '' }}" id="social">
            <li class="nav-item">
              <a class="nav-link {{ request()->is('param/cutting/*') ? 'active' : '' }}" href="{{ route('cutting.index') }}">
                <div class="d-flex align-items-center">
                  <span class="nav-link-text ps-1">Cutting</span>
                </div>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->is('param/school_year/*') ? 'active' : '' }}" href="{{ route('year.index') }}">
                <div class="d-flex align-items-center">
                  <span class="nav-link-text ps-1">School Year</span>
                </div>
              </a>
            </li>
          </ul>
          <a class="nav-link dropdown-indicator" href="#support-desk" role="button" data-bs-toggle="collapse" aria-expanded="{{ request()->is('config/*') ? 'true' : 'false' }}" aria-controls="support-desk">
            <div class="d-flex align-items-center">
              <span class="nav-link-icon">
                <span class="fas fa-ticket-alt"></span>
              </span>
              <span class="nav-link-text ps-1">Configurations</span>
            </div>
          </a>
          <ul class="nav collapse {{ request()->is('config/*') ? 'show' : '' }}" id="support-desk">
            <li class="nav-item">
              <a class="nav-link {{ request()->is('config/level/*') ? 'active' : '' }}" href="{{ route('level.index') }}">
                <div class="d-flex align-items-center">
                  <span class="nav-link-text ps-1">Level</span>
                </div>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->is('config/school/*') ? 'active' : '' }}" href="{{ route('school.index') }}">
                <div class="d-flex align-items-center">
                  <span class="nav-link-text ps-1">School</span>
                </div>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
