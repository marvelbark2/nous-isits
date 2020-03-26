

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>CodePen - Twitter Bootstrap Product Listing Page</title>
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'>
{{-- <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'> --}}
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<style>
/* custom font */
@import url(https://fonts.googleapis.com/css?family=Poiret+One);

/* glyphicons */
@import url('//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css');

/* font awesome */
@import "font-awesome";


body{
 font-family: 'Poiret One', cursive;
}
h1{
  text-align:center;
  font-size: 2em;
  font-color:#27292F;
}

blockquote {
 text-align:center;
  width: 100%;
  padding: 5px;
  font-size: 1.5em;
  border-left: 2px solid #4a9a8a;
 background: linear-gradient(90deg, #f9f9f9, hsla(123,99%,93%,9));

}
/*p  */
p{
  float:right;
  font-size: 20px;
}

.fa.fa-leaf{
  color:#4a9a8a;
  padding: 10px;
}

h2{
  text-align:center;
  font-size:1.4em;
}

#rowLine{
 border-bottom: 1px dashed #4a9a8a;
width: 100%;
text-align:center;
padding: 30px;
}


/* Input= checkbox */
input[type="checkbox"] {
  display: none;
}

.custom-check {
display: inline-block;
width: 20px; height: 20px;
border: 2px solid #4a9a8a;	font-family: 'Glyphicons Halflings';

	}
.custom-check::before {
  content: "\e013";
  color: #424242;
  display: none;
}

input[type=checkbox]:checked+.custom-check::before {
  line-height:1.2;
  display: block;
  color: #554236;
}


/* List Or Grid View Div */
.ListOrGrid{
  width: 20px;
  border: 1px solid red;
}
.icon{
  margin:10px;
}
/* Product section */
#col{
   border-bottom: 1px dashed #4a9a8a;
   border-right: 1px dashed #4a9a8a;
   text-align:center;
}
#col3{
  border-right:none;
  border-bottom: 1px dashed #4a9a8a;

}
h4{
  float:left;
}
.quantity{
  width: 30px;
  height:30px;
  display: inline-block;
  text-align:center;
  border: 1px dashed #4a9a8a;
}
label{
   font-family: 'Poiret One', cursive;
}
.btn{
  width:40px;
  height:29px;
  margin-top:-5px;
  border: 1px dashed #4a9a8a;
  border-radius:0px;
  background: #ffffff;
  color: black;
}
.glyphicon.glyphicon-shopping-cart{
  color:#cc3333;
}

.fa.fa-heart{
  border: 1px solid #ec4534;
}

/* cart and payment section */

.fa.fa-paypal{color:#009cde;}
.fa.fa-credit-card{color:#ff9900;}

#shopping{
  width: 100%;
}
.col-md-4{
 border: 1px dashed #4a9a8a;
}
.centerBlock {
display: table;
margin: 0 auto;
}

/* Shopping Cart */
#finalSection{
  width:100%;
}

.table{
  width:60%;
  margin: 0 auto;
}
h3{
  text-align:center;
}
.btn.btn-default{
  width: 120px;
  margin:10px;
  text-align: center;
}
.btn.btn-default:hover{
  background-color:green;
  color: #ffffff;
}
.btn.btn-danger{
  width: 70px;
  margin:10px;
  text-align: center;
}
.btn.btn-danger:hover{
  background-color:red;
  color: #ffffff;
}

.center-block{
  margin-top:18.8px;
  width:120px;
  text-align:center;
}

#textarea{
  border:none;
}

input[type=text].contact{
 width:150px;
 border: 1px dashed #4a9a8a;
}

.textarea{
  border: 1px dashed #4a9a8a;
}
/* footer */
footer{
  width: 100%;
  background: linear-gradient(90deg, #f9f9f9, hsla(123,99%,93%,9));
  text-align:center;
 line-height:2;

}


input[type=text]{
  width: 40px;
  border: none;
  line-height: 2;
  margin:4px;
  border: 1px dashed #4a9a8a;
}
.fa.fa-twitter{
  color: #55acee;
}
.fa.fa-facebook{
  color:#3b5998;
}
.fa.fa-product-hunt{
  color:#da552f;
}
/* style for mobiles */
@media (max-width: 767px) {
  body{
    overflow-x:hidden;
  }
  #mobile-view{
display:inline-block;
width:130%;
margin-left:-30px;
  }

.custom-check {
display: inline-block;
width: 20px; height: 20px;
border: 1px solid #4a9a8a;	font-family: 'Glyphicons Halflings';
	}

  .icon{
  display:none;
}
}

