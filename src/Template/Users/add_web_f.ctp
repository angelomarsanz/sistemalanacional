<?php
    use Cake\I18n\Time;
    use Cake\Routing\Router; 
?>

<div class='container'>
    <div class="row">
        <div class="col-md-6">

        	<div class="page-header">
            </div>

        	<div>
                <?= $this->Form->create() ?>
                    <fieldset>
                        <label class="control-label" for="typeOfIdentification">Tipo de identificación: </label>
                        <input id=typeOfIdentification name='typeOfIdentification' type='text' class='form-control' value='V'>

                        <label class="control-label" for="identidyCard">Cédula o RIF: </label>
                        <input id="identidyCard" name="identidyCard" type='text' class='form-control' value='99999999'>

                        <label class="control-label" for="firstName">Primer nombre: </label>
                        <p><input id="firstName" name="firstName" type='text' class='form-control' value='PROMOTOR'><p>

                        <label class="control-label" for="surname">Primer apellido: </label>
                        <p><input id="surname" name="surname" type='text' class='form-control' value='PRUEBA'><p>

                        <label class="control-label" for="sex">Sexo: </label>
                        <p><input id="sex" name="sex" type='text' class='form-control' value='MASCULINO'><p>

                        <label class="control-label" for="cellPhone">Teléfono: </label>
                        <p><input id="cellPhone" name="cellPhone" type='text' class='form-control' value='99999999'><p>

                        <label class="control-label" for="email">Email: </label>
                        <p><input id="email" name="email" type='text' class='form-control' value='pruebapromotor@gmail.com'><p>

                    </fieldset>   
                    <?= $this->Form->button(__('Guardar'), ['class' =>'btn btn-success noverScreen']) ?> 
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>