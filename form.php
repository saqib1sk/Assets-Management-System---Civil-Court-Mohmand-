
<?php  if(isset($_POST['submit'])){
   
   $ownership = $_POST['ownership'];
    // Retrieve selected checkboxes
    $benefits = isset($_POST['benefits']) ? $_POST['benefits'] : [];
    
    // Create a string representation of the selected checkboxes
   $benefitsString = implode(", ", $benefits);
   $boiler_installed = $_POST['boiler_installed'];
   $gas_meter = $_POST['gas_meter'];
   $name = $_POST['name'];
   $email = $_POST['email'];
   $phone = $_POST['phone'];
   $address = $_POST['address'];
   $message = $_POST['message'];
    
   // Retrieve selected checkboxes
    $benefits = isset($_POST['benefits']) ? $_POST['benefits'] : [];
    // Create a string representation of the selected checkboxes
    $benefitsString = implode(", ", $benefits);
    $to = 'mindgigspk@gmail.com'; // Replace with your email address
    $subject = 'Form Submission';
    $body = "Name: $name\nEmail: $email\nPhone: $phone\nAddress: $address\nMessage: $message\nOwnerShip:$ownership\n\nBenefits: $benefitsString\nBoiler installed: $boiler_installed\nGas Meter: $gas_meter";

    // Send email
    if (mail($to, $subject, $body)) {
        echo 'Email sent successfully!';
    } else {
        echo 'An error occurred while sending the email.';
    }  
} 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Website</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
	    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <style>
    * {
    margin: 0;
    padding: 0;
}

html {
    height: 100%;
}

/*Background color*/
#grad1 {
    /* background-color: : #9C27B0; */
    /* background-image: linear-gradient(120deg, #FF4081, #81D4FA); */
}

/*form styles*/
#msform {
    text-align: center;
    position: relative;
    margin-top: 20px;
}

#msform fieldset .form-card {
    background: white;
    border: 0 none;
    border-radius: 0px;
    box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
    padding: 20px 40px 30px 40px;
    box-sizing: border-box;
    width: 94%;
    margin: 0 3% 20px 3%;

    /*stacking fieldsets above each other*/
    position: relative;
}

#msform fieldset {
    background: white;
    border: 0 none;
    border-radius: 0.5rem;
    box-sizing: border-box;
    width: 100%;
    margin: 0;
    padding-bottom: 20px;

    /*stacking fieldsets above each other*/
    position: relative;
}

/*Hide all except first fieldset*/
#msform fieldset:not(:first-of-type) {
    display: none;
}

#msform fieldset .form-card {
    text-align: left;
    color: #9E9E9E;
}

#msform input, #msform textarea {
    padding: 0px 8px 4px 8px;
    border: none;
    border-bottom: 1px solid #ccc;
    border-radius: 0px;
    margin-bottom: 25px;
    margin-top: 2px;
    width: 100%;
    box-sizing: border-box;
    font-family: montserrat;
    color: #2C3E50;
    font-size: 16px;
    letter-spacing: 1px;
}

#msform input:focus, #msform textarea:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: none;
    font-weight: bold;
    border-bottom: 2px solid #399939;
    outline-width: 0;
}

/*Blue Buttons*/
#msform .action-button {
    width: 100px;
    background: #399939;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px;
}

#msform .action-button:hover, #msform .action-button:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px #399939;
}

/*Previous Buttons*/
#msform .action-button-previous {
    width: 100px;
    background: #616161;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px;
}

#msform .action-button-previous:hover, #msform .action-button-previous:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px #616161;
}

/*Dropdown List Exp Date*/
select.list-dt {
    border: none;
    outline: 0;
    border-bottom: 1px solid #ccc;
    padding: 2px 5px 3px 5px;
    margin: 2px;
}

select.list-dt:focus {
    border-bottom: 2px solid #399939;
}

/*The background card*/
.card {
    z-index: 0;
    border: none;
    border-radius: 0.5rem;
    position: relative;
}

