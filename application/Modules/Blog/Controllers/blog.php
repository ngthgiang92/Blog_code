<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Blog extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('blog_model');
	}

	public function index()
	{
		$data['title'] = 'Home';
		
		$data['current'] = 'HOME';
		$data['posts'] = $this->blog_model->get_posts();
		
		$data['categories'] = $this->blog_model->get_categories();
		
		$this->load->view('blog/index',$data);
	}
	
	public function about()
	{
		$data['title'] = 'About';
		$data['current'] = 'ABOUT';
		$data['categories'] = $this->blog_model->get_categories();
		$this->load->view('blog/about',$data);
	}
	
	public function post($id) // get a post based on id
	{
		$data['query'] 			= $this->blog_model->get_post($id);
		$data['comments'] 		= $this->blog_model->get_post_comment($id); // get comments related to the post
		$data['post_id'] 		= $id;
		$data['categories'] = $this->blog_model->get_categories();
		
		if( $this->ion_auth->logged_in() )
			$data['user'] = $this->ion_auth->user()->row(); // get current user login details
		
		$this->load->helper('form');
		$this->load->library(array('form_validation'));
		
		//set validation rules
		$this->form_validation->set_rules('commentor', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('comment', 'Comment', 'required');
		
		if($this->blog_model->get_post($id))
		{
			foreach($this->blog_model->get_post($id) as $row)
			{
				$data['title'] = $row->entry_name.'';
			}
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('blog/post',$data);
			}
			else
			{
				$name = $this->input->post('commentor');
				$email = strtolower($this->input->post('email'));
				$comment = $this->input->post('comment');
				$post_id = $this->input->post('post_id');
				
				if( $this->input->post('user_id') )
					$user_id = $this->input->post('user_id');
				else
					$user_id = 0;
				
				$this->blog_model->add_new_comment($post_id, $name, $email, $comment, $user_id);
				$this->session->set_flashdata('message', '1 new comment added!');
				redirect('post/'.$id);
			}
		}
		else
			show_404();
	}
	
	public function add_new_entry()
	{
		if( ! $this->ion_auth->logged_in() && ! $this->ion_auth->is_admin() ) // block un-authorized access
		{
			show_404();
		}
		else
		{
			$data['title'] = 'Add new entry';
			//$data['categories'] = $this->blog_model->get_categories();
			
			$this->load->helper('form');
			$this->load->library(array('form_validation'));
			
			//set validation rules
			$this->form_validation->set_rules('entry_name', 'Title', 'required|max_length[200]|xss_clean');
			$this->form_validation->set_rules('entry_body', 'Body', 'required|xss_clean');
			//$this->form_validation->set_rules('entry_category', 'Category', 'required');
			
			if ($this->form_validation->run() == FALSE)
			{
				//if not valid
				$this->load->view('admin/add_new_entry',$data);
			}
			else
			{
				//if valid
				$user = $this->ion_auth->user()->row();
				$title = $this->input->post('entry_name');
				$body = $this->input->post('entry_body');
			//	$categories = $this->input->post('entry_category');
				
				$this->blog_model->add_new_entry($user->id,$title,$body/*$categories*/);
				$this->session->set_flashdata('message', '1 new post added!');
				redirect('add-new-entry');
			}
		}
	}
	
	public function add_new_category()
	{
		$data['title'] = 'Add new category';
		
		if( ! $this->ion_auth->logged_in() && ! $this->ion_auth->is_admin() ) // block un-authorized access
		{
			show_404();
		}
		else
		{
			$this->load->helper('form');
			$this->load->library(array('form_validation'));
			
			// set validation rules
			$this->form_validation->set_rules('category_name', 'Name', 'required|max_length[200]|xss_clean');
			$this->form_validation->set_rules('category_slug', 'Slug', 'max_length[200]|xss_clean');
			
			if ($this->form_validation->run() == FALSE)
			{
				//if not valid
				$this->load->view('admin/add_new_category',$data);
			}
			else
			{
				//if valid
				$name = $this->input->post('category_name');
				
				if( $this->input->post('category_slug') != '' )
					$slug = $this->input->post('category_slug');
				else
					$slug = strtolower(preg_replace('/[^A-Za-z0-9_-]+/', '-', $name));
					
				$this->blog_model->add_new_category($name,$slug);
				$this->session->set_flashdata('message', '1 new category added!');
				redirect('add-new-category');
			}
		}
	}
    public function list_post()
    {
        $data['title'] = 'List post admin';
        if( ! $this->ion_auth->logged_in() && ! $this->ion_auth->is_admin() ) // block un-authorized access
		{
			show_404();
		}
		else
		{
            $data['data'] =$this->blog_model->get_list_entry();
    		$this->load->view('admin/list_post',$data);
        }
    }
	public function category($slug = FALSE)
	{
		$data['title'] = 'Category';
		$data['categories'] = $this->blog_model->get_categories();
		
		if( $slug == FALSE )
			show_404();
		else
		{
			$data['category'] = $this->blog_model->get_category(NULL,$slug); // get category details
			$data['query'] = $this->blog_model->get_category_post($slug); // get post in the category
		}
		$this->load->view('blog/category',$data);
	}
    public function search()
    {
        $data['title'] = 'Search box';
        if( ! $this->ion_auth->logged_in() && ! $this->ion_auth->is_admin() ) // block un-authorized access
		{
			show_404();
		}
		else
		{
            $function_name = $this->input->get('qsearch');
            $data['data'] = $this->blog_model->getSearchResults($function_name);
            $this->load->view('admin/search',$data);
        }
    }
    public function edit($id)
    {
        $data['title'] = 'Edit list post';
        if( ! $this->ion_auth->logged_in() && ! $this->ion_auth->is_admin() )
		{
			show_404();
		}
		else
		{
            $data['data'] = $this->blog_model->get_edit($id);
            $this->load->view('admin/edit_category',$data);
        }
    }
    public function update_entry($id)
    {
        $data['title'] = 'Update entry';
        if( ! $this->ion_auth->logged_in() && ! $this->ion_auth->is_admin() ) // block un-authorized access
		{
			show_404();
		}
		else
		{
		  
			$data = array(
            'entry_name'=>$this->input->post('entry_name'),
            'entry_body'=>$this->input->post('entry_body'),
            'entry_date'=>date('Y-m-d H:i:s'),
            );
            $this->blog_model->update($id,$data);
            $data_list['data_list'] = $this->blog_model->get_list_entry();
            $this->load->view('admin/success_update',$data_list);
            
		}
    }
    public function delete_entry($id)
    {
        $data['title'] = 'Delete entry';
        if( ! $this->ion_auth->logged_in() && ! $this->ion_auth->is_admin() ) // block un-authorized access
		{
			show_404();
		}
		else
		{
		  $data =  $this->blog_model->delete_entry($id);
          $data_list['data_list'] = $this->blog_model->get_list_entry();
          $this->load->view('admin/success_delete',$data_list);
        }
    }
    public function do_upload()
    {
        if($this->input->post('submit'))
        {
            $path = '/upload/';
            $this->load->library('upload');
            $this->upload->initialize=array(
            'upload_path'=>$path,
            'max_size'=>'100',
            'allow_type'=>'gif|jpg|png',
            'max_width'=>'1024',
            'min_height'=>'768'
            );
        }
    }
}

/* End of file blog.php */
/* Location: ./application/controllers/blog.php */