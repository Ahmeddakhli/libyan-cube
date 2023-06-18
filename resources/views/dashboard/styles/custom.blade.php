<style>
.modal.left, .modal.right {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    overflow: hidden;
}

.modal.left .modal-dialog,
.modal.right .modal-dialog {
    position: fixed;
    margin: auto;
    height: 100%;
    position: fixed;
    width: 100%;
    padding: 0;
    -webkit-transform: translate3d(0%, 0, 0);
        -ms-transform: translate3d(0%, 0, 0);
         -o-transform: translate3d(0%, 0, 0);
            transform: translate3d(0%, 0, 0);
}

.modal.left .modal-content,
.modal.right .modal-content {
    height: 100%;
    overflow-y: auto;
    border-radius: 0 !important;
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    border: 0 !important;
}

.modal.left .modal-body,
.modal.right .modal-body {
    padding: 15px 15px 80px;
    position: absolute;
    top: 59px;
    bottom: 60px;
    width: 100%;
    font-weight: 300;
    overflow: auto;
}

/Left/
.modal.left.fade .modal-dialog{
    left: -320px;
    -webkit-transition: opacity 0.3s linear, left 0.3s ease-out;
       -moz-transition: opacity 0.3s linear, left 0.3s ease-out;
         -o-transition: opacity 0.3s linear, left 0.3s ease-out;
            transition: opacity 0.3s linear, left 0.3s ease-out;
}

.modal.left.fade.in .modal-dialog{
    left: 0;
}
    
/Right/
.modal.right.fade .modal-dialog {
    right: -320px;
    -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
       -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
         -o-transition: opacity 0.3s linear, right 0.3s ease-out;
            transition: opacity 0.3s linear, right 0.3s ease-out;
}

.modal.right.fade.in .modal-dialog {
    right: 0;
}

.modal.left .modal-header,
.modal.right .modal-header {
    position: absolute;
    top: 0;
    right: 0;
    left: 0;
    height:48px;
    background: #F0EBF4;
    border: 0;
}

.modal.left .modal-footer,
.modal.right .modal-footer {
        position: absolute;
        right: 0;
        bottom: 0;
        left: 0;
        height:48px;
        padding: 10px;
        background: #F0EBF4;
    }

#fast_modal .modal-title {
    color: #69646d !important;
    line-height: 1.2 !important;
}

#fast_modal .modal-footer .btn {
    color: #69646d !important;
}

.modal.left .modal-body, .modal.right .modal-body {
    top: 59px !important;
    bottom: 59px !important;
}
/* Extra small devices (phones, 600px and down) */
@media only screen and (max-width: 600px) {
    .modal.left .modal-dialog, .modal.right .modal-dialog{width:320px}
} 

/* Small devices (portrait tablets and large phones, 600px and up) */
@media only screen and (min-width: 600px) {
    .modal.left .modal-dialog, .modal.right .modal-dialog{width:320px}
} 

/* Medium devices (landscape tablets, 768px and up) */
@media only screen and (min-width: 768px) {
    .modal.left .modal-dialog, .modal.right .modal-dialog{width:400px}
}

/* Large devices (laptops/desktops, 992px and up) */
@media only screen and (min-width: 992px) {
    .modal.left .modal-dialog, .modal.right .modal-dialog{width:400px}
} 

/* Extra large devices (large laptops and desktops, 1200px and up) */
@media only screen and (min-width: 1200px) {
    .modal.left .modal-dialog, .modal.right .modal-dialog{width:559px}
    .modal.left.full .modal-dialog, .modal.right.full .modal-dialog{width:calc(100% - 78px)}
}

</style>

<style>
@media only screen and (min-width: 1200px) {
    .lead.master-menu
    {
        background-color:#F9F7ED;
        min-height: 100%;
        bottom: 0;
        top: 0;
        position: absolute;
        padding: 0 !important;
        /*-webkit-box-shadow: 8px 0px 17px -5px rgba(179,179,179,0.51);
        -moz-box-shadow: 8px 0px 17px -5px rgba(179,179,179,0.51);
        box-shadow: 8px 0px 17px -5px rgba(179,179,179,0.51);*/
    }
    .lead.master-menu .btn
    {
        width: 100%;
        border-radius: 0;
        height: 100px;
    }
    .lead.master-menu .btn i
    {
        font-size: 2rem !important;
    }

    .lead.master-page
    {
        min-height: 100%;
        bottom: 0;
        top: 0;
        right:0;
        position: absolute;
        padding: 10px !important;
    }
}
</style>

<!-- Delete Confirmation Button -->
<style>
    .dialog-ovelay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.50);
        z-index: 999999
    }
    .dialog-ovelay .dialog {
        width: 400px;
        margin: 100px auto 0;
        background-color: #fff;
        box-shadow: 0 0 20px rgba(0,0,0,.2);
        border-radius: 3px;
        overflow: hidden
    }
    .dialog-ovelay .dialog header {
        padding: 10px 8px;
        background-color: #f6f7f9;
        border-bottom: 1px solid #e5e5e5
    }
    .dialog-ovelay .dialog header h3 {
        font-size: 14px;
        margin: 0;
        color: #555;
        display: inline-block
    }
    .dialog-ovelay .dialog header .fa-close {
        float: right;
        color: #c4c5c7;
        cursor: pointer;
        transition: all .5s ease;
        padding: 0 2px;
        border-radius: 1px    
    }
    .dialog-ovelay .dialog header .fa-close:hover {
        color: #b9b9b9
    }
    .dialog-ovelay .dialog header .fa-close:active {
        box-shadow: 0 0 5px #673AB7;
        color: #a2a2a2
    }
    .dialog-ovelay .dialog .dialog-msg {
        padding: 12px 10px
    }
    .dialog-ovelay .dialog .dialog-msg p{
        margin: 0;
        font-size: 15px;
        color: #333
    }
    .dialog-ovelay .dialog footer {
        border-top: 1px solid #e5e5e5;
        padding: 8px 10px
    }
    .dialog-ovelay .dialog footer .controls {
        direction: rtl
    }
    .dialog-ovelay .dialog footer .controls .button {
        padding: 5px 15px;
        border-radius: 3px
    }
    .button {
      cursor: pointer
    }
    .button-default {
        background-color: rgb(248, 248, 248);
        border: 1px solid rgba(204, 204, 204, 0.5);
        color: #5D5D5D;
    }
    .button-danger {
        background-color: #f44336;
        border: 1px solid #d32f2f;
        color: #f5f5f5
    }
    .link {
      padding: 5px 10px;
      cursor: pointer
    }
</style>