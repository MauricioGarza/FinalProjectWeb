$(document).ready(function(){
  getCarrito();

});

function getCarrito(){
  console.log("begin");
  let jsonToSend ={
            "action": "GETCART"
          };

  $.ajax({
    url : "./data/applicationLayer.php",
    type : "GET",
    data : jsonToSend,
    ContentType : "application/json",
    dataType : "json",
    success : function(data){
      products = data;
      console.log(data);
      let html = "";
      let counter = 0;
      $.each(data, function(key, product){
        console.log(product["imagen"]);
        counter += parseInt(product["precio"]);
        console.log(counter);
        html += `<div class="row cProducts">
                    <img class="imageProducts" data-id="${product["nombre"]}" src="${product["imagen"]}"><br>
                    <hr>
                    <span class="nombreProd" data-id="${product["nombre"]}">${product["nombre"]}<br>
                    Precio: $${product["precio"]}</span>
                  </div><br>`
      });
      html += `<h3>Precio Total: $${counter}</h3>`;
      $("#shopping_cart").append(html);

    },
    error : function(error){
      let html = "No tienes productos en tu carrito"
      $("#shopping_cart").append(html);
      console.log(error);
    }
  });
}
