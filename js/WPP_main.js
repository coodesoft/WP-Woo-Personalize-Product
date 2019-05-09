document.addEventListener('DOMContentLoaded', function() {
  let plugin = new CoodeWWPPlugin();
}, false);


class CoodeWWPPlugin{
  constructor(){
    this.data_products = {};
    this.pref_url      = '../../wp-content/plugins/WP-Woo-Personalize-Product';

    this.materials_cont = document.getElementById('stage-1');
    this.formas_cont    = document.getElementById('stage-2');
    this.upload_img_bt  = document.getElementById('upload-photo');
    this.take_img_bt    = document.getElementById('go-take-photo');
    this.info_mat       = [];
    this.info_mat_text  = [];
    this.mat_DOM_obj    = [];
    this.stage_DOM_obj  = [];
    this.back_btns      = [];
    this.form_btns      = [];
    this.size_btns      = [];
    this.stage_hl_btns  = [];

    this.materials_cont = document.getElementById('stage-1');

    this.pedido = {'material':null,'maeterial_n':'', 'forma':null, 'forma_n':'', 'imagen':null};

    this.actual_step   = 0;
    this.anterior_step = 0;

    this.load_data();
  }

  reference_html(){
    this.info_mat       = document.getElementsByClassName('wpp-info-mat');
    this.info_mat_text  = document.getElementsByClassName('text-tip');
    this.mat_DOM_obj    = document.getElementsByClassName('mat-btn');
    this.stage_DOM_obj  = document.getElementsByClassName('stg');
    this.back_btns      = document.getElementsByClassName('back-button');
    this.form_btns      = document.getElementsByClassName('wpp-form-btn');
    this.size_btns      = document.getElementsByClassName('wpp-size-btn');
    this.stage_hl_btns  = document.getElementsByClassName('stage-headline');
    this.event_bind();
  }

  load_data(){
    let req = new XMLHttpRequest();
    req.open("GET", this.pref_url+"/data/info.json", true);
    req.addEventListener("load", ()=> {
        this.data_products = JSON.parse(req.responseText);
        this.html_materials();
        this.html_formas();
        this.reference_html();
        this.next_step();
    });
    req.send(null);
  }

  next_step(){ this.go_to_step(Number(this.actual_step)+1); }
  back_step(){ this.go_to_step(Number(this.actual_step)-1); }

  go_to_step(i){
    this.reference_html();
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

    switch(this.actual_step){
      case 1:  break;
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
      //this.info_mat[c].removeEventListener("click",()=>{});
      this.info_mat[c].addEventListener("click", (e)=>{
        this.reset_info_mat();
        let text_tip = e.explicitOriginalTarget.parentElement.parentElement.getElementsByClassName('text-tip');
        text_tip[0].classList.add('show');
      });
    }

    //se recorre los modal de información del Material
    for(let c=0;c<this.info_mat_text.length;c++){
      //this.info_mat_text[c].removeEventListener("click",()=>{});
      this.info_mat_text[c].addEventListener("click", (e)=>{ this.reset_info_mat();  });
    }

    //se recorren los selectores de materiales
    for(let c=0;c<this.mat_DOM_obj.length;c++){
      //this.mat_DOM_obj[c].removeEventListener("click",()=>{});
      this.mat_DOM_obj[c].addEventListener("click", (e)=>{
        this.pedido.material = e.target.offsetParent.getAttribute('data-id');
        this.disable_formas();
        this.go_to_step(2);
      });
    }

    //se recorren los botones para Volver
    for(let c=0;c<this.back_btns.length;c++){
      //this.back_btns[c].removeEventListener("click",()=>{});
      this.back_btns[c].addEventListener("click", (e)=>{ this.back_step(); });
    }

    //se recorren los botones de formas
    for(let c=0;c<this.form_btns.length;c++){
      //this.form_btns[c].removeEventListener("click",()=>{});
      this.form_btns[c].addEventListener("click", (e)=>{

        this.go_to_step(3);
      });
    }

    //se recorren los botones de tamaños
    for(let c=0;c<this.size_btns.length;c++){
      //this.size_btns[c].removeEventListener("click",()=>{});
      this.size_btns[c].addEventListener("click", (e)=>{ this.next_step(); });
    }

    //se recorren los botones del checkpoint
    for(let c=0;c<this.stage_hl_btns.length;c++){
      //this.stage_hl_btns[c].removeEventListener("click",()=>{});
      this.stage_hl_btns[c].addEventListener("click", (e)=>{
        let d = e.target.offsetParent.getAttribute('data-target');
        if(d<this.actual_step){ this.go_to_step(d); }
      });
    }
  }

  reset_info_mat(){ this.setClass(this.info_mat_text,['text-tip']); }

  setClass(el,cl){
    for(let c=0;c<el.length;c++){ el[c].classList = cl; }
  }

  html_materials(){
    let content = '';
    for(let c=0; c<this.data_products.materiales.length;c++){
      let mat = this.data_products.materiales[c];
      content += '<div class="square">'+
        '  <div class="inner">'+
        '      <div class="images-wrapper mat-btn" data-kind="'+mat.abreviacion+'" data-kind-name="'+mat.abreviacion+'" data-id="'+mat.id+'">'+
              '    <div class="image bg" style="background: url('+mat.img_url+')"></div>'+
              '    <div class="image bg back" style="background: url('+mat.imj_ej_url+')"></div>'+
              '</div>'+
              '<div class="details m-t-20">'+
              '    <h5>'+mat.abreviacion+'</h5>'+
              '    <div class="wpp-info-mat"> <i class="fa fa-info-circle"></i>Sobre el material </div>'+
              '    <div class="text-tip">'+
              '        <div class="inner-w">'+mat.descripcion+' <div class="closer"></div></div>'+
              '    </div>'+
              '</div>'+
          '</div>'+
      '</div>';
    }
    content += '<div class="clear"></div>';
    this.materials_cont.innerHTML = content;
  }

  html_formas(){
    let content = '';
    for(let c=0; c<this.data_products.formas.length;c++){
      let mat = this.data_products.formas[c];
      content += '<div class="square" id="forma-'+mat.id+'">'+
        '  <div class="inner">'+
        '      <div class="images-wrapper wpp-form-btn s-shape" data-kind="'+mat.abreviacion+'" data-kind-name="'+mat.abreviacion+'" data-id="'+mat.id+'" data-shape="'+mat.nombre+'">'+
              '    <div class="image bg" style="background: url('+mat.img_url+')"></div>'+
              '    <div class="image bg back" style="background: url('+mat.imj_ej_url+')"></div>'+
              '</div>'+
              '<div class="details m-t-20">'+
              '    <h5>'+mat.abreviacion+'</h5>'+
              '</div>'+
          '</div>'+
      '</div>';
    }
    content += '<div class="clear"></div>';
    this.formas_cont.innerHTML = content;
  }

  disable_formas(){
    let mat = this.find_mat_id(this.pedido.material);
    for (let c=0;c<this.data_products.formas.length;c++){
      let e = document.getElementById('forma-'+this.data_products.formas[c].id);
      e.style.display = 'none';
    }
    for (let c=0;c<mat.formas.length;c++){
      let e = document.getElementById('forma-'+mat.formas[c].id_forma);
      e.style.display = 'inline-block';
    }
  }

  find_mat_id(id){
    for(let c=0; this.data_products.materiales.length;c++){
      if (this.data_products.materiales[c].id == id){ return this.data_products.materiales[c]; }
    }
    return -1;
  }

}
