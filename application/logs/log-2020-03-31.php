<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-03-31 19:39:35 --> ErrorException [ 2 ]: mysqli::real_connect(): (HY000/1049): Unknown database 'jurnal_kelas' ~ /home/trias/htdocs/jurnal_kelas/system/database/drivers/mysqli/mysqli_driver.php [ 203 ]
ERROR - 2020-03-31 19:39:35 --> Unable to connect to the database
ERROR - 2020-03-31 19:39:35 --> ErrorException [ 1 ]: Tidak dapat terhubung ke server basis data Anda menggunakan pengaturan yang disediakan. / Filename: core/CodeIgniter.php / Line Number: 518 ~ /home/trias/htdocs/jurnal_kelas/application/third_party/MX/Loader.php [ 109 ]
ERROR - 2020-03-31 19:41:45 --> Query error: Table 'jurnal_kelas.ci_session' doesn't exist - Invalid query: SELECT `data`
FROM `ci_session`
WHERE `id` = 'r560timj4lsb63gn6tevnafl7bb96evt'
ERROR - 2020-03-31 19:41:45 --> ErrorException [ 1 ]: Error Number: 1146 / Table 'jurnal_kelas.ci_session' doesn't exist / SELECT `data`
FROM `ci_session`
WHERE `id` = 'r560timj4lsb63gn6tevnafl7bb96evt' / Filename: libraries/Session/drivers/Session_database_driver.php / Line Number: 174 ~ /home/trias/htdocs/jurnal_kelas/application/third_party/MX/Loader.php [ 173 ]
ERROR - 2020-03-31 20:59:15 --> Query error: Table 'jurnal_kelas.settings' doesn't exist - Invalid query: SELECT *
FROM `settings`
WHERE `title` = 'site_is_offline'
ERROR - 2020-03-31 20:59:15 --> ErrorException [ 1 ]: Error Number: 1146 / Table 'jurnal_kelas.settings' doesn't exist / SELECT *
FROM `settings`
WHERE `title` = 'site_is_offline' / Filename: helpers/libs_helper.php / Line Number: 50 ~ /home/trias/htdocs/jurnal_kelas/application/helpers/libs_helper.php [ 50 ]
ERROR - 2020-03-31 21:02:15 --> ErrorException [ 1 ]: Unable to load the requested file: helpers/userlog_helper.php ~ /home/trias/htdocs/jurnal_kelas/application/third_party/MX/Loader.php [ 123 ]
