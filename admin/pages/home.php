<?php 
$setcl = $DB_connect->prepare("SELECT * FROM teacher_ci");
    $setcl->execute();
    $resteach = $setcl->fetchAll(PDO::FETCH_ASSOC);
 ?>

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
    <script src="../style/js/select2.full.js"></script>  
    <script src="../style/js/jquery.dataTables.js"></script>
    <script src="../style/js/jquery.initiatable.js"></script>
    <script src="../style/js/clickable.datatable.js"></script>
    <script src="../style/js/jquery.steps.min.js"></script>

    <script src="../style/js/metro.js"></script>
    <script src="../style/js/fungsi_cls.js"></script>
    <script src="../style/js/del_cls.js"></script>

    <script src="../style/js/option_adm.js"></script>
    <script src="../style/js/tinymce.min.js"></script>
    <script src="../style/js/monthly.js"></script>

    <script>tinymce.init({ selector:'.editor' });</script>

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
    
    <script type="text/javascript">
        $(document).ready(function() {
            var max_fields      = 10; //maximum input boxes allowed
            var wrapper         = $(".input_fields_wrap"); //Fields wrapper
            var add_button      = $(".add_field_button"); //Add button ID
            
            var x = 1; //initlal text box count
            $(add_button).click(function(e){ //on add input button click
                e.preventDefault();
                if(x < max_fields){ //max input box allowed
                    x++; //text box increment
                    $(wrapper).append('<div><input type="text" name="mytext[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
                }
            });
            
            $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                e.preventDefault(); $(this).parent('div').remove(); x--;
            })
        });
    </script>

    <script type="text/javascript">
        function preventDupes( select, index ) {
    var options = select.options,
        len = options.length;
    while( len-- ) {
        options[ len ].disabled = false;
    }
    select.options[ index ].disabled = true;
    if( index === select.selectedIndex ) {
        alert('You\'ve already selected the item "' + select.options[index].text + '".\n\nPlease choose another.');
        this.selectedIndex = 0;
    }
    }

    var select1 = select = document.getElementById( 'kls1' );
    var select2 = select = document.getElementById( 'select2' );

    select1.onchange = function() {
        preventDupes.call(this, select2, this.selectedIndex );
    };

    select2.onchange = function() {
        preventDupes.call(this, select1, this.selectedIndex );
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
function showDialog(id){
    var dialog = $(id).data('dialog');
    dialog.open();
}
</script>


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

<?php foreach ($resteach as $resteach) {?>
    <script type="text/javascript">
    $(function(){
        $("input[type='radio'][id='guru<?php echo $resteach['id_guru']; ?>']").click(function(){
            $("input[type='radio'][id='nip<?php echo $resteach['nip']; ?>']").prop('checked',true);
        });
    });
    </script>
<?php } ?>

</head>
<body class="bg-steel">
        <div class="flex-grid no-responsive-future" style="height: 100%;">
            <div class="row" style="height: 100%">
                <div class="cell auto-size bg-white" id="cell-content" style="overflow:true;">
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
</body>


        <footer class="app-bar fixed-bottom padding10" data-role="appbar">

           <div>Sistem Kesiswaan SDIT Citra Insani Copyright @ <?php echo date("Y"); ?> <div class="place-right">Developed by Deny Rachmat</div></div> 
        </footer>
</html>

