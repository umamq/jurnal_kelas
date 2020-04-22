<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-04-15 00:40:07 --> 404 Page Not Found: ../modules/kurikulum/controllers/Kurikulum/rekap_jurnal_kelas
ERROR - 2020-04-15 00:40:07 --> ErrorException [ 1 ]: The page you requested was not found. ~  [ 0 ]
ERROR - 2020-04-15 05:41:46 --> ErrorException [ 2 ]: include(rekap_jurnal_kelas.php): failed to open stream: No such file or directory ~ /home/trias/htdocs/jurnal_kelas/application/modules/kurikulum/views/master_page.php [ 290 ]
ERROR - 2020-04-15 05:41:46 --> ErrorException [ 2 ]: include(): Failed opening 'rekap_jurnal_kelas.php' for inclusion (include_path='.:/opt/lampp/lib/php') ~ /home/trias/htdocs/jurnal_kelas/application/modules/kurikulum/views/master_page.php [ 290 ]
ERROR - 2020-04-15 06:42:24 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 10 - Invalid query: SELECT b.hari, b.jam, 
                                               c.nama AS pelajaran, 
                                               d.nama_lengkap AS nama_guru, 
                                               a.`status`,
                                               a.topik
                                        FROM jurnal a
                                        LEFT JOIN jadwal_mengajar b ON a.jadwal_mengajar_id = b.id 
                                        LEFT JOIN matapelajaran c ON b.matapelajaran_id = c.id
                                        LEFT JOIN pegawai d ON b.pegawai_id = d.id
                                        WHERE (a.tanggal BETWEEN '2020-04-01' AND '2020-04-30') AND  b.kelas_id = 
ERROR - 2020-04-15 06:42:24 --> ErrorException [ 1 ]: Error Number: 1064 / You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 10 / SELECT b.hari, b.jam, 
                                               c.nama AS pelajaran, 
                                               d.nama_lengkap AS nama_guru, 
                                               a.`status`,
                                               a.topik
                                        FROM jurnal a
                                        LEFT JOIN jadwal_mengajar b ON a.jadwal_mengajar_id = b.id 
                                        LEFT JOIN matapelajaran c ON b.matapelajaran_id = c.id
                                        LEFT JOIN pegawai d ON b.pegawai_id = d.id
                                        WHERE (a.tanggal BETWEEN '2020-04-01' AND '2020-04-30') AND  b.kelas_id =  / Filename: modules/kurikulum/controllers/Kurikulum.php / Line Number: 92 ~ /home/trias/htdocs/jurnal_kelas/application/modules/kurikulum/controllers/Kurikulum.php [ 92 ]
ERROR - 2020-04-15 06:43:25 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 10 - Invalid query: SELECT b.hari, b.jam, 
                                               c.nama AS pelajaran, 
                                               d.nama_lengkap AS nama_guru, 
                                               a.`status`,
                                               a.topik
                                        FROM jurnal a
                                        LEFT JOIN jadwal_mengajar b ON a.jadwal_mengajar_id = b.id 
                                        LEFT JOIN matapelajaran c ON b.matapelajaran_id = c.id
                                        LEFT JOIN pegawai d ON b.pegawai_id = d.id
                                        WHERE (a.tanggal BETWEEN '2020-04-01' AND '2020-04-30') AND  b.kelas_id = 
ERROR - 2020-04-15 06:43:25 --> ErrorException [ 1 ]: Error Number: 1064 / You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 10 / SELECT b.hari, b.jam, 
                                               c.nama AS pelajaran, 
                                               d.nama_lengkap AS nama_guru, 
                                               a.`status`,
                                               a.topik
                                        FROM jurnal a
                                        LEFT JOIN jadwal_mengajar b ON a.jadwal_mengajar_id = b.id 
                                        LEFT JOIN matapelajaran c ON b.matapelajaran_id = c.id
                                        LEFT JOIN pegawai d ON b.pegawai_id = d.id
                                        WHERE (a.tanggal BETWEEN '2020-04-01' AND '2020-04-30') AND  b.kelas_id =  / Filename: modules/kurikulum/controllers/Kurikulum.php / Line Number: 92 ~ /home/trias/htdocs/jurnal_kelas/application/modules/kurikulum/controllers/Kurikulum.php [ 92 ]
ERROR - 2020-04-15 06:43:42 --> ErrorException [ 8 ]: Undefined variable: jurnal ~ /home/trias/htdocs/jurnal_kelas/application/modules/kurikulum/views/rekap_jurnal_kelas.php [ 44 ]
ERROR - 2020-04-15 06:43:42 --> Severity: Error --> Call to a member function result_array() on a non-object /home/trias/htdocs/jurnal_kelas/application/modules/kurikulum/views/rekap_jurnal_kelas.php 44
ERROR - 2020-04-15 06:53:03 --> ErrorException [ 8 ]: Undefined variable: jurnal ~ /home/trias/htdocs/jurnal_kelas/application/modules/kurikulum/views/rekap_jurnal_kelas.php [ 45 ]
ERROR - 2020-04-15 06:53:03 --> Severity: Error --> Call to a member function result_array() on a non-object /home/trias/htdocs/jurnal_kelas/application/modules/kurikulum/views/rekap_jurnal_kelas.php 45
