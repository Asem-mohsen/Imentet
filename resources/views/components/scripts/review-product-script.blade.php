<script>
    $(document).ready(function() {
        $('#review-form').submit(function(event) {
            event.preventDefault();

            $.ajax({
                url: "{{ route('reviews.store') }}",
                method: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    if (response.status === "success") {
                        toastr.success(response.message);
                        location.reload();
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr) {
                    toastr.error("Something went wrong! Please try again.");
                }
            });
        });

        $('.remove-review-btn').click(function(event) {
            event.preventDefault();
            let reviewId = $(this).data('review-id');

            $.ajax({
                url: "/reviews/" + reviewId,
                method: "DELETE",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function(response) {
                    if (response.status === "success") {
                        toastr.success(response.message);
                        location.reload();
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr) {
                    toastr.error("Unable to delete review.");
                }
            });
        });
    });
</script>