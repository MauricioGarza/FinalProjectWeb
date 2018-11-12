var product;

$(document).ready(function(){
  product = JSON.parse(localStorage.getItem('productoDetalle'));



console.log(product);
  let html = "";
  html = `<img class="productImage" src = "${product["imageURL"]}">`
  $("#imageProd").html(html);
  $("#name").html(product["nombreProducto"]);
  $("#price").html(product["precio"]);
  $("#desc").html(product["descripción"]);

  $(".productImage")
    .wrap('<span style="display:inline-block"></span>')
    .css('display', 'block')
    .parent()
    .zoom({
      magnify: 0.7
    });


    $(".agregar_prod").click(function(){
      console.log("Intento");
      let jsonToSend ={
                "product" : product["id"],
                "action": "ADD_CART"
              };

      $.ajax({
        url : "./data/applicationLayer.php",
        type : "POST",
        data : jsonToSend,
        ContentType : "application/json",
        dataType : "json",
        success : function(data){
          alertify.alert('Éxito', 'Este producto se agrego al carrito de compras!', function(){ alertify.success('Ok'); });


        },
        error : function(error){
          console.log(error);
        }
      });
    });


});
