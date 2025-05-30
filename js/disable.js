		function calculate(){
			amountCount1();
			amountCount2();
			amountCount3();
			amountCount4();
		}
		function amountCount1(){
			var qty_count = parseInt(document.order.qty1.value);
			
			document.order.price1.value = qty_count* 500;
			totalPrice();
		}
		function amountCount2(){
			var qty_count = parseInt(document.order.qty2.value);
			
			document.order.price2.value = qty_count* 20000;
			totalPrice();
		}
		function amountCount3(){
			var qty_count = parseInt(document.order.qty3.value);
			
			document.order.price3.value = qty_count* 13000;
			totalPrice();
		}
		function amountCount4(){
			var qty_count = parseInt(document.order.qty4.value);
			
			document.order.price4.value = qty_count* 2000;
			totalPrice();
		}
		function totalPrice(){
			var q1 = parseFloat(document.order.price1.value);
			var q2 = parseFloat(document.order.price2.value);
			var q3 = parseFloat(document.order.price3.value);
			var q4 = parseFloat(document.order.price4.value);
			
			document.order.total.value=(q1+q2+q3+q4).toFixed(2);
		}
