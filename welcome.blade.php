<head> 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css"> 

</head>
<div class="panel panel-default">
  <!-- Содержание панели по умолчанию -->  
  <div class="panel-heading">
	<input type="text" class="form-control" id="name"  placeholder="Имя товара">
	<input type="text" class="form-control" id="cena" placeholder="Цена">
	<button type="button" id="add" class="btn btn-default">Добавить</button>
  </div>
  <!-- Таблица -->  
  <table class="table">
	<thead>
		<tr>
		  <th>Имя товара</th>
		  <th>Цена</th>
		  <th>Количество</th>
		  <th>Увеличить</th>
		  <th>Уменьшить</th>
		  <th>Удалить</th>
		</tr>
	  </thead>
	  <tbody>
	  </tbody>
  </table> 
</div>
<h1>Итоговая цена <span class="label label-default cena">0</span></h1>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script> 
<script>
class Product {

  constructor() {
    this.datta = [];
  }
	 summ(data){
		var summa=0;
		$.each(data,function(index, value){
			summa+= value['cena']*value['kolichestvo'];
		}); 
		$(".cena").empty();
		$(".cena").append(summa);
	}
	reload(){
		
		$("tr:eq(-1) td:eq(5) button").on("click", function(){
			product.delet($(this));		
		});
		$("tr:eq(-1) td:eq(3) button").on("click", function(){
			product.up($(this));
		});
		$("tr:eq(-1) td:eq(4) button").on("click", function(){
			product.down($(this));		
		});
	}
  add() {
	var flag=0;
	var flagforeach=0;
	var name = $("#name").val();
	var cena = $("#cena").val();
	if (name!="" || cena!=""){
		var kolichestvo = 1;
		if (this.datta.length == 0) {
			flag=1;
		}else{
			$.each(this.datta,function(index, value){
				if (flagforeach==0){
				  if (value['name']==name) {
					alert("Такое продукт уже есть!");
					flag=0;
					flagforeach=1;
				  }else{
					  flag=1;
				  }
				}
			});
		}
		if (flag==1) {
			var item = { name: name, cena: cena, kolichestvo:kolichestvo };
			this.datta.push(item);
			$.each(this.datta,function(index, value){});
			$('.table').append('<tr><td>'+name+'</td>'+
			  '<td>'+cena+'</td>'+
			  '<td>'+kolichestvo+'</td>'+
			  '<td><button type="button" class="btn btn-default glyphicon glyphicon-plus up"></button></td>'+
			  '<td><button type="button" class="btn btn-default glyphicon glyphicon-minus down"></button></td>'+
			  '<td><button type="button" class="btn btn-default glyphicon glyphicon-remove delet"></button></td></tr>');
			this.reload();
			this.summ(this.datta);
		}
	}
  }
  delet(thisbut) {
	var name=$(thisbut).parent().siblings(":first").text();
	var indexx;
	$.each(this.datta,function(index, value){
		  if (value['name']==name) {		  
			indexx=index;			
		  }
	});
	this.datta.splice(indexx,1);;
	thisbut.closest('tr').remove();
	this.summ(this.datta);
	
  }
  up(thisbut) {
	  var name=$(thisbut).parent().siblings(":first").text();
	  var indexx;
	  $.each(this.datta,function(index, value){
			if (value['name']==name) {		  
				indexx=index;			
			}
	  });
	  this.datta[indexx]['kolichestvo']=this.datta[indexx]['kolichestvo']+1;
	  this.summ(this.datta);
	  $(thisbut).parent().siblings(":eq(2)").empty();
	  $(thisbut).parent().siblings(":eq(2)").append(this.datta[indexx]['kolichestvo']);
  }
  down(thisbut) {
    var name=$(thisbut).parent().siblings(":first").text();
	var indexx;
	$.each(this.datta,function(index, value){
		if (value['name']==name) {		  
			indexx=index;			
		}
	});
	if (this.datta[indexx]['kolichestvo']>1){
		this.datta[indexx]['kolichestvo']=this.datta[indexx]['kolichestvo']-1;
		this.summ(this.datta);
		$(thisbut).parent().siblings(":eq(2)").empty();
		$(thisbut).parent().siblings(":eq(2)").append(this.datta[indexx]['kolichestvo']);
	}
  }
	  
}
let product = new Product();
window.onload = function () {
	
	$('#cena').keypress(function(key) { if(key.charCode < 48 || key.charCode > 57) return false; });

	$("#add").on("click", function(){
        product.add();
    });
    $(".delet").on("click", function(){
        product.delet($(this));
		
    });
	$(".up").on("click", function(){
        product.up();
    });
    $(".down").on("click", function(){
        product.down();
		
    });
}
</script>