#list{
  border: 1px solid red;
text-align:center;
}
</style>
<script>
  window.console = window.console || function(t) {};
</script>
<script>
  if (document.location.search.match(/type=embed/gi)) {
    window.parent.postMessage("resize", "*");
  }
</script>
</head>
<body translate="no">


<div class="container" id="shopping">
<div class="row">
<div class="col-md-4">
<div class="centerBlock">
<input type="text">
<h4> My cart <span class="glyphicon glyphicon-shopping-cart"> </span>
</h4> </input>
</div>
</div>
<div class="col-md-4">
<div class="centerBlock">
<h4> My Wish List <span class="glyphicon glyphicon-heart"> </span> </h4>
</div>
</div>
<div class="col-md-4">
<div class="centerBlock">
<button type="button" class="btn btn-default" data-toggle="modal" data-target="#cart">
    Cart (<span class="total-count"></span>)
</button>
<button class="clear-cart btn btn-danger">Clear Cart</button>
{{-- <h4>Checkout <i class="fa fa-credit-card" aria-hidden="true"></i> <i class="fa fa-paypal" aria-hidden="true"></i> <i class="fa fa-btc" aria-hidden="true"></i></h4> --}}
</div>
</div>
</div>
</div>


<div class="container">
<h1> <span i class="fa fa-leaf"> </i> </span> TeaPost </h1>
</div>
<div class="container">
<div class="row">
<div class="col-lg-12">
<blockquote>A cup of tea for me. A cup of tea for you
</blockquote>
<h2> <i class="fa fa-coffee" aria-hidden="true"></i> Our Teas </h2>
</div>
</div>
</div>


<section>
<div class="container" id="rowLine">
<div class="row">
<div class="col-lg-12">
<div id="mobile-view">
<form action="{{route('p-search')}}" method="post">
@csrf
<div class="form-group">
  <label for=""></label>
  <select class="form-control" name="cate" id="cate">
    <option>Select the category</option>
    @foreach ($cat as $item)
    <option value="{{$item->categorie}}">{{$item->categorie}}</option>
    @endforeach
  </select>
</div>
<input name="name" style="width:100%;" placeholder="Name of product" type="text" value="">

</div>
<button type="submit" class="btn btn-default">Search</button>
</form>
</div>
</div>
</div>
</section>


<div class='section'>
<div class="container" class="listOrGrid">
<div class="centerBlock">
<button class="btn btn-default" id='grid-view' onclick="grid()">Grid</button>

<button class="btn btn-default" id="list-view" onclick="list()">List</button>
</div>
</div>
</div>


<section class="productSection">
<div class="container-fluid" id="product-container">
<div class="row">
    @foreach ($items as $item)
        <div class="col-sm-4 col-lg-4 col-md-4 col">
        <div class="description">
        <h5> {{$item->product}} </h4>
        <img src="{{$item->image}}">
        <p>{{$item->brand}} </p>
        <div class="col-sm-10 col-lg-10 col-md-10">
        <div class="float-left"><h4>{{$item->price}}       </h4></div>
        <div class="float-right">
        <label> Quantity
        <input id="{{$item->id}}" class="quantity" type="number" min="0" max="1000" value="1"> </input> </label>
        <a href="#" data-name="{{$item->product}}" data-price="{{str_replace("DH", "", "$item->price")}}" data-id="{{$item->id}}" class="add-to-cart btn btn-default" class="btn btn-success"> <span class="glyphicon glyphicon-shopping-cart"> </span></a>
        <i class="fa fa-heart-o" aria-hidden="true"> </i>
        <i class="fa fa-circle-thin" aria-hidden="true"> </i>
        </div>
        </div>
        </div>
        </div>
    @endforeach
</div>
{{$items->links()}}
</section>



