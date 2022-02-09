<?php header("content-type: text/css"); ?>
/*<style type="text/css">/**/


body{
	/*background: #212529;*/
	margin: 0;
	padding: 0;
	min-height: 100vh;
	font-family: sans-serif;
	font-size: 14px;
	user-select: none;
	max-width: calc(100vw - 10px);
	padding-top: 255px;
	background: radial-gradient(#f8bba6, #ffe6de);
	background-attachment: fixed;
}
select:hover{
	background: white !important;
	color: red !important;
}
select{
	text-align: left !important;
}
select:focus{
	box-shadow: none !important;
}
input:hover{
	background: white !important;
	color: red !important;
}
input{
	text-align: left !important;
}
input:focus{
	box-shadow: none !important;
}
textarea:hover{
	background: white !important;
	color: red !important;
}
textarea{
	text-align: left !important;
}
textarea:focus{
	box-shadow: none !important;
}
::-webkit-scrollbar {
  width: 10px;
  cursor: pointer;
}::-webkit-scrollbar-track {
  background: #f1f1f1;
}::-webkit-scrollbar-thumb {
  background: #d0d0d0;
}::-webkit-scrollbar-thumb:hover {
  background: #555;
}
input {
	outline: none;
	border-color: solid lightgray;
	font-size: 12px;
	padding: 4px 8px;
}
#homeBanner{
	max-width: calc(100vw - 10px);
    height: calc((100vw - 10px)/4);
}
*{
	font-family: Raleway,sans-serif;
	user-select:  none;
	pointer-events: auto;
	transition: all 0.15s ease-in-out;
}

img{
	height: 100%;
	width: 100%;
	object-fit: cover;
}
.loader {
	background: white;height: 1px;width: 100%;max-width: 100vw;
	transition: all 1s ease-in-out;
}
.loader .loaded{
	width: 0%;height: 100%;background: #2ca96c;
	transition: all 1s ease-in-out;
}



.floating .float-button{
	color:#FFF !important;
	font-size: 30px;
}
.floating{
	position:fixed;
	width: 60px;
	height: 60px;
	bottom:10%;
	left:40px;
	background:#25d366;
	border-radius:50%;
	text-align:center;
	box-shadow: 2px 2px 3px #999;
	z-index:100;
}

.float-button{
	margin-top:16px;
}




/* error style */
.server_returns_error{
	max-width: 100vw;
	height: calc(100vh - 85px);
	display: block;
	pointer-events: none;
	cursor: not-allowed;
	overflow: hidden;
	position: relative;
	z-index: -1;
}
.server_returns_error .error_block{
	position: absolute;
	top:  40%;
	left: 50%;
	transform: translate(-50%, -50%);
	display: inline-block;
	backdrop-filter: blur(10px);
	border-radius: 10px;
	padding: 30px;
	background: rgb(255 255 255 / 20%);
	margin: 16px;
}
.server_returns_error .error_block span{
	display: block;
	text-align: center;
}
.server_returns_error .error_block .error_code{
	font-size: 150px;
  	font-family: fantasy;
}
.server_returns_error .error_block .error_code:after{
	content: '!';
}
.server_returns_error .error_block .error_desc{
	font-family: cursive;
  font-weight: bold;
  font-size: 30px;
}




.icon{
	font-family: 'Font Awesome 5 Free',"Font Awesome 5 Brands", sans-serif;
	font-weight: bolder;
	display: inline-block;
}
.icon.next:before {
	content: "\f054";
}
.icon.prev:before {
	content: "\f053";
}
.gallery-preview-panel {
    position: relative;
    overflow: hidden;
    text-align: center;
    margin: 16px 4px;
}

#productView.pdp-block__main-information {
    background: #fff;
    padding-bottom: 16px;
}
.pdp-block__gallery {
    display: inline-block;
    vertical-align: top;
}
hr{
	border-top: 0px solid transparent;
	border-bottom: 1px solid #a9a9a9 !important;
}
.add-to-cart-btn:hover{
	box-shadow: 5px 6px 0px 0px #2abbe8, 5px 5px 19px 0px grey;
	transform: scale(1.1);
}
.order-now-btn:hover{
	box-shadow: 5px 6px 0px 0px orange, 5px 5px 19px 0px grey;
	transform: scale(1.1);
}
.add-to-cart-btn {
	border: 1px solid transparent;
    background: orange !important;
    color: white !important;
    border-radius: 0 !important;
}
.order-now-btn {
	border: 1px solid transparent;
    background: #2abbe8 !important;
    color: white !important;
    border-radius: 0 !important;
}
.pdp-block {
    margin: auto;
    padding-left: 0!important;
    padding-right: 0!important;
    overflow: hidden;
}

