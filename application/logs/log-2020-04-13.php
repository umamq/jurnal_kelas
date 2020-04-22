<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-04-13 17:12:56 --> 404 Page Not Found: ../modules/kurikulum/controllers/Kurikulum/detailkehadiran
ERROR - 2020-04-13 17:12:56 --> ErrorException [ 1 ]: The page you requested was not found. ~  [ 0 ]
ERROR - 2020-04-13 22:13:37 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '/SELECT a.id AS pegawai_id,
                                      a.nama_lengkap' at line 1 - Invalid query: /SELECT a.id AS pegawai_id,
                                      a.nama_lengkap,
                                      a.nuptk,
                                      f.nama AS nama_matapelajaran,
                                      COUNT(c.id) AS guru_hadir,
                                      COUNT(d.id) AS guru_kosong,
                                      COUNT(e.id) AS guru_digantikan,
                                      CONCAT(ROUND((COUNT(c.id) * 100) / (COUNT(c.id) + COUNT(d.id) + COUNT(e.id)),0),'%') AS jml
                              FROM pegawai a
                              LEFT JOIN jadwal_mengajar b ON a.id = b.pegawai_id
                              LEFT JOIN jurnal c ON b.id = c.jadwal_mengajar_id AND c.`status`= 'HADIR' AND c.tanggal BETWEEN '2020-04-01' AND '2020-04-30'
                              LEFT JOIN jurnal d ON b.id = d.jadwal_mengajar_id AND d.`status`= 'KOSONG' AND d.tanggal BETWEEN '2020-04-01' AND '2020-04-30'
                              LEFT JOIN jurnal e ON b.id = e.jadwal_mengajar_id AND e.`status`= 'DIGANTIKAN' AND e.tanggal BETWEEN '2020-04-01' AND '2020-04-30'                              
                              LEFT JOIN matapelajaran f ON b.matapelajaran_id = f.id
                              WHERE a.id = 15
                              GROUP BY a.id
                              ORDER BY ROUND((COUNT(c.id) * 100) / (COUNT(c.id) + COUNT(d.id) + COUNT(e.id)),0) DESC, a.nama_lengkap ASC
ERROR - 2020-04-13 22:13:37 --> ErrorException [ 1 ]: Error Number: 1064 / You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '/SELECT a.id AS pegawai_id,
                                      a.nama_lengkap' at line 1 / /SELECT a.id AS pegawai_id,
                                      a.nama_lengkap,
                                      a.nuptk,
                                      f.nama AS nama_matapelajaran,
                                      COUNT(c.id) AS guru_hadir,
                                      COUNT(d.id) AS guru_kosong,
                                      COUNT(e.id) AS guru_digantikan,
                                      CONCAT(ROUND((COUNT(c.id) * 100) / (COUNT(c.id) + COUNT(d.id) + COUNT(e.id)),0),'%') AS jml
                              FROM pegawai a
                              LEFT JOIN jadwal_mengajar b ON a.id = b.pegawai_id
                              LEFT JOIN jurnal c ON b.id = c.jadwal_mengajar_id AND c.`status`= 'HADIR' AND c.tanggal BETWEEN '2020-04-01' AND '2020-04-30'
                              LEFT JOIN jurnal d ON b.id = d.jadwal_mengajar_id AND d.`status`= 'KOSONG' AND d.tanggal BETWEEN '2020-04-01' AND '2020-04-30'
                              LEFT JOIN jurnal e ON b.id = e.jadwal_mengajar_id AND e.`status`= 'DIGANTIKAN' AND e.tanggal BETWEEN '2020-04-01' AND '2020-04-30'                              
                              LEFT JOIN matapelajaran f ON b.matapelajaran_id = f.id
                              WHERE a.id = 15
                              GROUP BY a.id
                              ORDER BY ROUND((COUNT(c.id) * 100) / (COUNT(c.id) + COUNT(d.id) + COUNT(e.id)),0) DESC, a.nama_lengkap ASC / Filename: modules/kurikulum/controllers/Kurikulum.php / Line Number: 76 ~ /home/trias/htdocs/jurnal_kelas/application/modules/kurikulum/controllers/Kurikulum.php [ 76 ]