<div class="container" id="finalSection">
<div class="row">
<div class="col-md-6">
<h3> My Cart<span class="glyphicon glyphicon-shopping-cart"> </h3>
<table class="table">
<tbody>
<tr>
<td><h5> Cart total </h5> </td>
<td>
<input class="form-input" type="text"> </input>
</td>
</tr>
<tr>
<td><h5> Shipping</h5></td>
<td>
<input type="text"> </input>
</td>
</tr>
<tr>
<td><h5> Tax</h5></td>
<td>
<input type="text"> </input>
</td>
</tr>
<tr>
<td><h5> Coupon</h5></td>
<td>
<input type="text"> </input>
</td>
</tr>
<tr>
<td><h5>Total</h5></td>
<td>
<input type="text"> </input>
</td>
</tr>
</tbody>
</table>
<div class="centerBlock">
<button type="button" class="btn btn-default"> Checkout</button>
<button type="button" class="btn btn-default"> Keep Shopping</button>
</div>

</div>
<div class="col-md-6" id="try">
<h3> Contact Us </h3>
<form class="form-inline">
<div class="form-group">
<input class="contact" type="text" name="firstname" placeholder="First Name"> </input> </br>
<input class="contact" type="text" name="email" placeholder="Email"> </br>
<div class="textarea">
<textarea name=address rows=9 cols=29 id="textarea">
    Your message ...
    </textarea>
</div>
<button type="button" class="btn btn-success center-block"> Send</button>
</div>
</form>
</div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cart</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="show-cart table">

        </table>
        <div>Total price: $<span class="total-cart"></span></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-default">Order now</button>
      </div>
    </div>
  </div>
</div>
<!-- end of modal -->
<footer>
<div class="footerContent">
<a href="#"> <i class="fa fa-product-hunt" aria-hidden="true"></i> </a>
<a href="#"><i class="fa fa-twitter fa-lg"> </i> </a>
<a href="#"> <i class="fa fa-facebook fa-lg"> </i> </a>
</div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://static.codepen.io/assets/common/stopExecutionOnTimeout-157cd5b220a5c80d4ff8e0e70ac069bffd87a61252088146915e8726e5d9f147.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
<script id="rendered-js">
//  onclick function for list button
document.getElementById("list-view").onclick = function () {
  //This selects all the col-md-4 divs that we created for each array in the JSON object
  var displayItems = document.getElementsByClassName("col-md-4");

  //create a for loop
  //the for loop will iterate as long as it is less than the number of col-md-4 divs that were created
  for (i = 0; i < displayItems.length; i++) {if (window.CP.shouldStopExecution(0)) break;
    //for eacg col-md-4 div selected during the iteration clear the style to present it in a list
    displayItems[i].style.clear = "both";

  }window.CP.exitedLoop(0);
};


//  onclick function for list button
document.getElementById("grid-view").onclick = function () {
  //This selects all the col-md-4 divs that we created for each array in the JSON object
  var displayItems = document.getElementsByClassName("col-md-4");
  //create a for loop
  //the for loop will iterate as long as it is less than the number of col-md-4 divs that were created
  for (i = 0; i < displayItems.length; i++) {if (window.CP.shouldStopExecution(1)) break;
    //for eacg col-md-4 div selected during the iteration clear the style to present it in a list
    displayItems[i].style.clear = "none";
  }window.CP.exitedLoop(1);
};
//# sourceURL=pen.js
// ************************************************
// Shopping Cart API
// ************************************************

