[0;1;32m●[0m mariadb.service - MariaDB 10.11.13 database server
     Loaded: loaded (]8;;file://srv1241757/usr/lib/systemd/system/mariadb.service/usr/lib/systemd/system/mariadb.service]8;;; [0;1;32menabled[0m; preset: [0;1;32menabled[0m)
     Active: [0;1;32mactive (running)[0m since Sat 2026-01-03 04:51:34 UTC; 6min ago
       Docs: ]8;;man:mariadbd(8)man:mariadbd(8)]8;;
             ]8;;https://mariadb.com/kb/en/library/systemd/https://mariadb.com/kb/en/library/systemd/]8;;
   Main PID: 38307 (mariadbd)
     Status: "[0;1;36mTaking your SQL requests now...[0m"
      Tasks: 11 (limit: 126357)
     Memory: 83.9M (peak: 84.5M)
        CPU: 888ms
     CGroup: /system.slice/mariadb.service
             └─[0;38;5;245m38307 /usr/sbin/mariadbd[0m

Jan 03 04:51:34 srv1241757 mariadbd[38307]: 2026-01-03  4:51:34 0 [Note] InnoDB: Buffer pool(s) load completed at 260103  4:51:34
Jan 03 04:51:34 srv1241757 mariadbd[38307]: 2026-01-03  4:51:34 0 [Note] Server socket created on IP: '127.0.0.1'.
Jan 03 04:51:34 srv1241757 mariadbd[38307]: 2026-01-03  4:51:34 0 [Note] /usr/sbin/mariadbd: ready for connections.
Jan 03 04:51:34 srv1241757 mariadbd[38307]: Version: '10.11.13-MariaDB-0ubuntu0.24.04.1'  socket: '/run/mysqld/mysqld.sock'  port: 3306  Ubuntu 24.04
Jan 03 04:51:34 srv1241757 systemd[1]: Started mariadb.service - MariaDB 10.11.13 database server.
Jan 03 04:51:34 srv1241757 /etc/mysql/debian-start[38325]: Upgrading MariaDB tables if necessary.
Jan 03 04:51:34 srv1241757 /etc/mysql/debian-start[38340]: Triggering myisam-recover for all MyISAM tables and aria-recover for all Aria tables
Jan 03 04:53:10 srv1241757 mariadbd[38307]: 2026-01-03  4:53:10 32 [Warning] Access denied for user 'phpmyadmin'@'localhost'
Jan 03 04:53:10 srv1241757 mariadbd[38307]: 2026-01-03  4:53:10 34 [Warning] Access denied for user 'phpmyadmin'@'localhost'
Jan 03 04:55:16 srv1241757 mariadbd[38307]: 2026-01-03  4:55:16 45 [Warning] Access denied for user 'admin'@'localhost' (using password: YES)
