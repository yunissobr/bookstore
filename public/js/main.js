function updateCartContent() {
  let cart = JSON.parse(localStorage.getItem('cart') || '[]')
  document.querySelectorAll('#cartlength')[0].innerHTML = cart.length
  document.querySelectorAll('#cartlength')[1].innerHTML = cart.length

  $('#cartItems').empty()
  if (cart.length !== 0) {
    $('#btnCheckout').show()
    cart.forEach((element) => {
      $('#cartItems').append(
        '<a href="#" class="iq-sub-card"> <div class="media align-items-center"> <div class=""> <img class="rounded" src="<?=URLROOT?>img/book/' +
          element.image +
          '" alt="" /> </div> <div class="media-body ml-3"> <h6 class="mb-0">' +
          element.title +
          '</h6> <p class="mb-0">$' +
          element.price +
          '</p> </div> <div class="float-right font-size-24 text-danger"><i onclick="removeBook(\'' +
          element.id +
          '\')" class="ri-close-fill"></i></div> </div> </a>'
      )
      if (cart.filter((e) => e.id === element.id).length > 0) {
        $('#shopping_cart_icon' + element.id).addClass('text-primary')
        $('#shopping_cart_icon' + element.id).removeClass('text-secondary')
      }
    })
  } else {
    $('#cartItems').append(
      '<div class="cart-empty-container"> <p>لا يوجد كتب في عربة تسوقك</p> </div>'
    )
    $('#btnCheckout').hide()
  } 
  updateCheckoutProducts();
}

function updateTotals(){
  let cart = JSON.parse(localStorage.getItem("cart") || "[]");
  var subtotal = 0;
  cart.map((item) => {
     subtotal += parseFloat(item.price);
  });

  if(subtotal === 0){
     setBtnCompleteOrderDisable(true);
  } else {
     setBtnCompleteOrderDisable(false);
  }


  $("#subtotal").empty()
  $("#subtotal").append('$'+subtotal);
  $("#total").empty()
  $("#total").append('$'+subtotal);
  
}
function removeBook(id) {
  console.log(id)
  if (
    confirm('هل أنت متأكد أنك تريد إزالة هذا الكتاب من عربة التسوق الخاصة بك؟')
  ) {
    let cart = JSON.parse(localStorage.getItem('cart') || '[]')
    let newCart = cart.filter((cartItem) => {
      return cartItem.id !== id
    })
    localStorage.setItem('cart', JSON.stringify(newCart))
    updateCartContent()
    updateAddToCart()
    updateTotals()
  }
}

function handleCart(book_id, title, price, image) {
  let cart = JSON.parse(localStorage.getItem('cart') || '[]')
  let singleCart = { id: book_id, title: title, price: price, image: image }
  var newCart
  if (cart.filter((e) => e.id === singleCart.id).length > 0) {
    if (
      confirm(
        'هل أنت متأكد أنك تريد إزالة هذا الكتاب من عربة التسوق الخاصة بك؟'
      )
    ) {
      newCart = cart.filter((cartItem) => {
        return cartItem.id !== singleCart.id
      })

      $('#shopping_cart_icon' + singleCart.id).removeClass('text-primary')
      $('#shopping_cart_icon' + singleCart.id).addClass('text-secondary')
    } else {
      newCart = cart
      console.log('not removed!')
    }
  } else {
    newCart = [...cart, singleCart]
  }
  localStorage.setItem('cart', JSON.stringify(newCart))
  updateCartContent()
  updateAddToCart()
  // console.log(localStorage.getItem("cart"))
}
function buyNow(book_id, title, price, image) {
  let cart = JSON.parse(localStorage.getItem('cart') || '[]')
  let singleCart = { id: book_id, title: title, price: price, image: image }
  var newCart
  if (cart.filter((e) => e.id === singleCart.id).length > 0) {
   
      newCart = cart;
    
  } else {
    newCart = [...cart, singleCart]
  }
  localStorage.setItem('cart', JSON.stringify(newCart))
  updateCartContent()
  updateAddToCart()
  // console.log(localStorage.getItem("cart"))
}




