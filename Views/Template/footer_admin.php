    <script>
        const base_url = "<?= base_url(); ?>";        
        const page_name = "<?= $data['page_name'];?>";  
        const mp_access_token = "<?= mp_access_token();?>";
        const mp_public_key = "<?= mp_public_key();?>";
        const smony = "<?= SMONEY; ?>";
    </script>
    <!-- Essential javascripts for application to work-->
    <script src="<?= base_url(); ?>/Assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url(); ?>/Assets/js/popper.min.js"></script>
    <script src="<?= base_url(); ?>/Assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>/Assets/js/main.js?v=<?php echo time(); ?>"></script>
    <script src="<?= base_url(); ?>/Assets/js/fontawesome.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="<?= base_url(); ?>/Assets/js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="<?= base_url(); ?>/Assets/js/plugins/sweetalert.min.js"></script>
    <!-- <script type="text/javascript" src="<?= base_url(); ?>/Assets/js/tinymce/tinymce.min.js"></script> -->

    <!-- Data table plugin-->
    <script type="text/javascript" src="<?= base_url(); ?>/Assets/js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>/Assets/js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>/Assets/js/plugins/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js" language="javascript"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" language="javascript"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js" language="javascript"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js" language="javascript"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js" language="javascript"></script>
    <script type="text/javascript" src="https://code.highcharts.com/highcharts.js"></script>
    <script type="text/javascript" src="https://code.highcharts.com/modules/exporting.js"></script>
    <script type="text/javascript" src="https://code.highcharts.com/modules/export-data.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>/Assets/js/datepicker/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>/Assets/js/functions_admin.js?v=<?php echo time(); ?>"></script>    
    <script src="<?= base_url(); ?>/Assets/js/<?= $data['page_functions_js']; ?>?v=<?php echo time(); ?>"></script>
    <?php if ($data['page_name'] != "login"  || $data['page_name'] != "cambiar_contrasenia"){ ?>        
    <script type="text/javascript" src="<?= base_url(); ?>/Assets/js/noty.js?v=<?php echo time(); ?>"></script>    
    <?php } ?>
    <script> const id_pago = "<?= base_url(); ?>";</script>
    <?php    
    // var_dump(selectUltimoPago());
    if ($data['page_title'] == "Pagos"){
        // Variables del Pago
        $preference = MercadoPago();           
        // var_dump($preference);
    ?>
    <script>
      //Mercado Pago
      const mp = new MercadoPago(mp_public_key, {
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
    <?php } ?>
  </body>
</html>