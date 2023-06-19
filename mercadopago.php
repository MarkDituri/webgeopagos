<?php
    require 'vendor/autoload.php';    

    MercadoPago\SDK::SetAccessToken('TEST-3381582219099709-111517-6a20ca5318040b043ecf141be502b710-269870262');

    $preference = new MercadoPago\Preference();

    $item = new MercadoPago\Item();
    $item->id = '0001';
    $item->title = "Producto de prueba";
    $item->quantity = 1;
    $item->unit_price = 750.00;
    $item->currency_id = 'ARS';
    $item->external_reference = '250';

    $preference->items = array($item);
    $preference->back_urls = array(
        "success" => "http://localhost/qudimar/menu/mp/captura.php?id_rest=255&",
        "failure" => "http://localhost/qudimar/menu/mp/fallo.php"
    );

    $preference->auto_return = "approved";
    $preference->binary_mode = true;

    $preference->save();

    var_dump($preference);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://sdk.mercadopago.com/js/v2"></script>
</head>
<body>
    
    <h3>Mercado pago prueba</h3>
    <div class="checkout-btn">
    </div>


    <script>
        const mp = new MercadoPago('TEST-c9a928cd-a8a2-4736-a28b-a612a3aaf140', {
            locale: 'es-AR'
        });

        mp.checkout({
            preference: {
                id: '<?php echo $preference->id;?>'                
            },
            render: {
                container: '.checkout-btn',
                label: 'Pagar con Mercado Pago'
            }
        })
    </script>


</body>
</html>