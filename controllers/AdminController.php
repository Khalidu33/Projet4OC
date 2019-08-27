<?php

namespace controllers;

use models\CommentManager;
use models\Message;
use models\PostManager;

class AdminController {

    // Lister les billets en ligne et les commentaires signalés
    // depuis la page d'administration
    public function indexAction()
    {
        // Objet
        $newPostManager = new PostManager();
        $newCommentManager = new CommentManager();
        // Méthode
        $posts = $newPostManager->getPosts();
        $comments = $newCommentManager->getReportedComments();
        // Vue
        require_once ('views/adminPanel.php');
    }

    // Publier un nouveau billet depuis la page d'administration
    public function postAction($title, $content)
    {
        // Si la requête serveur est une méthode POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            if (!empty($title) && !empty($content))
            {
                $newPostManager = new PostManager();
                $newPostManager->addPost($title, $content);
                $newMessage = new Message();
                $newMessage->setSuccess("<p>Merci, votre billet a bien été publié !</p>");
            }
            else
            {
                $newMessage = new Message();
                $newMessage->setError("<p>Tous les champs doivent être rempli !</p>");
            }
        }
        // Sinon on reste sur la page
        $newAdminController = new AdminController();
        $newAdminController->indexAction();
    }

    // Modifier un billet depuis la page d'administration
    public function editPostAction($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $post = new PostManager();
            $post->updatePost($_GET['id'], ($_POST['title']), ($_POST['content']));
            $newMessage = new Message();
            $newMessage->setSuccess("<p>Merci, votre billet a bien été modifié !</p>");
        }
        $newPostManager = new PostManager();
        $post = $newPostManager->getPost($id);
        // Vue
        require_once ('views/editPost.php');
    }

    // Supprimer un billet depuis la page d'administration
    public function deletePostAction($id)
    {
        $newPostManager = new PostManager();
        $deletedPost = $newPostManager->deletePost($id);
        // Gestion des erreurs
        if ($deletedPost === false)
        {
            throw new Exception("Impossible de supprimer le billet !");
        }
        else
        {
            header('Location: ?controller=AdminController&action=indexAction');
        }
    }

    // Modifier un commentaire signalé
    public function editCommentAction($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $comment = new CommentManager();
            $comment->updateComment($_GET['id'], ($_POST['content']));
            $newMessage = new Message();
            $newMessage->setSuccess("<p>Merci, votre commentaire a bien été modifié !</p>");
        }
        $newCommentManager = new CommentManager();
        $comment = $newCommentManager->getComment($id);
        // Vue
        require_once ('views/editComment.php');
    }

    // Supprimer un commentaire signalé
    public function deleteCommentAction($id)
    {
        $newCommentManager = new CommentManager();
        $deletedComment = $newCommentManager->deleteComment($id);
        // Gestion des erreurs
        if ($deletedComment === false) {
            throw new \Exception("Impossible de supprimer le commentaire !");
        }
        else {
            header('Location: ?controller=AdminController&action=indexAction');
        }
    }
}