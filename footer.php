<a href="https://api.whatsapp.com/send?phone=8816325" class="floating whatsapp">
	<i class="fab fa-whatsapp float-button"></i>
</a>
<footer class="footer">
	<div class="top">
		<div class="container">
			<div class="col-lg-12 row">
				<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
					<h6><?php echo t(30)[$l]; ?></h6>
					<ul>
						<li class="item">
							<a href="#"><?php echo t(31)[$l]; ?></a>
						</li>
						<li class="item">
							<a href="/about"><?php echo t(2)[$l]; ?></a>
						</li>
						<li class="item">
							<a href="#"><?php echo t(32)[$l]; ?></a>
						</li>
						<li class="item">
							<a href="/contact"><?php echo t(10)[$l]; ?></a>
						</li>
					</ul>
				</div>
				<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<h6><?php echo t(4)[$l]; ?></h6>
					<ul>
						<li class="item">
							<a href="/account?current=settings"><?php echo t(5)[$l]; ?></a>
						</li>
						<li class="item">
							<a href="/account?current=orders"><?php echo t(6)[$l]; ?></a>
						</li>
						<li class="item">
							<a href="/account?current=payments"><?php echo t(7)[$l]; ?></a>
						</li>
						<li class="item">
							<a href="/account?current=cart"><?php echo t(8)[$l]; ?></a>
						</li>
					</ul>
				</div>
				<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
					<h6><?php echo t(10)[$l]; ?></h6>
					<ul>
						<li class="item">
							<span href="#">
								<p style="font-weight: 600;">
									<i class="fas fa-map-marker-alt"></i> <?php echo site_info('address'); ?></p>
							</span>
						</li>
						<li class="item">
							<span href="#">
								<p style="font-weight: 400;">
								<i class="fas fa-phone"></i> <?php echo site_info('phone'); ?></p>
							</span>
						</li>
						<li class="item">
							<a href="mailto:<?php echo site_info('email'); ?>?subject=Feedback"   target="_blank">
								<p style="font-weight: 400;">
								<i class="far fa-envelope"></i> <?php echo site_info('email'); ?></p>
							</a>
						</li>
						<li class="item">
							<div class="d-flex flex-wrap justify-content-between px-1 container social">
								<a href="https://facebook.com/" target="_blank" style="color: #0a80ec;">
									<i class="fab fa-facebook"></i>
								</a>
								<a href="https://instagram.com/" target="_blank" style="color: #ff0077;">
									<i class="fab fa-instagram"></i>
								</a>
								<a href="https://twitter.com/" target="_blank" style="color: rgb(29 155 240);">
									<i class="fab fa-twitter"></i>
								</a>
								<a href="https://youtube.com/" target="_blank" style="color: rgb(255 0 0);">
									<i class="fab fa-youtube"></i>
								</a>
								<a href="mailto:<?php echo site_info('email'); ?>?subject=Feedback" target="_blank" style="color: rgb(200 200 200);">
									<i class="fas fa-at"></i>
								</a>
								<a href="https://www.linkedin.com/" target="_blank" style="color: #0077b5;">
									<i class="fab fa-linkedin"></i>
								</a>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="container d-flex flex-wrap justify-content-between mt-5">
			<div class="mb-2 mx-auto df4s5d4f5asf flex-wrap">
				<div class="text-center me-2">
					Download app from 
				</div>
				<div>
					<a href="#">
						<img style="object-fit: contain; width: 150px;" src="/cdn/apple-store.png">
					</a>
					<a href="#">
						<img style="object-fit: contain; width: 150px;" src="/cdn/play-store.png">
					</a>
				</div>
			</div>
			<div class="d-flex flex-wrap my-3 mx-auto">
				<img style="object-fit: contain; height: 30px; width: auto; margin-right: 4px;" src="/cdn/visa.jpg">
				<img style="object-fit: contain; height: 30px; width: auto; margin-right: 4px;" src="/cdn/mastercard.jpg">
				<img style="object-fit: contain; height: 30px; width: auto; margin-right: 4px;" src="/cdn/mastereo.jpg">
				<img style="object-fit: contain; height: 30px; width: auto; margin-right: 4px;" src="/cdn/paypal.jpg">
			</div>
		</div>
	</div>
	<div class="bottom">
		<div class="container">
			<div class="copyright">
				<?php echo t(33)[$l]; ?> <a href="/"><?php echo site_info('site_name'); ?></a> 2021 - <?php echo date("Y"); ?> . <!-- Powered by <a href="https://instagram.com/ProgrammerJibon">ProgrammerJibon</a> -->
			</div>
		</div>
	</div>
</footer>
<div class="contact_us_floating">
	<?php require_once 'contact-us.php'; ?>
</div>
<a  class="toTop" style="right: 80px;" onclick="document.querySelector('div.contact_us_floating').classList.toggle('show');this.querySelector('i.fas').classList.toggle('fa-times');this.querySelector('i.fas').classList.toggle('fa-envelope-open-text');  return false;">
	<i class="fas fa-envelope-open-text"></i>
</a>
<a onclick="topFunction()" class="toTop" rel="follow" target="_self">
  <i class="fas fa-angle-up"></i>
  <script type="text/javascript">

	uparrow = document.querySelectorAll("a.toTop");
	navbar = document.querySelector("nav.navbar.navbar-expand-lg.navbar-light.mg-auto");
	floatingWhatsapp = document.querySelector(".whatsapp.floating");
	uparrow.onclick = ()=>{topFunction()};
	window.onscroll = function() {scrollFunction()};

	function scrollFunction() {
	  if (document.body.scrollTop > 150 || document.documentElement.scrollTop > 150) {
	    uparrow.forEach(item=>{
	    	item.style.display = "block";
	    })
	    floatingWhatsapp.style.display = "block";
	    navbar.style.flexDirection = "row";
	    document.querySelector("div.sticky-top").style.boxShadow = "0 .5rem 1rem rgba(0,0,0,.15)";
	    document.querySelector(".mainHeader.sticky-top .container a.navbar-brand img").style.height = "60px";
	    // document.querySelector(".mainHeader.sticky-top .container a.navbar-brand img").style.width = "";
	    document.body.scrollTop = 0;
	  } else {
	    uparrow.forEach(item=>{
	    	item.style.display = "none";
	    })	    
	    navbar.style.flexDirection = "column";
			document.querySelector(".mainHeader.sticky-top .container a.navbar-brand img").style.height = "";
			// document.querySelector(".mainHeader.sticky-top .container a.navbar-brand img").style.width = "400px";
	  }
	}
	scrollFunction();
	function topFunction() {
	  document.body.scrollTop = 0;
	  document.documentElement.scrollTop = 0;
	}
  </script>
</a>
<div id="event_5"></div>
</body>
</html>