<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Side Bar</title>
    <link href="css/sidebar.css" rel="stylesheet">
    <link href="css/icons.css" rel="stylesheet">

</head>
<body> -->
<link rel="icon" href="./favicon.ico" type="image/x-icon"/>
<link rel="shortcut icon" href="./favicon.ico" type="image/x-icon"/>

    <div class="sidebar">
        <div class="logo_content">
            <div class="logo">
                <!-- <i class="bi bi-app"></i> -->
                <img height="42" width="42" src="./favicon.ico" style="border-radius: 3px;"/>
                <div class="logo_name">NvMarie</div>
            </div>
            <i class="bi bi-justify" id="btn"></i>
        </div>
        <ul class="nav_list">
            <li>
                <a href="dashboard.php">
                    <i class="bi bi-grid"></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <!-- <li>
                <a href="#">
                    <i class="bi bi-person"></i>
                    <span class="links_name">Users</span>
                </a>
                <span class="tooltip">Users</span>
            </li> -->
            <li>
                <a href="list_personnel.php">
                    <i class="bi bi-person-fill"></i>
                    <span class="links_name">Personnel</span>
                </a>
                <span class="tooltip">Personnel</span>
            </li>
            <li>
                <a href="histoire.php">
                    <i class="bi bi-receipt-cutoff"></i>
                    <span class="links_name">Histoire</span>
                </a>
                <span class="tooltip">Histoire</span>
            </li>
            <li>
                <a href="mission.php">
                    <i class="bi bi-signpost-split-fill"></i>
                    <span class="links_name">Mission</span>
                </a>
                <span class="tooltip">Mission</span>
            </li>
            <li>
                <a href="list_projet.php">
                    <i class="bi bi-layout-wtf"></i>
                    <span class="links_name">Projet</span>
                </a>
                <span class="tooltip">Projet</span>
            </li>
            <li>
                <a href="list_activity.php">
                    <i class="bi bi-graph-up"></i>
                    <span class="links_name">Activite</span>
                </a>
                <span class="tooltip">Activite</span>
            </li>
            <li>
                <a href="list_annonce.php">
                    <i class="bi bi-envelope-fill"></i>
                    <span class="links_name">Annonce</span>
                </a>
                <span class="tooltip">Annonce</span>
            </li>
            <li>
                <a href="list_lieux_touristique.php">
                    <i class="bi bi-geo-alt-fill"></i>
                    <span class="links_name">Lieux Touristique</span>
                </a>
                <span class="tooltip">Lieux Touristique</span>
            </li>
            <li>
                <a href="list_publiciter.php">
                    <i class="bi bi-intersect"></i>
                    <span class="links_name">Publiciter</span>
                </a>
                <span class="tooltip">Publiciter</span>
            </li>
            <li>
                <a href="settings.php">
                    <i class="bi bi-gear-fill"></i>
                    <span class="links_name">Settings</span>
                </a>
                <span class="tooltip">Settings</span>
            </li>

            <!--  -->
            
        </ul>
        <div class="profile_content">
            <div class="profile">
                <div class="profile_details">
                    <i class="bi bi-person-circle"></i>
                    <div class="job_name">
                        <div class="name"><?php echo $user['login'] ?></div>
                        <div class="job"><?php echo $user['email'] ?></div>
                    </div>  
                </div>
                <i class="bi bi-box-arrow-left" style="cursor: pointer;" id="logout"></i>
            </div>
        </div>
    </div>
    <script>
        let btn = document.querySelector("#btn");
        let sidebar = document.querySelector(".sidebar");

        btn.onclick = function (){
            sidebar.classList.toggle("active");
        }

    </script>
    
<!--     
</body>
</html> -->
