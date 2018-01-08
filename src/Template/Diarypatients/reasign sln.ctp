<?php
    use Cake\Routing\Router; 
?>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="page-header">
            <p><?= $this->Html->link(__('Volver'), ['controller' => 'Diarypatients', 'action' => $origin], ['class' => 'btn btn-sm btn-default']) ?></p>    	   
            <h2>Reasignar paciente a usuario</h2>
        </div>
        <div class="row panel panel-default">
            <div class="col-md-12">
                <br />
                <label for="patient">Por favor escriba el primer apellido del usuario</label>
                <br />
                <input type="text" class="form-control" id="patient">
                <input type="hidden" id="patient-user" value=<?= $idPatient ?>> 
                <br />
                <p id="header-messages"></p>
                <br />
                <div class="panel panel-default pre-scrollable" style="height:220px;">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <tbody id="response-container"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
// Declaración de variables
    var selectPatient = -1;
    
// Funciones

    function log(message) 
    {
        cleanPager();
        $("#response-container").html(message);
    }

    function cleanPager()
    {
        $('#patient').val(" ");
        $("#response-container").html("");
    }
    
// Funciones Jquery

    var patient = "";

    $(document).ready(function() 
    {
        $('#patient').autocomplete(
        {
            source:'<?php echo Router::url(array("controller" => "Users", "action" => "findPromoter")); ?>',
            minLength: 3,
            select: function( event, ui ) {
                log("<tr id=pa" + ui.item.id + " class='patients'><td>" + ui.item.value + "</td></tr>");
                patient = ui.item.value;
              }
        });

        $("#response-container").on("click", ".patients", function()
        {
            idPatient = $(this).attr('id').substring(2);

            if (selectPatient > -1)
            {
                $('#pa' + selectPatient).css('background-color', 'white');
            }
            
            selectPatient = idPatient;
            
            $('#pa' + selectPatient).css('background-color', '#c2c2d6');  
    
            cleanPager();
            
            $("#header-messages").html("Por favor espere...");
            
            $.redirect('/sln/Users/reasignUser', {id1 : idPatient, id2 : $('#patient-user').val()}); 

        });

// Final funciones Jquery
    });    

</script>