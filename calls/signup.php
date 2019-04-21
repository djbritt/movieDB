<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <style>
        html {
            height: 100%;
        }
        legend {
            color: blue;
            font-weight: bold;
            font-size: 20px;
            border: 3px solid;
        }
        
        #btn {
            border-top: 1px solid #96d1f8;
            background: #65a9d7;
            background: -webkit-gradient(linear, left top, left bottom, from(#3e779d), to(#65a9d7));
            background: -webkit-linear-gradient(top, #3e779d, #65a9d7);
            background: -moz-linear-gradient(top, #3e779d, #65a9d7);
            background: -ms-linear-gradient(top, #3e779d, #65a9d7);
            background: -o-linear-gradient(top, #3e779d, #65a9d7);
            padding: 5px 10px;
            -webkit-border-radius: 8px;
            -moz-border-radius: 8px;
            border-radius: 8px;
            -webkit-box-shadow: rgba(0, 0, 0, 1) 0 1px 0;
            -moz-box-shadow: rgba(0, 0, 0, 1) 0 1px 0;
            box-shadow: rgba(0, 0, 0, 1) 0 1px 0;
            text-shadow: rgba(0, 0, 0, .4) 0 1px 0;
            color: white;
            font-size: 14px;
            font-family: Georgia, serif;
            text-decoration: none;
            vertical-align: middle;
        }
        
        #btn:hover {
            border-top-color: #28597a;
            background: #28597a;
            color: #ccc;
        }
        
        #btn:active {
            border-top-color: #1b435e;
            background: #1b435e;
        }
        input {
            width: 190px;
        }
        
    </style>
</head>

<body>
    <a href="../index.php"><button>Return Home</button></a>
    <h2>Sign up for an Account!</h2>

    <!--<form onsubmit="return validateForm()" id="registerForm">-->
    <form id="registerForm">
            <table>
                <tr>
                    <td>First Name: </td>
                    <td><input type="text" id="firstName" name="firstName"><span style="color: red;" id="firstNameError"></span></td>
                </tr>
                <tr>
                    <td>Last Name: </td>
                    <td><input type="text" id="lastName" name="lastName"><span style="color: red;" id="lastNameError"></span></td>
                </tr>
                <tr>
                    <td>Email: </td>
                    <td><input type="text" name="email" id="email"><span style="color: red;" id="emailError"></span></td>
                </tr>
                <tr>
                    <td>Phone Number: </td>
                    <td><input type="text" name="phone" id="phone" /><span id="phoneError" style="color:red;" class="error"></span></td>
                </tr>
                <tr>
                    <td>Zip Code: </td>
                    <td><input type="text" name="zip" id="zip" /><span id="zipError" style="color:red;" class="error"></span></td>
                </tr>
                <tr>
                    <td>State: </td>
                    <td><input type="text" name="state" id="stateCode" /><span id="stateError" style="color:red;" class="error"></span></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" id="username"><span id="usernameError" style="color:red;" class="error"></span></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" id="password" /><span style="color: red;" id="passwordError"></span></td>
                </tr>
                <tr>
                    <td>Type Password Again: </td>
                    <td><input type="password" name="rePassword" id="rePassword" /><span style="color: red;" id="rePasswordError"></span></td>
                </tr>
            </table>
            <br>
            <button type="submit" class="buton">Sign up!</button>
            <!--<a href="updateMovie.php" type="submit" class="button">Signup!</a>-->
    </form>
    <div id="data"></div>
</body>
<script>

    var isValid = true;
    // function validateForm() {
    $("#registerForm").submit(function(e) {
        e.preventDefault()
    
        $("#firstNameError").html("");
        $("#lastNameError").html("");
        $("#emailError").html("");
        $("#usernameError").html("");
        $("#passwordError").html("");
        $("#rePasswordError").html("");
        $("#stateError").html("");
        $("#phoneError").html("");
        $("#zipError").html("");
        $("#city").html("");

        if ($('#firstName').val().trim().length == 0) {
            isValid = false;
            $("#firstNameError").html(" First name must not be blank...");
        }
        if ($('#lastName').val().trim().length == 0) {
            isValid = false;
            $("#lastNameError").html(" Last name must not be blank...");
        }
        if (/^[a-z]+@[a-z]+\.[a-z]{3}$/i.test($("#email").val()) == false) {
            isValid = false;
            $("#emailError").html(" Email must be typed correctly...");
        }
        if (/\(\d{3}\) \d{3}\-\d{4}/.test($("#phone").val()) == false) {
            isValid = false;
            $("#phoneError").html(" Phone number must be formatted like (111) 111-1111");
        }
        if (/\b[0-9]{5}\b/.test($("#zip").val()) == false) {
            isValid = false;
            $("#zipError").html(" Zip code must have five digits only...");
        }
        if (/^(AL|Alabama|alabama|AK|Alaska|alaska|AZ|Arizona|arizona|AR|Arkansas|arkansas|CA|California|california|CO|Colorado|colorado|CT|Connecticut|connecticut|DE|Delaware|delaware|FL|Florida|florida|GA|Georgia|georgia|HI|Hawaii|hawaii|ID|Idaho|idaho|IL|Illinois|illinois|IN|Indiana|indiana|IA|Iowa|iowa|KS|Kansas|kansas|KY|Kentucky|kentucky|LA|Louisiana|louisiana|ME|Maine|maine|MD|Maryland|maryland|MA|Massachusetts|massachusetts|MI|Michigan|michigan|MN|Minnesota|minnesota|MS|Mississippi|mississippi|MO|Missouri|missouri|MT|Montana|montana|NE|Nebraska|nebraska|NV|Nevada|nevada|NH|New Hampshire|new hampshire|NJ|New Jersey|new jersey|NM|New Mexico|new mexico|NY|New York|new york|NC|North Carolina|new carolina|ND|North Dakota|north dakota|OH|Ohio|ohio|OK|Oklahoma|oklahoma|OR|Oregon|oregon|PA|Pennsylvania|pennsylvania|RI|Rhode Island|rhode island|SC|South Carolina|south carolina|SD|South Dakota|south dakota|TN|Tennessee|tennessee|TX|Texas|texas|UT|Utah|utah|VT|Vermont|vermont|VA|Virginia|virginia|WA|Washington|washington|WV|West Virginia|west virginia|WI|Wisconsin|wisconsin|WY|Wyoming|wyoming)$/.test($("#stateCode").val()) == false) {
            console.log("in state test")
            console.log($("#stateCode").val())
            isValid = false;
            $("#stateError").html(" State code must have two digits only...");
        }
        if ($('#username').val().trim().length < 7) {
            var value = validateUsername();
            isValid = value;
        }
        if (/([a-zA-Z0-9]){6,}/.test($("#password").val()) == false) {
            isValid = false;
            $("#passwordError").html(" Password must be typed correctly...");
        }
        if (/([a-zA-Z0-9]){6,}/.test($("#password").val()) == false) {
            isValid = false;
            $("#passwordError").html(" Password must be longer than 6 letters, and only have letters or numbers...");
        }
        if ($("#rePassword").val() != $("#password").val()) {
            isValid = false;
            $("#rePasswordError").html(" Passwords must match...");
        }
        if (isValid != false) {
            ajaxCall()
        } 
        
    })
    
    $("#username").change(function(){ 
        if ($("#username").val().length == 0) {
            $("#usernameError").html("")
        } else {
            validateUsername(); 
        }
    });

    function validateUsername() {
        $("#usernameError").html("");
        // console.log($("#username").val().length);
        console.log("in validateUsername")
        if ($("#username").val().length < 2) {
            $("#username").css("background-color", "white")
            $("#usernameError").css("color", "red").html(" Username must have a length longer than 2!")
            isValid = false;  
        } else if ($("#username").val().length >= 2){
            console.log("username verify ajaxCall")
            $.ajax({
                type: "GET",
                url: "verifyUsername.php?username=" + $("#username").val(),
                dataType: "json"
            })
            .done(function(data) {
                console.log(data);
                if (data != false) {
                    $("#username").css("background", "red");
                    $("#usernameError").html(" Username is taken!").css("color", "red");
                    isValid = false;
                } else {
                    $("#username").css("background", "green");
                    $("#usernameError").html(" Username is available!").css("color", "white")
                    isValid = true;
                }
            })
            .fail(function(xhr, status, errorThrown) {
                console.log("Sorry, there was a problem!");
                console.log(xhr)
            })
            .always(function(xhr, status) {
                console.log("The request is complete!");
            });
            
        } else {
            isValid = true;
        }
        return isValid
    }
    
    function ajaxCall() {
            var name = $("#firstName").val() + " " + $("#lastName").val();;
            var email = $("#email").val();
            var phone = $("#phone").val();
            var zip = $("#zip").val();
            var state = $("#stateCode").val();
            var username = $("#username").val();
            var password = $("#password").val();
            // console.log(name)
            // console.log(email)
            // console.log(phone)
            // console.log(zip)
            // console.log(stateCode)
            // console.log(username)
            // console.log(password)
            $.ajax({
                type: "POST",
                url: "registerUser.php",
                data: {name: name,
                        email: email, 
                        phone: phone,
                        zip: zip,
                        state: state,
                        username: username,
                        password: password
                }
            })
            .done(function(data) {
                $("#data").append(data);
                // console.log(data);
            })
            .fail(function(xhr, status, errorThrown) {
                console.log("Sorry, there was a problem!");
            })
            .always(function(xhr, status) {
                console.log("The request is complete!");
            });
        }
</script>

</html>
