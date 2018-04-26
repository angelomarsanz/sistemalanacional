<div>
    <p>testComunicationSend</p>
</div>
<script>

    $.post('/sln/users/addWeb', { 'typeOfIdentification' : 'V' , 'identidyCard' : '99999991',
        'firstName' : 'Web', 'surname' : 'Promotor', 'sex' : 'Masculino', 'cellPhone' : '0426-5450845', 
        'email' : 'promotorweb@gmail.com' }, null, "json")

    .done(function(response) 
    {
        if (response.success) 
        {
            alert(response.data);
        } 
        else 
        {
            alert(response.data);
        }
            
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
            
        alert('Falló la comunicación');
        
    });

</script>
