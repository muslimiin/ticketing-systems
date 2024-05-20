<script>
    /**
     * Check all the permissions
     */
    $("#checkPermissionAll").click(function() {
        if ($(this).is(':checked')) {
            // check all the checkbox
            $('input[type=checkbox]').prop('checked', true);
        } else {
            // un check all the checkbox
            $('input[type=checkbox]').prop('checked', false);
        }
    });

    function checkPermissionByGroup(className, checkThis) {
        const groupIdName = $("#" + checkThis.id);
        const classCheckBox = $('.' + className + ' input');

        if (groupIdName.is(':checked')) {
            classCheckBox.prop('checked', true);
        } else {
            classCheckBox.prop('checked', false);
        }
        implementAllChecked();
    }

    function checkSinglePermission(groupClassName, groupID, countTotalPermission) {
        const classCheckbox = $('.' + groupClassName + ' input');
        const groupIDCheckBox = $("#" + groupID);

        // if there is any occurance where something is not selected then make selected = false
        if ($('.' + groupClassName + ' input:checked').length == countTotalPermission) {
            groupIDCheckBox.prop('checked', true);
        } else {
            groupIDCheckBox.prop('checked', false);
        }
        implementAllChecked();
    }

    // Function to create an event without permission check
    function createEventWithoutPermissionCheck() {
        // Implement your logic to create event here
        alert('Event created successfully!');
    }

    // Function to edit an event without permission check
    function editEventWithoutPermissionCheck(eventId) {
        // Implement your logic to edit event here
        alert('Event edited successfully!');
    }

    // Function to delete an event without permission check
    function deleteEventWithoutPermissionCheck(eventId) {
        // Implement your logic to delete event here
        alert('Event deleted successfully!');
    }
</script>
