$(document).ready(() => {
    $(".register_company").on("submit",(e) => {
        if ($('#accept_condition').is(':checked')) {
            e.preventDefault();
            var data = $('.register_company').serializeArray()
            $.ajax({
                url : "../auth/routes/register_company.php",
                method: "post",
                data : data,
                success: (res) => {
                    if(res.success){
                        Swal.fire(
                            'Success',
                            `${res.message}`,
                            'success'
                        )
                        setTimeout(() => {
                            window.location.href = "?a=already";
                        }, 1000);
                    }else{
                        Swal.fire(
                            'Failed',
                            `${res.message}`,
                            'error'
                        )
                    }
                }
            });
        } else {
            alert('Please Accept All the Terms and Aggreement!...');
            
        }

        
        
    });
});