.slider:hover{
	box-shadow: 2px 2px 10px -5px grey;
}
.slider {
	box-shadow: 0px 0px 10px 0px transparent;
	width: 100%;
	height: 100%;
	overflow: hidden;
	position: relative;
	transition: all 0.3s;
}
.slider .images {
	width: 100%;
    height: 100%;
    display: flex;
    flex-direction: row;
    flex-wrap: nowrap;
    align-items: center;
}
.slider .images .image {
	height: 100%;
	min-width: 100%;
	position: relative;
	background-repeat: no-repeat;
	background-size: cover;
	background-position: center;
}
.full_screen_view img{
	height: 100vh;
	width: 100vw;
	object-fit: contain;
	padding: 5vh 5vw;
}

.slider .images .image .over_button:after{
	content: "";
	color: #ff0025;
	background: transparent;
	font-size: 20px;
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
}
.slider .images .image .over_button{
	position: absolute;
    top: 10px;
    height: 40px;
    width: 40px;
    right: 10px;
    cursor: pointer;
    font-size: 0px;
    border-radius: 50%;/*
    box-shadow: 0 0 20px 4px #00000059;*/
    backdrop-filter: blur(1px);
}
.full_screen_view{
	position: fixed;
    height: 0vh;
    width: 0vw;
    background: #000000c4;
    z-index: 999999;
    top: 0;
    left: 0;
    cursor: zoom-out;
    transition: all 0.5s ease-in-out;
    overflow-x: hidden;
    overflow-y: scroll;
}
/*.full_screen_view:after {
    content: "X";
    color: white;
    position: fixed;
    right: 4%;
    top: 5%;
    display: inline-flex;
    width: 35px;
    height: 35px;
    font-family: cursive;
    border-radius: 50%;
    border: 1px solid;
    background: transparent;
    font-size: 20px;
    align-content: center;
    justify-content: center;
    align-items: center;
    cursor: pointer;
}*/
.slider .images .image img{
	width: 100%;
	height: 100%;
	pointer-events: none;
	object-fit: cover;
	backdrop-filter:  blur(50px);
}

