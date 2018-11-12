var products;

window.onload = function(){
  //console.log($(".dropdown-item"));
  $(".dropdown-item").click(function(e){
    //e.preventDefault();
    let type = $(this).attr("data-item");
    localStorage.setItem('filter', type);
  });

  let type_filter = localStorage.getItem("filter");
  console.log(type_filter);
  // ajax to get items
  let jsonToSend ={
						"filterType" : type_filter,
            "action": "FILTER"
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
      html += "<div class=row>"
      $.each(data, function(key, product){
        html += `<div class="col-md-3 cProducts">
                    <img class="imageProducts" data-id="${product["id"]}" src="${product["imageURL"]}"><br>
                    <hr>
                    <span class="nombreProd" data-id="${product["id"]}">${product["nombreProducto"]}<br>
                    Precio: $${product["precio"]}</span>
                  </div>`
      });
      html+="</div>"
      $("#listings").append(html);

		},
		error : function(error){
      let html = "No se encontraron resultados"
      $("#listings").append(html);
			console.log(error);
		}
	});

  $("#sliderPrice").slider({
    min:0,
    max:10000,
    range: true,
    values:[0,10000]
  });

  $(document).on("click",".imageProducts, .nombreProd", function(){
    let passProduct;
    let id = $(this).attr("data-id");
    $.each(products,function(key, product){

      if(product["id"] == id) {
        console.log("true");
        passProduct = product;
      }
    });
    console.log(passProduct);
    localStorage.setItem('productoDetalle', JSON.stringify(passProduct));
    window.location = "detalleproducto.html";
  })
};
