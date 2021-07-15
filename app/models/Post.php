<?php

class Post
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
    public function getPosts()
    {
        $this->db->query('SELECT * ,
                                issue_report.id as issuetId,
                                users.id as userId,
                                issue_report.created_at as issueCreated,
                                users.created_at as userCreated
                            FROM issue_report
                            INNER JOIN users
                            ON issue_report.user_id=users.id
                            ORDER BY issue_report.created_at DESC 
                            ');

        $results = $this->db->resultSet();
        return $results;
    }

    public function getComments($id){
        $this->db->query('SELECT
                                comments.comment_id as commentId,
                                comments.user_id as userId,
                                comments.created_at as commentCreated,
                                comments.comment as commentText,
                                users.name as userName
                                FROM comments
                                INNER JOIN users
                                ON comments.user_id = users.id
                                WHERE comments.id = :post_id
                                ORDER BY comments.created_at DESC
                                ');

        $this->db->bind(':post_id',$id);

        $this->db->execute();
        $results = $this->db->resultSet();
        return $results;
    }

    public function addIssues($data)
    {

        $this->db->query('INSERT INTO issue_report (user_id,name,contact,flat_no,title,issue,img) VALUES (:user_id,:name,:contact,:flat_no,:title,:issue,:img)');

        //Bind values

        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':contact', $data['contact']);
        $this->db->bind(':flat_no', $data['flat_no']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':issue', $data['issue']);
        $this->db->bind(':img', $data['img']);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateIssue($data)
    {

        $this->db->query('UPDATE issue_report SET name = :name , contact = :contact , flat_no = :flat_no , title = :title , issue = :issue , img = :img WHERE id = :id');

        //Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':contact', $data['contact']);
        $this->db->bind(':flat_no', $data['flat_no']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':issue', $data['issue']);
        $this->db->bind(':img', $data['img']);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getPostById($id){
        $this->db->query('SELECT * FROM issue_report WHERE id = :id');
        $this->db->bind(':id',$id);

        $row=$this->db->single();

        return $row;
    }

    public function deleteIssue($id)
    {
        $this->db->query('DELETE FROM issue_report WHERE id = :id');

        //Bind values
        $this->db->bind(':id',$id);


        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function addComment($data)
    {
        $this->db->query('INSERT INTO comments (user_id,id,comment) VALUES (:user_id,:id,:comment)');

        //Bind values

        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':comment', $data['comment']);
        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function deleteComment($id)
    {
        $this->db->query('DELETE FROM comments WHERE comment_id = :id');

        //Bind values
        $this->db->bind(':id',$id);


        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function addReplay($data)
    {
        $this->db->query('INSERT INTO comments (user_id,id,parent_comment_id,comment) VALUES (:user_id,:id,:parent_comment_id,:comment)');

        //Bind values

        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':comment', $data['comment']);
        $this->db->bind(':parent_comment_id', $data['parent_comment_id']);
        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

}