.slider .dots {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    width: 100%;
    display: flex;
    flex-wrap: nowrap;
    flex-direction: row;
    margin: 0 auto;
    justify-content: center;
    opacity: 1;
}
.slider .dots .dotX:hover .dot{
	transform: scale(1.5);
	box-shadow: 0px 0px 0px 0px #ff00b1, 0px 0px 4px 1px #ff00b1, 0px 0px 8px 2px #ff00b1, 0px 0px 20px 4px #ff00b1;
}
.slider .dots .dotX {
    cursor: pointer;
    padding: 16px;
}
.slider .dots .dot{
	height: 8px;
	width: 8px;
	overflow: hidden;
	border-radius: 50%;
	cursor: pointer;
	margin: 0 auto;
	background: white;
	border: 1px #ff00b1;
}
.slider .buttons {
	width: 0px;
	height: 0px;
	opacity: 0;
}
.slider:hover .buttons, .slider:hover .dots{
	opacity: 1;
}
.slider .prev{
	background: linear-gradient(90deg, #0000004d, transparent);
	left: 0;
}
.slider .next{
	background: linear-gradient(270deg, #0000004d, transparent);
	right: 0;
}
.slider:hover .prev, .slider:hover .next {
    cursor: pointer;
    font-size: 32px;
    padding: 0 20px;
    position: absolute;
    top: 0;
    bottom: 0;
}
.slider .buttons .prev, .slider .buttons .next {
    transition: all 0.3s ease-in-out;
    color: white;
    height: 100%;
    text-align: center;
    display: grid;
    align-items: center;
    position: absolute;
}







.contentX tr{
	font-size: 13px;
	font-family: sans-serif;
}
a{
	display: inline-block;
	cursor: pointer;
}

.nav-item .nav-link{
	color:  #1e1e1e;
	font-weight: 400;
	font-size: 17px;
	padding-bottom: 0;
}
.nav-item .nav-link.current{
	color: rgb(118 189 66);
}
.mainHeader .navbar .navbar-brand{
	width: auto;
	height: auto;
}
.mainHeader.sticky-top{
	position: fixed !important;
	top: 0;
	left: 0;
	right: 0;
}
.mainHeader.sticky-top .container a.navbar-brand img {
    /*width: 320px;*/
    height: 120px;
    padding: 8px 0;
    object-fit: contain;
}
.mainHeader.sticky-top .container nav a.nav-link{
	color: white;
	padding-top: 8px;
	padding-bottom: 8px;
}
.mainHeader.sticky-top .container nav{
	width: 100%;
	padding: 20px 0px;
	transition: padding 0.1s;
}
.mainHeader.sticky-top .container{
	display: flex;
    width: 100%;
    align-content: center;
    justify-content: center;
    align-items: center;
}
.mainHeader.sticky-top{
	background: #950318;
}
nav.navbar{
	padding-top: 0px;
	padding-bottom: 0px;
}

*[role="button"]:hover *{
	color: rgb(118 189 66);
}

ul {
    list-style: none;
    padding-left: 0;
    padding-right: 0;
}
.toTop{
    position: fixed;
    bottom: 10%;
    right: 40px;
    z-index: 99;
    cursor: pointer;
    background: white;
    border: 1px solid rgb(249 193 166);
    padding: 10px;
    border-radius: 50%;
    text-align: center;
    display: none;
    color: rgb(249 193 166);
    width: 40px;
    height: 40px;
}

.footer li {
	padding: 3px 0;
}
.footer li a{
	color: #a8a8a8;
	text-decoration: none;
	font-size: 14px;
}
.footer li p{
	color: #a8a8a8;
	text-decoration: none;
	font-size: 14px;
}
.footer a:hover{
	color: rgb(249, 193, 166);
	text-decoration: underline;
}
.footer .bottom a:hover{
	color: rgb(249, 193, 166);
	text-decoration: underline;
}
.footer h6{
	margin: 0 0px 8px 0px;
}
.footer .top ul{
	margin-bottom: 0;
}
.footer .bottom a{
	color: #ff008d;
	text-decoration: none;
}
.footer .bottom .copyright{
	padding: 16px 0;
	font-size: 11px;
	letter-spacing: 1px;
	font-family: sans-serif;
	text-align: center;
}
.footer .bottom{
	background: #1e1e1e;
	color: white;
}
.footer .top{
	width: 100%;
	height: 100%;
	background: url("/cdn/13.jpg");
	color: white;
	padding: 32px 0;
	background-attachment: fixed;
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
}
.form-row label{
	min-width: 33.333334%;
}

.form-row select{
	min-width: 66.6666667%;
}
.dropdown-menu{
	position: absolute !important;
	overflow-y: scroll;
	overflow-x: hidden;
	max-height: 500px;
}
.lowHead_wishlist{
	font-size: 12px; padding-left: 4px; color: white;
	display: none;
}
@media (max-width: 992px){

	.mainHeader.sticky-top .container a.navbar-brand img{
		/*width: 320px !important;*/
		height: 120px !important;
		padding-left: 16px;
	}
	.search-lkjsadf{
		width: 100%;
	}
	nav.navbar.navbar-expand-lg.navbar-light.mg-auto{
		flex-direction: row !important;
	}
	body{
		padding-top: 210px;
	}
}
@media (max-width: 768px){
	.slider .buttons{
		display: none;
	}
	.lowHead_wishlist{
		display: inline-block;
	}
	/*#homeBanner{
		max-width: 100%;
	    height: 100px;
	}*/
	.product-grid.mx-3{
		margin-right: 8px !important;
    	margin-left: 8px !important;
	}
	.product-grid{
		width: 40%;
	}
}
@media (max-width: 575px){
	.admin-panelX.row{
	}
	.sidebar.sticky-top{
		position: relative !important;
		top: 0px !important;
	}
	.navbar-dark.navbar-toggler{
		max-width: 20%;
		padding: 0.5%;
	}
	.navbar-brand{
		max-width: 69%;
	}
	.navbar-brand img{
		max-width: 100%;
	}
}
pre{
	user-select: text;
}
.product_admin_heading *{
	display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.notification {
    cursor: zoom-out;
    user-select: none;
    backdrop-filter: blur(10px);
    color: gray;
    padding: 0px 0px;
    height: 0px;
    border-radius: 300px;
    font-family: cursive;
    letter-spacing: 1px;
    font-size: 0px;
    border: 1px solid;
    margin-bottom: 0px;
    opacity: 0;
    margin-bottom: 0px;
    overflow: hidden;
    font-weight: lighter;
    background: rgba(0, 0, 0, 0.5);
}

#event_5 {
    user-select: none;
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: fit-content;
    transition: all 0.3s ease-in-out;
    z-index: 999999999;
}



.neon_light {
    font-size: 50px;
    font-family: /*"Vibur",*/ cursive;
    color: #fff;
    text-shadow: 0 0 7px #fff, 0 0 10px #fff, 0 0 21px #fff, 0 0 42px #fba500, 0 0 82px #fba500, 0 0 92px #fba500, 0 0 102px #fba500, 0 0 151px #fba500;
}
.sidebar {
	width: 200px;
	position: relative;
	height: 100%;
	overflow: auto;
	top: 100px !important;
	z-index: 1;
	background: #666666;
	min-height: calc(100vh - 100px);
}

.sidebar button{
	padding: 16px 0;
}
.sidebar a {
    display: block;
    padding: 16px 8px;
    text-decoration: none;
    color: white;
    border-bottom: 1px solid #727272;
    font-size: 13px;
}
 
.sidebar a.active {
  color: lime;
}

.sidebar a:hover:not(.active) {
  color: limegreen;
}

div.contentX {
  padding: 1px 16px;
}


.ratings, .ratings span{
	color: orange;
	font-size: 12px;
	font-family: sans-serif;
}






.product-grid:hover *{
	color: #ff0025 !important;
}
.product-grid:hover{
	box-shadow: 5px 5px 15px -5px #000000bf;
	background: #ffddd2;
}
.product-grid{
	border: 1px solid #ffb39a;
	font-size: 13px;
	height: max-content;
	cursor: pointer;
	background: #ffeee8;
	position: relative;
	overflow: hidden;/*
	min-height: 400px;*/
}
.product-grid:hover .product_floating_desc{
	bottom: -3%;
	margin-bottom: 1%;
	top: 0%;
	opacity: 1;
	font-size: unset;
}
.product-grid .product_floating_desc{
	opacity: 0;
    padding: 8px;
    position: absolute;
    left: 0;
    bottom: -100%;
    top: 200%;
    right: 0;
    background: #00000087;
    backdrop-filter: blur(3px);
    border-top: 1px solid #ffb39a;
    color: white !important;
    line-break: normal;
    /*font-family: sans-serif;*/
    font-weight: lighter;
    transition: all 0.3s ease-in-out;
    font-size: 0px;
}
.product-grid .product-details{
	position: relative;
}
.product-grid .product-image img{
	object-fit: contain;
}
.product-grid .product-image{
	width: 100%;
	height: 100%;
	overflow: hidden;
	position: relative;
}



.product-image-slider .slider .images .image img{
	object-fit: contain;
}

.contact_us_floating form.p-5{
	padding: 16px !important;
}
.contact_us_floating form{
	margin: 0px !important;
}
.contact_us_floating.show:before{
	top: 0%;
}
.contact_us_floating.show{
	bottom: 10%;
}
.contact_us_floating:before {
    content: "";
    position: fixed;
    top: 100%;
    bottom: 0;
    left: 0;
    right: 0;
    background: #0000006b;
    backdrop-filter: blur(5px);
}
.contact_us_floating{
	position: fixed;
	z-index: 10;
	bottom: -200%;
	right: 120px;
	transition: all 1 ease-in-out;
}

.social a{
	margin-left: 4px; 
	font-size: 20px !important;
}
.social a:hover i{
	transform: scale(1.5) rotateZ(355deg);
}

.df4s5d4f5asf {
    display: flex;
    flex-direction: row;
    align-content: center;
    justify-content: space-evenly;
    align-items: center;
}