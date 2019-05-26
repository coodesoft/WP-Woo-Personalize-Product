document.addEventListener('DOMContentLoaded', function() {
  let plugin = new CoodeWWPPlugin();
}, false);

class CanvasImg{
  constructor(url,c,cc){
    this.src = url;
    this.h   = 0;
    this.w   = 0;
    this.w_sq = 0;
    this.h_sq = 0;
    this.x   = 0;
    this.y   = 0;
    this.opacity = 1;
    this.loaded     = false;
    this.img        = new Image();
    this.img.src    = this.src;
    let obj         = this;
    this.on_load    = cc;
    this.scale      = 2;
    this.angle      = 0;
    this.img.onload = function(){
      obj.loaded = true;
      if (obj.h == 0){ obj.h = obj.img.height; obj.w = obj.img.width; }
      obj.h_sq = obj.w/obj.h;
      obj.w_sq = obj.h/obj.w;
      if(obj.on_load != -1) { obj.on_load(); }
    };
    this.canvas = c;
    this.tam_point  = this.canvas.tam_point*2;
  }

  setPos(x,y){ this.x=x; this.y=y; }
  setTam(w,h){ this.w=w; this.h=h; }
  scaleToContainer(){
    let r = (this.canvas.canvas_w/this.w)/this.scale;
    this.w = this.w*r; this.h = this.h*r;
    this.x = this.canvas.canvas_w*0.25;
    this.y = this.canvas.canvas_h*0.25;
  }

  mouseOver(){
    return (this.canvas.mouse_x > this.x && this.canvas.mouse_x < this.x + this.w && this.canvas.mouse_y > this.y && this.canvas.mouse_y < this.y + this.h);
  }

  mouseOverPointLU(){ return (this.canvas.mouse_x > this.x-this.tam_point && this.canvas.mouse_x < this.x+this.tam_point && this.canvas.mouse_y > this.y-this.tam_point && this.canvas.mouse_y < this.y+this.tam_point);  }
  mouseOverPointRU(){ return (this.canvas.mouse_x > this.x+this.w-this.tam_point && this.canvas.mouse_x < this.x+this.w+this.tam_point && this.canvas.mouse_y > this.y-this.tam_point && this.canvas.mouse_y < this.y+this.tam_point);  }
  mouseOverPointLD(){ return (this.canvas.mouse_x > this.x-this.tam_point && this.canvas.mouse_x < this.x+this.tam_point && this.canvas.mouse_y > this.y+this.h-this.tam_point && this.canvas.mouse_y < this.y+this.h+this.tam_point);  }
  mouseOverPointRD(){ return (this.canvas.mouse_x > this.x+this.w-this.tam_point && this.canvas.mouse_x < this.x+this.w+this.tam_point && this.canvas.mouse_y > this.y+this.h-this.tam_point && this.canvas.mouse_y < this.y+this.h+this.tam_point) }
  mouseOverPointLD(){ return (this.canvas.mouse_x > this.x-this.tam_point && this.canvas.mouse_x < this.x+this.tam_point && this.canvas.mouse_y > this.y+this.h-this.tam_point && this.canvas.mouse_y < this.y+this.h+this.tam_point);  }
}

