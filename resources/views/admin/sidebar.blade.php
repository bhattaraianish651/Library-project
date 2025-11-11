
 <!-- Sidebar Navigation-->
 <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
         <!-- <div class="avatar"><img src="{{asset('admin/img/avatar-6.jpg')}}" alt="..." class="img-fluid rounded-circle"></div>-->
          <div class="title">
            <h1 class="h5">Admin Dashboard</h1>
          
          </div>
        </div>
        <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
        <ul class="list-unstyled">
        <li class="active">
            <a href="{{url('/home')}}">
                <i class="fas fa-home"></i> Home
            </a>
        </li>
        <li>
            <a href="{{url('category_page')}}">
                <i class="fas fa-th-list"></i> Category
            </a>
        </li>
        <li>
            <a href="{{url('add_book')}}">
                <i class="fas fa-book"></i> Add Book
            </a>
        </li>
        <li>
            <a href="{{url('show_book')}}">
                <i class="fas fa-book-open"></i> Show Book
            </a>
        </li>
        <li>
            <a href="{{url('borrow_request')}}">
                <i class="fas fa-book-reader"></i> Borrow Request
            </a>
        </li>
        
        
    </ul>
</nav>