<?php
	class M_Data_Master extends CI_Model {
		function __construct(){
			parent::__construct();
			$this->load->database();
		}
		public function getDepartement()
		{
			$sql = "SELECT nm_dept FROM dbhrm.dbo.tbdepartement";
			return $this->db->query($sql);
		}
		public function getJabatan()
		{
			$sql = "SELECT jabatan FROM dbhrm.dbo.tbjabatan";
			return $this->db->query($sql);
		}
		public function getDataUserLogin($search)
		{
			$sql = "SELECT
						a.*,
						b.namapeg,
						b.departemen,
						b.divisi,
						b.seksi,
						b.jabatan,
						b.jkelamin
					FROM
						MTG_USER a
					LEFT JOIN 
						dbhrm.dbo.tbPegawai b ON
						a.NIK = b.nik
					WHERE
						[LEVEL] > 0 AND
						namapeg LIKE '%$search%' OR
						a.NIK LIKE '%$search%' AND
						[LEVEL] >0";
			return $this->db->query($sql);
		}
		public function getKaryawanMaintenance($cari)
		{
			$sql = "SELECT
						Q1.*
					FROM
					(
						SELECT
							nik,
							namapeg
						FROM
							dbhrm.dbo.tbPegawai
						WHERE
							Departemen = 'Maintenance' AND
							status_aktif = 'AKTIF'
					)Q1 
					LEFT JOIN
					(
						SELECT
							NIK
						FROM
							MTG_USER
						WHERE
							STATUS = 'AKTIF'
					)Q2 ON Q1.nik = Q2.NIK
					WHERE
						Q2.NIK IS NULL AND
						Q1.nik LIKE '%$cari%'
						OR 
						namapeg LIKE '%$cari%' AND
						Q2.NIK IS NULL";
			return $this->db->query($sql);
		}
		public function tambahAkun($nik)
		{
			date_default_timezone_set('Asia/Jakarta');
            $tanggal = date('Y-m-d H:i:s');
            $user = $this->session->userdata("NIK");
			$getData = $this->db->query("SELECT jabatan, jkelamin FROM dbhrm.dbo.tbPegawai WHERE nik = '$nik'");
			$level = null;
			$avatar = 'male1.png';
			foreach ($getData->result() as $key) {
				$level = $key->jabatan == 'Kepala Bagian'?1:2;
				$avatar = $key->jkelamin == 'L'?'male1.png':'female1.png';
			}
			$sql = "INSERT INTO MTG_USER VALUES('$nik','123','$level','AKTIF','$avatar','$tanggal','$user')";
			return $this->db->query($sql);
		}
		public function ubahStatusAkun($nik, $status)
		{
			$sql = "UPDATE MTG_USER SET STATUS = '$status' WHERE NIK = '$nik'";
			$this->db->query($sql);
		}
		public function getDataTooling($filKategori, $filJenisProses, $filJenisTool, $filSearch)
		{
			$sql = "SELECT TOP 100
						*
					FROM
					(
						SELECT
							reg_date,
							tool_kategori,
							CASE 
								WHEN tool_kategori = 'Single' THEN prosesname1
								ELSE prosesname2
							END AS prosesname,
							jenisproses,
							CASE 
								WHEN tool_kategori = 'Single' THEN b.jenistool
								ELSE sub_kategori
							END AS jenistool,
							CASE 
								WHEN tool_kategori = 'Single' THEN asetno1
								ELSE asetno2
							END AS asetno,
							CASE 
								WHEN tool_kategori = 'Single' THEN partname1
								ELSE partname2
							END AS partname,
							CASE 
								WHEN tool_kategori = 'Single' THEN partno1
								ELSE partno2
							END AS partno,
							CASE 
								WHEN tool_kategori = 'Single' THEN cav1
								ELSE cav2
							END AS cav,
							CASE 
								WHEN tool_kategori = 'Single' THEN maker1
								ELSE maker2
							END AS maker,
							CASE 
								WHEN tool_kategori = 'Single' THEN periode1
								ELSE periode2
							END AS periode,
							CASE 
								WHEN tool_kategori = 'Single' THEN status1
								ELSE status2
							END AS status,
							JenisTool2,
							CASE 
								WHEN tool_kategori = 'Single' THEN OrderStatus1
								ELSE OrderStatus2
							END AS OrderStatus,
							StatusTooling
						FROM
							tb_ToolRegistrasiMst a
						LEFT JOIN tb_ToolJenis b
						ON a.jenistool = b.kode
						WHERE
							tool_kategori LIKE '%$filKategori%' AND
							prosesname1 LIKE '%$filJenisProses%' AND
							a.jenistool LIKE '%$filJenisTool%'
					)Q1 
					WHERE
						asetno LIKE '%$filSearch%' OR
						partname LIKE '%$filSearch%' OR
						partno LIKE '%$filSearch%' OR
						maker LIKE '%$filSearch%'
					ORDER BY
					reg_date DESC";
		return $this->db->query($sql);
		}
		public function getJenisTool()
		{
			$sql = "SELECT
						kode,
						jenistool
					FROM
						tb_ToolJenis 
					ORDER BY
						jenistool ASC";
			return $this->db->query($sql);
		}
		public function getJenisProses()
		{
			$sql = "SELECT
						nourut,
						proses
					FROM
						[dbo].[tb_ToolPengkodean]
					ORDER BY nourut ASC";
			return $this->db->query($sql);
		}
		public function getArea()
		{
			$sql = "SELECT KdArea, NmArea,Kategori FROM dbhrm.dbo.tbArea WHERE StatusAktif='Y'";
			return $this->db->query($sql);
		}
		public function getSupplier()
		{
			$sql = "SELECT
						NoSupplier,
						CompanyName,
						Country,
						AddressOffice,
						TypeOfCompany,
						MainProduct
					FROM
						dbhrm.[dbo].[PC_TSupplier]
					ORDER BY NoSupplier ASC";
			return $this->db->query($sql);
		}
	}