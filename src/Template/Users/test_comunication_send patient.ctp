<div>
    <p>testComunicationSend</p>
</div>
<script>

    $.post('/sln/users/addWebBasic', { 'typeOfIdentification' : 'V' , 'identidyCard' : '99999999',
        'firstName' : 'Paciente', 'surname' : 'Web', 'sex' : 'Masculino', 'birthdate' : '2017-10-23',
        'cellPhone' : '0426-5450845', 'email' : 'pacienteweb1@gmail.com', 'country' : 'Venezuela',
        'address' : 'Los Cerritos', 'surgery' : 'APENDICECTOMIA', 'coin' : 'BOLIVAR' }, null, "json")

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
