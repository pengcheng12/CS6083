<?php  
    include("includes/config.php");

    // get the value from input to verify auto-complete
    if(isset($_POST["query"])) {
        $output = '';
        // update : fix the query 
        $query = "select CONCAT(street_num, ' ', street_name, ', ' , city, ', ', state) as result
        from address natural join blocks_info natural join hoods
        where street_num LIKE '%".$_POST["query"]."%' ";

        
        $result = mysqli_query($con, $query);  
        $output = '<ul class="list-unstyled">';  
        if (mysqli_num_rows($result) > 0 ){
            while($row = mysqli_fetch_array($result)){
                $output .= '<li>'.$row["result"].'</li>';
            }
        }

        else{
            $output .= '<li>Cannot find your address!</li>'; 
        }

        $output .= "</ul>";
        echo $output;
    }
   
    

?>