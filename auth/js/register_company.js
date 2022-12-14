$(document).ready(() => {
    $(".register_company").on("submit",(e) => {
        if ($('.accept_condition').is(':checked')) {
           if ($('#accept_condition').is(':checked')) {
                e.preventDefault();
                var data = new FormData();

                //Form data
                var form_data = $('.register_company').serializeArray();
                $.each(form_data, function (key, input) {
                    data.append(input.name, input.value);
                });

                //File data
                var file_data = $('input[name="valid_photo"]')[0].files;
                for (var i = 0; i < file_data.length; i++) {
                    data.append("valid_photo[]", file_data[i]);
                }

                //Custom data
                // data.append('key', 'value');

                $.ajax({
                    url : "../auth/routes/register_company.php",
                    method: "post",
                    processData: false,
                    contentType: false,
                    data: data,
                    success: function (res) {
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
                    },
                    error: function (e) {
                        //error
                    }
                });
            } else {
                // var val = $('#decline_condition').val();
               alert('Please Accept All Terms and Aggreement!...');
               setTimeout(() => {
                    window.location.href = "?a=join";
                }, 1000);
            }
        } else {
            alert('Please Accept All the Terms and Aggreement!...');
            setTimeout(() => {
                window.location.href = "?a=join";
            }, 1000);
            
        }

        
        
    });
});