var shoppingCart = (function() {
  // =============================
  // Private methods and propeties
  // =============================
  cart = [];

  // Constructor
  function Item(name, price, count, id) {
    this.name = name;
    this.price = price;
    this.count = count;
    this.id = id;
  }

  // Save cart
  function saveCart() {
    sessionStorage.setItem('shoppingCart', JSON.stringify(cart));
  }

    // Load cart
  function loadCart() {
    cart = JSON.parse(sessionStorage.getItem('shoppingCart'));
  }
  if (sessionStorage.getItem("shoppingCart") != null) {
    loadCart();
  }


  // =============================
  // Public methods and propeties
  // =============================
  var obj = {};

  // Add to cart
  obj.addItemToCart = function(name, price, count, id) {
    for(var item in cart) {
      if(cart[item].name === name) {
        cart[item].count ++;
        saveCart();
        return;
      }
    }
    var item = new Item(name, price, count, id);
    cart.push(item);
    saveCart();
  }
  // Set count from item
  obj.setCountForItem = function(name, count) {
    for(var i in cart) {
      if (cart[i].name === name) {
        cart[i].count = count;
        break;
      }
    }
  };
  // Remove item from cart
  obj.removeItemFromCart = function(name) {
      for(var item in cart) {
        if(cart[item].name === name) {
          cart[item].count --;
          if(cart[item].count === 0) {
            cart.splice(item, 1);
          }
          break;
        }
    }
    saveCart();
  }

  // Remove all items from cart
  obj.removeItemFromCartAll = function(name) {
    for(var item in cart) {
      if(cart[item].name === name) {
        cart.splice(item, 1);
        break;
      }
    }
    saveCart();
  }

  // Clear cart
  obj.clearCart = function() {
    cart = [];
    saveCart();
  }

  // Count cart
  obj.totalCount = function() {
    var totalCount = 0;
    for(var item in cart) {
      totalCount += cart[item].count;
    }
    return totalCount;
  }

  // Total cart
  obj.totalCart = function() {
    var totalCart = 0;
    for(var item in cart) {
      totalCart += cart[item].price * cart[item].count;
    }
    return Number(totalCart.toFixed(2));
  }

  // List cart
  obj.listCart = function() {
    var cartCopy = [];
    for(i in cart) {
      item = cart[i];
      itemCopy = {};
      for(p in item) {
        itemCopy[p] = item[p];

      }
      itemCopy.total = Number(item.price * item.count).toFixed(2);
      cartCopy.push(itemCopy)
    }
    return cartCopy;
  }

  // cart : Array
  // Item : Object/Class
  // addItemToCart : Function
  // removeItemFromCart : Function
  // removeItemFromCartAll : Function
  // clearCart : Function
  // countCart : Function
  // totalCart : Function
  // listCart : Function
  // saveCart : Function
  // loadCart : Function
  return obj;
})();


// *****************************************
// Triggers / Events
// *****************************************
// Add item
$('.add-to-cart').click(function(event) {
  event.preventDefault();
  var name = $(this).data('name');
  var price = Number($(this).data('price'));
  var id = $(this).data('id');
  var counts = document.getElementById(id).value;
  console.log(counts)
  shoppingCart.addItemToCart(name, price, counts, id);
  displayCart();
});

// Clear items
$('.clear-cart').click(function() {
  shoppingCart.clearCart();
  displayCart();
});


function displayCart() {
  var cartArray = shoppingCart.listCart();
  var output = "";
  for(var i in cartArray) {
    output += "<tr>"
      + "<td>" + cartArray[i].name + "</td>"
      + "<td>(" + cartArray[i].price + ")</td>"
      + "<td>(" + cartArray[i].id + ")</td>"
      + "<td><div class='input-group'><button class='minus-item input-group-addon btn btn-default' data-name=" + cartArray[i].name + ">-</button></td>"
      + "<td><input type='number' style='width:40px;' class='item-count quantity form-control' data-name='" + cartArray[i].name + "' value='" + cartArray[i].count + "'></td>"
      + "<td><button class='plus-item btn btn-default input-group-addon text-left' data-name=" + cartArray[i].name + ">+</button></div></td>"
      + "<td><button class='delete-item btn btn-danger' data-name=" + cartArray[i].name + ">X</button></td>"
      + " = "
      + "<td>" + cartArray[i].total + "</td>"
      +  "</tr>";
  }
  $('.show-cart').html(output);
  $('.total-cart').html(shoppingCart.totalCart());
  $('.total-count').html(shoppingCart.totalCount());
}

// Delete item button

$('.show-cart').on("click", ".delete-item", function(event) {
  var name = $(this).data('name')
  shoppingCart.removeItemFromCartAll(name);
  displayCart();
})


// -1
$('.show-cart').on("click", ".minus-item", function(event) {
  var name = $(this).data('name')
  shoppingCart.removeItemFromCart(name);
  displayCart();
})
// +1
$('.show-cart').on("click", ".plus-item", function(event) {
  var name = $(this).data('name')
  shoppingCart.addItemToCart(name);
  displayCart();
})

// Item count input
$('.show-cart').on("change", ".item-count", function(event) {
   var name = $(this).data('name');
   var count = Number($(this).val());
  shoppingCart.setCountForItem(name, count);
  displayCart();
});

displayCart();

    </script>
</body>
</html>
