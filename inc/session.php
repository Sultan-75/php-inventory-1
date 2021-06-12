
<?php 

class Session{
        public static function init(){
        session_start();
        }
        public static function set($key,$value){

            $_SESSION[$key] = $value; // static function ervitore [''] it lage na.
        }
        public static function get($key){
            if(isset($_SESSION[$key])) {
                return $_SESSION[$key];
            }else {
                return false;
            }

        }
        public static function checkSession(){

            self::init();
            if (self::get("login") == false){
                self::destroy();
                header("Location:index.php");
            }
        }
        
        public static function destroy(){
            session_destroy();
            header("Location:index.php");
        }
    }


?>