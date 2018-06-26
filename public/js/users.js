$(document).ready(function(){
    var common = new IMSCommon();

    // $("#designation").autocomplete({
    //     source: designation
    // });

    $("#createUserForm").validate({
        rules:
            {
                fullNameInput:
                    {
                        required: true,
                        maxlength: 40
                    },
                emailInput:
                    {
                        required: true,
                        email: true,
                        // checkEmailExist:true,
                    },
                mobileInput:{
                    number: true,
                    minlength:6,
                    maxlength: 20
                },
                countryCodeInput:{
                    number: true,
                    maxlength: 2
                },
                designationInput:{
                    required: true
                },
                departmentSBox:{
                    required: true
                },
                departmentCriteriaSBox:{
                    required: true
                }
            },
        messages:
            {
                fullNameInput:
                    {
                        required: "You have not entered a Full Name. Please enter Full Name.",
                        maxlength: "Please enter no more than 40 characters."
                    },
                emailInput:
                    {
                        required: "You have not entered a Email. Please enter Email.",
                        email:"You have entered a wrong format Email address, please enter another one.",
                        // checkEmailExist:"Email already is exists."
                    },
                mobileInput:{
                    number: "You have entered a wrong mobile number",
                    minlength:"Your Mobile number is too short. Try another Mobile number between 6 to 20 characters.",
                    maxlength:"Your Mobile number is too long. Try another Mobile number between 6 to 20 characters."

                },
                countryCodeInput:{
                    number: "You have entered a wrong country code number",
                    maxlength: "Please enter no more than 2 characters."
                },
                designationInput:{
                    required: "You have not entered a Designation. Please enter Designation."
                },
                departmentSBox:{
                    required: "You have not selected a Department. Please select a Department."
                },
                departmentCriteriaSBox:{
                    required: "You have not selected a Department Criteria. Please select Department Criteria."
                }
            },
        highlight : function(element) {
            $(element).addClass('has_error');
        },
        unhighlight : function(element) {
            $(element).removeClass('has_error');
        },
        errorPlacement: function(error, element) {
            $(element).parents(".col-sm-4").find(".text-danger").html(error);
        }
    });

    $("#submitCreateUserBtn").click(function () {
        if ($("#createUserForm").valid()){
            $( "#createProfileForm" ).submit();
        }
    });


    jQuery.validator.addMethod("checkEmailExist", function(value, element, param){
        var status = true;
        var token  = $("#token").val();
        var profileId = $("#profileId").val();
        $.ajax({
            type:'GET',
            url: fnCommon.getBaseUrl() +'profiles/checkEmail',
            async: false,
            data:{"email" : value , "_token" : token, "profileId": profileId},
            success:function(result){
                if (result.userId != "0"){
                    status = false;
                }
            }
        });

        return status;
    });

    jQuery.validator.addMethod("checkMobileExist", function(value, element, param){
        var status = true;
        var token  = $("#token").val();
        var profileId = $("#profileId").val();

        var countryCode = $("#countryCode").val();
        var mobile = $("#mobileNumber").val();

        if (countryCode !="" && mobile!="") {
            var mobileNumber = countryCode+mobile;
            $.ajax({
                type:'GET',
                url: fnCommon.getBaseUrl() + 'profiles/checkMobileNumber',
                async: false,
                data:{"mobileNumber" : mobileNumber , "_token" : token, "profileId" : profileId},
                success:function(result){
                    if (result.userId != "0"){
                        status = false;
                    }
                }
            });
        }

        return status;
    });


    $("#editProfileForm").validate({
        rules:
            {
                fullname:
                    {
                        required: true,
                        maxlength: 40
                    },
                email:
                    {
                        required: true,
                        email: true,
                        checkEmailExist:true,
                    },
                mobileNumber:{
                    number: true,
                    minlength:6,
                    maxlength: 20,
                    checkMobileExist:true,
                },
                countryCode:{
                    number: true,
                    maxlength: 2
                },
                designation:{
                    required: true
                },
                department:{
                    required: true
                },
                profileStatus:{
                    required: true
                }
            },
        messages:
            {
                fullname:
                    {
                        required: "You have not entered a Full Name. Please enter Full Name.",
                        maxlength: "Please enter no more than 40 characters."
                    },
                email:
                    {
                        required: "You have not entered a Email. Please enter Email.",
                        email:"You have entered a wrong format Email address, please enter another one.",
                        checkEmailExist: "The email address is taken, please enter another one.",
                    },
                mobileNumber:{
                    number: "You have entered a wrong mobile number",
                    minlength:"Your Mobile number is too short. Try another Mobile number between 6 to 20 characters.",
                    maxlength:"Your Mobile number is too long. Try another Mobile number between 6 to 20 characters.",
                    checkMobileExist: "The Mobile Number is taken, please enter another one.",

                },
                countryCode:{
                    number: "You have entered a wrong country code number",
                    maxlength: "Please enter no more than 2 characters."
                },
                designation:{
                    required: "You have not entered a Designation. Please enter Designation."
                },
                department:{
                    required: "You have not selected a Department. Please select a Department."
                },
                profileStatus:{
                    required: "You have not selected a Profile Status. Please select Profile Status."
                }
            },
        highlight : function(element) {
            $(element).addClass('has_error');
        },
        unhighlight : function(element) {
            $(element).removeClass('has_error');
        },
        errorPlacement: function(error, element) {
            $(element).parents(".form-item").find(".msgError").html(error);
        }
    });

    $("#editProfileBtn").click(function () {
        if ($("#editProfileForm").valid()){
            $( "#editProfileForm" ).submit();
        }
    });


    jQuery.validator.addMethod("checkRepeatPassword", function(value, element, param){
        var status = true;
        var newPassword = $("#newPassword").val();
        if (newPassword != value) {
            status = false;
        }

        return status;
    });

    $("#userAccountForm").validate({
        rules:
            {
                repeatPassword: {
                    checkRepeatPassword: true
                }
            },
        messages:
            {
                repeatPassword: {
                    checkRepeatPassword: "These passwords don't match."
                }

            },
        highlight : function(element) {
            $(element).addClass('has_error');
        },
        unhighlight : function(element) {
            $(element).removeClass('has_error');
        },
        errorPlacement: function(error, element) {
            $(element).parents(".form-item").find(".msgError").html(error);
        }
    });

    $("#userUpdateBtn").click(function () {
        if ($("#userAccountForm").valid()){
            $( "#userAccountForm" ).submit();
        }
    });

    $("#createProfileBackBtn, #userUpdateBtnBackBtn").click(function () {
        window.location.href = fnCommon.getBaseUrl() + "profiles";
    })

    $("#email").blur(function(){
        var token = $("#token").val();
        var value = $("#email").val();
        if (value !="") {
            $.ajax({
                type:'GET',
                url:fnCommon.getBaseUrl() + 'profiles/checkEmail',
                async: false,
                data:{"email" : value , "_token" : token},
                success:function(result){
                    if (result.userId != "0"){
                        var link =fnCommon.getBaseUrl() +  "profiles/edit/" + result.userId;
                        $("#emailExist").html('<a href='+ link +'>The profile which I want to create matches with the selected profile, Edit this profile</a>');
                        $('#matches_profile').val(1);
                    } else {
                        $("#emailExist").html(" ");
                        $('#matches_profile').val(0);
                    }
                }
            });
        } else {
            $("#emailExist").html(" ");
        }
    });

    $("#countryCode,#mobileNumber").blur(function(){
        var token = $("#token").val();
        var countryCode = $("#countryCode").val();
        var mobile = $("#mobileNumber").val();
        if (countryCode !="" && mobile!="") {
            var mobileNumber = countryCode+mobile;
            $.ajax({
                type:'GET',
                url: fnCommon.getBaseUrl() + 'profiles/checkMobileNumber',
                data:{"mobileNumber" : mobileNumber , "_token" : token},
                success:function(result){
                    if (result.userId != "0"){
                        var link = fnCommon.getBaseUrl() + "profiles/edit/" + result.userId;
                        $("#mobileExist").html('<a href='+ link +'>The profile which I want to create matches with the selected profile, Edit this profile</a>');
                    } else {
                        $("#mobileExist").html(" ");
                    }
                }
            });
        } else {
            $("#mobileExist").html(" ");
        }
    });

    $("#resetLinkBtn").click(function () {
        $("#resetLinkTxt").val("1");
        $("#userAccountForm").submit();
    });
});
