$(document).ready(function(){
    var common = new IMSCommon();
    // validateIncidentCreateForm();

    // $('.date-picker-field').datetimepicker({
    //     useCurrent: false,
    //     format: 'D/MM/YYYY H:mm:ss'
    // });
    // $.validator.addMethod(
    //     "regex",
    //     function(value, element, regexp) {
    //         var re = new RegExp(regexp);
    //         return this.optional(element) || re.test(value);
    //     },
    //     "Wrong format"
    // );
    // jQuery.validator.addMethod("requiredTextArea", function(value, element, param){
    //     return (CKEDITOR.instances['incidentDescriptionInput'].getData() != '');
    // });

    $("#btnAttachmentAddMore").click(function () {
        if (attachmentOrder <=15) {
            var html = "<div id='"+ attachmentOrder +"' class='attachment-container'>";
            html += "      <div class='attachment-item-left'>";
            html += "         <input type='file' name='fileAttachment[]' id='fileAttachment class='fileAttachmentAddMore' value=''>";
            html += "         <div class='msgError'></div>";
            html += "      </div>";
            html += "      <div class='attachment-item-right'>";
            html += "          <img onclick='removeParticularsContain(this);' style='cursor: pointer'";
            html += "             class='attachmentFileIcon' src='/images/icon-delete.png'>";
            html += "       </div>";
            html += "       <div class='attachment-item-magin'></div>";
            html += "    </div>";

            var $div = $('div[class^="attachment-container"]:last');
            $div.after(html);
            var elementCount = $('.attachment-container').length;
            ++ attachmentOrder;
        }
    });

    $("#btnAttachmentAddMoreEdit").click(function () {
        var length = $(".attachment-container").length;
        if (length <= 15){
            addMoreFiledAttachmentEdit("attachment-container", "fileAttachment");
        }
    });

    $("#addMoreButton").click(function () {
        var $div = $('div[id^="particulars-item"]:last');
        var num = parseInt( $div.prop("id").match(/\d+/g), 10 ) +1;

        if (num <=15) {
            var $particularsItem = $div.clone().prop('id', 'particulars-item'+num );
            $div.after($particularsItem);
            $particularsItem.find(".allowIconRemove").css('display', 'block');

            $particularsItem.find(".form-control").each(function(i, obj) {
                var elementNameAttr = $(this).attr("id");
                var newName = "particulars["+ num +"]["+ elementNameAttr +"]";
                $(this).attr("name", newName);
                $particularsItem.find(".text-field").html("");
            });

            $particularsItem.find(":input").val("");
            $particularsItem.find(".text-danger").html("");
        }
    });

    $("#particularsIsAllow").click(function () {
        if ($(this).is(':checked')) {
            $("#particulars-container").show(100);
        } else {
            $("#particulars-container").hide(100);
        }
    });

    $("#btnCreateIncident").click(function () {
        if ($("#incidentCreateFrm").valid()){
            if (validFileExtention() && validParticulars()) {
                $( "#incidentCreateFrm" ).submit();
            }
        }
    });

    $("#btnIncidentBack").click(function () {
        var incidentId = $("#incidentId").val();
        if (incidentId !="") {
            window.location.href = commonFunction.getBaseUrl() + "incidents/show/"+incidentId;
        }
    });

    $("#btnIncidentCreateBack").click(function () {
        window.location.href = commonFunction.getBaseUrl() + "incidents";
    });

    $("#cboTypeIncident1").change(function(){
        commonFunction.emptySelectBox("cboTypeIncident2", "Please select", "", true);
        commonFunction.emptySelectBox("cboTypeIncident3", "Please select", "", true);
        var cboTypeIncident1Value = $(this).val();
        var selectedData =[];
        selectedData.push(cboTypeIncident1Value);

        var incidentLevel = getTypeIncidentLevel();
        var option = commonFunction.filterIncidentLevelByParent(selectedData, incidentLevel);
        if (option!="") {
            $('#cboTypeIncident2').append(option);
        }

    });

    $("#cboTypeIncident2").change(function(){
        commonFunction.emptySelectBox("cboTypeIncident3", "Please select", "", true);
        var cboTypeIncident2Value = $(this).val();
        var selectedData =[];
        selectedData.push(cboTypeIncident2Value);

        var incidentLevel = getTypeIncidentLevel();
        var option = commonFunction.filterIncidentLevelByParent(selectedData, incidentLevel);
        if (option!="") {
            $('#cboTypeIncident3').append(option);
        }
    });

    $("#cboIncidentStatus").change(function () {
        var value = $(this).val();
        if (value == '12') {
            $("#follow-up-containner").show();
        } else {
            $("#follow-up-containner").hide();
        }
    });

    $("#btnFollowUpAddMore").click(function () {
        addMoreFiledAttachmentEdit("followUp-container", "followUpAttachment");
    });


    function validFileExtention() {
        var isValid = true;
        $("input.fileAttachmentAddMore").each(function(){
            var file = $(this).val();
            if (file != "") {
                var extension = file.substr( (file.lastIndexOf('.') +1) );
                if (!commonFunction.checkFileExtention(extension)) {
                    isValid = false;
                    $(this).parent().find(".msgError").html("This file is not allowed. Please upload one of these formats : PNG, JPG, JPEG, PDF, DOC, XLS, PPT, DOCX, XLSX, PPTX,ZIP");
                } else if (!commonFunction.checkFileSize(this.files[0].size)){
                    isValid = false;
                    $(this).parent().find(".msgError").html("File attachment should be less than 20MB");
                } else {
                    $(this).parent().find(".msgError").html("");
                }
            }
        });

        return isValid;
    }

    function validParticulars() {
        var isValid = true;
        if ($("#particularsIsAllow").is(':checked')) {
            $("input.particulars_email").each(function(){
                var email = $(this).val();
                if (email!="") {
                    if (!commonFunction.isValidEmailAddress(email)) {
                        isValid = false;
                        $(this).parent().find(".msgError").html("Email address not formatted correctly");
                    } else {
                        $(this).parent().find(".msgError").html("");
                    }
                }
            });
        }
        return isValid;
    }

    function addMoreFiledAttachmentEdit(elementClass, name) {
        var html ="<div id='' class='"+ elementClass +"'>";
        html+="  <div style='width: 175px; float: left;'>";
        html+="      <input type='file' name='"+name+"[]' id='fileAttachment' class='fileAttachmentInput fileAttachmentAddMore' value=''>";
        html+= "  <div class='msgError'></div>";
        html+="  </div>";
        html+="<div style='float: right;'>";
        html+=" <a href='#'></a>";
        html+="    <img onclick='removeParticularsContain(this);' style='cursor: pointer'";
        html+="      class='attachmentFileIcon' src='/img/icon-delete.png'>";
        html+="</div>";

        html+="<div style='margin-top: 2px; margin-bottom: 2px; clear: both;'></div>";
        html+="</div>";

        var $div = $("div[class^='"+ elementClass +"' ]:last");
        $div.after(html);
    }

    $(".fileAttachmentEdit").change(function () {
        $(this).parents(".attachment-container").find(".fileAttachmentName").html("");
        var fileNameRemove = $(this).attr("fileNameRemove");
        //var value = $(this).val().replace(/C:\\fakepath\\/i, '');
        commonFunction.joinValueOfElement("#attachmentRemove", fileNameRemove);
        commonFunction.removeValueOfElement("#attachmentOld", fileNameRemove);
        if ($(".attachment-container").length == 1) {
            $("#attachmentOld").val("");
        }
    });


    $(".removeAttachmentFileOfPageEdit").click(function () {
        var fileNameRemove = $(this).attr("fileNameRemove");
        commonFunction.joinValueOfElement("#attachmentRemove", fileNameRemove)
        commonFunction.removeValueOfElement("#attachmentOld", fileNameRemove);

        $(this).parents(".attachment-container").remove();
        if ($(".attachment-container").length == 1) {
            $("#attachmentOld").val("");
            var $div = $('div[class^="attachment-container"]:last');
            var content ="<div class='attachment-container'><input type='file' name='fileAttachment[]' id='fileAttachment' class='' value=''> </div>";
            $div.after(content);
        }
    });

    $(".removeFollowUpAttachment").click(function () {
        var fileNameRemove = $(this).attr("fileNameRemove");
        commonFunction.joinValueOfElement("#followUpattachmentRemove", fileNameRemove)
        commonFunction.removeValueOfElement("#followUpFileOld", fileNameRemove);

        $(this).parents(".followUp-container").remove();
        if ($(".followUp-container").length == 1) {
            $("#followUpFileOld").val("");
            var $div = $('div[class^="followUp-container"]:last');
            var content ="<div class='followUp-container'><input type='file' name='fileAttachment[]' id='fileAttachment' class='' value=''> </div>";
            $div.after(content);
        }
    });

    $(document).on('click', '#incidentsTable tr', function(event) {
        if(!$(event.target).is('a') && !$(event.target).is('input[type=checkbox]')) {

            var $a = $(this).find('a').first();

            if (typeof $a != 'undefined' && $a.length) {
                $a[0].click()
            }
        }
    });

    $('table #all').change(function() {
        if ($(this).is(':checked') == true) {
            $('#incidentsTable tbody input[type=checkbox]').attr('checked', true);
        } else {
            $('#incidentsTable tbody input[type=checkbox]').attr('checked', false);
        }
    });
});

