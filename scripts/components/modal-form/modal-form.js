import { ElementBuilder } from "../../utils/ElementBuilder.js";

function create_modal() {

  const modal = ElementBuilder.createElement('section', '', {
    class: "modal",
  })

  const modal_content = ElementBuilder.createElement('section', '', {
    class: "modal-content"
  })

  const close_button = ElementBuilder.createElement('button', '', { class: "close-button" });
  close_button.addEventListener('click', () => {
    close_modal(modal);
  })
  modal_content.appendChild(close_button);

  const main_image = ElementBuilder.createElement('img', '', {
    src: "https://i.pinimg.com/564x/2f/18/9e/2f189e3be4ef04ab12a0a125efe4e67e.jpg",
    alt: "Portada del álbum 'The Dark Side of the Moon' de Pink Floyd",
    width: "200px",
    height: "200px",
    class: "image-border"
  })

  const type = ElementBuilder.createElement('p', 'Canción', { class: "type-title" })
  const title = ElementBuilder.createElement('h2', 'Comfortubly Numb', { class: "song-title title" })

  const figcaption = ElementBuilder.createElement('figcaption', '', {})

  figcaption.appendChild(type);
  figcaption.appendChild(title);



  const img = ElementBuilder.createElement('img', '', {
    src: "https://i.pinimg.com/236x/20/cc/b2/20ccb24df9750b08d764e574fcec5f5d.jpg",
    alt: "Imagen de perfil de 'Pink Floyd'",
    height: "50px",
    width: "50px",
  })
  const artist_span_name = ElementBuilder.createElement('span', 'Pink Floyd · 1973', {})

  const artist_info = ElementBuilder.createElement('p', '', {
    class: 'artist-info'
  })

  artist_info.appendChild(img);
  artist_info.appendChild(artist_span_name);


  const figure = ElementBuilder.createElement('figure', '', {})

  figure.appendChild(main_image);
  figure.appendChild(figcaption);
  figure.appendChild(artist_info);


  const textarea = ElementBuilder.createElement('textarea', '', {
    placeholder: "Agrega una descripción...",
    name: "description",
    id: "description",
    cols: "40",
    rows: "10",
    class: "input"
  })

  let tag_text = "";
  let tags_count = 0;

  const input_tag = ElementBuilder.createElement('input', '', {
    class: "input input-tag",
    type: "text",
    name: "tag",
    placeholder: "ej. Trap"
  })

  input_tag.addEventListener('change', (event) => {
    tag_text = event.target.value;
  })

  const tags_section = ElementBuilder.createElement('section', '', {
    class: "tags-section"
  })

  const tag_button = ElementBuilder.createElement('button', '+ Agregar Tag', {
    type: "button",
    class: "tag-button submit-button"
  })

  tag_button.addEventListener('click', () => {
    if (tag_text !== "" && tags_count < 3) {
      const tag = ElementBuilder.createElement('span', tag_text, {
        class: "tag"
      })
      tags_section.appendChild(tag);
      tag_text = "";
      input_tag.value = "";
      tags_count += 1;
    }
  })

  const tag_creator = ElementBuilder.createElement('p', '', {
    class: "tags-creator"
  })

  tag_creator.appendChild(tags_section);
  tag_creator.appendChild(input_tag);
  tag_creator.appendChild(tag_button);


  const valoración_label = ElementBuilder.createElement('label', 'Valoración', {
    for: "rate"
  })
  const stars = ElementBuilder.createElement('span', '★★★★★', {})
  const input_rate = ElementBuilder.createElement('input', '', {
    type: "hidden",
    value: "3",
    name: "rate",
    id: "rate"
  })
  const rating = ElementBuilder.createElement('p', '', {
    class: "rating"
  })

  rating.appendChild(valoración_label);
  rating.appendChild(stars);
  rating.appendChild(input_rate);

  const share_span = ElementBuilder.createElement('span', 'share', {
    class: "hidden"
  })
  const share_button = ElementBuilder.createElement('button', '', {
    class: 'share-button'
  })
  share_button.appendChild(share_span)
  const share_container = ElementBuilder.createElement('p', '', {
    class: "share-container"
  })

  share_container.appendChild(share_button);


  const volver_button = ElementBuilder.createElement('button', 'Volver', {
    class: "cancel-button"
  })
  volver_button.addEventListener('click', () => {
    close_modal(modal);
  })

  const postear_button = ElementBuilder.createElement('input', '', {
    type: "submit",
    value: "Postear",
    class: "submit-button postear-button"
  })

  const submit_container = ElementBuilder.createElement('section', '', {
    class: "submit-container"
  })

  submit_container.appendChild(volver_button);
  submit_container.appendChild(postear_button);

  const form = ElementBuilder.createElement('form', '', {
    action: "",
    method: "GET"
  })

  form.appendChild(textarea);
  form.appendChild(tag_creator);
  form.appendChild(rating);
  form.appendChild(share_container);
  form.appendChild(submit_container);

  modal_content.appendChild(figure);
  modal_content.appendChild(form);
  modal.appendChild(modal_content);

  document.body.appendChild(modal);

}

const post_form_openers = document.querySelectorAll(".post-form-opener")


const create_post = document.getElementById("create-post");
// const go_to_top = document.getElementById("go-to-top");
const main_header = document.getElementById("main-header");

post_form_openers.forEach((opener) => {
  opener.addEventListener('click', () => {
    create_post.classList.add("hidden");
    // go_to_top.classList.add("hidden");
    main_header.classList.add("hidden");
    document.body.classList.add("none-scroll")
    create_modal();
  })
});

function close_modal(modal) {
  modal.remove();
  create_post.classList.remove("hidden");
  // go_to_top.classList.remove("hidden");
  main_header.classList.remove("hidden");
  document.body.classList.remove("none-scroll")
}