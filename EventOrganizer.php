<?php
/**
 * Created by PhpStorm.
 * User: a.alarfaj
 * Date: 1/23/2017
 * Time: 11:12 AM
 */

include('connect-db.php');

if(isset($_POST['CreateESubmit'])) {
    $Status = 'Active';

    $username = $_POST['Username'];
    $password = $_POST['Password'];
    $Name = $_POST['OrgName'];
    $Email = $_POST['OrgEmail'];
    $OrgDesc = $_POST['OrgDesc'];
    $FB = $_POST['OrgFB'];
    $Twitter = $_POST['OrgTwitter'];
    $TelNo = $_POST['TelNo'];

    //Inserting Organizer Info
        $query = "Insert into eventorg(Username,Password, Name, Email, OrganizerDescription, Facebook, Twitter, TelephoneNumber) values( '$username','$password', '$Name', '$Email', '$OrgDesc', '$FB', '$Twitter', '$TelNo')";
        $result = mysqli_query($con, $query);


    if($result==1)
    {
        header('Location: EventOrganizer.php?results=success');

    }
    else{
        header('Location: EventOrganizer.php?results=failure');
    }




}
?>

<?php
        $Title = "Organizer Registration";
		include('Header.php');
				?>

<?php if(isset($_GET['results']) && $_GET['results']==='success') {?>
    <h1 class="Status">You Registered Succesfully</h1>
<?php } else if(isset($_GET['results']) && $_GET['results']==='failure') {?>
    <h1 class="Status">Oops! There was a problem.</h1>
<?php } else {?>

<form id="CreateEForm" name="CreateEForm" action="EventOrganizer.php" method="post" onsubmit="return validate();" enctype="multipart/form-data">
    <div id="CreateEUserInfo">
        <h2 id="CreateEventHeader">Organizer Information</h2>

           <div>
               <table id="OrgInfoTbl">
               <tr>
                <td><label for="OrgName">Organizer Name*:</label></td>
                <td><input type="text" name="OrgName" /></td>
            </tr>

            <tr>
                <td><label for="OrgEmail">Email*:</label></td>
                <td><input type="email" name="OrgEmail" /></td>
            </tr>

            <tr>
                <td><label for="OrgDesc">Organizer Description:</label></td>
                <td><input type="text" name="OrgDesc" /></td>
            </tr>

            <tr>
                <td><label for="OrgFB">Organizer Facebook Link:</label></td>
                <td><input type="text" name="OrgFB" /></td>
            </tr>

            <tr>
                <td><label for="OrgTwitter">Organizer Twitter Link:</label></td>
                <td><input type="text" name="OrgTwitter" /></td>
            </tr>

            <tr>
                <td><label for="TelNo">Telephone Number:</label></td>
                <td><input type="tel" name="TelNo" /></td>
            </tr>
        </table>
           </div>

    <div id="EventLoginInfo">
        <table id="OrgInfoTbl">
            <tr>
                <td><label for="username">Username:</label></td>
                <td><input type="text" name="Username" /></td>
            </tr>

            <tr>
                <td><label for="password">Password:</label></td>
                <td><input type="password" name="Password" /></td>
            </tr>


            <tr>
                <td><label for="ConfirmPassword">Confirm Password: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></td>
                <td><input type="password" name="ConfirmPassword" /></td>
            </tr>
        </table>
    </div>

        <input type="submit" class="CustomButtonA" name="CreateESubmit" id="CreateESubmit" onclick="validate();" value="Submit" />
        <a href="" class="CustomButtonA">Reset</a>
    </div>

</form>
<?php } ?>

<script>
    function validate(){

        var Orgname = document.CreateEForm.OrgName.value;
        var OrgEmail = document.CreateEForm.OrgEmail.value;
        var Username = document.CreateEForm.Username.value;
        var Password = document.CreateEForm.Password.value;
        var ConfirmPassword = document.CreateEForm.ConfirmPassword.value;

        var flag = false;

        if(Orgname=="")
        { document.CreateEForm.OrgName.style.backgroundColor="#FFC7C7";
            document.CreateEForm.OrgName.setAttribute("placeholder","Required");
            flag = false;
        }
        else { document.CreateEForm.OrgName.style.backgroundColor="#FFF";
            document.CreateEForm.OrgName.setAttribute("placeholder","");
            flag = true;
        }
        if(OrgEmail=="")
        { document.CreateEForm.OrgEmail.style.backgroundColor="#FFC7C7";
            document.CreateEForm.OrgEmail.setAttribute("placeholder","Required");
            flag = false;
        }
        else { document.CreateEForm.OrgEmail.style.backgroundColor="#FFF";
            document.CreateEForm.OrgEmail.setAttribute("placeholder","");
            flag = true;
        }

        if(Username=="")
        { document.CreateEForm.Username.style.backgroundColor="#FFC7C7";
            document.CreateEForm.Username.setAttribute("placeholder","Required");
            flag = false;
        }
        else { document.CreateEForm.Username.style.backgroundColor="#FFF";
            document.CreateEForm.Username.setAttribute("placeholder","");
            flag = true;
        }

        if(Password=="")
        { document.CreateEForm.Password.style.backgroundColor="#FFC7C7";
            document.CreateEForm.Password.setAttribute("placeholder","Required");
            flag = false;
        }
        else { document.CreateEForm.Password.style.backgroundColor="#FFF";
            document.CreateEForm.Password.setAttribute("placeholder","");
            flag = true;
        }

        if(ConfirmPassword=="")
        { document.CreateEForm.ConfirmPassword.style.backgroundColor="#FFC7C7";
            document.CreateEForm.ConfirmPassword.setAttribute("placeholder","Required");
            flag = false;
        }
        else { document.CreateEForm.ConfirmPassword.style.backgroundColor="#FFF";
            document.CreateEForm.ConfirmPassword.setAttribute("placeholder","");
            flag = true;
        }


        if(Password!=ConfirmPassword)
        { document.CreateEForm.ConfirmPassword.style.backgroundColor="#FFC7C7";
            document.CreateEForm.ConfirmPassword.setAttribute("placeholder","Password does not match!");
            flag = false;
        }
        else { document.CreateEForm.ConfirmPassword.style.backgroundColor="#FFF";
            document.CreateEForm.ConfirmPassword.setAttribute("placeholder","");
            flag = true;
        }
    }
</script>
<?php include('Footer.php'); ?>