class CanvasManager{
  constructor(){
    this.canvas   = document.getElementById('canvas');
    this.context  = this.canvas.getContext( '2d' );
    this.element  = $('#canvas');
    this.canvas_h = this.element[0].height;
    this.canvas_w = this.element[0].width;
    this.mouse_x  = 0;
    this.mouse_y  = 0;
    this.images     = [];
    this.tam_point  = 5;
    let obj         = this;
    setInterval(function(){obj.draw()},18);

    this.move_img = false;
    this.resize   = false;
    this.rotate   = false;
    this.diff_x = 0; this.diff_y = 0;
    this.img_selected = true;
    this.mouse_down   = false;
    this.m_prev_x     = 0;
    this.m_prev_y     = 0;
    this.img_prev_h   = 0;
    this.img_prev_w   = 0;

    this.element.mousemove(function(e){
      let offset  = $('#canvas').offset();
      obj.mouse_x = e.pageX - offset.left;
      obj.mouse_y = e.pageY - offset.top;

      if(obj.images[2]){
        obj.element.css('cursor','default');

        if (obj.images[2].mouseOver()){ obj.element.css('cursor','all-scroll'); }

        if (obj.images[2].mouseOverPointLU()){
          obj.move_img = false;
          obj.element.css('cursor','nw-resize');
          if (obj.mouse_down){
            obj.images[2].x = obj.mouse_x;
            obj.images[2].y = obj.mouse_y;

            let d_x = obj.m_prev_x-obj.mouse_x;
            let d_y = obj.m_prev_y-obj.mouse_y;

            if(obj.img_prev_w+d_x > 40){ obj.images[2].w = obj.img_prev_w+d_x;}
            if(obj.img_prev_h+d_y > 40){ obj.images[2].h = obj.img_prev_h+d_y;}
          }
        }

        if (obj.images[2].mouseOverPointRU()){
          obj.move_img = false;
          obj.element.css('cursor','ne-resize');
          if (obj.mouse_down){
            obj.images[2].y = obj.mouse_y;

            let d_x = obj.m_prev_x-obj.mouse_x;
            let d_y = obj.m_prev_y-obj.mouse_y;

            if(obj.img_prev_w-d_x > 40){ obj.images[2].w = obj.img_prev_w-d_x;}
            if(obj.img_prev_h+d_y > 40){ obj.images[2].h = obj.img_prev_h+d_y;}
          }
        }

        if (obj.images[2].mouseOverPointLD()){
          obj.move_img = false;
          obj.element.css('cursor','sw-resize');
          if (obj.mouse_down){
            obj.images[2].x = obj.mouse_x;

            let d_x = obj.m_prev_x-obj.mouse_x;
            let d_y = obj.m_prev_y-obj.mouse_y;

            if(obj.img_prev_w+d_x > 40){ obj.images[2].w = obj.img_prev_w+d_x;}
            if(obj.img_prev_h-d_y > 40){ obj.images[2].h = obj.img_prev_h-d_y;}
          }
        }

        if (obj.images[2].mouseOverPointRD()){
          obj.move_img = false;
          obj.element.css('cursor','se-resize');
          if (obj.mouse_down){
            let d_x = obj.m_prev_x-obj.mouse_x;
            let d_y = obj.m_prev_y-obj.mouse_y;

            if(obj.img_prev_w-d_x > 40){ obj.images[2].w = obj.img_prev_w-d_x;}
            if(obj.img_prev_h-d_y > 40){ obj.images[2].h = obj.img_prev_h-d_y;}
          }
        }

        if(obj.move_img){
          obj.resize      = false;
          obj.images[2].x = obj.mouse_x-obj.diff_x;
          obj.images[2].y = obj.mouse_y-obj.diff_y;
        }
      }
    });

    this.element.mousedown(function(e){
      obj.mouse_down = true;
      obj.m_prev_x   = obj.mouse_x;
      obj.m_prev_y   = obj.mouse_y;
      if(obj.images[2]){
        obj.img_selected = false;
        obj.diff_x = obj.mouse_x-obj.images[2].x; obj.diff_y = obj.mouse_y-obj.images[2].y;
        obj.move_img = obj.images[2].mouseOver();
        obj.resize   = obj.images[2].mouseOverPointLU();
        obj.resize   = obj.images[2].mouseOverPointRU();
        obj.resize   = obj.images[2].mouseOverPointLD();
        obj.resize   = obj.images[2].mouseOverPointRD();

        obj.img_selected = obj.resize || obj.move_img;
        obj.img_prev_w = obj.images[2].w; obj.img_prev_h = obj.images[2].h;
      }
    });

    this.element.mouseup(function(e){
      obj.move_img   = false;
      obj.resize     = false;
      obj.mouse_down = false;
    });
  }

  setImgPointers(){
    if(this.images[2]){
      this.context.rotate(this.images[2].angle);
      this.context.strokeStyle = "#FF0000";
      this.context.lineWidth = 2;
      this.context.strokeRect(this.images[2].x, this.images[2].y, this.images[2].w, this.images[2].h);
      this.context.fillStyle = "#FF0000";
      this.context.fillRect(this.images[2].x-this.tam_point, this.images[2].y-this.tam_point, 10, 10);
      this.context.fillRect(this.images[2].x+this.images[2].w-this.tam_point, this.images[2].y+this.images[2].h-this.tam_point, 10, 10);
      this.context.fillRect(this.images[2].x+this.images[2].w-this.tam_point, this.images[2].y-this.tam_point, 10, 10);
      this.context.fillRect(this.images[2].x-this.tam_point, this.images[2].y+this.images[2].h-this.tam_point, 10, 10);

      this.context.fillRect(this.images[2].x+this.images[2].w/2, this.images[2].y-this.images[2].h/4, 1, this.images[2].h/4);
      this.context.fillRect(this.images[2].x-this.tam_point+this.images[2].w/2, this.images[2].y-this.tam_point-this.images[2].h/4, 11, 10);
      this.context.rotate(-this.images[2].angle);
    }
  }

  draw(){
    this.context.clearRect(0,0,this.canvas_w,this.canvas_h);
    for(let c=0;c< this.images.length;c++){
      this.context.globalAlpha = this.images[c].opacity;
      this.context.rotate(this.images[c].angle);
      this.context.imageSmoothingEnabled = true;
      this.context.drawImage( this.images[c].img, this.images[c].x, this.images[c].y, this.images[c].w, this.images[c].h);
      this.context.rotate(-this.images[c].angle); //se vuelve a dejar el lienzo como estaba
    }
    if (this.img_selected){ this.setImgPointers(); }
  }

  setImg(t,src,callback=-1){
    this.images[t] = new CanvasImg(src,this,callback);
  }

}

