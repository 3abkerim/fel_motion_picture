<?php

require 'Database.php';

class Message
{
    private $db;
    private $name;
    private $email;
    private $subject;
    private $message;
    private $dateTime;

    public function __construct($name, $email, $subject, $message, $dateTime)
    {
        $this->db = (new Database())->connect();
        $this->name = $name;
        $this->email = $email;
        $this->subject = $subject;
        $this->message = $message;
        $this->dateTime = $dateTime;
    }

    public function save()
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO messages (name, email, subject, message, date) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$this->name, $this->email, $this->subject, $this->message, $this->dateTime]);
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            throw new Exception("Unable to save message: " . $e->getMessage());
        }
    }

    public function getAll()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM messages");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception("Unable to retrieve messages: " . $e->getMessage());
        }
    }

    public function getById($id)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM messages WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            throw new Exception("Unable to retrieve message: " . $e->getMessage());
        }
    }
}
