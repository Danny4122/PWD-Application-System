<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHO PWD Members</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Global CSS -->
    <link rel="stylesheet" href="../../assets/css/global/base.css">
    <link rel="stylesheet" href="../../assets/css/global/layout.css">
    <link rel="stylesheet" href="../../assets/css/global/component.css">

</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <img src="../../assets/pictures/white.png" alt="logo" width="45">
            <img src="../../assets/pictures/CHO logo.png" alt="logo 2" width="45">
            <h4>CHO</h4>
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
            <div>LIST OF PERSON WITH DISABILITIES</div>

            <div class="d-flex justify-content-between">
                <div class="fw-bold me-4">ACTION</div>
            </div>
        </div>

        <div class="member-list">
            <div class="member-info">
                <div>
                    <div><b>Danny Boy Loberanes Jr.</b></div>
                    <div style="font-size: 12px;">Dalipuga, Iligan City</div>
                </div>
            </div><a href="#" class="view-link"><i class="fas fa-eye me-1"></i> View Applicant</a>
        </div>
        <div class="member-list">
            <div class="member-info">
                <div>
                    <div><b>Thea Ancog</b></div>
                    <div style="font-size: 12px;">Acmac, Iligan City</div>
                </div>
            </div><a href="#" class="view-link"><i class="fas fa-eye me-1"></i> View Applicant</a>
        </div>
        <div class="member-list">
            <div class="member-info">
                <div>
                    <div><b>Maxine Joyce Lesondra</b></div>
                    <div style="font-size: 12px;">Luinab, Iligan City</div>
                </div>
            </div><a href="#" class="view-link"><i class="fas fa-eye me-1"></i> View Applicant</a>
        </div>
        <div class="member-list">
            <div class="member-info">
                <div>
                    <div><b>Jielven Rose Baraquel</b></div>
                    <div style="font-size: 12px;">Santa Filomena, Iligan City</div>
                </div>
            </div><a href="#" class="view-link"><i class="fas fa-eye me-1"></i> View Applicant</a>
        </div>
        <div class="member-list">
            <div class="member-info">
                <div>
                    <div><b>Rosemarie Dela Cruz</b></div>
                    <div style="font-size: 12px;">Acmac, Iligan City</div>
                </div>
            </div><a href="#" class="view-link"><i class="fas fa-eye me-1"></i> View Applicant</a>
        </div>
        <div class="member-list">
            <div class="member-info">
                <div>
                    <div><b>Mary Grace Luna</b></div>
                    <div style="font-size: 12px;">Luinab, Iligan City</div>
                </div>
            </div><a href="#" class="view-link"><i class="fas fa-eye me-1"></i> View Applicant</a>
        </div>
        <div class="member-list">
            <div class="member-info">
                <div>
                    <div><b>Rosie Ong</b></div>
                    <div style="font-size: 12px;">Tambo, Iligan City</div>
                </div>
            </div><a href="#" class="view-link"><i class="fas fa-eye me-1"></i> View Applicant</a>
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