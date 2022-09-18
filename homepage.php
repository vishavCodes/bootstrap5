<?php

if(isset($_POST['action']) && $_POST['action'] == 'collectData'){
    $msg = [];
    if(file_exists('facebookFormData/facebookform.json')){
        $previousarray = json_decode(file_get_contents('facebookFormData/facebookform.json'),true);

        $getallformids = array_column($previousarray,'formid');

        if(!in_array($_POST['formid'],$getallformids)){

            $currentarray = array(
                "formid" => $_POST['formid'],
                "formName" => $_POST['formName'],
                "leadShow" => $_POST['leadShow'],
            );
            $previousarray[] = $currentarray;
            file_put_contents('facebookFormData/facebookform.json',json_encode($previousarray));
            $msg['success'] = 1;
        } else{
            $msg['success'] = 0;
        }





        print_r($previousarray);
        // die();
    }
    // file_put_contents('facebookFormData/facebookform.json',json_encode($_POST));
    // echo "Jquery Worked";
}
?>

<html>
    <head>
        <title>Website</title>
    </head>
    <body>
        <form action="" method="post" id="collectFormdataForFacebook">
            <input type="text" name="formid" id="formid">
            <input type="text" name="formName" id="formName">
            <select name="leadShow" id="leadShow">
                <option value="">Please selecr</option>
                <option value="MyCoach">Mycoach</option>
                <option value="B2B">B2B</option>
            </select>
            <input type="hidden"  name="action" value="collectData">
            <input type="button" value="Submit" onclick="addFacebookForm();">
        </form>
        <?php
        $previousarray = json_decode(file_get_contents('facebookFormData/facebookform.json'),true);
        echo "<pre>";
        print_r($previousarray);
        echo "</pre>";


        $form_ids = array_column($previousarray,'formid');

        echo "<pre> Only formids";
        print_r($form_ids);
        ?>
    </body>
</html>
<script src="js/jquery.min.js"></script>
<script>
    function addFacebookForm(){
        console.log("vishav");
        var data = $('#collectFormdataForFacebook').serialize();
        $.ajax({
            url: '',
            type: "POST",
            data:data,
            success: function(resp) {
                console.log(resp);
            }
        });
    }
</script>