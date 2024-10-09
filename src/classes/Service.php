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

    /**
     * Save the service and return the newly inserted service ID.
     * @throws Exception
     */
    public function save1()
    {
        try {
            // Get the maximum order value from the services table
            $maxOrderQuery = $this->db->prepare('SELECT MAX(`order`) as max_order FROM services');
            $maxOrderQuery->execute();
            $row = $maxOrderQuery->fetch();

            // Calculate the next order
            $max_order = $row['max_order'] ?? 0;
            $next_order = $max_order + 1;

            // Insert the new service with the next order value
            $req = "INSERT INTO services (`order`) VALUES (?)";
            $stmt = $this->db->prepare($req);
            $stmt->execute([$next_order]);

            // Return the ID of the newly inserted service
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Unable to save service: " . $e->getMessage());
            throw new Exception("Unable to save service.");
        }
    }

    /**
     * Save service translation for a given language.
     * @throws Exception
     */
    public function save2($id_service, $lang_code, $titre_service, $info_service)
    {
        try {
            // Insert the translation of the service into the translations table
            $stmt = $this->db->prepare("INSERT INTO services_translations (id_service, lang_code, titre_service, info_service) VALUES (?, ?, ?, ?)");
            $stmt->execute([$id_service, $lang_code, $titre_service, $info_service]);

            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Unable to save service_translations: " . $e->getMessage());
            throw new Exception("Unable to save service_translations.");
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

    public function update1($date, $type, $project)
    {
        try {
            $req = "UPDATE services SET project_date = ?, id_project_type = ? WHERE id_project = ?";
            $stmt = $this->db->prepare($req);
            $stmt->execute([$date, $type, $project]);

            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function update2($titre_service, $info_service, $id, $lang)
    {
        try {
            $req = "UPDATE services_translations SET titre_service = ?, info_service = ? WHERE id_service = ? AND lang_code = ?";
            $stmt = $this->db->prepare($req);
            $stmt->execute([$titre_service, $info_service, $id, $lang]);
            $affectedRows = $stmt->rowCount();
            return $affectedRows;
        } catch (PDOException $e) {
            error_log("Error in update2: " . $e->getMessage());
            return false;
        }
    }

    public function delete($id)
    {
        try {
            $req = "UPDATE services SET deleted = 1 WHERE id_service = ?";
            $stmt = $this->db->prepare($req);
            $stmt->execute([$id]);
            return $stmt;
        } catch (PDOException $e) {
            throw new Exception("Unable to delete project_type: " . $e->getMessage());
        }
    }
}
