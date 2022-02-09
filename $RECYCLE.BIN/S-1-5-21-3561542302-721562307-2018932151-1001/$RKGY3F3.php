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
							<a href="/about"><?php echo t(10)[$l]; ?></a>
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
					</ul>
				</div>
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

<a onclick="topFunction()" class="toTop" rel="follow" target="_self">
  <i class="fas fa-angle-up"></i>
  <script type="text/javascript">

	uparrow = document.querySelector("a.toTop");
	uparrow.onclick = ()=>{topFunction()}
	window.onscroll = function() {scrollFunction()};

	function scrollFunction() {
	  if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
	    uparrow.style.display = "block";
	    document.querySelector("div.sticky-top").style.boxShadow = "0 .5rem 1rem rgba(0,0,0,.15)";
	    document.querySelector(".mainHeader.sticky-top .container a.navbar-brand img").style.height = "60px";
	    document.body.scrollTop = 0;
	  } else {
	    uparrow.style.display = "none";
			document.querySelector(".mainHeader.sticky-top .container a.navbar-brand img").style.height = "";
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