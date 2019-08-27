<?php

namespace models;

class CommentManager extends Manager {

    //Obtenir les commentaires d'un billet
    public function getComments($post_id)
    {
        // Connexion à la bdd
        $newManager = new Manager();
        $db = $newManager->dbConnect();
        // Requête
        $request = $db->prepare('SELECT id, post_id, author, content, alert, DATE_FORMAT(added_datetime, \'%d/%m/%Y à %Hh%i\') AS added_datetime_fr, updated_datetime FROM comments WHERE post_id = ?');
        // Exécute la requête
        $request->execute(array($post_id));
        // Transformation en tableau
        $result = $request->fetchAll();
        $comments = [];
        foreach ($result as $comment) {
            $newComment = new Comment($comment['id'], $comment['post_id'], $comment['author'], $comment['content'], $comment['alert'], $comment['added_datetime_fr'], $comment['updated_datetime']);
            $comments[] = $newComment;
        }
        // Résultat
        return $comments;
    }

    // Publier un nouveau commentaire sous un billet
    public function postComment($post_id, $author, $content)
    {
        // Connexion à la base de données
        $newManager = new Manager();
        $db = $newManager->dbConnect();
        // Requête
        $comments = $db->prepare('INSERT INTO comments (post_id, author, content, alert, added_datetime) VALUES (?, ?, ?, 0, NOW())');
        // Exécute la requête
        $affectedLines = $comments->execute(array($post_id, $author, $content));
        // Résultat
        return $affectedLines;
    }

    // Signaler un commentaire sous un billet
    public function reportComment($id)
    {
        // Connexion à la base de données
        $newManager = new Manager();
        $db = $newManager->dbConnect();
        // Requête
        $request = $db->prepare('UPDATE comments SET alert = alert + 1 WHERE id = ?');
        // Exécute la requête
        $alertedComment = $request->execute(array($id));
        // Résultat
        return $alertedComment;
    }

    // Récupérer les commentaires le plus signalés
    public function getReportedComments()
    {
        // Connexion à la base de données
        $newManager = new Manager();
        $db = $newManager->dbConnect();
        // Requête
        $request = $db->query('SELECT id, post_id, author, content, alert, DATE_FORMAT(added_datetime, \'le %d/%m/%Y à %Hh%i\') AS added_datetime_fr, DATE_FORMAT(updated_datetime, \'le %d/%m/%Y à %Hh%i\') AS updated_datetime_fr FROM comments WHERE alert != 0 ORDER BY alert DESC LIMIT 10');
        // Exécute la requête
        $request->execute(array());
        // Transformation en tableau
        $result = $request->fetchAll();
        $comments = [];
        foreach ($result as $comment) {
            $newComment = new Comment($comment['id'], $comment['post_id'], $comment['author'], $comment['content'], $comment['alert'], $comment['added_datetime_fr'], $comment['updated_datetime_fr']);
            $comments[] = $newComment;
        }
        // Résultat
        return $comments;
    }

    // Obtenir l'identifiant d'un commentaire
    public function getComment($id)
    {
        // Connexion à la base de données
        $newManager = new Manager();
        $db = $newManager->dbConnect();
        // Requête
        $request = $db->prepare('SELECT id, post_id, author, content, alert, added_datetime, updated_datetime FROM comments WHERE id = ?');
        // Exécute la requête
        $request->execute(array($id));
        // Résultat
        $comment = $request->fetch();
        return new Comment($comment['id'], $comment['post_id'], $comment['author'], $comment['content'], $comment['alert'], $comment['added_datetime'], $comment['updated_datetime']);
    }

    // Modifier un commentaire depuis la page d'administration
    public function updateComment($id, $content)
    {
        // Connexion à la base de données
        $newManager = new Manager();
        $db = $newManager->dbConnect();
        // Requête
        $request = $db->prepare('UPDATE comments SET content = ?, updated_datetime = NOW() WHERE id = ?');
        $comment = $request->execute(array($content, $id));
        // Résultat
        return $comment;
    }

    // Supprimer un commentaire depuis la page d'administration
    public function deleteComment($id)
    {
        // Connexion à la base de données
        $newManager = new Manager();
        $db = $newManager->dbConnect();
        // Requête
        $request = $db->prepare('DELETE FROM comments WHERE id = ?');
        // Résultat
        $deletedComment = $request->execute(array($id));
        return $deletedComment;
    }
}