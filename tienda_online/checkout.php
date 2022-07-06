<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://www.paypal.com/sdk/js?client-id=AcANTAUEhWB4s1CYomNZeb-i9viNtSqDzOzLm7TuhH3GLP5OZ27vXZsyLmD-PJEAy1qYe-Q1NI8pZhUb"></script>
    <!-- Set up a container element for the button -->
    
</head>
<body>
<div id="paypal-button-container"></div>
    <script>
     paypal.Buttons({
        style:{
            color:'blue',
            shape:'pill',
            label: 'pay'
        },
        createOrder:function (data, actions) {
            return actions.order.create({
                purchase_units:[{
                    amount:{
                        value: 100
                    }
                }]
            });

        },
        //vamos ha hacer la funcion de aprovacion del pago
        onApprove: function(data,actions){
            actions.order.capture().then(function(detalles){
                window.location.href="ventana.html"
             
            });
        },
        onCancel: function(data){
            alert("pago cancelado")
            console.log(data);
        }
     }).render('#paypal-button-container')
    </script>
</body>
</html>