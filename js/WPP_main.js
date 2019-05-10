document.addEventListener('DOMContentLoaded', function() {
  let plugin = new CoodeWWPPlugin();
}, false);


class CoodeWWPPlugin{
  constructor(){
    this.data_products = {};
    this.pref_url      = WPP_URL;

    this.upload_img_bt  = $('#upload-photo');
    this.take_img_bt    = $('#go-take-photo');
    this.stage_DOM_obj  = [];

    this.pedido = {'material':null,'material_n':'', 'forma':null, 'forma_n':'', 'tamanio':null, 'tamanio_n':'', 'imagen':null};

    this.actual_step   = 0;
    this.anterior_step = 0;

    this.load_data();
  }

  reference_html(){
    this.stage_DOM_obj  = $('.stg');
    this.event_bind();
  }

  load_data(){
    let req = new XMLHttpRequest();
    req.open("GET", this.pref_url+"/info.json", true);
    req.addEventListener("load", ()=> {
        this.data_products = JSON.parse(req.responseText);
        this.html_materials();
        this.html_formas();
        this.html_tamanios();
        this.reference_html();
        this.next_step();
    });
    req.send(null);
  }

  next_step(){ this.go_to_step(Number(this.actual_step)+1); }
  back_step(){ this.go_to_step(Number(this.actual_step)-1); }

  go_to_step(i){
    this.anterior_step = this.actual_step;
    this.actual_step   = i;

    this.toggle_class_or('stage-','down');
    this.toggle_class_or('stage-headline-','active');

    if(this.actual_step > 1){
      $('.back-button').css('opacity', '1');
      $('.back-button').css('visibility', 'visible');
    } else {
      $('.back-button').css('opacity', '0');
      $('.back-button').css('visibility', 'hidden');
    }

    switch(this.actual_step){
      case 1:  break;
    }
  }

  toggle_class_or(el,cl){
    let o1 = $('#'+el+this.actual_step);
    let o2 = $('#'+el+this.anterior_step);
    o1.toggleClass(cl);
    if(o2) { o2.toggleClass(cl); }
  }

  event_bind(){
    let obj = this;
    //se recorren los botones para mostrar el texto de descripcion del material
    $('.wpp-info-mat').click( function(){
        $('.text-tip').removeClass('show');
        $(this).parent().children('.text-tip').addClass('show');
    });

    //se recorre los modal de información del Material
    $('.text-tip').click( function(){ $('.text-tip').removeClass('show'); });

    //se recorren los selectores de materiales
    $('.mat-btn').click( function() {
        obj.pedido.material   = $(this).attr('data-id');
        obj.pedido.material_n = $(this).attr('data-name');
        obj.disable_formas();
        obj.go_to_step(2);
    });

    //se recorren los botones para Volver
    $('.back-button').click( (e)=>{ obj.back_step(); });

    //se recorren los botones de formas
    $('.wpp-form-btn').click( function(){
        obj.pedido.forma   = $(this).attr('data-id');
        obj.pedido.forma_n = $(this).attr('data-name');
        obj.go_to_step(3);
    });

    //se recorren los botones de tamaños
    $('.wpp-size-btn').click( function(){
        obj.pedido.tamanio   = $(this).attr('data-id');
        obj.pedido.tamanio_n = $(this).attr('data-name');
        obj.go_to_step(4);
    });

    //se recorren los botones del checkpoint
    $('.stage-headline').click( function() {
        let d = $(this).attr('data-target');
        if(d<obj.actual_step){ obj.go_to_step(d); }
    });
  }

  setClass(el,cl){
    for(let c=0;c<el.length;c++){ el[c].classList = cl; }
  }

  html_materials(){
    let content = '';
    for(let c=0; c<this.data_products.materiales.length;c++){
      let mat = this.data_products.materiales[c];
      content += '<div class="square">'+
        '  <div class="inner">'+
        '      <div class="images-wrapper mat-btn" data-kind="'+mat.abreviacion+'" data-name="'+mat.abreviacion+'" data-id="'+mat.id+'">'+
              '    <div class="image bg" style="background: url('+WPP_URL+mat.img_url+')"></div>'+
              '    <div class="image bg back" style="background: url('+WPP_URL+mat.imj_ej_url+')"></div>'+
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
    $('#stage-1').html(content);
  }

  html_formas(){
    let content = '';
    for(let c=0; c<this.data_products.formas.length;c++){
      let mat = this.data_products.formas[c];
      content += '<div class="square" id="forma-'+mat.id+'">'+
        '  <div class="inner">'+
        '      <div class="images-wrapper wpp-form-btn" data-kind="'+mat.abreviacion+'" data-kind-name="'+mat.abreviacion+'" data-id="'+mat.id+'" data-name="'+mat.nombre+'">'+
              '    <div class="image bg" style="background: url('+WPP_URL+mat.img_url+')"></div>'+
              '    <div class="image bg back" style="background: url('+WPP_URL+mat.imj_ej_url+')"></div>'+
              '</div>'+
              '<div class="details m-t-20">'+
              '    <h5>'+mat.abreviacion+'</h5>'+
              '</div>'+
          '</div>'+
      '</div>';
    }
    content += '<div class="clear"></div>';
    $('#stage-2').html(content);
  }

  html_tamanios(){
    let content = '';
    for(let c=0; c<this.data_products.tamanos.length;c++){
      let mat = this.data_products.tamanos[c];
      content += '<div class="square"><div class="inner s-size" data-size="25-30">'+
          '<div class="images-wrapper wpp-size-btn" data-id="'+mat.id+'" data-name="'+mat.nombre+'" data-price="'+mat.precio+'"><div class="form-rectangle" style="'+mat.style+'"></div>'+
          '</div>'+
          '<div class="details"><h5>'+mat.nombre+'</h5>'+
            '  <h5 class="m-t-5">'+
                '  Precio: <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>'+mat.precio+'</span></ins></h5>'+
          '</div>'+
      '</div></div>';
    }
    content += '<div class="clear"></div>';
    $('#stage-3').html(content);
  }

  disable_formas(){
    let mat = this.find_mat_id(this.pedido.material);
    for (let c=0;c<this.data_products.formas.length;c++){
      let e = $('#forma-'+this.data_products.formas[c].id);
      e.css('display', 'none');
    }
    for (let c=0;c<mat.formas.length;c++){
      let e = $('#forma-'+mat.formas[c].id_forma);
      e.css('display', 'inline-block');
    }
  }

  find_mat_id(id){
    for(let c=0; this.data_products.materiales.length;c++){
      if (this.data_products.materiales[c].id == id){ return this.data_products.materiales[c]; }
    }
    return -1;
  }

}
