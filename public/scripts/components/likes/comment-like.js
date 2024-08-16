const heartButtons = document.querySelectorAll('.heart-button');

heartButtons.forEach(button => {
  
  button.addEventListener('click', () => {
    const commentId = button.id; // Obtener el ID del comentario
    const postId = button.getAttribute('post-id');
    console.log(commentId);
    const url = 'comment/like';
    
    fetch(url, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(
        { 
          comment_id: commentId,
          post_id: postId
        }),
    })
    .then(response => {
      if (response.ok) {
        return response.json();
      } else {
        throw new Error('Error al likear el comentario');
      }
    })
    .then(data => {
      console.log('Comentario likeado correctamente');
      console.log(data);
    })
    .catch(error => {
      console.error(error);
    });
  });

});