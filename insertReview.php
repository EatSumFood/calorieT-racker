<?php
    include("connection.php");
    if(isset($_POST['reviewsubmit'])){
    $foodname = $_POST['foodreview'];
    $rating = $_POST['foodrating'];
    $review = $_POST['review'];
    //for some reason, if the review has a ' or ' in it it breaks the query, not sure why.
    //wouldn't this mean that if a ' and ' is in the review then it also breaks it? assuming this is based on that it is a logical expression

    $query = "select ID from food where name = '$foodname'";

    $result = mysqli_query($conn,$query);

    $result2 = mysqli_fetch_array($result);
    $foodid = $result2[0];
    
    $query = "insert into review(foodID,rating,description) values ('$foodid','$rating','$review')";

    $run = mysqli_query($conn,$query);

    
    if($run){
        echo '<script>
            window.location.href = "review.php";
            alert("review successfully added to database!")
            </script>';
            //insert average rating into food with matching id
        $query = "select AVG(rating) from review where foodID = '$foodid'";
        $result = mysqli_query($conn,$query);
        $result2 = mysqli_fetch_array($result);
        $rating = $result2[0];

        $query = "update food set userRating = '$rating' where ID = '$foodid'";
        $run = mysqli_query($conn,$query);

    }
    else{
        echo '<script>
            window.location.href = "review.php";
            alert("something went wrong, please try again")
            </script>';
    }


    
}
?>