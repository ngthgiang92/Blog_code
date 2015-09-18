<?php $this->load->view('blog/header');?>
<body>

	<!-- header top starts-->
	<?php $this->load->view('blog/menu_top');?>
	<!-- header top ends here -->
	
	<!-- content starts -->
	<div id="content-outer" class="clear"><div id="content-wrapper">
	
		<!-- column-one -->
		<div id="content">
            <div class="col-one">
			
    			<h2>List post</h2>
                <table>
                    <tr>
                        <th>Entry_id</th>
                        <th>Entry_name</th>
                        <th>Entry_body</th>
                        <th>Entry_date</th>
                    </tr>
                    
                       <?php foreach($data as $itemp) {?>
                        <tr>
                            <td><?php echo $itemp['entry_id']?></td>
                            <td><?php echo $itemp['entry_name']?></td>
                            <td><?php echo $itemp['entry_date']?></td>
                            <td><a href="<?php echo base_url()?>edit/<?php echo $itemp['entry_id']?>">Edit</a> | <a href="<?php echo base_url()?>delete_entry/<?php echo $itemp['entry_id']?>">Delete</a></td>
                        </tr>
                       <?php }?>
                </table>
    		</div>
            <form id="quick-search" action="<?php echo base_url()?>search" method="get" >
    			<p>
    			<label for="qsearch">Search:</label>
    			<input class="tbox" id="qsearch" type="text" name="qsearch" placeholder="Search this site..." title="Start typing and hit ENTER" />
    			<input class="btn" type="submit" value="Submit" />
    			</p>
    		</form>	
    </div>
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