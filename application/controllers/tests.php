<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tests extends CI_Controller 
{
	public function index()
	{
		// $this->session->sess_destroy();
		// die();
		$this->load->view('main');
	}

	//---------------------registering---------------------------

	public function register()
	{
		//register function
		if($this->input->post('action') == 'register')
		{
			//load the model 
			$this->load->model('Test');
			//load the form validation library
			$this->load->library('form_validation');


			//---------form validation---------

			$this->load->library('form_validation');
			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[2]');
   		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[2]');
	    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
	    $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[2]|matches[confirm_password]');
	    $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required');


	    //running the form validator... if errors appear
	    if ($this->form_validation->run() === FALSE)
			{
				//save errors to a variable
				$errors = array(validation_errors());
				//set flashdata containing errors
      	$this->session->set_flashdata('errors', $errors);
      	//redirect to index function
				redirect('/');
			}
			else
			{
				//if there are no errors... set a variable to equal the post data
				$user_details = array(
					"first_name" => $this->input->post('first_name'),
					"last_name" => $this->input->post('last_name'),
					"email" => $this->input->post('email'),
					"password" => md5($this->input->post('password')),
				);
				//send the post data to the database
				$add_user = $this->Test->add_user($user_details);
				//set a success flashdata message
				$success[] = 'You are now registered. ';
        $this->session->set_flashdata('success', $success);
        //redirect to the index function
				redirect('/');
			}
		}
	}
		//-----------------------login--------------------------

	public function login()
	{
		

		if($this->input->post('action') == 'login')
		{
			//load the form validation library
			$this->load->library('form_validation');
			//form validation
			$this->form_validation->set_rules("email","Email","required|valid_email");
			//load the model Test
			$this->load->model('Test');

			//set variables to equal to post data
			$email = $this->input->post('email');
			$password = md5($this->input->post('password'));
			//go to database to retrieve user with the email $email
			$user = $this->Test->get_user($email);
			
			//if the $user is true and the password is equal to the variable password
			if ($user && $user['password']==$password) 
			{		
				//set a session to tell us the user is logged in
				$this->session->set_userdata('loggedIn', TRUE);
				//redirect to function home
				redirect('/tests/home');
			}
			else
			{
				//if the user info is wrong send a flash message with an error message
				$this->session->set_userdata('loggedIn', FALSE);
				$errors[] = 'Please enter valid credentials';
    		$this->session->set_flashdata('errors', $errors);
				// $this->load->view('main');
				redirect('/');
			}
		}
	}

	//------------------------home--------------------
	public function home()
	{	
		//if session loggedIn is true, load the success page
		if($this->session->userdata('loggedIn') == TRUE)
		{
			$this->load->view('success');
		} 
		else
		{
			//if session loggedIn is flase, redirect to index function
			redirect('/');
		}
	}


	

//---------log off ------------------
	public function logoff()
	{
		$this->session->sess_destroy();
		redirect('/');
	}
	





}