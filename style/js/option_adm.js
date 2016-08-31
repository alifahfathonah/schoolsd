$(function(){
            $('#wizard').wizard({
                buttons: {
                    cancel: false,
                    help: false,
                    prior: {
                        show: true,
                        title: "Previous",
                        group: "left",
                        cls: "info"
                    },
                    next: {
                        show: true,
                        title: "Next",
                        group: "left",
                        cls: "info"
                    },
                    finish: false
                }
            });
        });