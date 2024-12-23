<div class="sidebar active">
    <div class="sidebar-logo">
        <a href="/admin" class="logo">
            <img src="{{ Vite::asset('resources/img/logo.png') }}" alt="Logo" class="navbar-brand" height="50px" />
        </a>
    </div>
    <ul class="nav">
        <li class="nav-item">
            <a href="dashboard">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="quanlykhoahoc">
                <i class="far fa-chart-bar"></i>
                <span>Quản lí phòng</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="quanlynguoidung">
                <i class="fas fa-users"></i>
                <span>Quản lí người dùng</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="quanlydanhmuc">
                <i class="fas fa-folder"></i>
                <span>Quản lí danh mục</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="contact">
                <i class="fas fa-envelope"></i>
                <span>Liên hệ</span>
            </a>
        </li>
    </ul>
</div>
<style>
    * {
        font-family: sans-serif;
    }

    .sidebar {
        width: 250px;
        background-color: #101d3d;
        color: white;
        height: 100vh;
        position: fixed;
        top: 0;
        left: -250px;
        transition: left 0.3s ease;
        z-index: 9999;
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.2);
    }

    /* Sidebar when active */
    .sidebar.active {
        left: 0;
    }

    .sidebar-logo {
        text-align: center;
        padding: 10px 0;
        background-color: #0F172B;
    }

    .sidebar-logo .logo img {
        height: 53px;
        width: auto;
        transition: transform 0.3s ease;
    }

    .sidebar-logo:hover .logo img {
        transform: scale(1.1);
    }

    .nav {
        list-style: none;
        padding: 0;
        margin: 0;
        margin-top: 40px;
    }

    .nav-item {
        padding: 19px 20px;
        display: flex;
        align-items: center;
        transition: background-color 0.3s ease;
    }

    .nav-item a {
        display: flex;
        align-items: center;
        color: white;
        text-decoration: none;
        font-size: 16px;
        font-weight: bold;
        transition: color 0.3s ease;
    }

    .nav-item a i {
        margin-right: 12px;
        font-size: 16px;
    }

    .nav-item:hover a {
        color: #f59e0b;
        border-radius: 5px;
    }

    .nav-item:hover {
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 5px;
    }

    .nav-section {
        margin: 25px 20px 10px;
        font-size: 13px;
        text-transform: uppercase;
        color: rgba(255, 255, 255, 0.6);
        margin-left: 30px !important;
    }

    /* Media query for small screens */
    @media (max-width: 768px) {
        .sidebar {
            left: -250px;
            height: 100vh;
        }

        .sidebar.active {
            left: 0;
        }

        .toggle-sidebar {
            display: block;
            position: absolute;
            top: 15px;
            left: 15px;
            background-color: rgba(255, 255, 255, 0.2);
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            color: white;
        }

        .nav-item {
            padding: 12px 15px;
        }

        .nav-section {
            margin-left: 10px !important;
        }

        .navbar {
            position: relative;
            justify-content: space-between;
            padding-right: 15px;
        }

        .navbar-nav {
            display: flex;
        }
    }

    /* Media query for larger screens */
    @media (min-width: 769px) {
        .sidebar {
            left: 0;
        }

        .toggle-sidebar {
            display: none;
        }

        .navbar {
            justify-content: flex-end;
        }
    }
</style>