<script>
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('txt').innerHTML =
    "JAM " + h + " : " + m + " : " + s;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
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

<body onload="startTime()">

<div class="flex-grid no-responsive-future">
            <div class="row"> 
                <div class="cell colspan12 padding40 bg-white">             
                   
                <h1 class="align-center">Dashboard</h1>
                <hr class="thin bg-grayLighter">
                            <h4>
                                <script type='text/javascript'>
                                    var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                    var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                                    var date = new Date();
                                    var day = date.getDate();
                                    var month = date.getMonth();
                                    var thisDay = date.getDay(),
                                        thisDay = myDays[thisDay];
                                    var yy = date.getYear();
                                    var year = (yy < 1000) ? yy + 1900 : yy;
                                    document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
                                   
                                </script>
                                <div id="txt" class="place-right"></div>
                            </h4>
                            <div class="times" data-role="times"></div>
                <hr class="thin bg-grayLighter">
                            <div class="page align-center">
                                <h1>Kalender Akademik</h1>
                                <h4>Anda dapat melihat event di tanggal tertentu</h4>
                                <div style="width:100%; max-width:600px; display:inline-block;">
                                    <div class="monthly" id="mycalendar"></div>
                                </div>
                                <br><br>
                            </div>
</div>
</div>
</div>
</body>
                   