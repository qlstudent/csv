# custom urls for xmlsitemap 

My current understanding is 

it is cheaper to just 
  1. drop the table completely 
  2. create the table 
  3. load data from csv 
  4. let xmlsitemap module rebuild the module 

```SQL 

MariaDB [studentdb]> CREATE TABLE studentdb.xmlsitemap ( `id` varchar(32) NOT NULL DEFAULT '' COMMENT 'Primary key with type. a unique id for the item.', `type` varchar(32) NOT NULL DEFAULT '' COMMENT 'Primary key with id. the type of item (e.g. node, user, etc.).', `subtype` varchar(128) NOT NULL DEFAULT '' COMMENT 'A sub-type identifier for the link (node type, menu name, term VID, etc.).', `loc` varchar(255) NOT NULL DEFAULT '' COMMENT 'The URL to the item relative to the Drupal path.', `language` varchar(12) NOT NULL DEFAULT '' COMMENT 'The languages.language of this link or an empty string if it is language-neutral.', `access` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'A boolean that represents if the item is viewable by the anonymous user. This field is useful to store the result of node_access() so we can retain changefreq and priority_override information.', `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'An integer that represents if the item is included in the sitemap.', `status_override` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'A boolean that if TRUE means that the status field has been overridden from its default value.', `lastmod` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'The UNIX timestamp of last modification of the item.', `priority` float DEFAULT NULL COMMENT 'The priority of this URL relative to other URLs on your site. Valid values range from 0.0 to 1.0.', `priority_override` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'A boolean that if TRUE means that the priority field has been overridden from its default value.', `changefreq` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'The average time in seconds between changes of this item.', `changecount` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'The number of times this item has been changed. Used to help calculate the next changefreq value.', PRIMARY KEY (`id`,`type`,`language`), KEY `loc` (`loc`(191)), KEY `access_status_loc` (`access`,`status`,`loc`(191)), KEY `type_subtype` (`type`,`subtype`) ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='The base table for xmlsitemap links.' ;
--------------
CREATE TABLE studentdb.xmlsitemap ( `id` varchar(32) NOT NULL DEFAULT '' COMMENT 'Primary key with type. a unique id for the item.', `type` varchar(32) NOT NULL DEFAULT '' COMMENT 'Primary key with id. the type of item (e.g. node, user, etc.).', `subtype` varchar(128) NOT NULL DEFAULT '' COMMENT 'A sub-type identifier for the link (node type, menu name, term VID, etc.).', `loc` varchar(255) NOT NULL DEFAULT '' COMMENT 'The URL to the item relative to the Drupal path.', `language` varchar(12) NOT NULL DEFAULT '' COMMENT 'The languages.language of this link or an empty string if it is language-neutral.', `access` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'A boolean that represents if the item is viewable by the anonymous user. This field is useful to store the result of node_access() so we can retain changefreq and priority_override information.', `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'An integer that represents if the item is included in the sitemap.', `status_override` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'A boolean that if TRUE means that the status field has been overridden from its default value.', `lastmod` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'The UNIX timestamp of last modification of the item.', `priority` float DEFAULT NULL COMMENT 'The priority of this URL relative to other URLs on your site. Valid values range from 0.0 to 1.0.', `priority_override` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'A boolean that if TRUE means that the priority field has been overridden from its default value.', `changefreq` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'The average time in seconds between changes of this item.', `changecount` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'The number of times this item has been changed. Used to help calculate the next changefreq value.', PRIMARY KEY (`id`,`type`,`language`), KEY `loc` (`loc`(191)), KEY `access_status_loc` (`access`,`status`,`loc`(191)), KEY `type_subtype` (`type`,`subtype`) ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='The base table for xmlsitemap links.'
--------------

Query OK, 0 rows affected (0.42 sec)

MariaDB [studentdb]> drop table xmlsitemap;CREATE TABLE studentdb.xmlsitemap ( `id` varchar(32) NOT NULL DEFAULT '' COMMENT 'Primary key with type. a unique id for the item.', `type` varchar(32) NOT NULL DEFAULT '' COMMENT 'Primary key with id. the type of item (e.g. node, user, etc.).', `subtype` varchar(128) NOT NULL DEFAULT '' COMMENT 'A sub-type identifier for the link (node type, menu name, term VID, etc.).', `loc` varchar(255) NOT NULL DEFAULT '' COMMENT 'The URL to the item relative to the Drupal path.', `language` varchar(12) NOT NULL DEFAULT '' COMMENT 'The languages.language of this link or an empty string if it is language-neutral.', `access` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'A boolean that represents if the item is viewable by the anonymous user. This field is useful to store the result of node_access() so we can retain changefreq and priority_override information.', `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'An integer that represents if the item is included in the sitemap.', `status_override` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'A boolean that if TRUE means that the status field has been overridden from its default value.', `lastmod` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'The UNIX timestamp of last modification of the item.', `priority` float DEFAULT NULL COMMENT 'The priority of this URL relative to other URLs on your site. Valid values range from 0.0 to 1.0.', `priority_override` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'A boolean that if TRUE means that the priority field has been overridden from its default value.', `changefreq` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'The average time in seconds between changes of this item.', `changecount` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'The number of times this item has been changed. Used to help calculate the next changefreq value.', PRIMARY KEY (`id`,`type`,`language`), KEY `loc` (`loc`(191)), KEY `access_status_loc` (`access`,`status`,`loc`(191)), KEY `type_subtype` (`type`,`subtype`) ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='The base table for xmlsitemap links.' ;LOAD DATA LOCAL INFILE '/Users/student/src/csv/sitemap.csv' INTO TABLE studentdb.xmlsitemap FIELDS TERMINATED BY ',' ignore 1 lines;
--------------
drop table xmlsitemap
--------------

Query OK, 0 rows affected (0.01 sec)

--------------
CREATE TABLE studentdb.xmlsitemap ( `id` varchar(32) NOT NULL DEFAULT '' COMMENT 'Primary key with type. a unique id for the item.', `type` varchar(32) NOT NULL DEFAULT '' COMMENT 'Primary key with id. the type of item (e.g. node, user, etc.).', `subtype` varchar(128) NOT NULL DEFAULT '' COMMENT 'A sub-type identifier for the link (node type, menu name, term VID, etc.).', `loc` varchar(255) NOT NULL DEFAULT '' COMMENT 'The URL to the item relative to the Drupal path.', `language` varchar(12) NOT NULL DEFAULT '' COMMENT 'The languages.language of this link or an empty string if it is language-neutral.', `access` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'A boolean that represents if the item is viewable by the anonymous user. This field is useful to store the result of node_access() so we can retain changefreq and priority_override information.', `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'An integer that represents if the item is included in the sitemap.', `status_override` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'A boolean that if TRUE means that the status field has been overridden from its default value.', `lastmod` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'The UNIX timestamp of last modification of the item.', `priority` float DEFAULT NULL COMMENT 'The priority of this URL relative to other URLs on your site. Valid values range from 0.0 to 1.0.', `priority_override` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'A boolean that if TRUE means that the priority field has been overridden from its default value.', `changefreq` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'The average time in seconds between changes of this item.', `changecount` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'The number of times this item has been changed. Used to help calculate the next changefreq value.', PRIMARY KEY (`id`,`type`,`language`), KEY `loc` (`loc`(191)), KEY `access_status_loc` (`access`,`status`,`loc`(191)), KEY `type_subtype` (`type`,`subtype`) ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='The base table for xmlsitemap links.'
--------------

Query OK, 0 rows affected (0.10 sec)

--------------
LOAD DATA LOCAL INFILE '/Users/student/src/csv/sitemap.csv' INTO TABLE studentdb.xmlsitemap FIELDS TERMINATED BY ',' ignore 1 lines
--------------

Query OK, 1000000 rows affected (25.57 sec)
Records: 1000000  Deleted: 0  Skipped: 0  Warnings: 0

```

attempt with one million rows 

```bash
Last login: Wed May  2 20:18:40 on ttys000
You have new mail.
minint-tg9n4hv:~ student$ cd ~/src/csv/
minint-tg9n4hv:csv student$ git pull origin master
remote: Counting objects: 4, done.
remote: Compressing objects: 100% (2/2), done.
remote: Total 4 (delta 2), reused 4 (delta 2), pack-reused 0
Unpacking objects: 100% (4/4), done.
From github.com:qlstudent/csv
 * branch            master     -> FETCH_HEAD
   0d28d60..ec030e9  master     -> origin/master
Updating 0d28d60..ec030e9
Fast-forward
 drupal_function.php | 5 ++---
 index.php           | 1 +
 2 files changed, 3 insertions(+), 3 deletions(-)
minint-tg9n4hv:csv student$ opendb
mkdir: /usr/local/etc/my.cnf.d: File exists
Welcome to the MariaDB monitor.  Commands end with ; or \g.
Your MariaDB connection id is 8
Server version: 10.2.14-MariaDB Homebrew

Copyright (c) 2000, 2018, Oracle, MariaDB Corporation Ab and others.

Reading history-file /Users/student/.mysql_history
Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

MariaDB [(none)]> use studentdb;
Reading table information for completion of table and column names
You can turn off this feature to get a quicker startup with -A

Database changed
MariaDB [studentdb]> show tables;
--------------
show tables
--------------

+---------------------+
| Tables_in_studentdb |
+---------------------+
| xmlsitemap          |
+---------------------+
1 row in set (0.00 sec)

MariaDB [studentdb]> select count(*) from studentdb.xmlsitemap;
--------------
select count(*) from studentdb.xmlsitemap
--------------

+----------+
| count(*) |
+----------+
|        0 |
+----------+
1 row in set (0.00 sec)

MariaDB [studentdb]> select count(*) from studentdb.xmlsitemap;
--------------
select count(*) from studentdb.xmlsitemap
--------------

+----------+
| count(*) |
+----------+
|      100 |
+----------+
1 row in set (0.00 sec)

MariaDB [studentdb]> select count(*) from studentdb.xmlsitemap;
--------------
select count(*) from studentdb.xmlsitemap
--------------

+----------+
| count(*) |
+----------+
|  1000000 |
+----------+
1 row in set (0.23 sec)

MariaDB [studentdb]> \q
Writing history-file /Users/student/.mysql_history
Bye
minint-tg9n4hv:csv student$
```