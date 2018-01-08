<div>
    <form>
        <fieldset>
            <input type="text" name="your-name" ?>
        </fieldset>
      <br />
      <br />
      <input type="submit" value="Guardar">
</form> 
</div>
<script>
    $(document).ready(function() 
    {
        $("[name='your-name']").focusout(function(e) 
        {
            e.preventDefault();

            alert("Si se puede");
        });
    });
</script>