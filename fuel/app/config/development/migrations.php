<?php
return array(
  'version' => 
  array(
    'app' => 
    array(
      'default' => 
      array(
        0 => '001_create_users',
        1 => '002_create_scans',
        2 => '003_create_stores',
        3 => '004_create_codes',
        4 => '005_create_commands',
        5 => '006_create_codesources',
        6 => '006_create_newcodes',
        7 => '007_create_codenews',
        8 => '007_create_competitorcodes',
        9 => '008_create_codeoems',
        10 => '008_create_oemcodes',
        11 => '009_create_codecompetitors',
      ),
    ),
    'module' => 
    array(
    ),
    'package' => 
    array(
      'auth' => 
      array(
        0 => '001_auth_create_usertables',
        1 => '002_auth_create_grouptables',
        2 => '003_auth_create_roletables',
        3 => '004_auth_create_permissiontables',
        4 => '005_auth_create_authdefaults',
        5 => '006_auth_add_authactions',
        6 => '007_auth_add_permissionsfilter',
        7 => '008_auth_create_providers',
        8 => '009_auth_create_oauth2tables',
        9 => '010_auth_fix_jointables',
      ),
    ),
  ),
  'folder' => 'migrations/',
  'table' => 'migration',
);
