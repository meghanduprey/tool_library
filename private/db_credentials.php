<?php
if($_SERVER['HTTP_HOST'] == 'mduprey.com'){
  define("DB_SERVER", "localhost");
  define("DB_USER", "meghand9_admin");
  define("DB_PASS", "qSE9j77sePR7!DNz");
  define("DB_NAME", "meghand9_tool_library");
 } else {
   define("DB_SERVER", "localhost");
   define("DB_USER", "root");
   define("DB_PASS", "root");
   define("DB_NAME", "tool_library");
 }
?>