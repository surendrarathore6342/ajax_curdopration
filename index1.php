<html>
<head>
    <title>AJAX CURD OPRATION</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-primary text-center">AJAX CURD OPRATION</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 d-flex justify-content-end"> 
                 <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#myModal">ADD USER</button>
            </div>
        </div>
        <div class="row">
            <div class="text-primary">
                 <h2>ALL RECORD</h2>
                 <div id="record_contant"></div>
            </div>
        </div>
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">AJAX CURD OPRATION</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group mt-3">
                        <label for="firstname">First Name :-</label>
                        <input type="text"name="" id="firstname" class="form-control" placeholder="Enter Your Name">
                    </div>
                    <div class="form-group mt-3">
                        <label for="lastname">Last Name :-</label>
                        <input type="text"name="" id="lastname" class="form-control" placeholder="Enter Your Last Name">
                    </div>
                    <div class="form-group mt-3">
                        <label for="email">Email Id :-</label>
                        <input type="email"name="" id="email" class="form-control" placeholder="Enter Your Email Id">
                    </div>
                    <div class="form-group mt-3">
                        <label for="mobile">Mobile Number :-</label>
                        <input type="text"name="" id="mobile" class="form-control" placeholder="Enter Your Mobile Number">
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"onclick="addRecord()">Save</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>
<!-- UPDATE MODAL -->
        <div class="modal" id="update_user_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">AJAX CURD OPRATION</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group mt-3">
                        <label for="update_firstname">First Name :-</label>
                        <input type="text"name="" id="update_firstname" class="form-control" placeholder="Enter Your Name">
                    </div>
                    <div class="form-group mt-3">
                        <label for="update_lastname">Last Name :-</label>
                        <input type="text"name="" id="update_lastname" class="form-control" placeholder="Enter Your Last Name">
                    </div>
                    <div class="form-group mt-3">
                        <label for="update_email">Email Id :-</label>
                        <input type="email"name="" id="update_email" class="form-control" placeholder="Enter Your Email Id">
                    </div>
                    <div class="form-group mt-3">
                        <label for="update_mobile">Mobile Number :-</label>
                        <input type="text"name="" id="update_mobile" class="form-control" placeholder="Enter Your Mobile Number">
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"onclick="updateuserdetail()">Save</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <input type="hidden" name="" id="hidden_user_id">
                </div>
                </div>
            </div>
        </div>
   </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



<script>
    $(document).ready(function(){
        readRecords();
    });
    function readRecords(){
        var readrecord = "readrecord";
        $.ajax({
            url:"bacand1.php",
            type:"post",
            data:{ readrecord:readrecord },
            success:function(data,ststus){
                $('#record_contant').html(data);
            }
        });
    }
    function addRecord(){
        var firstname = $('#firstname').val();
        var lastname = $('#lastname').val();
        var email = $('#email').val();
        var mobile = $('#mobile').val();
        $.ajax({
            url:"bacand1.php",
            type:'post',
            data:{ firstname : firstname,
                lastname : lastname,
                email : email,
                mobile : mobile
             },
             success:function(data,status){
                readRecords();
             }
        });
    }


    function DeleteUser(deleteid){
        var conf = confirm("Are You Sure");
        if(conf==true){
            $.ajax({
                url:"bacand1.php",
                type:"POST",
                data:{ deleteid:deleteid },
                success:function(data,status){
                    readRecords();
                }
            })
        }
    }


    function GetUserDetails(id){
    $('#hidden_user_id').val(id);
    $.post("bacand1.php",{
        id:id   
    }, function(data,status){
        var user = JSON.parse(data);
        $('#update_firstname').val(user.firstname);
        $('#update_lastname').val(user.lastname);
        $('#update_email').val(user.email);
        $('#update_mobile').val(user.mobile);
        $('#myModal').modal("hide");
        $('#update_user_modal').modal("show");
    });
}


    function updateuserdetail(){
        var firstnameupd = $('#update_firstname').val();
        var lastnameupd = $('#update_lastname').val();
        var emailupd = $('#update_email').val();
        var mobileupd = $('#update_mobile').val();

        var hidden_user_idupd = $('#hidden_user_id').val();
        $.post("bacand1.php",{
        hidden_user_idupd:hidden_user_idupd,
        firstnameupd:firstnameupd,
        lastnameupd:lastnameupd,
        emailupd:emailupd,
        mobileupd:mobileupd,
    },
    function(data,status){
        $('#update_user_modal').modal("hide");
        readRecords();
    }
    );
    }
</script>
</body>
</html>