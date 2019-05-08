document.addEventListener('DOMContentLoaded', function() {
  let plugin = new CoodeWWPPlugin();
}, false);


class CoodeWWPPlugin{
  constructor(){
    this.info_mat      = document.getElementsByClassName('wpp-info-mat');
    this.info_mat_text = document.getElementsByClassName('text-tip');
    this.mat_DOM_obj   = document.getElementsByClassName('mat-btn');
    this.stage_DOM_obj = document.getElementsByClassName('stg');
    this.back_btns     = document.getElementsByClassName('back-button');

    this.pedido = {'material':null, 'forma':null, 'imagen':null};

    this.actual_step   = 0;
    this.anterior_step = 0;

    this.event_bind();
    this.next_step();
  }

  next_step(){ this.go_to_step(this.actual_step+1); }
  back_step(){ this.go_to_step(this.actual_step-1); }

  go_to_step(i){
    this.anterior_step = this.actual_step;
    this.actual_step   = i;

    this.toggle_class_or('stage-','down');
    this.toggle_class_or('stage-headline-','active');

    if(this.actual_step > 1){
      this.back_btns[0].style.opacity    = 1;
      this.back_btns[0].style.visibility = 'visible';
    } else {
      this.back_btns[0].style.opacity    = 0;
      this.back_btns[0].style.visibility = 'hidden';
    }
  }

  toggle_class_or(el,cl){
    let o1 = document.getElementById(el+this.actual_step);
    let o2 = document.getElementById(el+this.anterior_step);
    o1.classList.toggle(cl);
    if(o2) { o2.classList.toggle(cl); }
  }

  event_bind(){
    //se recorren los botones para mostrar el texto de descripcion del material
    for(let c=0;c<this.info_mat.length;c++){
      this.info_mat[c].addEventListener("click", (e)=>{
        this.reset_info_mat();
        let text_tip = e.explicitOriginalTarget.parentElement.parentElement.getElementsByClassName('text-tip');
        text_tip[0].classList.add('show');
      });
    }

    //se recorre los modal de información del Material
    for(let c=0;c<this.info_mat_text.length;c++){
      this.info_mat_text[c].addEventListener("click", (e)=>{
        this.reset_info_mat();
      });
    }

    //se recorren los selectores de materiales
    for(let c=0;c<this.mat_DOM_obj.length;c++){
      this.mat_DOM_obj[c].addEventListener("click", (e)=>{ this.next_step(); });
    }

    //se recorren los botones para Volver
    for(let c=0;c<this.back_btns.length;c++){
      this.back_btns[c].addEventListener("click", (e)=>{ this.back_step(); console.log(e); });
    }
  }

  reset_info_mat(){ this.setClass(this.info_mat_text,['text-tip']); }

  setClass(el,cl){
    for(let c=0;c<el.length;c++){ el[c].classList = cl; }
  }

}