/*FieldSet headings*/
.fs-title {
    font-size: 25px;
    color: #2C3E50;
    margin-bottom: 10px;
    font-weight: bold;
    text-align: left;
}

/*progressbar*/
#progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    color: lightgrey;
}

#progressbar .active {
    color: #399939;
}

#progressbar li {
    list-style-type: none;
    font-size: 12px;
    width: 25%;
    float: left;
    position: relative;
}

/*Icons in the ProgressBar*/
#progressbar #account:before {
    font-family: FontAwesome;
    /* content: "\f023"; */
    content: "1";
}

#progressbar #personal:before {
    font-family: FontAwesome;
    /* content: "\f007"; */
    content: "2";
}

#progressbar #payment:before {
    font-family: FontAwesome;
    /* content: "\f09d"; */
    content: "3";
}

#progressbar #confirm:before {
    font-family: FontAwesome;
    /* content: "\f00c"; */
    content: "4";
}

/*ProgressBar before any progress*/
#progressbar li:before {
    width: 50px;
    height: 50px;
    line-height: 45px;
    display: block;
    font-size: 18px;
    color: #ffffff;
    background: lightgray;
    border-radius: 50%;
    margin: 0 auto 10px auto;
    padding: 2px;
}

/*ProgressBar connectors*/
#progressbar li:after {
    content: '';
    width: 100%;
    height: 2px;
    background: lightgray;
    position: absolute;
    left: 0;
    top: 25px;
    z-index: -1;
}

/*Color number of the step and the connector before it*/
#progressbar li.active:before, #progressbar li.active:after {
    background: #399939;
}

/*Fit image in bootstrap div*/
.fit-image{
    width: 100%;
    object-fit: cover;
}




.checkbox-group {
    display: flex;
    flex-direction: column;
}

.checkbox-label {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.styled-checkbox {
    display: none;
}

.custom-checkbox {
    display: inline-block;
    width: 20px;
    height: 20px;
    border: 2px solid #000;
    margin-right: 10px;
    background-color: #fff;
}

.styled-checkbox:checked + .custom-checkbox {
    background-color: green;
}



/*Imaged Radio Buttons*/
.radio-group1 {
    position: relative;
    margin-bottom: 25px;
}

.radio1 {
    display:block;
    width: 204;
    height: 104;
    border-radius: 6px;
    background: white;
    box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.1);
    box-sizing: border-box;
    cursor:pointer;
    margin: 8px 2px; 
}

.radio1:hover {
    /* box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.3); */
    background: #399939;
    border-radius: 4;
}

.radio1.selected {
    /* box-shadow: 1px 1px 2px 2px rgba(0, 0, 0, 0.1); */
    background: #399939;
    border-radius: 4;
}

    </style>
  </head>
  <body>
    <main>
        <!-- MultiStep Form -->
<div class="container-fluid" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <h2><strong style="color:#399939">Check Eligibility</strong></h2>
                <p>Check if you meet the government requirements</p>
                <div class="row">
                    <div class="col-md-12 mx-0">
                   
                        <form method="post" action="" id="msform">
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li class="active" id="account"><strong></strong></li>
                                <li id="personal"><strong></strong></li>
                                <li id="payment"><strong></strong></li>
                                <li id="confirm"><strong></strong></li>
                            </ul>
                            <!-- fieldsets -->
                            <fieldset>
                                <div class="form-card">
                             <h2 class="fs-title">    <center> What is your home ownership status? *</center></h2>
 

<br>
                             <center>
                             <div class="col-md-8" style="">
                             <div class="form-check">
  <input class="form-check-input" type="radio" name="ownership" id="flexRadioDefault1" value="Home Owner">
  <label class="form-check-label" for="flexRadioDefault1" style="color:black; font-weight:bold; padding-right:10px;">
  Home Owner
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="ownership" id="flexRadioDefault2" value="Private tenant" checked>
  <label class="form-check-label" for="flexRadioDefault2" style="color:black; font-weight:bold;">
  Private Tenant
  </label>
