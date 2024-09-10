$(function(){
    $(document).on('click', '#delete', function(e){
        e.preventDefault();
        var link = $(this).attr("href");  
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete this Data?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            didRender: function() {
                const confirmButton = Swal.getConfirmButton();
                confirmButton.setAttribute('style', 'background-color: #e6000e !important; color: white !important; border-color: #e6000e !important;');

                const cancelButton = Swal.getCancelButton();
                cancelButton.setAttribute('style', 'background-color: #cccccc !important; color: black !important;');

               
            }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
                Swal.fire({
                    title: 'Deleted!',
                    text: 'Your file has been deleted.',
                    icon: 'success',
                    didRender: function() {
                        // Change the success message background color to red
                        const successPopup = document.querySelector('.swal2-success');
                        if (successPopup) {
                            successPopup.setAttribute('style', 'background-color: #e6000e !important;'); // Red background
                            const icon = successPopup.querySelector('svg');
                            if (icon) {
                                icon.setAttribute('style', 'fill: white !important;'); // Change icon color to white for contrast
                            }
                        }
                    }
                });
            }
        });
    });
});