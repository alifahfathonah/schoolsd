<?php   
$nip = $userRow['username'];
$setcl = $DB_connect->prepare("SELECT * FROM bio_teach_ci WHERE nip = $nip");
    $setcl->execute();
    $resper = $setcl->fetch(PDO::FETCH_ASSOC);
 ?>
<body class="bg-steel">
<div class="app-bar fixed-top darcula" data-role="appbar">
        <a class="app-bar-element branding" href="../">Home</a>
        <span class="app-bar-divider"></span>
        <ul class="app-bar-menu">
            <li>
                
            </li>
            <li>
                
            </li>
            <li>
                            
            </li>
            <li>
                
            </li>
            <li>
                
            </li>
        </ul>

        <div class="app-bar-element place-right">
            <span class="dropdown-toggle"><span class="mif-cog"></span> <?php print($userRow['fullname']) ?></span>
            <div class="app-bar-drop-container padding10 place-right no-margin-top block-shadow fg-dark" data-role="dropdown" data-no-close="true" style="width: 220px">
                <img id="proimg" src="<?php echo $userRow['gambar_p']; ?>" alt="Gambar anda"  style="height: 200px; width:200px;">
                <ul class="unstyled-list fg-dark">
                    <li><a href="?page=inpri" class="fg-white1 fg-hover-yellow">Profile</a></li>
                    <li><a href="" class="fg-white2 fg-hover-yellow">Security</a></li>
                    <li><a href="../lib/logout.php?logout=true" class="fg-white3 fg-hover-yellow">Exit</a></li>
                </ul>
            </div>
        </div>
    </div>
    </body>
