var postId= 0; // stora u post id 0
var postBodyElement = null;

$('.post').find('.edit').on('click' , function (event) { // nadji edit klasu i dodao on click funkciju na svaki event
    event.preventDefault();

    postBodyElement = event.target.parentNode.parentNode.childNodes[1];  // inicijalizira post body element
    var postBody = postBodyElement.textContent;// varijabla post bodi , event target , parent node , chiled node index 1 , dohvaca tekst content
    postId = event.target.parentNode.parentNode.dataset['postid']; // postID jednako artoklu , dataset postId
    $('#post-body').val(postBody); // insertano u modul formu post-body selected post bodi , value vrijednost insertan u post body
    $('#edit-modal').modal();
});

$('#modal-save').on('click',function () { // on click model funkcija sa model save targeta modal seva i adda on click funkciju
    $.ajax({ //jquery ajaks model , proslijedimo java script objekt objekt
        method: 'POST', // metoda je post
        url: urlEdit, // varijabla url izvan java script filea u dashboard html , url ruta  , kreiramo rutu url rutu
        data:  { body: $('#post-body').val(), postId: postId, _token: token}//postId, _token: token }//body posta , vrijednost proslog posta , postId , moramo proslijediti token
    })
        .done(function (msg){ // done funckija koja prima poruku
            $(postBodyElement).text(msg['new_body']); // tekst funkcija koju treba utput // za testiranje , moramo i token proslijediti da ne bude error
            $('#edit-modal').modal('hide');
        });
});

$('.like').on('click', function(event) {
    event.preventDefault();
    postId = event.target.parentNode.parentNode.dataset['postid'];
    var isLike = event.target.previousElementSibling == null;
    $.ajax({
        method: 'POST',
        url: urlLike,
        data: {isLike: isLike, postId: postId, _token: token}
    })
        .done(function() {
            event.target.innerText = isLike ? event.target.innerText == 'Like' ? 'You like this post' : 'Like' : event.target.innerText == 'Dislike' ? 'You don\'t like this post' : 'Dislike';
            if (isLike) {
                event.target.nextElementSibling.innerText = 'Dislike';
            } else {
                event.target.previousElementSibling.innerText = 'Like';
            }
        });
});


///////////////////////////////////////////////////////////////////////////////////////////////
/*
    postBodyElement = event.target.parentNode.parentNode.childNodes(1);
    var postBody = postBodyElement.textContent;
    postId = event.target.parentNode.parentNode.dataset['postId'];
    $('post-body').val(postBody);
    $('#edit-modal').modal();
});

$('#modal-save').on('click',function () { // on click model funkcija sa model save targeta modal seva i adda on click funkciju
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
*/