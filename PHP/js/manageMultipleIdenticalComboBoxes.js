$(document).ready(function() {
    var selectBoxes = document.getElementsByClassName('select');
    var disableOtherBoxes = function () {
        'use strict';
        var selectedValues = [], options;
        for (var i = 0; i < selectBoxes.length; i++) {
            selectedValues.push(selectBoxes[i].value);
            for (var j = 0; j < selectBoxes.length; j++) {
                if (selectBoxes[j] !== selectBoxes[i]) {
                    options = selectBoxes[j].querySelectorAll('option');
                    for (var k = 0; k < options.length; k++) {
                        options[k].hidden = (selectedValues.indexOf(options[k].value) > -1);
                    }
                }
            }
        }
    };
    var checkCompletion = function () {
        var count = 0;
        for (var i = 0; i < selectBoxes.length; i++) {
            if (selectBoxes[i].value == "not") {
                count++
            }
        }
        if (count == 0) {
            $('#genMessage').text("Launch your event now.");
            $('#gen').removeAttr('disabled');
        } else {
            $('#genMessage').text("Select All Players");
            $('#gen').attr('disabled','disabled');
        }
    };
    for (var i = 0; i < selectBoxes.length; i++) {
        selectBoxes[i].addEventListener('change', function () {
            disableOtherBoxes();
            checkCompletion()
        }, false);
    }
});