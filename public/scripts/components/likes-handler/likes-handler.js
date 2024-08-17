const heartButtons = document.querySelectorAll('.heart-button');

function createFetchData(button) {
  const postId = button.getAttribute('post-id');
  let body = {
    post_id: postId
  };
  let url = '';
  if (button.hasAttribute('comment-id')) {
    const commentId = button.getAttribute('comment-id');
    body.comment_id = commentId;
    url = 'comment/like';
  } else {
    url = 'post/like';
  }

  const response = {
    url: url,
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: body,
  };
  return response;
}

heartButtons.forEach(button => {
  
  button.addEventListener('click', () => {

    const dataFetch = createFetchData(button);
    
    fetch(dataFetch.url , {
      method: dataFetch.method,
      headers: dataFetch.headers,
      body: JSON.stringify(dataFetch.body),
    })
    .then(response => {

    })
    .catch(error => {
      console.error(error);
    });
  });

});