<link rel="stylesheet" type="text/css" href="import/bootstrap.min.css">
<script src="import/bootstrap.min.js"></script>
<style>
        .profile-image{
            width:40px;
            height: 40px;
            margin: 0px;
        }
        .dropdown-menu { left: auto !important; right: 0 !important;}
    </style>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">SQL Trening</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="">Treningjeim</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="bemutato">Bemutato</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="trener">Trenerek</a>
                </li>

                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle d-sm-block d-md-block d-lg-none" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Fiokom
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="settings">Fiok Beallitasok</a></li>
                        <li><a class="dropdown-item logout" href="#">Kijelentkezes</a></li>
                    </ul>
                </li>
            </ul>

    
        </div>
        <div class="dropdown btn-lg d-none d-lg-block">
            <button class="btn dropend " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <?php
                    if( file_exists("/uploads/profile-images/". $_SESSION["user"]["id"]."jpg") ) 
                        echo '<img src="/uploads/profile-images/'.$_SESSION["user"]["id"].'.jpg" class="profile-image">';
                    else
                        echo '<img src="/uploads/profile-images/default.jpg" class="profile-image">';
                ?>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="settings">Fiok beallitasai</a></li>
                <!--<li><a class="dropdown-item" href="#">Another action</a></li>-->
                <li><a class="dropdown-item logout" href="#">Kijelentkezes</a></li>
            </ul>
        </div>
    </div>  
</nav>
<script>
        async function  logout() {
            await fetch('logout')
            window.location.reload();
        }
        const $ = (param) => document.getElementById(param)
        let logoutButton = document.querySelectorAll('.logout')
        logoutButton.forEach(element => {
            element.addEventListener("click", () => logout())
        });
    </script>
