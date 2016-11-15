var postId= 0;
var postBodyElement = null;

$('.post').find('.edit').on('click' , function (event) {
    event.preventDefault();


    postBodyElement = event.target.parentNode.parentNode.childNodes[1];
    var postBody = postBodyElement.textContent;
    postId = event.target.parentNode.parentNode.dataset['postId'];
    $('post-body').val(postBody);
    $('#edit-modal').modal();
});

$('#modal-save').on('click',function () { // on click model funkcija sa model save
    $.ajax({ //jquery ajaks model , proslijedimo java objekt
        method: 'POST',
        url: url, // varijabla url izvan java script filea
        data:  { body: $('post-body').val(), postId: postId, _token: token }//body posta , vrijednost , postId
    })
        .done(function (msg){
          $(postBodyElement).text(msg['new_body']);    // za testiranje , moramo i token proslijediti da ne bude error
            $('#edit-modal').modal('hide');
    });
});
