<?php
class Mplanvsreal extends CI_Model {
    // public $title;
    // public $content;
    // public $date;

    public function get_man_hour_plan()
    {
        $query = $this->db->query(
			"SELECT `tanggal`,`no_wo`,`time`
			FROM `m_planing` WHERE `id_pabrik` = '$id_pabrik' AND`tanggal` = '$tanggal'
		");
        return $query->result();
    }

    public function get_man_hour_real()
    {
        // SELECT DISTINCT `m_activity_detail`.`tanggal`, `m_activity`.`no_wo`,`nama_teknisi`,`realisasi` FROM `m_activity`,`m_activity_detail` WHERE `m_activity`.`no_wo` = `m_activity_detail`.`no_wo`

        $query = $this->db->query(
			"SELECT `no_wo`,`nama_teknisi`,`realisasi`
			FROM `m_activity`,`m_activity_detail` 
            WHERE 
            `m_activity`.`no_wo` = `m_activity_detail`.`no_wo` 
            AND 
            `m_activity`.`no_wo` LIKE '%$id_pabrik-$tahun-$bulan%'
		");
        return $query->result();    
    
    }

    public function update_entry()
    {
        $this->title    = $_POST['title'];
        $this->content  = $_POST['content'];
        $this->date     = time();

        $this->db->update('entries', $this, array('id' => $_POST['id']));
    }
}
?>