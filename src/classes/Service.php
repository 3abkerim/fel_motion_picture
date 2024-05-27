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

    public function getAllByOrderND($lang)
    {
        try {
            $stmt = $this->db->prepare("
                SELECT s.*, st.titre_service, st.info_service 
                FROM services s 
                LEFT JOIN services_translations st ON s.id_service = st.id_service AND st.lang_code = ? 
                WHERE s.deleted = 0 
                ORDER BY s.`order`
            ");
            $stmt->execute([$lang]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception("Unable to retrieve ordered services: " . $e->getMessage());
        }
    }


    public function getByIdAndLang($id, $lang)
    {
        try {
            $req = "SELECT * FROM services s LEFT JOIN services_translations st on s.id_service = st.id_service WHERE s.id_service = ? and st.lang_code = ?";
            $stmt = $this->db->prepare($req);
            $stmt->execute([$id, $lang]);
            $result = $stmt->fetch();
            return $result;
        } catch (PDOException $e) {
            throw new Exception("Unable to get project_type: " . $e->getMessage());
        }
    }

    public function updateOrder($data) {
        foreach ($data as $item) {
            $query = "UPDATE services SET `order` = :order WHERE id_service = :id";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':order', $item['order'], PDO::PARAM_INT);
            $statement->bindValue(':id', $item['id'], PDO::PARAM_INT);

            if (!$statement->execute()) {
                throw new Exception("Error updating item with ID: " . $item['id']);
            }
        }
        return "Order updated successfully.";
    }
}
