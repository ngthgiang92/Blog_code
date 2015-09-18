<?php $this->load->view('blog/header');?>
<body>

	<!-- header top starts-->
	<?php $this->load->view('blog/menu_top');?>
	<!-- header top ends here -->
	
	<!-- content starts -->
	<div id="content-outer" class="clear"><div id="content-wrapper">
	
		<!-- column-one -->
		<div id="content"><div class="col-one">
				
			<h2><a href="index.html">About Me</a></h2>
				<p>
					<a href="http://www.hdwebsoft.com/" class="twitter-follow-button" data-show-count="true">DHWedsoft-Giang</a>
				</p>
            <p>Thanks for viewing my tutorial! Happy coding!</p>
			
		</div></div>
		
		<!-- column-two -->
		<?php $this->load->view('blog/menu_sidebar');?>
		
		<!-- column-three -->
		<div class="col-three">
			
			<h3 style="color:#0c7a00;">Tâm tư</h3>
			<p>&quot;Nếu chúng ta biết chúng ta là ai, chúng tôi sẽ không cố gắng để trở thành một người nào khác để có
giá trị và ý nghĩa trong cuộc sống của chúng tôi. Nếu chúng ta không biết chúng ta là ai, chúng tôi sẽ cố gắng
trở thành một người người khác muốn chúng ta phải.&quot; </p>
			
			<h3 style="color:#0c7a00;">Đóng góp</h3>
			<p>Hảy cùng với chúng tôi để chung tay đóng góp và xây dựng ngày một phát triền hơn 
			<a href="https://www.facebook.com/thanh.giang.270792">Contact me</a> Tên blog cá nhân của tôi chắc chắn sẻ xây dựng ngày một hoàn thiện hơn.</p>	
			
			<h3 style="color:#0c7a00;">Bí kíp võ công</h3>
			
			<p>
		Có 1 anh chàng một hôm đang đi nhặt lá đá ống bơ thì nhặt được 1 quyển bí kíp.
Nghi là võ học thượng thừa nên anh ta giấu mang về nhà đọc.
Trang 1 : Miêu tả về võ công. Có thể hô mưa gọi gió. Độc bộ thiên hạ. Đưa người ta lên đỉnh cao của võ học.
Trang 2 : Cần phải tự cung mới có thể luyện …
Sau một hồi đắn đo suy nghĩ. Anh ta hạ quyết tâm vung đao tự cung.. 				
			</p>
			
			<h3 style="color:#0c7a00;">Search Box</h3>	
			<form action="#" class="searchform">
				<p>
				<input name="search_query" class="textbox" type="text" placeholder="insert Search"  />
  				<input name="search" class="button" value="Search" type="submit" />
				</p>			
			</form>							
			
		</div>	
	
	<!-- contents end here -->	
	</div></div>

	<!-- footer starts here -->	
	<?php $this->load->view('blog/footer');?>
	<!-- footer ends here -->

</body>
</html>