//ignore my double datatable
$.fn.dataTableExt.sErrMode = 'throw';

//function add new class
$(document).ready(function () { 

function initiatablejs() {
      $.getScript("../style/js/jquery.initiatable.js");
      $.getScript("../style/js/clickable.datatable.js");
      $.getScript("../style/js/del_cls.js");
}

$(function() {
        var ajax_load = "<img src='../style/images/loading.gif' title='dreams' />";
        var loadUrl = "index.php?page=kelas #loadpage";
        
        $('form#addclass').on('submit', function(e) {
                if (confirm('Apakah anda Yakin')) {
                    $.post('?page=s_class', $(this).serialize(), function (data) {                      
                        alert('Data Kelas Sukses Disimpan !');
                        document.getElementById("addclass").reset();                                    
                        $("#loadpage").html(ajax_load).load(loadUrl,initiatablejs);                    
                        // This is executed when the call to mail.php was succesful.
                        // 'data' contains the response from the request
                        }).error(function() {
                        alert('Mohon maaf ada kesalahan')
                        // This is executed when the call to mail.php failed.
                        });
                } else {
                    alert('Anda memilih cancel data tidak jadi disimpan');
                }
                
                e.preventDefault();
        });
    });
}); 

//function add teach

$(document).ready(function () { 

function initiatablejs() {
      $.getScript("../style/js/jquery.initiatable.js");
      $.getScript("../style/js/clickable.datatable.js");
      $.getScript("../style/js/del_cls.js");
}

$(function() {
        var ajax_load = "<div data-role='preloader' data-type='cycle' data-style='color'></div>";
        var loadUrl = "index.php?page=guru #loadpage";
        
        $('form#addteach').on('submit', function(e) {
                if (confirm('Apakah anda Yakin')) {
                    $.post('?page=s_teach', $(this).serialize(), function (data) {                      
                        alert('Data Guru Sukses Disimpan !');
                        document.getElementById("addteach").reset();                                    
                        $("#loadpage").html(ajax_load).load(loadUrl,initiatablejs);                    
                        // This is executed when the call to mail.php was succesful.
                        // 'data' contains the response from the request
                        }).error(function() {
                        alert('Mohon maaf ada kesalahan')
                        // This is executed when the call to mail.php failed.
                        });
                      
                } else {
                    alert('Anda memilih cancel data tidak jadi disimpan');
                    document.getElementById("addteach").reset();
                }
                
                e.preventDefault();
        });
    });
}); 

//func add student

$(document).ready(function () { 

function initiatablejs() {
      $.getScript("../style/js/jquery.initiatable.js");
      $.getScript("../style/js/clickable.datatable.js");
      $.getScript("../style/js/del_cls.js");
}

$(function() {
        var ajax_load = "<div data-role='preloader' data-type='cycle' data-style='color'></div>";
        var loadUrl = "index.php?page=murid #loadpage";
        
        $('form#addstudent').on('submit', function(e) {
                if (confirm('Apakah anda Yakin')) {
                    $.post('?page=s_murid', $(this).serialize(), function (data) {                      
                        alert('Data Murid Sukses Disimpan !');
                        document.getElementById("addstudent").reset();                                    
                        $("#loadpage").html(ajax_load).load(loadUrl,initiatablejs);                    
                        // This is executed when the call to mail.php was succesful.
                        // 'data' contains the response from the request
                        }).error(function() {
                        alert('Mohon maaf ada kesalahan')
                        // This is executed when the call to mail.php failed.
                        });
                      
                } else {
                    alert('Anda memilih cancel data tidak jadi disimpan');
                    document.getElementById("addstudent").reset();
                }
                
                e.preventDefault();
        });
    });
}); 

//function add pelajaran
$(document).ready(function () { 

function initiatablejs() {
      $.getScript("../style/js/jquery.initiatable.js");
      $.getScript("../style/js/clickable.datatable.js");
      $.getScript("../style/js/del_cls.js");
}

$(function() {
        var ajax_load = "<div data-role='preloader' data-type='cycle' data-style='color'></div>";
        var loadUrl = "index.php?page=matpel #loadpage";
        
        $('form#addnampel').on('submit', function(e) {
                if (confirm('Apakah anda Yakin')) {
                    $.post('?page=s_matpel', $(this).serialize(), function (data) {                      
                        alert('Data Pelajaran Sukses Disimpan !');
                        document.getElementById("addnampel").reset();                                    
                        $("#loadpage").html(ajax_load).load(loadUrl,initiatablejs);                    
                        // This is executed when the call to mail.php was succesful.
                        // 'data' contains the response from the request
                        }).error(function() {
                        alert('Mohon maaf ada kesalahan')
                        // This is executed when the call to mail.php failed.
                        });
                      
                } else {
                    alert('Anda memilih cancel data tidak jadi disimpan');
                    document.getElementById("addteach").reset();
                }
                
                e.preventDefault();
        });
    });
}); 

