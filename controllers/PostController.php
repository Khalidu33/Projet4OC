<?php

namespace controllers;

use models\PostManager;
use models\CommentManager;

class PostController {

    // Lister les billets à l'accueil
    public function indexAction()
    {
        $newPostManager = new PostManager();
        $total = $newPostManager->countArticle();
        $perPage = 3; 
        $nbPage = ceil($total/$perPage);
        if(isset($_GET['p']) && !empty($_GET['p']) && ctype_digit($_GET['p']) == 1){
            if($_GET['p'] > $nbPage){
                $current = $nbPage;
            }
            else{
                $current = $_GET['p'];
            }
        }
        else{
            $current = 1;
        }
        $firestOfPage = ($current-1)*$perPage;
        $posts = $newPostManager->getPreviousPosts($firestOfPage,$perPage);
        
        require_once ('views/listPosts.php');
    }

    // Afficher le dernier  billet en date
    public function showLastPostAction()
    {
        $newPostManager = new PostManager();
        $lastPost = $newPostManager->getLastPost();
        require_once ('views/lastPost.php');
    }

    // Afficher le contenu d'un billet
    public function showAction($id)
    {
        $newPostManager = new PostManager();
        $newCommentManager = new CommentManager();
        $post = $newPostManager->getPost($id);
        $comments = $newCommentManager->getComments($id);
        // Si l'id du billet n'existe pas alors on affiche une erreur
        if ($post->getId() == null)
        {
            // Vue
            require_once ('views/error.php');
        }
        else
        {
            // Vue
            require_once ('views/postView.php');
        }
    }    
}