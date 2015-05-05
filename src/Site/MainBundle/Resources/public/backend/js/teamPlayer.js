$(function(){
   function loadPlayer(idTeam, select){
       $.post('/admin/player/team/'+idTeam, {}, function(data){
            var players = JSON.parse(data);
           $.each(players, function(key, value){
                $(select)
                    .append('<option></option>')
                    .attr('value', key)
                    .text(value);
            });
       }).fail(function(){
           throw Error('Ошибка получения списка игроков');
       });
   }

   //$('a[data-collection="site_mainbundle_event_eventTeam"]').click(function(){
   //
   //});

    $('a[data-collection="site_mainbundle_event_playerTeam"]').click(function(){
        var numberTeam = $('#site_mainbundle_event_playerTeam .form-inline:last select:first').val(),
            idTeam = $('#site_mainbundle_event_eventTeam select').eq(numberTeam).val();

        $('#site_mainbundle_event_playerTeam .form-inline:last select')
            .eq(1)
            .find("option[value='initial']")
            .remove();

        loadPlayer(
            idTeam,
            $('#site_mainbundle_event_playerTeam .form-inline:last select').get(1)
        );
    });
});