class CoodeWWPPlugin{
  constructor(){
    this.data_products = {};
    this.pref_url      = WPP_URL;

    this.take_img_bt    = $('#go-take-photo');
    this.canvas_adm     = new CanvasManager();

    this.stage_DOM_obj  = [];

    this.pedido = {'material':null,'material_n':'', 'material_img_url':'', 'forma':null, 'forma_n':'','forma_img_url':'', 'tamanio':null, 'tamanio_n':'', 'imagen':null};

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

    let st = $(".stage-headline");
    for(let c=0;c<st.length;c++){
      if (c < this.actual_step-1){
        $(st[c]).children('.indication').css('visibility','visible');
        $(st[c]).children('.indication').css('opacity','1');
      } else {
        $(st[c]).children('.indication').css('visibility','hidden');
        $(st[c]).children('.indication').css('opacity','0');
      }
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
        obj.pedido.material_img_url = $(this).attr('data-img');
        $('#indication-kind').html(obj.pedido.material_n);
        obj.disable_formas();
        obj.go_to_step(2);
    });

    //se recorren los botones para Volver
    $('.back-button').click( (e)=>{ obj.back_step(); });

    //se recorren los botones de formas
    $('.wpp-form-btn').click( function(){
        obj.pedido.forma   = $(this).attr('data-id');
        obj.pedido.forma_n = $(this).attr('data-name');
        obj.pedido.forma_img_url = $(this).attr('data-img');
        $('.img-size').attr('src',obj.pedido.forma_img_url);
        $('#indication-shape').html(obj.pedido.forma_n);
        obj.disable_tamanios();
        obj.go_to_step(3);
    });

    //se recorren los botones de tamaños
    $('.wpp-size-btn').click( function(){
        obj.pedido.tamanio   = $(this).attr('data-id');
        obj.pedido.tamanio_n = $(this).attr('data-name');
        $('#indication-size').html(obj.pedido.tamanio_n);
        obj.canvas_adm.setImg(0, obj.pedido.material_img_url);
        obj.canvas_adm.setImg(1, obj.pedido.forma_img_url);
        obj.canvas_adm.images[0].setTam(obj.canvas_adm.canvas_w, obj.canvas_adm.canvas_h);
        obj.canvas_adm.images[1].setTam(obj.canvas_adm.canvas_w, obj.canvas_adm.canvas_h);
        obj.go_to_step(4);
    });

    $('#edit-closer').click(function(){
      $(".WPP_pop_up_wrapper").css('display','none');
    });

    //se recorren los botones del checkpoint
    $('.stage-headline').click( function() {
        let d = $(this).attr('data-target');
        if(d<obj.actual_step){ obj.go_to_step(d); }
    });

    //Se sube la Imagen
    $('.upload-photo').click(function(){
      $('#file-reader').click();
    });
    $('#file-reader').change(function(e){
      $(".WPP_pop_up_wrapper").css('display','block');
      let file = e.target.files[0];

      if ( !(file.type == "image/png" || file.type == "image/jpg" || file.type == "image/bmp" || file.type == "image/jpeg") ){
        alert('Solo se pueden subir imágenes .PNG, .BMP o .JPG');
        return true;
      }
      obj.canvas_adm.setImg(2, URL.createObjectURL(file),function(){
        obj.canvas_adm.images[2].scale = 2;
        obj.canvas_adm.images[2].opacity = 0.75;
        obj.canvas_adm.images[2].scaleToContainer();
      });
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
        '      <div class="images-wrapper mat-btn" data-img="'+WPP_URL+mat.img_url+'" data-kind="'+mat.abreviacion+'" data-name="'+mat.abreviacion+'" data-id="'+mat.id+'">'+
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
        '      <div class="images-wrapper wpp-form-btn" data-kind="'+mat.abreviacion+'" data-img="'+WPP_URL+mat.img_url+'" data-kind-name="'+mat.abreviacion+'" data-id="'+mat.id+'" data-name="'+mat.nombre+'">'+
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
      content += '<div class="square" id="tama-'+mat.id+'"><div class="inner s-size" data-size="25-30">'+
          '<div class="images-wrapper wpp-size-btn" data-id="'+mat.id+'" data-name="'+mat.nombre+'" data-price="'+mat.precio+'">'+
              '<div class="form-rectangle" style="'+mat.style+'"><img class="img-responsive img-size"></div>'+
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

  disable_tamanios(){
    let mat = this.find_mat_id(this.pedido.material);
    let tam = [];

    for (let c=0;c<mat.formas.length;c++){
      if(mat.formas[c].id_forma == this.pedido.forma){
        tam = mat.formas[c].tamanos; break;
      }
    }

    for (let c=0;c<this.data_products.tamanos.length;c++){
      let e = $('#tama-'+this.data_products.tamanos[c].id);
      e.css('display', 'none');
    }
    for (let c=0;c<tam.length;c++){
      let e = $('#tama-'+tam[c]);
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
