<?php

class Service
{
    private $db;
    private $titre_service;
    private $info_service;
    private $order;

    public function __construct()
    {
        $this->db = (new Database())->connect();
    }

    public function setTitre($titre)
    {
        $this->titre_service = $titre;
    }

    public function setInfo($info)
    {
        $this->info_service = $info;
    }

    public function setOrder($order)
    {
        $this->order = $order;
    }

    public function save()
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO services (titre_service, info_service, order) VALUES (?, ?, ?)");
            $stmt->execute([
                $this->titre_service,
                $this->info_service,
                $this->order,

            ]);
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Unable to save user: " . $e->getMessage());
            throw new Exception("Unable to save user.");
        }
    }
    public function getAll($lang)
    {
        try {
            $stmt = $this->db->prepare("SELECT s.*, st.titre_service, st.info_service FROM services s LEFT JOIN services_translations st ON s.id_service = st.id_service AND st.lang_code = ?");
            $stmt->execute([$lang]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception("Unable to retrieve services: " . $e->getMessage());
        }
    }


    public function getAllByOrder($lang)
    {
        try {
            $stmt = $this->db->prepare("SELECT s.*, st.titre_service, st.info_service FROM services s LEFT JOIN services_translations st ON s.id_service = st.id_service AND st.lang_code = ? ORDER BY s.`order`");
            $stmt->execute([$lang]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception("Unable to retrieve ordered services: " . $e->getMessage());
        }
    }




    public function getById($id)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM `service` WHERE `id_service` = ?");
            $stmt->execute([$id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            throw new Exception("Unable to retrieve message: " . $e->getMessage());
        }
    }
}