ERROR - 2020-04-13 22:17:17 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '/SELECT a.id AS pegawai_id,
                                      a.nama_lengkap' at line 1 - Invalid query: /SELECT a.id AS pegawai_id,
                                      a.nama_lengkap,
                                      a.nuptk,
                                      f.nama AS nama_matapelajaran,
                                      COUNT(c.id) AS guru_hadir,
                                      COUNT(d.id) AS guru_kosong,
                                      COUNT(e.id) AS guru_digantikan,
                                      CONCAT(ROUND((COUNT(c.id) * 100) / (COUNT(c.id) + COUNT(d.id) + COUNT(e.id)),0),'%') AS jml
                              FROM pegawai a
                              LEFT JOIN jadwal_mengajar b ON a.id = b.pegawai_id
                              LEFT JOIN jurnal c ON b.id = c.jadwal_mengajar_id AND c.`status`= 'HADIR' AND c.tanggal BETWEEN '2020-04-01' AND '2020-04-30'
                              LEFT JOIN jurnal d ON b.id = d.jadwal_mengajar_id AND d.`status`= 'KOSONG' AND d.tanggal BETWEEN '2020-04-01' AND '2020-04-30'
                              LEFT JOIN jurnal e ON b.id = e.jadwal_mengajar_id AND e.`status`= 'DIGANTIKAN' AND e.tanggal BETWEEN '2020-04-01' AND '2020-04-30'                              
                              LEFT JOIN matapelajaran f ON b.matapelajaran_id = f.id
                              WHERE a.id = 4
                              GROUP BY a.id
                              ORDER BY ROUND((COUNT(c.id) * 100) / (COUNT(c.id) + COUNT(d.id) + COUNT(e.id)),0) DESC, a.nama_lengkap ASC
ERROR - 2020-04-13 22:17:17 --> ErrorException [ 1 ]: Error Number: 1064 / You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '/SELECT a.id AS pegawai_id,
                                      a.nama_lengkap' at line 1 / /SELECT a.id AS pegawai_id,
                                      a.nama_lengkap,
                                      a.nuptk,
                                      f.nama AS nama_matapelajaran,
                                      COUNT(c.id) AS guru_hadir,
                                      COUNT(d.id) AS guru_kosong,
                                      COUNT(e.id) AS guru_digantikan,
                                      CONCAT(ROUND((COUNT(c.id) * 100) / (COUNT(c.id) + COUNT(d.id) + COUNT(e.id)),0),'%') AS jml
                              FROM pegawai a
                              LEFT JOIN jadwal_mengajar b ON a.id = b.pegawai_id
                              LEFT JOIN jurnal c ON b.id = c.jadwal_mengajar_id AND c.`status`= 'HADIR' AND c.tanggal BETWEEN '2020-04-01' AND '2020-04-30'
                              LEFT JOIN jurnal d ON b.id = d.jadwal_mengajar_id AND d.`status`= 'KOSONG' AND d.tanggal BETWEEN '2020-04-01' AND '2020-04-30'
                              LEFT JOIN jurnal e ON b.id = e.jadwal_mengajar_id AND e.`status`= 'DIGANTIKAN' AND e.tanggal BETWEEN '2020-04-01' AND '2020-04-30'                              
                              LEFT JOIN matapelajaran f ON b.matapelajaran_id = f.id
                              WHERE a.id = 4
                              GROUP BY a.id
                              ORDER BY ROUND((COUNT(c.id) * 100) / (COUNT(c.id) + COUNT(d.id) + COUNT(e.id)),0) DESC, a.nama_lengkap ASC / Filename: modules/kurikulum/controllers/Kurikulum.php / Line Number: 76 ~ /home/trias/htdocs/jurnal_kelas/application/modules/kurikulum/controllers/Kurikulum.php [ 76 ]
