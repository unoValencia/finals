<?php

class database{

    function opencon(){
        return new PDO('mysql:host=localhost; dbname=finalcake', 'root', '');
    }


    // function check($username, $password){
    //     $con = $this->opencon();
    //     $query = "SELECT * from .signup WHERE username='".$username."'&&password='".$password."'                ";
    //     return $con->query($query)->fetch();
    // }

function check($username, $password) {
        // Open database connection
        $con = $this->opencon();
    
        // Prepare the SQL query
        $stmt = $con->prepare("SELECT * FROM signup WHERE username = ?");
        $stmt->execute([$username]);
    
        // Fetch the user data as an associative array
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // If a user is found, verify the password
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
    
        // If no user is found or password is incorrect, return false
        return false;
    }

function signup($username, $email, $password){
        $con = $this->opencon();

// Check if the username is already exists

    $query=$con->prepare("SELECT username FROM .signup WHERE username =?");
    $query->execute([$username]);
    $existingUser= $query->fetch();
    

// If the username already exists, return false
    if($existingUser){
    return false;
}
// Insert the new username and password into the database
    return $con->prepare("INSERT INTO .signup(username,email,password)
VALUES (?, ?, ?)")
           ->execute([$username,$email, $password]);
           
}

// function signupUser($username, $password, $firstname, $lastname, $birthday, $sex){
//     $con = $this->opencon();


//     // Check if the username is already exists

//     $query=$con->prepare("SELECT username FROM .signup WHERE username =?");
//     $query->execute([$username]);
//     $existingUser= $query->fetch();
    

// // If the username already exists, return false
//     if($existingUser){
//     return false;
// }
// // Insert the new username and password into the database
//  $con->prepare("INSERT INTO .signup(username,password,firstname,lastname,birthday,sex)
// VALUES (?, ?, ?, ?, ?, ?)")
//            ->execute([$username,$password, $firstname, $lastname, $birthday, $sex]);
//            return $con->lastInsertId();
// }


function signupUser($firstname, $lastname, $birthday, $sex, $email, $username, $password, $profilePicture)
{
    $con = $this->opencon();
    // Save user data along with profile picture path to the database
    $con->prepare("INSERT INTO .signup (firstname, lastname, birthday, sex, user_email, username, password, user_profile_picture) VALUES (?,?,?,?,?,?,?,?)")->execute([$firstname, $lastname, $birthday, $sex, $email, $username, $password, $profilePicture]);
    return $con->lastInsertId();
    }
// function insertAddress($User_Id, $street, $barangay, $city, $province){
//     $con = $this->opencon();
//      return $con->prepare("INSERT INTO user_address (User_Id,street, barangay, city,province) VALUES(?, ?, ?, ?, ?)") ->execute([$User_Id, $street, $barangay, $city, $province]);
    
 

// }


function insertAddress($User_Id, $street, $barangay, $city, $province)
{
    $con = $this->opencon();
    return $con->prepare("INSERT INTO user_address (User_Id, street, barangay, city, province) VALUES (?,?,?,?,?)")->execute([$User_Id, $street, $barangay,  $city, $province]);
      
}

function view(){
        $con = $this->opencon();
        return $con->query("SELECT
        .signup.User_Id,
        .signup.firstname,
        .signup.lastname,
        .signup.birthday,
        .signup.sex,
        .signup.username, 
        .signup.password,
        .signup.user_profile_picture, 
        CONCAT(
            user_address.street,' ',user_address.barangay,' ',user_address.city,' ',user_address.province
        ) AS address
    FROM
        .signup
    JOIN user_address ON .signup.User_Id = user_address.User_Id")->fetchAll();

    }

    
    function delete($id){
        try{
            $con = $this->opencon();
            $con->beginTransaction();

            // Delete user address

            $query = $con->prepare("DELETE FROM user_address
            WHERE User_Id =?");
            $query->execute([$id]);
        
            // Delete user

          
            $query2 = $con->prepare("DELETE FROM .signup
            WHERE User_Id =?");
            $query2->execute([$id]);

            $con->commit();
            return true; //Deletion successful
} catch (PDOException $e) {
    $con->rollBack();
    return false;
} 

}

function viewdata($id){
    try {
        $con = $this->opencon();
        $query = $con->prepare("SELECT
        .signup.User_Id,
        .signup.firstname,
        .signup.lastname,
        .signup.birthday,
        .signup.sex,
        .signup.username, 
        .signup.password,
        .signup.user_profile_picture,
        user_address.street,user_address.barangay,user_address.city,user_address.province
        
    FROM
        .signup
    JOIN user_address ON .signup.User_Id = user_address.User_Id
    Where .signup.User_Id =?;");
        $query->execute([$id]);
        return $query->fetch();
    } catch (PDOException $e) {
        // Handle the exception (e.g. , log error, return empty array. etc.)
        return [];
    
  
        }
    }

    function updateUser($User_Id, $username,$password,$firstname, $lastname, $birthday, $sex) {
        try { 
            $con = $this->opencon();
            $con->beginTransaction();
            $query = $con->prepare("UPDATE .signup SET username=?, password=?, firstname=?, lastname=?, birthday=?, sex=? WHERE User_Id=?");
            $query->execute([$username, $password, $firstname, $lastname, $birthday, $sex, $User_Id]);
        
            // Update Successful
            $con->commit();
            return true;
        }catch (PDOException $e) {
            // Handle the exception (e.g., log error, return false, etc.)
            $con->rollBack();
            return false;

        }
    }

    function updateUserAddress($User_Id, $street, $barangay, $city, $province) {
        try { 
            $con = $this->opencon();
            $con->beginTransaction();
            $query = $con->prepare("UPDATE user_address SET street=?, barangay=?, city=?, province=?  WHERE User_Id=?");
            $query->execute([$street,$barangay,$city,$province, $User_Id]);
        
            // Update Successful
            $con->commit();
            return true;
        }catch (PDOException $e) {
            // Handle the exception (e.g., log error, return false, etc.)
            $con->rollBack();
            return false;

        }
    }
    
        
    // // function check_account_type($username) {
    //     $query = $this->connection->prepare("SELECT account_type FROM .signup WHERE username = :username");
    //     $query->bindParam(":username", $username);
    //     $query->execute();

    //     $result = $query->fetch(PDO::FETCH_ASSOC);
    //     if ($result) {
    //         return $result['account_type'];
    //     } else {
    //         return false;
    //     }
    // }
        
    
    function validateCurrentPassword($User_Id, $currentPassword) {
        // Open database connection
        $con = $this->opencon();
    
        // Prepare the SQL query
        $query = $con->prepare("SELECT password FROM .signup WHERE User_Id = ?");
        $query->execute([$User_Id]);
    
        // Fetch the user data as an associative array
        $user = $query->fetch(PDO::FETCH_ASSOC);
    
        // If a user is found, verify the password
        if ($user && password_verify($currentPassword, $user['password'])) {
            return true;
        }
    
        // If no user is found or password is incorrect, return false
        return false;
    }
function updatePassword($userId, $hashedPassword){
        try {
            $con = $this->opencon();
            $con->beginTransaction();
            $query = $con->prepare("UPDATE .signup SET password = ? WHERE User_Id = ?");
            $query->execute([$hashedPassword, $userId]);
            // Update successful
            $con->commit();
            return true;
        } catch (PDOException $e) {
            // Handle the exception (e.g., log error, return false, etc.)
             $con->rollBack();
            return false; // Update failed
        }
        }
    function updateUserProfilePicture($userID, $profilePicturePath) {
            try {
                $con = $this->opencon();
                $con->beginTransaction();
                $query = $con->prepare("UPDATE .signup SET user_profile_picture = ? WHERE User_Id = ?");
                $query->execute([$profilePicturePath, $userID]);
                // Update successful`
                $con->commit();
                return true;
            } catch (PDOException $e) {
                // Handle the exception (e.g., log error, return false, etc.)
                 $con->rollBack();
                return false; // Update failed
            }
             }
    
         


}

    




   