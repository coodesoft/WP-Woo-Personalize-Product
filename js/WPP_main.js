document.addEventListener('DOMContentLoaded', function() {

    let info_mat      = document.getElementsByClassName('wpp-info-mat');
    let info_mat_text = document.getElementsByClassName('text-tip');

    //se recorren los botones para mostrar el texto de descripcion del material
    for(let c=0;c<info_mat.length;c++){
      info_mat[c].addEventListener("click", function(e){
        reset_info_mat();
        let text_tip = e.explicitOriginalTarget.parentElement.parentElement.getElementsByClassName('text-tip');
        text_tip[0].classList.add('show');
      });
    }

    //se recorre los modal de información del Material
    for(let c=0;c<info_mat_text.length;c++){
      info_mat_text[c].addEventListener("click", function(e){
        reset_info_mat();
      });
    }

    function reset_info_mat(){
      for(let c=0;c<info_mat_text.length;c++){ info_mat_text[c].classList = ['text-tip']; }
    }

}, false);
