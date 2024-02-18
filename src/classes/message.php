<?php
class Message
{
    private $firstName;
    private $lastName;
    private $email;
    private $subject;
    private $message;
    private $dateTime;

    public function __construct($firstName, $lastName, $email, $subject, $message, $date)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->subject = $subject;
        $this->message = $message;
        $this->dateTime = $date;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }
    public function getLastName()
    {
        return $this->lastName;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getSubject()
    {
        return $this->subject;
    }
    public function getMessage()
    {
        return $this->message;
    }
    public function getDate()
    {
        return $this->dateTime;
    }


    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }
    public function setMessage($message)
    {
        $this->message = $message;
    }
    public function setDate($date)
    {
        $this->dateTime = $date;
    }

    public function sendMessage($firstName, $lastName, $email, $subject, $message, $date)
    {
        $reqSendMessage = $bdd->prepare('INSERT INTO messages (nom,prenom, email, subject, message, date) VALUES (?,?,?,?,?,?)');
        $reqSendMessage->execute([$this->firstName, $this->lastName, $this->email, $this->subject, $this->message, $this->date]);
    }
}
