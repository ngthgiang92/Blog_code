<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Blog_model extends CI_Model {

	function get_posts()
	{
		$this->db->order_by('entry_date','desc');
		$query = $this->db->get('entry');
		return $query->result();
	}
	public function update($params)
    {
        $fields = array(
        'entry_name'=>$params['entry_name'],
        'entry_body'=>$params['entry_body'],
        'entry_date'=>date('Y-m-d H:i:s')
        );
        //code insert here .
        
        $this->db->insert('entry',$fields);
    }
    /*`entry_id`, `author_id`, `entry_name`, `entry_body`, `entry_date`, `comment_count`*/
	function add_new_entry($author,$name,$body,$categories)
	{
	   
		$data = array(
			'author_id'		=> $author,
			'entry_name'	=> $name,
			'entry_body'	=> $body,
		);
		$this->db->insert('entry',$data);
		
		$object_id = (int) mysql_insert_id();
		foreach($categories as $category)
		{
			$relationship = array(
				'object_id'		=> $object_id,
				'category_id'	=> $category,
			);
			$this->db->insert('entry_relationships',$relationship);
		}
	}
	function add_new_comment($post_id, $commentor, $email, $comment, $user_id)
	{
		$total_count = 0;
		
		$data = array(
			'entry_id'		=> $post_id,
			'comment_name'	=> $commentor,
			'comment_email'	=> $email,
			'comment_body'	=> $comment,
			'user_id'		=> $user_id,
		);
		$this->db->insert('comment',$data);
		
		$query = $this->get_post($post_id);
		foreach($query as $post)
		{
			$total_count = $post->comment_count + 1;
		}
		
		$count = array(
			'comment_count'	=> $total_count,
		);
		
		$this->db->where('entry_id',$post_id);
		$query = $this->db->update('entry',$count); // update comment count

	}
	
	function get_post($id)
	{
		$this->db->where('entry_id',$id);
		$query = $this->db->get('entry');
		if($query->num_rows()!==0)
		{
			return $query->result();
		}
		else
			return FALSE;
	}
	function get_list_entry()
    {
       $query = $this->db->get('entry');
       return $query->result_array(); 
    }
	function get_post_comment($post_id)
	{
		$this->db->where('entry_id',$post_id);
		$query = $this->db->get('comment');
		return $query->result();
	}
	
	function total_comments($id)
	{
		$this->db->like('entry_id', $id);
		$this->db->from('comment');
		return $this->db->count_all_results();
	}
	function add_new_category($name,$slug)
	{
		$i = 0;
		$slug_taken = FALSE;
		
		while( $slug_taken ==  FALSE ) // to avoid duplicate slug
		{
			$category = $this->get_category(NULL,$slug);
			if( $category == FALSE )
			{
				$slug_taken = TRUE;
				$data = array(
					'category_name'	=> $name,
					'slug'			=> $slug,
				);
				$this->db->insert('entry_category',$data);
			}
			$i = $i + 1;
			$slug = $slug.'-'.$i;
		}
	}
	
	function get_category($id = FALSE, $slug)
	{
		if( $id != FALSE)
			$this->db->where('category_id',$id);
		elseif( $slug )
			$this->db->where('slug',$slug);
		
		$query = $this->db->get('entry_category');
		
		if( $query->num_rows() !== 0 )
		{
			return $query->result();
		}
		else
			return FALSE; // return false if no category in database
	}
	
	function get_categories()
	{
		$query = $this->db->get('entry_category'); 
		return $query->result();
	}
	
	function get_related_categories($post_id)
	{
		$category = array();
		
		$this->db->where('object_id',$post_id);
		$query = $this->db->get('entry_relationships'); // get category id related to the post
		
		foreach($query->result() as $row)
		{
			$this->db->where('category_id',$row->category_id);
			$query = $this->db->get('entry_category'); // get category details
			$category = array_merge($category,$query->result());
		}
		
		return $category;
	}
	
	function get_category_post($slug)
	{
		$list_post = array();
		
		$this->db->where('slug',$slug);
		$query = $this->db->get('entry_category'); // get category id
		if( $query->num_rows() == 0 )
			show_404();
		
		foreach($query->result() as $category)
		{
			$this->db->where('category_id',$category->category_id);
			$query = $this->db->get('entry_relationships'); // get posts id which related the category
			$posts = $query->result();
		}
		
		if( isset($posts) && $posts )
		{
			foreach($posts as $post)
			{
				$list_post = array_merge($list_post,$this->get_post($post->object_id)); // get posts and merge them into array
			}		
		}
		
		return $list_post; // return an array of post object
	}
    
    function get_search()
    {
        $match = $this->input->post('search');
        $this->db->like('entry_id',$match);
        $this->db->or_like('entry_name',$match);
        $this->db->or_like('entry_body',$match);
        $this->db->or_like('entry_date',$match);
        $query = $this->db->get('entry');
        return $query->result();
    }
    
    function getSearchResults($function_name,$description = TRUE)
    {
        $this->db->select('*');
        $this->db->from('entry');
        $this->db->like('entry_name',$function_name);
        $query = $this->db->get();      
        if($query->num_rows()>0)
        {
            $output = '<ul>';
            foreach($query->result() as  $function_info)
            {
                    $output.='<li>'.'  ID: '.$function_info->entry_id.',  Name: '.$function_info->entry_name.',  Date: '.$function_info->entry_date.'</li>';
            }
            $output .= '<ul>';
            return $output;
        }else{
            return '<p>Sorry, no results returned</p>';
        }
    }
}

/* End of file blog_model.php */
/* Location: ./applicationodels/blog_model.php */