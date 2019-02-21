<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('tgl_indo'))
{
	function tgl_indo($tgl)
	{
		$ubah = gmdate($tgl, time()+60*60*8);
		$pecah = explode("-",$ubah);
		$tanggal = $pecah[2];
		$bulan = bulan($pecah[1]);
		$tahun = $pecah[0];
		return $tanggal.' '.$bulan.' '.$tahun;
	}
}


if ( ! function_exists('bulan'))
{
	function bulan($bln)
	{
		switch ($bln)
		{
			case 1:
				return "Januari";
				break;
			case 2:
				return "Februari";
				break;
			case 3:
				return "Maret";
				break;
			case 4:
				return "April";
				break;
			case 5:
				return "Mei";
				break;
			case 6:
				return "Juni";
				break;
			case 7:
				return "Juli";
				break;
			case 8:
				return "Agustus";
				break;
			case 9:
				return "September";
				break;
			case 10:
				return "Oktober";
				break;
			case 11:
				return "November";
				break;
			case 12:
				return "Desember";
				break;
		}
	}
}




if ( ! function_exists('bulan2'))
{
	function bulan2($date)
	{
		$bln	= substr($date,5,2);
		switch ($bln)
		{
			case '01':
				return "Jan";
				break;
			case '02':
				return "Feb";
				break;
			case '03':
				return "Mar";
				break;
			case '04':
				return "Ap";
				break;
			case '05':
				return "Mei";
				break;
			case '06':
				return "Jun";
				break;
			case '07':
				return "Jul";
				break;
			case '08':
				return "Agu";
				break;
			case '09':
				return "Sep";
				break;
			case '10':
				return "Okt";
				break;
			case '11':
				return "Nov";
				break;
			case '12':
				return "Des";
				break;
		}
	}
}


if ( ! function_exists('list_bulan'))
{
	function list_bulan()
	{
		$bln	= array('01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember');
		return  $bln;
	}
}



if ( ! function_exists('tgl'))
{
	function tgl($date)
	{
		$tgl	= substr($date,-2);
		return  $tgl;
	}
}



if ( ! function_exists("bulan_romawi"))
{
	function bulan_romawi($bln)
	{
		switch ($bln)
		{
			case "01":
				return "I";
				break;
			case "02":
				return "II";
				break;
			case "03":
				return "III";
				break;
			case "04":
				return "IV";
				break;
			case "05":
				return "V";
				break;
			case "06":
				return "VI";
				break;
			case "07":
				return "VII";
				break;
			case "08":
				return "VIII";
				break;
			case "09":
				return "IX";
				break;
			case "10":
				return "X";
				break;
			case "11":
				return "XI";
				break;
			case "12":
				return "XII";
				break;
		}
	}
}



if ( ! function_exists('nama_hari'))
{
	function nama_hari($tanggal)
	{
		$ubah = gmdate($tanggal, time()+60*60*8);
		$pecah = explode("-",$ubah);
		$tgl = $pecah[2];
		$bln = $pecah[1];
		$thn = $pecah[0];

		$nama = date("l", mktime(0,0,0,$bln,$tgl,$thn));
		$nama_hari = "";
		if($nama=="Sunday") {$nama_hari="Minggu";}
		else if($nama=="Monday") {$nama_hari="Senin";}
		else if($nama=="Tuesday") {$nama_hari="Selasa";}
		else if($nama=="Wednesday") {$nama_hari="Rabu";}
		else if($nama=="Thursday") {$nama_hari="Kamis";}
		else if($nama=="Friday") {$nama_hari="Jumat";}
		else if($nama=="Saturday") {$nama_hari="Sabtu";}
		return $nama_hari;
	}
}



if ( ! function_exists('nama_hari2'))
{
	function nama_hari2($nama)
	{
		if($nama=="Sunday") {$nama_hari="Minggu";}
		else if($nama=="Monday") {$nama_hari="Senin";}
		else if($nama=="Tuesday") {$nama_hari="Selasa";}
		else if($nama=="Wednesday") {$nama_hari="Rabu";}
		else if($nama=="Thursday") {$nama_hari="Kamis";}
		else if($nama=="Friday") {$nama_hari="Jumat";}
		else if($nama=="Saturday") {$nama_hari="Sabtu";}
		return $nama_hari;
	}
}













if ( ! function_exists('hitung_mundur'))
{
	function hitung_mundur($wkt)
	{
		$waktu=array(	365*24*60*60	=> "tahun",
						30*24*60*60		=> "bulan",
						7*24*60*60		=> "minggu",
						24*60*60		=> "hari",
						60*60			=> "jam",
						60				=> "menit",
						1				=> "detik");

		$hitung = strtotime(gmdate ("Y-m-d H:i:s", time () +60 * 60 * 8))-$wkt;
		$hasil = array();
		if($hitung<5)
		{
			$hasil = 'kurang dari 5 detik yang lalu';
		}
		else
		{
			$stop = 0;
			foreach($waktu as $periode => $satuan)
			{
				if($stop>=6 || ($stop>0 && $periode<60)) break;
				$bagi = floor($hitung/$periode);
				if($bagi > 0)
				{
					$hasil[] = $bagi.' '.$satuan;
					$hitung -= $bagi*$periode;
					$stop++;
				}
				else if($stop>0) $stop++;
			}
			$hasil=implode(' ',$hasil).' yang lalu';
		}
		return $hasil;
	}
}