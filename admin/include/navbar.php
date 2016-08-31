<body class="bg-steel">
<div class="app-bar fixed-top darcula" data-role="appbar">
        <a class="app-bar-element branding" href="../">Home</a>
        <span class="app-bar-divider"></span>
        <ul class="app-bar-menu">
            <li>
                <a href="index.php">Beranda</a>
            </li>
            <li>
                <a href="#" class="dropdown-toggle">Ubah Konten Web</a>
                <ul class="d-menu" data-role="dropdown">
                    <li><a href="?page=up_kegiatan">Ganti Foto Kegiatan</a></li>
                    <li><a href="?page=pesan">Contact Us</a></li> 
                    <li class="divider"></li>
                    <li>
                        <a href="#">Konten</a>
                        <ul class="d-menu" data-role="dropdown">
                            <li><a href="?page=add_news">Konten News</a></li>
                            <li><a href="?page=portofolio">Portofolio</a></li>
                        </ul>
                    </li>                                   
                </ul>
            </li>
            <li>
                <a href="index.php?page=kelas">Kelas</a>
            </li>
            <li>
                <a href="#" class="dropdown-toggle">Guru</a>
                <ul class="d-menu" data-role="dropdown">
                    <li><a href="?page=guru">Daftar Guru</a></li>
                    <li><a href="?page=reg_guru">Guru Mata Pelajaran</a></li>                                    
                </ul>                    
            </li>
            <li>
                <a href="#" class="dropdown-toggle">Mata Pelajaran</a>
                <ul class="d-menu" data-role="dropdown">
                    <li><a href="?page=matpel">Daftar Mata Pelajaran</a></li>
                    <li><a href="?page=jam_matpel">Set Jam Matpel</a></li>                                    
                </ul>
            </li>
            <li>
                <a href="#" class="dropdown-toggle">Anak Murid</a>
                <ul class="d-menu" data-role="dropdown">
                    <li><a href="?page=murid">Daftar Anak Murid</a></li>                                   
                </ul>
            </li>
        </ul>

        <div class="app-bar-element place-right">
            <span class="dropdown-toggle"><span class="mif-cog"></span> <?php print($userRow['fullname']) ?></span>
            <div class="app-bar-drop-container padding10 place-right no-margin-top block-shadow fg-dark" data-role="dropdown" data-no-close="true" style="width: 220px">
                <h2 class="text-light">Quick settings</h2>
                <ul class="unstyled-list fg-dark">
                    <li><a href="" class="fg-white1 fg-hover-yellow">Profile</a></li>
                    <li><a href="" class="fg-white2 fg-hover-yellow">Security</a></li>
                    <li><a href="../lib/logout.php?logout=true" class="fg-white3 fg-hover-yellow">Exit</a></li>
                </ul>
            </div>
        </div>
    </div>
    </body>
