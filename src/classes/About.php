<?php

class About
{
    private $db;
    private $title;
    private $main;
    private $order;



    public function __construct()
    {
        $this->db = (new Database())->connect();
    }

    public function save()
    {
        try {
            $req = "INSERT INTO `about_us` (title,about_us,order) VALUES (?,?,?)";
            $stmt = $this->db->prepare($req);
            $stmt->execute([$this->title, $this->main, $this->order]);
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            throw new Exception("Unable to retrieve messages: " . $e->getMessage());
        }
    }
    public function getAll($lang)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM about_us ab LEFT JOIN about_us_translations abt ON ab.id_about_us = abt.id_about_us AND ab.qsn = 0 AND abt.lang_code = ?");
            $stmt->execute([$lang]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception("Unable to retrieve messages: " . $e->getMessage());
        }
    }

    public function getqsn($lang)
    {
        try {
            $stmt = $this->db->prepare("SELECT abt.about_us FROM about_us ab JOIN about_us_translations abt ON ab.id_about_us = abt.id_about_us AND ab.qsn = 1 AND abt.lang_code = ?");
            $stmt->execute([$lang]);
            $result = $stmt->fetch();
            return $result['about_us'];
        } catch (PDOException $e) {
            throw new Exception("Unable to retrieve messages: " . $e->getMessage());
        }
    }

    public function getAllByOrder($lang)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM about_us ab LEFT JOIN about_us_translations abt ON ab.id_about_us = abt.id_about_us AND ab.qsn = 0 AND abt.lang_code = ? ORDER BY `order` ASC");
            $stmt->execute([$lang]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception("Unable to retrieve messages: " . $e->getMessage());
        }
    }
    public function delete($id)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM `about_us` WHERE `id_about_us` = ?");
            $stmt->execute([$id]);
            return true;
        } catch (PDOException $e) {
            throw new Exception("Unable to retrieve messages: " . $e->getMessage());
        }
    }
}