//function add edit class
$(document).ready(function () { 

function initiatablejs() {
      $.getScript("../style/js/jquery.initiatable.js");
      $.getScript("../style/js/clickable.datatable.js");
      $.getScript("../style/js/del_cls.js");
}

$(function() {
        var ajax_load = "<div data-role='preloader' data-type='cycle' data-style='color'></div>";
        var loadUrl = "index.php?page=guru #loadpage";
        
        $('#btn-sub-eclass').on('click', function(e) {
                if (confirm('Apakah anda Yakin')) {
                    $.post('?page=se_kelas', $('#addeclass').serialize(), function (data) {                      
                        alert('Data Kelas Sukses Disimpan !');                                    
                        window.location = "?page=kelas";                    
                        // This is executed when the call to mail.php was succesful.
                        // 'data' contains the response from the request
                        }).error(function() {
                        alert('Mohon maaf ada kesalahan')
                        // This is executed when the call to mail.php failed.
                        });
                      
                } else {
                    alert('Anda memilih cancel data tidak jadi disimpan');
                    document.getElementById("addteach").reset();
                }
                
                e.preventDefault();
        });
    });
}); 

$(document).ready(function () { 

function initiatablejs() {
      $.getScript("../style/js/jquery.initiatable.js");
      $.getScript("../style/js/clickable.datatable.js");
      $.getScript("../style/js/del_cls.js");
}

$(function() {
        var ajax_load = "<div data-role='preloader' data-type='cycle' data-style='color'></div>";
        var loadUrl = "index.php?page=reg_guru #loadpage";
        
        $('form#regteachmatpel').on('submit', function(e) {
                if (confirm('Apakah anda Yakin')) {
                    $.post('?page=s_reg_teach', $(this).serialize(), function (data) {                      
                        alert('Data Guru Sukses Disimpan !');                                    
                        window.location = "?page=reg_guru";                    
                        // This is executed when the call to mail.php was succesful.
                        // 'data' contains the response from the request
                        }).error(function() {
                        alert('Mohon maaf ada kesalahan')
                        // This is executed when the call to mail.php failed.
                        });
                      
                } else {
                    alert('Anda memilih cancel data tidak jadi disimpan');
                }
                
        });
    });
}); 


//function edit registrasi
$(document).ready(function () { 

function initiatablejs() {
      $.getScript("../style/js/jquery.initiatable.js");
      $.getScript("../style/js/clickable.datatable.js");
      $.getScript("../style/js/del_cls.js");
}

$(function() {
        var ajax_load = "<div data-role='preloader' data-type='cycle' data-style='color'></div>";
        var loadUrl = "index.php?page=reg_guru #loadpage";
        
        $('#btn-sub-ereguru').on('click', function(e) {
                if (confirm('Apakah anda Yakin')) {
                    $.post('?page=se_reg_guru', $('#editregguru').serialize(), function (data) {                      
                        alert('Data Guru Sukses Dirubah !');                                    
                        window.location = "?page=reg_guru";                    
                        // This is executed when the call to mail.php was succesful.
                        // 'data' contains the response from the request
                        }).error(function() {
                        alert('Mohon maaf ada kesalahan')
                        // This is executed when the call to mail.php failed.
                        });
                      
                } else {
                    alert('Anda memilih cancel data tidak jadi disimpan');
                }
                
                e.preventDefault();
        });
    });
}); 

