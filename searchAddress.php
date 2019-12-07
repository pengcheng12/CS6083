<?php


    $connect = mysqli_connect("localhost", "root", "", "final");



    if(isset($_POST["query"])) {
        $output = '';
        $query = "select CONCAT(street_num, ' ', street_name, ' ,' , city, ' ,', state) as result
        from address natural join blocks_info natural join hoods
        where street_num LIKE '%".$_POST["query"]."%'";

        $result = mysqli_query($connect, $query);
        $output .= '<ul class = "list-unstyled">'; 
      
        if (mysqli_num_rows($result) > 0 ){
            while($row = mysqli_fetch_array($result)){
                $output .= '<li> '.$row["result"].'</li>';

            }

        }

        else{
            $output .= '<li>Cannot find your address!</li>'; 
        }

        $output .= "</ul>";
        echo $output;

    }
   
    

?>