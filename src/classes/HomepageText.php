<?php

class HomepageText
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->connect();
    }

    public function getByLang($lang)
    {
        try {
            $query = "SELECT * FROM homepage_text h 
                  JOIN homepage_text_translations ht 
                  ON h.id_homepage_text = ht.id_homepage_text 
                  WHERE h.id_homepage_text = 1 AND ht.lang_code = :lang_code";

            $stmt = $this->db->prepare($query);
            $stmt->execute([':lang_code' => $lang]);

            return $stmt->fetch();
        } catch (PDOException $e) {
            throw new Exception("Error fetching homepage presentation by language: " . $e->getMessage());
        }
    }

    public function update($text, $lang)
    {
        try {
            $req = "UPDATE homepage_text_translations SET text = ? WHERE lang_code = ? and id_homepage_text = 1";
            $stmt = $this->db->prepare($req);
            $stmt->execute([$text, $lang]);
            $affectedRows = $stmt->rowCount();
            return $affectedRows;
        } catch (PDOException $e) {
            error_log("Error in updating homepage text: " . $e->getMessage());
            return false;
        }
    }
}
