<?php
	class M_Auth extends CI_Model {
		function __construct(){
			parent::__construct();
			$this->load->database();
		}
		public function login($nik, $password)
		{
			$sql = "SELECT
						Q1.*,
						NAMA,
						JABATAN,
						DEPARTEMEN,
						DIVISI,
						SEKSI,
						JENIS_KELAMIN
					FROM
					(
						SELECT
							NIK,
							[LEVEL],
							STATUS,
							AVATAR
						FROM
							MTG_USER
						WHERE
							NIK = '$nik' AND
							PASSWORD = '$password' AND
							STATUS = 'AKTIF'
					)Q1
					LEFT JOIN
					(
						SELECT
							nik,
							namapeg AS NAMA,
							jabatan AS JABATAN,
							departemen AS DEPARTEMEN,
							divisi AS DIVISI,
							seksi AS SEKSI,
							jKelamin AS JENIS_KELAMIN
						FROM
						dbhrm.dbo.tbPegawai
					)Q2 ON Q1.NIK = Q2.nik";
			return $this->db->query($sql);
		}
		public function getDataAvatar()
		{
			$jk = $this->session->userdata("JENIS_KELAMIN");
			$sql = "SELECT * FROM dbhrm.dbo.HRGA_AVATAR WHERE JENIS_KELAMIN = '$jk'";
			return $this->db->query($sql);
		}
		public function view_akun()
		{
			$nik = $this->session->userdata("NIK");
			$sql = "SELECT
						a.NIK,
						a.PASSWORD,
						b.namapeg,
						b.jabatan,
						b.departemen,
					CASE
							WHEN Subdepartemen2 IS NULL 
							OR Subdepartemen2 = '' THEN
								Subdepartemen1 ELSE Subdepartemen1 + ', ' + Subdepartemen2 
								END AS subdepartemen,
							b.divisi,
							b.seksi,
							a.AVATAR,
							c.FOTO 
						FROM
							MTG_USER a
							LEFT JOIN dbhrm.dbo.tbPegawai b ON a.NIK = b.nik
							LEFT JOIN dbhrm.dbo.HRGA_AVATAR c ON a.avatar = c.avatar 
					WHERE
						a.NIK = '$nik'";
			return $this->db->query($sql);
		}
		public function updateAvatar($inputAvatar)
		{
			$nik = $this->session->userdata("NIK");
			$sql = "UPDATE MTG_USER SET AVATAR = '$inputAvatar' WHERE NIK='$nik'";
			return $this->db->query($sql);
		}
		public function updatePassword($inputPassword)
		{
			$nik = $this->session->userdata("NIK");
			$sql = "UPDATE MTG_USER SET PASSWORD = '$inputPassword' WHERE NIK='$nik'";
			return $this->db->query($sql);	
		}
	}