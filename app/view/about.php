
<h2>
    Fname is: <?php 
    foreach($data as $user){
        echo '<br>' . $user->username . '<br>';
    }
    ?>
</h2>

<h2>
    Lname is: <?php 
        foreach($data as $user){
            echo '<br>' . $user->email . '<br>';
        }
    ?>
</h2>