<?php $this->load->view('blog/header');?>
<script src="<?php echo base_url()?>assets/ckeditor/ckeditor.js"></script>
<body>
	<!-- header top starts-->
	<?php $this->load->view('blog/menu_top');?>
	<!-- header top ends here -->
	
	<!-- content starts -->
	<div id="content-outer" class="clear"><div id="content-wrapper">
	
		<!-- column-one -->
		<div id="content"><div class="col-one"> <?php foreach($data as $itemp) {?>
			<form action="<?php echo base_url(). "update_entry/"?><?php echo $itemp['entry_id']?>" method="post" >
    			<h2>Edit Entry</h2>
               
    			<p><label>Title</label>
    			<input type="text" name="entry_name" value="<?php echo $itemp['entry_name']?>" size="30" /></p>
    
    			<p><label>Your Entry: (in html)</label>
    			<textarea class="ckeditor" rows="16" cols="80%" name="entry_body" style="resize:none;"><?php echo $itemp['entry_body']?></textarea></p>
    			 <?php }?>
    			<br />	
    			
    			<input class="button" type="submit" value="Update" name="update">
    			<input class="button" type="reset" value="Reset"/>	
			</form>
		</div></div>
		
		<!-- column-two -->
		<?php $this->load->view('blog/menu_sidebar');?>	
	
		<!-- column-three -->
		<?php $this->load->view('blog/sidebar');?>
		
	<!-- contents end here -->	
	</div></div>

	<!-- footer starts here -->	
	<?php $this->load->view('blog/footer');?>
	<!-- footer ends here -->

</body>
</html>