<?php
    $conn = mysqli_connect('localhost', 'root', '', 'ajaxcurdopration');
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    extract($_POST);
    if(isset($_POST['readrecord'])){
        $data = '<table class="table table-dark table-hover">
            <tr>
                <th>SR. NO.</th>
                <th>FIRST NAME</th>
                <th>LAST NAME</th>
                <th>EMAIL</th>
                <th>MOBILE NUMBER</th>
                <th>UPDATE</th>
                <th>DELETE</th>
            </tr>';
            $displayquery = "SELECT * FROM curdtable";
            $result = mysqli_query($conn, $displayquery);
            
            if(!$result) {
                echo "Error: " . mysqli_error($conn);
            }
            
            if(mysqli_num_rows($result) > 0){
                $number = 1;
                while ($row = mysqli_fetch_array($result)){
                    $data .= '<tr>
                        <td>'.$number.'</td>
                        <td>'.$row['firstname'].'</td>
                        <td>'.$row['lastname'].'</td>
                        <td>'.$row['email'].'</td>
                        <td>'.$row['mobile'].'</td>
                        <td>
                            <button onclick="GetUserDetails('.$row['id'].')"class="btn btn-info">UPDATE</button>
                        </td>
                        <td>
                            <button onclick="DeleteUser('.$row['id'].')"class="btn btn-danger">DELETE</button>
                        </td>
                    </tr>';
                    $number++;
                }
            }
            $data .= '</table>';
            echo $data;
    }
    if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['mobile'])){
        $query = "INSERT INTO `curdtable`(`firstname`, `lastname`, `email`, `mobile`) VALUES('$firstname','$lastname','$email','$mobile')";
        if (mysqli_query($conn, $query)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    }
    if(isset($_POST['deleteid'])){
        $userid = $_POST['deleteid'];
        $deletequery = "delete from curdtable where id='$userid'";
        mysqli_query($conn, $deletequery);
    }
    if(isset($_POST['id']) && isset($_POST['id']) != "")
    {
        $user_id = $_POST['id'];
        $query = "SELECT * FROM curdtable where id = '$user_id'";
        if(!$result = mysqli_query($conn,$query)){
            exit(mysqli_error());
        }
        $responce = array();
        if(mysqli_num_rows($result) > 0){
            while ($row = mysqli_fetch_assoc($result)){
                $responce = $row;
            }
        }else{
            $responce['status'] = 200;
            $responce['massage'] = "Data Not Found";
        }
        echo json_encode($responce);
    }
    else{
        $responce['status'] = 200;
        $responce['massage'] = "Invalid Request!";
    }
    if(isset($_POST['hidden_user_idupd'])){
        $hidden_user_idupd = $_POST['hidden_user_idupd'];
        $firstnameupd = $_POST['firstnameupd'];
        $lastnameupd = $_POST['lastnameupd'];
        $emailupd = $_POST['emailupd'];
        $mobileupd = $_POST['mobileupd'];

        $query = "UPDATE `curdtable` SET `firstname`='$firstnameupd', `lastname`='$lastnameupd', `email`='$emailupd', `mobile`='$mobileupd' WHERE id='$hidden_user_idupd'";
        mysqli_query($conn, $query);

        mysqli_query($conn, $query);
        echo "User updated successfully!";
    }
      mysqli_close($conn);
?>
