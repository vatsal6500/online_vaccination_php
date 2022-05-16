<?php
    $msg="";
    $err="";
    if(isset($_POST["btnsubmit"]))
    {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $msg = $_POST["msg"];
        $d = date("Y-m-d");

        $qry = "insert into feedback(name,email,message,date) values('$name','$email','$msg','$d')";
        $res = mysqli_query($con,$qry);
        if($res)
        {
          $msg = '<div class="text-white bg-green-500 bg-opacity-50" >'.$name.' Your Feedback is submited successfully.</div>';
        }
        else
        {
          $err = '<div class="text-white bg-green-500 bg-opacity-50" ><?php die(mysqli_error($con)); ?></div>';
        }
    }
  ?>


<head>
  <script type="text/javascript" src="jquery.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){

      $("#name").on('input',function(){
        var name = $("#name").val();
        var namex = /^[a-zA-Z ]{2,50}$/;
        if(namex.test(name))
        {
          $("#pname").text("");
        }
        else
        {
          $("#pname").text("*");
        }
      });

      $("#message").on('input',function(){
        var adds = $("#message").val();
        var addsx = /^[a-zA-Z0-9-,. ]{0,500}$/;
        if(addsx.test(adds))
        {
          $("#pmsg").text("");
        }
        else
        {
          $("#pmsg").text("*");
        }
      });

      $("#email").on('input',function(){
        var email = $("#email").val();
        var emailx = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(emailx.test(email))
        {
          $("#pemail").text("");
        }
        else
        {
          $("#pemail").text("*");
        }
      });

          $("form").submit(function(){

          var name = $("#name").val();

          var msg = $("#message").val();

          var email = $("#email").val();

          if(name=="")
          {
            $("#spname").text("name is Empty");
            return false;
          }
          else
          {
            $("#spname").text("");                     
          }

          if(email=="")
          {
            $("#spemail").text("Email is empty");
            return false;
          }
          else{
                $("#spemail").text("");                     
          }

          if(msg=="")
          {
            $("#spmsg").text("Feedback is empty");
            return false;
          }
          else{
                $("#spmsg").text("");                      
          }

        });

    });




  </script>
</head>

<section class="text-gray-600 body-font relative" style="background-image: url('images/drop.jpg'); background-repeat: no-repeat; background-size: cover; background-position: bottom;">
  <form method="post" action="index.php">
  <div class="container px-5 py-24 mx-auto">
    <div class="flex flex-col text-center w-full mb-12">
      <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">FeedBack</h1>
    </div>
    <div class="lg:w-1/2 md:w-2/3 mx-auto">
      <div class="flex flex-wrap -m-2">
        <div class="p-2 w-1/2">
          <div class="relative">
            <label for="name" class="leading-7 text-sm text-black-600"><b>Name</b>&nbsp;&nbsp;<span id="pname" style="color: red;"></span></label>
            <input type="text" id="name" name="name" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
            <b><span id="spname" style="color: red;"></span></b>
          </div>
        </div>
        <div class="p-2 w-1/2">
          <div class="relative">
            <label for="email" class="leading-7 text-sm text-black-600"><b>Email</b>&nbsp;&nbsp;<span id="pemail" style="color: red;"></span></label>
            <input type="email" id="email" name="email" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
            <p class="lg:w-2/2 mx-auto leading-relaxed">We will never share your Email to anyone else.</p>
          </div>
          <b><span id="spemail" style="color: red;"></span></b>
        </div>
        <div class="p-2 w-full">
          <div class="relative">
            <label for="message" class="leading-7 text-sm text-black-600"><b>Message</b>&nbsp;&nbsp;<span id="pmsg" style="color: red;"></span></label>
            <textarea id="message" name="msg" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
          </div>
          <b><span id="spmsg" style="color: red;"></span></b>
        </div>
        <div class="p-2 w-full">
          <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-yellow-500 rounded text-lg" name="btnsubmit">Submit</button>
        </div>
      </div>
    </div>
  </div>
  <span><?php echo $err; ?></span>
  <span><?php echo $msg; ?></span>
  </form>
</section>