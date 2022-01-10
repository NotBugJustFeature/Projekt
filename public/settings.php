<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <style>
        .border{
            border: solid 1px black;
        }
        .profile-image-big{
            width: 200px;
            height: 200px;
        }
    </style>
</head>
<body>
    <?php require "import/nav.php"; ?>
    <div class="container">
        <div class="row">
            <div class="col-4 border">
                <div class="row">
                <?php
                    if( file_exists("/uploads/profile-images/". $_SESSION["user"]["id"]."jpg") ) 
                        echo '<img src="/uploads/profile-images/'.$_SESSION["user"]["id"].'.jpg" class="profile-image-big">';
                    else
                        echo '<img src="/uploads/profile-images/default.jpg" class="profile-image-big">';
                ?>
                </div>
                <div class="row">
                    <form name="profile_img_form">
                        <input type="file" class="form-control" name="profile_img" src>
                        <input type="submit">
                    </form>
                </div>
            </div>
            <div class="col-8 border">
                <form name="password_update_form">
                    <input type="password" name="password">
                    <input type="password" name="passwordRepeat">
                    <input type="button" id="passwordChange" value="Jelszo valtoztatas">
                </form>
                <form name="deleteAccount">
                    <input type="hidden" name="accountId" value=<?php echo $_SESSION["user"]["id"];  ?>>
                    <input type="button" value="Fiok torlese" id="accountDelete">
                </form>
            </div>
        </div>
    </div>
    
    <?php print_r($_SESSION["user"]);
        echo $_SESSION["isAdmin"];
    ?>
    <script>
        document.forms.profile_img_form.addEventListener("submit", (e) => {
            e.preventDefault();
            postData(new FormData(document.forms.profile_img_form));
        })
        document.getElementById("accountDelete").addEventListener("click", (e)=>{
            e.preventDefault();
            form = new FormData(document.forms.deleteAccount)
            form.append("accountId", document.forms.deleteAccount.accountId.value);
            postData(form)
        })
        document.getElementById("passwordChange").addEventListener("click", (e)=>{
            if(document.forms.password_update_form.password.value && document.forms.password_update_form.password.value == document.forms.password_update_form.passwordRepeat.value){
                e.preventDefault();
                form = new FormData(document.forms.password_update_form)
                form.append("account_Id", document.forms.deleteAccount.accountId.value);
                postData(form)
            }
        })

        async function postData(formattedFormData){
            const response = await fetch('settings_backend',{
                method: 'POST',
                body: formattedFormData
            })
            const data = await response.text()
            console.log(data)
            if(data == "img success") window.location.reload()
            if(data == "logout") window.location.reload()
        }

    </script>
</body>
</html>