//edit guru
$(document).ready(function () { 

function initiatablejs() {
      $.getScript("../style/js/jquery.initiatable.js");
      $.getScript("../style/js/clickable.datatable.js");
      $.getScript("../style/js/del_cls.js");
}

$(function() {
        var ajax_load = "<div data-role='preloader' data-type='cycle' data-style='color'></div>";
        var loadUrl = "index.php?page=guru #loadpage";
        
        $('#btn-sub-eteach').on('click', function(e) {
                if (confirm('Apakah anda Yakin')) {
                    $.post('?page=se_teach', $('#addeteach').serialize(), function (data) {                      
                        alert('Data Guru Sukses Disimpan !');                                    
                        window.location = "?page=guru";                    
                        // This is executed when the call to mail.php was succesful.
                        // 'data' contains the response from the request
                        }).error(function() {
                        alert('Mohon maaf ada kesalahan')
                        // This is executed when the call to mail.php failed.
                        });
                      
                } else {
                    alert('Anda memilih cancel data tidak jadi disimpan');
                    document.getElementById("addteach").reset();
                }
                
                e.preventDefault();
        });
    });
}); 

//simpan bio guru
$(document).ready(function () { 

function initiatablejs() {
      $.getScript("../style/js/jquery.initiatable.js");
      $.getScript("../style/js/clickable.datatable.js");
      $.getScript("../style/js/del_cls.js");
}

$(function() {
        var ajax_load = "<div data-role='preloader' data-type='cycle' data-style='color'></div>";
        var loadUrl = "index.php?page=inpri #loadpage";
        
        $('#btn-sub-bio').on('click', function(e) {
                if (confirm('Apakah anda Yakin')) {
                    $.post('?page=s_bio', $('#updatebio').serialize(), function (data) {                      
                        alert('Biodata Sukses Disimpan !');                                    
                        $("#loadpage").html(ajax_load).load(loadUrl,initiatablejs);                   
                        // This is executed when the call to mail.php was succesful.
                        // 'data' contains the response from the request
                        }).error(function() {
                        alert('Mohon maaf ada kesalahan')
                        // This is executed when the call to mail.php failed.
                        });
                      
                } else {
                    alert('Anda memilih cancel data tidak jadi disimpan');
                    document.getElementById("addteach").reset();
                }
                
                e.preventDefault();
        });
    });
}); 

//simpan pengalaman guru

$(document).ready(function () { 

function initiatablejs() {
      $.getScript("../style/js/jquery.initiatable.js");
      $.getScript("../style/js/clickable.datatable.js");
      $.getScript("../style/js/del_cls.js");
}

$(function() {
        var ajax_load = "<div data-role='preloader' data-type='cycle' data-style='color'></div>";
        var loadUrl = "index.php?page=inpri #loadpage";
        
        $('#btn-sub-exp').on('click', function(e) {
                if (confirm('Apakah anda Yakin')) {
                    $.post('?page=s_exp', $('#updateexp').serialize(), function (data) {                      
                        alert('Pengalaman Sukses Disimpan !');   
                        document.getElementById("updateexp").reset();                                   
                        $("#loadpage").html(ajax_load).load(loadUrl,initiatablejs);                   
                        // This is executed when the call to mail.php was succesful.
                        // 'data' contains the response from the request
                        }).error(function() {
                        alert('Mohon maaf ada kesalahan')
                        // This is executed when the call to mail.php failed.
                        });
                      
                } else {
                    alert('Anda memilih cancel data tidak jadi disimpan');
                    document.getElementById("addteach").reset();
                }
                
                e.preventDefault();
        });
    });
}); 


//simpan pendidikan guru
$(document).ready(function () { 

function initiatablejs() {
      $.getScript("../style/js/jquery.initiatable.js");
      $.getScript("../style/js/clickable.datatable.js");
      $.getScript("../style/js/del_cls.js");
}

$(function() {
        var ajax_load = "<div data-role='preloader' data-type='cycle' data-style='color'></div>";
        var loadUrl = "index.php?page=inpri #loadpage";
        
        $('#btn-sub-edu').on('click', function(e) {
                if (confirm('Apakah anda Yakin')) {
                    $.post('?page=s_edu', $('#saveedu').serialize(), function (data) {                      
                        alert('Pendidikan Sukses Disimpan !');   
                        document.getElementById("saveedu").reset();                                   
                        $("#loadpage").html(ajax_load).load(loadUrl,initiatablejs);                   
                        // This is executed when the call to mail.php was succesful.
                        // 'data' contains the response from the request
                        }).error(function() {
                        alert('Mohon maaf ada kesalahan')
                        // This is executed when the call to mail.php failed.
                        });
                      
                } else {
                    alert('Anda memilih cancel data tidak jadi disimpan');
                    document.getElementById("addteach").reset();
                }
                
                e.preventDefault();
        });
    });
}); 

