
<h2>
    Fname is:<br> <?php 
    foreach($data as $user){
        echo '<br>' . $user->username . '<br>';
    }
    ?>
</h2>

<h2>
    Email is:<br> <?php 
        foreach($data as $user){
            echo '<br>' . $user->email . '<br>';
        }
    ?>
</h2>