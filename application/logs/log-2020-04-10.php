<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-04-10 10:08:33 --> ErrorException [ 8 ]: Undefined variable: kehadiren ~ /home/trias/htdocs/jurnal_kelas/application/modules/kurikulum/views/rekap_kehadiran_guru.php [ 36 ]
ERROR - 2020-04-10 10:08:33 --> Severity: Error --> Call to a member function result_array() on a non-object /home/trias/htdocs/jurnal_kelas/application/modules/kurikulum/views/rekap_kehadiran_guru.php 36
ERROR - 2020-04-10 10:09:14 --> ErrorException [ 8 ]: Undefined variable: kehadiren ~ /home/trias/htdocs/jurnal_kelas/application/modules/kurikulum/views/rekap_kehadiran_guru.php [ 36 ]
ERROR - 2020-04-10 10:09:14 --> Severity: Error --> Call to a member function result_array() on a non-object /home/trias/htdocs/jurnal_kelas/application/modules/kurikulum/views/rekap_kehadiran_guru.php 36
ERROR - 2020-04-10 10:09:25 --> ErrorException [ 8 ]: Undefined variable: kehadiran ~ /home/trias/htdocs/jurnal_kelas/application/modules/kurikulum/views/rekap_kehadiran_guru.php [ 36 ]
ERROR - 2020-04-10 10:09:25 --> Severity: Error --> Call to a member function result_array() on a non-object /home/trias/htdocs/jurnal_kelas/application/modules/kurikulum/views/rekap_kehadiran_guru.php 36
ERROR - 2020-04-10 10:10:05 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'GROUP BY a.id' at line 13 - Invalid query: SELECT a.nama_lengkap,
                                      a.nuptk,
                                      COUNT(c.id) AS guru_hadir,
                                      COUNT(d.id) AS guru_kosong,
                                      COUNT(e.id) AS guru_digantikan,
                                      CONCAT(ROUND((COUNT(c.id) * 100) / (COUNT(c.id) + COUNT(d.id) + COUNT(e.id)),0),'%') AS jml
                              FROM pegawai a
                              LEFT JOIN jadwal_mengajar b ON a.id = b.pegawai_id
                              LEFT JOIN jurnal c ON b.id = c.jadwal_mengajar_id AND c.`status`= 'HADIR' AND c.tanggal BETWEEN '2020-04-01' AND '2020-04-30'
                              LEFT JOIN jurnal d ON b.id = d.jadwal_mengajar_id AND d.`status`= 'KOSONG' AND d.tanggal BETWEEN '2020-04-01' AND '2020-04-30'
                              LEFT JOIN jurnal e ON b.id = e.jadwal_mengajar_id AND e.`status`= 'DIGANTIKAN' AND e.tanggal BETWEEN '2020-04-01' AND '2020-04-30'
                              ORDER BY ROUND((COUNT(c.id) * 100) / (COUNT(c.id) + COUNT(d.id) + COUNT(e.id)),0) DESC
                              GROUP BY a.id
ERROR - 2020-04-10 10:10:05 --> ErrorException [ 1 ]: Error Number: 1064 / You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'GROUP BY a.id' at line 13 / SELECT a.nama_lengkap,
                                      a.nuptk,
                                      COUNT(c.id) AS guru_hadir,
                                      COUNT(d.id) AS guru_kosong,
                                      COUNT(e.id) AS guru_digantikan,
                                      CONCAT(ROUND((COUNT(c.id) * 100) / (COUNT(c.id) + COUNT(d.id) + COUNT(e.id)),0),'%') AS jml
                              FROM pegawai a
                              LEFT JOIN jadwal_mengajar b ON a.id = b.pegawai_id
                              LEFT JOIN jurnal c ON b.id = c.jadwal_mengajar_id AND c.`status`= 'HADIR' AND c.tanggal BETWEEN '2020-04-01' AND '2020-04-30'
                              LEFT JOIN jurnal d ON b.id = d.jadwal_mengajar_id AND d.`status`= 'KOSONG' AND d.tanggal BETWEEN '2020-04-01' AND '2020-04-30'
                              LEFT JOIN jurnal e ON b.id = e.jadwal_mengajar_id AND e.`status`= 'DIGANTIKAN' AND e.tanggal BETWEEN '2020-04-01' AND '2020-04-30'
                              ORDER BY ROUND((COUNT(c.id) * 100) / (COUNT(c.id) + COUNT(d.id) + COUNT(e.id)),0) DESC
                              GROUP BY a.id / Filename: modules/kurikulum/controllers/Kurikulum.php / Line Number: 73 ~ /home/trias/htdocs/jurnal_kelas/application/modules/kurikulum/controllers/Kurikulum.php [ 73 ]
