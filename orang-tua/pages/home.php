<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="Metro, a sleek, intuitive, and powerful framework for faster and easier web development for Windows Metro Style.">
    <meta name="keywords" content="HTML, CSS, JS, JavaScript, framework, metro, front-end, frontend, web development">
    <meta name="author" content="Sergey Pimenov and Metro UI CSS contributors">

    <link rel='shortcut icon' type='image/x-icon' href='../favicon.ico' />

    <title>Selamat datang</title>

    <link href="../style/css/metro.css" rel="stylesheet">
    <link href="../style/css/metro-icons.css" rel="stylesheet">
    <link href="../style/css/metro-responsive.css" rel="stylesheet">
    <link href="../style/css/monthly.css" rel="stylesheet">

    <script src="../style/js/jquery-2.1.3.min.js"></script>
    <script src="../style/js/jquery.dataTables.min.js"></script>
    <script src="../style/js/jquery.initiatable.js"></script>

    <script src="../style/js/metro.js"></script>
     <script src="../style/js/metro-times.js"></script>
    <script src="../style/js/fungsi_cls.js"></script>
    <script src="../style/js/fusioncharts.js"></script>
    <script src="../style/js/monthly.js"></script>
    
    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <style>
        html, body {
            height: 100%;
        }
        body {
        }
        .page-content {
            padding-top: 3.125rem;
            min-height: 100%;
            height: 100%;
        }
        .table .input-control.checkbox {
            line-height: 1;
            min-height: 0;
            height: auto;
        }

        @media screen and (max-width: 800px){
            #cell-sidebar {
                flex-basis: 52px;
            }
            #cell-content {
                flex-basis: calc(100% - 52px);
            }
        }
    </style>

    <script>
        function pushMessage(t){
            var mes = 'Info|Implement independently';
            $.Notify({
                caption: mes.split("|")[0],
                content: mes.split("|")[1],
                type: t
            });
        }

        $(function(){
            $('.sidebar').on('click', 'li', function(){
                if (!$(this).hasClass('active')) {
                    $('.sidebar li').removeClass('active');
                    $(this).addClass('active');
                }
            })
        })
    </script>

    

<script>
function showDialog(id){
    var dialog = $(id).data('dialog');
    dialog.open();
}


</script>

<script type="text/javascript">
                       $(document).ready(function() {
                            $(window).load( function() {

                                $('#mycalendar').monthly({
                                    mode: 'event',
                                    xmlUrl: '../config/events.php'
                                });

                                $('#mycalendar2').monthly({
                                    mode: 'picker',
                                    target: '#mytarget',
                                    setWidth: '250px',
                                    startHidden: true,
                                    showTrigger: '#mytarget',
                                    stylePast: true,
                                    disablePast: true
                                });
                            });

                            switch(window.location.protocol) {
                            case 'http:':
                            case 'https:':
                            // running on a server, should be good.
                            break;
                            case 'file:':
                            alert('Just a heads-up, events will not work when run locally.');
                            }

                            });
                        </script>

</head>
<div class="row" id="loadthis">
<body class="bg-steel">
    <div class="page-content">
        <div class="flex-grid no-responsive-future" style="height: 100%;">
                <div class="row" style="height: 100%">
                    <div class="cell size-x200" id="cell-sidebar" style="background-color: #71b1d1; height: 100%">
                        <ul class="sidebar no-responsive-future" id="sidebar-2">
                            <li><a href="?page=start">
                                <span class="mif-home icon"></span>
                                <span class="title">Beranda</span>
                                <span class="counter">0</span>
                            </a></li>
                            <li><a href="?page=info">
                                <span class="mif-info icon"></span>
                                <span class="title">Info Anak</span>
                                <span class="counter">0</span>
                            </a></li>
                            <li><a href="?page=jurnal">
                                <span class="mif-books icon"></span>
                                <span class="title">Absensi</span>
                                <span class="counter">0</span>
                             </a></li>
                            <li><a href="?page=nilai_stu">
                                <span class="mif-list-numbered icon"></span>
                                <span class="title">Nilai</span>
                                <span class="counter">0</span>
                            </a></li>
                            <li><a href="?page=laporan">
                                <span class="mif-cogs icon"></span>
                                <span class="title">Rapot</span>
                                <span class="counter">0</span>
                            </a></li>
                            <li><a href="../lib/logout.php?logout=true">
                                <span class="mif-exit icon"></span>
                                <span class="title">Logout</span>
                                <span class="counter">0</span>
                            </a></li>
                        </ul>
                </div>
                
                    <div class="flex-grid no-responsive-future" style="height: 100%;">
                        <div class="row" style="height: 100%;">
                            <div class="cell auto-size padding40 bg-white" id="cell-content kontenweb" style="overflow:auto;">
                             <?php    
                                $page = @$_GET['page'];
                                $file = ("include/$page.php");
                                if (!file_exists($file)) 
                                {   
                                include ("include/start.php"); 
                                } 
                                else 
                                { include ("include/$page.php"); }
                            ?>  
                            </div>
                        </div>
        </div>
    </div>
<footer class="app-bar fixed-bottom padding10" data-role="appbar">

           <div>Sistem Kesiswaan SDIT Citra Insani Copyright @ <?php echo date("Y"); ?> <div class="place-right">Developed by Deny Rachmat</div></div> 
        </footer>
</body>
</div>
</html>