var form = $("#incidentCreateForm").show();
var submited = false;

$("#incidentCreateForm").steps({
    headerTag: "h6"
    , bodyTag: "section"
    , transitionEffect: "none"
    , titleTemplate: '<span class="step">#index#</span> #title#'
    , labels: {
        finish: "Submit"
    }
    , onStepChanging: function (event, currentIndex, newIndex) {
        return currentIndex > newIndex || !(3 === newIndex && Number($("#age-2").val()) < 18) && (currentIndex < newIndex && (form.find(".body:eq(" + newIndex + ") label.error").remove(), form.find(".body:eq(" + newIndex + ") .error").removeClass("error")), form.validate().settings.ignore = ":disabled,:hidden", form.valid())
    }
    , onFinishing: function (event, currentIndex) {
        return true
    }
    , onFinished: function (event, currentIndex) {
        // swal("Your Form Submitted!", "Sed dignissim lacinia nunc. Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor.");
        // $("#incidentCreateForm .actions a[href='#finish']").attr('disabled', 'disabled');
        if (!submited) {
            submited = true;
            form.submit();
        }
    }
}).validate({
    ignore: "input[type=hidden]"
    , errorClass: "text-danger"
    , successClass: "text-success"
    , highlight: function (element, errorClass) {
        $(element).removeClass(errorClass)
    }
    , unhighlight: function (element, errorClass) {
        $(element).removeClass(errorClass)
    }
    , errorPlacement: function (error, element) {
        // error.insertAfter(element)
        $(element).parents(".col-sm-8").find(".text-danger").html(error);
        $(element).parents(".col-sm-10").find(".text-danger").html(error);
    }
    , rules: {
        startTime:{
                required: true
            },

            categorySelectbox:
                {
                    required: true,
                },

            level1Selectbox:
                {
                    required: true,
                },

            level2Selectbox:
                {
                    required: true,
                },

            level3Selectbox:
                {
                    required: true,
                },

            "departmentSelectBox[]":
                {
                    required: true,
                },

            "departmentInfoSelectBox[]":
                {
                    required: true,
                },

            locationIncidentSelectBox:
                {
                    required: true,
                },

            locationDescriptionIncidentInput:
                {
                    required: true,
                    maxlength: 20000
                },

            reportInput:
                {
                    maxlength: 255
                },

            NOONTOInput:
                {
                    maxlength: 100
                },

            attendInput:
                {
                    maxlength: 255
                },

            MTSGNoInput:
                {
                    maxlength: 100
                },

            PoliceReportInput:
                {
                    maxlength: 200
                },

            incidentTitleInput:
                {
                    required: true,
                    minlength:3,
                    maxlength:255
                },
            incidentDescriptionInput:
                {
                required: true,
                minlength:3,
                maxlength:15000
                },

            actionTakenInput:
                {
                    maxlength: 10000
                },

            caseSummaryInput:
                {
                    maxlength: 15000
                }

    }, messages:
        {
            startTime: {
                required: "You have not entered Incident Date. Please enter the date"
            },
            categorySelectbox:
                {
                    required: "You have not entered Category. Please enter Category",
                },
            level1Selectbox:
                {
                    required: "You have not entered Type of Incident Level 1. Please enter Type of Incident Level 1",
                },
            level2Selectbox:
                {
                    required: "You have not entered Type of Incident Level 2. Please enter Type of Incident Level 2",
                },

            locationIncidentSelectBox:
                {
                    required: "You have not entered Location of Incident. Please enter Location of Incident",
                },

            level3Selectbox:
                {
                    required: "You have not entered Type of Incident Level 3. Please enter Type of Incident Level 3",
                },

            "departmentInfoSelectBox[]":
                {
                    required: "You have not entered Department. Please enter Department",
                },

            locationDescriptionIncidentInput:
                {
                    required: "You have not entered Location of Incident. Please enter Location of Incident",
                    maxlength: "Your Location Description is too long. Try another Location Description between 0 to 20,000 characters."
                },

            NOONTOInput:
                {
                    maxlength: "Your NOO NTO is too long. Try another NOO NTO between 0 to 255 characters.",
                },

            reportInput:
                {
                    maxlength: "Your Reported by is too long. Try another Reported by between 0 to 255 characters.",
                },

            attendInput:
                {
                    maxlength: "Your Attended By is too long. Try another Attended By between 0 to 255 characters.",
                },

            MTSGNoInput:
                {
                    maxlength: "Your MTSG Issued is too long. Try another MTSG Issued between 0 to 255 characters.",
                },

            PoliceReportInput:
                {
                    maxlength: "Your Police Report No is too long. Try another Police Report No between 0 to 255 characters.",
                },

            incidentTitleInput:
                {
                    required: "You have not entered a Incident Title. Please enter Incident Title.",
                    minlength: "Your Incident Title is too short. Try another Incident Title between 3 to 255 characters.",
                    maxlength: "Your Incident Title is too long. Try another Incident Title between 3 to 255 characters."
                },
            incidentDescriptionInput:
                {
                    required: "You have not entered a Incident Description. Please enter Incident Description.",
                    minlength: "Your Incident Description is too short. Try another Incident Description between 3 to 15000 characters.",
                    maxlength: "Your Incident Description is too long. Try another Incident Description between 3 to 15000 characters."
                },
            "departmentSelectBox[]": {
                required: "You have not entered Department. Please enter Department",
            },

            actionTakenInput:
                {
                    maxlength: "Your Action Taken is too long. Try another Action Taken between 0 to 10,000 characters.",
                },

            caseSummaryInput:
                {
                    maxlength: "Your Case Summary is too long. Try another Case Summary between 0 to 15,000 characters.",
                }
        }
});