</div>  
</div>  

</center>
                                   
                                </div>
                                <input type="button" name="next" class="next action-button" value="Next Step"/>
                            </fieldset>


                            <fieldset>
                             <h2 class="fs-title"><center> Please select all the benefits currently received within the home: *</center></h2>
                             <div class="checkbox-group">
    <label class="checkbox-label">
        <input type="checkbox" class="styled-checkbox" name="benefits[]" value="Income Based Jobseeker's allowance (JSA)" />
        <span class="custom-checkbox"></span>
        Income Based Jobseeker's allowance (JSA)
    </label>
    <label class="checkbox-label">
        <input type="checkbox" class="styled-checkbox" name="benefits[]" value="Income Related Employment & Support Allowance (ESA)" />
        <span class="custom-checkbox"></span>
        Income Related Employment & Support Allowance (ESA)
    </label>
    <label class="checkbox-label">
        <input type="checkbox" class="styled-checkbox" name="benefits[]"  value=" Income Support (IS)"/>
        <span class="custom-checkbox"></span>
        Income Support (IS)
    </label>
    <label class="checkbox-label">
        <input type="checkbox" class="styled-checkbox" name="benefits[]" value=" Pension Guarantee Credit" />
        <span class="custom-checkbox"></span>
        Pension Guarantee Credit
    </label>
    <label class="checkbox-label">
        <input type="checkbox" class="styled-checkbox" name="benefits[]" value=" Working Tax Credit (WTC)" />
        <span class="custom-checkbox"></span>
        Working Tax Credit (WTC)
    </label>
    <label class="checkbox-label">
        <input type="checkbox" class="styled-checkbox" name="benefits[]" value=" Child Tax Credit (CTC)" />
        <span class="custom-checkbox"></span>
        Child Tax Credit (CTC)
    </label>
    <label class="checkbox-label">
        <input type="checkbox" class="styled-checkbox" name="benefits[]" value="Universal Credit (UC)" />
        <span class="custom-checkbox"></span>
        Universal Credit (UC)
    </label>
    <label class="checkbox-label">
        <input type="checkbox" class="styled-checkbox" name="benefits[]" value="Housing Benefit (New Eligible Benefit Under ECO4)" />
        <span class="custom-checkbox"></span>
        Housing Benefit (New Eligible Benefit Under ECO4)
    </label>
    <label class="checkbox-label">
        <input type="checkbox" class="styled-checkbox" name="benefits[]" value=" Pension Savings Credit (New Eligible Benefit Under ECO4)" />
        <span class="custom-checkbox"></span>
        Pension Savings Credit (New Eligible Benefit Under ECO4)
    </label>
    <label class="checkbox-label">
        <input type="checkbox" class="styled-checkbox" name="benefits[]" value=" Child Benefit" />
        <span class="custom-checkbox"></span>
        Child Benefit
    </label>
</div>
    <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                                <input type="button" name="next" class="next action-button" value="Next Step"/>
</fieldset>


             
                              
                          
                            <fieldset>

                            <div class="form-card">
                             <h2 class="fs-title">    <center> Was your boiler installed before april 2005? *</center></h2>
                             <center>
                             <div class="col-md-10" style="">
                             <div class="form-check col-md-9">
  <input class="form-check-input" type="radio" onchange="hide_error()" name="boiler_installed" id="" value="YES" checked>
  <label class="form-check-label" for="flexRadioDefault1" style="color:black; font-weight:bold;">YES</label>
</div>

<div class="form-check col-md-9" >
  <input class="form-check-input" type="radio" onchange="show_error()" name="boiler_installed" id="boiler_installed" value="NO" >
  <label class="form-check-label" for="flexRadioDefault2" style="color:black; font-weight:bold;">NO</label>
</div>  

<div class="form-check">
  <input class="form-check-input" type="checkbox" onchange="show_boiler(),uncheck_radio()" name="" id="flexRadioDefault2" value="No Boiler and Radiators">
  <label class="form-check-label" for="flexRadioDefault2" style="color:black; font-weight:normal;">No Boiler and Radiators</label>
