$(document).ready(function () {

    function PhpComment(element) {
        this.element = element;
        this.init();
    }

    PhpComment.prototype.init = function () {
        this.setupVariables();
        this.setupEvents();
    }

    PhpComment.prototype.setupVariables = function () {
        this.commentForm = this.element.find(".comment-form");
        this.nameField = this.element.find("#comment_title");
        this.commentField = this.element.find("#comment_body");
    }

    PhpComment.prototype.setupEvents = function () {
        var phpComment = this,
        newMedia;

        $.ajax({
            url: 'php/template.php',
            method: 'GET',
            dataType: 'html',
            success: function (data) {
                newMedia = data;
            }
        });

        phpComment.commentForm.on("submit", function (e) {
            e.preventDefault();
            var parentId = 0,
                name = phpComment.nameField.val(),
                comment = phpComment.commentField.val();

            if(phpComment.commentForm.parents(".media").length > 0){
                parentId = phpComment.commentForm.closest(".media").attr("data-Id");
            }
            
            $.ajax({
                url: phpComment.commentForm.attr("action"),
                method: 'POST',
                dataType: 'json',
                data: {name: name, comment: comment, parentId: parentId},
                success: function (data) {
                    if(!data.created){
                        alert("Couldn't create comment");
                        return;
                    }

                    newMedia = newMedia.replace("{{id}}", data.id);
                    newMedia = newMedia.replace("{{name}}", name);
                    newMedia = newMedia.replace("{{comment}}", comment);
                    newMedia = newMedia.replace("{{nested}}", '');
                    phpComment.commentForm.before(newMedia);
                    phpComment.nameField.val("");
                    phpComment.commentField.val("");
                }
            });
        });
        
        $(document).on("click", ".reply-link", function (e) {
            e.preventDefault();
            var media = $(this).closest(".media");
            media.find(">.media-body>.media-text").after(phpComment.commentForm);
        });

         $(document).on("click", ".delete-link", function (e) {
            e.preventDefault();
            var media = $(this).closest(".media");
            media.hide();
            deleted_id =  media.attr("data-Id");
           
             $.ajax({
                url:'php/delete.php',
                method: 'POST',
                dataType: 'json',
                data:{ deleted_id: deleted_id},
                success: function (data) {
                   
                }
                          
        });

    });
         
    }

    $.fn.phpComment = function (options) {
        new PhpComment(this);
        return this;
    }

    $(".comments").phpComment();

});
