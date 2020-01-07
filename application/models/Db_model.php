<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Db_model extends CI_Model
{

    public function login($table, $data)
    {

        $query = $this->db->select('c.NAMA, NIM, NAMA_LENGKAP, p.ID_PENGURUS, c.ID_KEMENTERIAN, ACCESS, p.TAHUN, SINGKAT')->from($table . " p")->join('EM_KEMENTERIAN c', 'c.ID_KEMENTERIAN = p.ID_KEMENTERIAN')->where($data)->get();
        if ($this->db->affected_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function selectWhere($table, $data)
    {
        $query = $this->db->where($data)->get($table);
        if ($query) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function getRowWhere($table, $data)
    {
        $query = $this->db->where($data)->get($table);
        if ($query) {
            return $query->num_rows();
        } else {
            return false;
        }
    }

    public function logged($id)
    {
        $query = $this->db->where(array('ID_PENGURUS' => $id))->get('PENGURUS_EM');
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
    public function rekap_awarding()
    {
        return $this->db->query('SELECT `nama`,`kategori`, (SELECT COUNT(`vote`.`nominasi_id`) FROM `vote` WHERE `vote`.`nominasi_id` = `nominasi`.`id`) AS jumlah FROM `nominasi` order by jumlah DESC')->result_array();
    }

    public function loggedNIM($id)
    {
        $query = $this->db->where(array('NIM' => $id))->get('PENGURUS_EM');
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function getRow($table)
    {
        return $this->db->get($table)->num_rows();
    }

    public function getJoinRow($table1, $table2)
    {
        return $this->db->select('*')->from($table1)->join($table2, $table2 . '.id = ' . $table1 . '.id')->get()->num_rows();
    }

    public function selectAllWhere($table, $data)
    {
        $query = $this->db->where($data)->get($table);
        if ($this->db->affected_rows() !== 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function deleteWhere($table, $data)
    {
        $query = $this->db->where($data)->delete($table);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function insertTo($table, $data)
    {
        $query = $this->db->insert($table, $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function updateWhere($id, $table, $data)
    {
        $query = $this->db->where('id_user', $id)->update($table, $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function updateWheres($where, $table, $data)
    {
        $query = $this->db->where($where)->update($table, $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function selectSum($table, $row, $data)
    {
        $query = $this->db->select_sum($row)->where($data)->get($table);
        if ($query) {
            return $query->row();
        }
    }

    public function selectAllLike($table, $data, $like)
    {
        $query = $this->db->where($data)->like($like)->get($table);
        if ($this->db->affected_rows() !== 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function selectAll($table)
    {
        return $this->db->get($table)->result();
    }

    public function selectAllLimit($table, $limit)
    {
        return $this->db->limit($limit)->get($table)->result();
    }

    public function selectAllLimitMember($table)
    {
        return $this->db->limit(60, 60)->get($table)->result();
    }

    public function selectRandAllLimit($table, $limit)
    {
        return $this->db->order_by('id', 'RANDOM')->limit($limit)->get($table)->result();
    }

    public function getAbsensi($id)
    {
        $query = $this->db->select('b.NIM, c.NAMA, a.NAMA_LENGKAP, a.waktu, a.status')->from('absensi_list a')->join('PENGURUS_EM b', 'b.NIM = a.NIM')->join('EM_KEMENTERIAN c', 'c.ID_KEMENTERIAN = b.ID_KEMENTERIAN')->where(array('id_absensi' => $id))->get();
        if ($this->db->affected_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getUser()
    {
        return $this->db->select('a.id, a.nim, a.nama, a.id_role, a.access, b.nama as nama_kementrian')->from('PENGURUS_EM a')->join('role b', 'b.id = a.id_role')->get()->result();
    }

    public function getStaf($where)
    {
        return $this->db->select('a.ID_PENGURUS, a.NIM, a.NAMA_LENGKAP, a.FAKULTAS, a.APRESIASI, a.KESAN, b.NAMA as KEMENTERIAN')->from('PENGURUS_EM a')->join('EM_KEMENTERIAN b', 'b.ID_KEMENTERIAN = a.ID_KEMENTERIAN')
            ->where($where)->get()->result();
    }

    public function getSambat($where)
    {
        $query = $this->db->select('`ID_SAMBATAN`,`BS_SAMBATAN`.`NIM`,`NAMA_LENGKAP`,`JENIS_KELAMIN`,`KONTAK`,`RINGKASAN`,`R_KATEGORI`,`STATUS`,`PROGRES`,`FILE`,`R_TIMESTAMP`,(SELECT BS_KOMENTAR(`ID_SAMBATAN`)) AS KOMENTAR')
            ->from('BS_SAMBATAN')
            ->join('TB_BIODATA', 'BS_SAMBATAN.NIM=TB_BIODATA.NIM')
            ->where($where)
            ->get()->result();
        return $query;
    }
    public function getInfo()
    {
        return $this->db->from('informasi')->order_by('id', 'desc')->get()->result();
    }
}

/* End of file db_model.php */
/* Location: ./application/models/db_model.php */