</div> 
</div>  


<br>
                                        <div  id="www">
                                        <h2 class="fs-title"><center>Gas meter installed before march 2022? *</center></h2>
                                        <center>
                                        <div class="col-md-10" style="">
                                        <div class="form-check col-md-9">
  <input class="form-check-input" type="radio" onchange="hide_error()" name="gas_meter" id="flexRadioDefault1" value="YES" checked>
  <label class="form-check-label" for="flexRadioDefault1" style="color:black; font-weight:bold;">YES</label>
</div>

<div class="form-check col-md-9">
  <input class="form-check-input" type="radio" onchange="show_error()" name="gas_meter" id="flexRadioDefault2" value="NO" >
  <label class="form-check-label" for="flexRadioDefault2" style="color:black; font-weight:bold;">NO</label>
</div> 
</div> 
</center>
                                      <br>
                                           </div>


                                           <div style="background-color:red;" id="abc">

<span style="color:white;">Funding for boiler grants has been reduced in recent years and unfortunately it doesn’t look like you qualify.
    <br>
We recommend contacting your energy provider, or your local council, or Simple Energy Advice on 0800 444 202.</span>
</div>


</center>
                                </div>
                                
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                                <input type="button" name="make_payment" class="next action-button" value="Next Step"/>
                            </fieldset>






                            <fieldset>
                            <div class="form-card">
                                 
                                    <input type="text" name="name" placeholder="Name" required/>
                                    <input type="email" name="email" placeholder="email" required/>
                                    <input type="text" name="phone" placeholder="Contact No." required/>
                                    <input type="text" name="address" placeholder="Address"/>
                                    <textarea rows="3" cols="7" placeholder="Message" name="message" required></textarea>
                                    <input type="submit" name="submit" class="action-button" value="SUBMIT"/>
                                    </form>
                                </div>
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                               
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    </main>
	<script type="text/javascript">

        $(document).ready(function(){
    
var current_fs, next_fs, previous_fs; //fieldsets
var opacity;

$(".next").click(function(){
    
    current_fs = $(this).parent();
    next_fs = $(this).parent().next();
    
    //Add Class Active
    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
    
    //show the next fieldset
    next_fs.show(); 
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
        step: function(now) {
            // for making fielset appear animation
            opacity = 1 - now;

            current_fs.css({
                'display': 'none',
                'position': 'relative'
            });
            next_fs.css({'opacity': opacity});
        }, 
        duration: 600
    });
});

$(".previous").click(function(){
    
    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();
    
    //Remove class active
    $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
    
    //show the previous fieldset
    previous_fs.show();

    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
        step: function(now) {
            // for making fielset appear animation
            opacity = 1 - now;

            current_fs.css({
                'display': 'none',
                'position': 'relative'
            });
            previous_fs.css({'opacity': opacity});
        }, 
        duration: 600
    });
});

$('.radio-group .radio').click(function(){
    $(this).parent().find('.radio').removeClass('selected');
    $(this).addClass('selected');
});

// $(".submit").click(function(){
//     return false;
// })
    
});
    </script>


<script src="dist/jquery.js"></script>
           <script type="text/javascript">
// get quantity from availible_assets table by assets_id
$(document).ready(function()
{
   // alert();
    $('#abc').css('display', 'none');
    $('#www').css('display', 'none');
// $("#xyz").change(function()
// {
   
//     $('#abc').css('display', 'block');

// });
});


function show_error() {
   // alert();
   $('#abc').css('display', 'block');
   $('#www').css('display', 'none');
}


function hide_error() {
   // alert();
   $('#abc').css('display', 'none');
//    $('#www').css('display', 'none');
}

function show_boiler() {
   // alert();
   $('#www').css('display', 'block');

}

function uncheck_radio() {
   // alert();
   $('#boiler_installed').prop('checked', false);

}


</script>
  </body>
</html>