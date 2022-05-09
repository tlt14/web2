<?php 
    class dataProvider{
        public static function executeQuery($sql)
        {
            include('ketnoi.php');
            if(!($conection=mysqli_connect($host,$user,$pass,$db)))
            {
                die("k the ket noi");
            }
            if(!($result=mysqli_query($conection,$sql)))
            {
                echo "khong the ket noi 3";
            }
            if(!(mysqli_close($conection)))
            {
                echo "khong the ket noi 4";
            }
            return $result;
        }
    }
?>