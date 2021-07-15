<?php

class Posts extends Controller
{
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $this->postModel = $this->model('post');
        $this->userModel = $this->model('User');

    }

    public function index()
    {
        //Get Posts
        $posts = $this->postModel->getPosts();


        $data = [
            'posts' => $posts
        ];

        $this->view('posts/index', $data);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize POST Array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'user_id' => $_SESSION['user_id'],
                'name' => trim($_POST['name']),
                'contact' => trim($_POST['contact']),
                'flat_no' => trim($_POST['flat_no']),
                'title' => trim($_POST['title']),
                'issue' => trim($_POST['issue']),
                'img' => trim($_POST['img']),

                'name_err' => '',
                'contact_err' => '',
                'flat_no_err' => '',
                'title_err' => '',
                'issue_err' => '',
                'img_err' => '',
            ];

            //Validate Title
            if (empty($data['name'])) {
                $data['name_err'] = 'Please Enter name';
            }

            if (empty($data['contact'])) {
                $data['contact_err'] = 'Please Enter contact';
            }

            if (empty($data['flat_no'])) {
                $data['flat_no_err'] = 'Please Enter num';
            }

            if (empty($data['title'])) {
                $data['title_err'] = 'Please Enter Title';
            }

            //Validate Body
            if (empty($data['issue'])) {
                $data['issue_err'] = 'Please Enter Text';
            }

            if (empty($data['img'])) {
                $data['img_err'] = 'Please Enter img';
            }

            //Make sure no error
            if (empty($data['name_err']) && empty($data['contact_err']) && empty($data['flat_no_err']) && empty($data['title_err']) && empty($data['issue_err']) && empty($data['img_err']) ) {
                //Validate
                if ($this->postModel->addIssues($data)) {
                    flash('post_message', 'Issues Added');
                    redirect('posts');
                } else {
                    die('Something went wrong');
                }
            } else {
                //Load View with errors
                $this->view('posts/add', $data);
            }

        } else {
            $data = [
                'name_err' => '',
                'contact_err' => '',
                'flat_no_err' => '',
                'title_err' => '',
                'issue_err' => '',
                'img_err' => '',
            ];

            $this->view('posts/add', $data);
        }
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize POST Array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'user_id' => $_SESSION['user_id'],
                'name' => trim($_POST['name']),
                'contact' => trim($_POST['contact']),
                'flat_no' => trim($_POST['flat_no']),
                'title' => trim($_POST['title']),
                'issue' => trim($_POST['issue']),
                'img' => trim($_POST['img']),

                'name_err' => '',
                'contact_err' => '',
                'flat_no_err' => '',
                'title_err' => '',
                'issue_err' => '',
                'img_err' => '',
            ];

            //Validate Title
            if (empty($data['name'])) {
                $data['name_err'] = 'Please Enter name';
            }

            if (empty($data['contact'])) {
                $data['contact_err'] = 'Please Enter contact';
            }

            if (empty($data['flat_no'])) {
                $data['flat_no_err'] = 'Please Enter num';
            }

            if (empty($data['title'])) {
                $data['title_err'] = 'Please Enter Title';
            }

            //Validate Body
            if (empty($data['issue'])) {
                $data['issue_err'] = 'Please Enter Text';
            }

            if (empty($data['img'])) {
                $data['img_err'] = 'Please Enter img';
            }

            //Make sure no error
            if (empty($data['name_err']) && empty($data['contact_err']) && empty($data['flat_no_err']) && empty($data['title_err']) && empty($data['issue_err']) && empty($data['img_err']) ) {
                //Validate
                if ($this->postModel->updateIssue($data)) {
                    flash('post_message', 'Issues Updated');
                    redirect('posts');
                } else {
                    die('Something went wrong');
                }
            } else {
                //Load View with errors
                $this->view('posts/edit', $data);
            }

        } else {
            //Get Existing post from model
            $post=$this->postModel->getPostById($id);

            //check for owner
            if($post->user_id != $_SESSION['user_id']){
                redirect('posts');
            }

            $data = [
                'id' => $id,
                'name'=>$post->name,
                'contact'=>$post->contact,
                'flat_no'=>$post->flat_no,
                'title' => $post->title,
                'issue' => $post->issue,
                'img'=>$post->img
            ];

            $this->view('posts/edit', $data);
        }
    }

    public function comment($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize POST Array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'comment' => trim($_POST['comment']),
                'user_id' => $_SESSION['user_id'],
                'comment_err' => '',
            ];

            //Validate Title
//            if (empty($data['comment'])) {
//                $data['comment_err'] = 'Please Enter comment';
//            }

            //Validate Body

            //Make sure no error
            if (empty($data['comment_err'])) {
                //Validate
                if ($this->postModel->addComment($data)) {
                    flash('post_message', 'Comment Added');
                    redirect('posts');

                } else {
                    die('Something went wrong');
                }
            } else {
                //Load View with errors
                $this->view('posts/show', $data);
            }

        } else {
            $data = [
                'comment' => '',
            ];

            $this->view('posts/show'.$id , $data);
        }
    }

    public function show($id)
    {
        $post = $this->postModel->getPostById($id);
        $user = $this->userModel->getUserById($post->user_id);
        $comments=$this->postModel->getComments($id);

        $data = [
            'post' => $post,
            'user' => $user,
            'comments'=>$comments
        ];

        $this->view('posts/show', $data);
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $post=$this->postModel->getPostById($id);

            //check for owner
            if($post->user_id != $_SESSION['user_id']){
                redirect('posts');
            }
            if ($this->postModel->deleteIssue($id))
            {
                flash('post_message','Issues removed');
                redirect('posts');
            }else{
                die('Something went wrong');
            }
        }else
        {
            redirect('posts');
        }
    }
    public function deleteComm($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $post=$this->postModel->getComments($id);

            //check for owner
            if($post->user_id != $_SESSION['user_id']){
                redirect('posts');
            }
            if ($this->postModel->deleteComment($id))
            {
                flash('post_message','Comment removed');
                redirect('posts');
            }else{
                die('Something went wrong');
            }
        }else
        {
            redirect('posts');
        }
    }

    public function replay($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize POST Array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'parent_comment_id'=>trim($_POST['parent_comment_id']),
                'comment' => trim($_POST['comment']),
                'user_id' => $_SESSION['user_id'],
                'comment_err' => '',
            ];

            //Validate Title
//            if (empty($data['comment'])) {
//                $data['comment_err'] = 'Please Enter comment';
//            }

            //Validate Body

            //Make sure no error
            if (empty($data['comment_err'])) {
                //Validate
                if ($this->postModel->addReplay($data)) {
                    flash('post_message', 'replay Added');
                    redirect('posts');

                } else {
                    die('Something went wrong');
                }
            } else {
                //Load View with errors
                $this->view('posts/show', $data);
            }

        } else {
            $data = [
                'comment' => '',
            ];

            $this->view('posts/show'.$id , $data);
        }
    }

}