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

    // Function to create an ticket without permission check
    function createTicketWithoutPermissionCheck() {
        // Implement your logic to create ticket here
        alert('Ticket created successfully!');
    }

    // Function to edit an ticket without permission check
    function editTicketWithoutPermissionCheck(eventId) {
        // Implement your logic to edit ticket here
        alert('Ticket edited successfully!');
    }

    // Function to delete an ticket without permission check
    function deleteTicketWithoutPermissionCheck(eventId) {
        // Implement your logic to delete ticket here
        alert('Ticket deleted successfully!');
    }
</script>
