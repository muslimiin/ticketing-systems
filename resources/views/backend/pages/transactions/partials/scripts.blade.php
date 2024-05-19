<script>
    $(document).ready(function() {
        $('#event_id').change(function() {
            var eventId = $(this).val();
            if (eventId) {
                $.ajax({
                    url: '/admin/tickets/get-by-event/' + eventId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#ticket_id').empty();
                        $('#ticket_id').append('<option value="">Select Ticket</option>');
                        $.each(data, function(key, value) {
                            $('#ticket_id').append('<option value="' + value.id +
                                '">' + value.name + '</option>');
                        });
                    }
                });
            } else {
                $('#ticket_id').empty();
                $('#ticket_id').append('<option value="">Select Ticket</option>');
            }
        });

        $('#ticket_id').change(function() {
            var ticketId = $(this).val();
            if (ticketId) {
                $.ajax({
                    url: '/admin/tickets/get-price/' + ticketId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#price').val(data.price);
                        calculateTotal();
                    }
                });
            } else {
                $('#price').val('');
                calculateTotal();
            }
        });

        $('#quantity').on('input', function() {
            calculateTotal();
        });

        function calculateTotal() {
            var price = $('#price').val();
            var quantity = $('#quantity').val();
            if (price && quantity) {
                var total = price * quantity;
                $('#total').val(total);
            } else {
                $('#total').val('');
            }
        }
    });
</script>
