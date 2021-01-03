
     // Pass csrf token in ajax header
     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


//----- [ button click function ] ----------
    $("#createBtn").click(function(event) {
        event.preventDefault();
        $(".error").remove();
        $(".alert").remove();
        var title       =  $("#title").val();
        var description =       $("#description").val();
        if(title == "") {
            $("#title").after('<span class="text-danger error"> Title is required </span>');
        }
        if(description == "") {
            $("#description").after('<span class="text-danger error"> Description is required </span>');
            return false;
        }
        var form_data   = $("#postForm").serialize();
        // if post id exist
        if($("#id_hidden").val() !="") {
            createPost(form_data);
        }
        else {
            createPost(form_data);
        }
    });

        // function getData() {
        //     $.get('data')
        //         .done(function (data){
        //             console.log(data)
        //             var html = '';
        //             data.forEach(function($post) {
        //                 html += '<tr>'
        //                 html += ' <td> '+ $post.id +'</td>'
        //                 html += '<td>'+ $post.title+' </td>'
        //                 html += '<td>'+ $post.title+'</td>'
        //                 html += '<td>'+ $post.description+ '</td>'
        //                 html += '<td>'
        //                 html += '<a href="javascript:void(0);" data-toggle="modal" data-target="#addPostModal" data-id="' + $post.id +'" data-title="'+ $post.title+ '" data-description="'+ $post.description +'"data-action="view" class="btn btn-info btn-sm"> View </a>'
        //                 html += '<a href="javascript:void(0);" data-toggle="modal" data-target="#addPostModal" data-id="'+ $post.id +'" data-title="'+ $post.title +'" data-description="'+ $post.description +'" data-action="edit" class="btn btn-success btn-sm"> Edit </a>'
        //                 html += '<a href="javascript:void(0);" onclick="deletePost("'+ $post.id +'")" class="btn btn-danger btn-sm"> Delete </a>'
        //                 html += '</td>'
        //                 html += '</tr>'
        //             })
        //             $('table tbody').html(html);
        //         })
            
        // }
    // create new post
    function createPost(form_data) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: "input",
            method: 'post',
            data: form_data,  
            dataType: 'json',

            beforeSend:function() {
                $("#createBtn").addClass("disabled");
                $("#createBtn").text("Processing..");
            },

            success:function(res) {
                $("#createBtn").removeClass("disabled");
                $("#createBtn").text("Save");

                if(res.status == "success") {
                    $(".result").html("<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert'>×</button>" + res.message+ "</div>");
                }

                else if(res.status == "failed") {
                    $(".result").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert'>×</button>" + res.message+ "</div>");
                }
            },
            error:function(err) {
                console.log(err)
            }
            
        });
    }

    // update post
    function updatePost(form_data) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            url: 'update',
            method: 'post',
            data: form_data,
            dataType: 'json',

            beforeSend:function() {
                $("#createBtn").addClass("disabled");
                $("#createBtn").text("Processing..");
            },

            success:function(res) {
                $("#createBtn").removeClass("disabled");
                $("#createBtn").text("Update");

                if(res.status == "success") {
                    $(".result").html("<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert'>×</button>" + res.message+ "</div>");
                }

                else if(res.status == "failed") {
                    $(".result").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert'>×</button>" + res.message+ "</div>");
                }
            }
        });
    }

    // ---------- [ Delete post ] ----------------
    function deletePost(post_id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        var status = confirm("Do you want to delete this post?");
        if(status == true) {
            $.ajax({
                url: "product/"+post_id,
                method: 'delete',
                dataType: 'json',

                success:function(res) {
                    if(res.status == "success") {
                        $("#result").html("<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert'>×</button>" + res.message + "</div>");
                    }
                    else if(res.status == "failed") {
                        $("#result").html("<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert'>×</button>" + res.message + "</div>");
                    }
                }
            });
        }
    }

$('#addPostModal').on('shown.bs.modal', function (e) {
   var id           =   $(e.relatedTarget).data('id');
   var title        =   $(e.relatedTarget).data('title');
   var description  =   $(e.relatedTarget).data('description');
   var action       =   $(e.relatedTarget).data('action');

   if(action !== undefined) {
        if(action === "view") {

            // set modal title
            $(".modal-title").html("Post Detail");

            // pass data to input fields
            $("#title").attr("readonly", "true");
            $("#title").val(title);

            $("#description").attr("readonly", "true");
            $("#description").val(description);

            // hide button
            $("#createBtn").addClass("d-none");
        }


        if(action === "edit") {
            $("#title").removeAttr("readonly");
            $("#description").removeAttr("readonly");

            // set modal title
            $(".modal-title").html("Update Post");

            $("#createBtn").text("Update");

             // pass data to input fields
             $("#id_hidden").val(id);
             $("#title").val(title);
             $("#description").val(description);

             // hide button
            $("#createBtn").removeClass("d-none");
        }
   }

   else {
        $(".modal-title").html("Create Post");

        // pass data to input fields
        $("#title").removeAttr("readonly");
        $("#title").val("");

        $("#description").removeAttr("readonly");
        $("#description").val("");

        // hide button
        $("#createBtn").removeClass("d-none");
   }
});
