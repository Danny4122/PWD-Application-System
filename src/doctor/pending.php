<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f5f5;
        }

        .sidebar {
            width: 260px;
            height: 100vh;
            background: linear-gradient(to bottom, #191654, rgb(67, 130, 198));
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            padding: 20px;
            padding-bottom: 40px;
            transition: width 0.3s ease, opacity 0.3s ease;
            opacity: 1;
        }

        .sidebar.closed {
            width: 80px;
            padding: 20px 10px;
            opacity: 1;
            overflow: hidden;
            transition: width 0.3s ease, opacity 0.3s ease;
        }

        .sidebar .logo {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 10px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }

        .sidebar.closed .logo {
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 3px;
        }

        .sidebar.closed .logo img {
            width: 50px;
            height: 48px;
        }

        .sidebar h4 {
            margin: 0;
            font-weight: bold;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            margin: 10px 0;
            padding: 8px 12px;
            border-radius: 8px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: white !important;
        }

        .sidebar.closed .toggle-btn .no-wrap span {
            display: none !important;
        }

        .sidebar.closed .toggle-btn .chevron-icon {
            display: none;
        }

        .sidebar.closed .submenu {
            max-height: 0 !important;
        }

        .sidebar-item .toggle-btn:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: #f5f5f5 !important;
        }

        .sidebar.closed a {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
        }

        .sidebar.closed i {
            font-size: 1.4rem;
            margin: 0;
        }

        .sidebar.closed a span {
            display: none;
        }

        .sidebar.closed .toggle-btn {
            justify-content: center;
        }

        .main {
            margin-left: 260px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        .main.shifted {
            margin-left: 80px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .search-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .cards {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .card-stat {
            flex: 1;
            position: relative;
            min-width: 200px;
            background-color: #2b2bb2;
            color: white;
            padding: 20px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        .card-stat::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            height: 20px;
            width: 100%;
            background-color: rgb(26, 26, 35);
            opacity: 30%;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
        }

        .card-stat i {
            font-size: 2rem;
        }

        .chart-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .dropdown-menu {
            background: transparent;
        }

        .dropdown-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .sidebar-item {
            margin-top: 10px;
        }

        .toggle-btn {
            padding: 8px 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .chevron-icon {
            transition: transform 0.3s ease;
        }

        .rotate {
            transform: rotate(180deg);
        }

        .submenu {
            overflow: hidden;
            max-height: 0;
            transition: max-height 0.4s ease;
        }

        .submenu-link {
            display: block;
            padding: 8px 20px;
            color: white;
            font-size: 0.95rem;
            border-radius: 6px;
            margin: 4px 0;
            text-decoration: none;
            transition: background 0.3s;
        }

        .submenu-link:hover {
            background-color: rgba(255, 255, 255, 0.15);
            color: white !important;
        }

        .no-wrap {
            white-space: nowrap;
        }

        hr {
            border: 0;
            height: 1px;
            background: white;
            margin: 0px 0;
            width: 100%;
        }

        .cho-label {
            font-size: 30px;
            font-weight: bold;
            /* font-family: Arial, sans-serif; */
            color: #ffffff;
        }

        .search-bar input {
            padding: 6px 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .search-bar {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
        }

        .search-bar label {
            font-weight: 500;
            color: #333;
        }

        .search-bar input[type="text"] {
            padding: 8px 14px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 8px;
            transition: border 0.3s ease;
            width: 250px;
        }

        .search-bar input[type="text"]:focus {
            border-color: #3f71e8;
            outline: none;
            box-shadow: 0 0 3px rgba(63, 113, 232, 0.3);
        }


        .download-btn {
            background-color: white;
            color: #1e40af;
            border: 1px solid #1e40af;
            border-radius: 20px;
            padding: 6px 14px;
            font-size: 14px;
            cursor: pointer;
        }

        .section-header {
            background-color: #3f71e8;
            color: white;
            padding: 12px 20px;
            margin-top: 20px;
            border-radius: 8px;
            font-size: 20px;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
        }

        .member-list {
            background-color: white;
            margin-top: 10px;
            border-radius: 6px;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #eee;
        }

        .member-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .member-info .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #e1e1e1;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 18px;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            gap: 5px;
        }

        .pagination button {
            background: white;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 6px 12px;
            cursor: pointer;
        }

        .pagination button.active {
            background: #3f71e8;
            color: white;
        }

        .view-link {
            color: #3f71e8;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <img src="../../assets/white.png" alt="logo" width="45">
            <img src="../../assets/CHO logo.png" alt="logo 2" width="45">
            <h4 class="cho-label">CHO</h4>
        </div>
        <hr> <!-- Horizontal line stretching from logo area -->
        <a class="active"><i class="fas fa-chart-line me-2"></i><span>Dashboard</span></a>
        <a><i class="fas fa-wheelchair me-2"></i><span>Members</span></a>
        <a><i class="fas fa-users me-2"></i><span>Applications</span></a>

        <div class="sidebar-item">
            <div class="toggle-btn d-flex justify-content-between align-items-center">
                <span class="no-wrap d-flex align-items-center"><i class="fas fa-folder me-2"></i><span>Manage
                        Applications</span></span>
                <i class="fas fa-chevron-down chevron-icon"></i>
            </div>
            <div class="submenu">
                <a href="#" class="submenu-link d-flex align-items-center ps-4"
                    style="padding-top: 3px; padding-bottom: 3px; margin: 5px 0;">
                    <span class="icon" style="width: 18px;"><i class="fas fa-user-check"></i></span>
                    <span class="ms-2">Accepted</span>
                </a>
                <a href="#" class="submenu-link d-flex align-items-center ps-4"
                    style="padding-top: 3px; padding-bottom: 3px; margin: 5px 0;">
                    <span class="icon" style="width: 18px;"><i class="fas fa-hourglass-half"></i></span>
                    <span class="ms-2">Pending</span>
                </a>
                <a href="#" class="submenu-link d-flex align-items-center ps-4"
                    style="padding-top: 3px; padding-bottom: 3px; margin: 5px 0;">
                    <span class="icon" style="width: 18px;"><i class="fas fa-user-times"></i></span>
                    <span class="ms-2">Denied</span>
                </a>
            </div>
        </div>

        <a><i class="fas fa-sign-out-alt me-2"></i><span>Logout</span></a>
    </div>

    <div class="main">
        <div class="topbar d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <div class="toggle-btn" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </div>
            </div>

            <div class="d-flex flex-column align-items-end">
                <div class="d-flex align-items-center ms-3 mt-2 mb-2" style="font-size: 1.4rem;">
                    <strong>Danny Boy Loberanes Jr.</strong>
                    <i class="fas fa-user-circle ms-3 me-2 mb-2 mt-2" style="font-size: 2.5rem;"></i>
                </div>

            </div>
        </div>

        <!-- Search row -->
        <div class="search-container d-flex align-items-center mt-3">
            <div class="search-bar me-3">
                <label>Search: </label>
                <input type="text" placeholder="Search PWDs...">
            </div>

            <div class="d-flex flex-column align-items-end">
                <button class="download-btn"><i class="fas fa-download"></i> Download</button>
            </div>
        </div>

        <div class="section-header">
            <div>LIST OF APPLICANTS</div>

            <div class="d-flex justify-content-between" style="width: 265px;">
                <div class="fw-bold">STATUS</div>
                <div class="fw-bold me-4">ACTION</div>
            </div>
        </div>

        <div class="member-list">
            <div class="member-info">
                <div class="avatar"><i class="fas fa-user"></i></div>
                <div>
                    <div>Danny Boy Loberanes Jr.</div>
                    <div style="font-size: 12px;">Dalipuga, Iligan City</div>
                </div>
            </div>

            <div class="d-flex align-items-center">
                <span class="badge bg-warning text-white text-center"
                    style="font-size: 1rem; width: 100px; padding: 0.5rem 0;">Pending</span>

                <a href="#" class="view-link text-primary text-decoration-none">
                    <i class="fas fa-eye me-1 ms-5"></i> View Applicant
                </a>
            </div>
        </div>

        <div class="member-list">
            <div class="member-info">
                <div class="avatar"><i class="fas fa-user"></i></div>
                <div>
                    <div>Thea Ancog</div>
                    <div style="font-size: 12px;">Acmac, Iligan City</div>
                </div>
            </div>

            <div class="d-flex align-items-center">
                <span class="badge bg-warning text-white text-center"
                    style="font-size: 1rem; width: 100px; padding: 0.5rem 0;">Pending</span>
                <a href="#" class="view-link text-primary text-decoration-none">
                    <i class="fas fa-eye me-1 ms-5"></i> View Applicant
                </a>
            </div>
        </div>


        <div class="member-list">
            <div class="member-info">
                <div class="avatar"><i class="fas fa-user"></i></div>
                <div>
                    <div>Maxine Joyce Lesondra</div>
                    <div style="font-size: 12px;">Luinab, Iligan City</div>
                </div>
            </div>

            <div class="d-flex align-items-center">
                <span class="badge bg-warning text-white text-center"
                    style="font-size: 1rem; width: 100px; padding: 0.5rem 0;">Pending</span>
                <a href="#" class="view-link text-primary text-decoration-none">
                    <i class="fas fa-eye me-1 ms-5"></i> View Applicant
                </a>
            </div>
        </div>

        <div class="member-list">
            <div class="member-info">
                <div class="avatar"><i class="fas fa-user"></i></div>
                <div>
                    <div>Jielven Rose Baraquel</div>
                    <div style="font-size: 12px;">Santa Filomena, Iligan City</div>
                </div>
            </div>

            <div class="d-flex align-items-center">
                <span class="badge bg-warning text-white text-center"
                    style="font-size: 1rem; width: 100px; padding: 0.5rem 0;">Pending</span>
                <a href="#" class="view-link text-primary text-decoration-none">
                    <i class="fas fa-eye me-1 ms-5"></i> View Applicant
                </a>
            </div>
        </div>

        <div class="member-list">
            <div class="member-info">
                <div class="avatar"><i class="fas fa-user"></i></div>
                <div>
                    <div>Rosemarie Dela Cruz</div>
                    <div style="font-size: 12px;">Acmac, Iligan City</div>
                </div>
            </div>

            <div class="d-flex align-items-center">
                <span class="badge bg-warning text-white text-center"
                    style="font-size: 1rem; width: 100px; padding: 0.5rem 0;">Pending</span>
                <a href="#" class="view-link text-primary text-decoration-none">
                    <i class="fas fa-eye me-1 ms-5"></i> View Applicant
                </a>
            </div>
        </div>

        <div class="member-list">
            <div class="member-info">
                <div class="avatar"><i class="fas fa-user"></i></div>
                <div>
                    <div>Mary Grace Luna</div>
                    <div style="font-size: 12px;">Luinab, Iligan City</div>
                </div>
            </div>

            <div class="d-flex align-items-center">
                <span class="badge bg-warning text-white text-center"
                    style="font-size: 1rem; width: 100px; padding: 0.5rem 0;">Pending</span>
                <a href="#" class="view-link text-primary text-decoration-none">
                    <i class="fas fa-eye me-1 ms-5"></i> View Applicant
                </a>
            </div>
        </div>

        <div class="member-list">
            <div class="member-info">
                <div class="avatar"><i class="fas fa-user"></i></div>
                <div>
                    <div>Rosie Ong</div>
                    <div style="font-size: 12px;">Tambo, Iligan City</div>
                </div>
            </div>

            <div class="d-flex align-items-center">
                <span class="badge bg-warning text-white text-center"
                    style="font-size: 1rem; width: 100px; padding: 0.5rem 0;">Pending</span>
                <a href="#" class="view-link text-primary text-decoration-none">
                    <i class="fas fa-eye me-1 ms-5"></i> View Applicant
                </a>
            </div>
        </div>

        <div class="pagination">
            <button>&lt; Previous</button>
            <button class="active">1</button>
            <button>2</button>
            <button>3</button>
            <button>4</button>
            <button>5</button>
            <button>6</button>
            <button>Next &gt;</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.querySelectorAll('.toggle-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const submenu = btn.nextElementSibling;
                const icon = btn.querySelector('.chevron-icon');
                submenu.style.maxHeight = submenu.style.maxHeight ? null : submenu.scrollHeight + "px";
                icon.classList.toggle('rotate');
            });
        });

        // Toggle Sidebar visibility
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const main = document.querySelector('.main');
            sidebar.classList.toggle('closed');
            main.classList.toggle('shifted');
        }
    </script>
</body>

</html>