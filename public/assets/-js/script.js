// jquery ready start
$(document).ready(function() {
	// jQuery code

  setTimeout(function () {
      $('.loader-display').fadeOut('fast');
  }, 500);

  //TRUE FUNCTION OF SELECTED FOOTER NAVIGATION
  var pathTemp = window.location.pathname
  console.log("pathTemp", pathTemp);
  if(pathTemp === '/darurat'){
    $(".footer-nav-bottom  a[href='" + pathTemp + "']").addClass('active');
    $(".footer-nav-bottom  a[href='" + pathTemp + "']").addClass('text-danger');
    $(".footer-nav-bottom  a[href='" + pathTemp + "'] span").addClass('text-danger');
  }else{
    $(".footer-nav-bottom  a[href='" + pathTemp + "']").addClass('active');
  }

///// Prevent closing from click inside dropdown
  $(document).on('click', '.dropdown-menu', function (e) {
    e.stopPropagation();
  });


  $("[data-trigger]").on("click", function(e){
      e.preventDefault();
      e.stopPropagation();
      var offcanvas_id =  $(this).attr('data-trigger');
      $(offcanvas_id).toggleClass("show");
      $(".screen-overlay").toggleClass("show");
      $('body').toggleClass("offcanvas-active");
  });

  $(".btn-close, .screen-overlay").click(function(e){
    e.preventDefault();
      $(".offcanvas").removeClass("show");
      $(".screen-overlay").removeClass("show");
      $("body").removeClass("offcanvas-active");
  });


  $('.box-selection input').change(function () {
      item = $(this).closest('.box-selection');
      if ($(this).is(':checked')) {
          item.siblings().removeClass('active');
          item.addClass('active');
        // item.find('.radio').find('span').text('Add');
      } else {
          item.removeClass('active');
          // item.find('.radio').find('span').text('Unselect');
      }
  });

  // Ecommerce code
  const main = {
      "ajax_url":"",
      "ajax_url_shipping_charge":"/shippingcharge",
      "currency": new Intl.NumberFormat('id-ID', {
          style: 'currency',
          currency: 'IDR',
          minimumFractionDigits: 0
      }),
      "nonce": "",
      "font_uri" : false,
      "store_id" : "",
      "store_admin_fee" : 1000,
      "store_name" : "",
      "store_ongkir" : "0",
      "store_ongkir_name" : "Flat Ongkir",
      "store_ongkir_enable" : true,
      "store_ongkir_provider" : "flatongkir",
      "store_admin_phone" : "6282153053443",
      "store_opened_message" : "Hai kak, saya akan memesan",
  };

  let d = document;
  let RKommers;
	RKommers = {

		init: function(){
			let self = this;

			// if( main.store_ongkir_enable ){
			// 	localStorage.setItem('cart_ongkir', main.store_ongkir);
			// 	localStorage.setItem('cart_ongkir_name', main.store_ongkir_name);
			// 	localStorage.removeItem('cart_ongkir_list');
			// }

			self.scrollCategory();
			// self.loadMore();
			self.buttonAdd();
			self.buttonQty();
			self.loadBasket();
			self.openSupportWa();

      // binding payment click
      let $local_storage_length = localStorage.length;
      let $local_payment_method = localStorage.getItem('payment_method') ? localStorage.getItem('payment_method') : null;

      if($local_storage_length > 0 || !!localStorage.getItem('shopping_cart')){
        if($local_payment_method !== null){
          let $pmvalueinit = d.getElementById('payment-method') ? d.getElementById('payment-method').innerHTML : '';
          $pmvalueinit = $pmvalueinit.replace('{payment_value}', $local_payment_method);
          d.getElementById('payment-method').innerHTML = $pmvalueinit;
        }

        // d.getElementById('payment-method').innerHTML;
        let $button = d.querySelectorAll('.click-payment');
        for (var i = 0, length = $button.length; i < length; i++) {
  				$button[i].onclick = function(element){
            if( this.getAttribute('data-value') == 'CASH'){
              let $pm = d.getElementById('payment-method');
              $pm.style.display = 'block';

              let $pmvalue = d.getElementById('payment-method').innerHTML;
              if($local_payment_method !== null){
                $pmvalue = $pmvalue.replace('TRANSFER', 'CASH');
              }else{
                $pmvalue = $pmvalue.replace('{payment_value}', 'CASH');
              }
              d.getElementById('payment-method').innerHTML = $pmvalue;
              localStorage.setItem('payment_method', 'CASH');

              d.getElementById('section-cash').style.display = 'block';
              d.getElementById('section-transfer').style.display = 'none';

              let $btnconfirmation = d.getElementById('btn-confirmation');
              $btnconfirmation.style.display = 'flex';

              d.querySelector('#btn-order-confirmation').onclick = function(){
                RKommers.sendingWA();
              }
            }else{
              let $pm = d.getElementById('payment-method');
              $pm.style.display = 'block';

              let $pmvalue = d.getElementById('payment-method').innerHTML;
              if($local_payment_method !== null){
                $pmvalue = $pmvalue.replace('CASH', 'TRANSFER');
              }else{
                $pmvalue = $pmvalue.replace('{payment_value}', 'TRANSFER');
              }
              d.getElementById('payment-method').innerHTML = $pmvalue;
              localStorage.setItem('payment_method', 'TRANSFER');

              d.getElementById('section-cash').style.display = 'none';
              d.getElementById('section-transfer').style.display = 'block';

              let $btnconfirmation = d.getElementById('btn-confirmation');
              $btnconfirmation.style.display = 'flex';

              d.querySelector('#btn-order-confirmation').onclick = function(){
                RKommers.sendingWA();
              }
            }
          }
        }
      }else{
        d.getElementById('choose-payment').style.display = 'none';
        d.getElementById('payment-method').style.display = 'none';
        d.getElementById('btn-confirmation').style.display = 'none';

        d.getElementById('btn-back-home').style.display = 'flex';
      }

      // clickpay.onclick = function(element){
      //   console.log(element);
      // }
      // function clickPayment(label){
      //   $("#payment-method").show();
      //   $("#payment-value").html(label);
      // }


		},
		// rajaongkirLoad: function(info){
		// 	let $cart = d.getElementById('cart'),
		// 	$cart_name = 'cart_' + main.store_id,
		// 	$cart_items = localStorage.getItem($cart_name) ? JSON.parse(localStorage.getItem($cart_name)) : [],
		// 	$weight = 0;
    //
		// 	$cart.querySelector('[name="district_name"]').value = info.text;
    //         $cart.querySelector('[name="district_id"]').value = info.value;
    //
		// 	$cart_items.forEach( function(item, i, object) {
    //
		// 		if( typeof(item.item_weight) == 'undefined' || item.item_weight == null ){
		// 			item.item_weight = 1000;
		// 		}
    //
		// 		let $sub_weight = parseInt(item.qty) * parseInt(item.item_weight);
		// 		$weight = $weight + $sub_weight;
    //
		// 	});
    //
		// 	let $url = main.ajax_url+'?action=get_ongkir&nonce='+main.nonce+'&destination='+info.value+'&weight='+$weight;
    //
		// 	fetch($url)
		// 	.then((respons) => respons.json())
		// 	.then(function(json){
		// 		if( json == '404' ){
		// 			alert('Gagal mendapatkan data ongkir, silahkan hubungi admin');
		// 		}else{
		// 			localStorage.setItem('cart_ongkir', json[0].value);
		// 			localStorage.setItem('cart_ongkir_name', '('+json[0].courier+' '+json[0].service+')');
		// 			localStorage.setItem('cart_ongkir_list', JSON.stringify(json));
		// 			RKommers.loadCart();
    //
		// 			let $ongkir_field = $cart.querySelector('#choose-ongkir'),
		// 			$ongkirs = localStorage.getItem('cart_ongkir_list') ? JSON.parse(localStorage.getItem('cart_ongkir_list')) : [];
		// 			$ongkir_field.options.length = 0;
		// 			for (let i = 0; i < $ongkirs.length; i++) {
		// 				let name = main.currency.format($ongkirs[i].value)+' ('+$ongkirs[i].courier+' '+$ongkirs[i].service+')';
		// 				$ongkir_field.options.add(new Option(name, $ongkirs[i].value));
		// 			}
    //
		// 			RKommers.rajaongkirChoose();
    //
		// 		}
    //
		// 	})
		// 	.catch(function(error){
		// 		console.log(error);
		// 	});
		// },
		// rajaongkirChoose: function(){
		// 	let $cart = d.getElementById('cart'),
		// 	$chooser = $cart.querySelector('#choose-ongkir');
    //
		// 	$chooser.onchange = function(){
		// 		let text = this.options[this.selectedIndex].text;
		// 		let valval = this.selectedIndex;
		// 		let regExp = /\(([^)]+)\)/;
		// 		let matches = regExp.exec(text);
		// 		let $options = this.options;
		// 		localStorage.setItem('cart_ongkir', this.value);
		// 		localStorage.setItem('cart_ongkir_name', matches[0]);
		// 		RKommers.loadCart();
    //
		// 		let $ongkir_field = $cart.querySelector('#choose-ongkir'),
		// 		$ongkirs = localStorage.getItem('cart_ongkir_list') ? JSON.parse(localStorage.getItem('cart_ongkir_list')) : [];
		// 		$ongkir_field.options.length = 0;
		// 		for (let i = 0; i < $ongkirs.length; i++) {
		// 			let name = main.currency.format($ongkirs[i].value)+' ('+$ongkirs[i].courier+' '+$ongkirs[i].service+')';
		// 			$ongkir_field.options.add(new Option(name, $ongkirs[i].value));
		// 		}
    //
		// 		$ongkir_field.selectedIndex = valval;
    //
		// 		RKommers.rajaongkirChoose();
		// 	}
		// },
		scrollCategory: function(){
			let $box = d.getElementById('category-slide');
			if( typeof($box) != 'undefined' && $box != null ){
				let $left = $box.querySelector('.arrow-left'),
				$right = $box.querySelector('.arrow-right'),
				$catbox = $box.querySelector('.slide-category'),
				$scroll_width = $catbox.scrollWidth,
				$scroll_left = $catbox.scrollLeft;

				if( $scroll_width <= $catbox.clientWidth ){
					$right.style.display = 'none';
				}

				$scroll_width = parseInt($scroll_width) - parseInt($catbox.clientWidth);

				$right.addEventListener('click', function(){
					$catbox.scrollTo({
						top: 0,
						left: $scroll_left += 210,
						behavior: 'smooth',
					});
					if( $scroll_left >= $scroll_width ){
						$scroll_left = $scroll_width;
						this.style.display = 'none';
					}else{
						this.style.display = 'block';
					}
					$left.style.display = 'block';

				});

				$left.addEventListener('click', function(){
					$catbox.scrollTo({
						top: 0,
						left: $scroll_left  -= 200,
						behavior: 'smooth',
					});
					if( $scroll_left <= 0 ){
						$scroll_left = 0;
						this.style.display = 'none';
					}else{
						this.style.display = 'block';
					}
					$right.style.display = 'block';
				});


			}
		},
		// loadMore: function(){
		// 	let $buttons = d.querySelectorAll('.loadmore');
		// 	for (var i = 0, length = $buttons.length; i < length; i++) {
		// 		$buttons[i].onclick = function(element){
		// 			this.innerHTML = 'Loading ...';
		// 			let $wrapper = this.parentNode,
		// 			$button = this,
		// 			ajax = new XMLHttpRequest(),
		// 			params = new URLSearchParams({
		// 				action: 'loadmore-products',
		// 				paged: this.getAttribute('data-paged'),
		// 				search: this.getAttribute('data-search'),
		// 				store_id: this.getAttribute('data-store-id'),
		// 				category_id: this.getAttribute('data-category-id'),
		// 				nonce: main.nonce
		// 			});
    //
		// 			ajax.open('GET', main.ajax_url+'?'+params.toString(), true);
		// 			ajax.onload = function(){
		// 				if( ajax.status === 200){
		// 					let $response = JSON.parse(ajax.responseText),
		// 					html = new DOMParser().parseFromString($response.products, 'text/html'),
		// 					products = html.querySelectorAll('.productbox');
		// 					products.forEach(function (product, key) {
		// 						$wrapper.querySelector('.products').appendChild(product);
		// 					});
		// 					new LazyLoad({elements_selector: ".lazy"});
		// 					if( $response.next ){
		// 						$button.innerHTML = 'Tampilkan lebih banyak';
		// 						$button.setAttribute('data-paged', $response.next);
		// 					}else{
		// 						$wrapper.removeChild($button);
		// 					}
		// 					RKommers.init();
		// 				}
		// 			}
		// 			ajax.send();
		// 		}
		// 	}
		// },
		buttonAdd: function(){
			let $buttons = d.querySelectorAll('.button-add');
      let $store_id = d.querySelector('input[name="store_id"]') !== null ? d.querySelector('input[name="store_id"]').value : 0;
      let $store_slug = d.querySelector('input[name="store_slug"]') !== null ? d.querySelector('input[name="store_slug"]').value : '/stores';
      let $store_district = d.querySelector('input[name="store_district"]') !== null ? d.querySelector('input[name="store_district"]').value : '';

			for (var i = 0, length = $buttons.length; i < length; i++) {
				let $atc = $buttons[i].parentNode;
				let $qty = $atc.querySelector('.qty');
				$buttons[i].onclick = function(element){
          // console.log("$store_id", $store_id);
          if(parseInt($store_id) === parseInt(localStorage.getItem('store_id')) || localStorage.getItem('store_id') === null || localStorage.getItem('store_id') === '0'){

            $qty.querySelector('input').value = 1;
  					this.style.display = 'none';
  					$qty.style.display = 'flex';
  					RKommers.collectItem($atc);

            localStorage.setItem('store_id', parseInt($store_id));
            localStorage.setItem('store_slug', '/stores/'+$store_slug);
            localStorage.setItem('store_district', $store_district);
          }else{
            // alert("apa anda yakin untuk pindah ke toko ini?");
            Swal.fire({
              title: 'Anda ingin pindah Toko ?',
              text: "Jika anda ingin pindah Toko, maka keranjang belanja anda akan kami isi dengan barang baru",
              icon: 'question',
              showCancelButton: true,
              confirmButtonText: 'Ya, Lakukan!',
              cancelButtonText: 'Tidak, Batalkan!',
              confirmButtonColor: '#313AEB',
              reverseButtons: true
            }).then((result) => {
              if (result.isConfirmed) {
                // do yes
                localStorage.clear();

                $qty.querySelector('input').value = 1;
      					this.style.display = 'none';
      					$qty.style.display = 'flex';
      					RKommers.collectItem($atc);

                localStorage.setItem('store_id', parseInt($store_id));
                localStorage.setItem('store_slug', '/stores/'+$store_slug);
                localStorage.setItem('store_district', $store_district);
              } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
              ) {
                // do cancel
                window.location.href = localStorage.getItem('store_slug');
              }
            })

          }
				}
			}
		},
		buttonQty: function(){
			let $buttons = d.querySelectorAll('.button-qty');
			for (var i = 0, length = $buttons.length; i < length; i++) {
				let $qty = $buttons[i].parentNode;
        let $qty_new = $buttons[i].parentNode.parentNode,
				$add = $qty.parentNode.parentNode.querySelector('.button-add'),
				$qty_input = $qty.parentNode.querySelector('input'),
				$new_qty_input_value;
				$buttons[i].onclick = function(){
					if( this.getAttribute('data-qty-action') == 'plus' ){
						$new_qty_input_value = parseInt($qty_input.value) + 1;
					}else{
						$new_qty_input_value = parseInt($qty_input.value) - 1;
					}

					if( $new_qty_input_value < 1 ){
						$new_qty_input_value = 0;
						$qty_new.style.display = 'none';
						$add.style.display = 'block';
					}
					$qty_input.value = $new_qty_input_value;
					RKommers.collectItem($qty.parentNode.parentNode);
				}
			}
		},
		collectItem: function(atc){
			let $inputs = atc.querySelectorAll('input'),
			$data = {};
			for (var i = 0, length = $inputs.length; i < length; i++) {
				let $name = $inputs[i].name;
				$data[$name] = $inputs[i].value;
			}
			let $cart_name = 'shopping_cart',
			$cart_items = localStorage.getItem($cart_name) ? JSON.parse(localStorage.getItem($cart_name)) : [],
			$is_item_exists = false;

			$cart_items.forEach( function(item, i, object) {
				if( $data.item_id == item.item_id ){
					if( $data.qty < 1 ){
						object.splice(i, 1)
					}else{
						$cart_items[i].qty = $data.qty;
					}
					$is_item_exists = true;
				}
			});

			if( $is_item_exists == false ){
				$cart_items.push($data);
			}
      if(!$cart_items.length){
        localStorage.setItem('store_id', 0);
        localStorage.setItem('store_slug', '/stores');
        localStorage.setItem('store_district', '');
      }

      localStorage.setItem($cart_name, JSON.stringify($cart_items));
      RKommers.loadBasket();
		},
		loadBasket: function(){
			let $footer = d.querySelector('footer'),
			$basketbox = d.getElementById('basketbox'),
      $header = d.getElementById('cart-counter'),
      $linkstore = d.getElementById('link-store'),
      $linkbackcart = d.querySelector('.btn-back-header-cart');
			$total = 0,
			$subtotal = 0,
			$cart_name = 'shopping_cart';
			$cart_items = localStorage.getItem($cart_name) ? JSON.parse(localStorage.getItem($cart_name)) : [];
      $cart_linkstore = localStorage.getItem('store_slug');
      $linkstore ? $linkstore.setAttribute('href', $cart_linkstore) : null;
      $linkbackcart ? $linkbackcart.setAttribute('href', $cart_linkstore ? $cart_linkstore : '/stores') : null;


			if( $cart_items.length > 0 ){
				$cart_items.forEach( function(item, i, object) {
					let $atcs = d.querySelectorAll('.atc-item-'+item.item_id);
					for (var i = 0, length = $atcs.length; i < length; i++) {
						let $qty = $atcs[i].querySelector('.qty');
						$qty.querySelector('input').value = item.qty;
						let $add = $atcs[i].querySelector('.button-add');
						if( typeof($add) != 'undefined' && $add != null ){
							$add.style.display = 'none';
							$qty.style.display = 'flex';
						}
					}
					$subtotal = parseInt(item.item_price) * parseInt(item.qty);
					$total = $total + $subtotal;
				});

				$basketbox ? $basketbox.querySelector('.basket-cart-item-count').innerHTML = $cart_items.length : null ;
        $header ? $header.querySelector('.basket-cart-item-count-header').innerHTML = $cart_items.length : null;
				$basketbox ? $basketbox.querySelector('.basket-items-total').innerHTML = main.currency.format($total) : null;
        //
				// $footer.classList.add('product-footer');
				$basketbox ? $basketbox.style.display = 'block' : null;
			}else{
				// $footer.classList.remove('product-footer');
				if( typeof($basketbox) != 'undefined' && $basketbox != null ){
					$basketbox.style.display = 'none';
					let $atcs = d.querySelectorAll('.atc');
					for (var i = 0, length = $atcs.length; i < length; i++) {
						let $add = $atcs[i].querySelector('.button-add');
						if( typeof($add) != 'undefined' && $add != null ){
							$add.style.display = 'block';
						}
						$atcs[i].querySelector('.qty').querySelector('input').value = 0;
						$atcs[i].querySelector('.qty').style.display = 'none';
					}
          $header.querySelector('.basket-cart-item-count-header').innerHTML = '';
				}
			}

      let urlCart = window.location.pathname;
      if(urlCart === '/cart'){
        setTimeout(function(){
          if($cart_items.length > 0){
            RKommers.loadCart();
          }else{
            window.location.href = "/stores";
          }
        })
      }
			// $basketbox.onclick = function(){
			// 	RKommers.openCart();
			// }
		},
		cartButtonQty: function(){

			let $buttons = d.querySelectorAll('.cart-button-qty');
			for (var i = 0, length = $buttons.length; i < length; i++) {
				let $qty = $buttons[i].parentNode.parentNode,
				$qty_input = $qty.querySelector('input'),
				$new_qty_input_value;
				$buttons[i].onclick = function(){
					let $item_id = $qty.getAttribute('data-item-id'),
					$cart_name = 'shopping_cart',
					$cart_items = localStorage.getItem($cart_name) ? JSON.parse(localStorage.getItem($cart_name)) : [];

					if( this.getAttribute('data-qty-action') == 'plus' ){
						$new_qty_input_value = parseInt($qty_input.value) + 1;
					}else{
						$new_qty_input_value = parseInt($qty_input.value) - 1;
					}

					if( $new_qty_input_value < 1 ){
						$new_qty_input_value = 0;
					}

					$cart_items.forEach( function(item, i, object) {

						if( $item_id == item.item_id ){

							if( $new_qty_input_value < 1 ){
								object.splice(i, 1);
								let $atc = d.getElementById('atc-item-'+$item_id);
								if( typeof($atc) != 'undefined' && $atc != null ){

									let $add = $atc.querySelector('.button-add');
									if( typeof($add) != 'undefined' && $add != null ){
										$add.style.display = 'block';
										$atc.querySelector('.qty').style.display = 'none';
									}

								}
							}else{
								$cart_items[i].qty = $new_qty_input_value;
							}
						}

					});

					localStorage.setItem($cart_name, JSON.stringify($cart_items));
					$qty_input.value = $new_qty_input_value;
					let $is_cart_exists = RKommers.loadCart();
					if( $is_cart_exists ){

					}else{
						// RKommers.closeCart();
            localStorage.setItem('store_id', 0);
            localStorage.setItem('store_slug', '/stores');
            localStorage.setItem('store_district', '');
            window.location.href = '/stores'
					}
					RKommers.loadBasket();
				}
			}
		},
		loadCart: function(){
			let $cart = d.getElementById('cart'),
			$cart_name = 'shopping_cart',
			$items_list = '',
			$total = 0,
			$subtotal = 0,
            $adminfee = main.store_admin_fee,
			$weight = 0,
			$item_template = d.getElementById('template-productcart').innerHTML,
			$detail_template = d.getElementById('template-detail').innerHTML,
			$cart_items = localStorage.getItem($cart_name) ? JSON.parse(localStorage.getItem($cart_name)) : [];
      $store_district = localStorage.getItem('store_district') ? localStorage.getItem('store_district') : '';
      $store_id = localStorage.getItem('store_id') ? localStorage.getItem('store_id') : 'Bontang';
			$cart_ongkir = localStorage.getItem('cart_ongkir') ? localStorage.getItem('cart_ongkir') : main.store_ongkir;

      $cart_linkstore = localStorage.getItem('store_slug');
      $cart.querySelector('.add-more-product').href = $cart_linkstore ? $cart_linkstore : '/stores';

			if( $cart_items.length > 0 ){
				//$cart.querySelector('.cart-head-store').innerHTML = main.store_name;

				$cart_items.forEach( function(item, i, object) {
					let $template = $item_template,
					$price = '';
					$template = $template.replace('{item_image}', item.item_image);
					$template = $template.replace('{item_name}', item.item_name);
					// if( item.item_price == item.item_price_slik ){
					// 	$price = '<span class="price">'+main.currency.format(item.item_price)+'</span>';
					// }else{
					// 	$price = '<span class="price">'+main.currency.format(item.item_price)+'</span> <span class="price-slik">'+main.currency.format(item.item_price_slik)+'</span>';
					// }

          $price = '<span class="price">'+main.currency.format(item.item_price)+'</span>';
					$template = $template.replace('{item_price}', $price);
					$template = $template.replace('{item_qty}', item.qty);
					$template = $template.replace('{item_id}', item.item_id);
					$items_list += $template;

					let $subsubtotal = parseInt(item.item_price) * parseInt(item.qty);
					$subtotal = $subtotal + $subsubtotal;

					if( typeof(item.item_weight) == 'undefined' || item.item_weight == null ){
						item.item_weight = 1000;
					}

					let $sub_weight = parseInt(item.qty) * parseInt(item.item_weight);
					$weight = $weight + $sub_weight;
				})
				$cart.querySelector('.cart-content-items-list').innerHTML = $items_list;

        // set data for detail payment on cart
				$detail_template = $detail_template.replace('{subtotal}', main.currency.format($subtotal));
        $detail_template = $detail_template.replace('{store_district}', $store_district);
        $detail_template = $detail_template.replace('{admin_fee}', main.currency.format($adminfee));
				$total = parseInt($subtotal) + parseInt($adminfee);

        $detail_template = $detail_template.replace('{f_origin_id}', $store_id);
        $detail_template = $detail_template.replace('{f_admin_fee}', $adminfee);


				$cart.querySelector('.cart-content-detail-list').innerHTML = $detail_template;
        RKommers.cartButtonQty();

        // call API district_shipping
        RKommers.loadDistricCharges($detail_template, $total);

				return true;
			}else{
				return false;
			}
		},
    loadDistricCharges: function(detail_template, total){
      let origin = d.getElementById('f_origin_id').value;
      let destination = d.getElementById('f_destination_id').value;
      $.ajax({
        url: '/shippingcharge',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        data: {
          ori_id: origin,
          des_id: destination,
        },
        success:function (data) {
          let $cart = d.getElementById('cart');

          detail_template = detail_template.replace('{ongkir}', main.currency.format(data.data[0].price));
          detail_template = detail_template.replace('{total}', main.currency.format(data.data[0].price + total));

          detail_template = detail_template.replace('{f_district_shipping_id}', data.data[0].id);
          detail_template = detail_template.replace('{f_shipping_charge}', data.data[0].price);
          detail_template = detail_template.replace('{f_total_price}', data.data[0].price + total);

          $cart.querySelector('.cart-content-detail-list').innerHTML = detail_template;

          d.getElementById('submit-cart').disabled = false;
          $cart.querySelector('#submit-cart').onclick = function(){
						RKommers.submitCart();
					}
         }
       });
    },
    submitCart: function(){
			let $cart = d.getElementById('cart'),
      $cart_items = localStorage.getItem($cart_name) ? JSON.parse(localStorage.getItem($cart_name)) : [];
			if( typeof($cart) != 'undefined' && $cart != null ){
        console.log("masuk", RKommers.generateInvoiceRandom());

        let $f_invoice = 'RK-'+RKommers.generateInvoiceRandom(),
        $f_customer_id = d.getElementById('f_customer_id').value,
        $f_district_shipping_id = d.getElementById('f_district_shipping_id').value,
        $f_shipping_charge = d.getElementById('f_shipping_charge').value,
        $f_admin_fee = d.getElementById('f_admin_fee').value,
        $f_total_price = d.getElementById('f_total_price').value,
        $f_status = '0';

        // Insert data to submit-order
        $.ajax({
          url: '/submit-order',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: "POST",
          data: {
            f_invoice: $f_invoice,
            f_customer_id: $f_customer_id,
            f_district_shipping_id: $f_district_shipping_id,
            f_shipping_charge: $f_shipping_charge,
            f_admin_fee: $f_admin_fee,
            f_total_price: $f_total_price,
            f_status: $f_status,
          },
          success: function (data) {
            if(data.message === 'success'){
              $.ajax({
                url: '/submit-order-item',
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                data: {
                  f_order_id: data.orders.id,
                  f_invoice_id: data.orders.invoice_id,
                  items: $cart_items,
                },
                success: function (data) {
                  console.log("Sukses ey items datanya ===>", data);
                  if(data.message === 'success'){
                    window.location.href = '/checkout/'+$f_invoice;
                  }
                },
                error: function (err){
                  console.log("Error ey datanya ===>", err);
                  // window.location.href = '/cart';
                }
              });
            }
          },
          error: function (err){
            console.log("Error ey datanya ===>", err);
            window.location.href = '/cart';
          }
        });
      }
    },
    generateInvoiceRandom: function(){
      let min = 0,
      max = 50000;
      min = Math.ceil(min);
      max = Math.floor(max);
      const num =  Math.floor(Math.random() * (max - min + 1)) + min;
      return num.toString().padStart(5, "0")
    },
    generateDecimal: function(d){
      var s = d + '';
      s = s.replace(/\./g,"");
      s = parseInt(s);
      return s;
    },
    openCart: function(){
			let $cart = d.getElementById('cart');
			if( typeof($cart) != 'undefined' && $cart != null ){
				let $is_cart_exists = RKommers.loadCart();
				if( $is_cart_exists ){
					$cart.style.display = 'block';
					b.style.overflow = 'hidden';
					$cart.querySelector('.back').onclick = function(){
						RKommers.closeCart();
					}
					$cart.querySelector('#submit').onclick = function(){
						RKommers.submitCart();
					}
					$cart.querySelector('input[name="name"]').onkeyup = function(){
						this.style.border = '1px solid #ccc';
					}
					$cart.querySelector('input[name="phone"]').onkeyup = function(){
						this.style.border = '1px solid #ccc';
					}
					$cart.querySelector('textarea[name="address"]').onkeyup = function(){
						this.style.border = '1px solid #ccc';
					}
					if( main.store_ongkir_enable && main.store_ongkir_provider == 'rajaongkir' ){
						$cart.querySelector('.ss-main').onclick = function(){
							$cart.querySelector('.ss-single-selected').style.border = '1px solid #ccc';
						}
						$cart.querySelector('#choose-ongkir').onchange = function(){
							this.style.border = '1px solid #ccc';
						}
					}
				}else{
					$cart.style.display = 'none';
					b.style.overflow = 'auto';
				}
			}
		},
		closeCart: function(){
			d.getElementById('cart').style.display = 'none';
			b.style.overflow = 'auto';
		},
		submitCartt: function(){
			let $cart = d.getElementById('cart');
			if( typeof($cart) != 'undefined' && $cart != null ){

				let $valid = true,
				$e_name = $cart.querySelector('input[name="name"]'),
				$e_phone = $cart.querySelector('input[name="phone"]'),
				$e_address = $cart.querySelector('textarea[name="address"]'),
				$e_phone_stripped = $e_phone.value.replace(/\D/g,'');
				if( $e_name.value == '' ){
					$valid = false;
					$e_name.style.border = '1px solid red';
				}
				if( $e_phone.value == '' || $e_phone_stripped <= 9 ){
					$valid = false;
					$e_phone.style.border = '1px solid red';
				}
				if( $e_address.value == '' ){
					$valid = false;
					$e_address.style.border = '1px solid red';
				}

				if( main.store_ongkir_enable && main.store_ongkir_provider == 'rajaongkir' ){
					$district_id = $cart.querySelector('input[name="district_id"]');
					if( $district_id.value == '' ){
						$valid = false;
						$cart.querySelector('.ss-single-selected').style.border = '1px solid red';
					}

					$ongkir = $cart.querySelector('#choose-ongkir');
					if( $ongkir.value == '' ){
						$valid = false;
						$ongkir.style.border = '1px solid red';
					}
				}

				if( $valid ){
					RKommers.sendWA();
				}
			}
		},
		sendingWA: function(){
			let $wa = 'https://wa.me',
			// ajax = new XMLHttpRequest(),
			$total = 0,
			$subtotal = 0,
			$order_detail = '',
			$number = 0,
			$cart_name = 'shopping_cart',
      $cart_store_origin = localStorage.getItem('store_district') ? localStorage.getItem('store_district') : '',
      $cart_payment_method = localStorage.getItem('payment_method') ? localStorage.getItem('payment_method') : '',
			$cart_items = localStorage.getItem($cart_name) ? JSON.parse(localStorage.getItem($cart_name)) : [],
			$cart_ongkir = localStorage.getItem('cart_ongkir') ? parseInt(localStorage.getItem('cart_ongkir')) : parseInt(main.store_ongkir),
			$cart_ongkir_name = localStorage.getItem('cart_ongkir_name') ? localStorage.getItem('cart_ongkir_name') : 'flatongkir',
			// $cart = d.getElementById('cart'),
			$inputs = {},
      $c_cash_nominal = d.querySelector('input[name="cash-nominal"]').value,
			$c_name = d.querySelector('input[name="name"]').value,
			$c_phone = d.querySelector('input[name="phone"]').value,
			$c_address = d.querySelector('input[name="address"]').value,
      $c_shipping = d.querySelector('input[name="shipping"]').value,
      $c_admin_fee = d.querySelector('input[name="admin_fee"]').value,
      $c_total = d.querySelector('input[name="total"]').value,
			$c_district = d.querySelector('input[name="district"]'),
			// $c_note = $cart.querySelector('textarea[name="note"]').value,
			$c_district_name = '';

			if( typeof($c_district) != 'undefined' && $c_district != null ){
				$c_district_name = $c_district.value;
			}

			if( $cart_items.length > 0 ){
				if (/Chrome|Safari|Mozilla|Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
			        $wa = 'https://wa.me';
				};

				$cart_items.forEach( function(item, i) {
					let $subsubtotal = parseInt(item.item_price) * parseInt(item.qty);
					$subtotal = $subtotal + $subsubtotal;

					$number = i + 1;
					$number = $number + '. ';

					$order_detail += '%0A*' + $number + item.item_name + '* %0A';
					$order_detail += '  Quantity : ' + item.qty + ' pcs%0A';
					$order_detail += '  Harga (@) : ' + main.currency.format(item.item_price) + ' %0A';
					$order_detail += '  Total Harga : ' + main.currency.format($subsubtotal) + ' %0A';
				});

				// $order_detail += '%0A*Pesan :* ' + $c_note + '%0A';

				if( main.store_ongkir_enable ){
          $adminfee = parseInt($c_admin_fee);
          $shipping = parseInt($c_shipping);
          $total = parseInt($c_total);
          $cash = $c_cash_nominal ? RKommers.generateDecimal($c_cash_nominal) : '';

					$order_detail += '%0ASub-Total : *' + main.currency.format($subtotal) + '*';
          $order_detail += '%0ABiaya Layanan : *' + main.currency.format($adminfee) + '*';
          $order_detail += '%0APerkiraan Ongkos Kirim ('+$cart_store_origin+' -> '+$c_district_name+'): *' + main.currency.format($shipping) + '*%0A';
          $order_detail += '%0ATotal :* ' + main.currency.format($total) + '*%0A';
          $order_detail += '%0APayment Menggunakan : *' + $cart_payment_method + ($cash ? '%20('+main.currency.format($cash)+'), kembali: ('+ main.currency.format($cash-$total) +')' : '') + '*%0A';
					//$order_detail += 'Biaya Layanan : *' + main.currency.format($cart_ongkir) + '* '+$cart_ongkir_name+'%0A';
					//$total = $cart_ongkir + parseInt($subtotal);
					//$order_detail += 'Belum Termasuk Biaya Kirim Menggunakan Gojek/Grab *' + main.currency.format($total) + '*%0A';

				}else{
					$total = parseInt($subtotal);
					$order_detail += 'Total : *' + main.currency.format($total) + '*%0A';
          $order_detail += '%0APerkiraan Ongkos Kirim :* ' + main.currency.format($c_shipping) + '*%0A';
          $order_detail += '%0ATotal + Ongkos Kirim :* ' + main.currency.format(total + $c_shipping) + '*';
				}

				let url = $wa + '/' + main.store_admin_phone + '?text=' + main.store_opened_message + '.%0A' + $order_detail + '%0A--------------------------------%0A Apabila anda membutuhkan Bantuan, pertanyaan seputar pemesanan. Anda dapat menghubungi layanan Customer Service kami di Nomor 082153053443.%0A' +'--------------------------------%0A*Nama :*%0A' + $c_name + ' ( ' + $c_phone + ' ) %0A%0A*Alamat :*%0A' + $c_address.replace(/(\r\n|\n|\r)/gm,'%0A') +',%20Kelurahan:%20'+$c_district_name+ '%0A%0A' +'Via ' + location.href;
        if($c_cash_nominal || $cart_payment_method === 'TRANSFER'){

          // delete all data on local
          localStorage.clear();

          d.getElementById('choose-payment').style.display = 'none';
          d.getElementById('payment-method').style.display = 'none';
          d.getElementById('btn-confirmation').style.display = 'none';

          d.getElementById('btn-back-home').style.display = 'flex';


          window.open(url, '_blank');
        }else{
          Swal.fire('Nominal Cash wajib diisi.');
        }

				// $inputs['customer_name'] = $c_name;
				// $inputs['customer_phone'] = $c_phone;
				// $inputs['customer_address'] = $c_address;
				// $inputs['customer_district'] = $c_district_name;
				// $inputs['customer_note'] = $c_note;
				// $inputs['order_items'] = $cart_items;
				// $inputs['order_subtotal'] = $subtotal;
				// if( main.store_ongkir_enable ){
				// 	$inputs['order_ongkir'] = $cart_ongkir;
				// 	$inputs['order_ongkir_name'] = $cart_ongkir_name;
				// }else{
				// 	$inputs['order_ongkir'] = '0';
				// }
				// $inputs['order_total'] = $total;
				// $inputs['nonce'] = main.nonce;

				// ajax.open('POST', main.ajax_url + '?action=order_create');
				// ajax.setRequestHeader('Content-Type', 'application/json');
				// ajax.onload = function() {
				// 	if (ajax.status === 200) {
        //
				// 		console.log(ajax.responseText);
				// 	}
				// };
        //
				// ajax.send(JSON.stringify($inputs));

				// let w = 960,h = 540,left = Number((screen.width / 2) - (w / 2)),top = Number((screen.height / 2) - (h / 2)),popupWindow = window.open(url, '', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=1, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
        //
				// popupWindow.focus();

				// localStorage.removeItem($cart_name);

				// RKommers.closeCart();
				// RKommers.loadBasket();
				// return false;
			}else{
				// RKommers.closeCart();
			}
		},
		openSupportWa: function(){
			let $toggle = d.getElementById('support-wa-toggle');

			if( typeof($toggle) != 'undefined' && $toggle != null ){
				$toggle.onclick = function(){
					let $wabox = d.getElementById('support-wa');
					$wabox.classList.add('open');

					RKommers.supportWa();
					RKommers.closeSupportWa();
				}
			}

		},
		closeSupportWa: function(){
			let $toggle = d.getElementById('support-wa-toggle');
			if( typeof($toggle) != 'undefined' && $toggle != null ){
				$toggle.onclick = function(){
					let $wabox = d.getElementById('support-wa');
					$wabox.classList.remove('open');

					RKommers.openSupportWa();
				}
			}

		},
		supportWa: function(){
			let $form = d.getElementById('support-wa').querySelector('form');
			$form.onsubmit = function(){
				let $data = $form.elements,
				$wa = 'https://web.whatsapp.com/send',
				$inputs = {};

				if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
					$wa = 'whatsapp://send';
				}

				for (let i = 0; i < $data.length; i++) {
					let $key = $data[i].name;
					if( $key !== '' ){
						$inputs[$key] = $data[i].value;
					}
				}

				let $message = $inputs.message.replace(/\n/g, '%0A');

				let $url = $wa + '?phone=' + main.store_admin_phone + '&text=%0A' + 'Saya *' + $inputs.name + '*%0A%0A ' + '💬 ' + $message + '%0A%0A ' + 'Via ' + location.href;

				let w = 960,h = 540,left = Number((screen.width / 2) - (w / 2)),top = Number((screen.height / 2) - (h / 2)),popupWindow = window.open($url, '', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=1, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

				popupWindow.focus();

				return false;
			}
		}
	}

	RKommers.init();
});

function copyPrice(){
  var textBox = document.getElementById("totalprice");
  textBox.select();
  document.execCommand("copy");
  Swal.fire('Total harga berhasil dicopy.');
}

function copyAccountNumber(){
  var textBox = document.getElementById("accountnumber");
  textBox.select();
  document.execCommand("copy");
  Swal.fire('Nomor rekening berhasil dicopy.');
}
