function showValidationErrors(name, error) {
    var group = $("#form-group-" + name);
    group.addClass('has-error');
    group.find('.help-block').text(error);
}

function clearValidationError(name) {
    var group = $("#form-group-" + name);
    group.removeClass('has-error');
    group.find('.help-block').text('');
}

$("#name, #emailInput, #passwordInput").on('keyup', function () {
    clearValidationError($(this).attr('id').replace('#', ''))
});

$("#barangay_id").on('change', function () {
    clearValidationError($(this).attr('id').replace('#', ''))
});




function storeData(data,url ){

    $.ajax({
        type:'POST',
        url: url  ,
        processData: false,
        contentType: false,
        data : data,
        success:function(data){
            console.log(data);       
            swal({
                title: "Success",
                text: "User Added",
                icon: "success",
            });
            document.getElementById("addMedicineForm").reset();
        },
        err : err
    });

}


/****
 **--
 store Users  Information
 */
 function storeUser(data , url){
    $.ajax({
        method: 'POST',
        url: url,
        data: data , 
        success: function (data) {
            console.log(data);
            swal({
                title: "Success",
                text: "User Added",
                icon: "success",
            });

            $('.availability').text('Email Already used.');
            // $('#addUserModal')[0].reset();


        },
        error: err
    })
}


/****
 **--
 store Medicine Login Information
 */
 function storeMedicine(postData, url) {
    $.ajax({
        method: 'POST',
        url: url,
        processData: false,
        contentType: false,
        data: postData,
        success: function (data) {
            console.log(data);
            swal({
                title: "Success",
                text: "Medicine saved successfuly",
                type: "success",
                confirmButtonColor: "#66cc99"
            });

        },
        error: err
    })
}


function err(xhr, reason, ex) {
    if (xhr.status == 500) {
        swal({
            title: "500",
            text: "Internal Server. Please check your input",
            type: "error",
            confirmButtonColor: "#66cc99"
        });




    } else if (xhr.status == 422) {
        var data = xhr.responseJSON;
        for (let i in data) {
            showValidationErrors(i, data[i][0])
            alert(data[i][0]);
        }
    }
}

function deactivateUser(url, id) {

    $.ajax({
        method: 'PUT',
        
        url: url,
        
        data: {

            id: id,

            _token: $('input[name=_token]').val()
            

        },
        success: function (data) {
            // console.log(data);   
            
            location.reload();

            swal("User has been deleted", {
                icon: "success",
            });



        },
        error: function (xhr, res) {
            console.log(xhr.status);
        }
    })
}


function updateUser(data,id) {
    $.ajax({
        method: 'PUT',
        url: 'members/'+id,
        data: {
            data : data , 
            id : id ,
            _token: $('input[name=_token]').val()
        } , 
        success: function (data) {
            console.log(data);
            swal('Updated! ', 'User has been succesfully updated', 'success');
            location.reload(3000);
        },
        error: err
    });
}




function removeMedicinefromtheInventory(url, id) {
    console.log(url);
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            id: id,
            _token: $('input[name=_token]').val()
        },
        success: function (data) {
            console.log(data);
        },
        error: function (xhr) {
            console.log(xhr.status);
        }
    })
}




function storeBarangay(url,locdata,data) {
    console.log(url);
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            locdata : locdata ,
            data : data
        },
        success: function (data) {
            console.log(data);
        },
        error: function (xhr) {
            console.log(xhr.status);
        }
    })
}


