//function delete class
$(document).ready(function () { 

function initiatablejs() {
      $.getScript("../style/js/jquery.initiatable.js");
      $.getScript("../style/js/clickable.datatable.js");
       $.getScript("../style/js/del_cls.js");
}
$(function() {
    var ajax_load = "<div class='row'><legend><span class='text-primary'><img src='../style/images/loading.gif' title='dreams' /></span></legend></div>";
    var loadUrl = "index.php?page=kelas #loadpage";
      
        $('#btn-del').on('click', function(e) {
          if ($('input.checkbox_del').is(':checked')) {
        if (confirm('Apakah anda Yakin')) {
            $.post('index.php?page=d_kelas', $('form#formdel').serialize(), function (data) {
                alert('Data kelas sukses dihapus !');
                $("#loadpage").html(ajax_load).load(loadUrl,initiatablejs);
              // This is executed when the call to mail.php was succesful.
                // 'data' contains the response from the request
                }).error(function() {
                alert('Mohon maaf ada kesalahan')
                // This is executed when the call to mail.php failed.
                });
        } else {
            alert('Anda memilih cancel data tidak jadi dihapus');
        }
        
              e.preventDefault();
      }
      else
      {
              alert('Silahkan pilih dahulu kelas dibawah ini!');
        e.preventDefault();
          }
        });
    });
});

//function delete teacher
$(document).ready(function () { 

function initiatablejs() {
      $.getScript("../style/js/jquery.initiatable.js");
      $.getScript("../style/js/clickable.datatable.js");
}
$(function() {
    var ajax_load = "<div class='row'><legend><span class='text-primary'><img src='../style/images/loading.gif' title='dreams' /></span></legend></div>";
    var loadUrl = "index.php?page=guru #loadpage";
      
        $('#btn-del-guru').on('click', function(e) {
          if ($('input.checkbox_del').is(':checked')) {
        if (confirm('Apakah anda Yakin? (Menghapus data ini meneyebabkan guru tidak bisa mengakses akun serta jika guru yang dihapus adalah wali kelas maka akan terhapus juga kelasnya)')) {
            $.post('index.php?page=d_teach', $('#formdelteach').serialize(), function (data) {
                alert('Data guru sukses dihapus !');
                $("#loadpage").html(ajax_load).load(loadUrl,initiatablejs);
              // This is executed when the call to mail.php was succesful.
                // 'data' contains the response from the request
                }).error(function() {
                alert('Mohon maaf ada kesalahan')
                // This is executed when the call to mail.php failed.
                });
        } else {
            alert('Anda memilih cancel data tidak jadi dihapus');
        }
        
              e.preventDefault();
      }
      else
      {
              alert('Silahkan pilih dahulu guru dibawah ini!');
        e.preventDefault();
          }
        });
    });
});

//function delete matpel
$(document).ready(function () { 

function initiatablejs() {
      $.getScript("../style/js/jquery.initiatable.js");
      $.getScript("../style/js/clickable.datatable.js");
}
$(function() {
    var ajax_load = "<div class='row'><legend><span class='text-primary'><img src='../style/images/loading.gif' title='dreams' /></span></legend></div>";
    var loadUrl = "index.php?page=matpel #loadpage";
      
        $('#btn-del-matpel').on('click', function(e) {
          if ($('input.checkbox_del').is(':checked')) {
        if (confirm('Apakah anda Yakin? (Menghapus data ini juga menghapus registrasi mata pelajaran guru)')) {
            $.post('index.php?page=d_matpel', $('#delmatpel').serialize(), function (data) {
                alert('Data Mata Pelajaran sukses dihapus !');
                $("#loadpage").html(ajax_load).load(loadUrl,initiatablejs);
              // This is executed when the call to mail.php was succesful.
                // 'data' contains the response from the request
                }).error(function() {
                alert('Mohon maaf ada kesalahan')
                // This is executed when the call to mail.php failed.
                });
        } else {
            alert('Anda memilih cancel data tidak jadi dihapus');
        }
        
              e.preventDefault();
      }
      else
      {
              alert('Silahkan pilih dahulu Mata Pelajaran dibawah ini!');
        e.preventDefault();
          }
        });
    });
});