ERROR - 2020-04-13 22:18:14 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '/SELECT a.id AS pegawai_id,
                                      a.nama_lengkap' at line 1 - Invalid query: /SELECT a.id AS pegawai_id,
                                      a.nama_lengkap,
                                      a.nuptk,
                                      f.nama AS nama_matapelajaran,
                                      COUNT(c.id) AS guru_hadir,
                                      COUNT(d.id) AS guru_kosong,
                                      COUNT(e.id) AS guru_digantikan,
                                      CONCAT(ROUND((COUNT(c.id) * 100) / (COUNT(c.id) + COUNT(d.id) + COUNT(e.id)),0),'%') AS jml
                              FROM pegawai a
                              LEFT JOIN jadwal_mengajar b ON a.id = b.pegawai_id
                              LEFT JOIN jurnal c ON b.id = c.jadwal_mengajar_id AND c.`status`= 'HADIR' AND c.tanggal BETWEEN '2020-04-01' AND '2020-04-30'
                              LEFT JOIN jurnal d ON b.id = d.jadwal_mengajar_id AND d.`status`= 'KOSONG' AND d.tanggal BETWEEN '2020-04-01' AND '2020-04-30'
                              LEFT JOIN jurnal e ON b.id = e.jadwal_mengajar_id AND e.`status`= 'DIGANTIKAN' AND e.tanggal BETWEEN '2020-04-01' AND '2020-04-30'                              
                              LEFT JOIN matapelajaran f ON b.matapelajaran_id = f.id
                              WHERE a.id = 6
                              GROUP BY a.id
                              ORDER BY ROUND((COUNT(c.id) * 100) / (COUNT(c.id) + COUNT(d.id) + COUNT(e.id)),0) DESC, a.nama_lengkap ASC
ERROR - 2020-04-13 22:18:14 --> ErrorException [ 1 ]: Error Number: 1064 / You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '/SELECT a.id AS pegawai_id,
                                      a.nama_lengkap' at line 1 / /SELECT a.id AS pegawai_id,
                                      a.nama_lengkap,
                                      a.nuptk,
                                      f.nama AS nama_matapelajaran,
                                      COUNT(c.id) AS guru_hadir,
                                      COUNT(d.id) AS guru_kosong,
                                      COUNT(e.id) AS guru_digantikan,
                                      CONCAT(ROUND((COUNT(c.id) * 100) / (COUNT(c.id) + COUNT(d.id) + COUNT(e.id)),0),'%') AS jml
                              FROM pegawai a
                              LEFT JOIN jadwal_mengajar b ON a.id = b.pegawai_id
                              LEFT JOIN jurnal c ON b.id = c.jadwal_mengajar_id AND c.`status`= 'HADIR' AND c.tanggal BETWEEN '2020-04-01' AND '2020-04-30'
                              LEFT JOIN jurnal d ON b.id = d.jadwal_mengajar_id AND d.`status`= 'KOSONG' AND d.tanggal BETWEEN '2020-04-01' AND '2020-04-30'
                              LEFT JOIN jurnal e ON b.id = e.jadwal_mengajar_id AND e.`status`= 'DIGANTIKAN' AND e.tanggal BETWEEN '2020-04-01' AND '2020-04-30'                              
                              LEFT JOIN matapelajaran f ON b.matapelajaran_id = f.id
                              WHERE a.id = 6
                              GROUP BY a.id
                              ORDER BY ROUND((COUNT(c.id) * 100) / (COUNT(c.id) + COUNT(d.id) + COUNT(e.id)),0) DESC, a.nama_lengkap ASC / Filename: modules/kurikulum/controllers/Kurikulum.php / Line Number: 76 ~ /home/trias/htdocs/jurnal_kelas/application/modules/kurikulum/controllers/Kurikulum.php [ 76 ]
ERROR - 2020-04-13 22:37:17 --> ErrorException [ 8 ]: Undefined variable: row ~ /home/trias/htdocs/jurnal_kelas/application/modules/kurikulum/views/ajax_kehadiran_guru.php [ 10 ]
ERROR - 2020-04-13 22:37:17 --> ErrorException [ 8 ]: Undefined variable: row ~ /home/trias/htdocs/jurnal_kelas/application/modules/kurikulum/views/ajax_kehadiran_guru.php [ 11 ]
ERROR - 2020-04-13 22:37:45 --> ErrorException [ 8 ]: Undefined variable: row ~ /home/trias/htdocs/jurnal_kelas/application/modules/kurikulum/views/ajax_kehadiran_guru.php [ 10 ]
ERROR - 2020-04-13 22:37:45 --> ErrorException [ 8 ]: Undefined variable: row ~ /home/trias/htdocs/jurnal_kelas/application/modules/kurikulum/views/ajax_kehadiran_guru.php [ 11 ]
ERROR - 2020-04-13 18:18:51 --> 404 Page Not Found: ../modules/kurikulum/controllers/Kurikulum/rekap_harian
ERROR - 2020-04-13 18:18:51 --> ErrorException [ 1 ]: The page you requested was not found. ~  [ 0 ]
