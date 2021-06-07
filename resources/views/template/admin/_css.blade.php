<style type="text/css">
    /* Root */
    :root{ 
        --primary: #1993E6;
        --primary-dark: #1993E6;
        --primary-light: #DEF0FB;
        --secondary-dark: #0061C1;
        --secondary-light: #D2E8FF;
        --border-light: rgba(2555,255,255,.5); 
        --shadow: 0 .125rem .25rem rgba(0,0,0,.075);
        --transition: .25s ease;
        --font-family-sans-serif: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans","Liberation Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji"!important;
        --red: #DC3545;
        --red-s: #FAE3E5;
        --green: #28A745;
        --green-s: #CBF2D4;
        --blue: #17A2B8;
        --blue-s: #D9F6FA;
    }

    /* Selection */
    ::selection {background-color: var(--primary-dark)!important;}
    ::-moz-selection {background-color: var(--primary-dark)!important;}

    /* Header */
    .app-nav .app-nav__item .badge {position: absolute; right: 0; bottom: 8px; font-size: 75%;}
    .app-header__logo {color: var(--primary-dark)!important; font-family: 'Lato'; text-transform: uppercase;}
    @media(min-width: 768px){
        .app-header__logo {background-color: var(--white)!important;}
    }
    @media (max-width: 767px){
        .app-header__logo {display: block}
        .app-header__logo img {vertical-align: sub;}
    }

    /* Sidebar */
    .app-sidebar{box-shadow: unset!important; background-color: var(--white); z-index: 1040;}
    .app-sidebar__toggle, .app-nav__item{color: var(--gray)!important; transition: var(--transition)!important;}
    .app-sidebar__toggle:focus, .app-sidebar__toggle:hover, .app-nav__item:hover, .app-nav__item:focus {background-color: transparent!important; color: var(--primary-dark)!important;}
    .app-nav__item {color: var(--gray)!important;}
    .app-menu {border-top: 1px solid transparent; margin: 0 .75em}
    .app-menu__item {padding: 8px 15px!important; color: var(--gray); border-radius: .5em; margin-bottom: .5em; border: 0!important;}
    .app-menu__item.active, .app-menu__item:hover, .app-menu__item:focus, .treeview.is-expanded [data-toggle='treeview'] {background: var(--primary-dark); color: var(--white); border-radius: .5em; box-shadow: var(--shadow);}
    .treeview-menu{background: var(--light); border-radius: .5em}
    .treeview-item{color: var(--gray)}
    .treeview-item.active, .treeview-item:hover, .treeview-item:focus{background: rgba(0,0,0,.2);}
    .treeview.is-expanded .treeview-menu {margin-bottom: .5rem;}
    .treeview-item .icon {margin-right: 10px;}
    @media (min-width: 768px){
        .sidebar-mini.sidenav-closed .treeview:hover .app-menu__item {background: var(--primary-dark); color: var(--white);}
        .sidebar-mini.sidenav-closed .app-menu__item:hover{border-radius: .5em 0 0 .5em;}
        .sidebar-mini.sidenav-closed .treeview-item:hover .app-menu__item{border-radius: .5em 0 0 .5em!important;}
        .sidebar-mini.sidenav-closed .app-menu__label {background-color: var(--primary-dark); color: var(--white); border-radius: 0 .5em .5em 0!important; padding: 8px 15px!important;}
        .sidebar-mini.sidenav-closed .app-sidebar{width: 72px;}
        .sidebar-mini.sidenav-closed .app-content{margin-left: 72px;}
        .sidebar-mini.sidenav-closed .app-sidebar__user-avatar{width: 52px; height: 52px;}
        .sidebar-mini.sidenav-closed .treeview-menu{margin: -7px 0.75em 0.75em; background: var(--white); box-shadow: var(--shadow); border-radius: .5em;}
        .sidebar-mini.sidenav-closed .treeview-menu .treeview-item{color: var(--gray);}
    }

    /* Content */
    /*.app-content{background-color: var(--light)!important;}*/

    /* Breadcrumb */
    .app-title {margin-top: 0em; margin-right: 0em; margin-left: 0em; border-radius: .5em;}
    .app-title {padding: 20px;}

    /* Button */
    .btn-primary, .btn-theme-1 {background-color: var(--primary-light)!important; border-color: var(--primary-light)!important; color: var(--primary-dark)!important;}
    .btn-primary:hover, .btn-theme-1:hover {background-color: var(--primary-dark)!important; border-color: var(--primary-dark)!important; color: var(--primary-light)!important;}
    .btn-secondary {background-color: var(--secondary-light)!important; border-color: var(--secondary-light)!important; color: var(--secondary-dark)!important;}
    .btn-secondary:hover {background-color: var(--secondary-dark)!important; border-color: var(--secondary-dark)!important; color: var(--secondary-light)!important;}
    .btn-outline-primary {color: var(--primary-dark); background-color: transparent; background-image: none; border-color: var(--primary-dark);}
    .btn-outline-primary:hover {color: #FFF; background-color: var(--primary-dark); border-color: var(--primary-dark);}
    .btn-outline-primary:not(:disabled):not(.disabled):active, .btn-outline-primary:not(:disabled):not(.disabled).active, .show > .btn-outline-primary.dropdown-toggle {color: #FFF; background-color: var(--primary-dark); border-color: var(--primary-dark);}
    .btn .icon, .btn .fa {margin-right: 0; width: 14px;}

    /* Text */
    .text-primary {color: var(--primary-dark)!important;}

    /* Background */
    .bg-primary {background-color: var(--primary-dark)!important; color: var(--white)!important;}
    a.bg-primary:hover, a.bg-primary:focus, button.bg-primary:hover, button.bg-primary:focus {background-color: var(--primary-dark)!important;}

    /* Badge */
    .badge {font-size: 87.5%;}

    /* Table */
    #dataTable td {padding: .5rem;}
    #dataTable thead tr th {text-align: center; vertical-align: middle;}
    #dataTable tbody tr td:first-child, #dataTable tbody tr td:last-child {text-align: center;}
    #dataTable td .btn-group a.btn:first-child {border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;}
    #dataTable td .btn-group a.btn:last-child {border-top-right-radius: .25rem; border-bottom-right-radius: .25rem;}
    #dataTable td a.btn {width: 36px;}
    div.dataTables_wrapper div.dataTables_processing {background-color: #eeeeee;}
    .table-stretch tr th, .table-stretch tr td {padding: .25rem;}

    /* Anchor */
    a {color: var(--primary-dark);}
    a:hover {color: var(--primary-dark);}

    /* Form */
    .form-control:focus {border-color: var(--primary-dark)!important;}
    .animated-checkbox input[type="checkbox"]:checked + .label-text:before {color: var(--primary-dark)!important;}

    /* Pagination */
    .page-link {color: var(--primary-dark)!important;}
    .page-link:hover {color: var(--primary-dark);}
    .page-item.active .page-link {background-color: var(--primary-light)!important; border-color: var(--primary-light)!important; color: var(--primary-dark)!important;}
    .page-item.disabled .page-link {border-color: var(--primary-light)!important}

    /* List Group */
    .list-group-item.active {background-color: var(--primary-dark); border-color: var(--primary-dark);}

    /* Nav Pills */
    .nav-pills .nav-link.active, .nav-pills .show > .nav-link {background-color: var(--primary-dark)!important;}

    /* Image Overlay */
    .image-overlay {cursor: pointer; position: absolute; top: 0; bottom: 0; left: 0; right: 0; height: 100%; width: 100%; opacity: 0; transition: .5s ease; background-color: rgba(0,0,0,.6); border-radius: 50%;}
    .image-overlay span {color: white; position: absolute; top: 50%; left: 50%; -webkit-transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%); transform: translate(-50%, -50%); text-align: center; font-weight: bold;}
    .image-overlay:hover {opacity: 1;}

    /* Modal Image */
    #modal-image .modal-body {height: 80vh; overflow-y: auto;}
    .dropzone-wrapper {height: 150px; border: 2px dashed var(--primary-dark);}
    .dropzone-wrapper:hover {background-color: #e5e5e5; transition: .3s ease-in;}
    .dropzone-desc {text-align: center; font-weight: bold;}
    .dropzone, .dropzone:focus {position: absolute; width: 100%; height: 150px; outline: none!important; cursor: pointer; opacity: 0;}
    .btn-choose-image {cursor: pointer; opacity: .7;}
    .btn-choose-image:hover {opacity: 1; transition: .3s ease-in;}

    /* Modal Croppie */
    #modal-croppie .modal-dialog {max-width: 100%; margin-left: 1rem; margin-right: 1rem;}
    #modal-croppie .modal-body .table-responsive {max-height: calc(100vh - 250px); overflow-y: auto;}

    /* Modal Terminal, Modal Update Me, Modal Visitor */
    #modal-terminal .modal-body, #modal-update-me .modal-body, #modal-visitor .modal-body {max-height: 80vh; overflow-y: auto;}

    /* Quill Editor */
    #editor {height: 300px;}
    .ql-button-html:after {content: "<>";}
    .ql-editor {white-space: normal!important;}
	.ql-editor h1, .ql-editor h2, .ql-editor h3, .ql-editor h4, .ql-editor h5, .ql-editor h6, .ql-editor p {margin-bottom: 1rem!important;}
    .ql-snow .ql-toolbar button, .ql-snow.ql-toolbar button.ql-button-html {width: 30px;}

    /* Modal Quill Code */
    #modal-quill-code .modal-dialog {max-width: 100%; margin-left: 1rem; margin-right: 1rem;}
    #modal-quill-code .modal-dialog .modal-content {height: calc(100vh - 56px); max-height: auto!important;}

    /* Bootstrap Tagsinput */
    .bootstrap-tagsinput {width: 100%!important;}
    .bootstrap-tagsinput .tag {padding: 1px 2px; border-radius: 4px; background-color: var(--primary-dark)!important;}
    .tt-menu {background-color: #fff!important; width: 100%; box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15)!important; -webkit-box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15)!important}
    .tt-suggestion {padding: .5rem; cursor: pointer;}
    .tt-suggestion:hover {background-color: #e5e5e5;}

    /* Sortable */
    .sortable .sortable-item {cursor: move!important;}
    .sortable .sortable-item.card {border: 1px solid #bebebe!important;}

    /* Progress Bar */
    .progress-bar {background-color: var(--primary-dark)!important;}

    /* Others */
    .tile, .widget-small, .dropdown-menu, .tile-topik, .card, .app-title {box-shadow: var(--shadow)!important;}
    .material-half-bg .cover {background-color: var(--primary-dark)!important;}
    .widget-small.primary.coloured-icon .icon {background-color: var(--primary-dark)!important;}
    .dropdown-item.active, .dropdown-item:active {background-color: var(--primary-dark)!important;}
    .login-content .login-box {min-height: 430px;}
    .app-menu__submenu {margin-top: 2rem; padding: 8px 15px;}
    .app-menu__submenu .app-menu__label {color: #fff; font-size: 1rem; font-weight: bold; text-transform: uppercase;}
    .tab-content {border-top: 1px solid var(--primary-dark);}
    .separator {width: 100%; margin: 1rem; border-top: 1px solid #ddd;}
    .cr-boundary {border: 3px dashed #bebebe;}


    body{color: var(--dark)!important; background-color: var(--light)}
    .rounded-1{border-radius: .5em!important}
    .rounded-2{border-radius: 1em!important}
    .rounded-3{border-radius: 1.5em!important}
    .rounded-4{border-radius: 2em!important}
    .shadow-sm{box-shadow: var(--shadow)}
    .text-decoration-none{text-decoration: none!important}
    .widget-small .icon{border-radius: .25em}
    .tile, .dropdown-menu, .widget-small, .app-header, .card{border-radius: .5em}
    .app-sidebar__user{color: var(--gray)}
    .app-sidebar__user-avatar{transition: var(--transition)}
    .card, .tile-topik{border: unset!important}


    .app-header{padding: 30px 30px 0px 30px; position: static; background-color: transparent!important; box-shadow: none;}
    .app-header.nav-sticky{padding: 10px 30px 10px 30px; position: sticky; top: 0; transition: var(--transition); background-color: var(--white)!important; box-shadow: var(--shadow); animation: topBottom var(--transition)}
    .app-header.nav-sticky .dropdown{transform: translate();}
    .app-sidebar{padding-top: 0px; box-shadow: var(--shadow)!important}
    .app-content{min-height: unset; margin-top: unset; padding: 30px; background-color: unset; -webkit-transition: unset; -o-transition: unset; transition: }
    @media (min-width: 768px) {.app-content {margin-left: unset}}
    @media (max-width: 768px) {.app-content {margin-top: unset;min-width: unset}}
    @media (max-width: 480px) {.app-content {padding: unset}}
    @media print {.app-content { margin: unset; padding: unset; background-color: unset}}

    /*.a-app-content{min-height: calc(100vh - 50px); margin-top: 50px; padding: 30px; -webkit-transition: margin-left 0.3s ease; -o-transition: margin-left 0.3s ease; transition: margin-left 0.3s ease; min-height: unset!important; padding-bottom: unset!important; margin-top: 0px; margin-left: 230px}*/
    .a-app-content{min-height: calc(100vh - 50px); margin-top: 50px; -webkit-transition: margin-left 0.3s ease; -o-transition: margin-left 0.3s ease; transition: margin-left 0.3s ease; min-height: unset!important; padding-bottom: unset!important; margin-top: 0px; margin-left: 230px}
    .b-app-content{min-height: unset!important; padding-bottom: unset!important; margin-top: 1em; margin-bottom: 1em;}
    .app-content {min-height: calc(100vh - 129px);}

    a.fab:hover{text-decoration: none;}
    a.fab i{transition: var(--transition)}
    @keyframes fab{
        0% {transform: scale(1);}
        25% {transform: scale(1);}
        50% {transform: scale(.9);}
        75% {transform: scale(1);}
        100% {transform: scale(1);}
    }
    @keyframes topBottom{
        0% {top: -100px}
        50% {top: -50px}
        100% {top: 0px}
    }
    @keyframes bottomTop{
        0% {bottom: 4.5em}
        50% {bottom: 5em}
    }    
    @keyframes pulse-red {
        0% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(255, 82, 82, 0.7);
        }
        
        70% {
            transform: scale(1);
            box-shadow: 0 0 0 10px rgba(255, 82, 82, 0);
        }
        
        100% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(255, 82, 82, 0);
        }
    }
    @keyframes grow {
      0% {
        display: none;
        opacity: 0;
      }
      1% {
        display: block;
        opacity: 0;
      }
      100% {
        opacity: 1;
      }
    }
    .blob {
    position: absolute;
    border-radius: 50%;
    height: 18px;
    width: 18px;
    transform: scale(1);
    animation: pulse-red 2s infinite;}
    .a-app_logo{display: block; width: 160px}
    .b-app_logo{display: none; width: 37px}
    .wrap-b-app_logo{display: none;}
    .sidenav-closed .a-app_logo{display: none;}
    .sidenav-closed .b-app_logo{display: block;}
    .sidenav-closed .wrap-b-app_logo{display: block; transition: var(--transition)}
    /*.sidenav-closed .wrap-b-app_logo:hover img{display: block; filter: brightness(0) invert(1);}*/
    .sidenav-closed .app-menu__item{text-align: center; justify-content: center;}
    .sidenav-closed .app-menu-title{text-align: center;}
    .sidebar-mini.sidenav-closed .a-app-content {margin-left: 72px;}
    /*.app-title {display: none;}*/
    .app-breadcrumb{margin-top: 0!important}
    .dropdown-menu{width: fit-content; min-width: 20rem; animation: grow var(--transition);}
    .dropdown-menu .card{border: 0; box-shadow: var(--shadow)}
    .dropdown-item{padding: 0; white-space: normal; text-align: center; width: 100%; padding-top: 1em; padding-bottom: 1em}
    .dropdown-item:active, .dropdown-item:focus,  .dropdown-item:hover{color: var(--primary-dark)!important; background-color: transparent!important;}
    .menu-btn-red{background-color: var(--red-s)!important; color: var(--red)!important; border-radius: 1em}
    .menu-btn-red:hover, .menu-btn-red:focus{background-color: var(--red)!important; color: var(--white)!important}
    .menu-btn-green{background-color: var(--green-s)!important; color: var(--green)!important; border-radius: 1em}
    .menu-btn-green:hover, .menu-btn-green:focus{background-color: var(--green)!important; color: var(--white)!important}
    .menu-btn-primary{background-color: var(--primary-light)!important; color: var(--primary-dark)!important; border-radius: 1em}
    .menu-btn-primary:hover, .menu-btn-primary:focus{background-color: var(--primary-dark)!important; color: var(--white)!important}
    .menu-btn-blue{background-color: var(--blue-s)!important; color: var(--blue)!important; border-radius: 1em}
    .menu-btn-blue:hover, .menu-bg-blue:focus{background-color: var(--blue)!important; color: var(--white)!important}
    .menu-bg-red{background-color: var(--red-s)!important; color: var(--red)!important; transition: var(--transition)}
    .menu-bg-red:hover, .menu-bg-red:focus{background-color: var(--red)!important; color: var(--white)!important}
    .menu-bg-green{background-color: var(--green-s)!important; color: var(--green)!important; transition: var(--transition)}
    .menu-bg-green:hover, .menu-bg-green:focus{background-color: var(--green)!important; color: var(--white)!important}
    .menu-bg-primary{background-color: var(--primary-light)!important; color: var(--primary-dark)!important; transition: var(--transition)}
    .menu-bg-primary:hover, .menu-bg-primary:focus{background-color: var(--primary-dark)!important; color: var(--white)!important}
    .menu-bg-blue{background-color: var(--blue-s)!important; color: var(--blue)!important; transition: var(--transition)}
    .menu-bg-blue:hover, .menu-bg-blue:focus{background-color: var(--blue)!important; color: var(--white)!important}
    .btn:not([disabled]):not(.disabled):not(.btn-link):hover, .btn:not([disabled]):not(.disabled):not(.btn-link):focus{transform: unset; box-shadow: unset;}
    .menu-grid .card:hover .media-body{border-left: 1px solid rgba(255,255,255,.7)!important;}
    .modal-dialog-full{max-width: 100%!important; height: 100%; padding: 0; margin: 0;}
    .modal-content-full {height: 100%; min-height: 100%; height: auto; border-radius: 0;}
    .modal-body a{color: var(--gray);}
    .modal-body a:hover{color: var(--primary-dark); text-decoration: none;}
    @media (max-width: 480px) {
        .app-content {padding: 15px;}
    }
    @media (max-width: 767.98px) {
        .app-header{padding: 15px 15px 0px 15px}
        .app-header.nav-sticky{padding: 15px 15px 15px 15px}
        .menu-grid .media-body{border-left: unset!important}    
        .dropdown{position: static;}
        .dropdown-menu{width: 100%}
    
    }
    @media (max-width: 991.98px) {
        .sidebar-mini.sidenav-closed .app-content{margin-left: unset}
        .a-app-content {margin-top: unset;min-width: 100%;}
        .app-sidebar{width: 100%}
        .app.sidebar-mini.pace-done{overflow-y: hidden;}
        .app.sidebar-mini.pace-done.sidenav-closed{overflow-y: scroll;}
        .app.sidenav-closed .app-sidebar {left: -100%;}
        .sidebar-mini.sidenav-closed .a-app-content {margin-left: 0px;}
        .a-app-content {margin-left: 0px}
    }
    @media (min-width: 768px) {
        .sidebar-mini.sidenav-closed .app-content{margin-left: 0}
    }
    @media print {
        .a-app-content { margin: 0; padding: 0; background-color: #fff;}
    }
	
	/* AOL */
	#dataTable td {padding: .25rem .5rem;}
	#dataTable td a.btn {width: auto!important;}
</style>