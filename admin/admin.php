<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | StudySelf</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4895ef;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --success-color: #4cc9f0;
            --warning-color: #f8961e;
            --danger-color: #f72585;
            --sidebar-width: 250px;
            --header-height: 70px;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            color: var(--dark-color);
            overflow-x: hidden;
        }

        #header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--header-height);
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            display: flex;
            align-items: center;
            padding: 0 20px;
        }

        .navbar {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary-color);
        }

        .logo i {
            font-size: 1.8rem;
        }

        .btn {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .btn ul {
            display: flex;
            align-items: center;
            gap: 15px;
            list-style: none;
        }

        .user-name {
            font-weight: 500;
            color: var(--dark-color);
            text-decoration: none;
        }

        .cta-button {
            background-color: var(--primary-color);
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }

        .cta-button:hover {
            background-color: var(--secondary-color);
        }

        .hamburger {
            font-size: 1.5rem;
            cursor: pointer;
            display: none;
        }

        main {
            display: flex;
            margin-top: var(--header-height);
            min-height: calc(100vh - var(--header-height));
        }

        .left-side {
            width: var(--sidebar-width);
            background-color: white;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            transition: var(--transition);
            position: fixed;
            top: var(--header-height);
            left: 0;
            bottom: 0;
            z-index: 999;
        }

        .menu-container {
            padding: 20px 0;
        }

        .menu-container ul {
            list-style: none;
        }

        .menu-container li {
            margin-bottom: 5px;
        }

        .menu-container a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 20px;
            text-decoration: none;
            color: var(--dark-color);
            font-weight: 500;
            transition: var(--transition);
            border-left: 3px solid transparent;
        }

        .menu-container a:hover, .menu-container a.active {
            background-color: rgba(67, 97, 238, 0.1);
            color: var(--primary-color);
            border-left: 3px solid var(--primary-color);
        }

        .menu-container a i {
            width: 20px;
            text-align: center;
        }

        .right-side {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 20px;
            transition: var(--transition);
        }

        section {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            padding: 20px;
            margin-bottom: 20px;
            display: none;
        }

        section.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .section-header h2 {
            font-size: 1.5rem;
            color: var(--primary-color);
        }

        .btn-add {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 500;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .btn-add:hover {
            background-color: var(--secondary-color);
        }

        /* Dashboard Stats */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
        }

        .stat-card.users::before {
            background-color: var(--primary-color);
        }

        .stat-card.notes::before {
            background-color: var(--success-color);
        }

        .stat-card.downloads::before {
            background-color: var(--warning-color);
        }

        .stat-card.revenue::before {
            background-color: var(--danger-color);
        }

        .stat-card h3 {
            font-size: 0.9rem;
            font-weight: 500;
            color: #6c757d;
            margin-bottom: 10px;
        }

        .stat-card .value {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .stat-card .change {
            font-size: 0.8rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .stat-card .change.positive {
            color: #28a745;
        }

        .stat-card .change.negative {
            color: #dc3545;
        }

        /* Charts */
        .charts-container {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .chart-card {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .chart-card h3 {
            font-size: 1.1rem;
            margin-bottom: 15px;
            color: var(--dark-color);
        }

        /* Recent Activity */
        .activity-list {
            list-style: none;
        }

        .activity-item {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgba(67, 97, 238, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: var(--primary-color);
        }

        .activity-content {
            flex: 1;
        }

        .activity-content p {
            margin-bottom: 5px;
            font-size: 0.9rem;
        }

        .activity-content .time {
            font-size: 0.8rem;
            color: #6c757d;
        }

        /* Forms */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-family: inherit;
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .form-row {
            display: flex;
            gap: 20px;
        }

        .form-row .form-group {
            flex: 1;
        }

        /* Tables */
        .table-responsive {
            overflow-x: auto;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th, .data-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .data-table th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: var(--dark-color);
        }

        .data-table tr:hover {
            background-color: #f8f9fa;
        }

        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .badge-primary {
            background-color: rgba(67, 97, 238, 0.1);
            color: var(--primary-color);
        }

        .badge-success {
            background-color: rgba(76, 201, 240, 0.1);
            color: var(--success-color);
        }

        .badge-warning {
            background-color: rgba(248, 150, 30, 0.1);
            color: var(--warning-color);
        }

        .badge-danger {
            background-color: rgba(247, 37, 133, 0.1);
            color: var(--danger-color);
        }

        .action-btn {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            margin: 0 5px;
            transition: var(--transition);
        }

        .action-btn.edit {
            color: var(--success-color);
        }

        .action-btn.delete {
            color: var(--danger-color);
        }

        .action-btn:hover {
            opacity: 0.8;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1100;
            justify-content: center;
            align-items: center;
        }

        .modal.show {
            display: flex;
        }

        .modal-content {
            background-color: white;
            border-radius: 10px;
            width: 90%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
            animation: modalFadeIn 0.3s ease;
        }

        @keyframes modalFadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .modal-header {
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h3 {
            font-size: 1.3rem;
            color: var(--dark-color);
        }

        .modal-header .close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #6c757d;
        }

        .modal-body {
            padding: 20px;
        }

        .modal-footer {
            padding: 15px 20px;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        /* File Upload */
        .file-upload {
            border: 2px dashed #ddd;
            border-radius: 5px;
            padding: 30px;
            text-align: center;
            cursor: pointer;
            transition: var(--transition);
            margin-bottom: 20px;
        }

        .file-upload:hover {
            border-color: var(--primary-color);
        }

        .file-upload i {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .file-upload p {
            margin-bottom: 5px;
        }

        .file-upload small {
            color: #6c757d;
        }

        /* Download Status */
        .download-status {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-right: 5px;
        }

        .status-completed {
            background-color: var(--success-color);
        }

        .status-pending {
            background-color: var(--warning-color);
        }

        .status-failed {
            background-color: var(--danger-color);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .left-side {
                transform: translateX(-100%);
            }

            .left-side.show {
                transform: translateX(0);
            }

            .right-side {
                margin-left: 0;
            }

            .hamburger {
                display: block;
            }

            .charts-container {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .stats-container {
                grid-template-columns: 1fr 1fr;
            }

            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }

        @media (max-width: 576px) {
            .stats-container {
                grid-template-columns: 1fr;
            }

            .btn ul {
                display: none;
            }
        }
    </style>
</head>
<body>
    <header id="header">
        <div class="navbar">
            <div class="logo">
                <i class="fas fa-book-open-reader"></i>
                <span>StudySelf</span>
            </div>
            <div class="btn">
                <ul>
                    <a href="#" class="user-name">Admin Name</a>
                    <a href="#" class="cta-button">Logout</a>
                </ul>
                <div class="hamburger">
                    <i class="fas fa-bars"></i>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="left-side">
            <div class="menu-container">
                <ul>
                    <li><a href="#" class="active" data-section="dashboard"><i class="fas fa-chart-line"></i> Dashboard</a></li>
                    <li><a href="#" data-section="upload-notes"><i class="fas fa-upload"></i> Upload Notes</a></li>
                    <li><a href="#" data-section="manage-notes"><i class="fas fa-book"></i> Manage Notes</a></li>
                    <li><a href="#" data-section="manage-downloads"><i class="fas fa-download"></i> Manage Downloads</a></li>
                    <li><a href="#" data-section="manage-users"><i class="fas fa-users"></i> Manage Users</a></li>
                    <li><a href="#" data-section="settings"><i class="fas fa-cog"></i> Settings</a></li>
                </ul>
            </div>
        </div>
        <div class="right-side">
            <!-- Dashboard Section -->
            <section id="dashboard" class="active">
                <div class="section-header">
                    <h2>Dashboard Overview</h2>
                    <div class="date-selector">
                        <select class="form-control" style="width: auto;">
                            <option>Last 7 Days</option>
                            <option>Last 30 Days</option>
                            <option>Last 90 Days</option>
                            <option>This Year</option>
                        </select>
                    </div>
                </div>

                <div class="stats-container">
                    <div class="stat-card users">
                        <h3>Total Users</h3>
                        <div class="value">1,254</div>
                        <div class="change positive">
                            <i class="fas fa-arrow-up"></i> 12.5% from last month
                        </div>
                    </div>
                    <div class="stat-card notes">
                        <h3>Total Notes</h3>
                        <div class="value">568</div>
                        <div class="change positive">
                            <i class="fas fa-arrow-up"></i> 8.3% from last month
                        </div>
                    </div>
                    <div class="stat-card downloads">
                        <h3>Total Downloads</h3>
                        <div class="value">4,892</div>
                        <div class="change negative">
                            <i class="fas fa-arrow-down"></i> 3.2% from last month
                        </div>
                    </div>
                    <div class="stat-card revenue">
                        <h3>Total Revenue</h3>
                        <div class="value">$2,450</div>
                        <div class="change positive">
                            <i class="fas fa-arrow-up"></i> 15.7% from last month
                        </div>
                    </div>
                </div>

                <div class="charts-container">
               

                <div class="chart-card">
                    <h3>Recent Activity</h3>
                    <ul class="activity-list">
                        <li class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <div class="activity-content">
                                <p>New user registered: John Doe</p>
                                <span class="time">10 minutes ago</span>
                            </div>
                        </li>
                        <li class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="activity-content">
                                <p>New note uploaded: "Advanced Calculus"</p>
                                <span class="time">2 hours ago</span>
                            </div>
                        </li>
                        <li class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-download"></i>
                            </div>
                            <div class="activity-content">
                                <p>Note "Python Basics" downloaded 25 times</p>
                                <span class="time">5 hours ago</span>
                            </div>
                        </li>
                        <li class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-comment"></i>
                            </div>
                            <div class="activity-content">
                                <p>New review added to "Data Structures"</p>
                                <span class="time">1 day ago</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </section>

            <!-- Upload Notes Section -->
            <section id="upload-notes">
                <div class="section-header">
                    <h2>Upload New Notes</h2>
                </div>

                <form id="uploadForm">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="noteTitle">Note Title</label>
                            <input type="text" id="noteTitle" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="noteCategory">Category</label>
                            <select id="noteCategory" class="form-control" required>
                                <option value="">Select Category</option>
                                <option value="Mathematics">Mathematics</option>
                                <option value="Science">Science</option>
                                <option value="Programming">Programming</option>
                                <option value="Literature">Literature</option>
                                <option value="History">History</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="noteDescription">Description</label>
                        <textarea id="noteDescription" class="form-control" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Upload File</label>
                        <div class="file-upload" id="fileUploadArea">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p>Drag & Drop your files here</p>
                            <small>or click to browse</small>
                            <input type="file" id="noteFile" style="display: none;" required>
                        </div>
                        <div id="fileName" style="display: none; margin-top: 10px;">
                            <i class="fas fa-file-alt"></i> <span id="selectedFileName"></span>
                            <button type="button" id="removeFile" style="background: none; border: none; color: var(--danger-color); cursor: pointer; margin-left: 10px;">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="noteTags">Tags (comma separated)</label>
                        <input type="text" id="noteTags" class="form-control" placeholder="e.g., algebra, calculus, math">
                    </div>

                    <div class="form-group">
                        <label>
                            <input type="checkbox" id="isPremium"> Premium Content
                        </label>
                    </div>

                    <button type="submit" class="btn-add">
                        <i class="fas fa-upload"></i> Upload Notes
                    </button>
                </form>
            </section>

            <!-- Manage Notes Section -->
            <section id="manage-notes">
                <div class="section-header">
                    <h2>Manage Notes</h2>
                    <div class="search-filter">
                        <input type="text" class="form-control" placeholder="Search notes..." style="width: 250px;">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Upload Date</th>
                                <th>Downloads</th>
                      
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#001</td>
                                <td>Introduction to Python</td>
                                <td>Programming</td>
                                <td>2023-05-15</td>
                                <td>324</td>
                              
                                <td>
                                    <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>#002</td>
                                <td>Linear Algebra</td>
                                <td>Mathematics</td>
                                <td>2023-06-02</td>
                                <td>187</td>
                               
                                <td>
                                    <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>#003</td>
                                <td>World History</td>
                                <td>History</td>
                                <td>2023-04-28</td>
                                <td>92</td>
                                
                                <td>
                                    <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>#004</td>
                                <td>Organic Chemistry</td>
                                <td>Science</td>
                                <td>2023-06-10</td>
                                <td>145</td>
                               
                                <td>
                                    <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>#005</td>
                                <td>Shakespeare's Works</td>
                                <td>Literature</td>
                                <td>2023-05-22</td>
                                <td>76</td>
                             
                                <td>
                                    <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div style="margin-top: 20px; display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        Showing 1 to 5 of 25 entries
                    </div>
                    <div>
                        <button class="btn-add" style="margin-right: 10px;">Previous</button>
                        <button class="btn-add">Next</button>
                    </div>
                </div>
            </section>

            <!-- Manage Downloads Section -->
            <section id="manage-downloads">
                <div class="section-header">
                    <h2>Manage Downloads</h2>
                    <div class="search-filter">
                        <input type="text" class="form-control" placeholder="Search downloads..." style="width: 250px;">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Note Title</th>
                                <th>Subject</th>
                                <th>Download Date</th>
                             
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#DL001</td>
                                <td>John Smith</td>
                                <td>Introduction to Python</td>
                                <td>Programming</td>
                                <td>2023-06-15 10:30</td>
                          
                                <td>
                                    <button class="action-btn edit"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>#DL002</td>
                                <td>Sarah Johnson</td>
                                <td>Linear Algebra</td>
                                <td>Mathematics</td>
                                <td>2023-06-14 15:45</td>
                               
                                <td>
                                    <button class="action-btn edit"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>#DL003</td>
                                <td>Michael Brown</td>
                                <td>Organic Chemistry</td>
                                <td>Science</td>
                                <td>2023-06-14 09:20</td>
                              
                                <td>
                                    <button class="action-btn edit"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>#DL004</td>
                                <td>Emily Davis</td>
                                <td>World History</td>
                                <td>History</td>
                                <td>2023-06-13 14:10</td>
                              
                                <td>
                                    <button class="action-btn edit"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>#DL005</td>
                                <td>Robert Wilson</td>
                                <td>Shakespeare's Works</td>
                                <td>Literature</td>
                                <td>2023-06-12 16:30</td>
                              
                                <td>
                                    <button class="action-btn edit"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div style="margin-top: 20px; display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        Showing 1 to 5 of 18 entries
                    </div>
                    <div>
                        <button class="btn-add" style="margin-right: 10px;">Previous</button>
                        <button class="btn-add">Next</button>
                    </div>
                </div>
            </section>


            <!-- Manage Users Section -->
            <section id="manage-users">
                <div class="section-header">
                    <h2>Manage Users</h2>
                    <div class="search-filter">
                        <input type="text" class="form-control" placeholder="Search users..." style="width: 250px;">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Joined</th>
                      
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#1001</td>
                                <td>John Smith</td>
                                <td>john@example.com</td>
                                <td>Admin</td>
                                <td>2022-01-15</td>
                             
                                <td>
                                    <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>#1002</td>
                                <td>Sarah Johnson</td>
                                <td>sarah@example.com</td>
                                <td>Teacher</td>
                                <td>2022-03-22</td>
                              
                                <td>
                                    <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>#1003</td>
                                <td>Michael Brown</td>
                                <td>michael@example.com</td>
                                <td>Student</td>
                                <td>2023-02-10</td>
                             
                                <td>
                                    <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>#1004</td>
                                <td>Emily Davis</td>
                                <td>emily@example.com</td>
                                <td>Student</td>
                                <td>2023-04-05</td>
                              
                                <td>
                                    <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>#1005</td>
                                <td>Robert Wilson</td>
                                <td>robert@example.com</td>
                                <td>Teacher</td>
                                <td>2022-11-18</td>
                              
                                <td>
                                    <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div style="margin-top: 20px; display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        Showing 1 to 5 of 32 entries
                    </div>
                    <div>
                        <button class="btn-add" style="margin-right: 10px;">Previous</button>
                        <button class="btn-add">Next</button>
                    </div>
                </div>
            </section>

            <!-- Settings Section -->
            <section id="settings">
                <div class="section-header">
                    <h2>System Settings</h2>
                </div>

                <form id="settingsForm">
                    <div class="form-group">
                        <label for="siteName">Site Name</label>
                        <input type="text" id="siteName" class="form-control" value="StudySelf">
                    </div>

                    <div class="form-group">
                        <label for="siteLogo">Site Logo</label>
                        <div class="file-upload" id="logoUploadArea">
                            <i class="fas fa-image"></i>
                            <p>Click to upload logo</p>
                            <small>Recommended size: 200x50px</small>
                            <input type="file" id="siteLogo" style="display: none;" accept="image/*">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="adminEmail">Admin Email</label>
                        <input type="email" id="adminEmail" class="form-control" value="admin@studyself.com">
                    </div>

                    <div class="form-group">
                        <label for="timezone">Timezone</label>
                        <select id="timezone" class="form-control">
                            <option value="UTC">UTC</option>
                            <option value="EST" selected>Eastern Time (EST)</option>
                            <option value="PST">Pacific Time (PST)</option>
                            <option value="CST">Central Time (CST)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="maintenanceMode">
                            <input type="checkbox" id="maintenanceMode"> Maintenance Mode
                        </label>
                    </div>

                    <div class="form-group">
                        <label for="googleAnalytics">Google Analytics ID</label>
                        <input type="text" id="googleAnalytics" class="form-control" placeholder="UA-XXXXX-Y">
                    </div>

                    <button type="submit" class="btn-add">
                        <i class="fas fa-save"></i> Save Settings
                    </button>
                </form>
            </section>
        </div>
    </main>

    <!-- Edit Note Modal -->
    <div class="modal" id="editNoteModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Edit Note</h3>
                <button class="close">&times;</button>
            </div>
            <div class="modal-body">
                <form id="editNoteForm">
                    <div class="form-group">
                        <label for="editNoteTitle">Note Title</label>
                        <input type="text" id="editNoteTitle" class="form-control" value="Introduction to Python" required>
                    </div>
                    <div class="form-group">
                        <label for="editNoteCategory">Category</label>
                        <select id="editNoteCategory" class="form-control" required>
                            <option value="Mathematics">Mathematics</option>
                            <option value="Science">Science</option>
                            <option value="Programming" selected>Programming</option>
                            <option value="Literature">Literature</option>
                            <option value="History">History</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editNoteDescription">Description</label>
                        <textarea id="editNoteDescription" class="form-control" required>Basic Python programming concepts for beginners.</textarea>
                    </div>
                    <div class="form-group">
                        <label for="editNoteStatus">Status</label>
                        <select id="editNoteStatus" class="form-control" required>
                            <option value="active" selected>Active</option>
                            <option value="pending">Pending</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn-add" id="saveNoteChanges">Save Changes</button>
                <button class="btn-add" style="background-color: #6c757d;" id="cancelNoteEdit">Cancel</button>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal" id="editUserModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Edit User</h3>
                <button class="close">&times;</button>
            </div>
            <div class="modal-body">
                <form id="editUserForm">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="editFirstName">First Name</label>
                            <input type="text" id="editFirstName" class="form-control" value="John" required>
                        </div>
                        <div class="form-group">
                            <label for="editLastName">Last Name</label>
                            <input type="text" id="editLastName" class="form-control" value="Smith" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="editEmail">Email Address</label>
                        <input type="email" id="editEmail" class="form-control" value="john@example.com" required>
                    </div>
                    <div class="form-group">
                        <label for="editUserRole">User Role</label>
                        <select id="editUserRole" class="form-control" required>
                            <option value="student">Student</option>
                            <option value="teacher">Teacher</option>
                            <option value="admin" selected>Admin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editUserStatus">Status</label>
                        <select id="editUserStatus" class="form-control" required>
                            <option value="active" selected>Active</option>
                            <option value="pending">Pending</option>
                            <option value="suspended">Suspended</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn-add" id="saveUserChanges">Save Changes</button>
                <button class="btn-add" style="background-color: #6c757d;" id="cancelUserEdit">Cancel</button>
            </div>
        </div>
    </div>

    <!-- View Download Modal -->
    <div class="modal" id="viewDownloadModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Download Details</h3>
                <button class="close">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Download ID</label>
                    <div class="form-control" style="background-color: #f8f9fa;">#DL001</div>
                </div>
                <div class="form-group">
                    <label>User</label>
                    <div class="form-control" style="background-color: #f8f9fa;">John Smith (john@example.com)</div>
                </div>
                <div class="form-group">
                    <label>Note Title</label>
                    <div class="form-control" style="background-color: #f8f9fa;">Introduction to Python</div>
                </div>
                <div class="form-group">
                    <label>Subject</label>
                    <div class="form-control" style="background-color: #f8f9fa;">Programming</div>
                </div>
                <div class="form-group">
                    <label>Download Date</label>
                    <div class="form-control" style="background-color: #f8f9fa;">2023-06-15 10:30 AM</div>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <div class="form-control" style="background-color: #f8f9fa;">
                        <span class="download-status status-completed"></span> Completed
                    </div>
                </div>
                <div class="form-group">
                    <label>IP Address</label>
                    <div class="form-control" style="background-color: #f8f9fa;">192.168.1.1</div>
                </div>
                <div class="form-group">
                    <label>Device</label>
                    <div class="form-control" style="background-color: #f8f9fa;">Chrome on Windows 10</div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-add" style="background-color: #6c757d;" id="closeDownloadView">Close</button>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal" id="confirmModal">
        <div class="modal-content" style="max-width: 400px;">
            <div class="modal-header">
                <h3>Confirm Action</h3>
                <button class="close">&times;</button>
            </div>
            <div class="modal-body">
                <p id="confirmMessage">Are you sure you want to delete this item?</p>
            </div>
            <div class="modal-footer">
                <button class="btn-add" id="confirmAction" style="background-color: var(--danger-color);">Confirm</button>
                <button class="btn-add" style="background-color: #6c757d;" id="cancelAction">Cancel</button>
            </div>
        </div>
    </div>

    <script>
        // DOM Elements
        const hamburger = document.querySelector('.hamburger');
        const leftSide = document.querySelector('.left-side');
        const rightSide = document.querySelector('.right-side');
        const menuLinks = document.querySelectorAll('.menu-container a');
        const sections = document.querySelectorAll('section');
        const fileUploadArea = document.getElementById('fileUploadArea');
        const noteFile = document.getElementById('noteFile');
        const fileName = document.getElementById('fileName');
        const selectedFileName = document.getElementById('selectedFileName');
        const removeFile = document.getElementById('removeFile');
        const editNoteModal = document.getElementById('editNoteModal');
        const editUserModal = document.getElementById('editUserModal');
        const viewDownloadModal = document.getElementById('viewDownloadModal');
        const confirmModal = document.getElementById('confirmModal');
        const closeButtons = document.querySelectorAll('.close');
        const cancelButtons = document.querySelectorAll('[id$="Edit"], #cancelAction, #closeDownloadView');
        const editButtons = document.querySelectorAll('.action-btn.edit');
        const deleteButtons = document.querySelectorAll('.action-btn.delete');
        const viewButtons = document.querySelectorAll('#manage-downloads .action-btn.edit');

        // Toggle sidebar on mobile
        hamburger.addEventListener('click', () => {
            leftSide.classList.toggle('show');
        });

        // Switch between sections
        menuLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                
                // Remove active class from all links and sections
                menuLinks.forEach(l => l.classList.remove('active'));
                sections.forEach(s => s.classList.remove('active'));
                
                // Add active class to clicked link
                link.classList.add('active');
                
                // Show corresponding section
                const sectionId = link.getAttribute('data-section');
                document.getElementById(sectionId).classList.add('active');
                
                // Hide sidebar on mobile after selection
                if (window.innerWidth <= 992) {
                    leftSide.classList.remove('show');
                }
            });
        });

        // File upload handling
        fileUploadArea.addEventListener('click', () => {
            noteFile.click();
        });

        noteFile.addEventListener('change', () => {
            if (noteFile.files.length > 0) {
                selectedFileName.textContent = noteFile.files[0].name;
                fileName.style.display = 'block';
                fileUploadArea.style.borderColor = 'var(--success-color)';
            }
        });

        removeFile.addEventListener('click', () => {
            noteFile.value = '';
            fileName.style.display = 'none';
            fileUploadArea.style.borderColor = '#ddd';
        });

        // Drag and drop for file upload
        fileUploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            fileUploadArea.style.borderColor = 'var(--primary-color)';
        });

        fileUploadArea.addEventListener('dragleave', () => {
            fileUploadArea.style.borderColor = noteFile.files.length > 0 ? 'var(--success-color)' : '#ddd';
        });

        fileUploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            if (e.dataTransfer.files.length > 0) {
                noteFile.files = e.dataTransfer.files;
                selectedFileName.textContent = noteFile.files[0].name;
                fileName.style.display = 'block';
                fileUploadArea.style.borderColor = 'var(--success-color)';
            }
        });

        // Form submissions
        document.getElementById('uploadForm').addEventListener('submit', (e) => {
            e.preventDefault();
            alert('Notes uploaded successfully!');
            // Here you would typically send the form data to the server
        });

        document.getElementById('registerForm').addEventListener('submit', (e) => {
            e.preventDefault();
            alert('User registered successfully!');
            // Here you would typically send the form data to the server
        });

        document.getElementById('settingsForm').addEventListener('submit', (e) => {
            e.preventDefault();
            alert('Settings saved successfully!');
            // Here you would typically send the form data to the server
        });

        // Modal handling
        function openModal(modal) {
            modal.classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(modal) {
            modal.classList.remove('show');
            document.body.style.overflow = '';
        }

        // Edit note buttons
        editButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                if (btn.closest('#manage-notes')) {
                    openModal(editNoteModal);
                } else if (btn.closest('#manage-users')) {
                    openModal(editUserModal);
                }
            });
        });

        // View download buttons
        viewButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                openModal(viewDownloadModal);
            });
        });

        // Delete buttons
        deleteButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                document.getElementById('confirmMessage').textContent = 'Are you sure you want to delete this item?';
                openModal(confirmModal);
            });
        });

        // Close modals
        closeButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                const modal = btn.closest('.modal');
                closeModal(modal);
            });
        });

        cancelButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                const modal = btn.closest('.modal');
                if (modal) {
                    closeModal(modal);
                }
            });
        });

        // Save changes buttons
        document.getElementById('saveNoteChanges').addEventListener('click', () => {
            alert('Note changes saved!');
            closeModal(editNoteModal);
        });

        document.getElementById('saveUserChanges').addEventListener('click', () => {
            alert('User changes saved!');
            closeModal(editUserModal);
        });

        document.getElementById('confirmAction').addEventListener('click', () => {
            alert('Item deleted!');
            closeModal(confirmModal);
        });

        // Close modal when clicking outside
        window.addEventListener('click', (e) => {
            if (e.target.classList.contains('modal')) {
                closeModal(e.target);
            }
        });

      
       
    </script>
</body>
</html>