ERROR - 2020-04-10 11:04:49 --> ErrorException [ 8 ]: Undefined variable: POST ~ /home/trias/htdocs/jurnal_kelas/application/modules/kurikulum/views/rekap_kehadiran_guru.php [ 48 ]
ERROR - 2020-04-10 11:04:49 --> ErrorException [ 8 ]: Undefined variable: POST ~ /home/trias/htdocs/jurnal_kelas/application/modules/kurikulum/views/rekap_kehadiran_guru.php [ 48 ]
ERROR - 2020-04-10 11:04:49 --> ErrorException [ 8 ]: Undefined variable: POST ~ /home/trias/htdocs/jurnal_kelas/application/modules/kurikulum/views/rekap_kehadiran_guru.php [ 48 ]
ERROR - 2020-04-10 11:04:49 --> ErrorException [ 8 ]: Undefined variable: POST ~ /home/trias/htdocs/jurnal_kelas/application/modules/kurikulum/views/rekap_kehadiran_guru.php [ 48 ]
ERROR - 2020-04-10 11:04:49 --> ErrorException [ 8 ]: Undefined variable: POST ~ /home/trias/htdocs/jurnal_kelas/application/modules/kurikulum/views/rekap_kehadiran_guru.php [ 48 ]
ERROR - 2020-04-10 11:04:49 --> ErrorException [ 8 ]: Undefined variable: POST ~ /home/trias/htdocs/jurnal_kelas/application/modules/kurikulum/views/rekap_kehadiran_guru.php [ 48 ]
ERROR - 2020-04-10 11:04:49 --> ErrorException [ 8 ]: Undefined variable: POST ~ /home/trias/htdocs/jurnal_kelas/application/modules/kurikulum/views/rekap_kehadiran_guru.php [ 48 ]
ERROR - 2020-04-10 11:04:49 --> ErrorException [ 8 ]: Undefined variable: POST ~ /home/trias/htdocs/jurnal_kelas/application/modules/kurikulum/views/rekap_kehadiran_guru.php [ 48 ]
ERROR - 2020-04-10 11:04:49 --> ErrorException [ 8 ]: Undefined variable: POST ~ /home/trias/htdocs/jurnal_kelas/application/modules/kurikulum/views/rekap_kehadiran_guru.php [ 48 ]
ERROR - 2020-04-10 11:04:49 --> ErrorException [ 8 ]: Undefined variable: POST ~ /home/trias/htdocs/jurnal_kelas/application/modules/kurikulum/views/rekap_kehadiran_guru.php [ 48 ]
ERROR - 2020-04-10 11:04:49 --> ErrorException [ 8 ]: Undefined variable: POST ~ /home/trias/htdocs/jurnal_kelas/application/modules/kurikulum/views/rekap_kehadiran_guru.php [ 48 ]
ERROR - 2020-04-10 11:04:49 --> ErrorException [ 8 ]: Undefined variable: POST ~ /home/trias/htdocs/jurnal_kelas/application/modules/kurikulum/views/rekap_kehadiran_guru.php [ 48 ]
ERROR - 2020-04-10 11:04:49 --> ErrorException [ 8 ]: Undefined variable: POST ~ /home/trias/htdocs/jurnal_kelas/application/modules/kurikulum/views/rekap_kehadiran_guru.php [ 48 ]
ERROR - 2020-04-10 11:04:49 --> ErrorException [ 8 ]: Undefined variable: POST ~ /home/trias/htdocs/jurnal_kelas/application/modules/kurikulum/views/rekap_kehadiran_guru.php [ 48 ]
ERROR - 2020-04-10 11:04:49 --> ErrorException [ 8 ]: Undefined variable: POST ~ /home/trias/htdocs/jurnal_kelas/application/modules/kurikulum/views/rekap_kehadiran_guru.php [ 48 ]
ERROR - 2020-04-10 11:04:49 --> ErrorException [ 8 ]: Undefined variable: POST ~ /home/trias/htdocs/jurnal_kelas/application/modules/kurikulum/views/rekap_kehadiran_guru.php [ 48 ]
ERROR - 2020-04-10 11:04:49 --> ErrorException [ 8 ]: Undefined variable: POST ~ /home/trias/htdocs/jurnal_kelas/application/modules/kurikulum/views/rekap_kehadiran_guru.php [ 48 ]
ERROR - 2020-04-10 06:05:22 --> 404 Page Not Found: ../modules/kurikulum/controllers/Kurikulum/MTUvMjAyMC0wNC0wMS8yMDIwLTA0LTMw
ERROR - 2020-04-10 06:05:22 --> ErrorException [ 1 ]: The page you requested was not found. ~  [ 0 ]
ERROR - 2020-04-10 06:14:07 --> ErrorException [ 1 ]: URL yang anda submit memiliki karakter yang tidak diijinkan. ~  [ 0 ]
