(function(window) {

    function IMSCommon() {
        // constructor
    }

    /**
     * Empty select box
     * @param elementId
     * @param name
     * @param value
     * @param defaultValue
     * @return
     */
    IMSCommon.prototype.emptySelectBox = function (elementId, name, value, defaultValue) {
        id = '#'+elementId;
        if (defaultValue) {
            $(id).find('option').remove().end().append("<option value='" + value + "'>" + name + "</option>");
        } else {
            $(id).find('option').remove().end();
        }
    };

    /**
     * General option for select box by parent
     * @param arrayData
     * @return string
     */
    IMSCommon.prototype.fetchData = function(arrayData, defaultValue) {
        var str = "";
        for (var i = 0; i < arrayData.length; i++) {
            str = str + "<option value='"+ arrayData[i].id +"' "+ (defaultValue && parseInt(defaultValue) == arrayData[i].id ? "selected" : "") + ">"+ arrayData[i].name +"</option>";
        }

        return str;
    };

    /**
     * Gereral option for dataList
     * @param arrayData
     * @return string
     */
    IMSCommon.prototype.suggestData = function(arrayData) {
        var str = "";
        for (var i = 0; i < arrayData.length; i++) {
            str = str + "<option value='"+ arrayData[i].fullname + "'>"+ arrayData[i].email +"</option>";
        }
        return str
    };

    /**
     * Gereral option for dataList
     * @param arrayData
     * @return string
     */
    IMSCommon.prototype.suggestDesignationData = function(arrayData) {
        var str = "";
        for (var i = 0; i < arrayData.length; i++) {
            str = str + "<option value='"+ arrayData[i].name + "'></option>";
        }
        return str
    };

    IMSCommon.prototype.showLoading = function () {
        $("#loading-process").show();
    };

    IMSCommon.prototype.hideLoading = function () {
        $("#loading-process").hide();
    };

    IMSCommon.prototype.getBaseUrl = function () {
        return baseUrl + "/";
    };

    IMSCommon.prototype.getValueOrEmpty = function (element) {
        var value = $(element).val();
        if ($(element).val() == null) {
            value = ""
        }

        return value;
    };

    window.IMSCommon = IMSCommon;
}(window));