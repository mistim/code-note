<?php

return "
SET FOREIGN_KEY_CHECKS=0;
INSERT INTO `auth_item` VALUES ('/*', '2', null, null, null, '1465463829', '1465463829');
INSERT INTO `auth_item` VALUES ('/site/login', '2', 'Авторизация в админ-панели', null, null, '1465463829', '1465463829');
INSERT INTO `auth_item` VALUES ('/site/logout', '2', 'Выход из админ-панели', null, null, '1465463829', '1465463829');
INSERT INTO `auth_item` VALUES ('Admin area full', '2', 'Полный доступ в админку', null, null, '1465463829', '1465463829');
INSERT INTO `auth_item` VALUES ('Administrator', '1', 'Супер-пользователь, доступ ко всему, создание пользователей и назначение ролей', null, null, '1465463828', '1465463828');
INSERT INTO `auth_item` VALUES ('Guest', '1', 'Неавторизованный пользователь', null, null, '1465463828', '1465463828');
INSERT INTO `auth_item` VALUES ('Login to admin area', '2', 'Авторизация в админ-панели', null, null, '1465463829', '1465463829');
INSERT INTO `auth_item` VALUES ('Logout from admin area', '2', 'Выход из админ-панели', null, null, '1465463829', '1465463829');
";